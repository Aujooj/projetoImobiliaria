<!-- detalhesImovel.php -->
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="../../public/css/style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Detalhes do Imóvel</title>
    <style>
        /* Adicione estilos personalizados aqui, se necessário */
        body {
            background-color: #DBDBDB;
        }

        .wrapper {
            padding-top: 20px;
        }

        .img-fluid {
            max-width: 100%;
            height: auto;
        }

        .details-container {
            padding: 20px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            font-size: 24px;
        }

        h2 {
            font-size: 28px;
            color: ##f8b739;
        }

        strong {
            font-weight: bold;
        }

        p {
            margin-bottom: 10px;
        }

        .btn-gerar-contrato {
            margin-top: 15px;
            border-color: #f8b739;
            background-color: #f8b739;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="details-container">
            <h1 class="mb-4">Detalhes do Imóvel</h1>

            <?php
            require_once './app/models/Imovel.php';
            require_once './app/models/cliente.php';
            $cliente = new cliente;
            $proprietario = $cliente->buscarEntityClienteId($imovel["proprietario"]);

            if (isset($imovel)) {
                if (!empty($imovel)) {
                    echo '<div class="row">';
                    echo '<div class="col-md-6">';
                    echo '<img src="' . $imovel['foto'] . '" class="img-fluid" alt="Imagem do Imóvel">';
                    echo '</div>';
                    echo '<div class="col-md-6">';
                    echo '<h2>' . $imovel['tipo_imovel'] . '</h2>';
                    echo '<p><strong>Endereço:</strong> ' . $imovel['rua'] . ', ' . $imovel['numero'] . ', ' . $imovel['bairro'] . ', ' . $imovel['cidade'] . '</p>';
                    echo '<p><strong>Valor:</strong> R$ ' . number_format($imovel['valor'], 2, ',', '.') . '</p>';
                    echo '<p><strong>Área Total:</strong> ' . $imovel['area_total'] . ' m²</p>';
                    echo '<p><strong>Dormitórios:</strong> ' . $imovel['dormitorios'] . '</p>';
                    echo '<p><strong>Banheiros:</strong> ' . $imovel['banheiros'] . '</p>';
                    echo '<p><strong>Garagem:</strong> ' . $imovel['garagem'] . '</p>';
                    echo '<p><strong>Tipo de contrato:</strong> ' . $imovel['tipo_contrato'];
                    echo '<p><strong>Proprietário:</strong> ' . $proprietario[0]['nome'] . '</p>';
                    session_start();
                    $logado = $_SESSION['logado'] ?? false;
                    if ($logado && $imovel['imovel_disponivel']) {
                        // Botão "Gerar Contrato"
                        echo '<a href="/contrato-cadastrar/' . $imovel['id_imovel'] . '" class="btn btn-primary btn-gerar-contrato">Gerar Contrato</a>';
                        echo '<a>                                                </a>';
                        // Botão "Agendar Visitação"
                        if ($imovel['chave_disponivel']) {
                            echo '<a href="/visita-cadastrar/' . $imovel['id_imovel'] . '" class="btn btn-primary btn-gerar-contrato">Agendar Visitação</a>';
                        }else{
                            echo '<a href="/visita-devolver/' . $imovel['id_imovel'] . '" class="btn btn-primary btn-gerar-contrato">Devolver Chave</a>';

                        }
                    }

                    echo '</div></div>';
                } else {
                    echo '<p class="text-danger">Imóvel não encontrado!</p>';
                }
            } else {
                echo '<p class="text-danger">Parâmetro ID do Imóvel não especificado!</p>';
            }
            ?>

        </div>
    </div>
    <script src="../../public/js/home.js"></script>
</body>

</html>