<div id="personnels-panel"
    class="fixed top-0 left-0 z-30 items-end justify-center hidden w-full h-full overflow-x-hidden overflow-y-auto sm:p-4 sm:items-center bg-black/20">
    <div class="panel-size">
        <div class="flex items-center justify-between p-4 border-b border-gray-600 rounded-t md:p-5">
            <h3 class="text-xl font-medium text-white">
                Mon personnel SAMU
            </h3>
            <button type="button" name="personnels-panel"
                class="flex items-center justify-center shadow-md close-modal-button backdrop-filter top-2 right-2">
                <img src="{{ asset('assets/images/icons8-close-48.png') }}" class="size-8" alt="" srcset="">
                <span class="hidden">Close</span>
            </button>
        </div>
        <div class="relative z-10 p-2">
            <form id="search-alliance-form" class="flex flex-row items-center w-full gap-4 mt-4">
                <input type="search" id="clan_search" name="name" required placeholder="Titre du personnel"
                    class="block w-4/5 p-2.5 text-[#14264b] border font-medium border-gray-300 rounded-lg bg-stone-50 text-xs focus:ring-blue-500 focus:border-blue-500 ">
                <button 
                    class=" gap-2 border  rounded-xl p-2.5 px-4 fill-white bg-[#151b28] hover:bg-[#15244c] w-fit  flex items-center h-full text-white/70 hover:text-white   text-left text-sm transition-all  cursor-pointer">
                    Rechercher
                </button>
            </form>
            <div class="max-w-md mt-2">
                <div class="w-full">
                    <label for="base_id_personnel" class="block mb-2 text-sm text-[14px]  text-white ">Trier selon la base</label>
                    <select id="base_id_personnel" name="base_id_personnel" required
                        class="block w-full p-2 text-white border border-gray-300  rounded-sm bg-[#14264b] text-xs focus:ring-blue-500 focus:border-blue-500 ">
                        <option>Selectionner une base</option>
                    </select>
                </div>
            </div>
            <div class="" class="relative overflow-hidden">
                <div class="relative z-10 ">
                    <div style="height: 500px" class="grid flex-wrap w-full max-w-6xl grid-cols-1 gap-3 p-2 mx-auto mt-8 overflow-y-auto sm:grid-cols-2 sm:gap-6"
                        id="personnel-list">
                    </div>
                </div>
            </div>
            <div id="loader-personnel"
                class="flex absolute max-h-full sm:max-h-[500px] bg-[#14264b] items-center justify-center w-full h-full z-50 top-0 left-0 ">
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
            <div>
                <x-card-personnel />
            </div>
        </div>
    </div>
</div>
