<?php

	use \Psr\Http\Message\ServerRequestInterface as Request;
	use \Psr\Http\Message\ResponseInterface as Response;

	require "vendor/autoload.php";

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