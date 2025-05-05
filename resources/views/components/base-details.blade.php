<div id="base-details-panel" style="z-index: 35"
    class="fixed top-0 left-0 z-30 items-end justify-center hidden w-full h-full overflow-x-hidden overflow-y-auto sm:items-center bg-black/20">
    <div class="panel-size">
        <div class="flex items-center justify-between p-4 border-b border-gray-600 rounded-t md:p-5">
            <h3 class="text-xl font-medium text-white">
                Base
            </h3>
            <button type="button" name="base-details-panel"
                class="flex items-center justify-center shadow-md close-modal-button backdrop-filter top-2 right-2">
                <img src="{{ asset('assets/images/icons8-close-48.png') }}" class="size-8" alt="" srcset="">
                <span class="hidden">Close</span>
            </button>
        </div>
        <div>
            <div>
                <ul>
                    <li class="p-3 text-2xl font-thin text-white" id="base-detail-name">Name</li>
                    <li class="flex items-center gap-2 p-3 text-white text-[12px]"><span
                            class="font-bold">Véhicules:</span>
                        <div class="flex items-center gap-3 "><span class="text-[12px]"
                                id="base-detail-unite-disponible"></span><button
                                class="flex items-center gap-2 p-1 px-3 text-xs text-left transition-all rounded-md cursor-pointer w-fit hover:fill-white hover:text-white text-white/70 hover:bg-stone-500 bg-stone-600 fill-stone-500"
                                id="show-vehicles">Afficher</button>
                        </div>
                    </li>
                    <li class="flex items-center bg-[#1a2539] gap-2 p-3 text-white text-[12px]"><span
                            class="font-bold">Personnel:</span>
                        <div class="flex items-center gap-3 "><span class="text-[12px]"
                                id="base-detail-personnel-disponible"></span><button
                                class="flex items-center gap-2 p-1 px-3 text-xs text-left transition-all rounded-md cursor-pointer w-fit hover:fill-white hover:text-white text-white/70 hover:bg-stone-500 bg-stone-600 fill-stone-500"
                                id="show-personnel">Afficher</button>
                        </div>
                    </li>
                    <li class="flex items-start gap-2 p-3 text-white text-[12px]"><span
                            class="font-bold">Description:</span><span class="text-[12px]"
                            id="base-detail-description"></span></li>
                    <li class="flex items-start gap-2 p-3 text-white text-[12px]"><span
                            class="font-bold">Lieu:</span><span class="text-[12px]" id="base-detail-address"></span>
                    </li>
                </ul>
                <div class="p-3 overflow-y-auto h-[350px]">
                    <div
                        class="text-sm font-medium text-center text-gray-500 border-b border-gray-200 dark:text-gray-400 dark:border-gray-700">
                        <ul class="flex flex-wrap -mb-px">
                            <li class="me-2">
                                <button name="unite" id="tab-action-unite"
                                    class="inline-block p-4 border-b-2 border-transparent rounded-t-lg cursor-pointer tab-action hover:text-gray-600 hover:border-gray-300 ">
                                    Véhicules
                                </button>
                            </li>
                            <li class="me-2">
                                <button name="personnel" id="tab-action-personnel"
                                    class="inline-block p-4 border-b-2 border-transparent rounded-t-lg cursor-pointer tab-action active "
                                    aria-current="page">
                                    Personnel
                                </button>
                            </li>
                        </ul>
                    </div>
                    <div class="bg-[#1a2539] shadow-inner rounded-xl ">
                        <div id="table-unite-base-details-panel" class="grid grid-cols-1 gap-2 p-2 sm:grid-cols-3">

                        </div>
                        <div id="table-personnel-base-details-panel" class="grid grid-cols-1 gap-2 p-2 sm:grid-cols-3">

                        </div>
                        <table id="table-unite-base-details-panel"
                            class="w-full text-sm text-left text-gray-400 rtl:text-right">
                            <thead class="text-xs text-gray-400 uppercase bg-gray-700">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        Nom
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        statut
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Mission actuelle
                                    </th>
                                    <th>
                                        etat de santé
                                    </th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                    <div class="flex items-center gap-4 mt-4">
                        <button name="shop-panel"
                            class=" gap-2 show-modal p-2 border border-[#15244c] px-4 fill-white bg-white hover:bg-[#15244c] w-fit  flex items-center h-full hover:border hover:border-white text-[#15244c] font-bold hover:text-white  text-left text-sm transition-all rounded-md cursor-pointer">Recruter
                            ou acheter un véhicule</button>
                        <input type="text" class="hidden" id="id-base" >
                        <button id="delete-base"
                            class=" gap-2 p-2 border border-[#15244c] px-4 fill-white bg-red-600 hover:bg-red-500 w-fit  flex items-center h-full hover:border hover:border-white text-white  text-left text-sm transition-all rounded-md cursor-pointer">Supprimer
                            la base</button>
                    </div>
                </div>
            </div>
        </div>
        <div id="loader-detail-base"
            class="flex flex-col absolute  min-h-[500px] bg-[#14264b] items-center justify-center w-full h-full z-50 top-0 left-0 ">
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
            <button class="mt-2 font-bold text-white close-loader" name="base-details-panel">Annuler</button>
        </div>
    </div>
</div>

<script>
    document.getElementById('show-vehicles').addEventListener('click', function() {
        document.getElementById('tab-action-unite').scrollIntoView({
            behavior: 'smooth'
        });
    });

    document.getElementById('show-personnel').addEventListener('click', function() {
        document.getElementById('tab-action-personnel').scrollIntoView({
            behavior: 'smooth'
        });
    });
</script>
