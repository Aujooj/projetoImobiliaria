<!doctype html>
<html lang="pt-BR">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="../../public/layout/css/style.css">
</head>

<body>
  <div class="wrapper d-flex align-items-stretch">
    <nav id="sidebar">
      <div class="p-4 pt-5">
        <a href="/home" class="img logo rounded-circle mb-5" style="background-image: url(../../public/layout/images/logo.jpg);"></a>
        <p>Bem vindo: <?php echo $_SESSION['creci']; ?></p>
        <ul class="list-unstyled components mb-5">
          <li>
            <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Produtos</a>
            <ul class="collapse list-unstyled" id="homeSubmenu">
              <li>
                <a href="produto-listar">Listar</a>
              </li>
              <li>
                <a href="produto-cadastrar">Cadastrar</a>
              </li>
              <li>
                <a href="produto-excluir">Excluir</a>
              </li>
            </ul>
          </li>

          <li>
            <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Clientes</a>
            <ul class="collapse list-unstyled" id="pageSubmenu">
              <li>
                <a href="cliente-listar">Listar</a>
              </li>
              <li>
                <a href="cliente-cadastrar">Cadastrar</a>
              </li>
              <li>
                <a href="cliente-excluir">Excluir</a>
              </li>
            </ul>
          </li>
          <li>
            <a href="corretor" aria-expanded="false" class="dropdown-toggle">Corretores</a>
          </li>

          <li>
            <a href="/sair">Sair</a>
          </li>
        </ul>
      </div>
    </nav>
    <button type="button" id="sidebarCollapse" class="btn btn-primary">
      <i class="fa fa-bars"></i>
      <span class="sr-only">Toggle Menu</span>
    </button>
  </div>

  <script src="../../public/layout/js/jquery.min.js"></script>
  <script src="../../public/layout/js/popper.js"></script>
  <script src="../../public/layout/js/bootstrap.min.js"></script>
  <script src="../../public/layout/js/main.js"></script>
</body>

</html>