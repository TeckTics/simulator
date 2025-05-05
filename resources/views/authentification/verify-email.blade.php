<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap"
        rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp,container-queries"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.css" />
    {{-- <script src="https://www.google.com/recaptcha/api.js"></script> --}}
    {{-- <script src="https://www.google.com/recaptcha/api.js?render=6LepvmgqAAAAAFoF6YlKswfbC1OjRsfaBVhH38rJ"></script> --}}
    <title>S'authentifier - UrgenceSAMU</title>

    <script src='https://www.google.com/recaptcha/api.js?render=6LeBkIIqAAAAAOXLMWogm2VFjL7tNGPQ57JWRs60'></script>
    {!! htmlScriptTagJsApi() !!}
</head>

<style>
    .leaflet-control-container .leaflet-routing-container-hide {
        display: none;
    }
</style>

<body>
    <main>
        <div class=" min-h-screen bg-blue-50" style="background-color: #1b1b1b;">
            <div class="flex relative flex-col min-h-screen  h-full items-center justify-center "
                style="background-color: #327ca750;">

                <div
                    class="w-fit bg-white absolute top-8 left-8 z-50 px-3 shadow-lg shadow-black/30 py-2 mt-4 rounded-md">
                    <a href="{{ url('/') }}"
                        class=" text-sm font-semibold rounded-md text-black hover:text-blue-700">Retour à
                        l'accueil</a>   
                </div>

                <div id="map"
                    class="w-full top-0 left-0  absolute z-30 opacity-30 h-full shadow-black  z-10  overflow-hidden">
                </div>
            </div>
            <div class="fixed z-40 top-0 flex items-center justify-center w-full h-full p-3 md:p-0">
                <div class="bg-white text-center rounded-2xl p-8 max-w-md">
                    <P>
                        <span class="text-2xl text-blue-700 font-semibold">
                            Vérifiez votre boîte mail (y compris les spams) et cliquez sur le lien pour confirmer votre inscription.
                        </span> <br> 
                        <span class="text-sm"></span>
                    </P>
                    <P>  <a href="{{ url('/connexion') }}"
                        class=" text-sm rounded-md text-black hover:text-blue-700">Retour à Page de connexion</a></P>
                </div>
            </div>
        </div>
    </main>
</body>
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
<script src="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.js"></script>
<script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

<!-- Core plugin JavaScript-->
<script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>
<script>
    let form = document.querySelector('#btnForm');
    let loader = document.querySelector('#loader')
    let bol = false
    form.addEventListener('click', function(event) {
        if (!bol) {
            loader.style.display = 'block';
            loader.classList.replace('hidden', 'flex');
            bol = true
        }
    });
    const passwordButton = document.getElementById("passwordButton");
    const hiddenPassword = document.getElementById("hiddenPassword");
    const showPassword = document.getElementById("showPassword");
    const password = document.getElementById("password");
    var osm = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    });




    // L.icon permet de créer un icon 
    // var map = L.map('map').setView([51.505, -0.09], 13);

    // Initialisation de la carte et du marqueur

    var map = L.map('map').setView([46, 2], 1.2);
    osm.addTo(map);
    let markeurs = [];
    var marker = L.marker([46, 2]).addTo(map)

    const routing = (latF, lngF, lat, lng, marqueur) => {
        const r = L.Routing.control({
            waypoints: [
                L.latLng(lat, lng),
                L.latLng(latF, lngF),
            ],
            createMarker: function(i, waypoint) {
                return L.marker(waypoint.latLng);
            },
        }).on('routesfound', function(e) {
            const route = e.routes[0];
            const totalSteps = route.coordinates.length;
            let currentStep = 0; // 
            function animateRoute() {
                if (currentStep < totalSteps) {
                    marqueur.setLatLng(route.coordinates[currentStep]);
                    currentStep++;
                    setTimeout(animateRoute, 250); // Adjust animation speed as needed
                }
            }
            animateRoute();

        }).addTo(map)
        const tab = document.querySelector('.leaflet-right');
        if (tab) {
            tab.remove()
        }
    }
    routing(45.98, 1.98, 46, 2, marker);


    window.addEventListener('load', () => {
        let show = false;
        passwordButton.addEventListener('click', () => {
            if (!show) {
                hiddenPassword.classList.remove('hidden');
                showPassword.classList.add('hidden');
                password.type = 'text';
                show = true;
            } else {
                hiddenPassword.classList.add('hidden');
                showPassword.classList.remove('hidden');
                password.type = 'password';
                show = false;
            }
        })

        // signinButton.addEventListener('click', () => {
        //     window.location.href = "../dashboard/index.html";

        // });
    })
</script>

</html>
