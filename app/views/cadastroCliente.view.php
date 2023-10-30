<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="../../public/css/style.css">
    <link rel="stylesheet" type="text/css" href="../../public/css/home.css">
    <title>Cadastrar Cliente</title>
    <meta charset="UTF-8">
  </head>
  <body>
    <div class="wrapper d-flex align-items-stretch">
      <?php require("layout/sidebar.view.php"); ?>
        <div id="content" class="p-4 p-md-5">  
        <?php if ($_POST['erro'] ?? false) : ?>
        <div id="aviso-erro">
            Dados incorretos! Tente novamente.
        </div>
        <?php elseif ($_POST['validado'] ?? false) : ?>
        <div id="aviso-acerto">
            Cadastro realizado com sucesso.
        </div>
        <?php endif; ?>
          <h1>Cadastrar Cliente</h1>
          <form action="cliente-cadastrar" method="POST">
            <fieldset>
              <legend>Dados Pessoais</legend>
              <label>Nome<br><input type="text" name="nome" value="<?= $_POST['nome']??''; ?>" required></label><br>
              <label>Data de Nascimento<br><input type="date" name="dataNascimento" value="<?= $_POST['dataNascimento']??''; ?>" required></label><br>
              <label>CPF<br><input type="text" name="cpf" value="<?= $_POST['cpf']??''; ?>" placeholder="000.000.000-00" required></label><br>
              <label>Email<br><input type="email" name="email" value="<?= $_POST['email']??''; ?>" required></label><br>
            </fieldset>
            <fieldset>
              <legend>Telefone</legend>
              <label>Tipo <select name="tipoTelefone" required>
                <option value="" disabled selected>Escolha uma opção</option>
                <option value="Celular">Celular</option>
                <option value="Residencial">Residencial</option>
              </select></label><br>
              <label>Número <input type="number" name="numTelefone" value="<?= $_POST['numTelefone']??''; ?>" placeholder="(00) 00000-0000" required></label>
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
            <button type="submit">Enviar</button>
          </form>
        </div>
    </div>
    <script src="../../public/js/home.js"></script>
  </body>
</html>