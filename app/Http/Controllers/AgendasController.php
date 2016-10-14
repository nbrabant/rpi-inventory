<?php

namespace App\Http\Controllers;

use App\Agenda;
use App\Recette;
use App\Operation;
use App\Agendaproducts;
use App\Helpers\Calendar;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AgendasController extends Controller
{
	private $js_files 	= ['bootstrap-datepicker.js', 'select2.min.js', 'agendas.js'];
	private $css_files 	= ['datepicker.css', 'select2.css'];

	public function index(Agenda $agenda, Request $request)
	{
		$dates = [
			'startAt'   => Carbon::now()->startOfWeek(),
			'endAt'     => Carbon::now()->endOfWeek(),
		];

		$calendar = new Calendar($dates);

		return $this->getView('agendas.index', [
			'title'			=> 'Agendas',
			'breadcrumb'	=> [
				'Accueil' => url()
			],
			'btnHeading'	=> [
				'Ajouter' => '<a href="/agendas/add" class="btn btn-sm btn-success pull-right"><span class="glyphicon glyphicon-plus"></span> Ajouter</a>'
			],
			'calendar'	=> Calendar::getInstance()->setAgendas($agenda->with('recette')->byDateInterval($dates)->get())->render(),
			'produits'	=> Agendaproducts::all()
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

		return $this->getView('agendas.add', [
			'title' 		=> 'Planification d\'une recette',
			'breadcrumb'	=> [
				'Accueil' => url(),
				'Agenda'  => url().'/agendas',
			],
			'js_files'		=> $this->js_files,
			'css_files'		=> $this->css_files,
			'listeRecettes' => Recette::getList(),
			'listeMoments' 	=> Agenda::getMomentList(),
		]);
	}

	public function recette(Agenda $agenda, Recette $recette, Request $request)
	{
		$return =  $this->getView('agendas.recette', [
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

		// maj des quantités produits (opérations)
		$agenda->recette->produits->map(function($produit) use($agenda) {
			$operation = new Operation();
			$operation->produit_id	= $produit->produit_id;
			$operation->operation	= '-';
			$operation->quantite	= $produit->getQuantity();
			$operation->detail		= 'Recette : "'.$agenda->recette->nom.'"';
			$operation->save();
		});

		return redirect(url('agendas'));
	}

	public function delete(Agenda $agenda, Request $request)
	{
		$agenda->delete();
		return redirect(url('agendas'));
	}
}
