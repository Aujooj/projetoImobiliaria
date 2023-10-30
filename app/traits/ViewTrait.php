<?php
trait ViewTrait
{
    public function view($nome, $dados = [])
    {
        foreach ($dados as $chave => $valor) {
            ${$chave} = $valor;
        }
        return require "./app/views/{$nome}.view.php";
    }
}
