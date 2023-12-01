<?php
use app\Core\Application;
use app\Core\Container;


$container = new Container();

$container->register('app\Core\Database', function () {
  return new \app\Core\Database();
});

Application::setContainer($container);


$container->register('app\Core\Request', function () {
  return new \app\Core\Request();
});

Application::setContainer($container);


$container->register('app\Core\Response', function () {
  return new \app\Core\Response();
});

Application::setContainer($container);


$container->register('app\Core\Session', function () {
  return new \app\Core\Session();
});

Application::setContainer($container);