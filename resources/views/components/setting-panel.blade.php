<div id="setting-panel"
class="fixed top-0 left-0 z-30 items-end sm:items-center justify-center hidden w-full h-full overflow-x-hidden overflow-y-auto bg-black/20">
    <div class="panel-size">
        <div class="flex items-center justify-between p-4 border-b border-gray-600 rounded-t md:p-5">
            <h3 class="text-xl font-medium text-white">
                Paramètres
            </h3>
            <button type="button"  name="setting-panel"
                class="flex items-center justify-center shadow-md close-modal-button backdrop-filter top-2 right-2">
                <img src="{{ asset('assets/images/icons8-close-48.png') }}" class="size-8" alt=""
                    srcset="">
                <span class="hidden">Close</span>
            </button>
        </div>
        <div class="h-[70vh] flex flex-col justify-between">
            <div class="p-4">
                <h2 class="mt-8 text-3xl text-white">Paramètres globaux</h2>
                <div>
                    <label for="countries" class="block text-sm text-white sm:mb-2 "></label>
                    <select id="countries"
                    class="w-full p-2 text-sm focus-visible:ring-blue-500 focus-visible:ring-1 rounded-xl">
                        <option></option>
                        @foreach ($villes as $item)
                            <option value="{{ $item->id }}">{{ $item->place }}</option>
                        @endforeach
                    </select>

                </div>
                <div class="flex items-center mt-3">
                    <input  id="son-checked" type="checkbox" value=""
                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 ">
                    <label for="son-checked" class="text-sm font-medium text-white ms-2 ">Activer le son</label>
                </div>
                <div class="flex items-center mt-3">
                    <input checked id="" type="checkbox" value=""
                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 ">
                    <label for="" class="text-sm font-medium text-white ms-2 ">Afficher le nom des véhicules
                        sur la carte</label>
                </div>
                <div class="flex items-center mt-3">
                    <input checked id="" type="checkbox" value=""
                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 ">
                    <label for="" class="text-sm font-medium text-white ms-2 ">Afficher le nom des
                        bases</label>
                </div>
                <div class="flex items-center mt-3">
                    <input checked id="" type="checkbox" value=""
                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 ">
                    <label for="" class="text-sm font-medium text-white ms-2 ">Afficher les bases
                        inactives</label>
                </div>
                <div class="flex items-center mt-3">
                    <input checked id="" type="checkbox" value=""
                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 ">
                    <label for="" class="text-sm font-medium text-white ms-2 ">Afficher le nom des
                        missions</label>
                </div>
                <h2 class="mt-8 text-3xl text-white">Paramètres de l'alliance</h2>
                <div class="flex items-center mt-3">
                    <input checked id="" type="checkbox" value=""
                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 ">
                    <label for="" class="text-sm font-medium text-white ms-2 ">Afficher les bases des membres
                        de l'alliance</label>
                </div>
                <div class="flex items-center mt-3">
                    <input checked id="" type="checkbox" value=""
                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 ">
                    <label for="" class="text-sm font-medium text-white ms-2 ">Afficher les véhicules
                        de l'alliance se déplaçant sur la carte</label>
                </div>
                <h2 class="mt-8 text-3xl text-white">Paramètres de notifications</h2>
                <div class="flex items-center mt-3">
                    <input checked id="" type="checkbox" value=""
                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 ">
                    <label for="" class="text-sm font-medium text-white ms-2 ">Activer la notification
                        concernant les échanges d'unité</label>
                </div>
            </div>
            <div class="p-4">
                <button id="save-setting" class="flex items-center gap-2 p-2 text-sm text-left transition-all bg-green-600 cursor-pointer rounded-xl sm:p-4 show-modal fill-green-500 hover:bg-green-500 w-fit hover:fill-white text-white/70 hover:text-white">Enregistrer</button>
            </div>
        </div>
    </div>
</div>
