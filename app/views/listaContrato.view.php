<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <link rel="stylesheet" type="text/css" href="../../public/css/home.css">
    <title>Contratos</title>
    <meta charset="UTF-8">
</head>

<body>
    <div class="wrapper d-flex align-items-stretch">
        <?php 
            require("layout/sidebar.view.php");
            $cliente = new Cliente();
        ?>
        <div id="content" class="p-4 p-md-5">
            <h1>Contratos</h1>
            <?php if (sizeof($dados) == 0) : ?>
                <p>Não há contratos cadastrados!</p>
            <?php else : ?>
                <table>
                    <thead>
                        <tr>
                            <th>N° Contrato</th>
                            <th>Id Imovel</th>
                            <th>Tipo</th>
                            <th>Data Inicial</th>
                            <th>Data Final</th>
                            <th>Inquilino</th>
                            <th>Assinado</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($dados as $contrato) : ?>
                            <tr>
                                <td><?= $contrato->id_contrato?></td>
                                <td><?= $contrato->id_imovel?></td>
                                <td><?= $contrato->tipo ?></td>
                                <td><?= (new DateTime($contrato->data_inicial))->format('d/m/Y'); ?></td>
                                <td><?= (new DateTime($contrato->data_final))->format('d/m/Y'); ?></td>
                                <?php $inquilino = $cliente->buscarEntityClienteId($contrato->inquilino) ?>
                                <td><?= $inquilino[0]["nome"] ?></td>
                                <td>
                                    <?php
                                    if ($contrato->assinado) {
                                        echo 'Sim';
                                    } else {
                                        echo 'Não';
                                    }
                                    ?>
                                </td>
                                <td>
                                    <?php if(!$contrato->assinado):?>
                                    <form action="/contrato-assinar" method="POST">
                                        <button class="button-list" type="submit" name="id_contrato" value="<?= $contrato->id_contrato ?>">
                                            <img src="../../public/IMG/pencil.png" width="20" height="20">
                                        </button>
                                    </form>
                                    <?php endif;?>
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
