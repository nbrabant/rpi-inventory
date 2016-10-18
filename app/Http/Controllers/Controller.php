<?php namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesCommands;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\View;
use Jenssegers\Agent\Agent;

abstract class Controller extends BaseController {

	use DispatchesCommands, ValidatesRequests;

	protected $viewName = '';

	public function getView($file = '', $datas = [])
	{
		$agent = new Agent();
		if (($agent->isTablet() || $agent->match('midori')) && View::exists('tablette.'.$file)) {
			$this->viewName = 'tablette.'.$file;
		} elseif ($agent->isMobile() && View::exists('mobile.'.$file)) {
			$this->viewName = 'mobile.'.$file;
		} else {
			$this->viewName = 'desktop.'.$file;
		}

		$data['userAgent'] = $agent;

		return view($this->viewName, $datas);
	}

}
