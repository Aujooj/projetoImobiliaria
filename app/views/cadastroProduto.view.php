<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="../../public/css/style.css">
  <link rel="stylesheet" type="text/css" href="../../public/css/home.css">
  <title>Cadastro de produtos</title>
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
      <h1>Cadastrar Produto</h1>
      <form action="produto-cadastrar" method="POST">
        <fieldset>
          <legend>Informações</legend>
          <label>Tipo<br><input type="text" name="tipo" value="<?= $_POST['tipo'] ?? ''; ?>" maxlength="10" required></label><br>
          <label>Marca<br><input type="text" name="marca" value="<?= $_POST['marca'] ?? ''; ?>" maxlength="20" required></label><br>
          <label>Descrição<br><input type="text" name="descricao" value="<?= $_POST['descricao'] ?? ''; ?>" maxlength="100" required></label><br>
          <label>Processador<br><input type="text" name="processador" value="<?= $_POST['processador'] ?? ''; ?>" maxlength="20" required></label><br>
          <label>RAM<br><input type="number" name="ram" value="<?= $_POST['ram'] ?? ''; ?>" required></label><br>
          <label>Armazenamento<br><input type="number" name="armazenamento" value="<?= $_POST['armazenamento'] ?? ''; ?>" required></label><br>
          <label>Preço<br><input type="number" name="preco" value="<?= $_POST['preco'] ?? ''; ?>" required></label><br>
          <label>Qtde<br><input type="number" name="quantidade" value="<?= $_POST['quantidade'] ?? ''; ?>" required></label><br>
        </fieldset>
        <button type="submit">Cadastrar</button>
      </form>

    </div>
  </div>
  <script src="../../public/js/home.js"></script>
</body>

</html>