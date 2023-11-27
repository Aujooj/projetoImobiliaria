<?php
require 'vendor/autoload.php';

use Pecee\SimpleRouter\SimpleRouter as Router;

Router::get('/', 'HomeController@paginainIcial');
Router::get('/login', 'HomeController@index');
Router::post('/login', 'CorretorController@validacaoLogin');
Router::get('/home', 'HomeController@home');
Router::get('/sair', 'HomeController@sair');

Router::get('/imoveis', 'ImovelController@listar');
Router::get('/imovel-cadastrar', 'ImovelController@cadastrar');
Router::post('/imovel-cadastrar', 'ImovelController@realizarCadastro');
Router::get('/imovel-editar', 'ImovelController@editar');
Router::post('/imovel-editar', 'ImovelController@salvarEdicao');
Router::get('/imovel-excluir', 'ImovelController@excluir');
Router::post('/imovel-excluir', 'ImovelController@realizarExclusao');
Router::get('/imovel/{id}', 'ImovelController@verDetalhes');

Router::get('/clientes', 'ClienteController@listar');
Router::get('/cliente-cadastrar', 'ClienteController@cadastrar');
Router::post('/cliente-cadastrar', 'ClienteController@validarCadastro');
Router::get('/cliente-editar', 'ClienteController@editar');
Router::post('/cliente-editar', 'ClienteController@salvarEdicao');
Router::get('/cliente-excluir', 'ClienteController@excluir');
Router::post('/cliente-excluir', 'ClienteController@realizarExclusao');

Router::get('/corretor', 'CorretorController@listar');
Router::get('/corretor-cadastrar', 'CorretorController@cadastrar');
Router::post('/corretor-cadastrar', 'CorretorController@validarCadastro');
Router::get('/corretor-editar', 'CorretorController@editar');
Router::post('/corretor-editar', 'CorretorController@salvarEdicao');
Router::get('/corretor-excluir', 'CorretorController@excluir');
Router::post('/corretor-excluir', 'CorretorController@realizarExclusao');

Router::get('/contratos', 'ContratoController@listar');
Router::get('/contrato-cadastrar/{id}', 'ContratoController@cadastrar');
Router::post('/contrato-cadastrar', 'ContratoController@validarCadastro');
Router::post('/contrato-assinar', 'ContratoController@assinar');

Router::get('/visitas', 'VisitaController@listar');
Router::get('/visita-cadastrar/{id}', 'VisitaController@cadastrar');
Router::post('/visita-cadastrar', 'VisitaController@validarCadastro');
Router::get('/visita-devolver/{id}', 'VisitaController@devolver');


try {
    Router::start();
} catch (Pecee\SimpleRouter\Exceptions\NotFoundHttpException $e) {
    require('./app/views/layout/404.view.php');
}
