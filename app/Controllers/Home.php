<?php namespace App\Controllers;

namespace App\Controllers;

use App\Controllers\Common\Common;


class Home extends Common
{

    //接口访问：http://api.yaojiuyao.cn/
	public function index()
	{
	    
		return view('test/ci_dir');
	}


    //--------------------------------------------------------------------

}
