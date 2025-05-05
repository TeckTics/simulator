<div id="show-modal-send-unite" hidden
    class=" overflow-y-auto expend-modal overflow-x-hidden bg-black/20 flex fixed  top-0 left-0 left-0 z-50 justify-center items-start    w-full  h-full">
    <div class="relative p-4 max-w-6xl w-full py-40 ">
        <div style="z-index: 101" class="relative bg-white  rounded-lg shadow dark:bg-gray-700">
            <div class="flex items-center justify-between p-2 border-b rounded-t dark:border-gray-600">
                <h3 class=" font-bold   w-full text-center text-[#1d65e7e0]">
                    Traitement de l'appel
                </h3>
                <button type="button" name="show-modal-send-unite"
                    class="end-2.5 text-gray-400 close-modal-button bg-transparent hover:bg-gray-200 hover:text-[#1d65e7e0] rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white">
                    <svg class="w-3 h-3" class="hidden" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <div class="p-4 md:p-5">
                {{-- <div class="focus-map h-96 bg-blue-50 w-full">

                </div> --}}
                {{-- <button id="focus"
                    class="btn  p-2  text-white transition-all items-center border-white border-2 flex flex-row gap-2  text-sm justify-center from-blue-700 bg-gradient-to-t rounded-lg w-fit hover:bg-blue-600 bg-blue-500 font-semibold ">
                    <span>Afficher la map</span>
                </button> --}}
                <div class="grid grid-cols-2 gap-2">

                    <form id="acceptMission" class="space-y-4 mt-4" action="#">
                        <div class="grid grid-cols-2 gap-4">
                            <div class="mb-1">
                                <label for="mission_personnel_id"
                                    class="block mb-2 text-sm font-medium text-[#1d65e7e0] ">Selectionner une base pour la mission</label>
                                <select id="mission_personnel_id" name="mission_personnel_id" required
                                    class="block w-full p-2 text-[#1d65e7e0] border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500 ">
                                    <option>Selectionner une base</option>
                                    @foreach ($baseUser as $item)
                                        <option value="{{ $item->id }}">
                                            {{ $item->nom_base }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            {{-- <div class="mb-1 overflow-hidden border py-3 rounded-md px-4 bg-cyan-50">
                                <label for="mission_base_id"
                                    class="block mb-2 font-medium text-[#1d65e7e0] ">Selectionner
                                    une base pour la mission</label>
                                <div>
                                    <div id="controls-carousel" class="relative w-full" data-carousel="static">
                                        <!-- Carousel wrapper -->

                                        <div class="relative h-40 overflow-hidden rounded-lg ">
                                            <!-- Item 1 -->

                                            @foreach ($baseUser as $item)
                                                <div class="hidden duration-700 bg-stone-300 text-[#1d65e7e0] flex flex-col hover:shadow-xl cursor-pointer justify-center items-center from-white bg-gradient-to-br rounded-xl p-2 size-32  border-2 border-stone-300 ease-in-out"
                                                    data-carousel-item>
                                                    <img alt="regulateur" src="{{ asset($item->icon_base) }}"
                                                        class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2">
                                                    {{ $item->nom_base }}
                                                </div>
                                            @endforeach
                                        </div>
                                        <!-- Slider controls -->
                                        <button type="button"
                                            class="absolute top-0 start-0 left-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
                                            data-carousel-prev>
                                            <span
                                                class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-blue-300/30  group-hover:bg-blue-300/50  group-focus:ring-4 group-focus:ring-blue-300  group-focus:outline-none">
                                                <img width="20" alt="arrow left" height="20"
                                                    src="{{ asset('assets/icons/icons8-arrow-left-64.png') }}" />
                                                <span class="sr-only">Previous</span>
                                            </span>
                                        </button>
                                        <button type="button"
                                            class="absolute top-0 end-0 right-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
                                            data-carousel-next>
                                            <span
                                                class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-blue-300/30  group-hover:bg-blue-300/50  group-focus:ring-4 group-focus:ring-blue-300  group-focus:outline-none">
                                                <img width="20" alt="arrow left" height="20"
                                                    src="{{ asset('assets/icons/icons8-arrow-right-64.png') }}" />
                                                <span class="sr-only">Next</span>
                                            </span>
                                        </button>
                                    </div>
                                </div>
                            </div> --}}
                            <div class="mb-1 overflow-hidden rounded-md px-4 ">
                                <label for="mission_hopital_id" class="block mb-2 text-sm font-medium text-[#1d65e7e0] ">
                                    Selectionner l'Hôpital</label>
                                <select id="mission_hopital_id" name="mission_hopital_id" required
                                    class="block w-full p-2 text-[#1d65e7e0] border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500 ">
                                    <option>Selectionner un hopital</option>
                                    @foreach ($hopitals as $item)
                                        <option value="{{ $item->id }}">{{ $item->nom_hopital }}
                                            ({{ $item->capacite_hopital }})
                                        </option>
                                    @endforeach
                                </select>
                                {{-- <button id="dropdownHelperButton" data-dropdown-toggle="dropdownHelper"
                                    class="text-[#1d65e7e0] hover:bg-stone-200 focus:ring-4 focus:outline-none border font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center"
                                    type="button">Selectionner un hopital<svg class="w-2.5 h-2.5 ms-3"
                                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 10 6">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="m1 1 4 4 4-4" />
                                    </svg>
                                </button>
                                <div id="dropdownHelper"
                                    class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-96 ">
                                    <ul class="p-3 space-y-1 text-sm text-gray-700 "
                                        aria-labelledby="dropdownHelperButton">
                                        @foreach ($hopitals as $item)
                                            <li class="flex items-start border-b pb-2 gap-4">
                                                <div
                                                    class="text-[#1d65e7e0] flex flex-col cursor-pointer bg-cyan-50 justify-center hover:bg-cyan-100 items-center from-white bg-gradient-to-br rounded-xl size-20 shadow">

                                                    <img width="45" height="45" alt="regulateur"
                                                        src="{{ asset($item->icon_hopital) }}" />
                                                </div>
                                                <div>
                                                    <h3 class="text-left text-[#1d65e7e0] font-bold text-lg">
                                                        {{ $item->nom_hopital }}</h3>
                                                    <h4 class="text-left">Place restante {{ $item->capacite_hopital }}
                                                    </h4>
                                                    <div class="flex flex-row ">
                                                        <button
                                                            class="btn  p-1 px-2 text-white transition-all items-center border-white border-2 flex flex-row gap-2  text-sm justify-center from-stone-700 bg-gradient-to-t rounded-lg w-fit hover:bg-stone-600 bg-stone-500 font-semibold ">Afficher</button>
                                                        <button
                                                            class="btn  p-1 px-2 text-white transition-all items-center border-white border-2 flex flex-row gap-2  text-sm justify-center from-blue-700 bg-gradient-to-t rounded-lg w-fit hover:bg-blue-600 bg-blue-500 font-semibold ">Selectionner</button>
                                                    </div>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div> --}}
                            </div>
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div class="mb-1">
                                <label for="mission_unite_id"
                                    class="block mb-2 text-sm font-medium text-[#1d65e7e0] ">Mes
                                    unités</label>
                                {{-- <div id="controls-carousel" class="relative w-full" data-carousel="static">
                                    <!-- Carousel wrapper -->
                                    <div class="relative h-40 overflow-hidden rounded-lg ">
                                        <!-- Item 1 -->

                                        @foreach ($uniteUser as $item)
                                            <div class="hidden duration-700 bg-stone-300 text-[#1d65e7e0] flex flex-col hover:shadow-xl cursor-pointer justify-center items-center from-white bg-gradient-to-br rounded-xl p-2 size-32  border-2 border-stone-300 ease-in-out"
                                                data-carousel-item>
                                                <img alt="regulateur" src="{{ asset($item->icon_base) }}"
                                                    class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2">
                                                {{ $item->nom }}
                                            </div>
                                        @endforeach
                                    </div>
                                    <!-- Slider controls -->
                                    <button type="button"
                                        class="absolute top-0 start-0 left-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
                                        data-carousel-prev>
                                        <span
                                            class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-blue-300/30  group-hover:bg-blue-300/50  group-focus:ring-4 group-focus:ring-blue-300  group-focus:outline-none">
                                            <img width="20" alt="arrow left" height="20"
                                                src="{{ asset('assets/icons/icons8-arrow-left-64.png') }}" />
                                            <span class="sr-only">Previous</span>
                                        </span>
                                    </button>
                                    <button type="button"
                                        class="absolute top-0 end-0 right-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
                                        data-carousel-next>
                                        <span
                                            class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-blue-300/30  group-hover:bg-blue-300/50  group-focus:ring-4 group-focus:ring-blue-300  group-focus:outline-none">
                                            <img width="20" alt="arrow left" height="20"
                                                src="{{ asset('assets/icons/icons8-arrow-right-64.png') }}" />
                                            <span class="sr-only">Next</span>
                                        </span>
                                    </button>
                                </div> --}}

                                <select id="mission_unite_id" name="mission_unite_id" required
                                    class="block w-full p-2 text-[#1d65e7e0] border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500 ">
                                    <option>Selectionner une unité pour la mission</option>
                                    @foreach ($uniteUser as $item)
                                        <option value="{{ $item->id }}">{{ $item->nom }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-1">
                                <label for="mission_personnel_id"
                                    class="block mb-2 text-sm font-medium text-[#1d65e7e0] ">Personnel</label>
                                <select id="mission_personnel_id" name="mission_personnel_id" required
                                    class="block w-full p-2 text-[#1d65e7e0] border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500 ">
                                    <option>Selectionner un Personnel</option>
                                    @foreach ($personnel as $item)
                                        <option value="{{ $item->id }}">{{ $item->titre_personnel }}
                                            ({{ $item->quantite_personnel }})
                                            Niv {{ $item->niveau }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <button type="submit"
                            class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Engager</button>
                    </form>
                    <div class="block mb-2 text-black">
                        <span class="text-xl uppercase text-[#0f4098e0] font-bold">Données de l'appel </span>
                        <ul class=" data-mission border mt-3  border max-w-full rounded-sm">
                            <li>
                                <div class="bg-[#1d65e7e0] text-white   p-1 px-2 font-medium">Nom de la victime</div>
                                <div id="name-patient" class=" text-[#1d65e7e0] font-thin p-1 px-2 border-b"></div>
                            </li>
                            <li>
                                <div class="bg-[#1d65e7e0] text-white    p-1 px-2 font-medium">Age de la victime</div>
                                <div id="age-patient" class=" text-[#1d65e7e0] font-thin p-1 px-2 border-b"></div>
                            </li>
                            <li>
                                <div class="bg-[#1d65e7e0] text-white    p-1 px-2 font-medium">Numéro de téléphone
                                </div>
                                <div id="phone-patient" class=" text-[#1d65e7e0] font-thin p-1 px-2 border-b"></div>
                            </li>
                            <li>
                                <div class="bg-[#1d65e7e0] text-white    p-1 px-2 font-medium">Lieu de l'incident</div>
                                <div id="adresse-incident" class=" text-[#1d65e7e0] font-thin p-1 px-2 border-b">
                                </div>
                            </li>
                            {{-- <li>
                                <div class="bg-[#1d65e7e0] text-white    p-1 px-2 font-medium">Base de départ pour la
                                    mission</div>
                                <div id="base-init" class=" text-[#1d65e7e0] font-thin p-1 px-2 border-b"></div>
                            </li>
                            <li>
                                <div class="bg-[#1d65e7e0] text-white    p-1 px-2 font-medium">Hopital selectionné pour
                                    la mission</div>
                                <div id="hospital-init" class=" text-[#1d65e7e0] font-thin p-1 px-2 border-b"></div>
                            </li>
                            <li>
                                <div class="bg-[#1d65e7e0] text-white    p-1 px-2 font-medium">Unité selectionnée pour
                                    la mission</div>
                                <div id="hospital-init" class=" text-[#1d65e7e0] font-thin p-1 px-2 border-b"></div>
                            </li>
                            <li>
                                <div class="bg-[#1d65e7e0] text-white    p-1 px-2 font-medium">Personnel selectionné
                                    pour la mission</div>
                                <div id="hospital-init" class=" text-[#1d65e7e0] font-thin p-1 px-2 border-b"></div>
                            </li> --}}
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
