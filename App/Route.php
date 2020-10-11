<?php

namespace App;

use CRUD\Init\Bootstrap;

class Route extends Bootstrap {

    protected function initRoutes() {
        $routes['home'] = array(
            'route' => '/',
            'controller' => 'indexController',
            'action' => 'index'
        );

        $routes['cadastrar'] = array(
            'route' => '/cadastrar',
            'controller' => 'indexController',
            'action' => 'cadastrar'
        );

        $routes['registrar'] = array(
            'route' => '/registrar',
            'controller' => 'indexController',
            'action' => 'registrar'
        );

        $routes['busca'] = array(
            'route' => '/busca',
            'controller' => 'indexController',
            'action' => 'busca'
        );

        $routes['consulta'] = array(
            'route' => '/consulta',
            'controller' => 'indexController',
            'action' => 'consulta'
        );

        $this->setRoutes($routes);
    }
}