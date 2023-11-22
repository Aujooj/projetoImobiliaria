<?php
require('./app/models/Cliente.php');

use JC\BrDocs\BrDoc;

class ClienteController
{
    use AutenticacaoTrait;
    use ViewTrait;

    public function listar()
    {
        $this->autenticarLogin();

        $cliente = new Cliente();

        $this->view('listaCliente', $cliente->listar());
    }

    public function cadastrar()
    {
        $this->autenticarLogin();
        $this->view('cadastroCliente');
    }

    public function validarCadastro()
    {
        session_start();

        $cliente = new Cliente();

        if (!BrDoc::cpf($_POST['cpf'])->isValid() || $cliente->validarCpf(BrDoc::cpf($_POST['cpf'])->format()->get())) {
            $_POST['erro'] = true;
            $_POST['cpf'] = '';
        } elseif (!empty($_POST['numTelefone']) && ($this->validarNumero($_POST['numTelefone'])
            || ((strcmp($_POST['tipoTelefone'], "Celular") == 0 && strlen($_POST['numTelefone']) != 11)
                ||  (strcmp($_POST['tipoTelefone'], "Residencial") == 0 && strlen($_POST['numTelefone']) != 10)))) {
            $_POST['erro'] = true;
            $_POST['numTelefone'] = '';
        } elseif (!empty($_POST['cep']) && ($this->validarNumero($_POST['cep']) || strlen($_POST['cep']) != 8)) {
            $_POST['erro'] = true;
            $_POST['cep'] = '';
        } else {

            $cliente->cpf = BrDoc::cpf($_POST['cpf'])->format()->get();
            $cliente->data_nasc = $_POST['dataNascimento'];
            $cliente->nome = $_POST['nome'];
            $cliente->telefone = $_POST['numTelefone'];
            $cliente->email = $_POST['email'];
            $cliente->cep = $_POST['cep'];
            $cliente->rua = $_POST['rua'];
            $cliente->bairro = $_POST['bairro'];
            $cliente->numero = $_POST['numEndereco'];
            $cliente->cidade = $_POST['cidade'];
            $cliente->estado = $_POST['estado'];
            $_POST['validado'] = $cliente->inserir();
        }
        $this->view('cadastroCliente');
    }

    public function editar()
    {
        $cliente = new Cliente();
        $this->autenticarLogin();
        $this->view('editarCliente', $cliente->buscarEntityCliente($_GET['editar']));
    }

    public function salvarEdicao() {
        session_start();

        $cliente = new Cliente();
        if (!BrDoc::cpf($_POST['cpf'])->isValid() || !$cliente->validarCpf(BrDoc::cpf($_POST['cpf'])->format()->get())) {
            
            $_POST['erro'] = true;
            $_POST['cpf'] = '';
        } elseif (!empty($_POST['numTelefone']) && ($this->validarNumero($_POST['numTelefone'])
            || ((strcmp($_POST['tipoTelefone'], "Celular") == 0 && strlen($_POST['numTelefone']) != 11)
                ||  (strcmp($_POST['tipoTelefone'], "Residencial") == 0 && strlen($_POST['numTelefone']) != 10)))) {
                    $_POST['erro'] = true;
            $_POST['numTelefone'] = '';
        } elseif (!empty($_POST['cep']) && ($this->validarNumero($_POST['cep']) || strlen($_POST['cep']) != 8)) {
            $_POST['erro'] = true;
            $_POST['cep'] = '';
        } else {
            $cliente->cpf = BrDoc::cpf($_POST['cpf'])->format()->get();
            $cliente->data_nasc = $_POST['dataNascimento'];
            $cliente->nome = $_POST['nome'];
            $cliente->telefone = $_POST['numTelefone'];
            $cliente->email = $_POST['email'];
            $cliente->cep = $_POST['cep'];
            $cliente->rua = $_POST['rua'];
            $cliente->bairro = $_POST['bairro'];
            $cliente->numero = $_POST['numEndereco'];
            $cliente->cidade = $_POST['cidade'];
            $cliente->estado = $_POST['estado'];
            $_POST['validado'] = $cliente->editar($_SESSION['id_cliente']);
            
        }

        $this->view('editarCorretor');
    }

    public function excluir()
    {
        $this->autenticarLogin();
        $this->view('excluirCliente');
    }

    public function realizarExclusao()
    {
        session_start();
        $cliente = new Cliente();
        if (
            BrDoc::cpf($_POST['cpfExcluir'])->isValid()
            && $cliente->validarCpf((BrDoc::cpf($_POST['cpfExcluir'])->format()->get()))
        ) {
            $_POST['validado'] = $cliente->excluir((BrDoc::cpf($_POST['cpfExcluir'])->format()->get()));
        } else {
            $_POST['erro'] = true;
        }
        $this->view('excluirCliente');
    }

    private function validarNumero($variavel)
    {
        if (str_contains($variavel, "e") || str_contains($variavel, "E")) {
            return true;
        }
        return false;
    }
}
