<?php
    $url = 'http://erp.com.br/erp/';

    $urlBase = $_SERVER['REQUEST_URI'];
    session_name('erp');
    session_start();
    
    
    $route = explode('/',$urlBase);
    
    //var_dump($route);