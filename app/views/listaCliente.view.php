<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <link rel="stylesheet" type="text/css" href="../../public/css/home.css">
    <title>Listagem de clientes</title>
    <meta charset="UTF-8">
</head>

<body>
    <div class="wrapper d-flex align-items-stretch">
        <?php require("layout/sidebar.view.php"); ?>
        <div id="content" class="p-4 p-md-5">
            <h1>Listagem de clientes</h1>
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