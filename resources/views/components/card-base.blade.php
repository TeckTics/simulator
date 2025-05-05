<div>
    <form class="modal-content rounded-xl min-w-xl post-unite-base" id="post-unite-base" method="POST" >
        <div class="modal-header">
            <h5 class="modal-title"></h5>
            <button name="add-base" id="remove-base-map" class="close-modal-button remove-base-map" type="button">
                <span class="">×</span>
            </button>
        </div>
        <div class="modal-body">
            {{-- @dump($uniteBase) --}}
            <h3 class="text-center text-xl my-3 text-gray-800">Unités disponibles</h3>
            <div class="flex flex-row flew-wrap gap-2 ">
                @foreach ($uniteUser as $unite)
                        <button type="button" name="{{ $unite->id }}"
                            class="border-white check-spc border-4 bg-blue-500 text-white rounded-xl cursor-pointer p-2 ">
                            <h6 class="text-center" >{{ $unite->nom }}</h6>
                        </button>  
                @endforeach
                <input type="text" name="unite_id_card_base" hidden id="banner_clan">
                <input type="text" name="base_id_card_base" value="{{ $baseId }}" hidden id="base_id">
            </div>
            <h3 class="text-center text-xl my-3 text-gray-800">Unités se trouvant dans cette base</h3>
            <div class="grid grid-cols-4 gap-4 ">
                @foreach ($uniteBase as $unite)
                    <div class="flex flex-col  items-start">
                        <button type="button" name="{{ $unite->id }}"
                            class="border-white border-4 rounded-xl cursor-pointer p-2  bg-green-500 "=>
                            <h6 class="text-white">{{ $unite->nom }}</h6>
                        </button>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn btn-primary btn-sm text-blue-500" type="submit">Envoyer</button>
        </div>
    </form>
</div>
