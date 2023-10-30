<?php
require 'vendor/autoload.php';

use Pecee\SimpleRouter\SimpleRouter as Router;

Router::get('/', 'HomeController@index');
Router::post('/', 'CorretorController@validacaoLogin');
Router::get('/home', 'HomeController@home');
Router::get('/sair', 'HomeController@sair');

Router::get('/produto-listar', 'ProdutoController@listar');
Router::get('/produto-cadastrar', 'ProdutoController@cadastrar');
Router::post('/produto-cadastrar', 'ProdutoController@realizarCadastro');
Router::get('/produto-excluir', 'ProdutoController@excluir');
Router::post('/produto-excluir', 'ProdutoController@realizarExclusao');

Router::get('/cliente-listar', 'ClienteController@listar');
Router::get('/cliente-cadastrar', 'ClienteController@cadastrar');
Router::post('/cliente-cadastrar', 'ClienteController@validarCadastro');
Router::get('/cliente-excluir', 'ClienteController@excluir');
Router::post('/cliente-excluir', 'ClienteController@realizarExclusao');

Router::get('/corretor', 'CorretorController@listar');
Router::get('/corretor-cadastrar', 'CorretorController@cadastrar');
Router::post('/corretor-cadastrar', 'CorretorController@validarCadastro');
Router::get('/corretor-editar', 'CorretorController@editar');
Router::post('/corretor-editar', 'CorretorController@salvarEdicao');
Router::get('/corretor-excluir', 'CorretorController@excluir');
Router::post('/corretor-excluir', 'CorretorController@realizarExclusao');

try {
    Router::start();
} catch (Pecee\SimpleRouter\Exceptions\NotFoundHttpException $e) {
    require('./app/views/layout/404.view.php');
}
