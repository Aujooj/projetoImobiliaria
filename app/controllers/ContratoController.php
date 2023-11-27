<?php
require('./app/models/Contrato.php');

class ContratoController
{
    use AutenticacaoTrait;
    use ViewTrait;

    public function listar()
    {
        $this->autenticarLogin();

        $contrato = new Contrato();

        $this->view('listaContrato', $contrato->listar());
    }

    // ContratoController.php

    public function cadastrar($id)
    {
        $contrato = new Contrato();
        $this->autenticarLogin();

        // Verifica se foi passado o ID do imóvel
        if ($id) {
            $this->view('cadastroContrato', ['idImovel' => $id, 'clientes' => $contrato->buscarProprietarios()]);
        } else {
            // Redireciona para a página de lista de contratos se não houver ID do imóvel
            header('Location: /lista-contrato');
            exit();
        }
    }




    public function validarCadastro()
{
    session_start();

    $contrato = new Contrato();
    $imovel = new Imovel();

    $contrato->tipo = $_POST['tipo'];
    $contrato->data_inicial = $_POST['dataInicial'];
    $contrato->data_final = $_POST['dataFinal'];
    $contrato->inquilino = $_POST['inquilino'];
    $contrato->id_imovel = $_POST['id_imovel'];
    $contrato->assinado = false;

    $_POST['validado'] = $contrato->inserir();

    $imovel->indisponibilizar($_POST['id_imovel']);


    $this->view('cadastroContrato');
}


    public function editar()
    {
        $contrato = new Contrato();
        $this->autenticarLogin();
        $this->view('editarContrato', $contrato->buscarEntityContrato($_GET['editar']));
    }

    public function salvarEdicao()
    {
        session_start();

        $contrato = new Contrato();

        // Adicione validações específicas para o contrato, se necessário

        $contrato->tipo = $_POST['tipo'];
        $contrato->data_inicial = $_POST['dataInicial'];
        $contrato->data_final = $_POST['dataFinal'];
        $contrato->inquilino = $_POST['inquilino'];
        $contrato->id_imovel = $_POST['idImovel'];

        $_POST['validado'] = $contrato->editar($_SESSION['id_contrato']);

        $this->view('editarContrato');
    }

    public function assinar(){
        $contrato = new Contrato();
        
        $contrato->assinar($_POST['id_contrato']);

        header('Location: /contratos');
    }

    public function excluir()
    {
        $this->autenticarLogin();
        $this->view('excluirContrato');
    }

    public function realizarExclusao()
    {
        session_start();
        $contrato = new Contrato();

        // Adicione validações específicas para o contrato, se necessário

        $_POST['validado'] = $contrato->excluir($_POST['idContrato']);

        $this->view('excluirContrato');
    }
}
