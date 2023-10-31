<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="../../public/bootstrap-5.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../../public/css/home.css">
    <!-- Arquivos CSS do Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">


    <!-- Arquivos JavaScript do Bootstrap -->
    <script link="../../public/bootstrap-5.1.3/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="card">
            <img src="public/IMG/logo.png" class="card-img-top" alt="Logo da empresa Estelar"">
            <div class="card-body">
                <h2 class="card-title text-center mb-4">Login</h2>
                <form action="/" method="POST">

                    <?php if ($_POST['erro'] ?? false) : ?>
                        <div style="background: #FB4B4E; padding: 15px; margin-bottom: 24px; color: white;">
                            Creci ou Senha inválidos! Tente novamente.
                        </div>
                    <?php endif; ?>

                    <div class="mb-3">
                        <label for="creci" class="form-label">Creci</label>
                        <input type="text" class="form-control" id="creci" name="creci" required>
                    </div>
                    <div class="mb-3">
                        <label for="senha" class="form-label">Senha</label>
                        <input type="password" class="form-control" id="senha" name="senha" required>
                    </div>
                    <button type="submit" class="round-button" style="display:flex; width:100%; justify-content:center;">Login</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>