<?php

namespace App\Helpers;

use Cache;

trait CrawlerTraitHelper
{
	private $_uri = 'http://www.750g.com/recherche.htm';

	// requête CURL recherche
	// http://www.cuisineaz.com/recettes/recherche_v2.aspx?recherche=pomme-carotte

	// requête CURL accès
	// http://www.marmiton.org/recettes/recette_veloute-de-carottes-au-cumin_16952.aspx

	public function getApiRecettes($ingredients) {
		$cacheKey = str_replace(' ', '-', $ingredients);

		$results = Cache::get($cacheKey);
		if(is_null($results)) {
			$postDatas = [
				'search' => str_replace(' ', ' ', $ingredients)
			];

			// envoi du résultat dans un fichier de cache au nom de la recherche
			$results = $this->getSslPage($this->_uri, $postDatas);

			Cache::put($cacheKey, $results, 60);
		}

		return $this->parseRecipes($results);
	}

	public function getDetailRecettes($uri) {
		$results = Cache::get($uri);
		if(is_null($results)) {
			// envoi du résultat dans un fichier de cache au nom de la recherche
			$results = $this->getSslPage('http://www.750g.com'.$uri);

			Cache::put($uri, $results, 60);
		}

		return $this->populateRecette($results);
	}

	private function parseRecipes($html)
	{
		$xml = new \DOMDocument();

		@$xml->loadHTML($html, LIBXML_ERR_NONE);

		$recipes = [];
		foreach($xml->getElementsByTagName('section') as $recipe) {
			$links = [];
			foreach($recipe->getElementsByTagName('a') as $link) {
		        $links[] = ['url' => $link->getAttribute('href'), 'name' => $link->nodeValue];
		    }

			if(empty($links)) {
				continue;
			}

			$images = [];
			foreach($recipe->getElementsByTagName('img') as $image) {
		        $images[] = ['src' => $link->getAttribute('src')];
		    }

			$recipes[] = [
				'name' 	=> reset($links)['name'],
				'url' 	=> reset($links)['url'],
				'img' => !empty($images) ? reset($images)['src'] : public_path().'/img/index.jpg',
			];
		}

		return $recipes;
	}

	private function populateRecette($html)
	{
		$xml = new \DOMDocument();

		@$xml->loadHTML($html, LIBXML_ERR_NONE);

		$return = [
			'nom'				=> '',
			'imgurl'			=> '',
			'instructions'		=> '',
			'nombre_personnes'	=> '',
			'temps_preparation'	=> '',
			'temps_cuisson'		=> '',
			'ingredients'		=> '',
		];

		foreach($xml->getElementsByTagName('h1') as $element) {
			$return['nom'] = $element->nodeValue;
		}

		foreach($this->domFinderByAttibuteName($xml, 'c-swiper__media') as $element) {
			$return['imgurl'] = $element->getAttribute('src');
		}

		foreach($this->domFinderByAttibuteName($xml, 'c-recipe-steps__item') as $element) {
			$return['instructions'] .= $element->nodeValue;
		}

		foreach($this->domFinderByAttibuteName($xml, 'recipeYield', 'itemprop') as $element) {
			$return['nombre_personnes'] = $element->nodeValue;
		}

		foreach($this->domFinderByAttibuteName($xml, 'ingredients', 'itemprop') as $element) {
			$return['ingredients'] .= $element->nodeValue;
		}

		return $return;
	}

	private static function getSslPage($url, $postDatas = false) {
		try {
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
			curl_setopt($ch, CURLOPT_FAILONERROR, true);
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_REFERER, $url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

			if($postDatas !== false && is_array($postDatas) && !empty($postDatas)) {
				$postString = '';
				foreach ($postDatas as $field => $data) {
					$postString .= $field.'='.$data.'&';
				}
				curl_setopt($ch,CURLOPT_POST, count($postDatas));
				curl_setopt($ch,CURLOPT_POSTFIELDS, $postString);
			}

			$result = curl_exec($ch);
			$resultStatus = curl_getinfo($ch);
			if(is_array($resultStatus) && isset($resultStatus['http_code']) && $resultStatus['http_code'] == 200) {
				return $result;
			}
			return false;
		} catch (\Exception $e) {
			throw $e;
		}
	}

	private function domFinderByAttibuteName($xml, $content = '', $typeAttribute = 'class') {
		$finder = new \DomXPath($xml);
		return $finder->query("//*[contains(concat(' ', normalize-space(@$typeAttribute), ' '), ' $content ')]");
	}

}
