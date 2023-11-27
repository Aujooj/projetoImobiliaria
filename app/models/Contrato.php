<?php
require_once('./app/bancoDeDados/Conexao.php');

class Contrato
{
    private $id_contrato;
    private $tipo;
    private $data_inicial;
    private $data_final;
    private $inquilino;
    private $id_imovel;
    private $assinado;
    private $bd;

    public function __construct()
    {
        $this->bd = Conexao::get();
    }

    public function inserir()
    {
        $query = $this->bd->prepare(
            "INSERT INTO contratos (tipo, data_inicial, data_final, inquilino, id_imovel, assinado)
             VALUES (:tipo, :data_inicial, :data_final, :inquilino, :id_imovel, :assinado)"
        );

        $query->bindValue(':tipo', $this->tipo);
        $query->bindValue(':data_inicial', $this->data_inicial);
        $query->bindValue(':data_final', $this->data_final);
        $query->bindValue(':inquilino', $this->inquilino);
        $query->bindValue(':id_imovel', $this->id_imovel);
        $query->bindValue(':assinado', $this->assinado);

        $query->execute();
        return true;
    }

    public function editar($id_contrato)
    {
        $query = $this->bd->prepare(
            "UPDATE contratos SET tipo = :tipo, data_inicial = :data_inicial, data_final = :data_final, inquilino = :inquilino, id_imovel = :id_imovel WHERE id_contrato = :id_contrato"
        );

        $query->bindValue(':tipo', $this->tipo);
        $query->bindValue(':data_inicial', $this->data_inicial);
        $query->bindValue(':data_final', $this->data_final);
        $query->bindValue(':inquilino', $this->inquilino);
        $query->bindValue(':id_imovel', $this->id_imovel);
        $query->bindValue(':id_contrato', $id_contrato);

        $query->execute();
        return true;
    }

    public function listar()
    {
        $query = $this->bd->prepare("SELECT * FROM contratos");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    public function excluir($id_contrato)
    {
        $query = $this->bd->prepare("DELETE FROM contratos WHERE id_contrato = :id_contrato");
        $query->bindValue(':id_contrato', $id_contrato);
        $query->execute();
        return true;
    }
    public function assinar($id_contrato)
    {
        $query = $this->bd->prepare("UPDATE contratos SET assinado = true WHERE id_contrato = :id_contrato");
        $query->bindValue(':id_contrato', $id_contrato);
        $query->execute();
        $imovel = $query->fetchAll(PDO::FETCH_ASSOC);
        return $imovel;
    }
    

    public function buscarProprietarios() {
        $query = $this->bd->prepare("SELECT id_cliente, nome FROM clientes ORDER BY nome ASC");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarEntityContrato($id_contrato)
    {
        $query = $this->bd->prepare("SELECT * FROM contratos WHERE id_contrato = :id_contrato");
        $query->bindValue(':id_contrato', $id_contrato);
        $query->execute();
        $contrato = $query->fetchAll(PDO::FETCH_ASSOC);
        return $contrato;
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
