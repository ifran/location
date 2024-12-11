<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Location</title>

    <link href="assets/dist/css/bootstrap.min.css" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body {
            color: white;
        }
    </style>
</head>

<body class="bg-dark">

    <header data-bs-theme="dark">
        <div class="navbar navbar-dark bg-dark shadow-sm">
            <div class="container">
                <a href="./home" class="navbar-brand d-flex align-items-center">
                    <strong>Home</strong>
                </a>
                <a href="./user" class="navbar-brand d-flex align-items-center">
                    <strong>Usuário</strong>
                </a>
                <a href="./register-location" class="navbar-brand d-flex align-items-center">
                    <strong>Registrar Local</strong>
                </a>
                <a href="./logout" class="navbar-brand d-flex align-items-center">
                    <strong>Sair</strong>
                </a>
            </div>
        </div>
    </header>

    <div class="container">
        <div class="py-5 text-center">
            <h2>Registro de Local</h2>
        </div>

        <div class="row">
            <div class="col-md-8 order-md-1">
                <form class="needs-validation" id="local-form">
                    @csrf
                    <input type="hidden" name="id" value="{{ $location->location_id ?? null }}">
                    <div class="mb-3">
                        <label for="nome">Nome do Local</label>
                        <input type="text" class="form-control" id="nome" name="nome" value="{{ $location->location_name ?? null }}">
                    </div>

                    <div class="mb-3">
                        <label for="imagem" class="form-label">Imagem do Local</label>
                        <input type="file" class="form-control" id="imagem" name="imagem" value="{{ $location->location_img ?? null }}">
                    </div>

                    <div class="mb-3">
                        <label for="estado">Estado</label>
                        <input type="text" class="form-control" id="estado" name="estado">
                    </div>

                    <div class="mb-3">
                        <label for="cidade">Cidade</label>
                        <input type="text" class="form-control" id="cidade" name="cidade">
                    </div>

                    <div class="mb-3">
                        <label for="bairro">Bairro</label>
                        <input type="text" class="form-control" id="bairro" name="bairro">
                    </div>

                    <div class="mb-3">
                        <label for="endereco">Endereço</label>
                        <input type="text" class="form-control" id="endereco" name="endereco" value="{{ $location->location_address ?? null }}">
                    </div>

                    <div class="mb-3">
                        <label for="numero">Número</label>
                        <input type="text" class="form-control" id="numero" name="numero">
                    </div>

                    <div class="mb-3">
                        <label for="numero">Descrição</label>
                        <textarea class="form-control" id="descricao" rows="3" name="descricao">{{ $location->location_desc ?? null }}</textarea>
                    </div>

                    <hr class="mb-4">
                    <button class="btn btn-primary btn-lg btn-block" type="button"
                        onclick="findLocation()">Registrar</button>
                </form>
            </div>
        </div>
    </div>
    <br>

    <script>
        function findLocation() {
            estado = $('#estado').val();
            cidade = $('#cidade').val();
            bairro = $('#bairro').val();
            endereco = $('#endereco').val();
            numero = $('#numero').val();

            if (cidade == "") {
                alert("Preencher cidade");
                return;
            }

            if (endereco == "") {
                alert("Preencher endereço");
                return;
            }

            if (numero == "") {
                alert("Preencher número");
                return;
            }

            address = "address=" + estado + cidade + bairro + endereco + numero
            address += "&key=AIzaSyDiHZeqzK9xvUnsPTt9_6BJ4766ew0vT3w";

            $.ajax({
                url: 'https://maps.googleapis.com/maps/api/geocode/json?' + address,
                type: 'GET',
                success: function(data) {
                    lat = data.results[0].geometry.location.lat;
                    lng = data.results[0].geometry.location.lng;
                    saveLocal(lat, lng);
                },
                error: function(error) {
                    alert("Endereço não encontrado");
                }
            });
        }

        function saveLocal(lat, lng) {
            var form = document.getElementById('local-form');
            var formData = new FormData(form);

            var fileInput = document.getElementById('imagem');
            if (fileInput && fileInput.files[0]) {
                formData.append('imagem', fileInput.files[0]);
            }

            formData.append('lat', lat);
            formData.append('lng', lng);
            formData.append('_token', document.getElementsByName('_token')[0].value);

            $.ajax({
                url: './register-location',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(data) {
                    if (data.msg == "Sucesso") {
                        window.location.href = './home';
                    }
                },
                error: function(error) {
                    console.log(error);
                }
            });

        }
    </script>
</body>

</html>
