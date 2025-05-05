<div id="mission-form-panel" class="sm:items-center sm:h-[750px]  h-full z-30 items-end md:relative fixed max-sm:bg-black/20 top-0 left-0 justify-center hidden col-span-1 mt-3 sm:w-[800px] overflow-x-hidden " >
    <div class="panel-size" >
        <div class="flex items-center justify-between p-4 border-gray-600 rounded-t md:p-5">
            <h3 class="text-xl font-medium text-white" style="font-family: 'Plus Jakarta Sans'">
                Traitement de l'opération
            </h3>
            <button type="button" name="mission-form-panel"
                class="flex items-center justify-center shadow-md close-modal-button backdrop-filter top-2 right-2">
                <img src="{{ asset('assets/images/icons8-close-48.png') }}" class="size-8" alt=""
                    srcset="">
                <span class="hidden">Close</span>
            </button>
        </div>
        <div>
            <div>
                <div class="block mb-2  text-[#1a2539]">
                    <ul>
                        <li class="flex items-center text-[14px] bg-[#1a2539] gap-2 p-3 px-4 text-white">
                            <span class="font-medium ">Nom de la victime:</span>
                            <span id="name-patient"></span>
                        </li>
                        <li class="flex items-center text-[14px] gap-2 p-3 px-4 text-white">
                            <span class="font-medium ">Age de la victime:</span>
                            <span id="age-patient"></span>
                        </li>
                        <li class="flex items-center text-[14px] bg-[#1a2539] gap-2 p-3 px-4 text-white">
                            <span class="font-medium ">Adresse:</span>
                            <span id="address-incident"></span>
                        </li>
                        <li class="flex items-center text-[14px] gap-2 p-3 px-4 text-white">
                            <span class="font-medium ">Numéro de téléphone:</span>
                            <span id="phone-patient"></span>
                        </li>
                    </ul>
                </div>
                <hr>
                <div id="missionStart" class="w-full sm:h-[360px] h-[450px]  p-4 space-y-4 overflow-y-auto missionStart">
                    <div class="gap-4 ">
                        <div class="flex items-end gap-2 mb-1 ">
                            <div class="w-full">
                                <label for="base_id_mission" class="block mb-2 text-sm text-[14px]  text-white ">
                                    base</label>
                                <select id="base_id_mission" name="base_id_mission" required
                                    class="block w-full p-2 text-white border border-gray-300  rounded-sm bg-[#14264b] text-xs focus:ring-blue-500 focus:border-blue-500 ">
                                    <option>Selectionner une base</option>
                                </select>
                            </div>
                            <button
                                class="h-full px-3 py-2 text-sm font-medium text-center text-white bg-orange-500 rounded-lg w-fit hover:bg-orange-600 focus:ring-4 focus:outline-none focus:ring-orange-300 "
                                id="focus-base-id">Focus</button>
                        </div>
                        <div id="shop-button-mission-form-panel">
                            {{-- <button name="shop-panel"
                                class="h-full px-3 py-2 text-sm font-medium text-center text-white bg-blue-500 rounded-lg show-modal w-fit hover:bg-blue-600 focus:ring-4 focus:outline-none focus:ring-blue-300 "
                                >Boutique</button> --}}
                        </div>
                        <div class="flex items-end gap-2 mb-1 mt-3">
                            <br><br>
                            <div class="w-full">
                                <label for="hopital_id_mission" class="block mb-2 text-sm text-white ">
                                    Hôpital
                                </label>

                                <label for="hopital_search" class="block mb-2 text-sm italic text-white ">
                                    Rechercher un hôpital
                                </label>
                                <input type="text" id="hopital_search" placeholder="Rechercher un hôpital..."
                                    class="block w-full p-2 text-white border border-gray-300 rounded-sm bg-[#14264b] text-xs focus:ring-blue-500 focus:border-blue-500">

                                    <select id="hopital_id_mission" name="hopital_id_mission" required
                                    class="block w-full p-2 text-white border border-gray-300 rounded-sm bg-[#14264b] text-xs focus:ring-blue-500 focus:border-blue-500">
                                    <option value="">Sélectionner un hôpital</option>
                                    @foreach ($closestHospitals as $item)
                                        <option value="{{ $item['id'] }}">
                                            {{ $item['nom_hopital'] }} ({{ $item['capacite_hopital'] }})
                                        </option>
                                    @endforeach
                                </select>
                                
                            </div>
                            <button
                                class="h-full px-3 py-2 text-sm font-medium text-center text-white bg-orange-500 rounded-lg w-fit hover:bg-orange-600 focus:ring-4 focus:outline-none focus:ring-orange-300 "
                                id="focus-hopital-id">Focus</button>
                        </div>
                    </div>
                    <div class="gap-4 mt-2 ">
                        {{-- <button
                            class="h-full px-3 py-2 text-sm font-medium text-center text-blue-500 bg-white rounded-lg w-fit hover:shadow-xl focus:ring-4 focus:outline-none "
                            id="reload-data-mission-form-panel">Actualiser</button> --}}
                        <div class="">
                            <div class="mt-2">
                                <label class="block mb-2 text-sm text-white ">Véhicule disponible</label>
                                <div id="table-unite" class="w-full text-sm text-left text-gray-400 rtl:text-right">
                                    <div class="text-xs text-gray-400 uppercase bg-gray-700">
                                        <div class="grid items-center grid-cols-4">
                                            <div class="py-3 text-center">
                                                Nom
                                            </div>
                                            <div class="py-3 text-center">
                                                Santé
                                            </div>
                                            <div class="py-3 text-center">
                                                Nombre de places
                                            </div>
                                            <div class="py-3 text-center">

                                            </div>
                                        </div>
                                    </div>
                                    <div id="tbody-unite">

                                    </div>
                                </div>
                            </div>
                            <div class="mt-2">
                                <label for="hopital_id_mission" class="block mb-2 text-sm text-white ">Personnel
                                    disponible</label>
                                <div id="table-personnel"
                                    class="w-full text-sm text-left text-gray-400 rtl:text-right">
                                    <div class="grid items-center grid-cols-3    text-xs text-gray-400 uppercase bg-gray-700">
                                        <tr>
                                            <div class="py-3 text-center">
                                                Nom
                                            </div>
                                            <div class="py-3 text-center">
                                                Titre
                                            </div>  
                                           
                                            <div class="py-3 text-center">

                                            </div>
                                        </tr>
                                    </div>
                                    <div id="tbody-personnel">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="button" id="start-routing"
                        class="w-full text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center ">Déployer
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const hopitalSearch = document.getElementById('hopital_search');
        const hopitalSelect = document.getElementById('hopital_id_mission');

        hopitalSearch.addEventListener('input', function() {
            const searchTerm = hopitalSearch.value.toLowerCase();
            const options = hopitalSelect.getElementsByTagName('option');

            for (let i = 0; i < options.length; i++) {
                const optionText = options[i].text.toLowerCase();
                if (optionText.includes(searchTerm)) {
                    options[i].style.display = '';
                } else {
                    options[i].style.display = 'none';
                }
            }
        });
    });
</script>