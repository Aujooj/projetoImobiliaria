<?php
require('./app/models/Imovel.php');
class ImovelController
{
    use AutenticacaoTrait;
    use ViewTrait;

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

        $imovel->tipo = $_POST['tipo'];
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
        $_POST['validado'] = $imovel->inserir();

        $this->view('cadastroImovel');
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
        if ($imovel->validarCod($_POST['codImovel'])) {
            $_POST['validado'] = $imovel->excluir($_POST['codImovel']);
        } else {
            $_POST['erro'] = true;
        }
        $this->view('excluirImovel');
    }
}
