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
		]);
	}

	public function add(Agenda $agenda, Request $request)
	{
		if($request->method() == 'POST') {
			$this->validate($request, $agenda->getValidators());

			$values = $request->all();

			$agenda = new Agenda;
			$agenda->recette_id 	= $values['recette_id'];
			$agenda->date_recette 	= $values['date_recette'];
			$agenda->moment 		= $values['moment'];

			if($agenda->save()) {
				return redirect(url('agendas'))->with('success', 'Recette intégrée à l\'agenda');
			}
		}

		return view('agendas.add', [
			'title' 		=> 'Planification d\'une recette',
			'js_files'		=> ['bootstrap-datepicker.js', 'agendas.js'],
			'css_files'		=> ['bootstrap-datepicker.min.css'],
			'listeRecettes' => Recette::getList(),
			'listeMoments' 	=> Agenda::getMomentList(),
		]);
	}

	public function recette(Agenda $agenda, Recette $recette, Request $request)
	{
		$return =  view('agendas.recette', [
			'title'     	=> $recette->nom,
            'agenda'		=> $agenda,
            'recette'		=> $recette,
			'ingredients' 	=> $recette->produits
		])->render();

		return response()->json([
			'status' => true,
			'html' => $return
		]);
	}

	public function realise(Agenda $agenda, Request $request)
	{
		$agenda->realise = 1;
		$agenda->save();

		// @TODO maj des quantités produits (opérations)
		// fe $agenda->recette->produits

		return redirect(url('agendas'));
	}

	public function delete(Agenda $agenda, Request $request)
	{
		$agenda->delete();
		return redirect(url('agendas'));
	}
}
