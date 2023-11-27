<?php
class HomeController
{
    use AutenticacaoTrait;
    use ViewTrait;

    public function home()
    {
        $this->autenticarLogin();
        $this->view('home');
    }

    public function paginaInicial(){
        $this->view('home');
    }

    public function index()
    {
        $this->view('index');
    }

    public function sair()
    {
        session_start();
        session_destroy();
        header('Location: /');
    }
}
