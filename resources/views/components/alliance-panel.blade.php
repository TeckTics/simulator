<div id="alliance-panel"
    class="fixed top-0 left-0 z-30 items-end sm:items-center justify-center hidden w-full h-full overflow-x-hidden overflow-y-auto bg-black/20">

    <div class="panel-size">
        <div class="flex items-center justify-between p-4 border-b border-gray-600 rounded-t md:p-5">
            <h3 class="text-xl font-medium text-white">
                Alliances SAMU
            </h3>
            <button type="button"  name="alliance-panel"
                class="flex items-center justify-center shadow-md close-modal-button backdrop-filter top-2 right-2">
                <img src="{{ asset('assets/images/icons8-close-48.png') }}" class="size-8" alt=""
                    srcset="">
                <span class="hidden">Close</span>
            </button>
        </div>
        <div>
            <p id="success-alliance-message"></p>
            <div class="bg-[#151b28] overflow-hidden px-4  mt-2 py-3 ">
                <button id="create-alliance-button" name="modal-form"
                    class=" gap-2 rounded-xl show-modal mb-2 p-2.5 px-4 fill-white bg-white hover:bg-[#15244c] w-fit  flex items-center h-full text-[#15244c] font-bold hover:text-white   text-left text-sm transition-all  cursor-pointer">
                    Créer une alliance
                </button>
                <div id="timer-alliance-panel" class=" gap-2 rounded-xl show-modal mb-2 p-2.5 px-4 fill-white  w-fit  flex items-center h-full font-normal text-white   text-left text-sm transition-all  cursor-pointer">
                   
                </div>
                <form id="search-alliance-form" class="flex flex-row items-center w-full gap-4">
                    <input type="search" id="clan_search" name="name" required placeholder="Nom de l'alliance"
                        class="block w-4/5 p-2.5 text-[#14264b] border font-medium border-gray-300 rounded-lg bg-stone-50 text-xs focus:ring-blue-500 focus:border-blue-500 ">
                    <button 
                        class=" gap-2 border  rounded-xl p-2.5 px-4 fill-white bg-[#151b28] hover:bg-[#15244c] w-fit  flex items-center h-full text-white/70 hover:text-white   text-left text-sm transition-all  cursor-pointer">
                        Rechercher
                    </button>
                </form>
            </div>

        </div>
        <div class="flex flex-col max-w-5xl gap-2 px-5 mx-auto my-4">
            <p class="text-red-500" id="input-error-search-alliance"></p>
            <div id="alliance-list"> </div>
        </div>
        <div>
            <x-alliance-detail-panel/>
        </div>
        <div>
            <div id="modal-form" style=" font-family: 'Plus Jakarta Sans' "
                class="fixed top-0 left-0 items-center justify-center hidden w-full h-full bg-black/50">
                <form id="create-clan-form" class="modal-content p-10 shadow-xl rounded-xl  bg-[#14264b] max-w-2xl"
                    method="POST">
                    @csrf
                    <input hidden type="number" name="prix" value="{{ $prix }}">
                    <div class="flex items-center justify-between modal-header">
                        <h5 class="text-2xl font-bold text-center text-white modal-title " id="exampleModalLabel">
                            Créer une alliance</h5>

                        <button type="button"  name="modal-form"
                            class="flex items-center justify-center shadow-md close-modal-button backdrop-filter top-2 right-2">
                            <img src="{{ asset('assets/images/icons8-close-48.png') }}" class="size-8" alt=""
                                srcset="">
                            <span class="hidden">Close</span>
                        </button>
                    </div>
                    <p class="text-red-500 " id="message-error-create-alliance"></p>
                    <div class="modal-body">
                        <label for="nom_clan" class="block mb-2 text-sm font-medium text-white ">Selectionner
                            votre
                            écusson</label>
                        <div class="flex flex-row flex-wrap justify-center gap-4 mb-4">
                            <button type="button" name="assets/images/clan1.png"
                                class="p-2 border-4 border-white cursor-pointer check-spc rounded-xl bg-stone-100 bg-gradient-to-tr"
                                name="assets/images/clan1.png">
                                <img src="{{ asset('assets/images/clan1.png') }}" width="50" height="50"
                                    alt="">
                            </button>
                            <button type="button" name="assets/images/clan2.png"
                                class="p-2 border-4 border-white cursor-pointer check-spc rounded-xl bg-stone-100 bg-gradient-to-tr"
                                name="assets/images/clan2.png">
                                <img src="{{ asset('assets/images/clan2.png') }}" width="50" height="50"
                                    alt="">
                            </button>
                            <button type="button" name="assets/images/clan3.png"
                                class="p-2 border-4 border-white cursor-pointer check-spc rounded-xl bg-stone-100 bg-gradient-to-tr"
                                name="assets/images/clan3.png">
                                <img src="{{ asset('assets/images/clan3.png') }}" width="50" height="50"
                                    alt="">
                            </button>
                            <button type="button" name="assets/images/clan4.png"
                                class="p-2 border-4 border-white cursor-pointer check-spc rounded-xl bg-stone-100 bg-gradient-to-tr"
                                name="assets/images/clan4.png">
                                <img src="{{ asset('assets/images/clan4.png') }}" width="50" height="50"
                                    alt="">
                            </button>
                        </div>
                        <input type="text" id="banner_clan" hidden name="banner"
                            class="w-full p-3 text-sm focus-visible:outline-blue-500 focus-visible:outline-1 focus-visible:placeholder:text-blue-500 rounded-xl">
                        <div class="mb-1">
                            <label for="nom_clan" class="block mb-2 text-sm font-medium text-white ">Nom de
                                l'alliance</label>
                            <input type="text" id="nom_clan" name="nom_clan" required
                                placeholder="Donner un nom à votre Alliance"
                                class="w-full p-3 text-sm focus-visible:outline-blue-500 focus-visible:outline-1 focus-visible:placeholder:text-blue-500 rounded-xl">
                        </div>
                        <div class="mb-1">
                            <label for="description_clan"
                                class="block mb-2 text-sm font-medium text-white ">Description de l'alliance
                            </label>
                            <textarea id="description_clan" name="description_clan" rows="4" required
                                class="w-full p-3 text-sm focus-visible:outline-blue-500 focus-visible:outline-1 focus-visible:placeholder:text-blue-500 rounded-xl"
                                placeholder="Donne une description à votre alliance"></textarea>
                        </div>
                    </div>
                    <div class="mt-2 modal-footer ">
                        <button
                            class=" gap-2 rounded-xl justify-center p-4 fill-white text-center bg-[#151b28] hover:bg-[#15244c] hover:ring-4 hover:ring-white/20 w-full  flex items-center h-full text-white/70 hover:text-white  text-sm transition-all  cursor-pointer"
                            type="submit">Créer {{ $prix }} <img width="24" height="24"
                                src="{{ url('assets/images/icons8-money-48.png') }}" alt=""
                                srcset=""></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
