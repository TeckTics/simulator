<form style="font-family: cursive;" class="modal-content shadow-xl bg-white max-w-xl border-white border-2" method="POST"
    action="{{ route('init.demande') }}">
    @csrf

    <div class="modal-header">
        <h5 class="modal-title text-center text-blue-500 font-bold " id="exampleModalLabel">
            Echange d'unité</h5>
        <button name="modal-view-exchange-{{ $id }}" class="close close-modal-button text-black" type="button"
            data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div>
    <div class="modal-body">
        <span class="text-blue-500"> {{ $pseudo }}</span>
        <div class="grid grid-cols-3 py-5 items-center">
            <div class="flex shadow-inner p-2 bg-purple-100 rounded-xl flex-row gap-4 justify-start flex-wrap">
                @if($unite != null)
                <div class="flex flex-col justify-center items-start">
                    <button type="button" name="{{ $unite->id }}"
                        class="border-white check-spc border-4 rounded-xl cursor-pointer p-2  bg-stone-200 bg-gradient-to-tr"=>
                        <img src="{{ asset($unite->image) }}" width="150" height="150" alt="">
                    </button>
                    <div class="w-full mt-1 h-4 rounded-xl overflow-hidden bg-gray-50">
                        <div style="width: {{ $unite->sante }}%" class="h-full text-xs bg-green-500  px-2 text-white">
                            Santé
                            {{ $unite->sante }}%
                        </div>
                    </div>
                    {{ $unite->nom }}
                </div>
                @endif
            </div>
            <img src="{{ asset('/assets/icons/echange.svg') }}" class="mx-auto" width="50" height="50"
                alt="">
            <div class="flex shadow-inner p-2 bg-orange-100 rounded-xl flex-row gap-4   justify-start flex-wrap">

                @if($myUnite != null)
                <div class="flex flex-col justify-center items-center">
                    <button type="button" name="{{ $myUnite->id }}"
                        class="border-white check-spc-2 border-4 rounded-xl cursor-pointer p-2  bg-stone-200 bg-gradient-to-tr">
                        <img src="{{ asset($myUnite->image) }}" width="150" height="150" alt="">
                    </button>
                    <div class="w-full mt-1 h-4 rounded-xl overflow-hidden bg-gray-50">
                        <div style="width: {{ $myUnite->sante }}%"
                            class="h-full text-xs bg-green-500  px-2 text-white">
                            Santé
                            {{ $myUnite->sante }}%
                        </div>
                    </div>
                    {{ $myUnite->nom }}
                </div>
                @endif

            </div>
        </div>
    </div>
    {{-- <div class="modal-footer px-32">
        <button
            class="btn bg-blue-600 flex justify-center my-2 items-center hover:bg-blue-500 mx-auto from-blue-300 bg-gradient-to-tr  text-white font-bold py-2 "
            type="submit">Modifier</button>
    </div> --}}
</form>
