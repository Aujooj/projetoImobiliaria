<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="../../public/css/home.css">
    <title>Corretores</title>
</head>

<body>
    <div class="wrapper d-flex">
        <?php require("layout/sidebar.view.php"); ?>
        <div id="content" class="p-4 p-md-5">
            <h1>Corretores</h1>
            <a href="/corretor-cadastrar" class="round-button">+</a>
            <?php if (sizeof($dados) == 0) : ?>
                <p>Não há corretores cadastrados!</p>
            <?php else : ?>
                <table>
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Data de Nascimento</th>
                            <th>Creci</th>
                            <th>Email</th>
                            <th>Telefone</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($dados as $corretor) : ?>
                            <tr>
                                <td><?= $corretor->nome ?></td>
                                <td><?= (new DateTime($corretor->data_nasc))->format('d/m/Y') ?></td>
                                <td><?= $corretor->creci ?></td>
                                <td><?= $corretor->email ?></td>
                                <td><?= $corretor->telefone ?></td>
                                <td>
                                    <form action="/corretor-editar" method="GET">
                                    <button class="button-list" type="submit" name="corretor-editar" value="<?= $corretor->creci ?>">
                                        <img src="../../public/IMG/pencil.png" width="20" height="20">
                                    </button>
                                    </form>
                                </td>
                                <td>
                                    <form action="/corretor-excluir" method="GET">
                                    <button class="button-list" type="submit" name="excluir" value="<?= $corretor->creci ?>">
                                        <img src="../../public/IMG/trash.png" width="20" height="20">
                                    </button>
                                    </form>  
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>
    </div>
    <script src="../../public/js/home.js"></script>
</body>

</html>