<div @if ($isEditedForm == true) id="base-form-edit-layout" @else id="base-form-create-layout" @endif
    @class([
        'fixed top-0 left-0 z-30 items-center justify-center w-full h-full overflow-x-hidden overflow-y-auto bg-black/20' => $isEditedForm,
        'hidden   max-sm:h-full max-sm:z-30 max-sm:items-end md:relative max-sm:fixed max-sm:bg-black/20 max-sm:bottom-0 max-sm:left-0 max-sm:justify-center  max-sm:overflow-x-hidden ',
    ])>
    <div @class([
        'relative w-full bg-[#14264b] h-[500px] rounded-2xl  max-w-md' => $isEditedForm,
        'relative w-full bg-[#14264b] rounded-xl  overflow-hidden col-span-3',
    ])>
        <div class="flex items-center justify-between p-3 border-b border-gray-600 rounded-t md:px-5 md:py-2">
            <h3 class="text-lg font-medium text-white">
                @if ($isEditedForm == true)
                    Editer votre
                @else
                    Nouvelle
                @endif base
            </h3>
            <button type="button"  @if ($isEditedForm == true) name="base-form-edit-layout" @else name="base-form-create-layout" @endif
                class="flex items-center justify-center shadow-md close-modal-button backdrop-filter top-2 right-2">
                <img src="{{ asset('assets/images/icons8-close-48.png') }}" class="size-8" alt="" srcset="">
                <span class="hidden">Close</span>
            </button>
        </div>
        <div>
            <div @class(['relative w-full bg-[#14264b] rounded-s-xl', 'h-[500px]'])>
                <form class="px-4 py-2 overflow-y-auto rounded-lg base-form modal-content h-fit"
                    @if ($isEditedForm == true) name="base-form-edit" @else name="base-form-create" @endif>
                    @if ($isEditedForm == true)
                        <div>
                            <div class="mb-1">
                                <label for="nom_base" class="block mb-2 text-sm font-medium text-white "> Nom de la base
                                </label>
                                <input type="text" id="prix" value="150000" name="prix" required
                                    class="w-full p-3 text-sm focus-visible:outline-blue-500 focus-visible:outline-1 rounded-xl">
                                <input type="text" id="prix" name="nom_base" required
                                    class="w-full p-3 text-sm focus-visible:outline-blue-500 focus-visible:outline-1 rounded-xl">
                            </div>
                            <div class="mb-1">
                                <label for="description_base" class="block mb-2 text-sm font-medium text-white ">
                                    Description de la
                                    base</label>
                                <textarea type="text" id="description_base" name="description_base"
                                    class="w-full p-3 text-sm focus-visible:outline-blue-500 focus-visible:outline-1 rounded-xl"></textarea>
                            </div>
                        </div>
                    @else
                        <div>
                            <div class="mb-1">
                                <label for="nom_base_create" class="block mb-2 text-sm font-medium text-white ">
                                    la base</label>
                                <input type="text" id="nom_base_create" name="nom_base" required
                                    class="w-full p-3 text-sm focus-visible:outline-blue-500 focus-visible:outline-1 rounded-xl">
                            </div>
                            <div class="mb-1">
                                <label for="type_base_id_create" class="block mb-2 text-sm font-medium text-white ">Type
                                    de base</label>
                                <select id="type_base_id_create" name="type_base_id" required
                                    class="w-full p-3 text-sm focus-visible:outline-blue-500 focus-visible:outline-1 rounded-xl">

                                    {{-- @foreach ($typeDeBase as $item) --}}
                                    {{-- <option value="{{ $item->id }}">{{ $item->label }}</option>
                                    @endforeach --}}
                                </select>

                            </div>
                            <div class="mb-1">
                                <label for="description_base_create" class="block mb-2 text-sm font-medium text-white ">
                                    Description de la
                                    base</label>
                                <textarea type="text" id="description_base_create" name="description_base"
                                    class="w-full p-3 text-sm focus-visible:outline-blue-500 focus-visible:outline-1 rounded-xl"></textarea>
                            </div>
                            <div class="mb-1">
                                <label for="base-form-create-select-city"
                                    class="block mb-2 text-sm font-medium text-white ">Selectionner la
                                    position</label>
                                <div class="mt-1">
                                    <div class="flex items-center gap-4">
                                        <label for="" class="text-sm font-medium text-white ">Latitude:</label>
                                        <input type="text" inputmode="decimal" id="position_x_base_create"
                                            placeholder="Latitude" name="position_x" required
                                            pattern="/^([-+,0-9.]+)(.*)/g"
                                            class="w-full p-2 text-sm focus-visible:outline-blue-500 bg-[#14264b] text-white font-normal border-none  focus-visible:outline-1  rounded-xl">
                                        <label for="" class="text-sm font-medium text-white ">Longitude:</label>
                                        <input type="text" inputmode="decimal" id="position_y_base_create"
                                            placeholder="Longitude" name="position_y" required
                                            pattern="/^([-+,0-9.]+)(.*)/g"
                                            class="w-full p-2 text-sm focus-visible:outline-blue-500 bg-[#14264b] text-white font-normal border-none focus-visible:outline-1  rounded-xl">
                                    </div>
                                </div>
                            </div>
                            <div class="mx-auto mt-1 ">
                                <label class="block mb-2 text-sm font-medium text-white " for="image">Choissisez une
                                    image pour votre
                                    base</label>
                                <input
                                    class="block w-full text-sm text-[#1a2539] border border-gray-300 rounded-lg cursor-pointer bg-gray-50  focus:outline-none  "
                                    aria-describedby="image_help" id="imageBase" type="file" name="image">
                            </div>
                        </div>
                    @endif

                    <div class="mt-4">
                        <button
                            class=" gap-2 rounded-xl justify-center p-4 fill-white text-center bg-[#151b28] hover:bg-[#15244c] hover:ring-4 hover:ring-white/20 w-full hover:fill-blue-500 flex items-center h-full text-white/70 hover:text-white  text-sm transition-all cursor-pointer"
                            type="submit">Enregistrer</button>
                        <button  id="reset-base-form"
                            class=" gap-2 rounded-xl hidden justify-center p-4 fill-white text-center bg-[#151b28] hover:bg-[#15244c] hover:ring-4 hover:ring-white/20 w-full hover:fill-blue-500  items-center h-full text-white/70 hover:text-white  text-sm transition-all cursor-pointer"
                            type="reset">Reset</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
