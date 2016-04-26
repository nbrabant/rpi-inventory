<?php

namespace App\Helpers;

trait MarmitonTraitHelper
{
	private $_uri = 'http://www.marmiton.org/recettes/recherche.aspx?';

	// requête CURL recherche
	// http://www.marmiton.org/recettes/recherche.aspx?aqt=pomme-carotte&st=1

	// requête CURL accès
	// http://www.marmiton.org/recettes/recette_veloute-de-carottes-au-cumin_16952.aspx

	public function getApiRecettes($ingredients) {
		$postDatas = [
			'aqt' 	=> str_replace(' ', '-', $ingredients),
			'st' 	=> 1
		];

		// si fichier cache existe
		// load file

		// envoi du résultat dans un fichier de cache au nom de la recherche
		$results = $this->getSslPage($this->_uri, $postDatas);

		var_dump($results);
	}

	private function parseRecettes()
	{
		
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
				return $resultStatus;
			}
			return false;
		} catch (\Exception $e) {
			throw $e;
		}
	}
}
