<?php
$catalogo = new CatalogoController();
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
	<title>Homepage</title>
	<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="../../public/layout/css/style.css">
</head>
</head>

<body>

	<div class="wrapper d-flex align-items-stretch">
		<?php require("layout/sidebar.view.php"); ?>
		<?php $catalogo->catalogo(); ?>
	</div>
	</div>
</body>

</html>