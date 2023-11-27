<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <link rel="stylesheet" type="text/css" href="../../public/css/home.css">
    <title>Visitas</title>
    <meta charset="UTF-8">
</head>

<body>
    <div class="wrapper d-flex align-items-stretch">
        <?php 
            require("layout/sidebar.view.php");
            $cliente = new Cliente();
            $imovel = new Imovel();
            $corretor = new Corretor();
        ?>
        <div id="content" class="p-4 p-md-5">
            <h1>Visitas</h1>
            <?php if (sizeof($dados) == 0) : ?>
                <p>Não há visitas cadastradas!</p>
            <?php else : ?>
                <table>
                    <thead>
                        <tr>
                            <th>N° Visita</th>
                            <th>Id Imovel</th>
                            <th>Data Inicial</th>
                            <th>Data Final</th>
                            <th>Cliente</th>
                            <th>Corretor</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($dados as $visita) : ?>
                            <tr>
                                <td><?= $visita->id_visitacao?></td>
                                <td><?= $visita->imovel?></td>
                                <td><?= (new DateTime($visita->data_inicial))->format('d/m/Y'); ?></td>
                                <td><?= (new DateTime($visita->data_final))->format('d/m/Y'); ?></td>
                                <?php $clienteVisita = $cliente->buscarEntityClienteId($visita->cliente) ?>
                                <?php $corretorVisita = $corretor->buscarEntityCorretoriD($visita->corretor) ?>
                                <td><?= $clienteVisita[0]["nome"] ?></td>
                                <td><?= $corretorVisita[0]["nome"] ?></td>
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
