<?php
require('./app/models/Imovel.php');
class ImovelController
{
    use AutenticacaoTrait;
    use ViewTrait;

    public function verDetalhes($id)
    {
    
    $imovel = new Imovel();

    $detalhesImovel = $imovel->buscarEntityImovel($id);

    $this->view('Imovel', ['imovel' => $detalhesImovel[0]]);
    }

    public function listar()
    {
        $this->autenticarLogin();
        $imovel = new Imovel();
        $this->view('listaImovel', $imovel->listar());
    }

    public function cadastrar()
    {

        $this->autenticarLogin();
        $imovel = new Imovel();
        $this->view('cadastroImovel', $imovel->buscarProprietarios());
    }

    public function realizarCadastro()
    {
        session_start();

        $imovel = new Imovel();

        $imovel->tipo_imovel = $_POST['tipo_imovel'];
        $imovel->tipo_contrato = $_POST['tipo_contrato'];
        $imovel->cep = $_POST['cep'];
        $imovel->rua = $_POST['rua'];
        $imovel->bairro = $_POST['bairro'];
        $imovel->numero = $_POST['numEndereco'];
        $imovel->cidade = $_POST['cidade'];
        $imovel->estado = $_POST['estado'];
        $imovel->valor = $_POST['valor'];
        $imovel->condominio = $_POST['condominio'];
        $imovel->area_total = $_POST['area_total'];
        $imovel->dormitorios = $_POST['dormitorios'];
        $imovel->banheiros = $_POST['banheiros'];
        $imovel->garagem = $_POST['garagem'];
        $imovel->proprietario = $_POST['proprietario'];
        $imovel->chave_disponivel = true;
        $imovel->imovel_disponivel = true;
        $_POST['validado'] = $imovel->inserir();

        $this->view('cadastroImovel');
    }

    public function editar()
    {
        $imovel = new Imovel();
        $this->autenticarLogin();
        $this->view('editarImovel', [$imovel->buscarEntityImovel($_GET['editar']), $imovel->buscarProprietarios()]);
    }

    public function salvarEdicao() {
        session_start();

        $imovel = new Imovel();
        if (!empty($_POST['cep']) && ($this->validarNumero($_POST['cep']) || strlen($_POST['cep']) != 8)) {
            $_POST['erro'] = true;
            $_POST['cep'] = '';
        } else {
            $imovel->tipo_imovel = $_POST['tipo_imovel'];
            $imovel->tipo_contrato = $_POST['tipo_contrato'];
            $imovel->cep = $_POST['cep'];
            $imovel->rua = $_POST['rua'];
            $imovel->bairro = $_POST['bairro'];
            $imovel->numero = $_POST['numEndereco'];
            $imovel->cidade = $_POST['cidade'];
            $imovel->estado = $_POST['estado'];
            $imovel->valor = $_POST['valor'];
            $imovel->condominio = $_POST['condominio'];
            $imovel->area_total = $_POST['area_total'];
            $imovel->dormitorios = $_POST['dormitorios'];
            $imovel->banheiros = $_POST['banheiros'];
            $imovel->garagem = $_POST['garagem'];
            $imovel->proprietario = $_POST['proprietario'];
            $_POST['validado'] = $imovel->editar($_SESSION['id_imovel']);
        }

        $this->view('editarImovel');
    }

    public function excluir()
    {
        $this->autenticarLogin();
        $this->view('excluirImovel');
    }

    public function realizarExclusao()
    {
        session_start();
        $imovel = new Imovel();
        if ($imovel->validarId($_POST['imovelExcluir'])) {
            $_POST['validado'] = $imovel->excluir($_POST['imovelExcluir']);
        } else {
            $_POST['erro'] = true;
        }
        $this->view('excluirImovel');
    }

    private function validarNumero($variavel)
    {
        if (str_contains($variavel, "e") || str_contains($variavel, "E")) {
            return true;
        }
        return false;
    }
// No ImovelController.php

}
