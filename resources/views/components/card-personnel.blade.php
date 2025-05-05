<div id="card-personnel-formation-panel"
    class="fixed top-0 left-0 z-30 items-center justify-center hidden w-full h-full p-4 overflow-x-hidden overflow-y-auto bg-black/50">
    <div class="panel-size">
        <div class="flex items-center justify-between p-4 border-b border-gray-600 rounded-t md:p-5">
            <h3 class="text-xl font-medium text-white">
                Formations
            </h3>
            <button type="button"  name="card-personnel-formation-panel"
                class="flex items-center justify-center shadow-md close-modal-button backdrop-filter top-2 right-2">
                <img src="{{ asset('assets/images/icons8-close-48.png') }}" class="size-8" alt=""
                    srcset="">
                <span class="hidden">Close</span>
            </button>
        </div>
        <div class="grid grid-cols-4 gap-4 px-4 py-2" id="formation-list">
      
        </div>
        <div id="loader-personnel-card"
        class="flex absolute max-h-full bg-[#14264b] items-center justify-center w-full h-full z-50 top-0 left-0 ">
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
</div>
