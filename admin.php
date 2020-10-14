<?php
/**
 * @author Mahesh Babu <app@godigitally.co.in>
 * @copyright Go Digitally 2020
 * @package general-studies
 * 
 * 
 * Created using IMA BuildeRz v3
 */


/** site **/
$config["app-name"]			= "General Studies" ; //Write the name of your website
$config["app-desc"]			= "General Studies App for Android" ; //Write a brief description of your website
$config["utf8"]				= true; 
$config["background"]		= "https://cdn.jsdelivr.net/wp/themes/twentyseventeen/1.1/assets/images/coffee.jpg"; 
$config["logo"]		= "https://placehold.it/200x200"; 
$config["timezone"]		= "Asia/Kolkata" ; // check this site: http://php.net/manual/en/timezones.php
$config["color"]			= "blue"; 
$config["debug"]			= false; 
$config["gzip"]			= false; //compressed page 

/** mysql **/
$config["db_host"]				= "localhost" ; //host
$config["db_user"]				= "root" ; //Username SQL
$config["db_pwd"]				= "123456" ; //Password SQL
$config["db_name"]			= "db_general_studies" ; //Database

/** onesignal **/
$config["onesignal_app_id"]				= "7911f20c-ac65-46f7-bc61-0b788280804e" ; //Your OneSignal AppId, available in OneSignal https://documentation.onesignal.com/docs/generate-a-google-server-api-key
$config["onesignal_api_key"]			= "ZTc1MWRiYTEtYjZmNS00MjgyLWE0NGItOTFmZjMwZmY4YWQ5" ; //Your OneSignal ApiKey, required for push notification sender


/** DON'T EDIT THE CODE BELLOW **/
session_start();
if($config["gzip"]==true){
	ob_start("ob_gzhandler");
}
ini_set("internal_encoding", "utf-8");
date_default_timezone_set($config["timezone"]);
if(!isset($_SESSION["IS_LOGIN"])){
	$_SESSION["IS_LOGIN"] = false;
}
$app_name = $config["app-name"];
$app_desc = $config["app-desc"];
$page_title = "Welcome";
$content = $body_class = "";

if(!isset($_GET["page"])){
	$_GET["page"] = "home";
}
if($_GET["page"]==""){
	$_GET["page"] = "home";
}
if(!isset($_GET["action"])){
	$_GET["action"] = "list";
}
if($config["debug"]==true){
	error_reporting(E_ALL);
}else{
	error_reporting(0);
}

/** connect to mysql **/
$mysql = new mysqli($config["db_host"], $config["db_user"], $config["db_pwd"], $config["db_name"]);
if (mysqli_connect_errno()){
	die(mysqli_connect_error());
}

if($config["utf8"]==true){
	$mysql->set_charset("utf8");
}

switch($_GET["page"]){
	// TODO: PAGE - HOME
	case "home":
		if($_SESSION["IS_LOGIN"]==false){
			header("Location: ?page=login");
		}
		$page_title = "Dashboard";
		$body_class = "hold-transition skin-".$config["color"]." sidebar-mini";
		$current_user = $_SESSION["CURRENT_USER"];
		$content = null;
		$content .= '<div class="wrapper">';
		$content .= '<header class="main-header">';
		$content .= '<a href="?" class="logo">';
		$content .= '<span class="logo-mini"><b>PN</b>L</span>';
		$content .= '<span class="logo-lg"><b>'.$app_name.'</b> Panel</span>';
		$content .= '</a>';
		$content .= '<nav class="navbar navbar-static-top">';
		$content .= '<a href="?" class="sidebar-toggle" data-toggle="push-menu" role="button">';
		$content .= '<span class="sr-only">Toggle navigation</span>';
		$content .= '<span class="icon-bar"></span>';
		$content .= '<span class="icon-bar"></span>';
		$content .= '<span class="icon-bar"></span>';
		$content .= '</a>';
		$content .= '<div class="navbar-custom-menu">';
		$content .= '<ul class="nav navbar-nav">';
		$content .= '<li class="dropdown user user-menu">';
		$content .= '<a href="?" class="dropdown-toggle" data-toggle="dropdown">';
		$content .= '<img src="https://www.gravatar.com/avatar/' . md5(strtolower(trim($current_user['user_email']))).'" class="user-image" alt="User Image">';
		$content .= '<span class="hidden-xs">' . htmlentities(stripslashes($current_user['user_name'])).'</span>';
		$content .= '</a>';
		$content .= '<ul class="dropdown-menu">';
		$content .= '<li class="user-header">';
		$content .= '<img src="https://www.gravatar.com/avatar/' . md5(strtolower(trim($current_user['user_email']))).'" class="img-circle" alt="User Image">';
		$content .= '<p>';
		$content .= '' . htmlentities(stripslashes($current_user['user_name'])).'';
		$content .= '<small>' . htmlentities(stripslashes($current_user['user_level'])).'</small>';
		$content .= '</p>';
		$content .= '</li>';
		$content .= '<li class="user-footer">';
		$content .= '<div class="pull-left">';
		$content .= '<a href="?page=profile" class="btn btn-default btn-flat">Profile</a>';
		$content .= '</div>';
		$content .= '<div class="pull-right">';
		$content .= '<a href="?page=logout" class="btn btn-default btn-flat">Sign out</a>';
		$content .= '</div>';
		$content .= '</li>';
		$content .= '</ul>';
		$content .= '</li>';
		$content .= '</ul>';
		$content .= '</div>';
		$content .= '</nav>';
		$content .= '</header>';
		$content .= '<aside class="main-sidebar">';
		$content .= '<section class="sidebar">';
		$content .= '<div class="user-panel">';
		$content .= '<div class="pull-left image">';
		$content .= '<img src="https://www.gravatar.com/avatar/' . md5(strtolower(trim($current_user['user_email']))).'" class="img-circle" alt="'.htmlentities(stripslashes($current_user['user_name'])).'">';
		$content .= '</div>';
		$content .= '<div class="pull-left info">';
		$content .= '<p>'.htmlentities(stripslashes($current_user['user_name'])).'</p>';
		$content .= '<a href="?"><i class="fa fa-circle text-success"></i> '.htmlentities(stripslashes($current_user['user_level'])).'</a>';
		$content .= '</div>';
		$content .= '</div>';
		$content .= '<ul class="sidebar-menu" data-widget="tree">';
		$content .= '<li class="header">DATA MANAGER</li>';
		$content .= '<li class="treeview active">';
		$content .= '<a href="?">';
		$content .= '<i class="fa fa-book"></i> <span>Books</span>';
		$content .= '<span class="pull-right-container">';
		$content .= '<i class="fa fa-angle-left pull-right"></i>';
		$content .= '</span>';
		$content .= '</a>';
		$content .= '<ul class="treeview-menu">';
		$content .= '<li><a href="?page=books&amp;action=add"><i class="fa fa-plus"></i> Add New</a></li>';
		$content .= '<li><a href="?page=books&amp;action=list"><i class="fa fa-list-ul"></i> All Books</a></li>';
		$content .= '</ul>';
		$content .= '</li>';
		$content .= '<li class="treeview ">';
		$content .= '<a href="?">';
		$content .= '<i class="fa fa-book"></i> <span>Chapters</span>';
		$content .= '<span class="pull-right-container">';
		$content .= '<i class="fa fa-angle-left pull-right"></i>';
		$content .= '</span>';
		$content .= '</a>';
		$content .= '<ul class="treeview-menu">';
		$content .= '<li><a href="?page=chapters&amp;action=add"><i class="fa fa-plus"></i> Add New</a></li>';
		$content .= '<li><a href="?page=chapters&amp;action=list"><i class="fa fa-list-ul"></i> All Chapters</a></li>';
		$content .= '</ul>';
		$content .= '</li>';
		$content .= '<li class="header">TOOLS</li>';
		$content .= '<li><a href="?page=onesignal-sender"><i class="fa fa-send"></i> <span>OneSignal Sender</span></a></li>';
		$content .= '<li class="header">USERS</li>';
		$content .= '<li><a href="?page=profile"><i class="fa fa-user"></i> <span>Your Profile</span></a></li>';
		$content .= '</ul>';
		$content .= '</section>';
		$content .= '</aside>';
		$content .= '<div class="content-wrapper">';
		/** breadcrumb **/
		$content .= '<section class="content-header">';
		$content .= '<h1>Dashboard</h1>';
		$content .= '<ol class="breadcrumb">';
		$content .= '<li><a href="?"><i class="fa fa-dashboard"></i> Home</a></li>';
		$content .= '<li class="active">Dashboard</li>';
		$content .= '</ol>';
		$content .= '</section>';
		/** content **/
		$content .= '<section class="content">';
		$content .= '<div class="box">';
		$content .= '<div class="box-header with-border">';
		$content .= '<h3 class="box-title">Welcome</h3>';
		$content .= '<div class="box-tools pull-right">';
		$content .= '<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>';
		$content .= '<button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>';
		$content .= '</div>';
		$content .= '</div>';
		$content .= '<div class="box-body">';
		$content .= '<div class="well">';
		$content .= '<h2>Welcome to</h2><h1>'.$app_name.'!</h1>';
		$content .= '<p class="lead">'.$app_desc.'</p>';
		$content .= '</div>';
		$content .= '<div class="row">';
		
		/** count books data **/
		$sql_query = "SELECT COUNT(*) AS `total` FROM `books` LIMIT 0,1" ;
		$result = $mysql->query($sql_query);
		$count = $result->fetch_array();
		$content .= '<div class="col-lg-3 col-xs-6">';
		$content .= '<div class="small-box bg-blue">';
		$content .= '<div class="inner">';
		$content .= '<h3>'.$count["total"].'<sup style="font-size: 20px">items</sup></h3>';
		$content .= '<p>Books</p>';
		$content .= '</div>';
		$content .= '<div class="icon">';
		$content .= '<i class="fa fa-book"></i>';
		$content .= '</div>';
		$content .= '<a href="?page=books&amp;action=list" class="small-box-footer">';
		$content .= 'More <i class="fa fa-arrow-circle-right"></i>';
		$content .= '</a>';
		$content .= '</div>';
		$content .= '</div>';
		
		/** count chapters data **/
		$sql_query = "SELECT COUNT(*) AS `total` FROM `chapters` LIMIT 0,1" ;
		$result = $mysql->query($sql_query);
		$count = $result->fetch_array();
		$content .= '<div class="col-lg-3 col-xs-6">';
		$content .= '<div class="small-box bg-yellow">';
		$content .= '<div class="inner">';
		$content .= '<h3>'.$count["total"].'<sup style="font-size: 20px">items</sup></h3>';
		$content .= '<p>Chapters</p>';
		$content .= '</div>';
		$content .= '<div class="icon">';
		$content .= '<i class="fa fa-book"></i>';
		$content .= '</div>';
		$content .= '<a href="?page=chapters&amp;action=list" class="small-box-footer">';
		$content .= 'More <i class="fa fa-arrow-circle-right"></i>';
		$content .= '</a>';
		$content .= '</div>';
		$content .= '</div>';
		$content .= '</div>';
		$content .= '</div>';
		$content .= '</div>';
		$content .= '</section>';
		$content .= '</div>';
		$content .= '<footer class="main-footer">';
		$content .= '<div class="pull-right hidden-xs">';
		$content .= '<b>Version</b> 01.01.01';
		$content .= '</div>';
		$content .= '<strong>Copyright &copy; '.date("Y").' <a href="https://godigitally.co.in">Go Digitally</a>.</strong> All rights reserved.';
		$content .= '</footer>';
		$content .= '</div>';
		break;
	// TODO: PAGE - LOGIN
	case "login":
		$page_title = "Login";
		$body_class = "hold-transition login-page";
		$notification = '<p class="login-box-msg text-success">Sign in to start your session</p>';
		if(isset($_POST["submit"])){
			if(filter_var($_POST["user"]["email"], FILTER_VALIDATE_EMAIL)) {
				$user_email = addslashes($_POST["user"]["email"]);
				$user_password = sha1("imabuilder" . $_POST["user"]["password"]);
				$sql_query = "SELECT * FROM `users` WHERE `user_email` = '{$user_email}' AND `user_password` = '{$user_password}' AND `user_level` = 'admin' AND `user_status` = 'active'" ;
				$result = $mysql->query($sql_query);
				$current_user = $result->fetch_array();
				if(isset($current_user["user_email"])){
					$_SESSION["IS_LOGIN"] = true;
					$_SESSION["CURRENT_USER"]["user_id"] = $current_user["user_id"];
					$_SESSION["CURRENT_USER"]["user_name"] = $current_user["user_name"];
					$_SESSION["CURRENT_USER"]["user_first_name"] = $current_user["user_first_name"];
					$_SESSION["CURRENT_USER"]["user_last_name"] = $current_user["user_last_name"];
					$_SESSION["CURRENT_USER"]["user_email"] = $current_user["user_email"];
					$_SESSION["CURRENT_USER"]["user_level"] = $current_user["user_level"];
					header("Location: ?page=home");
				}else{
					$notification =  '<p class="login-box-msg text-danger">Incorrect email or password, please try again</p>';
				}
			}else{
				$notification =  '<p class="login-box-msg text-danger">Incorrect email or password, please try again!</p>';
			}
		}
		$content = null;
		$content .= '<div class="login-box">';
		$content .= '<div class="login-logo">';
		$content .= '<img src="'.$config["logo"].'?1602092005" />';
		$content .= '<br/><a href="?"><b>'. $app_name .'</b> Panel</a>';
		$content .= '</div>';
		$content .= '<div class="login-box-body">';
		$content .= '<h4 class="text-center">Admin</h4>';
		$content .= $notification;
		$content .= '<form action="" method="post" autocomplete="off">';
		$content .= '<div class="form-group has-feedback">';
		$content .= '<input type="email" name="user[email]" class="form-control" placeholder="Email" autocomplete="off">';
		$content .= '<span class="glyphicon glyphicon-envelope form-control-feedback"></span>';
		$content .= '</div>';
		$content .= '<div class="form-group has-feedback">';
		$content .= '<input type="password" name="user[password]" class="form-control" placeholder="Password" autocomplete="off">';
		$content .= '<span class="glyphicon glyphicon-lock form-control-feedback"></span>';
		$content .= '</div>';
		$content .= '<div class="row">';
		$content .= '<div class="col-xs-8">';
		$content .= '</div>';
		$content .= '<div class="col-xs-4">';
		$content .= '<button type="submit" name="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>';
		$content .= '</div>';
		$content .= '</div>';
		$content .= '</form>';
		$content .= '</div>';
		$content .= '</div>';
		break;
	// TODO: PAGE - LOGOUT
	case "logout":
		unset($_SESSION["IS_LOGIN"]);
		unset($_SESSION["CURRENT_USER"]);
		//session_destroy();
		header("Location: ?page=login");
		break;
	// TODO: PAGE - BOOKS
	case "books":
		$notification = null;
		if(isset($_GET["notice"])){
			switch($_GET["notice"]){
				case "success-delete":
					$notification .= '<div id="notification" class="alert alert-success">';
					$notification .= '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
					$notification .= 'You have successfully deleted the item of the <strong>Books data</strong>';
					$notification .= '</div>';
					break;
				case "success-edit":
					$notification .= '<div id="notification" class="alert alert-success">';
					$notification .= '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
					$notification .= 'You have successfully update the item of the <strong>Books data</strong>';
					$notification .= '</div>';
					break;
				case "success-add":
					$notification .= '<div id="notification" class="alert alert-success">';
					$notification .= '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
					$notification .= 'You have successfully add new item to the <strong>Books data</strong>';
					$notification .= '</div>';
					break;
				case "wrong-id":
					$notification .= '<div id="notification" class="alert alert-danger">';
					$notification .= '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
					$notification .= 'You did not find ID of this item in <strong>Books</strong>';
					$notification .= '</div>';
					break;
			}
		}
		if($_SESSION["IS_LOGIN"]==false){
			header("Location: ?page=login");
		}
		$page_title = "Books";
		$body_class = "hold-transition skin-".$config["color"]." sidebar-mini";
		$current_user = $_SESSION["CURRENT_USER"];
		$content = null;
		$content .= '<div class="wrapper">';
		$content .= '<header class="main-header">';
		$content .= '<a href="?" class="logo">';
		$content .= '<span class="logo-mini"><b>PN</b>L</span>';
		$content .= '<span class="logo-lg"><b>'.$app_name.'</b> Panel</span>';
		$content .= '</a>';
		$content .= '<nav class="navbar navbar-static-top">';
		$content .= '<a href="?" class="sidebar-toggle" data-toggle="push-menu" role="button">';
		$content .= '<span class="sr-only">Toggle navigation</span>';
		$content .= '<span class="icon-bar"></span>';
		$content .= '<span class="icon-bar"></span>';
		$content .= '<span class="icon-bar"></span>';
		$content .= '</a>';
		$content .= '<div class="navbar-custom-menu">';
		$content .= '<ul class="nav navbar-nav">';
		$content .= '<li class="dropdown user user-menu">';
		$content .= '<a href="?" class="dropdown-toggle" data-toggle="dropdown">';
		$content .= '<img src="https://www.gravatar.com/avatar/' . md5(strtolower(trim($current_user['user_email']))).'" class="user-image" alt="User Image">';
		$content .= '<span class="hidden-xs">' . htmlentities(stripslashes($current_user['user_name'])).'</span>';
		$content .= '</a>';
		$content .= '<ul class="dropdown-menu">';
		$content .= '<li class="user-header">';
		$content .= '<img src="https://www.gravatar.com/avatar/' . md5(strtolower(trim($current_user['user_email']))).'" class="img-circle" alt="User Image">';
		$content .= '<p>';
		$content .= '' . htmlentities(stripslashes($current_user['user_name'])).'';
		$content .= '<small>' . htmlentities(stripslashes($current_user['user_level'])).'</small>';
		$content .= '</p>';
		$content .= '</li>';
		$content .= '<li class="user-footer">';
		$content .= '<div class="pull-left">';
		$content .= '<a href="?page=profile" class="btn btn-default btn-flat">Profile</a>';
		$content .= '</div>';
		$content .= '<div class="pull-right">';
		$content .= '<a href="?page=logout" class="btn btn-default btn-flat">Sign out</a>';
		$content .= '</div>';
		$content .= '</li>';
		$content .= '</ul>';
		$content .= '<li>';
		$content .= '</ul>';
		$content .= '</div>';
		$content .= '</nav>';
		$content .= '</header>';
		$content .= '<aside class="main-sidebar">';
		$content .= '<section class="sidebar">';
		$content .= '<div class="user-panel">';
		$content .= '<div class="pull-left image">';
		$content .= '<img src="https://www.gravatar.com/avatar/' . md5(strtolower(trim($current_user['user_email']))).'" class="img-circle" alt="'.htmlentities(stripslashes($current_user['user_name'])).'">';
		$content .= '</div>';
		$content .= '<div class="pull-left info">';
		$content .= '<p>'.htmlentities(stripslashes($current_user['user_name'])).'</p>';
		$content .= '<a href="?"><i class="fa fa-circle text-success"></i> '.htmlentities(stripslashes($current_user['user_level'])).'</a>';
		$content .= '</div>';
		$content .= '</div>';
		$content .= '<ul class="sidebar-menu" data-widget="tree">';
		$content .= '<li class="header">DATA MANAGER</li>';
		$content .= '<li class="treeview active">';
		$content .= '<a href="?">';
		$content .= '<i class="fa fa-book"></i> <span>Books</span>';
		$content .= '<span class="pull-right-container">';
		$content .= '<i class="fa fa-angle-left pull-right"></i>';
		$content .= '</span>';
		$content .= '</a>';
		$content .= '<ul class="treeview-menu">';
		$content .= '<li><a href="?page=books&amp;action=add"><i class="fa fa-plus"></i> Add New</a></li>';
		$content .= '<li><a href="?page=books&amp;action=list"><i class="fa fa-list-ul"></i> All Books</a></li>';
		$content .= '</ul>';
		$content .= '</li>';
		$content .= '<li class="treeview ">';
		$content .= '<a href="?">';
		$content .= '<i class="fa fa-book"></i> <span>Chapters</span>';
		$content .= '<span class="pull-right-container">';
		$content .= '<i class="fa fa-angle-left pull-right"></i>';
		$content .= '</span>';
		$content .= '</a>';
		$content .= '<ul class="treeview-menu">';
		$content .= '<li><a href="?page=chapters&amp;action=add"><i class="fa fa-plus"></i> Add New</a></li>';
		$content .= '<li><a href="?page=chapters&amp;action=list"><i class="fa fa-list-ul"></i> All Chapters</a></li>';
		$content .= '</ul>';
		$content .= '</li>';
		$content .= '<li class="header">TOOLS</li>';
		$content .= '<li><a href="?page=onesignal-sender"><i class="fa fa-send"></i> <span>OneSignal Sender</span></a></li>';
		$content .= '<li class="header">USERS</li>';
		$content .= '<li><a href="?page=profile"><i class="fa fa-user"></i> <span>Your Profile</span></a></li>';
		$content .= '</ul>';
		$content .= '</section>';
		$content .= '</aside>';
		$content .= '<div class="content-wrapper">';
		switch($_GET["action"]){
			case "list":
				// TODO: PAGE - BOOKS - LIST
				/** breadcrumb **/
				$content .= '<section class="content-header">';
				$content .= '<h1>Books<small>List of books</small></h1>';
				$content .= '<ol class="breadcrumb">';
				$content .= '<li><a href="?"><i class="fa fa-dashboard"></i> Home</a></li>';
				$content .= '<li><a href="?page=chapters&amp;action=list">Books</a></li>';
				$content .= '<li class="active">List</li>';
				$content .= '</ol>';
				$content .= '</section>';
				/** content **/
				$content .= '<section class="content">';
				$content .= $notification;
				$content .= '<div class="box box-danger">';
				$content .= '<div class="box-header with-border">';
				$content .= '<h3 class="box-title">All Books</h3>';
				$content .= '<div class="box-tools pull-right">';
				$content .= '<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>';
				$content .= '<button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>';
				$content .= '</div>';
				$content .= '</div>';
				$content .= '<div class="box-body">';
				$content .= '<div class="table-responsive">';
				$content .= '<table class="datatable table table-striped table-hover">';
				$content .= '<thead>';
				$content .= '<tr>';
				$content .= '<th>ID</th>';
				$content .= '<th>Thumbnail</th>';
				$content .= '<th>Title</th>';
				$content .= '<th>Publisher</th>';
				$content .= '<th>ISBN</th>';
				$content .= '<th>Status</th>';
				$content .= '<th style="width:100px;">#</th>';
				$content .= '</tr>';
				$content .= '</thead>';
				$content .= '<tbody>';
				/** fetch data from mysql **/
				$sql_query = "SELECT * FROM `books` ORDER BY `book_id` DESC" ;
				if($result = $mysql->query($sql_query)){
					while ($data = $result->fetch_array()){
						$content .= '<tr>';
						
						/** book_id **/
						$content .= '<td>' . (int)$data["book_id"] . '</td>';
						
						/** book_thumbnail **/
						if($data["book_thumbnail"] ==""){
							$data["book_thumbnail"] ="https://placehold.it/80x80";
						}
						$content .= '<td><img class="img-thumbnail" width="80" height="80" src="' . htmlentities(stripslashes(strip_tags($data["book_thumbnail"]))) . '" class="img-thumbnail" alt="..."/></td>';
						
						/** book_cover **/
						
						/** book_title **/
						$content .= '<td>' . htmlentities(stripslashes(substr(strip_tags($data["book_title"]),0,64))) . '</td>';
						
						/** book_title_alt **/
						
						/** book_genre **/
						
						/** book_author **/
						
						/** book_publisher **/
						$content .= '<td>' . htmlentities(stripslashes(substr(strip_tags($data["book_publisher"]),0,64))) . '</td>';
						
						/** book_isbn **/
						$content .= '<td>' . htmlentities(stripslashes(substr(strip_tags($data["book_isbn"]),0,64))) . '</td>';
						
						/** book_released **/
						
						/** book_status **/
						$content .= '<td><span class="label label-default">' . htmlentities(stripslashes($data["book_status"])) . '</span></td>';
						
						/** book_synopsis **/
						$content .= '<td>';
						$content .= '<a href="?page=books&amp;action=edit&amp;id='.$data["book_id"].'" class="btn btn-success btn-flat btn-sm"><i class="fa fa-edit"></i></a>';
						$content .= '<a class="btn btn-danger btn-flat btn-sm" href="#" onClick="doModal(\'Delete Book\',\'<div class=\\\'row\\\'><div class=\\\'col-md-3 text-center text-primary\\\'><i class=\\\'fa fa-5x fa-book\\\'></i></div><div class=\\\'col-md-9\\\'>You are about to permanently delete these items from your site. <br/>This action cannot be undo, `Cancel` to stop, `OK` to delete.</div></div>\',\'Ok\',\'danger\',\'window.location=\\\'?page=books&amp;action=delete&amp;id='.$data["book_id"].'\\\'\');"><i class="fa fa-trash"></i></a>';
						$content .= '</td>';
						$content .= '</tr>';
					}
				}
				$content .= '</tbody>';
				$content .= '</table>';
				$content .= '</div>';
				$content .= '</div>';
				$content .= '</div>';
				$content .= '</section>';
				break;
			case "edit":
				// TODO: PAGE - BOOKS - EDIT
				if(isset($_GET["id"])){
					$entry_id= (int)$_GET["id"];
					/** fetch current data **/
					$sql_query = "SELECT * FROM `books` WHERE `book_id`=$entry_id LIMIT 0,1" ;
					$result = $mysql->query($sql_query);
					$rowdata = $result->fetch_array();
					if(isset($rowdata["book_id"])){
						/** default value **/
						$postdata["book-thumbnail"] = "" ;
						$postdata["book-cover"] = "" ;
						$postdata["book-title"] = "" ;
						$postdata["book-title-alt"] = "" ;
						$postdata["book-genre"] = "" ;
						$postdata["book-author"] = "" ;
						$postdata["book-publisher"] = "" ;
						$postdata["book-isbn"] = "" ;
						$postdata["book-released"] = "" ;
						$postdata["book-status"] = "Ongoing" ;
						$postdata["book-synopsis"] = "" ;
						/** response postdata **/
						if(isset($_POST["submit"])){
							if(isset($_POST["postdata"]["book-thumbnail"])){
								$postdata["book-thumbnail"] = addslashes($_POST["postdata"]["book-thumbnail"]);
							}
							if(isset($_POST["postdata"]["book-cover"])){
								$postdata["book-cover"] = addslashes($_POST["postdata"]["book-cover"]);
							}
							if(isset($_POST["postdata"]["book-title"])){
								$postdata["book-title"] = addslashes($_POST["postdata"]["book-title"]);
							}
							if(isset($_POST["postdata"]["book-title-alt"])){
								$postdata["book-title-alt"] = addslashes($_POST["postdata"]["book-title-alt"]);
							}
							if(isset($_POST["postdata"]["book-genre"])){
								$data_array = array() ;
								$data_arrs = explode(",",$_POST["postdata"]["book-genre"]);
								foreach($data_arrs as $data_arr){
									if(trim($data_arr)!=""){
										$data_array[] = trim($data_arr) ;
									}
								}
								$postdata["book-genre"] = json_encode($data_array);
							}else{
								$postdata["book-genre"] = "[]";
							}
							if(isset($_POST["postdata"]["book-author"])){
								$postdata["book-author"] = addslashes($_POST["postdata"]["book-author"]);
							}
							if(isset($_POST["postdata"]["book-publisher"])){
								$postdata["book-publisher"] = addslashes($_POST["postdata"]["book-publisher"]);
							}
							if(isset($_POST["postdata"]["book-isbn"])){
								$postdata["book-isbn"] = addslashes($_POST["postdata"]["book-isbn"]);
							}
							if(isset($_POST["postdata"]["book-released"])){
								$postdata["book-released"] = addslashes($_POST["postdata"]["book-released"]);
							}
							if(isset($_POST["postdata"]["book-status"])){
								$postdata["book-status"] = addslashes($_POST["postdata"]["book-status"]);
							}
							if(isset($_POST["postdata"]["book-synopsis"])){
								$postdata["book-synopsis"] = addslashes($_POST["postdata"]["book-synopsis"]);
							}
							$sql_query = "UPDATE `books` SET `book_thumbnail` = '{$postdata["book-thumbnail"]}' ,`book_cover` = '{$postdata["book-cover"]}' ,`book_title` = '{$postdata["book-title"]}' ,`book_title_alt` = '{$postdata["book-title-alt"]}' ,`book_genre` = '{$postdata["book-genre"]}' ,`book_author` = '{$postdata["book-author"]}' ,`book_publisher` = '{$postdata["book-publisher"]}' ,`book_isbn` = '{$postdata["book-isbn"]}' ,`book_released` = '{$postdata["book-released"]}' ,`book_status` = '{$postdata["book-status"]}' ,`book_synopsis` = '{$postdata["book-synopsis"]}'  WHERE `book_id`=$entry_id" ;
							$stmt = $mysql->prepare($sql_query);
							$stmt->execute();
							$stmt->close();
							header("Location: ?page=books&action=edit&id=".$entry_id."&notice=success-edit");
						}
						/** init variable field **/
						$postdata["book-thumbnail"] = '';
						if(isset($rowdata["book_thumbnail"])){
							$postdata["book-thumbnail"] = stripslashes($rowdata["book_thumbnail"]);
						}
						$postdata["book-cover"] = '';
						if(isset($rowdata["book_cover"])){
							$postdata["book-cover"] = stripslashes($rowdata["book_cover"]);
						}
						$postdata["book-title"] = '';
						if(isset($rowdata["book_title"])){
							$postdata["book-title"] = stripslashes($rowdata["book_title"]);
						}
						$postdata["book-title-alt"] = '';
						if(isset($rowdata["book_title_alt"])){
							$postdata["book-title-alt"] = stripslashes($rowdata["book_title_alt"]);
						}
						$postdata["book-genre"] = '';
						if(isset($rowdata["book_genre"])){
							$postdata["book-genre"] = stripslashes($rowdata["book_genre"]);
						}
						$postdata["book-author"] = '';
						if(isset($rowdata["book_author"])){
							$postdata["book-author"] = stripslashes($rowdata["book_author"]);
						}
						$postdata["book-publisher"] = '';
						if(isset($rowdata["book_publisher"])){
							$postdata["book-publisher"] = stripslashes($rowdata["book_publisher"]);
						}
						$postdata["book-isbn"] = '';
						if(isset($rowdata["book_isbn"])){
							$postdata["book-isbn"] = stripslashes($rowdata["book_isbn"]);
						}
						$postdata["book-released"] = '';
						if(isset($rowdata["book_released"])){
							$postdata["book-released"] = stripslashes($rowdata["book_released"]);
						}
						$postdata["book-status"] = 'Ongoing';
						if(isset($rowdata["book_status"])){
							$postdata["book-status"] = stripslashes($rowdata["book_status"]);
						}
						$postdata["book-synopsis"] = '';
						if(isset($rowdata["book_synopsis"])){
							$postdata["book-synopsis"] = stripslashes($rowdata["book_synopsis"]);
						}
						/** breadcrumb **/
						$content .= '<section class="content-header">';
						$content .= '<h1>Books <small>List of books</small></h1>';
						$content .= '<ol class="breadcrumb">';
						$content .= '<li><a href="?"><i class="fa fa-dashboard"></i> Home</a></li>';
						$content .= '<li><a href="?">Books</a></li>';
						$content .= '<li class="active">Edit</li>';
						$content .= '</ol>';
						$content .= '</section>';
						/** content **/
						$content .= '<section class="content">';
						$content .= $notification;
						$content .= '<form action="" method="post">';
						$content .= '<div class="box box-primary">';
						$content .= '<div class="box-header with-border">';
						$content .= '<h3 class="box-title">Edit Book</h3>';
						$content .= '<div class="box-tools pull-right">';
						$content .= '<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>';
						$content .= '<button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>';
						$content .= '</div>';
						$content .= '</div>';
						$content .= '<div class="box-body">';
						$content .= '<div class="row">';
						/** field book_id:id **/
						/** field book_thumbnail:thumbnail **/
						$content .= '<div class="col-md-6">';
						$content .= '<div class="form-group">';
						$content .= '<label>Thumbnail</label>';
						$content .= '<div class="input-group">';
						$content .= '<input name="postdata[book-thumbnail]" id="postdata-book-thumbnail" type="text" class="form-control" placeholder="" value="'.htmlentities(stripslashes($postdata['book-thumbnail'])).'" />';
						$content .= '<span class="input-group-btn">';
						$content .= '<button type="button" data-type="file-picker" class="btn btn-default btn-flat" data-target="#postdata-book-thumbnail">';
						$content .= '<i class="fa fa-folder-open"></i>';
						$content .= '</button>';
						$content .= '<a class="btn btn-default btn-flat" target="_blank" href="'.htmlentities(stripslashes($postdata['book-thumbnail'])).'" ><i class="fa fa-eye"></i></a>';
						$content .= '</span>';
						$content .= '</div>';
						$content .= '<p class="help-block">Upload thumbnail for ebook</p>';
						$content .= '</div>';
						$content .= '</div>';
						/** field book_cover:image **/
						$content .= '<div class="col-md-6">';
						$content .= '<div class="form-group">';
						$content .= '<label>Cover</label>';
						$content .= '<div class="input-group">';
						$content .= '<input name="postdata[book-cover]" id="postdata-book-cover" type="text" class="form-control" placeholder="" value="'.htmlentities(stripslashes($postdata['book-cover'])).'" />';
						$content .= '<span class="input-group-btn">';
						$content .= '<button type="button" data-type="file-picker" class="btn btn-default btn-flat" data-target="#postdata-book-cover">';
						$content .= '<i class="fa fa-folder-open"></i></button>';
						$content .= '<a class="btn btn-default btn-flat" target="_blank" href="'.htmlentities(stripslashes($postdata['book-cover'])).'" ><i class="fa fa-eye"></i></a>';
						$content .= '</span>';
						$content .= '</div>';
						$content .= '<p class="help-block">Upload cover for ebook</p>';
						$content .= '</div>';
						$content .= '</div>';
						/** field book_title:varchar **/
						$content .= '<div class="col-md-6">';
						$content .= '<div class="form-group">';
						$content .= '<label>Title</label>';
						$content .= '<input maxlength="128" name="postdata[book-title]" id="postdata-book-title" type="text" class="form-control" placeholder="Interdum Sed Duis" value="'.htmlentities(stripslashes($postdata['book-title'])).'" />';
						$content .= '<p class="help-block">Write the title of the book</p>';
						$content .= '</div>';
						$content .= '</div>';
						/** field book_title_alt:varchar **/
						$content .= '<div class="col-md-6">';
						$content .= '<div class="form-group">';
						$content .= '<label>Alternative Title</label>';
						$content .= '<input maxlength="128" name="postdata[book-title-alt]" id="postdata-book-title-alt" type="text" class="form-control" placeholder="Interdum Sed Duis" value="'.htmlentities(stripslashes($postdata['book-title-alt'])).'" />';
						$content .= '<p class="help-block">Write the alternative title of the book</p>';
						$content .= '</div>';
						$content .= '</div>';
						/** field book_genre:multi-text **/
						$data_book_genre_array = json_decode($postdata['book-genre'],true) ;
						$data_book_genre =  "";
						if(is_array($data_book_genre_array)){
							$data_book_genre =  implode(", ",$data_book_genre_array);
						}
						$content .= '<div class="col-md-6">';
						$content .= '<div class="form-group" >';
						$content .= '<label>Genre</label>';
						$content .= '<input data-type="tags" name="postdata[book-genre]" id="postdata-book-genre" type="text" class="form-control" placeholder="" value="'.htmlentities(stripslashes($data_book_genre)).'" />';
						$content .= '<p class="help-block"></p>';
						$content .= '</div>';
						$content .= '</div>';
						/** field book_author:varchar **/
						$content .= '<div class="col-md-6">';
						$content .= '<div class="form-group">';
						$content .= '<label>Author</label>';
						$content .= '<input maxlength="128" name="postdata[book-author]" id="postdata-book-author" type="text" class="form-control" placeholder="Feugiat" value="'.htmlentities(stripslashes($postdata['book-author'])).'" />';
						$content .= '<p class="help-block">Write the author of the book</p>';
						$content .= '</div>';
						$content .= '</div>';
						/** field book_publisher:varchar **/
						$content .= '<div class="col-md-6">';
						$content .= '<div class="form-group">';
						$content .= '<label>Publisher</label>';
						$content .= '<input maxlength="128" name="postdata[book-publisher]" id="postdata-book-publisher" type="text" class="form-control" placeholder="Imperdiet" value="'.htmlentities(stripslashes($postdata['book-publisher'])).'" />';
						$content .= '<p class="help-block">Write the publisher of the book</p>';
						$content .= '</div>';
						$content .= '</div>';
						/** field book_isbn:varchar **/
						$content .= '<div class="col-md-6">';
						$content .= '<div class="form-group">';
						$content .= '<label>ISBN</label>';
						$content .= '<input maxlength="128" name="postdata[book-isbn]" id="postdata-book-isbn" type="text" class="form-control" placeholder="Interdum Sed Duis" value="'.htmlentities(stripslashes($postdata['book-isbn'])).'" />';
						$content .= '<p class="help-block">Write the ISBN of the book</p>';
						$content .= '</div>';
						$content .= '</div>';
						/** field book_released:date **/
						$content .= '<div class="col-md-6">';
						$content .= '<div class="form-group">';
						$content .= '<label>Date Released</label>';
						$content .= '<div class="input-group date">';
						$content .= '<div class="input-group-addon"><i class="fa fa-calendar"></i></div>';
						$content .= '<input name="postdata[book-released]" id="postdata-book-released" type="text" class="form-control" placeholder="'.date("Y-m-d").'" value="'.htmlentities(stripslashes($postdata['book-released'])).'" data-type="date" />';
						$content .= '</div>';
						$content .= '<p class="help-block">Write the date released of the book</p>';
						$content .= '</div>';
						$content .= '</div>';
						/** field book_status:select **/
						$options = array();
						$options["book_status"][] = array("val"=>"Ongoing","label"=>"Ongoing");
						$options["book_status"][] = array("val"=>"End","label"=>"End");
						$options["book_status"][] = array("val"=>"Drop","label"=>"Drop");
						$options["book_status"][] = array("val"=>"Hiatus","label"=>"Hiatus");
						$content .= '<div class="col-md-6">';
						$content .= '<div class="form-group">';
						$content .= '<label>Status</label>';
						$content .= '<select class="form-control" name="postdata[book-status]" id="postdata-book-status">';
						foreach($options["book_status"] as $option) {
							$selected ="";
							if($option["val"] == $postdata['book-status'] ){
								$selected ="selected";
							}
							$content .= '<option value="'.htmlentities($option["val"]).'" '.$selected.'>'.htmlentities($option["label"]).'</option>';
						}
						$content .= '</select>';
						$content .= '<p class="help-block">Write the status of the book</p>';
						$content .= '</div>';
						$content .= '</div>';
						/** field book_synopsis:text **/
						$content .= '<div class="col-md-12">';
						$content .= '<div class="form-group">';
						$content .= '<label>Synopsis</label>';
						$content .= '<textarea name="postdata[book-synopsis]" id="postdata-book-synopsis" class="form-control" >'.htmlentities(stripslashes($postdata['book-synopsis'])).'</textarea>';
						$content .= '<p class="help-block">Write the synopsis of the book</p>';
						$content .= '</div>';
						$content .= '</div>';
						$content .= '</div>';
						$content .= '</div>';
						$content .= '<div class="box-footer">';
						$content .= '<button type="submit" class="btn btn-flat btn-primary" name="submit"><i class="fa fa-floppy-o"></i> Update</button>';
						$content .= '</div>';
						$content .= '</div>';
						$content .= '</form>';
						$content .= '</section>';
					}else{
						header("Location: ?page=books&notice=wrong-id");
					}
				}else{
					header("Location: ?page=books&notice=wrong-id");
				}
				break;
			case "add":
				// TODO: PAGE - BOOKS - ADD
				/** default value **/
				$postdata["book-thumbnail"] = "" ;
				$postdata["book-cover"] = "" ;
				$postdata["book-title"] = "" ;
				$postdata["book-title-alt"] = "" ;
				$postdata["book-genre"] = "" ;
				$postdata["book-author"] = "" ;
				$postdata["book-publisher"] = "" ;
				$postdata["book-isbn"] = "" ;
				$postdata["book-released"] = "" ;
				$postdata["book-status"] = "Ongoing" ;
				$postdata["book-synopsis"] = "" ;
				/** response postdata **/
				if(isset($_POST["submit"])){
					if(isset($_POST["postdata"]["book-thumbnail"])){
						$postdata["book-thumbnail"] = addslashes($_POST["postdata"]["book-thumbnail"]);
					}
					if(isset($_POST["postdata"]["book-cover"])){
						$postdata["book-cover"] = addslashes($_POST["postdata"]["book-cover"]);
					}
					if(isset($_POST["postdata"]["book-title"])){
						$postdata["book-title"] = addslashes($_POST["postdata"]["book-title"]);
					}
					if(isset($_POST["postdata"]["book-title-alt"])){
						$postdata["book-title-alt"] = addslashes($_POST["postdata"]["book-title-alt"]);
					}
					if(isset($_POST["postdata"]["book-genre"])){
						$data_array = array() ;
						$data_arrs = explode(",",$_POST["postdata"]["book-genre"]);
						foreach($data_arrs as $data_arr){
							if(trim($data_arr)!=""){
								$data_array[] = trim($data_arr) ;
							}
						}
						$postdata["book-genre"] = json_encode($data_array);
					}else{
						$postdata["book-genre"] = "[]";
					}
					if(isset($_POST["postdata"]["book-author"])){
						$postdata["book-author"] = addslashes($_POST["postdata"]["book-author"]);
					}
					if(isset($_POST["postdata"]["book-publisher"])){
						$postdata["book-publisher"] = addslashes($_POST["postdata"]["book-publisher"]);
					}
					if(isset($_POST["postdata"]["book-isbn"])){
						$postdata["book-isbn"] = addslashes($_POST["postdata"]["book-isbn"]);
					}
					if(isset($_POST["postdata"]["book-released"])){
						$postdata["book-released"] = addslashes($_POST["postdata"]["book-released"]);
					}
					if(isset($_POST["postdata"]["book-status"])){
						$postdata["book-status"] = addslashes($_POST["postdata"]["book-status"]);
					}
					if(isset($_POST["postdata"]["book-synopsis"])){
						$postdata["book-synopsis"] = addslashes($_POST["postdata"]["book-synopsis"]);
					}
					$sql_query = "INSERT INTO `books` (`book_thumbnail`,`book_cover`,`book_title`,`book_title_alt`,`book_genre`,`book_author`,`book_publisher`,`book_isbn`,`book_released`,`book_status`,`book_synopsis`) VALUES ('{$postdata['book-thumbnail']}','{$postdata['book-cover']}','{$postdata['book-title']}','{$postdata['book-title-alt']}','{$postdata['book-genre']}','{$postdata['book-author']}','{$postdata['book-publisher']}','{$postdata['book-isbn']}','{$postdata['book-released']}','{$postdata['book-status']}','{$postdata['book-synopsis']}')" ;
					$mysql->query($sql_query);
					$last_id = $mysql->insert_id;
					header("Location: ?page=books&notice=success-add&action=edit&id=".$last_id);
				}
				/** breadcrumb **/
				$content .= '<section class="content-header">';
				$content .= '<h1>Books <small>List of books</small></h1>';
				$content .= '<ol class="breadcrumb">';
				$content .= '<li><a href="?"><i class="fa fa-dashboard"></i> Home</a></li>';
				$content .= '<li><a href="?">Books</a></li>';
				$content .= '<li class="active">Add</li>';
				$content .= '</ol>';
				$content .= '</section>';
				/** content **/
				$content .= '<section class="content">';
				$content .= $notification;
				$content .= '<form action="" method="post">';
				$content .= '<div class="box box-success">';
				$content .= '<div class="box-header with-border">';
				$content .= '<h3 class="box-title">Add new Book</h3>';
				$content .= '<div class="box-tools pull-right">';
				$content .= '<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>';
				$content .= '<button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>';
				$content .= '</div>';
				$content .= '</div>';
				$content .= '<div class="box-body">';
				$content .= '<div class="row">';
				/** field book_id:id **/
				/** field book_thumbnail:thumbnail **/
				$content .= '<div class="col-md-6">';
				$content .= '<div class="form-group">';
				$content .= '<label>Thumbnail</label>';
				$content .= '<div class="input-group">';
				$content .= '<input name="postdata[book-thumbnail]" id="postdata-book-thumbnail" type="text" class="form-control" placeholder="" value="'.htmlentities(stripslashes($postdata['book-thumbnail'])).'" />';
				$content .= '<span class="input-group-btn">';
				$content .= '<button type="button" data-type="file-picker" class="btn btn-primary btn-flat" data-target="#postdata-book-thumbnail">';
				$content .= '<i class="fa fa-folder-open"></i>';
				$content .= '</button>';
				$content .= '</span>';
				$content .= '</div>';
				$content .= '<p class="help-block">Upload thumbnail for ebook</p>';
				$content .= '</div>';
				$content .= '</div>';
				/** field book_cover:image **/
				$content .= '<div class="col-md-6">';
				$content .= '<div class="form-group">';
				$content .= '<label>Cover</label>';
				$content .= '<div class="input-group">';
				$content .= '<input name="postdata[book-cover]" id="postdata-book-cover" type="text" class="form-control" placeholder="" value="'.htmlentities(stripslashes($postdata['book-cover'])).'" />';
				$content .= '<span class="input-group-btn">';
				$content .= '<button type="button" data-type="file-picker" class="btn btn-primary btn-flat" data-target="#postdata-book-cover">';
				$content .= '<i class="fa fa-folder-open"></i>';
				$content .= '</button>';
				$content .= '</span>';
				$content .= '</div>';
				$content .= '<p class="help-block">Upload cover for ebook</p>';
				$content .= '</div>';
				$content .= '</div>';
				/** field book_title:varchar **/
				$content .= '<div class="col-md-6">';
				$content .= '<div class="form-group">';
				$content .= '<label>Title</label>';
				$content .= '<input maxlength="128" name="postdata[book-title]" id="postdata-book-title" type="text" class="form-control" placeholder="Interdum Sed Duis" value="'.htmlentities(stripslashes($postdata['book-title'])).'" />';
				$content .= '<p class="help-block">Write the title of the book</p>';
				$content .= '</div>';
				$content .= '</div>';
				/** field book_title_alt:varchar **/
				$content .= '<div class="col-md-6">';
				$content .= '<div class="form-group">';
				$content .= '<label>Alternative Title</label>';
				$content .= '<input maxlength="128" name="postdata[book-title-alt]" id="postdata-book-title-alt" type="text" class="form-control" placeholder="Interdum Sed Duis" value="'.htmlentities(stripslashes($postdata['book-title-alt'])).'" />';
				$content .= '<p class="help-block">Write the alternative title of the book</p>';
				$content .= '</div>';
				$content .= '</div>';
				/** field book_genre:multi-text **/
				$content .= '<div class="col-md-6">';
				$content .= '<div class="form-group" >';
				$content .= '<label>Genre</label>';
				$content .= '<input data-type="tags" name="postdata[book-genre]" id="postdata-book-genre" type="text" class="form-control" placeholder="" value="'.htmlentities(stripslashes($postdata['book-genre'])).'" />';
				$content .= '<p class="help-block"></p>';
				$content .= '</div>';
				$content .= '</div>';
				/** field book_author:varchar **/
				$content .= '<div class="col-md-6">';
				$content .= '<div class="form-group">';
				$content .= '<label>Author</label>';
				$content .= '<input maxlength="128" name="postdata[book-author]" id="postdata-book-author" type="text" class="form-control" placeholder="Feugiat" value="'.htmlentities(stripslashes($postdata['book-author'])).'" />';
				$content .= '<p class="help-block">Write the author of the book</p>';
				$content .= '</div>';
				$content .= '</div>';
				/** field book_publisher:varchar **/
				$content .= '<div class="col-md-6">';
				$content .= '<div class="form-group">';
				$content .= '<label>Publisher</label>';
				$content .= '<input maxlength="128" name="postdata[book-publisher]" id="postdata-book-publisher" type="text" class="form-control" placeholder="Imperdiet" value="'.htmlentities(stripslashes($postdata['book-publisher'])).'" />';
				$content .= '<p class="help-block">Write the publisher of the book</p>';
				$content .= '</div>';
				$content .= '</div>';
				/** field book_isbn:varchar **/
				$content .= '<div class="col-md-6">';
				$content .= '<div class="form-group">';
				$content .= '<label>ISBN</label>';
				$content .= '<input maxlength="128" name="postdata[book-isbn]" id="postdata-book-isbn" type="text" class="form-control" placeholder="Interdum Sed Duis" value="'.htmlentities(stripslashes($postdata['book-isbn'])).'" />';
				$content .= '<p class="help-block">Write the ISBN of the book</p>';
				$content .= '</div>';
				$content .= '</div>';
				/** field book_released:date **/
				$content .= '<div class="col-md-6">';
				$content .= '<div class="form-group">';
				$content .= '<label>Date Released</label>';
				$content .= '<div class="input-group date">';
				$content .= '<div class="input-group-addon"><i class="fa fa-calendar"></i></div>';
				$content .= '<input name="postdata[book-released]" id="postdata-book-released" type="text" class="form-control" placeholder="'.date("Y-m-d").'" value="'.htmlentities(stripslashes($postdata['book-released'])).'" data-type="date" />';
				$content .= '</div>';
				$content .= '<p class="help-block">Write the date released of the book</p>';
				$content .= '</div>';
				$content .= '</div>';
				/** field book_status:select **/
				$options = array();
				$options["book_status"][] = array("val"=>"Ongoing","label"=>"Ongoing");
				$options["book_status"][] = array("val"=>"End","label"=>"End");
				$options["book_status"][] = array("val"=>"Drop","label"=>"Drop");
				$options["book_status"][] = array("val"=>"Hiatus","label"=>"Hiatus");
				$content .= '<div class="col-md-6">';
				$content .= '<div class="form-group">';
				$content .= '<label>Status</label>';
				$content .= '<select class="form-control" name="postdata[book-status]" id="postdata-book-status">';
				foreach($options["book_status"] as $option) {
					$selected ="";
					if($option["val"] == $postdata['book-status'] ){
						$selected ="selected";
					}
					$content .= '<option value="'.htmlentities($option["val"]).'" '.$selected.'>'.htmlentities($option["label"]).'</option>';
				}
				$content .= '</select>';
				$content .= '<p class="help-block">Write the status of the book</p>';
				$content .= '</div>';
				$content .= '</div>';
				/** field book_synopsis:text **/
				$content .= '<div class="col-md-12">';
				$content .= '<div class="form-group">';
				$content .= '<label>Synopsis</label>';
				$content .= '<textarea name="postdata[book-synopsis]" id="postdata-book-synopsis" class="form-control" >'.htmlentities(stripslashes($postdata['book-synopsis'])).'</textarea>';
				$content .= '<p class="help-block">Write the synopsis of the book</p>';
				$content .= '</div>';
				$content .= '</div>';
				$content .= '</div>';
				$content .= '</div>';
				$content .= '<div class="box-footer">';
				$content .= '<button type="submit" class="btn btn-flat btn-success" name="submit"><i class="fa fa-plus"></i> Add new Book</button>';
				$content .= '</div>';
				$content .= '</div>';
				$content .= '</form>';
				$content .= '</section>';
				break;
			case "delete":
				// TODO: PAGE - BOOKS - DELETE
				if(isset($_GET["id"])){
					$entry_id= (int)$_GET["id"];
					/** fetch current data **/
					$sql_query = "SELECT * FROM `books` WHERE `book_id`=$entry_id LIMIT 0,1" ;
					$result = $mysql->query($sql_query);
					$rowdata = $result->fetch_array();
					if(isset($rowdata["book_id"])){
						$sql_query = "DELETE FROM `books` WHERE `book_id`=$entry_id";
						$stmt = $mysql->prepare($sql_query);
						$stmt->execute();
						$stmt->close();
						header("Location: ?page=books&notice=success-delete");
					}else{
						header("Location: ?page=books&notice=wrong-id");
					}
				}
				break;
			}
			$content .= '</div>';
			$content .= '<footer class="main-footer">';
			$content .= '<div class="pull-right hidden-xs">';
			$content .= '<b>Version</b> 01.01.01';
			$content .= '</div>';
			$content .= '<strong>Copyright &copy; '.date("Y").' <a href="https://godigitally.co.in">Go Digitally</a>.</strong> All rights reserved.';
			$content .= '</footer>';
			$content .= '</div>';
			break;
	// TODO: PAGE - CHAPTERS
	case "chapters":
		$notification = null;
		if(isset($_GET["notice"])){
			switch($_GET["notice"]){
				case "success-delete":
					$notification .= '<div id="notification" class="alert alert-success">';
					$notification .= '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
					$notification .= 'You have successfully deleted the item of the <strong>Chapters data</strong>';
					$notification .= '</div>';
					break;
				case "success-edit":
					$notification .= '<div id="notification" class="alert alert-success">';
					$notification .= '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
					$notification .= 'You have successfully update the item of the <strong>Chapters data</strong>';
					$notification .= '</div>';
					break;
				case "success-add":
					$notification .= '<div id="notification" class="alert alert-success">';
					$notification .= '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
					$notification .= 'You have successfully add new item to the <strong>Chapters data</strong>';
					$notification .= '</div>';
					break;
				case "wrong-id":
					$notification .= '<div id="notification" class="alert alert-danger">';
					$notification .= '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
					$notification .= 'You did not find ID of this item in <strong>Chapters</strong>';
					$notification .= '</div>';
					break;
			}
		}
		if($_SESSION["IS_LOGIN"]==false){
			header("Location: ?page=login");
		}
		$page_title = "Chapters";
		$body_class = "hold-transition skin-".$config["color"]." sidebar-mini";
		$current_user = $_SESSION["CURRENT_USER"];
		$content = null;
		$content .= '<div class="wrapper">';
		$content .= '<header class="main-header">';
		$content .= '<a href="?" class="logo">';
		$content .= '<span class="logo-mini"><b>PN</b>L</span>';
		$content .= '<span class="logo-lg"><b>'.$app_name.'</b> Panel</span>';
		$content .= '</a>';
		$content .= '<nav class="navbar navbar-static-top">';
		$content .= '<a href="?" class="sidebar-toggle" data-toggle="push-menu" role="button">';
		$content .= '<span class="sr-only">Toggle navigation</span>';
		$content .= '<span class="icon-bar"></span>';
		$content .= '<span class="icon-bar"></span>';
		$content .= '<span class="icon-bar"></span>';
		$content .= '</a>';
		$content .= '<div class="navbar-custom-menu">';
		$content .= '<ul class="nav navbar-nav">';
		$content .= '<li class="dropdown user user-menu">';
		$content .= '<a href="?" class="dropdown-toggle" data-toggle="dropdown">';
		$content .= '<img src="https://www.gravatar.com/avatar/' . md5(strtolower(trim($current_user['user_email']))).'" class="user-image" alt="User Image">';
		$content .= '<span class="hidden-xs">' . htmlentities(stripslashes($current_user['user_name'])).'</span>';
		$content .= '</a>';
		$content .= '<ul class="dropdown-menu">';
		$content .= '<li class="user-header">';
		$content .= '<img src="https://www.gravatar.com/avatar/' . md5(strtolower(trim($current_user['user_email']))).'" class="img-circle" alt="User Image">';
		$content .= '<p>';
		$content .= '' . htmlentities(stripslashes($current_user['user_name'])).'';
		$content .= '<small>' . htmlentities(stripslashes($current_user['user_level'])).'</small>';
		$content .= '</p>';
		$content .= '</li>';
		$content .= '<li class="user-footer">';
		$content .= '<div class="pull-left">';
		$content .= '<a href="?page=profile" class="btn btn-default btn-flat">Profile</a>';
		$content .= '</div>';
		$content .= '<div class="pull-right">';
		$content .= '<a href="?page=logout" class="btn btn-default btn-flat">Sign out</a>';
		$content .= '</div>';
		$content .= '</li>';
		$content .= '</ul>';
		$content .= '<li>';
		$content .= '</ul>';
		$content .= '</div>';
		$content .= '</nav>';
		$content .= '</header>';
		$content .= '<aside class="main-sidebar">';
		$content .= '<section class="sidebar">';
		$content .= '<div class="user-panel">';
		$content .= '<div class="pull-left image">';
		$content .= '<img src="https://www.gravatar.com/avatar/' . md5(strtolower(trim($current_user['user_email']))).'" class="img-circle" alt="'.htmlentities(stripslashes($current_user['user_name'])).'">';
		$content .= '</div>';
		$content .= '<div class="pull-left info">';
		$content .= '<p>'.htmlentities(stripslashes($current_user['user_name'])).'</p>';
		$content .= '<a href="?"><i class="fa fa-circle text-success"></i> '.htmlentities(stripslashes($current_user['user_level'])).'</a>';
		$content .= '</div>';
		$content .= '</div>';
		$content .= '<ul class="sidebar-menu" data-widget="tree">';
		$content .= '<li class="header">DATA MANAGER</li>';
		$content .= '<li class="treeview ">';
		$content .= '<a href="?">';
		$content .= '<i class="fa fa-book"></i> <span>Books</span>';
		$content .= '<span class="pull-right-container">';
		$content .= '<i class="fa fa-angle-left pull-right"></i>';
		$content .= '</span>';
		$content .= '</a>';
		$content .= '<ul class="treeview-menu">';
		$content .= '<li><a href="?page=books&amp;action=add"><i class="fa fa-plus"></i> Add New</a></li>';
		$content .= '<li><a href="?page=books&amp;action=list"><i class="fa fa-list-ul"></i> All Books</a></li>';
		$content .= '</ul>';
		$content .= '</li>';
		$content .= '<li class="treeview active">';
		$content .= '<a href="?">';
		$content .= '<i class="fa fa-book"></i> <span>Chapters</span>';
		$content .= '<span class="pull-right-container">';
		$content .= '<i class="fa fa-angle-left pull-right"></i>';
		$content .= '</span>';
		$content .= '</a>';
		$content .= '<ul class="treeview-menu">';
		$content .= '<li><a href="?page=chapters&amp;action=add"><i class="fa fa-plus"></i> Add New</a></li>';
		$content .= '<li><a href="?page=chapters&amp;action=list"><i class="fa fa-list-ul"></i> All Chapters</a></li>';
		$content .= '</ul>';
		$content .= '</li>';
		$content .= '<li class="header">TOOLS</li>';
		$content .= '<li><a href="?page=onesignal-sender"><i class="fa fa-send"></i> <span>OneSignal Sender</span></a></li>';
		$content .= '<li class="header">USERS</li>';
		$content .= '<li><a href="?page=profile"><i class="fa fa-user"></i> <span>Your Profile</span></a></li>';
		$content .= '</ul>';
		$content .= '</section>';
		$content .= '</aside>';
		$content .= '<div class="content-wrapper">';
		switch($_GET["action"]){
			case "list":
				// TODO: PAGE - CHAPTERS - LIST
				/** breadcrumb **/
				$content .= '<section class="content-header">';
				$content .= '<h1>Chapters<small>List of chapter</small></h1>';
				$content .= '<ol class="breadcrumb">';
				$content .= '<li><a href="?"><i class="fa fa-dashboard"></i> Home</a></li>';
				$content .= '<li><a href="?page=chapters&amp;action=list">Chapters</a></li>';
				$content .= '<li class="active">List</li>';
				$content .= '</ol>';
				$content .= '</section>';
				/** content **/
				$content .= '<section class="content">';
				$content .= $notification;
				$content .= '<div class="box box-danger">';
				$content .= '<div class="box-header with-border">';
				$content .= '<h3 class="box-title">All Chapters</h3>';
				$content .= '<div class="box-tools pull-right">';
				$content .= '<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>';
				$content .= '<button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>';
				$content .= '</div>';
				$content .= '</div>';
				$content .= '<div class="box-body">';
				$content .= '<div class="table-responsive">';
				$content .= '<table class="datatable table table-striped table-hover">';
				$content .= '<thead>';
				$content .= '<tr>';
				$content .= '<th>ID</th>';
				$content .= '<th>Number</th>';
				$content .= '<th>Title</th>';
				$content .= '<th>Select Book</th>';
				$content .= '<th>Content</th>';
				$content .= '<th>Status</th>';
				$content .= '<th style="width:100px;">#</th>';
				$content .= '</tr>';
				$content .= '</thead>';
				$content .= '<tbody>';
				/** fetch data from mysql **/
				$sql_query = "SELECT * FROM `chapters` ORDER BY `chapter_id` DESC" ;
				if($result = $mysql->query($sql_query)){
					while ($data = $result->fetch_array()){
						$content .= '<tr>';
						
						/** chapter_id **/
						$content .= '<td>' . (int)$data["chapter_id"] . '</td>';
						
						/** chapter_number **/
						$content .= '<td><code>' . htmlentities(stripslashes(substr(strip_tags($data["chapter_number"]),0,64))) . '</code></td>';
						
						/** chapter_date **/
						
						/** chapter_title **/
						$content .= '<td>' . htmlentities(stripslashes(substr(strip_tags($data["chapter_title"]),0,64))) . '</td>';
						
						/** chapter_book **/
						$books_text = htmlentities(stripslashes($data["chapter_book"]));
						$sql_books_query = "SELECT * FROM `books` WHERE `book_id`='{$books_text}'" ;
						$books_result = $mysql->query($sql_books_query);
						if($books_result){
							$books_result_data = $books_result->fetch_array();
							if(isset($books_result_data["book_title"])){
								$content .= '<td><span class="label label-success">' . htmlentities(stripslashes($books_result_data["book_title"])) . '</span></td>';
							}else{
							$content .= '<td><span class="label label-danger">deleted</span></td>';
							}
						}else{
							$content .= '<td><span class="label label-danger">Not existing table</span></td>';
						}
						
						/** chapter_content **/
						$content .= '<td>' . htmlentities(stripslashes(substr(strip_tags($data["chapter_content"]),0,64))) . '</td>';
						
						/** chapter_status **/
						$content .= '<td><span class="label label-default">' . htmlentities(stripslashes($data["chapter_status"])) . '</span></td>';
						$content .= '<td>';
						$content .= '<a href="?page=chapters&amp;action=edit&amp;id='.$data["chapter_id"].'" class="btn btn-success btn-flat btn-sm"><i class="fa fa-edit"></i></a>';
						$content .= '<a class="btn btn-danger btn-flat btn-sm" href="#" onClick="doModal(\'Delete Chapter\',\'<div class=\\\'row\\\'><div class=\\\'col-md-3 text-center text-primary\\\'><i class=\\\'fa fa-5x fa-book\\\'></i></div><div class=\\\'col-md-9\\\'>You are about to permanently delete these items from your site. <br/>This action cannot be undo, `Cancel` to stop, `OK` to delete.</div></div>\',\'Ok\',\'danger\',\'window.location=\\\'?page=chapters&amp;action=delete&amp;id='.$data["chapter_id"].'\\\'\');"><i class="fa fa-trash"></i></a>';
						$content .= '</td>';
						$content .= '</tr>';
					}
				}
				$content .= '</tbody>';
				$content .= '</table>';
				$content .= '</div>';
				$content .= '</div>';
				$content .= '</div>';
				$content .= '</section>';
				break;
			case "edit":
				// TODO: PAGE - CHAPTERS - EDIT
				if(isset($_GET["id"])){
					$entry_id= (int)$_GET["id"];
					/** fetch current data **/
					$sql_query = "SELECT * FROM `chapters` WHERE `chapter_id`=$entry_id LIMIT 0,1" ;
					$result = $mysql->query($sql_query);
					$rowdata = $result->fetch_array();
					if(isset($rowdata["chapter_id"])){
						/** default value **/
						$postdata["chapter-number"] = "" ;
						$postdata["chapter-date"] = "" ;
						$postdata["chapter-title"] = "" ;
						$postdata["chapter-book"] = "" ;
						$postdata["chapter-content"] = "" ;
						$postdata["chapter-status"] = "draft" ;
						/** response postdata **/
						if(isset($_POST["submit"])){
							if(isset($_POST["postdata"]["chapter-number"])){
								$postdata["chapter-number"] = addslashes($_POST["postdata"]["chapter-number"]);
							}
							if(isset($_POST["postdata"]["chapter-date"])){
								$postdata["chapter-date"] = addslashes($_POST["postdata"]["chapter-date"]);
							}
							if(isset($_POST["postdata"]["chapter-title"])){
								$postdata["chapter-title"] = addslashes($_POST["postdata"]["chapter-title"]);
							}
							if(isset($_POST["postdata"]["chapter-book"])){
								$postdata["chapter-book"] = addslashes($_POST["postdata"]["chapter-book"]);
							}
							if(isset($_POST["postdata"]["chapter-content"])){
								$postdata["chapter-content"] = addslashes($_POST["postdata"]["chapter-content"]);
							}
							if(isset($_POST["postdata"]["chapter-status"])){
								$postdata["chapter-status"] = addslashes($_POST["postdata"]["chapter-status"]);
							}
							$sql_query = "UPDATE `chapters` SET `chapter_number` = '{$postdata["chapter-number"]}' ,`chapter_date` = '{$postdata["chapter-date"]}' ,`chapter_title` = '{$postdata["chapter-title"]}' ,`chapter_book` = '{$postdata["chapter-book"]}' ,`chapter_content` = '{$postdata["chapter-content"]}' ,`chapter_status` = '{$postdata["chapter-status"]}'  WHERE `chapter_id`=$entry_id" ;
							$stmt = $mysql->prepare($sql_query);
							$stmt->execute();
							$stmt->close();
							header("Location: ?page=chapters&action=edit&id=".$entry_id."&notice=success-edit");
						}
						/** init variable field **/
						$postdata["chapter-number"] = '';
						if(isset($rowdata["chapter_number"])){
							$postdata["chapter-number"] = stripslashes($rowdata["chapter_number"]);
						}
						$postdata["chapter-date"] = '';
						if(isset($rowdata["chapter_date"])){
							$postdata["chapter-date"] = stripslashes($rowdata["chapter_date"]);
						}
						$postdata["chapter-title"] = '';
						if(isset($rowdata["chapter_title"])){
							$postdata["chapter-title"] = stripslashes($rowdata["chapter_title"]);
						}
						$postdata["chapter-book"] = '';
						if(isset($rowdata["chapter_book"])){
							$postdata["chapter-book"] = stripslashes($rowdata["chapter_book"]);
						}
						$postdata["chapter-content"] = '';
						if(isset($rowdata["chapter_content"])){
							$postdata["chapter-content"] = stripslashes($rowdata["chapter_content"]);
						}
						$postdata["chapter-status"] = 'draft';
						if(isset($rowdata["chapter_status"])){
							$postdata["chapter-status"] = stripslashes($rowdata["chapter_status"]);
						}
						/** breadcrumb **/
						$content .= '<section class="content-header">';
						$content .= '<h1>Chapters <small>List of chapter</small></h1>';
						$content .= '<ol class="breadcrumb">';
						$content .= '<li><a href="?"><i class="fa fa-dashboard"></i> Home</a></li>';
						$content .= '<li><a href="?">Chapters</a></li>';
						$content .= '<li class="active">Edit</li>';
						$content .= '</ol>';
						$content .= '</section>';
						/** content **/
						$content .= '<section class="content">';
						$content .= $notification;
						$content .= '<form action="" method="post">';
						$content .= '<div class="box box-primary">';
						$content .= '<div class="box-header with-border">';
						$content .= '<h3 class="box-title">Edit Chapter</h3>';
						$content .= '<div class="box-tools pull-right">';
						$content .= '<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>';
						$content .= '<button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>';
						$content .= '</div>';
						$content .= '</div>';
						$content .= '<div class="box-body">';
						$content .= '<div class="row">';
						/** field chapter_id:id **/
						/** field chapter_number:number-fixed-length **/
						$content .= '<div class="col-md-6">';
						$content .= '<div class="form-group">';
						$content .= '<label>Number</label>';
						$content .= '<input maxlength="4" minlength="4" name="postdata[chapter-number]" id="postdata-chapter-number" type="text" class="form-control" placeholder="0000" value="'.htmlentities(stripslashes($postdata['chapter-number'])).'" />';
						$content .= '<p class="help-block">Write the number of the chapter, chapter numbers will be useful for sorting chapters</p>';
						$content .= '</div>';
						$content .= '</div>';
						/** field chapter_date:date **/
						$content .= '<div class="col-md-6">';
						$content .= '<div class="form-group">';
						$content .= '<label>Date</label>';
						$content .= '<div class="input-group date">';
						$content .= '<div class="input-group-addon"><i class="fa fa-calendar"></i></div>';
						$content .= '<input name="postdata[chapter-date]" id="postdata-chapter-date" type="text" class="form-control" placeholder="'.date("Y-m-d").'" value="'.htmlentities(stripslashes($postdata['chapter-date'])).'" data-type="date" />';
						$content .= '</div>';
						$content .= '<p class="help-block">Write the date released of the chapter</p>';
						$content .= '</div>';
						$content .= '</div>';
						/** field chapter_title:varchar **/
						$content .= '<div class="col-md-6">';
						$content .= '<div class="form-group">';
						$content .= '<label>Title</label>';
						$content .= '<input maxlength="128" name="postdata[chapter-title]" id="postdata-chapter-title" type="text" class="form-control" placeholder="Lorem Ipsum" value="'.htmlentities(stripslashes($postdata['chapter-title'])).'" />';
						$content .= '<p class="help-block">Write the title of the chapter</p>';
						$content .= '</div>';
						$content .= '</div>';
						/** field chapter_book:select-table **/
						$options["chapter_book"] = array();
						$sql_option_query = "SELECT * FROM `books`" ;
						$option_result = $mysql->query($sql_option_query);
						if($option_result){
							while ($option_data = $option_result->fetch_array()){
								$options["chapter_book"][] = array("val"=> $option_data["book_id"],"label"=>$option_data["book_title"]);
							}
						}else{
							$options["chapter_book"][] = array("val"=> "","label"=>"Not existing table");
						}
						$content .= '<div class="col-md-6">';
						$content .= '<div class="form-group">';
						$content .= '<label>Select Book</label>';
						$content .= '<select class="form-control" name="postdata[chapter-book]" id="postdata-chapter-book">';
						foreach($options["chapter_book"] as $option) {
							$selected ="";
							if($option["val"] == $postdata['chapter-book'] ){
								$selected ="selected";
							}
							$content .= '<option value="'.htmlentities($option["val"]).'" '.$selected.'>'.htmlentities($option["label"]).'</option>';
						}
						$content .= '</select>';
						$content .= '<p class="help-block"></p>';
						$content .= '</div>';
						$content .= '</div>';
						/** field chapter_content:longtext **/
						$content .= '<div class="col-md-12">';
						$content .= '<div class="form-group">';
						$content .= '<label>Content</label>';
						$content .= '<textarea name="postdata[chapter-content]" id="postdata-chapter-content" class="form-control" data-type="html5" >'.htmlentities(stripslashes($postdata['chapter-content'])).'</textarea>';
						$content .= '<p class="help-block">Write the content of the chapter</p>';
						$content .= '</div>';
						$content .= '</div>';
						/** field chapter_status:select **/
						$options = array();
						$options["chapter_status"][] = array("val"=>"draft","label"=>"Draft");
						$options["chapter_status"][] = array("val"=>"publish","label"=>"Publish");
						$content .= '<div class="col-md-6">';
						$content .= '<div class="form-group">';
						$content .= '<label>Status</label>';
						$content .= '<select class="form-control" name="postdata[chapter-status]" id="postdata-chapter-status">';
						foreach($options["chapter_status"] as $option) {
							$selected ="";
							if($option["val"] == $postdata['chapter-status'] ){
								$selected ="selected";
							}
							$content .= '<option value="'.htmlentities($option["val"]).'" '.$selected.'>'.htmlentities($option["label"]).'</option>';
						}
						$content .= '</select>';
						$content .= '<p class="help-block"></p>';
						$content .= '</div>';
						$content .= '</div>';
						$content .= '</div>';
						$content .= '</div>';
						$content .= '<div class="box-footer">';
						$content .= '<button type="submit" class="btn btn-flat btn-primary" name="submit"><i class="fa fa-floppy-o"></i> Update</button>';
						$content .= '</div>';
						$content .= '</div>';
						$content .= '</form>';
						$content .= '</section>';
					}else{
						header("Location: ?page=chapters&notice=wrong-id");
					}
				}else{
					header("Location: ?page=chapters&notice=wrong-id");
				}
				break;
			case "add":
				// TODO: PAGE - CHAPTERS - ADD
				/** default value **/
				$postdata["chapter-number"] = "" ;
				$postdata["chapter-date"] = "" ;
				$postdata["chapter-title"] = "" ;
				$postdata["chapter-book"] = "" ;
				$postdata["chapter-content"] = "" ;
				$postdata["chapter-status"] = "draft" ;
				/** response postdata **/
				if(isset($_POST["submit"])){
					if(isset($_POST["postdata"]["chapter-number"])){
						$postdata["chapter-number"] = addslashes($_POST["postdata"]["chapter-number"]);
					}
					if(isset($_POST["postdata"]["chapter-date"])){
						$postdata["chapter-date"] = addslashes($_POST["postdata"]["chapter-date"]);
					}
					if(isset($_POST["postdata"]["chapter-title"])){
						$postdata["chapter-title"] = addslashes($_POST["postdata"]["chapter-title"]);
					}
					if(isset($_POST["postdata"]["chapter-book"])){
						$postdata["chapter-book"] = addslashes($_POST["postdata"]["chapter-book"]);
					}
					if(isset($_POST["postdata"]["chapter-content"])){
						$postdata["chapter-content"] = addslashes($_POST["postdata"]["chapter-content"]);
					}
					if(isset($_POST["postdata"]["chapter-status"])){
						$postdata["chapter-status"] = addslashes($_POST["postdata"]["chapter-status"]);
					}
					$sql_query = "INSERT INTO `chapters` (`chapter_number`,`chapter_date`,`chapter_title`,`chapter_book`,`chapter_content`,`chapter_status`) VALUES ('{$postdata['chapter-number']}','{$postdata['chapter-date']}','{$postdata['chapter-title']}','{$postdata['chapter-book']}','{$postdata['chapter-content']}','{$postdata['chapter-status']}')" ;
					$mysql->query($sql_query);
					$last_id = $mysql->insert_id;
					header("Location: ?page=chapters&notice=success-add&action=edit&id=".$last_id);
				}
				/** breadcrumb **/
				$content .= '<section class="content-header">';
				$content .= '<h1>Chapters <small>List of chapter</small></h1>';
				$content .= '<ol class="breadcrumb">';
				$content .= '<li><a href="?"><i class="fa fa-dashboard"></i> Home</a></li>';
				$content .= '<li><a href="?">Chapters</a></li>';
				$content .= '<li class="active">Add</li>';
				$content .= '</ol>';
				$content .= '</section>';
				/** content **/
				$content .= '<section class="content">';
				$content .= $notification;
				$content .= '<form action="" method="post">';
				$content .= '<div class="box box-success">';
				$content .= '<div class="box-header with-border">';
				$content .= '<h3 class="box-title">Add new Chapter</h3>';
				$content .= '<div class="box-tools pull-right">';
				$content .= '<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>';
				$content .= '<button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>';
				$content .= '</div>';
				$content .= '</div>';
				$content .= '<div class="box-body">';
				$content .= '<div class="row">';
				/** field chapter_id:id **/
				/** field chapter_number:number-fixed-length **/
				$content .= '<div class="col-md-6">';
				$content .= '<div class="form-group">';
				$content .= '<label>Number</label>';
				$content .= '<input minlength="4" maxlength="4" name="postdata[chapter-number]" id="postdata-chapter-number" type="text" class="form-control" placeholder="0000" value="'.htmlentities(stripslashes($postdata['chapter-number'])).'" />';
				$content .= '<p class="help-block">Write the number of the chapter, chapter numbers will be useful for sorting chapters</p>';
				$content .= '</div>';
				$content .= '</div>';
				/** field chapter_date:date **/
				$content .= '<div class="col-md-6">';
				$content .= '<div class="form-group">';
				$content .= '<label>Date</label>';
				$content .= '<div class="input-group date">';
				$content .= '<div class="input-group-addon"><i class="fa fa-calendar"></i></div>';
				$content .= '<input name="postdata[chapter-date]" id="postdata-chapter-date" type="text" class="form-control" placeholder="'.date("Y-m-d").'" value="'.htmlentities(stripslashes($postdata['chapter-date'])).'" data-type="date" />';
				$content .= '</div>';
				$content .= '<p class="help-block">Write the date released of the chapter</p>';
				$content .= '</div>';
				$content .= '</div>';
				/** field chapter_title:varchar **/
				$content .= '<div class="col-md-6">';
				$content .= '<div class="form-group">';
				$content .= '<label>Title</label>';
				$content .= '<input maxlength="128" name="postdata[chapter-title]" id="postdata-chapter-title" type="text" class="form-control" placeholder="Lorem Ipsum" value="'.htmlentities(stripslashes($postdata['chapter-title'])).'" />';
				$content .= '<p class="help-block">Write the title of the chapter</p>';
				$content .= '</div>';
				$content .= '</div>';
				/** field chapter_book:select-table **/
				$options["chapter_book"] = array();
				$sql_option_query = "SELECT * FROM `books`" ;
				$option_result = $mysql->query($sql_option_query);
				if($option_result){
					while ($option_data = $option_result->fetch_array()){
						$options["chapter_book"][] = array("val"=> $option_data["book_id"],"label"=>$option_data["book_title"]);
					}
				}else{
					$options["chapter_book"][] = array("val"=> "","label"=>"Not existing table");
				}
				$content .= '<div class="col-md-6">';
				$content .= '<div class="form-group">';
				$content .= '<label>Select Book</label>';
				$content .= '<select class="form-control" name="postdata[chapter-book]" id="postdata-chapter-book">';
				foreach($options["chapter_book"] as $option) {
					$selected ="";
					if($option["val"] == $postdata['chapter-book'] ){
						$selected ="selected";
					}
					$content .= '<option value="'.htmlentities($option["val"]).'" '.$selected.'>'.htmlentities($option["label"]).'</option>';
				}
				$content .= '</select>';
				$content .= '<p class="help-block"></p>';
				$content .= '</div>';
				$content .= '</div>';
				/** field chapter_content:longtext **/
				$content .= '<div class="col-md-12">';
				$content .= '<div class="form-group">';
				$content .= '<label>Content</label>';
				$content .= '<textarea name="postdata[chapter-content]" id="postdata-chapter-content" class="form-control" data-type="html5" >'.htmlentities(stripslashes($postdata['chapter-content'])).'</textarea>';
				$content .= '<p class="help-block">Write the content of the chapter</p>';
				$content .= '</div>';
				$content .= '</div>';
				/** field chapter_status:select **/
				$options = array();
				$options["chapter_status"][] = array("val"=>"draft","label"=>"Draft");
				$options["chapter_status"][] = array("val"=>"publish","label"=>"Publish");
				$content .= '<div class="col-md-6">';
				$content .= '<div class="form-group">';
				$content .= '<label>Status</label>';
				$content .= '<select class="form-control" name="postdata[chapter-status]" id="postdata-chapter-status">';
				foreach($options["chapter_status"] as $option) {
					$selected ="";
					if($option["val"] == $postdata['chapter-status'] ){
						$selected ="selected";
					}
					$content .= '<option value="'.htmlentities($option["val"]).'" '.$selected.'>'.htmlentities($option["label"]).'</option>';
				}
				$content .= '</select>';
				$content .= '<p class="help-block"></p>';
				$content .= '</div>';
				$content .= '</div>';
				$content .= '</div>';
				$content .= '</div>';
				$content .= '<div class="box-footer">';
				$content .= '<button type="submit" class="btn btn-flat btn-success" name="submit"><i class="fa fa-plus"></i> Add new Chapter</button>';
				$content .= '</div>';
				$content .= '</div>';
				$content .= '</form>';
				$content .= '</section>';
				break;
			case "delete":
				// TODO: PAGE - CHAPTERS - DELETE
				if(isset($_GET["id"])){
					$entry_id= (int)$_GET["id"];
					/** fetch current data **/
					$sql_query = "SELECT * FROM `chapters` WHERE `chapter_id`=$entry_id LIMIT 0,1" ;
					$result = $mysql->query($sql_query);
					$rowdata = $result->fetch_array();
					if(isset($rowdata["chapter_id"])){
						$sql_query = "DELETE FROM `chapters` WHERE `chapter_id`=$entry_id";
						$stmt = $mysql->prepare($sql_query);
						$stmt->execute();
						$stmt->close();
						header("Location: ?page=chapters&notice=success-delete");
					}else{
						header("Location: ?page=chapters&notice=wrong-id");
					}
				}
				break;
			}
			$content .= '</div>';
			$content .= '<footer class="main-footer">';
			$content .= '<div class="pull-right hidden-xs">';
			$content .= '<b>Version</b> 01.01.01';
			$content .= '</div>';
			$content .= '<strong>Copyright &copy; '.date("Y").' <a href="https://godigitally.co.in">Go Digitally</a>.</strong> All rights reserved.';
			$content .= '</footer>';
			$content .= '</div>';
			break;
	// TODO: PAGE - PROFILE
	case "profile":
		if($_SESSION["IS_LOGIN"]==false){
			header("Location: ?page=login");
		}
		$page_title = "Profile";
		$body_class = "hold-transition skin-".$config["color"]." sidebar-mini";
		$notification = null;
		if(isset($_GET["notice"])){
			switch($_GET["notice"]){
				case "success-profile-update":
					$notification .= '<div id="notification" class="alert alert-success">';
					$notification .= '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
					$notification .= 'You have successfully update your profile.';
					$notification .= '</div>';
					break;
				case "error-password-too-short":
					$notification .= '<div id="notification" class="alert alert-danger">';
					$notification .= '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
					$notification .= 'The new password you wrote is too short, at least 6 characters or more';
					$notification .= '</div>';
					break;
				case "error-password-not-same":
					$notification .= '<div id="notification" class="alert alert-danger">';
					$notification .= '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
					$notification .= 'The new password and new password again are not the same, please try again!';
					$notification .= '</div>';
					break;
				case "error-old-password":
					$notification .= '<div id="notification" class="alert alert-danger">';
					$notification .= '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
					$notification .= 'Your old password is wrong, please try again!';
					$notification .= '</div>';
					break;
				case "success-password-update":
					$notification .= '<div id="notification" class="alert alert-success">';
					$notification .= '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
					$notification .= 'Your password has been changed, please logout!';
					$notification .= '</div>';
					break;
			}
		}
		$sql_query = "SELECT * FROM `users` WHERE `user_id` = '{$_SESSION["CURRENT_USER"]["user_id"]}' AND `user_email` = '{$_SESSION["CURRENT_USER"]["user_email"]}'" ;
		$result = $mysql->query($sql_query);
		$current_user = $result->fetch_array();
		if(!isset($current_user["user_email"])){
			header("Location: ?page=login");
		}
		
		/** resp update profile **/
		if(isset($_POST["user-data"])){
			$user_first_name = addslashes($_POST["postdata"]["user-first-name"]) ;
			$user_last_name = addslashes($_POST["postdata"]["user-last-name"]) ;
			$user_website = addslashes($_POST["postdata"]["user-website"]) ;
			$sql_query = "UPDATE `users` SET `user_first_name` = '{$user_first_name}', `user_last_name` = '{$user_last_name}',`user_website` = '{$user_website}' WHERE `user_id` ={$current_user["user_id"]};";
			$stmt = $mysql->prepare($sql_query);
			$stmt->execute();
			$stmt->close();
			$_SESSION["CURRENT_USER"]["user_first_name"] = $user_first_name;
			header("Location: ?page=profile&notice=success-profile-update");
		}
		
		/** resp update password **/
		if(isset($_POST["user-password"])){
			if(strlen($_POST["postdata"]["user-new-password"]) >= 6){
				if($_POST["postdata"]["user-new-password"] == $_POST["postdata"]["user-new-password-again"]){
					$old_password_hash = sha1("imabuilder".$_POST["postdata"]["user-old-password"]);
					if($old_password_hash == $current_user["user_password"]){
						$user_password = sha1("imabuilder".$_POST["postdata"]["user-new-password"]);
						$sql_query = "UPDATE `users` SET `user_password` = '{$user_password}' WHERE `user_id` ={$current_user["user_id"]};";
						$stmt = $mysql->prepare($sql_query);
						$stmt->execute();
						$stmt->close();
						header("Location: ?page=profile&notice=success-password-update");
					}else{
						header("Location: ?page=profile&notice=error-old-password");
					}
				}else{
					header("Location: ?page=profile&notice=error-password-not-same");
				}
			}else{
				header("Location: ?page=profile&notice=error-password-too-short");
			}
		}
		
		$content = null;
		$content .= '<div class="wrapper">';
		$content .= '<header class="main-header">';
		$content .= '<a href="?" class="logo">';
		$content .= '<span class="logo-mini"><b>PN</b>L</span>';
		$content .= '<span class="logo-lg"><b>'.$app_name.'</b> Panel</span>';
		$content .= '</a>';
		$content .= '<nav class="navbar navbar-static-top">';
		$content .= '<a href="?" class="sidebar-toggle" data-toggle="push-menu" role="button">';
		$content .= '<span class="sr-only">Toggle navigation</span>';
		$content .= '<span class="icon-bar"></span>';
		$content .= '<span class="icon-bar"></span>';
		$content .= '<span class="icon-bar"></span>';
		$content .= '</a>';
		$content .= '<div class="navbar-custom-menu">';
		$content .= '<ul class="nav navbar-nav">';
		$content .= '<li class="dropdown user user-menu">';
		$content .= '<a href="?" class="dropdown-toggle" data-toggle="dropdown">';
		$content .= '<img src="https://www.gravatar.com/avatar/' . md5(strtolower(trim($current_user['user_email']))).'" class="user-image" alt="User Image">';
		$content .= '<span class="hidden-xs">' . htmlentities(stripslashes($current_user['user_name'])).'</span>';
		$content .= '</a>';
		$content .= '<ul class="dropdown-menu">';
		$content .= '<li class="user-header">';
		$content .= '<img src="https://www.gravatar.com/avatar/' . md5(strtolower(trim($current_user['user_email']))).'" class="img-circle" alt="User Image">';
		$content .= '<p>';
		$content .= '' . htmlentities(stripslashes($current_user['user_name'])).'';
		$content .= '<small>' . htmlentities(stripslashes($current_user['user_level'])).'</small>';
		$content .= '</p>';
		$content .= '</li>';
		$content .= '<li class="user-footer">';
		$content .= '<div class="pull-left">';
		$content .= '<a href="?page=profile" class="btn btn-default btn-flat">Profile</a>';
		$content .= '</div>';
		$content .= '<div class="pull-right">';
		$content .= '<a href="?page=logout" class="btn btn-default btn-flat">Sign out</a>';
		$content .= '</div>';
		$content .= '</li>';
		$content .= '</ul>';
		$content .= '</li>';
		$content .= '</ul>';
		$content .= '</div>';
		$content .= '</nav>';
		$content .= '</header>';
		$content .= '<aside class="main-sidebar">';
		$content .= '<section class="sidebar">';
		$content .= '<div class="user-panel">';
		$content .= '<div class="pull-left image">';
		$content .= '<img src="https://www.gravatar.com/avatar/' . md5(strtolower(trim($current_user['user_email']))).'" class="img-circle" alt="'.htmlentities(stripslashes($current_user['user_name'])).'">';
		$content .= '</div>';
		$content .= '<div class="pull-left info">';
		$content .= '<p>'.htmlentities(stripslashes($current_user['user_name'])).'</p>';
		$content .= '<a href="?"><i class="fa fa-circle text-success"></i> '.htmlentities(stripslashes($current_user['user_level'])).'</a>';
		$content .= '</div>';
		$content .= '</div>';
		$content .= '<ul class="sidebar-menu" data-widget="tree">';
		$content .= '<li class="header">DATA MANAGER</li>';
		$content .= '<li class="treeview">';
		$content .= '<a href="?">';
		$content .= '<i class="fa fa-book"></i> <span>Books</span>';
		$content .= '<span class="pull-right-container">';
		$content .= '<i class="fa fa-angle-left pull-right"></i>';
		$content .= '</span>';
		$content .= '</a>';
		$content .= '<ul class="treeview-menu">';
		$content .= '<li><a href="?page=books&amp;action=add"><i class="fa fa-plus"></i> Add New</a></li>';
		$content .= '<li><a href="?page=books&amp;action=list"><i class="fa fa-list-ul"></i> All Books</a></li>';
		$content .= '</ul>';
		$content .= '</li>';
		$content .= '<li class="treeview">';
		$content .= '<a href="?">';
		$content .= '<i class="fa fa-book"></i> <span>Chapters</span>';
		$content .= '<span class="pull-right-container">';
		$content .= '<i class="fa fa-angle-left pull-right"></i>';
		$content .= '</span>';
		$content .= '</a>';
		$content .= '<ul class="treeview-menu">';
		$content .= '<li><a href="?page=chapters&amp;action=add"><i class="fa fa-plus"></i> Add New</a></li>';
		$content .= '<li><a href="?page=chapters&amp;action=list"><i class="fa fa-list-ul"></i> All Chapters</a></li>';
		$content .= '</ul>';
		$content .= '</li>';
		$content .= '<li class="header">TOOLS</li>';
		$content .= '<li><a href="?page=onesignal-sender"><i class="fa fa-send"></i> <span>OneSignal Sender</span></a></li>';
		$content .= '<li class="header">USERS</li>';
		$content .= '<li class="active"><a href="?page=profile"><i class="fa fa-user"></i> <span>Your Profile</span></a></li>';
		$content .= '</ul>';
		$content .= '</section>';
		$content .= '</aside>';
		$content .= '<div class="content-wrapper">';
		/** breadcrumb **/
		$content .= '<section class="content-header">';
		$content .= '<h1>Profile <small>Your personal data</small></h1>';
		$content .= '<ol class="breadcrumb">';
		$content .= '<li><a href="?"><i class="fa fa-dashboard"></i> Home</a></li>';
		$content .= '<li class="active">Profile</li>';
		$content .= '</ol>';
		$content .= '</section>';
		/** content **/
		$content .= '<section class="content">';
		$content .= $notification;
		$content .= '<div class="row">';
		$content .= '<div class="col-md-3">';
		$content .= '<div class="box box-primary">';
		$content .= '<div class="box-body box-profile">';
		$content .= '<img class="profile-user-img img-responsive img-circle" src="https://www.gravatar.com/avatar/' . md5(strtolower(trim($current_user['user_email']))).'?s=128" alt="User profile picture">';
		$content .= '<h3 class="profile-username text-center">' . htmlentities(stripslashes($current_user['user_name'])).'</h3>';
		$content .= '<p class="text-muted text-center">' . htmlentities(stripslashes($current_user['user_level'])).'</p>';
		$content .= '<ul class="list-group list-group-unbordered">';
		
		/** count books data **/
		$sql_query = "SELECT COUNT(*) AS `total` FROM `books` LIMIT 0,1" ;
		$result = $mysql->query($sql_query);
		$count = $result->fetch_array();
		$content .= '<li class="list-group-item">';
		$content .= '<b>Books</b> <a class="pull-right">'.$count["total"].'</a>';
		$content .= '</li>';
		
		/** count chapters data **/
		$sql_query = "SELECT COUNT(*) AS `total` FROM `chapters` LIMIT 0,1" ;
		$result = $mysql->query($sql_query);
		$count = $result->fetch_array();
		$content .= '<li class="list-group-item">';
		$content .= '<b>Chapters</b> <a class="pull-right">'.$count["total"].'</a>';
		$content .= '</li>';
		$content .= '</ul>';
		$content .= '<a href="https://en.gravatar.com/" target="_blank" class="btn btn-flat btn-primary btn-block"><b>Change Gravatar</b></a>';
		$content .= '</div>';
		$content .= '</div>';
		$content .= '</div>';
		$content .= '<div class="col-md-5">';
		$content .= '<form action="" method="post">';
		$content .= '<div class="box box-success">';
		$content .= '<div class="box-header with-border">';
		$content .= '<h3 class="box-title">About Yourself</h3>';
		$content .= '<div class="box-tools pull-right">';
		$content .= '<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>';
		$content .= '<button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>';
		$content .= '</div>';
		$content .= '</div>';
		$content .= '<div class="box-body">';
		$content .= '<div class="form-group">';
		$content .= '<label>First Name</label>';
		$content .= '<input name="postdata[user-first-name]" id="postdata-user-first-name" type="text" class="form-control" placeholder="Regel" value="'.htmlentities(stripslashes($current_user['user_first_name'])).'" />';
		$content .= '<p class="help-block">What is your first name?</p>';
		$content .= '</div>';
		$content .= '<div class="form-group">';
		$content .= '<label>Last Name</label>';
		$content .= '<input name="postdata[user-last-name]" id="postdata-user-last-name" type="text" class="form-control" placeholder="Jambak" value="'.htmlentities(stripslashes($current_user['user_last_name'])).'" />';
		$content .= '<p class="help-block">What is your last name?</p>';
		$content .= '</div>';
		$content .= '<div class="form-group">';
		$content .= '<label>Email Address</label>';
		$content .= '<input name="postdata[user-email]" id="postdata-user-email" type="text" class="form-control" placeholder="regel@ihsana.com" value="'.htmlentities(stripslashes($current_user['user_email'])).'" readonly/>';
		$content .= '<p class="help-block">What is the email address used to log in?</p>';
		$content .= '</div>';
		$content .= '<div class="form-group">';
		$content .= '<label>Website</label>';
		$content .= '<input name="postdata[user-website]" id="postdata-user-website" type="text" class="form-control" placeholder="http://ihsana.com" value="'.htmlentities(stripslashes($current_user['user_website'])).'" />';
		$content .= '<p class="help-block">What is the your website?</p>';
		$content .= '</div>';
		$content .= '</div>';
		$content .= '<div class="box-footer">';
		$content .= '<button type="submit" class="btn btn-flat btn-success" name="user-data"><i class="fa fa-floppy-o"></i> Update Profile</button>';
		$content .= '</div>';
		$content .= '</div>';
		$content .= '</form>';
		$content .= '</div>';
		$content .= '<div class="col-md-4">';
		$content .= '<form action="" method="post">';
		$content .= '<div class="box box-danger">';
		$content .= '<div class="box-header with-border">';
		$content .= '<h3 class="box-title">Account Management</h3>';
		$content .= '<div class="box-tools pull-right">';
		$content .= '<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>';
		$content .= '<button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>';
		$content .= '</div>';
		$content .= '</div>';
		$content .= '<div class="box-body">';
		$content .= '<div class="form-group">';
		$content .= '<label>Old Password</label>';
		$content .= '<input name="postdata[user-old-password]" id="postdata-user-old-password" type="password" class="form-control" autocomplete="off"/>';
		$content .= '<p class="help-block">What is old password have you used?</p>';
		$content .= '</div>';
		$content .= '<div class="form-group">';
		$content .= '<label>New Password</label>';
		$content .= '<input name="postdata[user-new-password]" id="postdata-user-new-password" type="password" class="form-control" autocomplete="off"/>';
		$content .= '<p class="help-block">What is your new password?</p>';
		$content .= '</div>';
		$content .= '<div class="form-group">';
		$content .= '<label>New Password Again</label>';
		$content .= '<input name="postdata[user-new-password-again]" id="postdata-user-new-password-again" type="password" class="form-control" autocomplete="off"/>';
		$content .= '<p class="help-block">Type again new password</p>';
		$content .= '</div>';
		$content .= '</div>';
		$content .= '<div class="box-footer">';
		$content .= '<button type="submit" class="btn btn-flat btn-danger" name="user-password"><i class="fa fa-floppy-o"></i> Update</button>';
		$content .= '</div>';
		$content .= '</div>';
		$content .= '</div>';
		$content .= '</form>';
		$content .= '</div>';
		$content .= '</section>';
		$content .= '</div>';
		$content .= '<footer class="main-footer">';
		$content .= '<div class="pull-right hidden-xs">';
		$content .= '<b>Version</b> 01.01.01';
		$content .= '</div>';
		$content .= '<strong>Copyright &copy; '.date("Y").' <a href="https://godigitally.co.in">Go Digitally</a>.</strong> All rights reserved.';
		$content .= '</footer>';
		$content .= '</div>';
		break;
	// TODO: PAGE - FILE-BROWSER
	case "file-browser":
		if($_SESSION["IS_LOGIN"]==false){
			header("Location: ?page=login");
		}
		if(!file_exists("./filebrowser/php/autoload.php")){
			die("elfinder not installed, please download <a target=\"blank\" href=\"https://studio-42.github.io/elFinder/\">elfinder</a> and extracted into `filebrowser` directory");
		}
		$site_url="";
		if(isset($_SERVER["HTTP_REFERER"])){
			$parse_url = parse_url($_SERVER["HTTP_REFERER"]);
			$site_url = $parse_url["scheme"] . "://" . $parse_url["host"] . "/" . dirname($parse_url["path"]) . "/";
		}
		$content .= '<!DOCTYPE HTML>';
		$content .= '<html>';
		$content .= '<head>';
		$content .= '<meta charset="utf-8" />';
		$content .= '<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />';
		$content .= '<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=2" />';
		$content .= '<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css" />';
		$content .= '<link rel="stylesheet" href="./filebrowser/css/elfinder.min.css"/>';
		$content .= '<link rel="stylesheet" href="./filebrowser/css/theme.css"/>';
		$content .= '<title>elFinder</title>';
		$content .= '<style type="text/css">';
		$content .= 'body {padding: 0 !important;margin: 0 !important;}';
		$content .= '#elfinder{z-index:999999999;height: 100%; width: 100%;}';
		$content .= 'div{border-radius: 0 !important;}';
		$content .= '</style>';
		$content .= '</head>';
		$content .= '<body>';
		$content .= '<div id="elfinder"></div>';
		$content .= '<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>';
		$content .= '<script src="//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>';
		$content .= '<script src="./filebrowser/js/elfinder.min.js"></script>';
		$content .= '<script type="text/javascript">';
		if(isset($_GET["CKEditor"])){
			$content .= 'function getUrlParam(n){var a=new RegExp("(?:[?&]|&)"+n+"=([^&]+)","i"),e=window.location.search.match(a);return e&&1<e.length?e[1]:null}';
			$content .= 'var userfiles="";$(document).ready(function(){$("#elfinder").elfinder({cssAutoLoad:!1,baseUrl:"./",url:"?page=file-connector",width:"100%",height:"100%",resizable:!1,getFileCallback:function(n,e){var i=n.path;i=i.replace(/\\\\/gi,"/");var t="'.$site_url.'"+i.replace(/src\//gi,"");window.opener.CKEDITOR.tools.callFunction(getUrlParam("CKEditorFuncNum"),t),window.close()}},function(i,n){i.bind("init",function(){"ja"===i.lang&&i.loadScript(["//cdn.rawgit.com/polygonplanet/encoding.js/1.0.26/encoding.min.js"],function(){window.Encoding&&Encoding.convert&&i.registRawStringDecoder(function(n){return Encoding.convert(n,{to:"UNICODE",type:"string"})})},{loadType:"tag"})});var t=document.title;i.bind("open",function(){var n="",e=i.cwd();e&&(n=i.path(e.hash)||null),document.title=n?n+":"+t:t}).bind("destroy",function(){document.title=t})})});';
		}else{
			$content .= 'var userfiles="";$(document).ready(function(){$("#elfinder").elfinder({cssAutoLoad:!1,baseUrl:"./",url:"?page=file-connector",width:"100%",height:"100%",resizable:!1,getFileCallback:function(n,e){var i=n.path;i=i.replace(/\\\\/gi,"/");var t="'.$site_url.'"+i.replace(/src\//gi,"");window.opener.fileBrowser.callBack(t),window.close()}},function(i,n){i.bind("init",function(){"ja"===i.lang&&i.loadScript(["//cdn.rawgit.com/polygonplanet/encoding.js/1.0.26/encoding.min.js"],function(){window.Encoding&&Encoding.convert&&i.registRawStringDecoder(function(n){return Encoding.convert(n,{to:"UNICODE",type:"string"})})},{loadType:"tag"})});var t=document.title;i.bind("open",function(){var n="",e=i.cwd();e&&(n=i.path(e.hash)||null),document.title=n?n+":"+t:t}).bind("destroy",function(){document.title=t})})});';
		}
		$content .= '</script>';
		$content .= '</body>';
		$content .= '</html>';
		die($content);
		break;
	// TODO: PAGE - FILE-CONNECTOR
	case "file-connector":
		if($_SESSION["IS_LOGIN"]==false){
			header("Location: ?page=login");
		}
		if(file_exists("./filebrowser/php/autoload.php")){
			require "./filebrowser/php/autoload.php";
			elFinder::$netDrivers["ftp"] = "FTP";
			function access($attr, $path, $data, $volume, $isDir, $relpath){
				$basename = basename($path);
				return $basename[0] === "."
				&& strlen($relpath) !== 1
					? !($attr == "read" || $attr == "write")
					: null;
			}
			$opts = array( // "debug" => true,
				"roots" => array( // Items volume
					array(
					"driver" => "LocalFileSystem", // driver for accessing file system (REQUIRED)
					"path" => "./userfiles/", // path to files (REQUIRED)
					"URL" => dirname($_SERVER["PHP_SELF"]) . "/userfiles/", // URL to files (REQUIRED)
					"trashHash" => "t1_Lw", // elFinder"s hash of trash folder
					"winHashFix" => DIRECTORY_SEPARATOR !== "/", // to make hash same to Linux one on windows too
					"uploadDeny" => array("all"), // All Mimetypes not allowed to upload
					"uploadAllow" => array(
						"image/x-ms-bmp",
						"image/gif",
						"image/jpeg",
						"image/png",
						"image/x-icon",
						"text/plain"), // Mimetype `image` and `text/plain` allowed to upload
					"uploadOrder" => array("deny", "allow"), // allowed Mimetype `image` and `text/plain` only
					"accessControl" => "access" // disable and hide dot starting files (OPTIONAL)
				), // Trash volume
				array(
					"id" => "1",
					"driver" => "Trash",
					"path" => "./userfiles/.trash/",
					"tmbURL" => dirname($_SERVER["PHP_SELF"]) . "/userfiles/.trash/.tmb/",
					"winHashFix" => DIRECTORY_SEPARATOR !== "/", // to make hash same to Linux one on windows too
					"uploadDeny" => array("all"), // Recomend the same settings as the original volume that uses the trash
					"uploadAllow" => array(
						"image/x-ms-bmp",
						"image/gif",
						"image/jpeg",
						"image/png",
						"image/x-icon",
						"text/plain"), // Same as above
					"uploadOrder" => array("deny", "allow"), // Same as above
					"accessControl" => "access", // Same as above
				)));
			$connector = new elFinderConnector(new elFinder($opts));
			$connector->run();
		}else{
			die("elfinder not installed");
		}
		die($content);
		break;
	// TODO: PAGE - ONESIGNAL-SENDER
	case "onesignal-sender":
		if($_SESSION["IS_LOGIN"]==false){
			header("Location: ?page=login");
		}
		$page_title = "Profile";
		$body_class = "hold-transition skin-".$config["color"]." sidebar-mini";
		$current_user = $_SESSION["CURRENT_USER"];
		$notification = null;
		if(isset($_POST["send-push"])){
			$push_content = array("en" => $_POST["push-message"]);
		
			$fields = array(
				"app_id" => $config["onesignal_app_id"],
				"included_segments" => array("All"),
				"data" => array("page" => ""),
				"contents" => $push_content
			);
		
			$fields = json_encode($fields);
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
			curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json; charset=utf-8", "Authorization: Basic " . $config["onesignal_api_key"]));
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_HEADER, false);
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			$response = json_decode(curl_exec($ch), true);
			curl_close($ch);
		
			if (isset($response["errors"][0])){
				$notification .= '<div id="notification" class="alert alert-danger">';
				$notification .= '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
				$notification .=  $response["errors"][0];
				$notification .= '</div>';
			} else{
				$notification .= '<div id="notification" class="alert alert-success">';
				$notification .= '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
				$notification .= 'ID #' . $response["id"] . ' with ' . $response["recipients"] . ' recipients';
				$notification .= '</div>';
			}
		
		}
		$content = null;
		$content .= '<div class="wrapper">';
		$content .= '<header class="main-header">';
		$content .= '<a href="?" class="logo">';
		$content .= '<span class="logo-mini"><b>PN</b>L</span>';
		$content .= '<span class="logo-lg"><b>'.$app_name.'</b> Panel</span>';
		$content .= '</a>';
		$content .= '<nav class="navbar navbar-static-top">';
		$content .= '<a href="?" class="sidebar-toggle" data-toggle="push-menu" role="button">';
		$content .= '<span class="sr-only">Toggle navigation</span>';
		$content .= '<span class="icon-bar"></span>';
		$content .= '<span class="icon-bar"></span>';
		$content .= '<span class="icon-bar"></span>';
		$content .= '</a>';
		$content .= '<div class="navbar-custom-menu">';
		$content .= '<ul class="nav navbar-nav">';
		$content .= '<li class="dropdown user user-menu">';
		$content .= '<a href="?" class="dropdown-toggle" data-toggle="dropdown">';
		$content .= '<img src="https://www.gravatar.com/avatar/' . md5(strtolower(trim($current_user['user_email']))).'" class="user-image" alt="User Image">';
		$content .= '<span class="hidden-xs">' . htmlentities(stripslashes($current_user['user_name'])).'</span>';
		$content .= '</a>';
		$content .= '<ul class="dropdown-menu">';
		$content .= '<li class="user-header">';
		$content .= '<img src="https://www.gravatar.com/avatar/' . md5(strtolower(trim($current_user['user_email']))).'" class="img-circle" alt="User Image">';
		$content .= '<p>';
		$content .= '' . htmlentities(stripslashes($current_user['user_name'])).'';
		$content .= '<small>' . htmlentities(stripslashes($current_user['user_level'])).'</small>';
		$content .= '</p>';
		$content .= '</li>';
		$content .= '<li class="user-footer">';
		$content .= '<div class="pull-left">';
		$content .= '<a href="?page=profile" class="btn btn-default btn-flat">Profile</a>';
		$content .= '</div>';
		$content .= '<div class="pull-right">';
		$content .= '<a href="?page=logout" class="btn btn-default btn-flat">Sign out</a>';
		$content .= '</div>';
		$content .= '</li>';
		$content .= '</ul>';
		$content .= '</li>';
		$content .= '</ul>';
		$content .= '</div>';
		$content .= '</nav>';
		$content .= '</header>';
		$content .= '<aside class="main-sidebar">';
		$content .= '<section class="sidebar">';
		$content .= '<div class="user-panel">';
		$content .= '<div class="pull-left image">';
		$content .= '<img src="https://www.gravatar.com/avatar/' . md5(strtolower(trim($current_user['user_email']))).'" class="img-circle" alt="'.htmlentities(stripslashes($current_user['user_name'])).'">';
		$content .= '</div>';
		$content .= '<div class="pull-left info">';
		$content .= '<p>'.htmlentities(stripslashes($current_user['user_name'])).'</p>';
		$content .= '<a href="?"><i class="fa fa-circle text-success"></i> '.htmlentities(stripslashes($current_user['user_level'])).'</a>';
		$content .= '</div>';
		$content .= '</div>';
		$content .= '<ul class="sidebar-menu" data-widget="tree">';
		$content .= '<li class="header">DATA MANAGER</li>';
		$content .= '<li class="treeview">';
		$content .= '<a href="?">';
		$content .= '<i class="fa fa-book"></i> <span>Books</span>';
		$content .= '<span class="pull-right-container">';
		$content .= '<i class="fa fa-angle-left pull-right"></i>';
		$content .= '</span>';
		$content .= '</a>';
		$content .= '<ul class="treeview-menu">';
		$content .= '<li><a href="?page=books&amp;action=add"><i class="fa fa-plus"></i> Add New</a></li>';
		$content .= '<li><a href="?page=books&amp;action=list"><i class="fa fa-list-ul"></i> All Books</a></li>';
		$content .= '</ul>';
		$content .= '</li>';
		$content .= '<li class="treeview">';
		$content .= '<a href="?">';
		$content .= '<i class="fa fa-book"></i> <span>Chapters</span>';
		$content .= '<span class="pull-right-container">';
		$content .= '<i class="fa fa-angle-left pull-right"></i>';
		$content .= '</span>';
		$content .= '</a>';
		$content .= '<ul class="treeview-menu">';
		$content .= '<li><a href="?page=chapters&amp;action=add"><i class="fa fa-plus"></i> Add New</a></li>';
		$content .= '<li><a href="?page=chapters&amp;action=list"><i class="fa fa-list-ul"></i> All Chapters</a></li>';
		$content .= '</ul>';
		$content .= '</li>';
		$content .= '<li class="header">TOOLS</li>';
		$content .= '<li class="active"><a href="?page=onesignal-sender"><i class="fa fa-send"></i> <span>OneSignal Sender</span></a></li>';
		$content .= '<li class="header">USERS</li>';
		$content .= '<li><a href="?page=profile"><i class="fa fa-user"></i> <span>Your Profile</span></a></li>';
		$content .= '</ul>';
		$content .= '</section>';
		$content .= '</aside>';
		$content .= '<div class="content-wrapper">';
		/** breadcrumb **/
		$content .= '<section class="content-header">';
		$content .= '<h1>OneSignal Sender <small>Send push notifications for your app</small></h1>';
		$content .= '<ol class="breadcrumb">';
		$content .= '<li><a href="?"><i class="fa fa-dashboard"></i> Home</a></li>';
		$content .= '<li class="active">OneSignal Sender</li>';
		$content .= '</ol>';
		$content .= '</section>';
		/** content **/
		$content .= '<section class="content">';
		$content .= $notification;
		$content .= '<form action="" method="post">';
		$content .= '<div class="box box-danger">';
		$content .= '<div class="box-header with-border">';
		$content .= '<h3 class="box-title">Push Notification</h3>';
		$content .= '<div class="box-tools pull-right">';
		$content .= '<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>';
		$content .= '<button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>';
		$content .= '</div>';
		$content .= '</div>';
		$content .= '<div class="box-body">';
		$content .= '<div class="form-group">';
		$content .= '<label class="">Message</label>';
		$content .= '<textarea class="form-control" name="push-message"></textarea>';
		$content .= '</div>';
		$content .= '</div>';
		$content .= '<div class="box-footer">';
		$content .= '<button type="submit" class="btn btn-flat btn-danger" name="send-push"><i class="fa fa-plane"></i> Send notification!</button>';
		$content .= '</div>';
		$content .= '</div>';
		$content .= '</form>';
		$content .= '</section>';
		$content .= '</div><!-- ./content-wrapper -->';
		$content .= '<footer class="main-footer">';
		$content .= '<div class="pull-right hidden-xs">';
		$content .= '<b>Version</b> 01.01.01';
		$content .= '</div>';
		$content .= '<strong>Copyright &copy; '.date("Y").' <a href="https://godigitally.co.in">Go Digitally</a>.</strong> All rights reserved.';
		$content .= '</footer>';
		$content .= '</div><!-- ./wrapper -->';
		break;
}

$mysql->close();
$html_tags = null;
$html_tags .= '<!DOCTYPE html>';
$html_tags .= '<html>';
$html_tags .= '<head>';
$html_tags .= '<meta charset="utf-8">';
$html_tags .= '<meta http-equiv="X-UA-Compatible" content="IE=edge">';
$html_tags .= '<meta name="generator" content="IMA-BuildeRz vrev20.10.11" />';
$html_tags .= '<title>'. htmlentities($app_name .' | '. $page_title) .'</title>';
$html_tags .= '<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">';
$html_tags .= '<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3/dist/css/bootstrap.min.css">';
$html_tags .= '<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4/css/font-awesome.min.css">';
$html_tags .= '<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@2/dist/css/AdminLTE.min.css">';
$html_tags .= '<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@2/dist/css/skins/_all-skins.min.css">';
$html_tags .= '<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-tagsinput@0.7.1/dist/bootstrap-tagsinput.min.css">';
$html_tags .= '<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/datatables.net-bs@1/css/dataTables.bootstrap.min.css">';
$html_tags .= '<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/eonasdan-bootstrap-datetimepicker@4/build/css/bootstrap-datetimepicker.min.css">';
$html_tags .= '<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/icheck@1/skins/all.css">';
$html_tags .= '<!--[if lt IE 9]>';
$html_tags .= '<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>';
$html_tags .= '<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>';
$html_tags .= '<![endif]-->';
$html_tags .= '<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Anton|Staatliches|Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">';
$html_tags .= '<style type="text/css">';
$html_tags .= 'body{background: url(\''.$config["background"].'\') no-repeat center center fixed !important; -webkit-background-size: cover !important;-moz-background-size: cover !important;-o-background-size: cover !important; background-size: cover !important; }';
$html_tags .= '.well h1 {font-weight:600;font-family:Anton;font-size:48px;}';
$html_tags .= '.content-header h1 {font-size:32px;font-family:Anton;}';
$html_tags .= '.login-logo img {width: 100px;height: 100px;}';
$html_tags .= '.login-logo a, .register-logo a {color: #fff;text-shadow: 1px 1px 1px #333;-webkit-text-shadow: 1px 1px 1px #333;-moz-text-shadow: 1px 1px 1px #333;-o-text-shadow: 1px 1px 1px #333;}';
$html_tags .= 'hr {border-top: 1px solid #ddd;}';
$html_tags .= '.bootstrap-tagsinput{display: block !important;border-radius: 0 !important;}';
$html_tags .= '</style>';
$html_tags .= '</head>';
$html_tags .= '<body class="'.$body_class.'">';
$html_tags .= $content ;
$html_tags .= '<script src="https://cdn.jsdelivr.net/npm/jquery@3/dist/jquery.min.js"></script>';
$html_tags .= '<script src="https://cdn.jsdelivr.net/npm/bootstrap@3/dist/js/bootstrap.min.js"></script>';
$html_tags .= '<script src="https://cdn.jsdelivr.net/npm/bootstrap-tagsinput@0.7.1/dist/bootstrap-tagsinput.min.js"></script>';
$html_tags .= '<script src="https://cdn.jsdelivr.net/npm/datatables.net@1/js/jquery.dataTables.min.js"></script>';
$html_tags .= '<script src="https://cdn.jsdelivr.net/npm/datatables.net-bs@1/js/dataTables.bootstrap.min.js"></script>';
$html_tags .= '<script src="https://cdn.jsdelivr.net/npm/ckeditor@4/ckeditor.js"></script>';
$html_tags .= '<script src="https://cdn.jsdelivr.net/npm/ckeditor@4/adapters/jquery.js"></script>';
$html_tags .= '<script src="https://cdn.jsdelivr.net/npm/moment@2/moment.min.js"></script>';
$html_tags .= '<script src="https://cdn.jsdelivr.net/npm/eonasdan-bootstrap-datetimepicker@4/build/js/bootstrap-datetimepicker.min.js"></script>';
$html_tags .= '<script src="https://cdn.jsdelivr.net/npm/icheck@1/icheck.min.js"></script>';
$html_tags .= '<script src="https://cdn.jsdelivr.net/npm/admin-lte@2/dist/js/adminlte.min.js"></script>';
$html_tags .= '<script>';
$html_tags .= '$(document).ready(function(){';
$html_tags .= '$(".delete").on("click",function(){ var target = $(this).attr("data-target") ;$(target).replaceWith(""); });';
$html_tags .= '$(".sidebar-menu").tree();';
$html_tags .= '$(".datatable").length && $(".datatable").dataTable({"order":[[0,"desc"]]});';
$html_tags .= '$("textarea[data-type=\'html5\']").length && $("textarea[data-type=\'html5\']").ckeditor({filebrowserBrowseUrl:"?page=file-browser"});';
$html_tags .= '$("input[data-type=\'tags\']").length && $("input[data-type=\'tags\']").tagsinput();';
$html_tags .= '$("input[data-type=\'date\']").length && $("input[data-type=\'date\']").datetimepicker({format:\'YYYY-MM-DD\'});';
$html_tags .= '$("input[data-type=\'datetime\']").length && $("input[data-type=\'datetime\']").datetimepicker({format:"YYYY-MM-DD HH:mm:ss"});';
$html_tags .= '$("input[data-type=\'time\']").length && $("input[data-type=\'time\']").datetimepicker({format:"HH:mm:ss"});';
$html_tags .= '$("input[type=\'radio\'].flat-red").length && $("input[type=\'radio\'].flat-red").iCheck({checkboxClass:"icheckbox_flat-red",radioClass:"iradio_flat-red"});';
$html_tags .= 'var fileBrowserTarget="undefined";window.fileBrowser={callBack:function(a){$(fileBrowserTarget).val(a)},open:function(a){var b=window.open("?page=file-browser","File Browser","scrollbars=no, width=1028, height=480, top="+((window.innerHeight?window.innerHeight:document.documentElement.clientHeight?document.documentElement.clientHeight:screen.height)/2-240+(void 0!=window.screenTop?window.screenTop:window.screenY))+", left="+((window.innerWidth?window.innerWidth:document.documentElement.clientWidth?document.documentElement.clientWidth:screen.width)/2-514+(void 0!=window.screenLeft?window.screenLeft:window.screenX)));fileBrowserTarget=a;window.focus&&b.focus()}};if($(\'*[data-type="file-picker"]\').length)$(\'*[data-type="file-picker"]\').on("click",function(){var a=$(this).attr("data-target");fileBrowser.open(a);return!1});';
$html_tags .= '});';
$html_tags .= 'function doModal(a,l,d,m,t){html=\'<div id="dynamicModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="confirm-modal" aria-hidden="true">\',html+=\'<div class="modal-dialog">\',html+=\'<div class="modal-content">\',html+=\'<div class="modal-header">\',html+=\'<a class="close" data-dismiss="modal">&times;</a>\',html+="<h4 class=\"modal-title\">"+a+"</h4>",html+="</div>",html+=\'<div class="modal-body">\',html+=l,html+="</div>",html+=\'<div class="modal-footer">\',""!=d&&(html+=\'<span class="btn btn-flat btn-\'+m+\'" onClick="\'+t+\'">\'+d+"</span>"),html+=\'<span class="btn btn-default btn-flat pull-left" data-dismiss="modal">Cancel</span>\',html+="</div>",html+="</div>",html+="</div>",html+="</div>",$("body").append(html),$("#dynamicModal").modal(),$("#dynamicModal").modal("show"),$("#dynamicModal").on("hidden.bs.modal",function(a){$(this).remove()})}';
$html_tags .= 'setTimeout(function(){$("#notification").fadeOut()},5e3);';
$html_tags .= '</script>';
$html_tags .= '</body>';
$html_tags .= '</html>';
echo $html_tags;
