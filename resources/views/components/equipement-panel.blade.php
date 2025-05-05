<div id="equipments-panel"
class="fixed top-0 left-0 z-30 items-end sm:items-center justify-center hidden w-full h-full overflow-x-hidden overflow-y-auto bg-black/20">
    <div class="panel-size">
        <div class="flex items-center justify-between p-4 border-b border-gray-600 rounded-t md:p-5">
            <h3 class="text-xl font-medium text-white">
                Mes unités
            </h3>
            <button type="button" name="equipments-panel"
                class="flex items-center justify-center shadow-md close-modal-button backdrop-filter top-2 right-2">
                <img src="{{ asset('assets/images/icons8-close-48.png') }}" class="size-8" alt="" srcset="">
                <span class="hidden">Close</span>
            </button>
        </div>
        <div class="relative z-10 p-2">
            <div class="flex items-center justify-start w-full max-w-6xl gap-4 mx-auto mt-2">
                <button id="all-equipments-list"
                    class="flex items-center h-full gap-2 p-2 px-4 text-sm font-bold transition-all rounded-md w-fit text-white/70 hover:text-white">
                    <svg width="24" height="24" viewBox="0 0 16 16" fill="none"
                        xmlns="http://www.w3.org/2000/svg" stroke="#14264b">
                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                        <g id="SVGRepo_iconCarrier">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M7 1H1V7H7V1ZM7 9H1V15H7V9ZM9 1H15V7H9V1ZM15 9H9V15H15V9Z" fill="#ffffff"></path>
                        </g>
                    </svg>
                    Eclaté
                </button>
                <button
                    class=" gap-2 p-2 fill-white bg-white stroke-[#14264b] hover:stroke-white hover:bg-[#15244c] w-fit hover:fill-blue-500 flex items-center h-full text-[#15244c] font-bold hover:text-white   text-left text-sm transition-all rounded-md cursor-pointer">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                        <g id="SVGRepo_iconCarrier">
                            <path
                                d="M4 6C4 4.89543 4.89543 4 6 4H18C19.1046 4 20 4.89543 20 6V18C20 19.1046 19.1046 20 18 20H6C4.89543 20 4 19.1046 4 18V6Z"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                        </g>
                    </svg>
                    Regroupé
                </button>
            </div>
            <div class="mt-8 p-4 flex flex-row justify-center sm:justify-start h-[500px] overflow-y-auto max-w-6xl w-full mx-auto flex-wrap gap-3 sm:gap-6"
                id="equipment-unite-list">

            </div>
        </div>
        <div>
            <x-card-unite-panel></x-card-unite-panel>
        </div>
    </div>

</div>
