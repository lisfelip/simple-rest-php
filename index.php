<?php

	require "vendor/autoload.php";

	use \Psr\Http\Message\ServerRequestInterface as Request;
	use \Psr\Http\Message\ResponseInterface as Response;
	use \Illuminate\Database\Capsule\Manager as DBManager;
	use \Illuminate\Database\Eloquent\Model;

	/*
	# EXAMPLE DATABASE CONNECTION
	$manager = new DBManager;
	$manager->addConnection(array(
		"driver" => "mysql",
		"host" => "localhost",
		"database" => "library",
		"username" => "root",
		"password" => "",
		"charset" => "utf8",
		"collation" => "utf8_unicode_ci",
		"prefix" =>""
	));
	$manager->bootEloquent();
	*/

	/*
	# EXAMPLE DATABASE "FIND BY ID"
	class User extends Model {
		protected $table = "user";
	}
	$user = User::find(1);
	print_r($user);
	*/

	$c = new \Slim\Container();

	$c["notFoundHandler"] = function ($c) {
	    return function ($req, $res) use ($c) {
	        return $c["response"]->withRedirect($c["request"]->getUri()->getBasePath());
	    };
	};

	$app = new \Slim\App($c);

	$app->add(function($req, $res, $next) {
		$res = $res
			->withAddedHeader("Content-type", "application/json;utf-8")
			->withAddedHeader("Access-Control-Allow-Origin", "*");
		return $next($req, $res);
	});

	$app->get("/", "index");

	function index($req, $res) {
	    $res->write("{\"success\": true}");
	    return $res;
	}

	$app->run();
	
?>