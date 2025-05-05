<div id="logout-modal" class="fixed inset-0 z-50 items-center justify-center w-full h-full bg-black/50 hidden p-4">
    <div class="rounded-lg shadow-lg w-96 p-6 bg-[#151b28] text-white/70 hover:text-white text-left relative">
        <div class="flex justify-between items-center border-b pb-3">
            <h3 class="text-lg font-semibold">Déconnexion</h3>
            <button id="cancel-logout" type="button"
                class="text-gray-400 bg-transparent rounded-lg text-sm hover:bg-gray-700 hover:text-white p-2">
                <img src="{{ asset('assets/images/icons8-close-48.png') }}" class="size-6" alt="Fermer">
            </button>
        </div>

        <div class="py-4 text-white">
            <p>Êtes-vous sûr de vouloir vous déconnecter ?</p>
            <p id="logout-message" class="text-red-400 text-danger font-semibold hidden">Vous avez une mission en cours, si vous vous déconnectez votre progression sera perdue!</p>
        </div>

        <div class="flex justify-end gap-3 mt-4">
            <button id="cancel-btn-logout" type="button"
                class="px-4 py-2 bg-gray-600 text-white rounded hover:bg-gray-700 transition">
                Annuler
            </button>

            <a href="{{ route('logoutUser') }}" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-800 transition">
                Se déconnecter
            </a>
        </div>
    </div>
</div>
