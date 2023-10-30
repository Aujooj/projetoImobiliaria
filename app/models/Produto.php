<?php
require('./app/bancoDeDados/Conexao.php');
class Produto
{

    private $cod_produto;
    private $tipo;
    private $marca;
    private $armazenamento;
    private $ram;
    private $descricao;
    private $preco;
    private $quantidade;
    private $processador;
    private $bd;

    public function __construct()
    {
        $this->bd = Conexao::get();
    }

    public function inserir()
    {
        $query = $this->bd->prepare(
            "INSERT INTO produto (tipo, marca, armazenamento, ram, descricao, preco, quantidade, processador) 
            VALUES (:tipo, :marca, :armazenamento, :ram, :descricao, :preco, :quantidade, :processador)"
        );

        $query->bindValue(':tipo', $this->tipo);
        $query->bindValue(':marca', $this->marca);
        $query->bindValue(':armazenamento', $this->armazenamento);
        $query->bindValue(':ram', $this->ram);
        $query->bindValue(':descricao', $this->descricao);
        $query->bindValue(':preco', $this->preco);
        $query->bindValue(':quantidade', $this->quantidade);
        $query->bindValue(':processador', $this->processador);

        $query->execute();
        return true;
    }

    public function listar()
    {
        $query = $this->bd->prepare("SELECT * FROM produto");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    public function excluir($codProduto)
    {
        $query = $this->bd->prepare("DELETE FROM produto WHERE cod_produto = :cod_produto");
        $query->bindValue(':cod_produto', $codProduto);
        $query->execute();
        return true;
    }

    public function validarCod($codProduto)
    {
        $query = $this->bd->prepare("SELECT cod_produto FROM produto");
        $query->execute();
        $produtos = $query->fetchAll(PDO::FETCH_ASSOC);
        foreach ($produtos as $produto) {
            if (in_array($codProduto, array($produto['cod_produto']))) {;
                return true;
            }
        }
        return false;
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
