<div id="garage-panel"
class="fixed top-0 left-0 z-30 items-end sm:items-center justify-center hidden w-full h-full overflow-x-hidden overflow-y-auto bg-black/20">
    <div class="panel-size" style="max-width: 800px">
        <div class="flex items-center justify-between p-4 border-gray-600 rounded-t md:p-5">
            <h3 class="text-xl font-medium text-white" style="font-family: 'Plus Jakarta Sans'">
                Garage
            </h3>
            <button type="button" name="garage-panel"
                class="flex items-center justify-center shadow-md close-modal-button backdrop-filter top-2 right-2">
                <img src="{{ asset('assets/images/icons8-close-48.png') }}" class="size-8" alt=""
                    srcset="">
                <span class="hidden">Close</span>
            </button>
        </div>
        <div class="w-full p-2 h-fit">
            <div class="w-full h-fit bg-[#1a2539]">
                <div id="container-unite" class="w-full p-4 text-white ">
                    <img src="{{ asset('/images/1729573733.jpg') }}" class="mx-auto size-96" alt=""
                        srcset="">

                    <h3 class="my-4 text-5xl font-semibold text-center " style="font-family: 'Plus Jakarta Sans'">Nom
                    </h3>
                    <div class="grid items-center grid-cols-6 gap-2">
                        <div class="col-span-1 font-semibold ">Santé</div>
                        <div class="w-full h-6 col-span-4 bg-white">
                            <div class="w-full h-full p-2 bg-blue-500"></div>
                        </div>
                        <div class="col-span-1 font-semibold">100%</div>
                    </div>
                    <div class="grid items-center grid-cols-6 gap-2">
                        <div class="col-span-1 font-semibold">Vitesse de déplacement:</div>
                        <div class="grid w-full h-6 grid-cols-5 col-span-4 gap-2 mt-2 ">
                            <div class="flex justify-center w-full h-full p-2 bg-blue-500">+2km/h </div>
                            <div class="flex justify-center w-full h-full p-2 bg-white"></div>
                            <div class="flex justify-center w-full h-full p-2 bg-white"></div>
                            <div class="flex justify-center w-full h-full p-2 bg-white"></div>
                            <div class="flex justify-center w-full h-full p-2 bg-white"></div>
                        </div>
                        <div class="col-span-1 font-semibold">20 km/h</div>
                    </div>
                    <div class="grid items-center grid-cols-6 gap-2 mt-4">
                        <div class="col-span-1 font-semibold">Usure:</div>
                        <div class="grid w-full h-6 grid-cols-5 col-span-4 gap-2 mt-2 ">
                            <div class="flex justify-center w-full h-full p-2 bg-red-500">-2%</div>
                            <div class="flex justify-center w-full h-full p-2 bg-white"></div>
                            <div class="flex justify-center w-full h-full p-2 bg-white"></div>
                            <div class="flex justify-center w-full h-full p-2 bg-white"></div>
                            <div class="flex justify-center w-full h-full p-2 bg-white"></div>
                        </div>
                        <div class="col-span-1 font-semibold">20%</div>
                    </div>
                </div>
                <div class="flex items-center p-4 mt-4">
                    <button id="upgrade-alliance-btn" name="modal-upgrade-alliance"
                        class="flex items-center gap-2 p-2 text-sm text-left transition-all bg-blue-600 cursor-pointer rounded-xl sm:p-4 show-modal fill-blue-500 hover:bg-blue-500 w-fit hover:fill-white text-white/70 hover:text-white"
                        type="submit">Achteter une amélioration
                    </button>
                    <button id="upgrade-alliance-btn" name="modal-upgrade-alliance"
                        class="flex items-center gap-2 p-2 text-sm text-left transition-all bg-blue-600 cursor-pointer rounded-xl sm:p-4 show-modal fill-blue-500 hover:bg-blue-500 w-fit hover:fill-white text-white/70 hover:text-white"
                        type="submit">Réparer
                    </button>
                </div>
                <div class="flex items-center justify-between p-4 mt-4">
                    <button id="upgrade-alliance-btn" name="modal-upgrade-alliance"
                        class="flex items-center gap-2 p-2 text-sm text-left transition-all bg-blue-600 cursor-pointer rounded-xl sm:p-4 show-modal fill-blue-500 hover:bg-blue-500 w-fit hover:fill-white text-white/70 hover:text-white"
                        type="submit">Véhicule précedent
                    </button>
                    <div>
                        1 sur 3 
                    </div>
                    <button id="upgrade-alliance-btn" name="modal-upgrade-alliance"
                        class="flex items-center gap-2 p-2 text-sm text-left transition-all bg-blue-600 cursor-pointer rounded-xl sm:p-4 show-modal fill-blue-500 hover:bg-blue-500 w-fit hover:fill-white text-white/70 hover:text-white"
                        type="submit">Véhicule suivant 
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
