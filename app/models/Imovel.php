<?php
require_once('./app/bancoDeDados/Conexao.php');
class Imovel
{

    private $id_imovel;
    private $tipo_imovel;
    private $tipo_contrato;
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
    private $chave_disponivel;
    private $imovel_disponivel;
    public function __construct()
    {
        $this->bd = Conexao::get();
    }

    // No arquivo Imovel.php

    public function listarComFiltros($quartos, $banheiros, $garagem, $tipoImovel, $tipoContrato)
{
    $query = "SELECT I.*, C.nome FROM imoveis I, clientes C WHERE I.proprietario = C.id_cliente AND I.imovel_disponivel = true";

    // Adicionar condições de filtro
    if ($quartos !== null) {
        $query .= " AND I.dormitorios >= :quartos";
    }

    if ($banheiros !== null) {
        $query .= " AND I.banheiros >= :banheiros";
    }

    if ($garagem !== null) {
        $query .= " AND I.garagem >= :garagem";
    }

    if (!empty($tipoImovel)) {
        $query .= " AND I.tipo_imovel = :tipo_imovel";
    }

    if (!empty($tipoContrato)) {
        $query .= " AND (I.tipo_contrato = :tipo_contrato OR I.tipo_contrato = 'Locação/Venda')";
    }

    $query .= " ORDER BY I.id_imovel ASC";

    $stmt = $this->bd->prepare($query);

    // Bind valores dos parâmetros
    if ($quartos !== null) {
        $stmt->bindValue(':quartos', $quartos, PDO::PARAM_INT);
    }

    if ($banheiros !== null) {
        $stmt->bindValue(':banheiros', $banheiros, PDO::PARAM_INT);
    }

    if ($garagem !== null) {
        $stmt->bindValue(':garagem', $garagem, PDO::PARAM_INT);
    }

    if (!empty($tipoImovel)) {
        $stmt->bindValue(':tipo_imovel', $tipoImovel, PDO::PARAM_STR);
    }

    if (!empty($tipoContrato)) {
        $stmt->bindValue(':tipo_contrato', $tipoContrato, PDO::PARAM_STR);
    }

    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_OBJ);
}




    public function inserir()
    {
        $query = $this->bd->prepare(
            "INSERT INTO imoveis (tipo_imovel, tipo_contrato, cep, rua, bairro, numero, cidade, estado, valor, condominio, area_total, foto, dormitorios, banheiros, garagem, proprietario, chave_disponivel, imovel_disponivel) 
            VALUES (:tipo_imovel, :tipo_contrato, :cep, :rua, :bairro, :numero, :cidade, :estado, :valor, :condominio, :area_total, :foto, :dormitorios, :banheiros, :garagem, :proprietario, :chave_disponivel, :imovel_disponivel)"
        );

        $query->bindValue(':tipo_imovel', $this->tipo_imovel);
        $query->bindValue(':tipo_contrato', $this->tipo_contrato);
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
        $query->bindValue(':chave_disponivel', $this->chave_disponivel);
        $query->bindValue(':imovel_disponivel', $this->imovel_disponivel);


        $query->execute();
        return true;
    }

    public function editar($id_imovel)
    {
        $query = $this->bd->prepare("UPDATE imoveis SET tipo_imovel = :tipo_imovel, tipo_contrato = :tipo_contrato, valor = :valor, condominio = :condominio, area_total = :area_total, foto = :foto, dormitorios = :dormitorios, banheiros = :banheiros, garagem = :garagem, proprietario = :proprietario, cep = :cep, rua = :rua, bairro = :bairro, numero = :numero, cidade = :cidade, estado = :estado WHERE id_imovel = :id_imovel");

        $query->bindValue(':tipo_imovel', $this->tipo_imovel);
        $query->bindValue(':tipo_contrato', $this->tipo_contrato);
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
            if (in_array($idImovel, array($imovel['id_imovel']))) {
                ;
                return true;
            }
        }
        return false;
    }
    public function buscarProprietarios()
    {
        $query = $this->bd->prepare("SELECT id_cliente, nome FROM clientes ORDER BY nome ASC");
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

    public function indisponibilizar($id_imovel)
    {
        $query = $this->bd->prepare("UPDATE imoveis SET imovel_disponivel = false WHERE id_imovel = :id_imovel");
        $query->bindValue(':id_imovel', $id_imovel);
        $query->execute();
        $imovel = $query->fetchAll(PDO::FETCH_ASSOC);
        return $imovel;
    }

    public function indisponibilizarChave($id_imovel)
    {
        $query = $this->bd->prepare("UPDATE imoveis SET chave_disponivel = false WHERE id_imovel = :id_imovel");
        $query->bindValue(':id_imovel', $id_imovel);
        $query->execute();
        $imovel = $query->fetchAll(PDO::FETCH_ASSOC);
        return $imovel;
    }

    public function disponibilizarChave($id_imovel)
    {
        $query = $this->bd->prepare("UPDATE imoveis SET chave_disponivel = true WHERE id_imovel = :id_imovel");
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
