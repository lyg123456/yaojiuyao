<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>ci框架目录</title>
</head>
<body>
<p>
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
            /Config         Stores the configuration files
            /Controllers    Controllers determine the program flow
            /Database       Stores the database migrations and seeds files
            /Filters        Stores filter classes that can run before and after controller
            /Helpers        Helpers store collections of standalone functions
            /Language       Multiple language support reads the language strings from here
            /Libraries      Useful classes that don't fit in another category
            /Models         Models work with the database to represent the business entities.
            /ThirdParty     ThirdParty libraries that can be used in application
            /Views          Views make up the HTML that is displayed to the client.
49.
50.    |-----index.php             入口文件



</p>
</body>
</html>