<div id="profil-panel" class="fixed top-0 left-0 z-30 items-end sm:items-center justify-center hidden w-full h-full overflow-x-hidden overflow-y-auto bg-black/20">
    <div class="panel-size">
        <div class="flex items-center justify-between p-4 border-b border-gray-600 rounded-t md:p-5">
            <h3 class="text-xl font-medium text-white">
                Paramètres
            </h3>
            <button type="button"  name="profil-panel"
                class="flex items-center justify-center shadow-md close-modal-button backdrop-filter top-2 right-2">
                <img src="{{ asset('assets/images/icons8-close-48.png') }}" class="size-8" alt=""
                    srcset="">
                <span class="hidden">Close</span>
            </button>
        </div>
        <div class="grid grid-cols-2 p-4">
            <div class="flex flex-col gap-2 justify-evenly">
                <div class="w-24 flex justify-center items-center h-24 overflow-hidden p-2 rounded-full bg-[#14213e]">
                    <img class="w-20 h-20 rounded-full "
                        src="{{ asset($user->profile ?? '/assets/images/user-profile.png') }}" alt="Default avatar">
                </div>
                <h3 class="text-white">{{ $user->pseudo }}</h3>
                <h3 class="text-sm font-thin text-white/70" style="font-weight: 100">
                    {{ $user->email }}</h3>
            </div>
            <form class="max-w-md p-4 rounded-2xl bg-[#1a2539]">
                <div id="message-error" class="text-red-500 text-[14px]"></div>
                <div class="grid grid-cols-1 gap-4 ">
                    <div class="block mt-1">
                        <label for="pseudo" class="text-[14px] text-white">Pseudo</label>
                        <div>
                            <input type="text" value="{{ $user->pseudo }}"
                                class="w-full p-2 text-[14px] font-thin  text-white bg-[#1a2539] border-b border-0     focus-visible:border-blue-500 "
                                placeholder="Entrer un pseudo, exp: Alec42" name="pseudo" id="pseudo">
                        </div>
                    </div>
                    <div class="block">
                        <label for="email" class="text-[14px] text-white">Email</label>
                        <div class="mt-1">
                            <input type="email" value="{{ $user->email }}"
                                class="w-full p-2  text-[14px] font-thin text-white bg-[#1a2539] border-b border-0    focus-visible:border-blue-500 "
                                placeholder="Entrer votre email" name="email" id="email">
                        </div>
                    </div>
                    <div class="hidden ">
                        <label for="password" class="text-[14px] text-white">Mot de passe</label>

                        <div class="relative mt-1">
                            <input type="password" value=""
                                class="w-full p-2 text-[14px]  focus-visible:outline-none focus-visible:ring-4 focus-visible:ring-blue-500/50 focus-visible:outline-1 focus-visible:placeholder:text-blue-500 rounded-md "
                                placeholder="Entrer votre mot de passe" name="password" id="password">
                        </div>
                    </div>
                </div>
                <button id="btnForm"
                    class="flex items-center justify-center w-full px-4 py-2 my-2 font-bold text-white border-2 border-white rounded-md btn hover:bg-blue-500 "
                    type="submit">Modifier
                </button>

            </form>
        </div>
    </div>
</div>
