<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <link rel="stylesheet" type="text/css" href="../../public/css/home.css">
    <title>Clientes</title>
    <meta charset="UTF-8">
</head>

<body>
    <div class="wrapper d-flex align-items-stretch">
        <?php require("layout/sidebar.view.php"); ?>
        <div id="content" class="p-4 p-md-5">
            <h1>Clientes</h1>
            <a href="/cliente-cadastrar" class="round-button">+</a>
            <?php if (sizeof($dados) == 0) : ?>
                <p>Não há clientes cadastrados!</p>
            <?php else : ?>
                <table>
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Data de Nascimento</th>
                            <th>CPF</th>
                            <th>Email</th>
                            <th>Telefone</th>
                            <th>CEP</th>
                            <th>Rua</th>
                            <th>Bairro</th>
                            <th>Nº</th>
                            <th>Cidade</th>
                            <th>Estado</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($dados as $cliente) : ?>
                            <tr>
                                <td><?= $cliente->nome ?></td>
                                <td><?= (new DateTime($cliente->data_nasc))->format('d/m/Y'); ?></td>
                                <td><?= $cliente->cpf ?></td>
                                <td><?= $cliente->email ?></td>
                                <td><?= $cliente->telefone ?></td>
                                <td><?= $cliente->cep ?></td>
                                <td><?= $cliente->rua ?></td>
                                <td><?= $cliente->bairro ?></td>
                                <td><?= $cliente->numero ?></td>
                                <td><?= $cliente->cidade ?></td>
                                <td><?= $cliente->estado ?></td>
                                <td>
                                    <form action="/cliente-editar" method="GET">
                                    <button class="button-list" type="submit" name="editar" value="<?= $cliente->cpf ?>">
                                        <img src="../../public/IMG/pencil.png" width="20" height="20">
                                    </button>
                                    </form>
                                </td>
                                <td>
                                    <form action="/cliente-excluir" method="GET">
                                    <button class="button-list" type="submit" name="excluir" value="<?= $cliente->cpf ?>">
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