<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="favicon.ico">

    <title>Exemplo de formulário para checkout usando Bootstrap</title>
    <link href="assets/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-center">
    <div class="container">
        <div class="py-5 text-center">
        </div>

        <div class="row">
            <div class="col-md-8 order-md-1">
                <h4 class="mb-3">Cadastrar Usuário</h4>
                <form class="needs-validation" action="register" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="name">Nome</label>
                        <input type="name" class="form-control" id="name" name="name" autocomplete="off">
                    </div>

                    <div class="mb-3">
                        <label for="phone">Telefone</label>
                        <input type="text" class="form-control" id="phone" name="phone" autocomplete="off">
                    </div>

                    <div class="mb-3">
                        <label for="email">Email</label>
                        <input type="text" class="form-control" id="email" name="email"
                            placeholder="fulano@exemplo.com" autocomplete="off">
                    </div>

                    <div class="mb-3">
                        <label for="pass">Senha</label>
                        <input type="password" class="form-control" id="pass" name="pass" autocomplete="off">
                    </div>

                    <hr class="mb-4">
                    <button class="btn btn-primary btn-lg btn-block" type="submit">Cadastrar</button>
                </form>
            </div>
        </div>

        <footer class="my-5 pt-5 text-muted text-center text-small"></footer>
    </div>
</body>

</html>
