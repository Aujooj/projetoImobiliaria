<?php
require('./app/models/Produto.php');
class ProdutoController
{
    use AutenticacaoTrait;
    use ViewTrait;

    public function listar()
    {
        $this->autenticarLogin();
        $produto = new Produto();
        $this->view('listaProduto', $produto->listar());
    }

    public function cadastrar()
    {
        $this->autenticarLogin();
        $this->view('cadastroProduto');
    }

    public function realizarCadastro()
    {
        session_start();

        $produto = new Produto();

        $produto->tipo = $_POST['tipo'];
        $produto->marca = $_POST['marca'];
        $produto->armazenamento = $_POST['armazenamento'];
        $produto->ram = $_POST['ram'];
        $produto->descricao = $_POST['descricao'];
        $produto->preco = $_POST['preco'];
        $produto->quantidade = $_POST['quantidade'];
        $produto->processador = $_POST['processador'];
        $_POST['validado'] = $produto->inserir();

        $this->view('cadastroProduto');
    }

    public function excluir()
    {
        $this->autenticarLogin();
        $this->view('excluirProduto');
    }

    public function realizarExclusao()
    {
        session_start();
        $produto = new Produto();
        if ($produto->validarCod($_POST['codProduto'])) {
            $_POST['validado'] = $produto->excluir($_POST['codProduto']);
        } else {
            $_POST['erro'] = true;
        }
        $this->view('excluirProduto');
    }
}
