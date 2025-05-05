<div id="options" hidden
    class="fixed top-0 left-0 z-50 flex items-center justify-center w-full h-full overflow-x-hidden overflow-y-auto  expend-modal bg-black/20">
    <div
        class="bg-white  shadow-xl modal-content border-[#1a2539] col-span-1 rounded-xl border-inset border-2 flex flex-col gap-4 w-fit">
        <div class="modal-header">
            <h5 class="modal-title font-bold text-[#1a2539]" id="exampleModalLabel">Paramètres de son</h5>
            <button name="options" class="close-modal-button " type="button">
                <span class="">×</span>
            </button>
        </div>
        <div class="flex flex-col gap-4 modal-body">
            <label class="inline-flex items-center justify-between cursor-pointer">
                <div>
                    <input type="checkbox" id="mutedInput" class="sr-only peer">
                    <div
                        class="relative w-9 h-5 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300  rounded-full peer  peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all  peer-checked:bg-blue-600">
                    </div>
                    <audio id="audio" muted hidden src="{{ asset('assets/son/warning.mp3') }}"></audio>
                </div>
                <span class="ms-3 text-sm font-medium text-[#1a2539] ">Desactiver le son</span>
            </label>
            <div class="inline-flex items-center justify-between gap-2">
                <input id="volumeInput" type="range" class="w-16" min="0" max="100" value="50">
                <label class="ms-3 text-sm  font-medium text-[#1a2539] " for="">Volume des
                    effects de son</label>
            </div>
        </div>
    </div>
</div>

