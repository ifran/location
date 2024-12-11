<!doctype html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <title>Home</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/album/">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@docsearch/css@3">
    <link href="assets/dist/css/bootstrap.min.css" rel="stylesheet">

    <script src="https://unpkg.com/@googlemaps/markerclusterer/dist/index.min.js"></script>
    <script async
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDiHZeqzK9xvUnsPTt9_6BJ4766ew0vT3w&callback=console.debug&libraries=maps,marker&v=beta">
    </script>

    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }

        .b-example-divider {
            width: 100%;
            height: 3rem;
            background-color: rgba(0, 0, 0, .1);
            border: solid rgba(0, 0, 0, .15);
            border-width: 1px 0;
            box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
        }

        .b-example-vr {
            flex-shrink: 0;
            width: 1.5rem;
            height: 100vh;
        }

        .bi {
            vertical-align: -.125em;
            fill: currentColor;
        }

        .nav-scroller {
            position: relative;
            z-index: 2;
            height: 2.75rem;
            overflow-y: hidden;
        }

        .nav-scroller .nav {
            display: flex;
            flex-wrap: nowrap;
            padding-bottom: 1rem;
            margin-top: -1px;
            overflow-x: auto;
            text-align: center;
            white-space: nowrap;
            -webkit-overflow-scrolling: touch;
        }

        .btn-bd-primary {
            --bd-violet-bg: #712cf9;
            --bd-violet-rgb: 112.520718, 44.062154, 249.437846;

            --bs-btn-font-weight: 600;
            --bs-btn-color: var(--bs-white);
            --bs-btn-bg: var(--bd-violet-bg);
            --bs-btn-border-color: var(--bd-violet-bg);
            --bs-btn-hover-color: var(--bs-white);
            --bs-btn-hover-bg: #6528e0;
            --bs-btn-hover-border-color: #6528e0;
            --bs-btn-focus-shadow-rgb: var(--bd-violet-rgb);
            --bs-btn-active-color: var(--bs-btn-hover-color);
            --bs-btn-active-bg: #5a23c8;
            --bs-btn-active-border-color: #5a23c8;
        }

        .bd-mode-toggle {
            z-index: 1500;
        }

        .bd-mode-toggle .dropdown-menu .active .bi {
            display: block !important;
        }
    </style>
</head>

<body>
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
                <a href="./about" class="navbar-brand d-flex align-items-center">
                    <strong>Sobre Nós</strong>
                </a>
                <a href="./logout" class="navbar-brand d-flex align-items-center">
                    <strong>Sair</strong>
                </a>
            </div>
        </div>
    </header>

    @if (!$hasLocation)
        <div class="d-flex justify-content-center align-items-center" style="height: 100vh;">
            <p class="text-center mb-0">Sem local cadastrado</p>
        </div>
    @else
        <div class="d-flex">
            <div class="p-3 bg-secondary text-white" style="width: 100vw; height: 92vh;" id="map"></div>

            <div class="row" style="margin: 0">
                <div class="col overflow-auto" style="height: 85vh;">
                    <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#filters"
                        aria-expanded="false" aria-controls="filters" style="width: 100%">
                        Filtrar Locais
                    </button>
                    <div id="filters" class="collapse">
                        <form action="./home" method="post">
                            @csrf
                            <div class="mb-3">
                                <label for="nome">Nome do Local</label>
                                <input type="text" class="form-control" id="nome" name="nome">
                            </div>
                            <div class="mb-3">
                                <label for="endereco">Endereço Aproximado</label>
                                <input type="text" class="form-control" id="endereco" name="endereco">
                            </div>
                            <input class="btn btn-secondary" type="submit" style="width: 100%" value="Aplicar filtros">
                        </form>
                    </div>
                    @foreach ($locations as $location)
                        <div class="card shadow-sm d-flex flex-row align-items-center">
                            <img src="{{ asset('storage/images') . '/' . $location->location_img }}"
                                style="height: 20vh; width: 10vw; margin-right: 10px;" alt="Imagem">
                            <div class="card-body">
                                <p class="card-text">
                                    <label>Nome: </label>
                                    {{ $location->location_name }}
                                </p>
                                <p class="card-text">
                                    <label>Endereço: </label>
                                    {{ $location->location_address }}
                                </p>
                                <p class="card-text">
                                    {{ $location->location_desc }}
                                </p>
                                <div class="btn-group">
                                    <a type="button" href="./register-location?id={{ $location->location_id }}" class="btn btn-sm btn-outline-secondary">Edit</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif

    <script type="module">
        async function initMap() {
            const {
                Map,
                InfoWindow
            } = await google.maps.importLibrary("maps");

            const {
                AdvancedMarkerElement,
                PinElement
            } = await google.maps.importLibrary(
                "marker",
            );

            const map = new google.maps.Map(document.getElementById("map"), {
                zoom: 9,
                center: {
                    lat: -30.0171167,
                    lng: -51.1908724
                },
                mapId: "AIzaSyDiHZeqzK9xvUnsPTt9_6BJ4766ew0vT3w",
            });

            const infoWindow = new google.maps.InfoWindow({
                content: "",
                disableAutoPan: true,
            });

            const labels = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";

            const markers = locations.map((position, i) => {
                const label = labels[i % labels.length];
                const pinGlyph = new google.maps.marker.PinElement({
                    glyph: label,
                    glyphColor: "white",
                });


                const marker = new google.maps.marker.AdvancedMarkerElement({
                    position,
                    content: pinGlyph.element,
                });

                google.maps.event.addListener(marker, 'click', function(evt) {
                    console.log(marker.position.Fg);
                    console.log(marker.position.Hg);

                });

                marker.addListener("click", () => {
                    infoWindow.setContent(position.lat + ", " + position.lng);
                    infoWindow.open(map, marker);
                });

                return marker;
            });

            const markerCluster = new markerClusterer.MarkerClusterer({
                markers,
                map
            });
        }

        const locations = [
            @php
                $val = '';
                foreach ($locations as $location) {
                    $val .= '{ lat: ' . $location->location_lat . ',' . 'lng:' . $location->location_long . '},';
                }

                $val = substr($val, 0, -1);
                echo $val;
            @endphp
        ];

        initMap();
    </script>

    <style>
        #map {
            height: 100%;
        }

        html,
        body {
            height: 100%;
            margin: 0;
            padding: 0;
        }
    </style>

    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>

    <script>
        (g => {
            var h, a, k, p = "The Google Maps JavaScript API",
                c = "google",
                l = "importLibrary",
                q = "__ib__",
                m = document,
                b = window;
            b = b[c] || (b[c] = {});
            var d = b.maps || (b.maps = {}),
                r = new Set,
                e = new URLSearchParams,
                u = () => h || (h = new Promise(async (f, n) => {
                    await (a = m.createElement("script"));
                    e.set("libraries", [...r] + "");
                    for (k in g) e.set(k.replace(/[A-Z]/g, t => "_" + t[0].toLowerCase()), g[k]);
                    e.set("callback", c + ".maps." + q);
                    a.src = `https://maps.${c}apis.com/maps/api/js?` + e;
                    d[q] = f;
                    a.onerror = () => h = n(Error(p + " could not load."));
                    a.nonce = m.querySelector("script[nonce]")?.nonce || "";
                    m.head.append(a)
                }));
            d[l] ? console.warn(p + " only loads once. Ignoring:", g) : d[l] = (f, ...n) => r.add(f) && u().then(() =>
                d[l](f, ...n))
        })
        ({
            key: "AIzaSyDiHZeqzK9xvUnsPTt9_6BJ4766ew0vT3w",
            v: "weekly"
        });
    </script>
    <script src="assets/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
