

<div class="grid items-start grid-cols-6 gap-2 py-2">
    @if (count($missionUser) < 2)
        <div class="col-span-3">
            <form id="alert-mission" method="POST" style="min-height: 150px;">
                @csrf
                <div id="card-mission" hidden style="display: flex;"
                    class="flex flex-col items-center justify-between gap-4 p-2 text-sm bg-red-500 shadow-xl alert rounded-xl from-red-700 bg-gradient-to-tr w-fit">
                    <div class="flex flex-row items-center gap-8 p-4 rounded-xl backdrop-blur-sm">
                        <img width="45" height="45" alt="regulateur"
                            src="{{ asset('/assets/images/regulateur.svg') }}" />
                        <div class="text-white ">
                            <span class="font-bold text-white">Régulation du SAMU:</span> <br>
                            <p>Bonjour, je suis Olivier de la régulation du SAMU, nous avons une mission sur votre
                                secteur:
                            </p>
                            <span class="font-bold ">Message: </span>
                            <p id="mission-description"></p>
                        </div>
                    </div>
                    <div class="flex gap-1">
                        <input hidden id="mission_id" name="mission_id" />
                        <input hidden id="mission_position_x" />
                        <input hidden id="mission_position_y"  />
                        <input hidden id="duree_mission"  />
                        <button title="Envoyer une unité sur la mission" type="button" id="accept-btn"
                            name="show-modal-send-unite"
                            style="font-family: cursive; text-shadow: 1px 1px 8px rgba(0, 0, 0, 0.756);"
                            class="flex flex-row justify-center gap-2 p-2 text-sm font-semibold text-white transition-all bg-blue-500 border-2 border-white rounded-lg show-modal from-blue-700 bg-gradient-to-t w-fit hover:bg-blue-600 ">
                            <img width="25" height="25" src="{{ asset('/assets/images/phone.svg') }}"
                                alt="Phone" />
                            <span class="text-white">Envoyer unité</span>
                        </button>
                        <button title="Mettre la mission dans la file d'attente" type="button" name="waiter"
                            id="waiter-btn" style="font-family: cursive; text-shadow: 1px 1px 8px rgba(0, 0, 0, 0.756);"
                            class="flex flex-row justify-center gap-2 p-2 text-sm font-semibold text-white transition-all border-2 border-white rounded-lg show-modal add-mission-to-map from-stone-700 bg-gradient-to-t w-fit hover:bg-stone-600 bg-stone-500 ">
                            <img width="25" height="25" src="{{ asset('/assets/images/arrow-down.svg') }}"
                                alt="Phone" />
                            <span class="text-white">Mettre la mission dans la file d'attente</span>
                        </button>
                        <button title="Refuser la mission" type="button" name="reject" id="reject-btn"
                            style="font-family: cursive; text-shadow: 1px 1px 8px rgba(0, 0, 0, 0.756);"
                            class="flex flex-row justify-center gap-2 p-2 text-sm font-semibold text-white transition-all bg-red-500 border-2 border-white rounded-lg reject-mission from-red-700 bg-gradient-to-t w-fit hover:bg-red-600 ">
                            <img width="25" height="25" src="{{ asset('/assets/images/hang-up.svg') }}"
                                alt="Phone" />
                            <span class="text-white">Refuser la mission</span>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    @endif
    @include('dashboard.layout.layout-options-panel')
    @include('dashboard.layout.layout-base-list-panel')
</div>
<div class="grid grid-cols-3">
    <div id="map"
        class="relative z-40 w-full overflow-hidden border-4 border-white shadow-md col-span-full shadow-black rounded-xl"
        style="height: 500px"></div>
    <div class="top-0 left-0 z-50 flex items-center justify-center w-full h-full col-span-1 overflow-x-auto expend-modal"
        id="add-base" hidden>
        <form class="max-w-md modal-content rounded-xl " enctype="multipart/form-data" method="POST"
            action="{{ route('add.user.base') }}">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title">Créer une nouvelle base</h5>
                <button name="add-base" id="remove-base-map" class="close-modal-button remove-base-map" type="button">
                    <span class="">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="mb-1">
                    <label for="nom_base" class="block mb-2 text-sm font-medium text-[#1a2539] ">Nommer
                        la base</label>
                    <input type="text" id="nom_base" name="nom_base" required
                        class="block w-full p-2 text-[#1a2539] border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500 ">
                </div>
                <div class="mb-1">
                    <label for="type_base_id" class="block mb-2 text-sm font-medium text-[#1a2539] ">Type
                        de base</label>
                    <select id="type_base_id" name="type_base_id" required
                        class="block w-full p-2 text-[#1a2539] border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500 ">
                        <option>Selectionner le type de votre base</option>
                        @foreach ($typeDeBase as $item)
                            <option value="{{ $item->id }}">{{ $item->label }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-1">
                    <label for="description_base" class="block mb-2 text-sm font-medium text-[#1a2539] ">Petite
                        description de la
                        base</label>
                    <textarea type="text" id="description_base" name="description_base"
                        class="block w-full p-2 text-[#1a2539] border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500 "></textarea>
                </div>
                <div class="mb-1">
                    <label for="capacite_hopital" class="block mb-2 text-sm font-medium text-[#1a2539] ">Position
                        sur la
                        map</label>
                    <div class="flex gap-4">
                        <input type="text" inputmode="decimal" id="position_x_base" placeholder="longitude"
                            name="position_x" required pattern="/^([-+,0-9.]+)(.*)/g"
                            class="block w-full p-2 text-[#1a2539] border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500 ">
                        <input type="text" inputmode="decimal" id="position_y_base" placeholder="latitude"
                            name="position_y" required pattern="/^([-+,0-9.]+)(.*)/g"
                            class="block w-full p-2 text-[#1a2539] border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500 ">
                    </div>
                </div>
                <div class="mx-auto mt-3 ">
                    <label class="block mb-2 text-sm font-medium text-[#1a2539] " for="image">Icon sur
                        la map</label>
                    <input
                        class="block w-full text-sm text-[#1a2539] border border-gray-300 rounded-lg cursor-pointer bg-gray-50  focus:outline-none  "
                        aria-describedby="image_help" id="imageBase" type="file" name="image">
                </div>
            </div>
            <div class="modal-footer">
                <button class="text-blue-500 btn btn-primary btn-sm" type="submit">Enregistrer</button>
            </div>
        </form>
    </div>
</div>
<div class="row">
    <div class="p-4 ">
        <div class="overflow-x-auto ">
            <h2>Mes missions </h2>
            <ol id="list-mission" style="list-style: none;"
                class="flex flex-row gap-4 mt-2 space-y-1 overflow-y-auto list-decimal list-inside ps-5 gp-8">
                @foreach ($missionUser as $key => $item)
                    <li id="card-mission-item-{{ $key }} bg-white">
                        <div class="w-full mb-1">
                            <div class="py-2 bg-white shadow  h-100">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="mr-2 col">
                                            <div class="mb-1 text-xs font-weight-bold text-dark text-uppercase">
                                                {{ $item->nom_mission }}
                                            </div>
                                            <p>
                                                {{ $item->description_mission }}
                                            </p>
                                            <p>
                                                @if (date_create($dateNow) < date_create($item->fin_mission))
                                                <div id="timer" class="font-semibold text-red-500 w-96">
                                                    <span id="countdown" class=""></span>
                                                </div>
                                                <script>
                                                    window.eventData = {
                                                        startDate: "{{ $dateNow }}",
                                                        endDate: "{{ date_format(date_create($item->fin_mission), 'Y-m-d H:i:s') }}"
                                                    };
                                                    $(document).ready(function() {
                                                        var timer = Math.abs(Date.parse("{{ $dateNow }}") - Date.parse(
                                                            "{{ date_format(date_create($item->fin_mission), 'Y-m-d H:i:s') }}"));
    
                                                        if (timer > 0) {
                                                            var timeinterval = setInterval(() => {
    
                                                                var minutesSpan = document.getElementById('countdown');
    
                                                                timer = timer - 1000;
                                                                var minutes = Math.floor((timer / 1000 / 60) % 60);
                                                                var seconds = Math.floor((timer / 1000) % 60);
                                                                if (minutesSpan) {
                                                                    minutesSpan.innerHTML =
                                                                        `Fin dans ${minutes < 10 ? "0" + minutes : minutes}:${seconds < 10 ? "0" + seconds : seconds}`;
                                                                }
                                                                if (t.total <= 0) {
                                                                    minutesSpan.innerHTML = `
                                                                         <button type="button" disabled
                                                                        class="flex items-center gap-2 p-2 px-4 mx-auto text-sm font-medium text-white rounded-sm bg-stone-500 w-fit">
                                                                        Terminer
                                                                    </button>
                                                                    `
                                                                    clearInterval(timeinterval);
                                                                }  
                                                            }, 1000);
    
                                                        }
                                                     
                                                    });
                                                </script>
                                            @else
                                                <button type="button" disabled
                                                    class="flex items-center gap-2 p-2 px-4 mx-auto text-sm font-medium text-white rounded-sm bg-stone-500 w-fit">
                                                    Terminer
                                                </button>
                                            @endif
                                        </div>
                                        <div class="col-auto">
                                            <button name="show-modal-mission-user-{{ $key }}"
                                                class="text-xs btn btn-primary show-modal getMissionMap">Envoyer</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="show-modal-mission-user-{{ $key }}" hidden
                            class="absolute top-0 left-0 z-50 flex items-center justify-center w-full h-full overflow-x-hidden overflow-y-auto  expend-modal bg-black/20">
                            <div class="relative w-full max-w-6xl p-4 ">
                                <!-- Modal content -->
                                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                    <!-- Modal header -->
                                    <div
                                        class="flex items-center justify-between p-4 border-b rounded-t md:p-5 dark:border-gray-600">
                                        <h3 class="text-xl font-semibold text-[#1a2539]">
                                            Traitement de l'appel
                                        </h3>
                                        <button type="button" name="show-modal-senid-unite"
                                            class="end-2.5 text-gray-400 close-modal-button bg-transparent hover:bg-gray-200 hover:text-[#1a2539] rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white">
                                            <svg class="w-3 h-3" class="hidden" xmlns="http://www.w3.org/2000/svg"
                                                fill="none" viewBox="0 0 14 14">
                                                <path stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="2"
                                                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                            </svg>
                                            <span class="sr-only">Close modal</span>
                                        </button>
                                    </div>
                                    <!-- Modal body -->
                                    <div class="p-4 md:p-5">
                                        <div class="block mb-2 text-[#1a2539]">
                                            <span class="font-medium ">Données de l'appel </span>
                                            <ul class="max-w-md p-2 text-sm border data-mission">
                                                <li class="flex items-center justify-between">
                                                    <span class="font-medium ">Nom de la victime</span>
                                                    <span id="name-patient-{{ $key }}"></span>
                                                </li>
                                                <li class="flex items-center justify-between">
                                                    <span class="font-medium ">Age de la victime</span>
                                                    <span id="age-patient-{{ $key }}"></span>
                                                </li>
                                                <li class="flex items-center justify-between">
                                                    <span class="font-medium ">Adresse </span>
                                                    <span id="adresse-incident-{{ $key }}"></span>
                                                </li>
                                                <li class="flex items-center justify-between">
                                                    <span class="font-medium ">Numéro de téléphone </span>
                                                    <span id="phone-patient-{{ $key }}"></span>
                                                </li>
                                            </ul>
                                        </div>
                                        <form id="missionStart" class="space-y-4 missionStart">
                                            <input type="text" hidden value="{{ $item->position_x }}"
                                                id="position_x_mission_{{ $key }}">
                                            <input type="text" hidden value="{{ $item->position_y }}"
                                                id="position_y_mission_{{ $key }}">
                                            <input type="text" hidden value="{{ $item->id }}"
                                                id="mission_user_id_{{ $key }}">
                                            <input type="text" hidden value="{{ $item->personnel_id }}"
                                                id="personnel_key_id_{{ $key }}">
                                            <input type="text" hidden value="{{ $item->type_unite_id }}"
                                                id="unite_key_id{{ $key }}">
                                            <div class="grid grid-cols-2 gap-4">
                                                <div class="mb-1">
                                                    <label for="base_id_mission_{{ $key }}"
                                                        class="block mb-2 text-sm font-medium text-[#1a2539] ">
                                                        base</label>
                                                    <select id="base_id_mission_{{ $key }}" re
                                                        name="base_id_mission" required
                                                        class="block w-full p-2 text-[#1a2539] border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500 ">
                                                        <option>Selectionner une base</option>
                                                        @foreach ($baseUser as $item)
                                                            <option value="{{ $item->id }}">
                                                                {{ $item->nom_base }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="mb-1">
                                                    <label for="hopital_id_mission_{{ $key }}"
                                                        class="block mb-2 text-sm font-medium text-[#1a2539] ">
                                                        Hopital</label>
                                                    <select id="hopital_id_mission_{{ $key }}"
                                                        name="hopital_id_mission" required
                                                        class="block w-full p-2 text-[#1a2539] border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500 ">
                                                        <option>Selectionner un hopital</option>
                                                        @foreach ($hopitals as $item)
                                                            <option value="{{ $item->id }}">
                                                                {{ $item->nom_hopital }}
                                                                ({{ $item->capacite_hopital }})
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="grid grid-cols-2 gap-4 h-96 ">
                                                <div class="mb-1">
                                                    <label for="unite_id_mission_{{ $key }}"
                                                        class="block mb-2 text-sm font-medium text-[#1a2539] ">Mes
                                                        unités</label>
                                                    <select id="unite_id_mission_{{ $key }}"
                                                        name="unite_id_mission" required
                                                        class="block w-full p-2 text-[#1a2539] border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500 ">
                                                        <option>Selectionner une unité pour la mission</option>
                                                        @foreach ($uniteUser as $item)
                                                            <option value="{{ $item->id }}">
                                                                {{ $item->nom }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="mb-1">
                                                    <label for="personnel_id_mission_{{ $key }}"
                                                        class="block mb-2 text-sm font-medium text-[#1a2539] ">Personnel</label>
                                                    <select id="personnel_id_mission_{{ $key }}"
                                                        name="personnel_id_mission" required
                                                        class="block w-full p-2 text-[#1a2539] border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500 ">
                                                        <option>Selectionner un Personnel</option>
                                                        @foreach ($personnel as $item)
                                                            <option value="{{ $item->id }}">
                                                                {{ $item->titre_personnel }}
                                                                ({{ $item->quantite_personnel }})
                                                                Niv {{ $item->niveau }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <button type="button" name="{{ $key }}"
                                                class="w-full text-white startbtnmission bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Engager
                                                {{ $key }}</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ol>
        </div>
    </div>
</div>
@include('dashboard.layout.layout-send-unite-panel')
<script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

<!-- Core plugin JavaScript-->
<script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
<script src="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.js"></script>
<script>
    // Initialisation de la map
    function getRandomArbitrary(min, max) {
        return Math.random() * (max - min) + min;
    }
    // var pointA = getRandomArbitrary(3.833119, 3.844119);
    // var map = L.map('map').setView([pointA, 11.501346], 13);
    const mutedInput = document.getElementById('mutedInput');
    mutedInput.addEventListener('change', (e) => {
        const audio = document.getElementById('audio')
        if (e.target.checked) {
            audio.play()
        } else {
            audio.pause();
            audio.currentTime = 0;
        }
    })

    const volumeInput = document.getElementById('volumeInput');
    volumeInput.addEventListener('change', (e) => {
        const audio = document.getElementById('audio')
        audio.volume = e.target.value / 100;
    })

    function getRandomIntInclusive(min, max) {
        const minCeiled = Math.ceil(min);
        const maxFloored = Math.floor(max);
        return Math.floor(Math.random() * (maxFloored - minCeiled + 1) +
            minCeiled); // The maximum is inclusive and the minimum is inclusive
    }
    // Page osm

    const addBaseButtonHandler = document.getElementById('add-base-map');
    // L.icon permet de créer un icon 
    // var map = L.map('map').setView([51.505, -0.09], 13);

    // Initialisation de la carte et du marqueur
    var osm = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    });
    var map = L.map('map').setView([{{ $user->lat }}, {{ $user->lgt }}], 15);
    osm.addTo(map);

    function loadMap() {
        var map = L.map('map').setView([{{ $user->lat }}, {{ $user->lgt }}], 15);
        osm.addTo(map);
    }
    var marker;

    // const addBaseButtonHandler = document.getElementById('add-base-map');
    const removeBaseButtonHandler = document.getElementById('remove-base-map');
    let baseCurrent = true;

    function routage(lat, lng, latF, vitesseUnite, lngF, marqueur, startIcon, endIcon, callback, last) {
        if (typeof callback !== 'function') {
            throw new Error('routage function requires a callback function as the last argument');
        }
        let v = vitesseUnite;
        if (vitesseUnite < 200) {
            v = vitesseUnite * 100
        }
        const r = L.Routing.control({
            waypoints: [
                L.latLng(lat, lng),
                L.latLng(latF, lngF),
            ],
            createMarker: function(i, waypoint) {
                return L.marker(waypoint.latLng, {
                    icon: i === 0 ? startIcon : endIcon
                });
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
                } else {
                    // Destination reached!

                    callback(true, r); // Call the callback function with true
                }
            }
            animateRoute();
        }).addTo(map)
        const tab = document.querySelector('.leaflet-right');
        if (tab) {
            tab.remove()
        }

    }

    $(document).ready(async function() {
        let mapDomElelemert;
        // const addHopitalButtonHandler = document.getElementById('add-hopital-map');
        // audioElement.play(); 
        addBaseButtonHandler.addEventListener('click', () => {
            if (baseCurrent) {
                const map = document.getElementById('map');
                if (map) {
                    map.classList.replace('col-span-full', 'col-span-2')
                }
                marker = L.marker([51.5, -0.09]).addTo(map);
                const posX = document.getElementById('position_x_base');
                const posY = document.getElementById('position_y_base');
                posX.value = -0.09;
                posY.value = 51.5;
                marker.on('dragend', function(event) {
                    var newLatLng = event.target.getLatLng();
                    posY.value = newLatLng.lng;
                    posX.value = newLatLng.lat;
                });
                // markeurs.push(markeurs)
                marker.dragging.enable();
                baseCurrent = false
            } else {
                removeBaseButtonHandler.click()
                baseCurrent = true
            }
        })
        removeBaseButtonHandler.addEventListener('click', () => {
            const map = document.getElementById('map')
            if (map) {
                alert(1)
                map.classList.replace('col-span-2', 'col-span-full')
            }
        })

        $('.startbtnmission').on("click", async (e) => {
            // e.preventDefault()
            const name = e.target.name;
            const uniteId = $('#unite_id_mission_' + name).val();
            const baseId = $('#base_id_mission_' + name).val();
            const HopitaliId = $('#hopital_id_mission_' + name).val();
            const personnelKeyId = $('#personnel_key_id_' + name).val();
            const uniteKeyId = $('#unite_key_id' + name).val();
            const personnelIdMission = $('#personnel_id_mission_' + name).val()

            $('.expend-modal').attr('hidden', true)
            // $('#mission_base_id').val();
            const hopitalData = await fetch("/api/hopital/" + HopitaliId);
            let hopital = await hopitalData.json()
            hopital = hopital.response;
            const uniteUserData = await fetch("/api/unite-user/" + uniteId);
            let uniteUser = await uniteUserData.json()
            uniteUser = uniteUser.response;
            const uniteData = await fetch("/api/unite/" + uniteUser.unite_id);
            let unite = await uniteData.json()
            const baseData = await fetch("/api/base/" + baseId);
            let base = await baseData.json()
            base = base.response;
            var startIcon = L.icon({
                iconUrl: window.location.origin + "/assets/images/point.svg",
                iconSize: [10, 10],
                iconAnchor: [20, 20],
                popupAnchor: [-3, -76]
            });
            var endIcon = L.icon({
                iconUrl: window.location.origin + "/assets/images/point.svg",
                iconSize: [10, 10],
                iconAnchor: [20, 20],
                popupAnchor: [-3, -76]
            });
            var uniteIcon = L.icon({
                iconUrl: window.location.origin + uniteUser.icon,
                iconSize: [50, 50],
                iconAnchor: [50, 50],
                popupAnchor: [-3, -76]
            });
            var missionIcon = L.icon({
                iconUrl: window.location.origin +
                    "/assets/images/point.svg",
                iconSize: [10, 10],
                iconAnchor: [50, 50],
                popupAnchor: [-3, -76]
            })
            var marker = L.marker([base.position_x, base.position_y], {
                icon: uniteIcon
            }).addTo(map)
            let routeingAisCompleted = false;
            let routeingBisCompleted = false;
            let routeingCisCompleted = false;
            var success = 1;

            // Ajouter des points au mission user de tel sorte que lorsque l'utilisateur renseigne 
            if (uniteKeyId == unite.response.type_unite_id && personnelKeyId ==
                personnelIdMission) {
                success = 2;
            }
            const myCallback = function(isDestinationReached, routing) {
                if (isDestinationReached) {
                    routing.remove()
                    const token = "{{ csrf_token() }}";

                    $.ajax({
                        url: `/api/update-mission`, // Replace with the target API URL
                        type: 'POST',
                        data: {
                            "mission_user_id": parseInt($('#mission_user_id_' +
                                name).val()),
                            "is_completed": success,
                            "etat": 1
                        },
                        headers: {
                            'X-CSRF-TOKEN': token
                        },
                        dataType: 'json',
                        success: function(response) {
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            console.error('Error posting data:', textStatus,
                                errorThrown);
                            // Handle errors
                        }
                    });
                    setTimeout(() => {
                        routage($('#position_x_mission_' + name).val(), $(
                                '#position_y_mission_' + name).val(), hopital
                            .position_x, uniteUser
                            .vitesse, hopital
                            .position_y, marker, missionIcon, endIcon,
                            myCallback1)
                    }, 1000);
                }
            };
            const myCallback1 = function(isDestinationReached, routing) {
                if (isDestinationReached) {
                    routing.remove()
                    $.ajax({
                        url: `/api/update-mission`, // Replace with the target API URL
                        type: 'POST',
                        data: {
                            "mission_user_id": parseInt($('#mission_user_id_' +
                                name).val()),
                            "is_completed": success,
                            "etat": 2
                        },
                        headers: {
                            'X-CSRF-TOKEN': token
                        },
                        dataType: 'json',
                        success: function(response) {

                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            console.error('Error posting data:', textStatus,
                                errorThrown);
                            // Handle errors
                        }
                    });
                    setTimeout(() => {
                        routage(hopital.position_x, hopital.position_y, base
                            .position_x, uniteUser.vitesse, base.position_y,
                            marker,
                            startIcon, endIcon, myCallback2)
                    }, 1000);
                }
            };

            const myCallback2 = function(isDestinationReached, routing) {
                $('card-mission-item-' + name).hide()
            }

            routage(base.position_x, base.position_y, $('#position_x_mission_' + name).val(),
                uniteUser
                .vitesse, $('#position_y_mission_' + name).val(), marker,
                startIcon, missionIcon,
                myCallback, false)
        });

        // Accepter la mission, etat en cour de d'execution

        $("#acceptMission").on("submit", async (e) => {
            e.preventDefault()
            var token = "{{ csrf_token() }}";
            $.ajax({
                url: `/api/add-mission`, // Replace with the target API URL
                type: 'POST',
                data: {
                    "mission_id": $('#mission_id').val(),
                    "position_x": $('#mission_position_x').val(),
                    "position_y": $('#mission_position_y').val(),
                    "etat": "1",
                    "duree": $('#duree_mission').val(),
                    "icon": "/assets/images/mission-icon.png"
                    
                },
                headers: {
                    'X-CSRF-TOKEN': token
                },
                dataType: 'json',
                success: function(response) {
                    if (response.message) {
                        reloadCardMission()
                    }
                    // Process the response data
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error('Error posting data:', textStatus, errorThrown);
                    // Handle errors
                }
            });
            // throw new Error('routage function requires a callback function as the last argument');
            const uniteId = $('#mission_unite_id').val();
            const baseId = $('#mission_base_id').val();
            const HopitaliId = $('#mission_hopital_id').val();
            $('.expend-modal').attr('hidden', true)
            // $('#mission_base_id').val();
            const hopitalData = await fetch("/api/hopital/" + HopitaliId);
            let hopital = await hopitalData.json()
            hopital = hopital.response;
            const uniteData = await fetch("/api/unite-user/" + uniteId);
            let uniteUser = await uniteData.json()
            uniteUser = uniteUser.response;
            const baseData = await fetch("/api/base/" + baseId);
            let base = await baseData.json()
            base = base.response;
            var startIcon = L.icon({
                iconUrl: window.location.origin + "/assets/images/point.svg",
                iconSize: [10, 10],
                iconAnchor: [20, 20],
                popupAnchor: [-3, -76]
            });
            var endIcon = L.icon({
                iconUrl: window.location.origin + "/assets/images/point.svg",
                iconSize: [10, 10],
                iconAnchor: [20, 20],
                popupAnchor: [-3, -76]
            });
            var uniteIcon = L.icon({
                iconUrl: window.location.origin + uniteUser.icon,
                iconSize: [50, 50],
                iconAnchor: [50, 50],
                popupAnchor: [-3, -76]
            });
            var missionIcon = L.icon({
                iconUrl: window.location.origin +
                    "/assets/images/mission-icon.svg",
                iconSize: [25, 25],
                iconAnchor: [50, 50],
                popupAnchor: [-3, -76]
            });
            var marker = L.marker([base.position_x, base.position_y], {
                icon: uniteIcon
            }).addTo(map)
            let routeingAisCompleted = false;
            let routeingBisCompleted = false;
            let routeingCisCompleted = false;

            const myCallback = function(isDestinationReached, routing) {
                if (isDestinationReached) {
                    routing.remove()
                    setTimeout(() => {
                        routage($('#mission_position_x').val(), $(
                                '#mission_position_y').val(), hopital
                            .position_x, uniteUser
                            .vitesse, hopital
                            .position_y, marker, missionIcon, endIcon,
                            myCallback1, false)
                    }, 1000);
                }
            };
            const myCallback1 = function(isDestinationReached, routing) {
                if (isDestinationReached) {
                    routing.remove()
                    setTimeout(() => {
                        routage(hopital.position_x, hopital.position_y, base
                            .position_x, uniteUser.vitesse, base.position_y,
                            marker,
                            startIcon, endIcon, myCallback2, true)
                    }, 1000);
                }
            };
            const myCallback2 = function(isDestinationReached, routing) {
                if (isDestinationReached) {
                    routing.remove()
                }
            };

            routage(base.position_x, base.position_y, $('#mission_position_x').val(), uniteUser
                .vitesse, $('#mission_position_y').val(), marker,
                startIcon, missionIcon,
                myCallback, false)

        })

        function loadMission() {
            const wesPromiseMission = fetch("/api/missions");
            wesPromiseMission.then((response) => {
                return response.json();
            }).then(function(data) {
                let tabMission = [];
                let = countDown = data.countDown;

                $.each(data.response, function(index, element) {
                   
                    const cardMission = document.getElementById('card-mission');
                    if (cardMission) {
                        cardMission.hidden = false;
                    }   
                    const namePatient = document.getElementById('name-patient');
                    namePatient.innerHTML = `${data.patient}`;
                    const age = document.getElementById('age-patient');
                    age.innerHTML = 40;
                    const adresse = document.getElementById('adresse-incident');
                    adresse.innerHTML = "nice, veuille ville";
                    const phonePatient = document.getElementById('phone-patient');
                    phonePatient.innerHTML = "+30 857452556";
                    const missionDescription = document.getElementById(
                        'mission-description');
                    if (missionDescription) {
                        missionDescription.innerHTML = element.nom_mission;
                    }
                    const missionId = document.getElementById('mission_id');
                    if (missionId) {
                        missionId.value = element.id;
                    }
                    const duree = document.getElementById('duree_mission');
                    if (duree) {
                       
                        duree.value = element.duree;
                    }
                    const missionPositionX = document.getElementById('mission_position_x');
                    if (missionPositionX) {
                        missionPositionX.value = data.positionX;
                    }
                    const missionPositionY = document.getElementById('mission_position_y');
                    if (missionPositionY) {
                        missionPositionY.value = data.positionY;
                    }
                    const buttonModalUnitePay = document.querySelectorAll('.show-modal');
                    if (buttonModalUnitePay) {
                        buttonModalUnitePay.forEach(element => {
                            element.addEventListener('click', () => {
                                let name = element.name;
                                let expendEvent = document.getElementById(name);
                                if (expendEvent) {
                                    expendEvent.hidden = false;
                                }
                                // alert(expendEvent.innerHTML)
                            })
                        });
                    }

                });
                const audio = document.getElementById('audio');
                audio.play()
                setTimeout(() => {
                    audio.play()
                }, 20000);
                if (mutedInput.checked) {
                    mutedInput.checked = false;
                }
            })
        }

        function loadData() {
            const wesPromise = fetch("/api/hopitaux");
            wesPromise.then((response) => {
                return response.json();
            }).then(function(data) {
                $.each(data.response, function(index, element) {
                    var myIcon = L.icon({
                        iconUrl: window.location.origin + "/" + element
                            .icon_hopital,
                        iconSize: [38, 95], // taille de l'icône en pixels
                        iconAnchor: [22, 94], // point d'ancrage de l'icône
                        popupAnchor: [-3, -76] // point d'ancrage du popup
                    });
                    let markerData = L.marker([element.position_x, element.position_y], {
                        icon: myIcon
                    }).addTo(map);
                    markerData.bindPopup("<p class='text-center'>" + element.nom_hopital +
                        "</p>")
                });
            })

            const wesPromise2 = fetch("/api/base");
            wesPromise2.then((response) => {
                return response.json();
            }).then(function(data) {
                $.each(data.response, function(index, element) {
                    var myIcon = L.icon({
                        iconUrl: window.location.origin + "/" + element
                            .icon_base,
                        iconSize: [50, 50], // taille de l'icône en pixels
                        iconAnchor: [20, 20], // point d'ancrage de l'icône
                        popupAnchor: [0, -10] // point d'ancrage du popup
                    });
                    L.marker([element.position_y, element.position_x], {
                            icon: myIcon
                        }).bindPopup("<p class='text-center'>" + element.nom_base + "</p>")
                        .addTo(map);

                });
            })

            const wesPromise3 = fetch("/api/get-mission");
            wesPromise3.then((response) => {
                return response.json();
            }).then(function(data) {
                $.each(data.response, function(index, element) {
                    var myIcon = L.icon({
                        iconUrl: window.location.origin +
                            "/assets/images/mission-icon.svg",
                        iconSize: [20, 20], // taille de l'icône en pixels
                        iconAnchor: [22, 94], // point d'ancrage de l'icône
                        popupAnchor: [-3, -76] // point d'ancrage du popup
                    });
                    let markerData = L.marker([element.position_x, element.position_y], {
                        icon: myIcon
                    }).addTo(map);
                    markerData.bindPopup("<p class='text-center'>" + element.position_x +
                        " " + element.position_y +
                        "</p>")
                });
            })


        }

        loadData();
        setTimeout(() => {
            loadMission();
        }, getRandomArbitrary({{ intval($gameSetting->intervale_mission_a * 1000) }},
            {{ intval($gameSetting->intervale_mission_b * 1000) }}));
        // Accepter la mission, etat en attente d'execution (1)

        $("#waiter-btn").on('click', () => {
            var token = "{{ csrf_token() }}";
            $.ajax({
                url: `/api/add-mission`, // Replace with the target API URL
                type: 'POST',
                data: {
                    "mission_id": $('#mission_id').val(),
                    "position_x": $('#mission_position_x').val(),
                    "position_y": $('#mission_position_y').val(),
                    "etat": "0",
                    "duree": $('#duree_mission').val(),
                    "icon": "/assets/images/mission-icon.png"
                },
                headers: {
                    'X-CSRF-TOKEN': token
                },
                dataType: 'json',
                success: function(response) {
                    if (response.message) {
                        reloadCardMission();
                        $('élist-mission').append(``)
                    }
                    // Process the response data
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    // Handle errors
                }
            });
        })

        function reloadCardMission() {
            $("#card-mission").fadeOut("slow", function() {
                const audio = document.getElementById('audio')
                if (mutedInput.checked) {
                    audio.play()
                } else {
                    audio.pause();
                    audio.currentTime = 0;
                }
                setTimeout(() => {
                    $("#card-mission").hide()
                }, 1000);
                setTimeout(() => {
                    if (mutedInput.checked) {
                        audio.play()
                    } else {
                        audio.pause();
                        audio.currentTime = 0;
                    }

                    $("#card-mission").show()
                    loadMission();
                }, getRandomIntInclusive(8000, 10000))
            });
        }

        $('#reject-btn').on('click', () => {
            reloadCardMission()
        })

        $('.getMissionMap').on('click', (e) => {
        })

        $('.remove-base-map').on('click', () => {
            if (marker) {
                baseCurrent = true
                marker.remove();
            }
            const map = document.getElementById('map')
            if (map) {
                map.classList.replace('col-span-2', 'col-span-full')
            }
        })

        $('.close-modal-button').on('click', function() {
            $('.expend-modal').attr('hidden', true)
        });
        $('.post-unite-base').on("submit", async (e) => {
            e.preventDefault()
            const baseId = e.target[4].value;
            const uniteId = e.target[5].value;
            const dataToJson = {
                "base_id": `${baseId}`,
                "id": `${uniteId}`
            }
            var token = "{{ csrf_token() }}";
            try {
                $.ajax({
                    url: `/api/add-unite-base`, // Replace with the target API URL
                    type: 'POST',
                    data: dataToJson,
                    headers: {
                        'X-CSRF-TOKEN': token
                    },
                    dataType: 'json',
                    success: function(response) {
                        // Process the response data
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.error('Error posting data:', textStatus,
                            errorThrown);
                        // Handle errors
                    }
                });
            } catch (error) {
            }
        });
        $('.focus-map').hide()
        $('#focus').on('click', function() {
            mapDomElelemert = $("#map");
            $('#map').remove();
            $('.focus-map').show();
            $('.focus-map').attr('id', 'map');
            map.remove();
            loadMap()
        })
    })
    // Active le déplacement du marqueur
</script>
