<?php
require_once('./app/bancoDeDados/Conexao.php');

class Visita
{
    private $id_visitacao;
    private $data_inicial;
    private $data_final;
    private $cliente;
    private $imovel;
    private $corretor;
    private $bd;

    public function __construct()
    {
        $this->bd = Conexao::get();
    }

    public function inserir()
    {
        $query = $this->bd->prepare(
            "INSERT INTO visitacao (data_inicial, data_final, cliente, imovel, corretor)
             VALUES (:data_inicial, :data_final, :cliente, :imovel, :corretor)"
        );

        $query->bindValue(':data_inicial', $this->data_inicial);
        $query->bindValue(':data_final', $this->data_final);
        $query->bindValue(':cliente', $this->cliente);
        $query->bindValue(':imovel', $this->imovel);
        $query->bindValue(':corretor', $this->corretor);

        $query->execute();
        return true;
    }

    public function editar($id_visitacao)
    {
        $query = $this->bd->prepare(
            "UPDATE visitacao SET data_inicial = :data_inicial, data_final = :data_final, 
            cliente = :cliente, imovel = :imovel, corretor = :corretor 
            WHERE id_visitacao = :id_visitacao"
        );

        $query->bindValue(':data_inicial', $this->data_inicial);
        $query->bindValue(':data_final', $this->data_final);
        $query->bindValue(':cliente', $this->cliente);
        $query->bindValue(':imovel', $this->imovel);
        $query->bindValue(':corretor', $this->corretor);
        $query->bindValue(':id_visitacao', $id_visitacao);

        $query->execute();
        return true;
    }

    public function listar()
    {
        $query = $this->bd->prepare("SELECT * FROM visitacao");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    public function devolver($id_visitacao)
{
    // Obtém a data atual
    $data_atual = date('Y-m-d H:i:s');

    // Atualiza o registro da visita com a data final sendo a data atual
    $query = $this->bd->prepare(
        "UPDATE visitacao SET data_final = :data_final WHERE id_visitacao = :id_visitacao"
    );

    $query->bindValue(':data_final', $data_atual);
    $query->bindValue(':id_visitacao', $id_visitacao);

    $query->execute();
    return true;
}


    public function buscarEntityVisita($id_visitacao)
    {
        $query = $this->bd->prepare("SELECT * FROM visitacao WHERE id_visitacao = :id_visitacao");
        $query->bindValue(':id_visitacao', $id_visitacao);
        $query->execute();
        $contrato = $query->fetchAll(PDO::FETCH_ASSOC);
        return $contrato;
    }

    public function buscarProprietarios() {
        $query = $this->bd->prepare("SELECT id_cliente, nome FROM clientes ORDER BY nome ASC");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function excluir($id_visitacao)
    {
        $query = $this->bd->prepare("DELETE FROM visitacao WHERE id_visitacao = :id_visitacao");
        $query->bindValue(':id_visitacao', $id_visitacao);
        $query->execute();
        return true;
    }

    // Getters e Setters

    public function __get($propriedade)
    {
        return $this->$propriedade;
    }

    public function __set($propriedade, $valor)
    {
        $this->$propriedade = $valor;
    }
}
