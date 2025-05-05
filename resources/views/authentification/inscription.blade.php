<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp,container-queries"></script>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap"
        rel="stylesheet">
    <title>Inscription - UrgenceSAMU</title>
</head>
<style>
        .inter-<uniquifier> {
        font-family: "Inter", serif;
        font-optical-sizing: auto;
        font-weight: <weight>;
        font-style: normal;
    }

    .plus-jakarta-sans-<uniquifier> {
        font-family: "Plus Jakarta Sans", serif;
        font-optical-sizing: auto;
        font-weight: <weight>;
        font-style: normal;
    }

    * {
        font-family: "Plus Jakarta Sans"
    }
</style>
<body>
    <main>
        <div class=" min-h-screen bg-blue-50" style="background-color: #1b1b1b;">
            <div class="flex relative flex-col min-h-screen  h-full items-center justify-center "
                style="background-color: #327ca750;">
           
                <div id="map"
                    class="w-full top-0 left-0  absolute z-0 opacity-30 h-full shadow-black  z-10  overflow-hidden">
                </div>
            </div>
            <div class="fixed z-40 top-0 overflow-y-auto flex items-center justify-center w-full h-full p-3 md:p-0">
                <form id="signinForm" action="{{ url('/auth/register') }}" method="POST"
                    class="w-full p-8 m-auto bg-[#14264b] rounded-xl shadow-xl   " style="max-width: 456px;  ">
                    @csrf
                    <div class="space-y-12">
                        <div class="space-y-12">
                            <div class="pb-12 ">
                                <div class="text-center">
                                    <img src="{{ asset('assets/images/Urgence.png') }}" width="200px"
                                        class="rounded-full mx-auto" alt="UrgenceSamu logo" />
                                </div>
                                <p class=" text-[14px] text-white text-center">Sauvez des vies en gérant vos unités de
                                    secours avec efficacité!</p>
                                <h2 class="text-3xl font-bold text-center leading-7 mt-8 mb-4 text-white">Inscription</h2>
                                @isset($message)
                                    {{ message }}
                                @endisset
                                <div id="message-error" class="text-red-500 text-[14px]"></div>
                                <div class="grid grid-cols-1 gap-4 ">
                                    <div class="block mt-1" id="email-to-phone">
                                        <label for="pseudo" class="text-[14px] text-white">Pseudo</label>
                                        <p class="mb-0.5 text-gray-400 text-xs">Choissisez un pseudo minimum 3
                                            caractères</p>
                                        <div>
                                            <input type="text" required
                                                class="w-full p-2.5 text-[14px]  focus-visible:outline-none focus-visible:ring-4 focus-visible:ring-blue-500/50 focus-visible:outline-1 focus-visible:placeholder:text-blue-500 rounded-xl "
                                                placeholder="Entrer un pseudo, exp: Alec42" name="pseudo"
                                                id="pseudo">
                                        </div>
                                        @error('pseudo')
                                            <p class="ml-1 text-red-500 text-[14px]">pseudo invalide</p>
                                        @enderror
                                    </div>

                                    {{-- <div class="block" id="email-to-phone">
                                        <label for="profile" class="text-[14px] text-white">Photo de profil</label>
                                        <div class="mt-1">
                                            <input type="file" required
                                                class="w-full p-2 text-[14px]  focus-visible:outline-none focus-visible:ring-4 focus-visible:ring-blue-500/50 focus-visible:outline-1 focus-visible:placeholder:text-blue-500 rounded-xl "
                                                placeholder="Pseudo" name="profile" id="profile">
                                        </div>
                                    </div> --}}
                                    <div class="block" id="email-to-phone">
                                        <label for="email" class="text-[14px] text-white">Email</label>
                                        <p class="mb-0.5 text-gray-400 text-xs">Veuillez entrer une email valide</p>
                                        <div class="mt-1">
                                            <input type="email" required
                                                class="w-full p-2.5  text-[14px]  focus-visible:outline-none focus-visible:ring-4 focus-visible:ring-blue-500/50 focus-visible:outline-1 focus-visible:placeholder:text-blue-500 rounded-xl "
                                                placeholder="Entrer votre email" name="email" id="email">
                                        </div>
                                        @error('email')
                                            <p class="ml-1 text-red-500 text-[14px]">email invalide ou déjà enregistrée</p>
                                        @enderror
                                    </div>
                                    <input type="text" value="45.650002" name="lat" id="lat" hidden>
                                    <input type="text" value="0.16" name="lgt" id="lgt" hidden>

                                    <div class="block ">
                                        <label for="password" class="text-[14px] text-white">Mot de passe</label>
                                        <p class="mb-0.5 text-gray-400 text-xs">Veuillez entrer votre mot de passe
                                            minimum 8 caractères</p>
                                        <div class="relative mt-1">
                                            <input type="password" required
                                                class="w-full p-2.5 text-[14px]  focus-visible:outline-none focus-visible:ring-4 focus-visible:ring-blue-500/50 focus-visible:outline-1 focus-visible:placeholder:text-blue-500 rounded-xl "
                                                placeholder="Entrer votre mot de passe" name="password" id="password">
                                            <button type="button" id="passwordButton" name="showpasswordButton"
                                                class="absolute -translate-y-1/2 top-1/2 right-2 opacity-30">
                                                <svg id="hiddenPassword" width="24px" class="hidden" height="24px"
                                                    viewBox="0 0 24 24" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                        stroke-linejoin="round"></g>
                                                    <g id="SVGRepo_iconCarrier">
                                                        <path opacity="0.1"
                                                            d="M6.29528 7.87634L5 9.17162C3.66667 10.505 3 11.1716 3 12C3 12.8285 3.66667 13.4951 5 14.8285L7.12132 16.9498C9.85499 19.6835 14.2871 19.6835 17.0208 16.9498L17.4322 16.5384L14.5053 14.2619C13.9146 14.8713 13.0873 15.2501 12.1716 15.2501C10.3766 15.2501 8.92157 13.795 8.92157 12.0001C8.92157 11.3746 9.09827 10.7904 9.40447 10.2946L6.29528 7.87634Z"
                                                            fill="#323232"></path>
                                                        <path d="M3.17139 5.12988L21.1714 19.1299" stroke="#323232"
                                                            stroke-width="2" stroke-linecap="round"
                                                            stroke-linejoin="round">
                                                        </path>
                                                        <path
                                                            d="M14.3653 13.8456C13.8162 14.5483 12.9609 15 12 15C10.3431 15 9 13.6569 9 12C9 11.3256 9.22253 10.7032 9.59817 10.2021"
                                                            stroke="#323232" stroke-width="2"></path>
                                                        <path
                                                            d="M9 5.62667C11.5803 4.45322 14.7268 4.92775 16.8493 7.05025L19.8511 10.052C20.3477 10.5486 20.5959 10.7969 20.7362 11.0605C21.0487 11.6479 21.0487 12.3521 20.7362 12.9395C20.5959 13.2031 20.3477 13.4514 19.8511 13.948V13.948L19.799 14"
                                                            stroke="#323232" stroke-width="2" stroke-linecap="round"
                                                            stroke-linejoin="round"></path>
                                                        <path
                                                            d="M7.01596 8.39827C7.40649 8.00774 7.40649 7.37458 7.01596 6.98406C6.62544 6.59353 5.99228 6.59353 5.60175 6.98406L7.01596 8.39827ZM7.65685 16.2427L5.53553 14.1213L4.12132 15.5356L6.24264 17.6569L7.65685 16.2427ZM16.1421 16.2427C13.799 18.5858 10 18.5858 7.65685 16.2427L6.24264 17.6569C9.36684 20.7811 14.4322 20.7811 17.5563 17.6569L16.1421 16.2427ZM5.53553 9.8787L7.01596 8.39827L5.60175 6.98406L4.12132 8.46449L5.53553 9.8787ZM16.7465 15.6383L16.1421 16.2427L17.5563 17.6569L18.1607 17.0526L16.7465 15.6383ZM5.53553 14.1213C4.84888 13.4347 4.40652 12.9893 4.12345 12.6183C3.85798 12.2704 3.82843 12.1077 3.82843 12H1.82843C1.82843 12.7208 2.1322 13.3056 2.53341 13.8315C2.917 14.3342 3.47464 14.8889 4.12132 15.5356L5.53553 14.1213ZM4.12132 8.46449C3.47464 9.11116 2.917 9.6658 2.53341 10.1686C2.1322 10.6944 1.82843 11.2792 1.82843 12H3.82843C3.82843 11.8924 3.85798 11.7297 4.12345 11.3817C4.40652 11.0107 4.84888 10.5654 5.53553 9.8787L4.12132 8.46449Z"
                                                            fill="#323232"></path>
                                                    </g>
                                                </svg>
                                                <svg id="showPassword" width="24px" height="24px"
                                                    viewBox="0 0 24 24" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                        stroke-linejoin="round"></g>
                                                    <g id="SVGRepo_iconCarrier">
                                                        <g id="style=stroke">
                                                            <g id="eye-open">
                                                                <path id="vector (Stroke)" fill-rule="evenodd"
                                                                    clip-rule="evenodd"
                                                                    d="M12 9.75C10.755 9.75 9.75 10.755 9.75 12C9.75 13.245 10.755 14.25 12 14.25C13.245 14.25 14.25 13.245 14.25 12C14.25 10.755 13.245 9.75 12 9.75ZM8.25 12C8.25 9.92657 9.92657 8.25 12 8.25C14.0734 8.25 15.75 9.92657 15.75 12C15.75 14.0734 14.0734 15.75 12 15.75C9.92657 15.75 8.25 14.0734 8.25 12Z"
                                                                    fill="#000000"></path>
                                                                <path id="vector (Stroke)_2" fill-rule="evenodd"
                                                                    clip-rule="evenodd"
                                                                    d="M2.28282 9.27342C4.69299 5.94267 8.19618 3.96997 12.0001 3.96997C15.8042 3.96997 19.3075 5.94286 21.7177 9.27392C22.2793 10.0479 22.5351 11.0421 22.5351 11.995C22.5351 12.948 22.2792 13.9424 21.7174 14.7165C19.3072 18.0473 15.804 20.02 12.0001 20.02C8.19599 20.02 4.69264 18.0471 2.28246 14.716C1.7209 13.942 1.46509 12.9478 1.46509 11.995C1.46509 11.0419 1.721 10.0475 2.28282 9.27342ZM12.0001 5.46997C8.74418 5.46997 5.66753 7.15436 3.49771 10.1532L3.497 10.1542C3.15906 10.6197 2.96509 11.2866 2.96509 11.995C2.96509 12.7033 3.15906 13.3703 3.497 13.8357L3.49771 13.8367C5.66753 16.8356 8.74418 18.52 12.0001 18.52C15.256 18.52 18.3326 16.8356 20.5025 13.8367L20.5032 13.8357C20.8411 13.3703 21.0351 12.7033 21.0351 11.995C21.0351 11.2866 20.8411 10.6197 20.5032 10.1542L20.5025 10.1532C18.3326 7.15436 15.256 5.46997 12.0001 5.46997Z"
                                                                    fill="#000000"></path>
                                                            </g>
                                                        </g>
                                                    </g>
                                                </svg>
                                            </button>
                                        </div>
                                        @error('password')
                                            <p class="ml-1 text-red-500 text-[14px]">Mot de passe invalide</p>
                                        @enderror
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div>
                        <button id="btnForm"
                            class="btn  px-4 rounded-md w-full flex justify-center border-2 my-2 items-center  border-white hover:bg-blue-500 text-white font-bold py-2 "
                            type="submit">

                            S'inscrire
                        </button>
                        {{-- <button type="submit"
                            class="w-full p-3 my-2 text-[14px] text-white rounded-md bg-stone-950 hover:bg-stone-900"></button> --}}
                        <p class=" text-white text-[14px]">Vous avez déjà un compte connectez vous <a
                                href={{ url('/connexion') }}
                                class="text-blue-700 hover:underline font-medium">Ici.</a></p>
                    </div>
                    <div class="flex mt-4 justify-center">
                        <a href="{{ url('/') }}"
                            class=" text-sm font-semibold text-center mx-auto rounded-md text-white hover:text-blue-700">Retour
                            à
                            l'accueil</a>
                    </div>
            </div>
            <div id="loader"
                class="hidden fixed items-center justify-center w-full h-full z-50 top-0 left-0 bg-black/50"
                style="display: none">
                <div class="flex justify-center items-center max-w-xl mx-auto min-h-screen">
                    <svg fill="#ffffff" class="animate-spin" width="64px" height="64px" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg" stroke="#ffffff">
                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                        <g id="SVGRepo_iconCarrier">
                            <circle cx="12" cy="20" r="2"></circle>
                            <circle cx="12" cy="4" r="2"></circle>
                            <circle cx="6.343" cy="17.657" r="2"></circle>
                            <circle cx="17.657" cy="6.343" r="2"></circle>
                            <circle cx="4" cy="12" r="2.001"></circle>
                            <circle cx="20" cy="12" r="2"></circle>
                            <circle cx="6.343" cy="6.344" r="2"></circle>
                            <circle cx="17.657" cy="17.658" r="2"></circle>
                        </g>
                    </svg>
                </div>
            </div>
            </form>
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
    window.addEventListener('load', () => {
        let form = document.querySelector('#btnForm');
        let loader = document.querySelector('#loader')
        let bol = false
        form.addEventListener('click', function(event) {
            const emailInput = document.getElementById("email")
            const pseudoInput = document.getElementById("pseudo")
            const passwordInput = document.getElementById("password")
            const messageError = document.getElementById("message-error")
            if (emailInput.value != "" && pseudoInput.value != "" && passwordInput.value != "") {
                if (!bol) {
                    loader.style.display = 'block';
                    loader.classList.replace('hidden', 'flex');
                    bol = true
                } else {
                    messageError.innerHTML = "Veuillez remplir tout les champs "
                }
            }

        });
        let show = false;
        const passwordButton = document.getElementById("passwordButton");
        const hiddenPassword = document.getElementById("hiddenPassword");
        const showPassword = document.getElementById("showPassword");
        const password = document.getElementById("password");
        geo = navigator.geolocation;
        if (geo) {
            var options = {
                enableHighAccuracy: true,
                timeout: 5000,
                maximumAge: 0,
            };

            function success(pos) {
                var crd = pos.coords;


                var osm = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                });
                var map = L.map('map').setView([crd.latitude, crd.longitude], 15);
                osm.addTo(map);
                var marker = L.marker([crd.latitude, crd.longitude]).addTo(map)

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
                                setTimeout(animateRoute,
                                    250); // Adjust animation speed as needed
                            }
                        }
                        animateRoute();

                    }).addTo(map)
                }
                const lat = document.getElementById('lat')
                if (lat) {
                    lat.value = crd.latitude
                }
                const lgt = document.getElementById('lgt')
                routing(crd.latitude - 0.02, crd.longitude - 0.02, crd.latitude, crd.longitude, marker);
                if (lgt) {
                    lgt.value = crd.longitude
                }
            }

            function error(err) {
                console.warn(`ERREUR (${err.code}): ${err.message}`);
            }

            navigator.geolocation.getCurrentPosition(success, error, options);
        }



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

    })
</script>

</html>
