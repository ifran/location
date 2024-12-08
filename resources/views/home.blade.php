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
            <div class="p-3 bg-secondary text-white" style="width: 100vw; height: 90vh;" id="map"></div>

            <div class="row">
                <div class="col">
                    <div class="card shadow-sm">
                        <img src="aaa" />
                        <div class="card-body">
                            <p class="card-text">
                                This is a wider card with supporting text below as a natural
                                lead-in to additional content. This content is a little bit longer.
                            </p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-sm btn-outline-secondary">View</button>
                                    <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button>
                                </div>
                                <small class="text-body-secondary">9 mins</small>
                            </div>
                        </div>
                    </div>
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

            // Create an array of alphabetical characters used to label the markers.
            const labels = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";

            // Add some markers to the map.
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
                    // BUSCAR OS LOCAIS PELAS LAT LONG
                    console.log(marker.position.Fg);
                    console.log(marker.position.Hg);

                });

                // markers can only be keyboard focusable when they have click listeners
                // open info window when marker is clicked
                marker.addListener("click", () => {
                    infoWindow.setContent(position.lat + ", " + position.lng);
                    infoWindow.open(map, marker);
                });

                return marker;
            });

            // Add a marker clusterer to manage the markers.
            const markerCluster = new markerClusterer.MarkerClusterer({
                markers,
                map
            });
        }

        const locations = [{
            lat: -30.0171167,
            lng: -51.1908724
        }, {

            lat: -30.0174543,
            lng: -51.1914113
        }, {
            lat: -30.078944823848122,
            lng: -51.22699349840304
        }];

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
