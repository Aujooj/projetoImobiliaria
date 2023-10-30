<?php
require('./app/models/Corretor.php');

use JC\BrDocs\BrDoc;

class CorretorController
{
    use AutenticacaoTrait;
    use EncryptTrait;
    use ViewTrait;

    public function listar()
    {
        $this->autenticarLogin();

        $corretor = new Corretor();

        $this->view('listaCorretor', $corretor->listar());
    }

    public function cadastrar()
    {
        $this->autenticarLogin();
        $this->view('cadastroCorretor');
    }

    public function validarCadastro()
    {
        session_start();

        $encriptadorSenha = $this->prepararEncriptador();
        $corretor = new Corretor();

        if (!empty($_POST['numTelefone']) && ($this->validarNumero($_POST['numTelefone'])
            || ((strcmp($_POST['tipoTelefone'], "Celular") == 0 && strlen($_POST['numTelefone']) != 11)
                ||  (strcmp($_POST['tipoTelefone'], "Residencial") == 0 && strlen($_POST['numTelefone']) != 10)))) {
            $_POST['erro'] = true;
            $_POST['numTelefone'] = '';
        } elseif (
            !empty($_POST['senha']) && !empty($_POST['confirmarSenha'])
            && strcmp($_POST['senha'], $_POST['confirmarSenha']) != 0
        ) {
            $_POST['erro'] = true;
            $_POST['senha'] = '';
            $_POST['confirmarSenha'] = '';
        } else {
            $corretor->creci = $_POST['creci'];
            $corretor->senha = $encriptadorSenha->hash($_POST['senha']);
            $corretor->data_nasc = $_POST['dataNascimento'];
            $corretor->nome = $_POST['nome'];
            $corretor->telefone = $_POST['numTelefone'];
            $corretor->email = $_POST['email'];
            $_POST['validado'] = $corretor->inserir();
        }

        $this->view('cadastroCorretor');
    }

    public function editar()
    {
        $corretor = new Corretor();
        $this->autenticarLogin();
        $this->view('editarCorretor', $corretor->buscarEntityCorretor($_GET['editar']));
    }

    public function salvarEdicao() {
        session_start();

        $encriptadorSenha = $this->prepararEncriptador();
        $corretor = new Corretor();

        if (!empty($_POST['numTelefone']) && ($this->validarNumero($_POST['numTelefone'])
            || ((strcmp($_POST['tipoTelefone'], "Celular") == 0 && strlen($_POST['numTelefone']) != 11)
                ||  (strcmp($_POST['tipoTelefone'], "Residencial") == 0 && strlen($_POST['numTelefone']) != 10)))) {
            $_POST['erro'] = true;
            $_POST['numTelefone'] = '';
        } elseif (
            !empty($_POST['senha']) && !empty($_POST['confirmarSenha'])
            && strcmp($_POST['senha'], $_POST['confirmarSenha']) != 0
        ) {
            $_POST['erro'] = true;
            $_POST['senha'] = '';
            $_POST['confirmarSenha'] = '';
        } else {
            $corretor->creci = $_POST['creci'];
            $corretor->senha = $encriptadorSenha->hash($_POST['senha']);
            if ($corretor->buscarCorretor($encriptadorSenha)) {
                $_POST['erro'] = true;
            } else {
                $corretor->data_nasc = $_POST['dataNascimento'];
                $corretor->nome = $_POST['nome'];
                $corretor->telefone = $_POST['numTelefone'];
                $corretor->email = $_POST['email'];
                $_POST['validado'] = $corretor->editar($_SESSION['id_corretor']);
            }
        }

        $this->view('editarCorretor');
    }

    public function excluir()
    {
        $this->autenticarLogin();
        $this->view('excluirCorretor');
    }

    public function realizarExclusao()
    {
        $corretor = new Corretor();

        session_start();

        if ($corretor->validarCreci($_POST['creciExcluir'])
            && $corretor->buscarUsuario($_POST['creciExcluir']) != $_SESSION['creci']
        ) {

            $_POST['validado'] = $corretor->excluir($_POST['creciExcluir']);
        } else {
            $_POST['erro'] = true;
        }
        $this->view('excluirCorretor');
    }

    public function validacaoLogin()
    {
        $corretor = new Corretor();
        $encriptadorSenha = $this->prepararEncriptador();

        $corretor->creci = $_POST['creci'];
        $corretor->senha = $_POST['senha'];

        session_start();

        // Validação do usuário e senha aqui
        if ($corretor->buscarCorretor($encriptadorSenha)) {
            $_SESSION['creci'] = $corretor->creci;
            $_SESSION['logado'] = true;

            header('Location: home');
        } 

        // Checar se o usuario já está logado
        if (!empty($_SESSION['logado']) && $_SESSION['logado']) {
            header('Location: home');
        }

        $_POST['erro'] = true;
        $this->view('index');
    }

    private function validarNumero($variavel)
    {
        if (str_contains($variavel, "e") || str_contains($variavel, "E")) {
            return true;
        }
        return false;
    }
}
