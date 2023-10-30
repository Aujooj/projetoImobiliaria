<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="../../public/css/style.css">
  <link rel="stylesheet" type="text/css" href="../../public/css/home.css">
  <title>Excluir Corretor</title>
</head>

<body>
  <div class="wrapper d-flex align-items-stretch">
    <?php require("layout/sidebar.view.php"); ?>
    <div id="content" class="p-4 p-md-5">
      <?php if ($_POST['erro'] ?? false) : ?>
        <div id="aviso-erro">
          Creci incorreto! Tente novamente.
        </div>
      <?php elseif ($_POST['validado'] ?? false) : ?>
        <div id="aviso-acerto">
          Exclusão realizada com sucesso.
        </div>
      <?php endif; ?>
      <h1>Excluir Corretor</h1>
      <form action="/corretor-excluir" method="POST">
        <fieldset>
          <label>Creci<br><input type="text" name="creciExcluir" value="<?= $_GET['excluir'] ?? ''; ?>" required readonly></label><br>
        </fieldset>
        <button type="submit" class="round-button">Excluir</button>
      </form>
    </div>
  </div>
</body>

</html>