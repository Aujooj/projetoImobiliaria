<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="../../public/css/style.css">
    <link rel="stylesheet" type="text/css" href="../../public/css/home.css">

    <title>Editar Corretor</title>

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
                    Alteração salvada com sucesso.
                </div>
            <?php endif; ?>
            <h1>Editar Corretor</h1>
            <form action="corretor-editar" method="POST">
                <fieldset>
                    <legend>Dados Pessoais</legend>
                    <?php $_SESSION['id_corretor'] = $dados[0]['id_corretor'] ?? '';?>
                    <label>Nome<br><input type="text" name="nome" value="<?= $dados[0]['nome'] ?? ''; ?>" required></label><br>
                    <label>Data de Nascimento<br><input type="date" name="dataNascimento" value="<?= $dados[0]['data_nasc'] ?? ''; ?>" required></label><br>
                    <label>Email<br><input type="email" name="email" value="<?= $dados[0]['email'] ?? ''; ?>" required></label><br>
                </fieldset>
                <fieldset>
                    <legend>Telefone</legend>
                    <label>Tipo <select name="tipoTelefone" required>
                            <option value="" disabled selected>Escolha uma opção</option>
                            <option value="Celular">Celular</option>
                            <option value="Residencial">Residencial</option>
                        </select></label><br>
                    <label>Número <input type="number" name="numTelefone" value="<?= $dados[0]['telefone'] ?? ''; ?>" placeholder="(00) 00000-0000" required></label>
                </fieldset>
                <fieldset>
                    <legend>Sistema</legend>
                    <label>Creci<br><input type="text" name="creci" value="<?= $dados[0]['creci'] ?? ''; ?>" required></label><br>
                    <label>Senha<br><input type="password" name="senha" required></label><br>
                    <label>Confirmar senha<br><input type="password" name="confirmarSenha" required></label><br>
                </fieldset>
                <button type="submit" class="round-button">Salvar</button>
            </form>
        </div>
    </div>
    <script src="../../public/js/home.js"></script>
</body>

</html>