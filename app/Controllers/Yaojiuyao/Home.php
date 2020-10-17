<?php namespace App\Controllers;

use app\Controllers\Common\BaseController;
class Home extends BaseController
{
	public function index()
	{
		return view('test/ci_dir');
	}

	//--------------------------------------------------------------------

}
