<?php

namespace App\Controllers;

use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

use App\Models\Categoria;
use App\DAO\CategoriaDAO;

use App\Models\Item;
use App\DAO\ItemDAO;

class CategoriaController {

    protected $container;

    // constructor receives container instance
    public function __construct(ContainerInterface $container) {
        $this->container = $container;
    }

    public function index(Request $request, Response $response) {
        
        if(autentica() == false) return $response->withRedirect('/');

        $renderer = render();

        $categoriaDAO = new CategoriaDAO();
        $itemDAO = new ItemDAO();
        
        $dados_categoria = $categoriaDAO->getAll();
        $dados_item = $itemDAO->getAll();
        
        return $renderer->render($response, "home.phtml", [
            'categoria' => $dados_categoria,
            'itens' => $dados_item
        ]);

    }

    public function show(Request $request, Response $response) {

        if(autentica() == false) return $response->withRedirect('/');

        $renderer = render();

        $categoriaDAO = new CategoriaDAO();
        $itemDAO = new ItemDAO();

        $dados_categoria = $categoriaDAO->show($_GET['id']);

        $dados_item = $itemDAO->show($_GET['id']);
        
        return $renderer->render($response, "categoria/ranking.phtml", [
            'categoria' => $dados_categoria,
            'itens' => $dados_item
        ]);

    }

    public function create(Request $request, Response $response) {

        if(autentica() == false) return $response->withRedirect('/');

        $renderer = render();
        
        return $renderer->render($response, "categoria/ranking-create.phtml");

    }

    public function edit() {

    }

    public function store(Request $request, Response $response) {

        $params = $request->getParsedBody();

        $categoriaDAO = new CategoriaDAO();
        $categoria = new Categoria();

        $categoria->__set('nome_categoria', $params['categoria']);

        $categoriaDAO->insert($categoria);

        return $response->withRedirect('/categoria/home');

    }

}