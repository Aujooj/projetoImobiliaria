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
    private $foto;
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
            "INSERT INTO imoveis (tipo, cep, rua, bairro, numero, cidade, estado, valor, condominio, area_total, foto, dormitorios, banheiros, garagem, proprietario) 
            VALUES (:tipo, :cep, :rua, :bairro, :numero, :cidade, :estado, :valor, :condominio, :area_total, :foto, :dormitorios, :banheiros, :garagem, :proprietario)"
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
        $query->bindValue(':foto', $this->foto);
        $query->bindValue(':dormitorios', $this->dormitorios);
        $query->bindValue(':banheiros', $this->banheiros);
        $query->bindValue(':garagem', $this->garagem);
        $query->bindValue(':proprietario', $this->proprietario);

        $query->execute();
        return true;
    }

    public function editar($id_imovel) {
        $query = $this->bd->prepare("UPDATE imoveis SET tipo = :tipo, valor = :valor, condominio = :condominio, area_total = :area_total, foto = :foto, dormitorios = :dormitorios, banheiros = :banheiros, garagem = :garagem, proprietario = :proprietario, cep = :cep, rua = :rua, bairro = :bairro, numero = :numero, cidade = :cidade, estado = :estado WHERE id_imovel = :id_imovel");

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
        $query->bindValue(':foto', $this->foto);
        $query->bindValue(':dormitorios', $this->dormitorios);
        $query->bindValue(':banheiros', $this->banheiros);
        $query->bindValue(':garagem', $this->garagem);
        $query->bindValue(':proprietario', $this->proprietario);
        $query->bindValue(':id_imovel', $id_imovel);

        $query->execute();
        return true;
    }

    public function listar()
    {
        $query = $this->bd->prepare("SELECT I.*, C.nome FROM imoveis I, clientes C WHERE I.proprietario = C.id_cliente ORDER BY id_imovel ASC");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    public function excluir($idImovel)
    {
        $query = $this->bd->prepare("DELETE FROM imoveis WHERE id_imovel = :id_imovel");
        $query->bindValue(':id_imovel', $idImovel);
        $query->execute();
        return true;
    }

    public function validarId($idImovel)
    {
        $query = $this->bd->prepare("SELECT id_imovel FROM imoveis");
        $query->execute();
        $imoveis = $query->fetchAll(PDO::FETCH_ASSOC);
        foreach ($imoveis as $imovel) {
            if (in_array($idImovel, array($imovel['id_imovel']))) {;
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

    public function buscarEntityImovel($id_imovel)
    {
        $query = $this->bd->prepare("SELECT * FROM imoveis WHERE id_imovel = :id_imovel");
        $query->bindValue(':id_imovel', $id_imovel);
        $query->execute();
        $imovel = $query->fetchAll(PDO::FETCH_ASSOC);
        return $imovel;
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
