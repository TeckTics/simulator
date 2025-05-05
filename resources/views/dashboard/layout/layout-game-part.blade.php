<div class="grid items-start w-full grid-cols-3 col-span-3 gap-1 hiddenElementBase" id="container-map">
    <audio id="audio"  src="{{ asset('assets/son/p_33009051_98.mp3') }}" hidden ></audio>
    <x-base-form :isEditedForm="false" />
    <div id="map"
        class="relative z-10 w-full col-span-3 overflow-hidden border-4 rounded-xl"
        style="height: 549px"></div>
</div>
