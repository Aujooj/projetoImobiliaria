<!-- cadastroVisita.view.php -->
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../../public/css/style.css">
    <link rel="stylesheet" type="text/css" href="../../public/css/home.css">
    <title>Cadastro de Visita</title>
</head>

<body>
    <div class="wrapper d-flex align-items-stretch">
        <?php require("layout/sidebar.view.php"); ?>
        <div id="content" class="p-4 p-md-5">
            <?php if ($_POST['validado'] ?? false): ?>
                <div id="aviso-acerto">
                    Cadastro de Visita realizado com sucesso.
                </div>
            <?php endif; ?>
            <h1>Agendar Visita</h1>
            <form action="/visita-cadastrar" method="POST">
                <?php
                $corretor = new Corretor();
                $id_corretor = $corretor->buscarEntityCorretor($_SESSION['creci']);
                echo '(' . $id_corretor[0]['id_corretor'] . ')'; ?>
                <input type="hidden" name="id_imovel" value="<?= $idImovel ?>">
                <input type="hidden" name="corretor" value="<?= $id_corretor[0]['id_corretor'] ?>">
                <fieldset>
                    <legend>Informações da Visita</legend>
                    <label>Data Inicial<br><input type="date" name="dataInicial" required></label><br>
                    <label>Data Final<br><input type="date" name="dataFinal" required></label><br>
                    <label>Cliente<br>
                        <select name="cliente" required>
                            <option value="" disabled selected>Escolha uma opção</option>
                            <?php
                            foreach ($clientes as $cliente) {
                                echo "<option value='" . $cliente['id_cliente'] . "'>" . $cliente['nome'] . "</option>";
                            }
                            ?>
                        </select>
                    </label><br>
                </fieldset>
                <button type="submit">Agendar</button>
            </form>
        </div>
    </div>
    <script src="../../public/js/home.js"></script>
</body>

</html>