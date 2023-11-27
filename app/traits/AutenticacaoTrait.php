<?php
trait AutenticacaoTrait
{
    public function autenticarLogin()
    {
        session_start();
        if (empty($_SESSION['logado']) || $_SESSION['logado'] == false) {
            header('Location: /login');
        }
    }
}
