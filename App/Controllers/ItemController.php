<?php

namespace App\Controllers;

use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

use App\Models\Categoria;
use App\DAO\CategoriaDAO;

use App\Models\Item;
use App\DAO\ItemDAO;

class ItemController {

    protected $container;

    // constructor receives container instance
    public function __construct(ContainerInterface $container) {
        $this->container = $container;
    }

    public function create(Request $request, Response $response) {
        
        if(autentica() == false) return $response->withRedirect('/');

        $renderer = render();
        
        return $renderer->render($response, "item/item-create.phtml", [
            'id' => $_GET['id']
        ]);

    }

    public function update(Request $request, Response $response) {

        $itemDAO = new ItemDAO();
        $item = new Item();

        $posicaoTarget = $_GET['posicao'];

        if($_GET['direction'] == 'up') {
            $posicaoTarget -= 1;
        } else {
            $posicaoTarget += 1;
        }

        $item->__set('id', $_GET['id']);
        $item->__set('categoria_id', $_GET['categoria_id']);
        $item->__set('posicao', $_GET['posicao']);

        $itemDAO->update($item, $posicaoTarget);

        return $response->withRedirect('/categoria?id='. $_GET['categoria_id']);

    }

    public function store(Request $request, Response $response) {
        
        $params = $request->getParsedBody();

        $itemDAO = new ItemDAO();
        $item = new Item();

        $total = (count($itemDAO->show($_GET['id'])) + 1);

        $item->__set('nome', $params['item']);
        $item->__set('categoria_id', $_GET['id']);
        $item->__set('posicao', $total);

        $itemDAO->insert($item);

        return $response->withRedirect('/categoria?id='. $_GET['id']);

    }

    public function destroy(Request $request, Response $response, $args) {

        $itemDAO = new ItemDAO();
        $item = new Item();

        $item->__set('id', $_GET['id']);

        $itemDAO->delete($item);

        return $response->withRedirect('/categoria?id=' . $_GET['id_categoria']);

    }
}