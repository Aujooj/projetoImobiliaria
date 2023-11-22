<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../../public/css/style.css">
    <link rel="stylesheet" type="text/css" href="../../public/css/home.css">
    <title>Listagem de imóveis</title>
</head>

<body>
    <div class="wrapper d-flex align-items-stretch">
        <?php require("layout/sidebar.view.php"); ?>
        <div id="content" class="p-4 p-md-5">
            <h1>Listagem de imóveis</h1>
            <a href="/imovel-cadastrar" class="round-button">+</a>
            <?php if (sizeof($dados) == 0) : ?>
                <p>Não há imóveis cadastrados!</p>
            <?php else : ?>
                <table>
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Tipo</th>
                            <th>CEP</th>
                            <th>Rua</th>
                            <th>Bairro</th>
                            <th>Nº</th>
                            <th>Cidade</th>
                            <th>UF</th>
                            <th>Valor</th>
                            <th>Condominio</th>
                            <th>Área Total</th>
                            <th>Dormitórios</th>
                            <th>Banheiros</th>
                            <th>Garagem</th>
                            <th>Proprietário</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($dados as $imovel) : ?>
                            <tr>
                                <td><?= $imovel->id_imovel ?></td>
                                <td><?= $imovel->tipo ?></td>
                                <td><?= $imovel->cep ?></td>
                                <td><?= $imovel->rua ?></td>
                                <td><?= $imovel->bairro ?></td>
                                <td><?= $imovel->numero ?></td>
                                <td><?= $imovel->cidade ?></td>
                                <td><?= $imovel->estado ?></td>
                                <td><?= 'R$ '; echo($imovel->valor) ?></td>
                                <td><?php 
                                    if($imovel->condominio) {
                                        echo'Sim';
                                    } else {
                                        echo'Não';
                                    }
                                ?></td>
                                <td><?= $imovel->area_total; echo'm²'; ?></td>
                                <td><?= $imovel->dormitorios ?></td>
                                <td><?= $imovel->banheiros ?></td>
                                <td><?= $imovel->garagem ?></td>
                                <td><?= $imovel->nome ?></td>
                                <td>
                                    <form action="/imovel-editar" method="GET">
                                    <button class="button-list" type="submit" name="editar" value="<?= $imovel->id_imovel ?>">
                                        <img src="../../public/IMG/pencil.png" width="20" height="20">
                                    </button>
                                    </form>
                                </td>
                                <td>
                                    <form action="/imovel-excluir" method="GET">
                                    <button class="button-list" type="submit" name="excluir" value="<?= $imovel->id_imovel ?>">
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
</body>

</html>