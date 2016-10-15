<?php

namespace App\Helpers;

use Carbon\Carbon;

class Calendar
{
	private static $_instance = null;

	private $agendas = [];
	private $dateDebut;
	private $dateFin;

	public function __construct($dates = [])
	{
		if(is_array($dates) && !empty($dates)) {

		} else {
			$this->dateDebut = Carbon::now()->startOfWeek();
			$this->dateFin = Carbon::now()->endOfWeek();
		}
	}

	public static function getInstance() {
		if(is_null(self::$_instance)) {
			self::$_instance = new Calendar();
		}
		return self::$_instance;
	}

	public function setAgendas($agendas)
	{
		$agendas->map(function($agenda) {
			$this->agendas[$agenda->date_recette->format('d/m/Y')][$agenda->moment][] = [
				'id' 			=> $agenda->id,
				'recette_id' 	=> $agenda->recette_id,
				'nom' 			=> $agenda->recette->nom
			];
		});

		return $this;
	}

	private function processDays()
	{
		$days = [];
		while ($this->dateDebut->getTimestamp() < $this->dateFin->getTimestamp()) {
			$recettes = isset($this->agendas[$this->dateDebut->format('d/m/Y')]) ? $this->agendas[$this->dateDebut->format('d/m/Y')] : null;
			$days[$this->dateDebut->format('d/m/Y')] = $recettes;

			$this->dateDebut->addDays(1);
		}

		return $days;
	}

	public function render()
	{
		return view('calendar', [
			'days' 	=> $this->processDays(),
		]);
	}


}
