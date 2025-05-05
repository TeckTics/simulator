<div id="stat-panel"
class="fixed top-0 left-0 z-30 items-end sm:items-center justify-center hidden w-full h-full overflow-x-hidden overflow-y-auto bg-black/20">
    <div class="panel-size">
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t =">
                <h3 class="text-xl font-medium text-white">
                    Mes statistiques
                </h3>
                <button type="button" name="stat-panel"
                    class="flex items-center justify-center shadow-md close-modal-button backdrop-filter top-2 right-2">
                    <img src="{{ asset('assets/images/icons8-close-48.png') }}" class="size-8" alt=""
                        srcset="">
                    <span class="hidden">Close</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-4 space-y-4 md:p-5">
                <div class="px-6 text-[14px] text-white py-4 bg-gray-800">
                    Mes statistiques d'interventions <span id="periodStat"></span>
                    <div class="flex items-center gap-2 mt-2">
                        <button name="semaine"
                            class="gap-2 p-2 px-3 change-stat fill-white bg-white hover:bg-[#15244c] w-fit hover:fill-blue-500 flex items-center h-full text-[#15244c] font-bold hover:text-white  text-left text-[12px] transition-all rounded-md cursor-pointer">Cette
                            semaine</button>
                        <button name="mois"
                            class="gap-2 p-2 px-3 change-stat fill-white bg-white hover:bg-[#15244c] w-fit hover:fill-blue-500 flex items-center h-full text-[#15244c] font-bold hover:text-white  text-left text-[12px] transition-all rounded-md cursor-pointer">Ce
                            mois</button>
                    </div>
                </div>
                <table class="w-full text-sm text-left text-gray-400 rtl:text-right">
                    <thead class="text-xs text-gray-400 uppercase bg-gray-700">
                        <tr>
                            <th scope="col" class="px-6 py-4">
                                Statistiques du Joueur
                            </th>
                            <th scope="col" class="px-6 py-4">
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="bg-gray-800">
                            <th scope="row" class="px-6 py-4 font-medium text-white whitespace-nowrap">
                                Nombre d'interventions
                            </th>
                            <td class="px-6 py-4 text-blue-500">
                                <span id="nbIntervention"></span>
                            </td>
                        </tr>
                        <tr class="bg-gray-800 border-gray-700">
                            <th scope="row" class="px-6 py-4 font-medium text-white whitespace-nowrap">
                                Nombre de véhicules
                            </th>
                            <td class="px-6 py-4">
                                <span id="nbUnite"></span>
                            </td>
                        </tr>
                        <tr class="bg-gray-800 border-gray-700">
                            <th scope="row" class="px-6 py-4 font-medium text-white whitespace-nowrap">
                                Nombre de personnels
                            </th>
                            <td class="px-6 py-4 text-red-500">
                                <span id="nbPersonnel"></span>
                            </td>
                        </tr>

                        <tr class="bg-gray-800 border-gray-700">
                            <th scope="row" class="px-6 py-4 font-medium text-white whitespace-nowrap">
                                Total équipements
                            </th>
                            <td class="px-6 py-4 text-red-500">
                                <span id="nbEquipement"></span>
                            </td>
                        </tr>
                        <tr class="bg-gray-800 border-gray-700">
                            <th scope="row" class="px-6 py-4 font-medium text-white whitespace-nowrap">
                                Total améliorations
                            </th>
                            <td class="px-6 py-4 text-red-500">
                                <span id="nbAmelioration"></span>
                            </td>
                        </tr>
                        <tr class="bg-gray-800 border-gray-700">
                            <th scope="row" class="px-6 py-4 font-medium text-white whitespace-nowrap">
                                Réactivité au mission
                            </th>
                            <td class="px-6 py-4 text-red-500">
                                <span id="reactMission"></span>
                            </td>
                        </tr>
                        <tr class="bg-gray-800 border-gray-700">
                            <th scope="row" class="px-6 py-4 font-medium text-white whitespace-nowrap">
                                Pourcentage de réussite
                            </th>
                            <td class="px-6 py-4 text-red-500">
                                <span id="percentageSuccess"></span>
                            </td>
                        </tr>
                    </tbody>
                </table>

            </div>
    </div>
</div>
