<?php

namespace App\Helpers;

use Cache;

trait CrawlerTraitHelper
{
	private $_uri = 'http://www.cuisineaz.com/recettes/recherche_v2.aspx?';

	// requête CURL recherche
	// http://www.cuisineaz.com/recettes/recherche_v2.aspx?recherche=pomme-carotte

	// requête CURL accès
	// http://www.marmiton.org/recettes/recette_veloute-de-carottes-au-cumin_16952.aspx

	public function getApiRecettes($ingredients) {
		$cacheKey = str_replace(' ', '-', $ingredients);

		$results = Cache::get($cacheKey);
		if(is_null($results)) {
			$postDatas = [
				'recherche' => str_replace(' ', '-', $ingredients)
			];

			// envoi du résultat dans un fichier de cache au nom de la recherche
			$results = $this->parseRecettes($this->getSslPage($this->_uri, $postDatas));

			Cache::put($cacheKey, $results, 60);
		}
		return $results;
	}

	private function parseRecettes($html)
	{
		// m_resultats_liste_recherche

		// premier tag
		// $html = strstr($html, '<div class="m_rechercher_recette"');
		//
		// $html = str_replace(strstr($html, '<div id="m_col_right"'), '', $html);

		return $html;
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
var_dump($resultStatus); exit;
			if(is_array($resultStatus) && isset($resultStatus['http_code']) && $resultStatus['http_code'] == 200) {
				return $result;
			}
			return false;
		} catch (\Exception $e) {
			throw $e;
		}
	}
}
