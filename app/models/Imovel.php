<?php
require('./app/bancoDeDados/Conexao.php');
class Imovel
{

    private $id_imovel;
    private $tipo;
    private $cep;
    private $rua;
    private $bairro;
    private $numero;
    private $cidade;
    private $estado;
    private $valor;
    private $bd;
    private $condominio;
    private $area_total;
    private $dormitorios;
    private $banheiros;
    private $garagem;
    private $proprietario;

    public function __construct()
    {
        $this->bd = Conexao::get();
    }

    public function inserir()
    {
        $query = $this->bd->prepare(
            "INSERT INTO imoveis (tipo, cep, rua, bairro, numero, cidade, estado, valor, condominio, area_total, dormitorios, banheiros, garagem, proprietario) 
            VALUES (:tipo, :cep, :rua, :bairro, :numero, :cidade, :estado, :valor, :condominio, :area_total, :dormitorios, :banheiros, :garagem, :proprietario)"
        );

        $query->bindValue(':tipo', $this->tipo);
        $query->bindValue(':cep', $this->cep);
        $query->bindValue(':rua', $this->rua);
        $query->bindValue(':bairro', $this->bairro);
        $query->bindValue(':numero', $this->numero);
        $query->bindValue(':cidade', $this->cidade);
        $query->bindValue(':estado', $this->estado);
        $query->bindValue(':valor', $this->valor);
        $query->bindValue(':condominio', $this->condominio);
        $query->bindValue(':area_total', $this->area_total);
        $query->bindValue(':dormitorios', $this->dormitorios);
        $query->bindValue(':banheiros', $this->banheiros);
        $query->bindValue(':garagem', $this->garagem);
        $query->bindValue(':proprietario', $this->proprietario);

        $query->execute();
        return true;
    }

    public function listar()
    {
        $query = $this->bd->prepare("SELECT I.*, C.nome FROM imoveis I, clientes C WHERE I.proprietario = C.id_cliente ORDER BY id_imovel ASC");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    public function excluir($codImovel)
    {
        $query = $this->bd->prepare("DELETE FROM imovel WHERE cod_imovel = :cod_imovel");
        $query->bindValue(':cod_imovel', $codImovel);
        $query->execute();
        return true;
    }

    public function validarCod($codImovel)
    {
        $query = $this->bd->prepare("SELECT cod_imovel FROM imovel");
        $query->execute();
        $imovels = $query->fetchAll(PDO::FETCH_ASSOC);
        foreach ($imovels as $imovel) {
            if (in_array($codImovel, array($imovel['cod_imovel']))) {;
                return true;
            }
        }
        return false;
    }
    public function buscarProprietarios() {
        $query = $this->bd->prepare("SELECT id_cliente, nome FROM clientes");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
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
