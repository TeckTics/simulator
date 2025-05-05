@if ($activePage != 'game')
    <div class="flex gap-2 py-2 text-sm px-2 ">
        <a href="{{ url('/dashboard/jeu') }}">
            <button
                class="p-2 px-4 flex items-center gap-4 text-white transition-all rounded-sm w-fit hover:shadow-xl hover:shadow-black/50 from-blue-800 bg-gradient-to-t hover:bg-gradient-to-b hover:bg-cyan-800 via-blue-800 to-blue-900">
                <img src="{{ asset('/assets/images/play.svg') }}" alt="icon">
                Lancer la partie
            </button>
        </a>
    </div>
@endif