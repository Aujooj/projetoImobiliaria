<!-- cadastroContrato.view.php -->
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../../public/css/style.css">
    <link rel="stylesheet" type="text/css" href="../../public/css/home.css">
    <title>Cadastro de Contrato</title>
</head>

<body>
    <div class="wrapper d-flex align-items-stretch">
        <?php require("layout/sidebar.view.php"); ?>
        <div id="content" class="p-4 p-md-5">
            <?php if ($_POST['validado'] ?? false) : ?>
                <div id="aviso-acerto">
                    Cadastro de Contrato realizado com sucesso.
                </div>
            <?php endif; ?>
            <h1>Gerar Contrato</h1>
            <form action="/contrato-cadastrar" method="POST">
                <input type="hidden" name="id_imovel" value="<?=$idImovel?>">
                <fieldset>
                    <legend>Informações do Contrato</legend> 
                    <label>Tipo<br>
                        <select name="tipo" required>
                            <option value="" disabled selected>Escolha uma opção</option>
                            <option value="Locação">Locação</option>
                            <option value="Venda">Venda</option>
                        </select>
                    </label><br>
                    <label>Data Inicial<br><input type="date" name="dataInicial" required></label><br>
                    <label>Data Final<br><input type="date" name="dataFinal" required></label><br>
                    <label>Inquilino<br>
                        <select name="inquilino" required>
                            <option value="" disabled selected>Escolha uma opção</option>
                            <?php
                            foreach ($clientes as $cliente) {
                                echo "<option value='" . $cliente['id_cliente'] . "'>" . $cliente['nome'] . "</option>";
                            }
                            ?>
                        </select>
                    </label><br>
                </fieldset>
                <button type="submit">Gerar</button>
            </form>

        </div>
    </div>
    <script src="../../public/js/home.js"></script>
</body>

</html>
