<?php

namespace App\Http\Controllers;

use App\Agenda;
use App\Recette;
use App\Helpers\Calendar;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AgendasController extends Controller
{
	public function index(Agenda $agenda, Request $request)
	{
		$dates = [
			'startAt'   => Carbon::now()->startOfWeek(),
			'endAt'     => Carbon::now()->endOfWeek(),
		];

		$calendar = new Calendar($dates);

		return view('agendas.index', [
			'title'		=> 'Agendas',
			'calendar'	=> Calendar::getInstance()->setAgendas($agenda->with('recette')->byDateInterval($dates)->get())->render()
			// 'js_files'		=> ['category.js']
		]);
	}

	public function recette(Recette $recette, Request $request)
	{
		$return =  view('agendas.recette', [
			'title'     	=> $recette->nom,
            'recette'		=> $recette,
			'ingredients' 	=> $recette->produits
		])->render();

		return response()->json([
			'status' => true,
			'html' => $return
		]);
	}
}
