<link rel="stylesheet" type="text/css" href="../../public/css/home.css">
<div class="wrapper d-flex align-items-stretch">
	<div id="content" class="p-4 p-md-5">
		<h1>Catálogo</h1>
		<table>
			<tr>
				<td>Imagem</td>
				<td>Código</td>
				<td>Nome</td>
				<td>Preço</td>
			</tr>

			<?php foreach ($televisores as $indice => $tv) : ?>
				<tr>
					<td><img src="../../public/IMG/tv.png" alt="Televisor"></td>
					<td><?php echo $tv['Código'] ?></td>
					<td><?php echo $tv['Nome'] ?></td>
					<td><?php echo $tv['Valor'] ?></td>
				</tr>
			<?php endforeach; ?>
		</table>
	</div>
</div>