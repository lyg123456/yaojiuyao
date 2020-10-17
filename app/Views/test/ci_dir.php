<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>ci框架目录</title>
</head>
<body>

1.    myshop
2.    |-----system                框架程序目录
3.        |-----core          框架的核心程序
4.            |-----CodeIgniter.php   引导性文件
5.            |-----Common.php    加载基类库的公共函数
6.            |-----Controller.php    基控制器类文件：CI_Controller
7.            |-----Model.php     基模型类文件：CI_Model
8.            |-----Config.php    配置类文件：CI_Config
9.            |-----Input.php     输入类文件：CI_Input
10.            |-----Output.php    输出类文件：CI_Output
11.            |-----URL.php       URL类文件：CI_URl
12.            |-----Router.php    路由类文件：CI_Router
13.            |-----Loader.php    加载类文件：CI_Loader
14.        |-----helpers           辅助函数
15.            |-----url_helper.php    url相关的辅助函数，如：创建url的辅助函数
16.            |-----captcha_helper.php创建图形验证码的辅助函数
17.        |-----libraries         通用类库
18.            |-----Pagination.php    通用分页类库
19.            |-----Upload.php    通用文件上传类库
20.            |-----Image_lib.php 通用图像处理类库
21.            |-----Session.php   通用session类库
22.        |-----language          语言包
23.        |-----database          数据库操作相关的程序
24.            |-----DB_active_rec.php 快捷操作类文件(ActiveRecord)
25.        |-----fonts         字库
26.
27.    |-----application           项目目录
28.        |-----core          项目的核心程序
29.        |-----helpers           项目的辅助函数
30.        |-----libraries         通用类库
31.        |-----language          语言包
32.        |-----config            项目相关的配置
33.            |-----config.php    项目相关的配置文件
34.            |-----database.php  数据库相关的配置文件
35.            |-----autoload.php  设置自动加载类库的配置文件
36.            |-----constants.php 常量配置文件
37.            |-----routes.php    路由配置文件
38.        |-----controllers       控制器目录
39.            |-----welcome.php   控制器文件，继承CI_Controller
40.        |-----models            模型目录
41.            |-----welcome_model.php 模型文件，继承CI_Model
42.        |-----views         视图目录
43.            |-----welcome.php   视图模板文件，默认后缀名为.php
44.        |-----cache         存放数据或模板的缓存文件
45.        |-----errors            错误提示模板
46.        |-----hooks         钩子，在不修改系统核心文件的基础上扩展系统功能
47.        |-----third_party       第三方库
48.        |-----logs          日志
49.
50.    |-----index.php             入口文件





1.    myshop
2.    |-----system                框架程序目录
3.        |-----core          框架的核心程序
4.            |-----CodeIgniter.php   引导性文件
5.            |-----Common.php    加载基类库的公共函数
6.            |-----Controller.php    基控制器类：CI_Controller
7.            |-----Model.php     基模型类：CI_Model
8.            |-----Config.php    配置类：CI_Config
9.            |-----Input.php     输入类：CI_Input
10.            |-----Output.php    输出类：CI_Output
11.            |-----URL.php       URL类：CI_URl
12.            |-----Router.php    路由类：CI_Router
13.            |-----Loader.php    加载类：CI_Loader
14.        |-----helpers           辅助函数
15.            |-----url_helper.php    url相关的辅助函数，如：创建url的辅助函数
16.            |-----captcha_helper.php创建图形验证码的辅助函数
17.            |-----xxx_helper.php    自定义辅助函数
18.        |-----libraries         通用类库
19.            |-----Pagination.php    通用分页类库
20.            |-----Upload.php    通用文件上传类库
21.            |-----Image_lib.php 通用图像处理类库
22.            |-----Session.php   通用session类库
23.            |-----Xxx.php       自定义类库
24.        |-----language          语言包
25.        |-----database          数据库操作相关的程序
26.            |-----DB_active_rec.php 快捷操作类文件(ActiveRecord)
27.        |-----fonts         字库
28.
29.    |-----application           项目目录
30.        |-----core          项目的核心程序
31.            |-----MY_Controller.php 扩展核心基控制器类：CI_Controller
32.        |-----helpers           项目的辅助函数
33.            |-----MY_url_helper.php 扩展系统url相关的辅助函数，如：创建url的辅助函数
34.            |-----MY_captcha_helper.php扩展系统创建图形验证码的辅助函数
35.            |-----url_helper.php    覆盖系统url相关的辅助函数，如：创建url的辅助函数
36.            |-----captcha_helper.php覆盖系统创建图形验证码的辅助函数
37.            |-----xxx_helper.php    创建自己的辅助函数
38.        |-----libraries         通用类库
39.            |-----MY_Pagination.php 扩展系统通用分页类库
40.            |-----MY_Upload.php 扩展系统通用文件上传类库
41.            |-----MY_Image_lib.php  扩展系统通用图像处理类库
42.            |-----MY_Session.php    扩展系统通用session类库
43.            |-----Pagination.php    覆盖系统通用分页类库
44.            |-----Upload.php    覆盖系统通用文件上传类库
45.            |-----Image_lib.php 覆盖系统通用图像处理类库
46.            |-----Session.php   覆盖系统通用session类库
47.            |-----Xxx.php       创建自己的类库
48.        |-----language          语言包
49.        |-----config            项目相关的配置
50.            |-----config.php    项目相关的配置文件
51.            |-----database.php  数据库相关的配置文件
52.            |-----autoload.php  设置自动加载类库的配置文件
53.            |-----constants.php 常量配置文件
54.            |-----routes.php    路由配置文件
55.        |-----controllers       控制器目录
56.            |-----admin     自定义目录,后台控制器文件可以划分到此目录中
57.                |-----welcome.php控制器文件，继承CI_Controller,也可以继承MY_Controller
58.                |-----common.php 自定义通用控制器文件，继承CI_Controller,也可以继承MY_Controller
59.            |-----home      自定义目录,前台控制器文件可以分化到此目录中
60.                |-----welcome.php控制器文件，继承CI_Controller,也可以继承MY_Controller
61.                |-----common.php 自定义通用控制器文件，继承CI_Controller,也可以继承MY_Controller
62.            |-----welcome.php   控制器文件，继承CI_Controller,也可以继承MY_Controller
63.        |-----models            模型目录
64.            |-----admin     自定义目录,后台模型文件可以划分到此目录中
65.                |-----welcome_model.php 模型文件，继承CI_Model
66.                |-----common_model.php  自定义通用模型文件，继承CI_Model
67.            |-----home      自定义目录,前台模型文件可以划分到此目录中
68.                |-----welcome_model.php 模型文件，继承CI_Model
69.                |-----common_model.php  自定义通用模型文件，继承CI_Model
70.            |-----welcome_model.php 模型文件，继承CI_Model
71.        |-----views           视图目录
72.            |-----admin       自定义目录,后台视图模板文件可以划分到此目录中
73.                |-----welcome.php 视图模板文件，后缀名可以是.php,也可以是.html等任意后缀
74.                |-----welcome.html视图模板文件，后缀名可以是.php,也可以是.html等任意后缀
75.                |-----welcome.tpl 视图模板文件，后缀名可以是.php,也可以是.html等任意后缀
76.            |-----home        自定义目录,前台视图模板文件可以划分到此目录中
77.                |-----welcome.php 视图模板文件，后缀名可以是.php,也可以是.html等任意后缀
78.                |-----welcome.html视图模板文件，后缀名可以是.php,也可以是.html等任意后缀
79.                |-----welcome.tpl 视图模板文件，后缀名可以是.php,也可以是.html等任意后缀
80.            |-----welcome.php   视图模板文件，默认后缀名为.php,后缀名也可以是.html等任意后缀
81.            |-----welcome.html  视图模板文件，后缀名可以是.php,也可以是.html等任意后缀
82.            |-----welcome.tpl       视图模板文件，后缀名可以是.php,也可以是.html等任意后缀
83.        |-----cache         存放数据或模板的缓存文件
84.        |-----errors            错误提示模板
85.        |-----hooks         钩子，在不修改系统核心文件的基础上扩展系统功能
86.        |-----third_party       第三方库
87.        |-----logs          日志
88.
89.    |-----index.php             入口文件
90.    |-----admin.php             自定义后台入口文件

</body>
</html>