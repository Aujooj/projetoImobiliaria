<?php
require('./app/models/Visita.php');

class VisitaController
{
    use AutenticacaoTrait;
    use ViewTrait;

    public function listar()
    {
        $this->autenticarLogin();

        $visita = new Visita();

        $this->view('listaVisitas', $visita->listar());
    }

    public function devolver($id)
    {
        $imovel = new Imovel();
        $imovel->disponibilizarChave($id);
        header('Location: /imoveis');


    }

    public function cadastrar($id)
    {

        $visita = new Visita();
        $this->autenticarLogin();

        // Verifica se foi passado o ID do imóvel
        if ($id) {
            $this->view('cadastroVisita', ['idImovel' => $id, 'clientes' => $visita->buscarProprietarios()]);
        } else {
            // Redireciona para a página de lista de visitas se não houver ID do imóvel
            header('Location: /lista-visita');
            exit();
        }
    }

    public function validarCadastro()
    {
        session_start();

        $visita = new Visita();
        $imovel = new Imovel();

        $visita->data_inicial = $_POST['dataInicial'];
        $visita->data_final = $_POST['dataFinal'];
        $visita->cliente = $_POST['cliente'];
        $visita->imovel = $_POST['id_imovel'];
        $visita->corretor = $_POST['corretor'];

        $_POST['validado'] = $visita->inserir();

        $imovel->indisponibilizarChave($_POST['id_imovel']);

        $this->view('cadastroVisita');
    }

    public function editar()
    {
        $visita = new Visita();
        $this->autenticarLogin();
        $this->view('editarVisita', $visita->buscarEntityVisita($_GET['editar']));
    }

    public function salvarEdicao()
    {
        session_start();

        $visita = new Visita();

        $visita->data_inicial = $_POST['dataInicial'];
        $visita->data_final = $_POST['dataFinal'];
        $visita->cliente = $_POST['cliente'];
        $visita->imovel = $_POST['idImovel'];
        $visita->corretor = $_POST['corretor'];

        $_POST['validado'] = $visita->editar($_SESSION['id_visita']);

        $this->view('editarVisita');
    }

    public function excluir()
    {
        $this->autenticarLogin();
        $this->view('excluirVisita');
    }

    public function realizarExclusao()
    {
        session_start();
        $visita = new Visita();

        $_POST['validado'] = $visita->excluir($_POST['idVisita']);

        $this->view('excluirVisita');
    }
}
