<?php namespace App\Controllers;

namespace App\Controllers\Yaojiuyao;

use App\Controllers\Common\Common;

class Home extends Common
{

    //接口访问：http://api.yaojiuyao.cn/yaojiuyao/home/index
	public function index()
	{
		return view('test/ci_dir');
	}

	//--------------------------------------------------------------------

}
