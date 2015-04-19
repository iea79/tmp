<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Debug\Debug;

// If you don't want to setup permissions the proper way, just uncomment the following PHP line
// read http://symfony.com/doc/current/book/installation.html#configuration-and-setup for more information
//umask(0000);

// This check prevents access to debug front controllers that are deployed by accident to production servers.
// Feel free to remove this, extend it, or make something more sophisticated.
if ((isset($_SERVER['HTTP_CLIENT_IP'])
    || isset($_SERVER['HTTP_X_FORWARDED_FOR'])
    || !(in_array(@$_SERVER['REMOTE_ADDR'], array('127.0.0.1'
        , '80.64.90.73'//home Nickolay
        , '77.91.130.82'//work Nickolay
        , '10.240.35.8' //cloud9
        , '81.198.90.13' //dima
        , '37.151.110.103' //elena kontent
        , '95.71.81.69' //elena 
        , '93.100.166.25' //elena verst
        , '62.16.43.150' //evgeny ivanov
        , '89.209.11.134' //vasya
        , '185.43.248.214' //aleksey
        , '84.83.255.2' //Alla
        , '109.68.173.20' //evgeniy voronov
        , '95.111.150.84' //Дарья
        , '83.69.244.205' //Олеся PR
        , '109.87.88.65' //Алексей Гловлюк 
        , '37.133.94.37' //Evgeny April (Barcelona)
        , '93.117.143.157' //kontent manager
        , '2.135.194.139' //Elena Ilyna
       , 'fe80::1', '::1')) || php_sapi_name() === 'cli-server') ) && !getenv("C9_PROJECT")
) {
    header('HTTP/1.0 403 Forbidden');
    exit('You are not allowed to access this file. Check '.basename(__FILE__).' for more information.');
}

$loader = require_once __DIR__.'/../app/bootstrap.php.cache';
Debug::enable();

require_once __DIR__.'/../app/AppKernel.php';

$kernel = new AppKernel('dev', true);
//$kernel->loadClassCache();
$request = Request::createFromGlobals();
$response = $kernel->handle($request);
$response->send();
$kernel->terminate($request, $response);
