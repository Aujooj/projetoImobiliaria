<?php
require_once('./app/bancoDeDados/Conexao.php');
class Cliente
{
    private $cpf;
    private $data_nasc;
    private $nome;
    private $telefone;
    private $email;
    private $bd;
    private $cep;
    private $rua;
    private $bairro;
    private $numero;
    private $cidade;
    private $estado;


    public function __construct()
    {
        $this->bd = Conexao::get();
    }

    public function inserir()
    {
        $query = $this->bd->prepare(
            "INSERT INTO clientes (cpf, data_nasc, nome, telefone, email, cep, rua, bairro, numero, cidade, estado)
             VALUES (:cpf, :data_nasc, :nome, :telefone, :email, :cep, :rua, :bairro, :numero, :cidade, :estado)"
        );

        $query->bindValue(':cpf', $this->cpf);
        $query->bindValue(':data_nasc', $this->data_nasc);
        $query->bindValue(':nome', $this->nome);
        $query->bindValue(':telefone', $this->telefone);
        $query->bindValue(':email', $this->email);
        $query->bindValue(':cep', $this->cep);
        $query->bindValue(':rua', $this->rua);
        $query->bindValue(':bairro', $this->bairro);
        $query->bindValue(':numero', $this->numero);
        $query->bindValue(':cidade', $this->cidade);
        $query->bindValue(':estado', $this->estado);

        $query->execute();
        return true;
    }

    public function editar($id_cliente) {
        $query = $this->bd->prepare("UPDATE clientes SET cpf = :cpf, data_nasc = :data_nasc, nome = :nome, telefone = :telefone, email = :email, cep = :cep, rua = :rua, bairro = :bairro, numero = :numero, cidade = :cidade, estado = :estado WHERE id_cliente = :id_cliente");

        $query->bindValue(':cpf', $this->cpf);
        $query->bindValue(':data_nasc', $this->data_nasc);
        $query->bindValue(':nome', $this->nome);
        $query->bindValue(':telefone', $this->telefone);
        $query->bindValue(':email', $this->email);
        $query->bindValue(':cep', $this->cep);
        $query->bindValue(':rua', $this->rua);
        $query->bindValue(':bairro', $this->bairro);
        $query->bindValue(':numero', $this->numero);
        $query->bindValue(':cidade', $this->cidade);
        $query->bindValue(':estado', $this->estado);
        $query->bindValue(':id_cliente', $id_cliente);

        $query->execute();
        return true;
    }

    public function listar()
    {
        $query = $this->bd->prepare("SELECT * FROM clientes");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    public function excluir($cpf)
    {
        $query = $this->bd->prepare("DELETE FROM clientes WHERE cpf = :cpf");
        $query->bindValue(':cpf', $cpf);
        $query->execute();
        return true;
    }

    public function validarCpf($cpf)
    {
        $query = $this->bd->prepare("SELECT cpf FROM clientes");
        $query->execute();
        $clientes = $query->fetchAll(PDO::FETCH_ASSOC);
        foreach ($clientes as $cliente) {
            if (in_array($cpf, array($cliente['cpf']))) {;
                return true;
            }
        }
        return false;
    }

    public function buscarEntityCliente($cpf)
    {
        $query = $this->bd->prepare("SELECT * FROM clientes WHERE cpf = :cpf");
        $query->bindValue(':cpf', $cpf);
        $query->execute();
        $cliente = $query->fetchAll(PDO::FETCH_ASSOC);
        return $cliente;
    }

    public function buscarEntityClienteId($id)
    {
        $query = $this->bd->prepare("SELECT * FROM clientes WHERE id_cliente = :id");
        $query->bindValue(':id', $id);
        $query->execute();
        $cliente = $query->fetchAll(PDO::FETCH_ASSOC);
        return $cliente;
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
