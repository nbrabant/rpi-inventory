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
		if ($agent->isTablet() && View::exists('tablette.'.$file)) {
			$this->viewName = 'tablette.'.$file;
		} elseif ($agent->isMobile() && View::exists('mobile.'.$file)) {
			$this->viewName = 'mobile.'.$file;
		} else {
			$this->viewName = 'desktop.'.$file;
		}

		// $this->viewName = 'tablette.'.$file;

		return view($this->viewName, $datas);
	}

}
