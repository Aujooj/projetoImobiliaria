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

        if (!BrDoc::cpf($_POST['cpf'])->isValid() || $corretor->validarCpf(BrDoc::cpf($_POST['cpf'])->format()->get())) {
            $_POST['erro'] = true;
            $_POST['cpf'] = '';
        } elseif (!empty($_POST['numTelefone']) && ($this->validarNumero($_POST['numTelefone'])
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
            $corretor->usuario = $_POST['usuario'];
            $corretor->senha = $encriptadorSenha->hash($_POST['senha']);
            $corretor->cpf = BrDoc::cpf($_POST['cpf'])->format()->get();
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
        $this->autenticarLogin();
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

        if (
            BrDoc::cpf($_POST['cpfCorretor'])->isValid()
            && $corretor->validarCpf((BrDoc::cpf($_POST['cpfCorretor'])->format()->get()))
            && $corretor->buscarUsuario($_POST['cpfCorretor']) != $_SESSION['usuario']
        ) {

            $_POST['validado'] = $corretor->excluir((BrDoc::cpf($_POST['cpfCorretor'])->format()->get()));
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
