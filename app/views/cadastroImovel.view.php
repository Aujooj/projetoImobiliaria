<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="../../public/css/style.css">
  <link rel="stylesheet" type="text/css" href="../../public/css/home.css">
  <title>Cadastro de imóveis</title>
</head>

<body>
  <div class="wrapper d-flex align-items-stretch">
    <?php require("layout/sidebar.view.php"); ?>
    <div id="content" class="p-4 p-md-5">
      <?php if ($_POST['validado'] ?? false) : ?>
        <div id="aviso-acerto">
          Cadastro realizado com sucesso.
        </div>
      <?php endif; ?>
      <h1>Cadastrar Imóvel</h1>
      <form action="imovel-cadastrar" method="POST">
        <fieldset>
          <legend>Informações</legend>
          <label>Tipo<br>
              <select name="tipo" required>
                <option value="" disabled selected>Escolha uma opção</option>
                <option value="Celular">Apartamento</option>
                <option value="Casa Residencial">Casa Residencial</option>
                <option value="Chácara">Chácara</option>
                <option value="Comercial">Comercial</option>
                <option value="Condomínio">Condomínio</option>
                <option value="Terreno">Terreno</option>
              </select>
          </label><br>
          <label>Valor<br><input type="text" name="valor" maxlength="11" required></label><br>
          <label>Condomínio<br>
            <input type="radio" name="condominio" value="1"><span> Sim</span><br>
            <input type="radio" name="condominio" value="0" checked="checked"><span> Não</span></label><br>
            <label>Área Total<br><input type="number" name="area_total" required></label><br>
            <label>Número de quartos<br><input type="number" name="dormitorios" required></label><br>
            <label>Número de banheiros<br><input type="number" name="banheiros" required></label><br>
            <label>Vagas na garagem<br><input type="number" name="garagem" required></label><br>
            <label>Proprietário<br>
              <select name="proprietario" required>
                <option value="" disabled selected>Escolha uma opção</option>
                <?php  
                  foreach($dados as $proprietario) {
                    echo"<option value='";
                    echo $proprietario["id_cliente"];
                    echo "'>";
                    echo $proprietario["nome"];
                    echo"</option>";
                  }
                ?>
              </select>
          </label><br>
        </fieldset>
        <fieldset>
              <legend>Endereço</legend>
              <label>CEP<br><input type="number" name="cep" value="<?= $_POST['cep']??''; ?>" placeholder="00000-000" required></label><br>
              <label>Rua<br><input type="text" name="rua" value="<?= $_POST['rua']??''; ?>" required></label><br>
              <label>Número<br><input type="number" name="numEndereco"value="<?= $_POST['numEndereco']??''; ?>"  required></label><br>
              <label>Bairro<br><input type="text" name="bairro" value="<?= $_POST['bairro']??''; ?>" required></label><br>
              <label>Cidade<br><input type="text" name="cidade" value="<?= $_POST['cidade']??''; ?>" required></label><br>
              <label>Estado<br><select name="estado" required>
                <option value="" disabled selected>Escolha uma opção</option>
                <option value="AC">Acre</option>
                <option value="AL">Alagoas</option>
                <option value="AP">Amapá</option>
                <option value="AM">Amazonas</option>
                <option value="BA">Bahia</option>
                <option value="CE">Ceará</option>
                <option value="DF">Distrito Federal</option>
                <option value="ES">Espírito Santo</option>
                <option value="GO">Goiás</option>
                <option value="MA">Maranhão</option>
                <option value="MT">Mato Grosso</option>
                <option value="MS">Mato Grosso do Sul</option>
                <option value="MG">Minas Gerais</option>
                <option value="PA">Pará</option>
                <option value="PB">Paraíba</option>
                <option value="PR">Paraná</option>
                <option value="PE">Pernambuco</option>
                <option value="PI">Piauí</option>
                <option value="RJ">Rio de Janeiro</option>
                <option value="RN">Rio Grande do Norte</option>
                <option value="RS">Rio Grande do Sul</option>
                <option value="RO">Rondônia</option>
                <option value="RR">Roraima</option>
                <option value="SC">Santa Catarina</option>
                <option value="SP">São Paulo</option>
                <option value="SE">Sergipe</option>
                <option value="TO">Tocantins</option>
              </select></label>
            </fieldset>
        <button type="submit">Cadastrar</button>
      </form>

    </div>
  </div>
  <script src="../../public/js/home.js"></script>
</body>

</html>