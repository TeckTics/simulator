<div id="alliance-details" 
class="fixed top-0 left-0 z-30 items-end sm:items-center justify-center hidden w-full h-full overflow-x-hidden overflow-y-auto bg-black/20">
    <div class="panel-size">
        <button type="button" name="alliance-details"
            class="absolute flex items-center justify-center shadow-md close-modal-button backdrop-filter top-2 right-2">
            <img src="{{ asset('assets/images/icons8-close-48.png') }}" class="size-8" alt="" srcset="">
            <span class="hidden">Close</span>
        </button>
        <div class="grid w-full h-full grid-cols-1 gap-4 sm:grid-cols-3 md:grid-cols-5">
            <div style="max-height: 70vh;" class="h-full col-span-2">
                <div class=" h-full shadow bg-[#151b28] text-white  ">
                    <div class="p-4 ">
                        <img src="" id="alliance-detail-banner" width="150" class="mx-auto" height="150"
                            alt="" srcset="">
                    </div>
                    <div class="py-4 ">
                        <h3 style=" text-shadow: 1px 1px 6px rgba(0, 0, 0, 0.315);"
                            class="text-2xl font-bold text-center text-blue-500" id="alliance-detail-name"></h3>
                        <p class="max-w-sm my-4 text-sm font-thin text-center text-white/80" id="alliance-detail-description"></p>
                        <div class="flex flex-col items-center justify-center">
                            <div id="alliance-detail-niveau-image"></div>
                            <h3>Alliance de niveau <span id="alliance-detail-niveau-name"></span></h3>

                        </div>
                        <div class="mt-2">
                            <ul>
                                <li class="flex justify-between px-4 bg-[#1a2539] p-2">
                                    <span>Popularité</span><span>0</span>
                                </li>
                                <li class="flex justify-between px-4 bg-[#151b28] p-2">
                                    <span>Experience</span><span id="alliance-detail-experience"></span>
                                </li>
                                <li class="flex justify-between px-4 bg-[#1a2539]    p-2">
                                    <span>Nombre de places</span><span id="alliance-detail-max"></span>
                                </li>
                                <li class="flex justify-between px-4 bg-[#151b28]    p-2">
                                    <span>Interventions réussies</span><span>0</span>
                                </li>
                                <li class="flex justify-between px-4 bg-[#1a2539]    p-2">
                                    <span>Nombre d'interventions</span><span>0</span>
                                </li>
                                <li class="p-2 px-4 mt-2 ">
                                    <input type="text" hidden id="id-alliance">
                                    <div class="flex-wrap items-start block w-full gap-2 sm:flex">
                                        <button id="leave-alliance-btn"
                                            class="gap-2 p-2 text-sm text-left transition-all bg-red-600 cursor-pointer rounded-xl sm:p-4 fill-red-500 hover:bg-red-500 w-fit hover:fill-white text-white/70 hover:text-white"
                                            type="submit">Quitter l'alliance </button>
                                        <button id="destroy-alliance-btn"
                                            class="gap-2 p-2 text-sm text-left transition-all bg-red-600 cursor-pointer rounded-xl sm:p-4 fill-red-500 hover:bg-red-500 w-fit hover:fill-white text-white/70 hover:text-white"
                                            type="submit">Détruire l'alliance </button>
                                        <button id="upgrade-alliance-btn" name="modal-upgrade-alliance"
                                            class="gap-2 p-2 text-sm text-left transition-all bg-blue-600 cursor-pointer rounded-xl sm:p-4 show-modal fill-blue-500 hover:bg-blue-500 w-fit hover:fill-white text-white/70 hover:text-white"
                                            type="submit">Monter de niveau
                                        </button>
                                        <button id="edit-alliance-btn" name="modal-form-edit"
                                            class="gap-2 p-2 text-sm text-left transition-all bg-yellow-600 cursor-pointer rounded-xl sm:p-4 show-modal fill-yellow-500 hover:bg-yellow-500 w-fit hover:fill-white text-white/70 hover:text-white"
                                            type="submit">Editer</button>
                                        <button id="select-alliance-button"
                                            class=" gap-2 rounded-xl show-modal mb-2  sm:p-4 p-2 hover:ring-2 fill-white bg-white hover:bg-[#15244c] w-fit hover:fill-blue-500 flex items-center text-[#15244c] font-bold hover:text-white   text-left text-sm transition-all  cursor-pointer">
                                            Entrer dans l'alliance
                                        </button>
                                        <div id="timer-alliance-detail-panel"
                                            class=" gap-2 rounded-xl show-modal mb-2 p-2.5 px-4 fill-white  w-fit  flex items-center h-full font-normal text-white   text-left text-sm transition-all  cursor-pointer">

                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>  
            </div>
            <div class="h-full col-span-3 p-4 pr-8">
                <h3 class="mt-4 mb-2 text-2xl font-bold text-center text-white ">Membres</h3>
                <div class="flex justify-between gap-4">
                </div>
                <div class="mt-2 overflow-hidden rounded-lg">
                    <div class="relative overflow-y-auto">
                        <div class="grid items-center justify-between grid-cols-3 gap-4 p-2 text-center bg-white show-event btn">
                            <div class="flex items-center justify-center gap-2 text-center">
                               
                                <span class="text-[14px] font-bold text-[#1a2539] ">Nom</span>
                            </div>
                            <div class="text-center ">
                                <span class="text-[14px] font-bold text-[#1a2539] ">Nombre d'unités</span>
                            </div>
                            <div class="text-center">
                                <span class="text-[14px] font-bold text-[#1a2539] ">Experience</span>
                            </div>
                        </div>
                        <div class="relative flex flex-col gap-2 overflow-x-auto" id="alliance-detail-users">
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div id="loader-detail-alliance"
            class="flex absolute  min-h-[500px] bg-[#14264b] items-center justify-center w-full h-full z-50 top-0 left-0 ">
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
        <div id="modal-upgrade-alliance" style=" font-family: 'Plus Jakarta Sans' "
            class="fixed top-0 left-0 items-center justify-center hidden w-full h-full bg-black/50">
            <div class="modal-content p-10 shadow-xl rounded-xl  bg-[#14264b] max-w-3xl">
                <div class="flex items-center justify-between modal-header">
                    <h5 class="text-2xl font-bold text-center text-white modal-title " id="exampleModalLabel">
                        Monter le niveau de l'alliance</h5>

                    <button type="button" name="modal-upgrade-alliance"
                        class="flex items-center justify-center shadow-md close-modal-button backdrop-filter top-2 right-2">
                        <img src="{{ asset('assets/images/icons8-close-48.png') }}" class="size-8" alt=""
                            srcset="">
                        <span class="hidden">Close</span>
                    </button>
                </div>
                <p id="message-upgrade-alliance" class="my-4 text-white"></p>
                <p id="message-error-upgrade-alliance" class="text-sm text-red-500"></p>
                <div class="mt-2 modal-footer" id="button-upgrade-alliance">
                    <button
                        class=" gap-2 rounded-xl justify-center p-4 fill-white text-center bg-[#151b28] hover:bg-[#15244c] hover:ring-4 hover:ring-white/20 w-full  flex items-center h-full text-white/70 hover:text-white  text-sm transition-all  cursor-pointer"
                        type="submit">Valider</button>
                </div>
            </div>
        </div>
        <div id="modal-form-edit" style=" font-family: 'Plus Jakarta Sans' "
            class="fixed top-0 left-0 items-center justify-center hidden w-full h-full bg-black/50">
            <form id="edit-clan-form" class="modal-content p-10 shadow-xl rounded-xl  bg-[#14264b] max-w-2xl"
                method="POST">

                <div class="flex items-center justify-between modal-header">
                    <h5 class="text-2xl font-bold text-center text-white modal-title " id="exampleModalLabel">
                        Modifier votre alliance</h5>

                    <button type="button" name="modal-form-edit"
                        class="flex items-center justify-center shadow-md close-modal-button backdrop-filter top-2 right-2">
                        <img src="{{ asset('assets/images/icons8-close-48.png') }}" class="size-8" alt=""
                            srcset="">
                        <span class="hidden">Close</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p class="text-red-500 " id="message-error-create-alliance-edit"></p>
                    <input type="number" id="edit-clan-form-id" hidden name="id">
                    <div class="mb-1">
                        <label for="edit-clan-form-nom" class="block mb-2 text-sm font-medium text-white">Donner
                            un nom à votre Alliance</label>
                        <input type="text" id="edit-clan-form-nom" name="nom_clan"
                            class="block w-full p-2 text-xs border border-gray-300 rounded-lg text-stone-800 bg-stone-50 focus:ring-blue-500 focus:border-blue-500 ">
                    </div>
                    <div class="mb-1">
                        <label for="edit-clan-form-description"
                            class="block mb-2 text-sm font-medium text-white">Donner
                            une
                            description
                        </label>
                        <textarea id="edit-clan-form-description" name="description_clan" rows="4"
                            class="block resize-none p-2.5 w-full text-sm text-stone-800 bg-stone-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 "
                            placeholder="Décrire l'événement"></textarea>
                    </div>
                </div>
                <div class="mt-2 modal-footer">
                    <button
                        class=" gap-2 rounded-xl justify-center p-4 fill-white text-center bg-[#151b28] hover:bg-[#15244c] hover:ring-4 hover:ring-white/20 w-full  flex items-center h-full text-white/70 hover:text-white  text-sm transition-all  cursor-pointer"
                        type="submit">Modifier</button>
                </div>
            </form>
        </div>
    </div>
</div>
