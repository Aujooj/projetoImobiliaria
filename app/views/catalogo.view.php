<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="../../public/css/style.css">
    <title>Catálogo de Imóveis</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }

        #content {
            margin-right: 500px;
            margin-left: 0px;
            padding: 10px;
        }

        #content h1 {
            margin-top: 0;
        }

        form {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        label {
            margin-right: 10px;
        }

        input {
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type="submit"] {
            background-color: #f8b739;
            color: #fff;
            cursor: pointer;
            border-color: #f8b739;
        }

        .imovel-card {
            display: flex;
            margin-bottom: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .imovel-card img {
            max-width: 30%;
            border-top-left-radius: 8px;
            border-bottom-left-radius: 8px;
        }

        .imovel-details {
            padding: 20px;
        }

        .imovel-details h3 {
            margin-bottom: 10px;
        }

        .imovel-details p {
            color: #555;
        }

        .btn-primary {
            background-color: #f8b739;
            color: #fff;
            text-decoration: none;
            padding: 8px 12px;
            border-radius: 4px;
            display: inline-block;
        }

        .btn-primary:hover {
            background-color: #f8b739;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <nav id="sidebar">

        </nav>
        <div id="content">
            <h1 class="text-left mb-5">Catálogo de Imóveis</h1>

            <!-- Formulário de Filtros -->
            <form method="get">
                <label for="tipo_imovel">Tipo de Imóvel:</label>
                <select name="tipo_imovel" id="tipo_imovel">
                    <option value="" <?= empty($_GET['tipo_imovel']) ? 'selected' : '' ?>>Todos</option>
                    <option value="Casa Residencial" <?= ($_GET['tipo_imovel'] ?? '') === 'Casa Residencial' ? 'selected' : '' ?>>Casa Residencial</option>
                    <option value="Apartamento" <?= ($_GET['tipo_imovel'] ?? '') === 'Apartamento' ? 'selected' : '' ?>>
                        Apartamento</option>
                    <option value="Chácara" <?= ($_GET['tipo_imovel'] ?? '') === 'Chácara' ? 'selected' : '' ?>>Chácara
                    </option>
                    <option value="Comercial" <?= ($_GET['tipo_imovel'] ?? '') === 'Comercial' ? 'selected' : '' ?>>
                        Comercial</option>
                    <option value="Condomínio" <?= ($_GET['tipo_imovel'] ?? '') === 'Condomínio' ? 'selected' : '' ?>>
                        Condomínio</option>
                    <option value="Terreno" <?= ($_GET['tipo_imovel'] ?? '') === 'Terreno' ? 'selected' : '' ?>>Terreno
                    </option>

                </select>

                <label for="tipo_contrato">Tipo de Contrato:</label>
                <select name="tipo_contrato" id="tipo_contrato">
                    <option value="" <?= empty($_GET['tipo_contrato']) ? 'selected' : '' ?>>Todos</option>
                    <option value="Locação" <?= ($_GET['tipo_contrato'] ?? '') === 'Locação' ? 'selected' : '' ?>>Locação
                    </option>
                    <option value="Venda" <?= ($_GET['tipo_contrato'] ?? '') === 'Venda' ? 'selected' : '' ?>>Venda
                    </option>
                </select>

                <label for="quartos">Quartos:</label>
                <input type="number" name="quartos" id="quartos" min="0"
                    value="<?= isset($_GET['quartos']) ? $_GET['quartos'] : '' ?>">

                <label for="banheiros">Banheiros:</label>
                <input type="number" name="banheiros" id="banheiros" min="0"
                    value="<?= isset($_GET['banheiros']) ? $_GET['banheiros'] : '' ?>">

                <label for="garagem">Garagem:</label>
                <input type="number" name="garagem" id="garagem" min="0"
                    value="<?= isset($_GET['garagem']) ? $_GET['garagem'] : '' ?>">

                <input type="submit" value="Filtrar">
            </form>

            <?php
            require_once './app/models/Imovel.php';
            $imovelModel = new Imovel();

            $quartos = isset($_GET['quartos']) ? $_GET['quartos'] : null;
            $banheiros = isset($_GET['banheiros']) ? $_GET['banheiros'] : null;
            $garagem = isset($_GET['garagem']) ? $_GET['garagem'] : null;
            $tipoImovel = isset($_GET['tipo_imovel']) ? $_GET['tipo_imovel'] : null;
            $tipoContrato = isset($_GET['tipo_contrato']) ? $_GET['tipo_contrato'] : null;

            $imoveis = $imovelModel->listarComFiltros($quartos, $banheiros, $garagem, $tipoImovel, $tipoContrato);

            if (!empty($imoveis)) {
                foreach ($imoveis as $imovel) {
                    if ($imovel->imovel_disponivel == true) {
                        echo '<div class="imovel-card">';
                        echo '<img src="' . $imovel->foto . '" alt="Imagem do Imóvel">';
                        echo '<div class="imovel-details">';
                        echo '<h3>' . $imovel->tipo_imovel . '</h3>';
                        echo '<p>Endereço: ' . $imovel->rua . ', ' . $imovel->numero . ', ' . $imovel->bairro . ', ' . $imovel->cidade . '</p>';
                        echo '<p>Área: ' . $imovel->area_total .'m²</p>';
                        echo '<a href="/imovel/' . $imovel->id_imovel . '" class="btn-primary">Ver Detalhes</a>';
                        echo '</div></div>';
                    }
                }
            } else {
                echo '<p>Não há imóveis cadastrados!</p>';
            }
            ?>
        </div>
    </div>
    <script src="../../public/js/home.js"></script>
</body>

</html>