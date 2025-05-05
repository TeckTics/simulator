<div class="flex items-center relative   rounded-md text-sm backdrop-sm justify-between bg-white px-4 py-2">
    <div class="flex items-center gap-4">
        <img width="30" class="size-12 rounded-full" height="30" alt="Logo"
            src="{{ asset('assets/images/logo-2.jpg') }}" />
        <h1 class="text-2xl font-bold text-[#151b28]"> UrgenceSAMU </h1>
    </div>
    <div class="flex gap-4">
        <div title="Ma performance"
            class="flex items-center bg-[#151b28] border justify-between space-x-1 shadow-black/30 px-2 rounded-md">
            <img width="24" height="24" src="{{ asset('assets/images/icons8-performance-48.png') }}"
                alt="" srcset="">
            <span class="text-lg font-bold text-white">{{ Auth::guard('appuser')->user()->experience }} xp</span>
        </div>
        <div title="mon argent"
            class="flex items-center border bg-[#151b28]  justify-between space-x-1 shadow-black/30  px-2 rounded-md">
            <img width="24" height="24" class="opacity-50" src="{{ asset('assets/images/icons8-money-48.png') }}"
                alt="" srcset=""> <span
                class="text-lg font-bold text-white">{{ Auth::guard('appuser')->user()->argent }} €</span>
        </div>
        <button id="dropdownHoverButton" data-dropdown-toggle="dropdownHover" data-dropdown-trigger="hover"
            class=" bg-inherit  hover:bg-black/10 focus:ring-4 focus:outline-none text-[#151b28] font-medium rounded-lg text-sm  p-2 text-center inline-flex items-end"
            type="button">
            <div class="flex items-center justify-start text-left gap-2">
                <img class="w-8 h-8 rounded"
                    src="{{ Auth::guard('appuser')->user()->profile ?? '/assets/images/user-profile.png' }}"
                    alt="Default avatar">
                <div class="text-[#151b28]">
                    <h2 class="font-semibold uppercase">{{ Auth::guard('appuser')->user()->pseudo }}</h2>
                    {{-- <h3 class="text-sm ">{{ Auth::guard('appuser')->user()->email }}</h3> --}}
                </div>
            </div>
        </button>
        <div id="dropdownHover" class="z-10 hidden z-50 bg-white divide-y divide-gray-100 rounded-lg shadow w-44 ">
            <ul class="py-2 text-sm text-gray-700 " aria-labelledby="dropdownHoverButton">
                <li>
                    <a href="#" class="block px-4 py-2 hover:bg-gray-100 ">Options</a>
                </li>
                <li>
                    <a href="{{ route('logoutUser') }}" class="block px-4 py-2  hover:bg-gray-100 ">Déconnexion</a>
                </li>
            </ul>
        </div>
    </div>
</div>
<div class="py-2 container mx-auto flex items-center justify-evenly text-sm bg-cyan-500 text-white">
    <h3 id="date-now"></h3> | <div>0 Intervention(s) au total</div> |  <div>0 Intervention(s) en cours</div> |  <div>0 Unité(s) en interventions</div> | <div>Temps de réponse moyen</div>
</div>
<script>
        const d = new Date();
        const dateNowDiv = document.getElementById('date-now');
        if (dateNowDiv) {
            dateNowDiv.innerHTML = d.toDateString();
        }

</script>
