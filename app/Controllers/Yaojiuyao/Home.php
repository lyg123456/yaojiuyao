<?php namespace App\Controllers;

namespace App\Controllers\Yaojiuyao;

use App\Controllers\Common\Common;
use App\Models\Yaojiuyao\HomeModel;
use App\Component\Validate\Validator;



class Home extends Common
{

    //接口访问：http://api.yaojiuyao.cn/yaojiuyao/home/index
	public function index()
	{



		return view('test/ci_dir');
	}


    //接口访问：http://api.yaojiuyao.cn/
    public function test()
    {
        $return = [];
        $params = $_POST;
        $validator =  new Validator();
        $home = new HomeModel();
        $return = $home->index($params);

        echo json_encode($return);
        //return json_encode($return);
    }

}
