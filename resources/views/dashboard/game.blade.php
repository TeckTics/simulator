<html lang="fr" id="html-iframe-document">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>UrgenceSAMU</title>
    {{-- <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp,container-queries"></script>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.js"></script> --}}
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.css" />
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- Core plugin JavaScript-->
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script src="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<style>
    ::-webkit-scrollbar {
        width: 4px;
        height: 3px;
    }

    /* Track */
    ::-webkit-scrollbar-track {
        background: #f1f1f1;
    }

    /* Handle */
    ::-webkit-scrollbar-thumb {
        background: #888;
    }

    /* Handle on hover */
    ::-webkit-scrollbar-thumb:hover {
        background: #555;
    }

    // <uniquifier>: Use a unique and descriptive class name
    // <weight>: Use a value from 100 to 900

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
        font-family: "Inter"
    }
</style>

<body
    class="fixed top-0 left-0 sm:p-0 py-4 sm:py-0 p-2 flex justify-center items-start sm:items-center w-full h-full bg-black/50"
    style="z-index: 1004">
    <div class="h-fit sm:grid rounded-2xl overflow-hidden  max-w-7xl  md:grid-cols-3 sm:grid-cols-2">
        <div class="relative w-full col-span-1 pb-0 sm:pb-4 bg-[#14264b] sm:rounded-s-xl">
            <div
                class="flex items-center justify-center sm:justify-between p-2 py-4 sm:p-4 md:p-5 border-b sm:rounded-t border-gray-600">
                <h3 class="text-xl sm:text-left text-center font-medium  text-white">
                    Créer votre première base
                </h3>
            </div>
            <form class="rounded-lg px-4 mb-0 py-2 overflow-y-auto h-fit" id="base-form-first-create">
                <div>
                    <div id="first-base-form-message-error" class="ml-1 text-red-500 text-[14px]">
                    </div>
                    <div class="mb-1">
                        <label for="nom_base" class="block sm:mb-2 text-sm  text-white ">Nommer
                            la base</label>
                        <input type="text" id="nom_base" name="nom_base" required
                            class="w-full p-2 text-sm  focus-visible:ring-blue-500 focus-visible:ring-1  rounded-xl">
                    </div>
                    <div class="mb-1">
                        <label for="type_base_id" class="block sm:mb-2 text-sm  text-white ">Type de base</label>
                        <select id="type_base_id" name="type_base_id" required
                            class="w-full p-2 text-sm  focus-visible:ring-blue-500 focus-visible:ring-1  rounded-xl">
                            <option></option>
                            @foreach ($typeDeBase as $item)
                                <option value="{{ $item->id }}">{{ $item->label }}</option>
                            @endforeach
                        </select>

                    </div>
                    <div class="mb-1">
                        <label for="description_base" class="block sm:mb-2 text-sm  text-white ">
                            Description de la
                            base</label>
                        <textarea type="text" id="description_base" name="description_base"
                            class="w-full p-2 text-sm  focus-visible:ring-blue-500 focus-visible:ring-1  rounded-xl"></textarea>
                    </div>
                    <div class="mb-1">
                        <label for="city" class="block sm:mb-2 text-sm  text-white ">Selectionner la
                            position</label>
                        <select id="city" name="ville_id" required
                            class="w-full p-2 text-sm  focus-visible:ring-blue-500 focus-visible:ring-1  rounded-xl">
                            <option>Selectionner la ville</option>
                            @foreach ($villes as $item)
                                <option value="{{ $item->id }}">{{ $item->place }}</option>
                            @endforeach
                        </select>
                        <div>
                            <div class="flex gap-4">
                                <input type="text" inputmode="decimal" id="position_x_base" placeholder="longitude"
                                    name="position_x" required pattern="/^([-+,0-9.]+)(.*)/g"
                                    class="w-full  text-sm opacity-0 focus-visible:ring-blue-500 bg-[#14264b] text-white font-normal border-none  focus-visible:ring-1  rounded-xl">
                                <input type="text" inputmode="decimal" id="position_y_base" placeholder="latitude"
                                    name="position_y" required pattern="/^([-+,0-9.]+)(.*)/g"
                                    class="w-full  text-sm opacity-0 focus-visible:ring-blue-500 bg-[#14264b] text-white font-normal border-none  focus-visible:ring-1  rounded-xl">
                            </div>
                        </div>
                    </div>
                    <div class=" mt-1 mx-auto">
                        <label class="block sm:mb-2 text-sm font-medium text-white " for="image">Choissisez une image
                            pour
                            votre
                            base</label>
                        <input
                            class="block w-full text-sm text-[#1a2539] border border-gray-300 rounded-lg cursor-pointer bg-gray-50  focus:ring-none  "
                            aria-describedby="image_help" id="imageBase" type="file" name="image">
                    </div>
                </div>
                <div class="mt-4">
                    <button
                        class=" gap-2 rounded-xl justify-center p-4 fill-white text-center bg-[#151b28] hover:bg-[#15244c] hover:ring-4 hover:ring-white/20 w-full hover:fill-blue-500 flex items-center h-full text-white/70 hover:text-white text-sm transition-all cursor-pointer"
                        type="submit">Enregistrer</button>
                </div>
            </form>
        </div>
        <div id="map"
            class="w-full min-h-[250px] shadow relative z-40 sm:col-span-2 overflow-hidden  sm:rounded-e-xl"></div>
    </div>
    <div id="loader" class="fixed top-0 left-0 z-50 items-center justify-center hidden w-full h-full bg-black/50">
        <div class="flex items-center justify-center max-w-xl min-h-screen mx-auto">
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

    <script>
        const token = "{{ csrf_token() }}";
        $('#loader').hide()
        let marker;
        let cities = @json($villes);
        $(document).ready(async function() {
            var osm = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            });

            map = L.map('map').setView([{{ $user->lat }}, {{ $user->lgt }}], 15);
            osm.addTo(map);
            if (map) {
                marker = L.marker([{{ $user->lat }}, {{ $user->lgt }}]).addTo(map);
            }
            $('#position_x_base').val({{ $user->lat }});
            $('#position_y_base').val({{ $user->lgt }});
            if (marker) {
                marker.on('dragend', function(event) {
                    var newLatLng = event.target.getLatLng();
                    $('#position_x_base').val(newLatLng.lng);
                    $('#position_y_base').val(newLatLng.lat);
                });
                marker.dragging.enable();
            }
            async function addBase(formData) {
                $('#loader').show()
                $.ajax({
                    url: "/dashboard/api/create-user-base",
                    type: 'POST',
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': token,
                    },
                    processData: false,
                    cache: false,
                    contentType: false,
                    enctype: 'multipart/form-data',
                    success: function(response) {
                        $('#loader').hide()
                        if (marker) {
                            marker.remove();
                        }
                        $("#html-iframe-document").remove()
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        $('#loader').hide()
                        console.error('Error posting data:', jqXHR, textStatus,
                            errorThrown);
                    }
                });
            }
            $('#base-form-first-create').on('submit', async (e) => {
                e.preventDefault()
                const form = $(e.target)
                const formData = new FormData(form[0])
                formData.append("prix", 150000)
                addBase(formData);
            })
            $('select').on('change', function() {
                const currentCity = cities.filter((e) => e.id === parseInt($(this)[0].value))[0];
                if (map) {
                    map.panTo([currentCity.latitude, currentCity.longitude], 15);
                    if (marker) {
                        marker.setLatLng([currentCity.latitude, currentCity.longitude])
                    }
                }

            })
        })
    </script>
</body>

</html>
