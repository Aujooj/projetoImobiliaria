<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../../public/css/style.css">
    <link rel="stylesheet" type="text/css" href="../../public/css/home.css">
    <title>Listagem de produtos</title>
</head>

<body>
    <div class="wrapper d-flex align-items-stretch">
        <?php require("layout/sidebar.view.php"); ?>
        <div id="content" class="p-4 p-md-5">
            <h1>Listagem de produtos</h1>
            <?php if (sizeof($dados) == 0) : ?>
                <p>Não há produtos cadastrados!</p>
            <?php else : ?>
                <table>
                    <thead>
                        <tr>
                            <th>Código</th>
                            <th>Tipo</th>
                            <th>Marca</th>
                            <th>Armazenamento</th>
                            <th>RAM</th>
                            <th>Descrição</th>
                            <th>Preço</th>
                            <th>Qtde</th>
                            <th>Processador</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($dados as $produto) : ?>
                            <tr>
                                <td><?= $produto->cod_produto ?></td>
                                <td><?= $produto->tipo ?></td>
                                <td><?= $produto->marca ?></td>
                                <td><?= $produto->armazenamento ?></td>
                                <td><?= $produto->ram ?></td>
                                <td><?= $produto->descricao ?></td>
                                <td><?= $produto->preco ?></td>
                                <td><?= $produto->quantidade ?></td>
                                <td><?= $produto->processador ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>
    </div>
</body>

</html>