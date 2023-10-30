<?php
require('./app/bancoDeDados/Conexao.php');
class Corretor
{

    private $creci;
    private $senha;
    private $data_nasc;
    private $nome;
    private $telefone;
    private $email;
    private $bd;

    public function __construct()
    {
        $this->bd = Conexao::get();
    }

    public function inserir()
    {
        $query = $this->bd->prepare("INSERT INTO corretores (creci, senha, data_nasc, nome, telefone, email) VALUES (:creci, :senha, :data_nasc, :nome, :telefone, :email)");

        $query->bindValue(':creci', $this->creci);
        $query->bindValue(':senha', $this->senha);
        $query->bindValue(':data_nasc', $this->data_nasc);
        $query->bindValue(':nome', $this->nome);
        $query->bindValue(':telefone', $this->telefone);
        $query->bindValue(':email', $this->email);

        $query->execute();
        return true;
    }

    public function listar()
    {
        $query = $this->bd->prepare("SELECT * FROM corretores");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    public function excluir($creci)
    {
        $query = $this->bd->prepare("DELETE FROM corretores WHERE creci = :creci");
        $query->bindValue(':creci', $creci);
        $query->execute();
        return true;
    }

    public function validarCreci($creci)
    {
        $query = $this->bd->prepare("SELECT creci FROM corretores");
        $query->execute();
        $corretores = $query->fetchAll(PDO::FETCH_ASSOC);
        foreach ($corretores as $corretor) {
            if (in_array($creci, array($corretor['creci']))) {;
                return true;
            }
        }
        return false;
    }

    public function buscarCorretor($encriptadorSenha)
    {
        $query = $this->bd->prepare("SELECT creci, senha FROM corretores");
        $query->execute();
        $crecis = $query->fetchAll(PDO::FETCH_ASSOC);
        foreach ($crecis as $dados) {
            if (
                in_array($this->creci, array($dados['creci']))
                && $encriptadorSenha->verify($dados['senha'], $this->senha)
            ) {
                return true;
            }
        }
        return false;
    }

    public function buscarUsuario($creci)
    {
        $query = $this->bd->prepare("SELECT creci FROM corretores WHERE creci = :creci");
        $query->bindValue(':creci', $creci);
        $query->execute();
        $crecis = $query->fetchAll(PDO::FETCH_ASSOC);
        return $crecis[0]['creci'];
    }

    public function __get($propriedade)
    {
        return $this->$propriedade;
    }

    public function __set($propriedade, $valor)
    {
        $this->$propriedade = $valor;
    }
}
