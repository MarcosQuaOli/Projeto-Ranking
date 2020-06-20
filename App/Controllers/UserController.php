<?php

namespace App\Controllers;

use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

use App\Models\User;
use App\DAO\UserDAO;

class UserController {
    
    protected $container;

    // constructor receives container instance
    public function __construct(ContainerInterface $container) {
        $this->container = $container;
    }

    public function login(Request $request, Response $response, $args) {  
        
        $renderer = render();
        
        return $renderer->render($response, "user/login.phtml");

    }

    public function register(Request $request, Response $response, $args) {        
        
        $renderer = render();
        
        return $renderer->render($response, "user/register.phtml");

    }

    public function auth(Request $request, Response $response, $args) {        
        
        $params = $request->getParsedBody();

        $userDAO = new UserDAO();
        $user = new User();

        $user->__set('email', $params['email']);
        $user->__set('senha', md5($params['senha']));

        $userAuth = $userDAO->getUser($user);

        if(count($userAuth) > 0) {

            $_SESSION['autenticado'] = true;
            $_SESSION['user_id'] = $userAuth[0]->id;
            
            return $response->withRedirect('/categoria/home');

        } else {

            return $response->withRedirect('/?erro=email');

        }

    }

    public function store(Request $request, Response $response, $args) {        
        
        $params = $request->getParsedBody();

        $userDAO = new UserDAO();        

        if($params['senha'] == $params['confirm-senha']) {

            foreach($userDAO->getEmail() as $user) {

                if($user->email == $params['email']) {

                    return $response->withRedirect('/user/register?erro=email');

                }

            }

            $user = new User();

            $user->__set('email', $params['email']);
            $user->__set('nome', $params['nome']);
            $user->__set('senha', md5($params['senha']));

            $userDAO->insert($user);

            return $response->withRedirect('/');
            
        } else {

            return $response->withRedirect('/user/register?erro=senha');

        }


    }

    public function logout(Request $request, Response $response, $args) {  

        session_start();
        session_unset();
        session_destroy();
        
        return $response->withRedirect('/');

    }
}