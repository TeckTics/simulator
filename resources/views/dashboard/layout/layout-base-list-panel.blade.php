<div id="base-list" hidden
    class=" overflow-y-auto expend-modal overflow-x-hidden bg-black/20 flex fixed  top-0 left-0 left-0 z-50 justify-center items-center    w-full  h-full">
    <div
        class="bg-white modal-content max-w-2xl  shadow-xl col-span-1 border-white rounded-xl border-inset border-2 flex flex-col gap-4 w-full">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Mes bases</h5>
            <button name="base-list" class="close-modal-button " type="button">
                <span class="">×</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="flex flex-row items-start gap-4">
                @foreach ($baseUser as $item)
                    <button name="{{ $item->id }}-card-base"
                        class=" shadow-md show-modal cursor-pointer border-4 rounded-xl w-fit flex flex-col justify-between items-center px-4 py-2 from-blue-700 hover:bg-blue-600 bg-blue-500 bg-gradient-to-t  ">
                        <img src="{{ asset($item->icon_base) }}" width="50" height="50"
                            alt="{{ $item->icon_base }}" class=" ">
                        <span style="font-family: cursive;" class="text-white">{{ $item->nom_base }}</span>
                    </button>
                    <div hidden id="{{ $item->id }}-card-base"
                        class=" fixed overflow-x-auto expend-modal bg-black/20 flex  top-0 left-0 left-0 z-50 justify-center items-center   w-full  h-full">
                        <x-card-base :base-id="$item->id"></x-card-base>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

</div>
