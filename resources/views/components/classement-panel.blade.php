<div id="ranking-panel"
    class="fixed top-0 left-0 z-30 items-end sm:items-center justify-center hidden w-full h-full overflow-x-hidden overflow-y-auto bg-black/20">
    <div class="panel-size">
        <div class="flex items-center justify-between p-4 border-b border-gray-600 rounded-t md:p-5">
            <h3 class="text-xl font-medium text-white">
                Classements
            </h3>
            <button type="button"  name="ranking-panel"
                class="flex items-center justify-center shadow-md close-modal-button backdrop-filter top-2 right-2">
                <img src="{{ asset('assets/images/icons8-close-48.png') }}" class="size-8" alt=""
                    srcset="">
                <span class="hidden">Close</span>
            </button>
        </div>
        <div class="p-4">
         
            <div class="py-4 mt-4">
                <button class="text-sm px-3 py-2 bg-[#1a2539] hover:bg-[#151b28] text-white"> Classement par
                    interventions</button>
                {{-- <button class="text-sm px-3 py-2 bg-[#1a2539] hover:bg-[#151b28] text-white"> Classement par
                    Popularité</button> --}}
                <button class="text-sm px-3 py-2 bg-[#1a2539] hover:bg-[#151b28] text-white"> Classement par
                    Expérience</button>
                <form class="mt-2">
                   
                    <select name="" class="text-[#151b28] text-sm" id="">
                        <option value="">Général</option>
                        <option value="">Cette année</option>
                        <option value="">Ce mois</option>
                        <option value="">Hier</option>
                    </select>
                    <button type="submit"
                        class="text-sm px-3 py-2 bg-[#1a2539] hover:bg-[#151b28] text-white">Filtrer</button>
                </form>
            </div>
            <div class="mt-4 overflow-y-auto h-[500px] ">
                <div class="relative overflow-x-auto">
                    <div class="relative overflow-x-auto">
                        <div class="w-full text-left text-gray-600 group rtl:text-right ">
                            <div class="text-xs text-white bg-[#151b28] uppercase  ">
                                <div class="grid items-center w-full grid-cols-8">
                                    <div class="col-span-1 py-3 font-medium text-center border">
                                        Place
                                      
                                    </div>
                                    <div  class="col-span-1 py-3 font-medium text-center border">
                                        Joueur
                                    </div>
                                    <div  class="col-span-2 py-3 font-medium text-center border">
                                        Nombre de missions
                                    </div>
                                    <div  class="col-span-1 py-3 font-medium text-center border">
                                        % de réussite
                                    </div>
                                    <div  class="col-span-2 py-3 font-medium text-center border">
                                        Véhicules envoyés
                                    </div>
                                 
                                    <div  class="col-span-1 py-3 font-medium text-center border">
                                        Expérience
                                       
                                    </div>
                                </div>
                            </div>
                            <div>
                                @foreach ($users as $key => $user)
                                    <div class=" border-y grid w-full  items-center grid-cols-8 text-white even:bg-[#151b28] odd:bg-[#1a2539] bg-gray-50 ">
                                        <div class="col-span-1 text-xl font-medium text-center text-white">
                                            {{ $key + 1 }}
                                        </div>
                                        <div class="col-span-1 py-2 text-center">
                                            {{ $user->pseudo }}
                                        </div>
                                        <div class="col-span-2 py-2 text-center ">
                                            {{ $user->count_mission }}
                                        </div>
                                        <div class="col-span-1 py-2 text-center">
                                            0
                                        </div>
                                        <div class="col-span-2 py-2 text-center">
                                            0%
                                        </div>
                                        <div class="flex items-center justify-end col-span-1 gap-3 py-2 pr-4 text-center text-green-500">
                                            <span>{{ $user->experience }}</span> <span>xp</span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
