<?php

use Slim\App;
use Slim\Routing\RouteCollectorProxy;

use App\Controllers\HomeController;
use App\Controllers\UserController;
use App\Controllers\CategoriaController;
use App\Controllers\ItemController;

use Slim\Views\PhpRenderer;

return function (App $app, $settings) {
    
    $app->get('/', [UserController::class, 'login']);    

    $app->group('/user', function (RouteCollectorProxy $group) {

        $group->get('/register', [UserController::class, 'register']);

        $group->get('/logout', [UserController::class, 'logout']);
        
        $group->post('/store', [UserController::class, 'store']);
        
        $group->post('/auth', [UserController::class, 'auth']);

    });

    $app->group('/categoria', function (RouteCollectorProxy $group) {

        $group->get('/home', [CategoriaController::class, 'index']);

        $group->get('', [CategoriaController::class, 'show']);

        $group->get('/create', [CategoriaController::class, 'create']);

        $group->get('/edit', [CategoriaController::class, 'edit']);
        
        $group->post('/store', [CategoriaController::class, 'store']);

    });

    $app->group('/item', function (RouteCollectorProxy $group) {

        $group->get('/create', [ItemController::class, 'create']);
        
        $group->get('/delete', [ItemController::class, 'destroy']);
        
        $group->get('/update', [ItemController::class, 'update']);

        $group->post('/store', [ItemController::class, 'store']);        

    });

    function autentica() {
        
        if(isset($_SESSION['autenticado']) && $_SESSION['autenticado'] == true) {

            return true;

        } else {

            return false;

        }

    }

    function render() {

        $path = dirname(__DIR__) . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . 'views';

        $renderer = new PhpRenderer($path);

        $renderer->setLayout('/layouts/main.phtml');

        return $renderer;   

    }
}

?>