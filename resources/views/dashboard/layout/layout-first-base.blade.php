<div class="h-fit sm:grid md:grid-cols-3 sm:grid-cols-2">
    <div class="relative w-full col-span-1 pb-8 bg-[#14264b] rounded-s-xl">
        <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t border-gray-600">
            <h3 class="text-xl font-medium  text-white">
                Créer votre première base
            </h3>
        </div>
        <form name="base-form-create" class="modal-content base-form rounded-lg px-4 py-2 overflow-y-auto h-fit"
            id="base-form-first-create">
            <div>
                <div id="first-base-form-message-error" class="ml-1 text-red-500 text-[14px]">

                </div>
                <div class="mb-1">
                    <label for="nom_base" class="block mb-2 text-sm font-medium text-white ">Nommer
                        la base</label>
                    <input type="text" id="nom_base" name="nom_base" required
                        class="w-full p-3 text-sm  focus-visible:outline-blue-500 focus-visible:outline-1 focus-visible:placeholder:text-blue-500 rounded-xl">

                </div>
                <div class="mb-1">
                    <label for="type_base_id" class="block mb-2 text-sm font-medium text-white ">Type
                        de base</label>
                    <select id="type_base_id" name="type_base_id" required
                        class="w-full p-3 text-sm  focus-visible:outline-blue-500 focus-visible:outline-1 focus-visible:placeholder:text-blue-500 rounded-xl">
                        <option>Selectionner le type de votre base</option>
                        @foreach ($typeDeBase as $item)
                            <option value="{{ $item->id }}">{{ $item->label }}</option>
                        @endforeach
                    </select>

                </div>
                <div class="mb-1">
                    <label for="description_base" class="block mb-2 text-sm font-medium text-white ">
                        Description de la
                        base</label>
                    <textarea type="text" id="description_base" name="description_base"
                        class="w-full p-3 text-sm  focus-visible:outline-blue-500 focus-visible:outline-1 focus-visible:placeholder:text-blue-500 rounded-xl"></textarea>
                </div>
                <div class="mb-1">
                    <label for="ville_id" class="block mb-2 text-sm font-medium text-white ">Selectionner la
                        position</label>
                    <select id="ville_id" name="ville_id" required
                        class="w-full p-3 text-sm  focus-visible:outline-blue-500 focus-visible:outline-1 focus-visible:placeholder:text-blue-500 rounded-xl">
                        <option>Selectionner la ville</option>
                        @foreach ($villes as $item)
                            <option value="{{ $item->id }}">{{ $item->place }}</option>
                        @endforeach
                    </select>
                    @error('ville_id')
                        <p class="ml-1 text-red-500 text-[14px]">email invalide ou déjà enregistrée</p>
                    @enderror
                    <div class="mt-1">

                        <div class="flex gap-4">
                            <input type="text" inputmode="decimal" id="position_x_base" placeholder="longitude"
                                name="position_x" required pattern="/^([-+,0-9.]+)(.*)/g"
                                class="w-full p-3 text-sm  focus-visible:outline-blue-500 focus-visible:outline-1 focus-visible:placeholder:text-blue-500 rounded-xl">
                            <input type="text" inputmode="decimal" id="position_y_base" placeholder="latitude"
                                name="position_y" required pattern="/^([-+,0-9.]+)(.*)/g"
                                class="w-full p-3 text-sm  focus-visible:outline-blue-500 focus-visible:outline-1 focus-visible:placeholder:text-blue-500 rounded-xl">
                        </div>
                    </div>
                </div>
                <div class=" mt-1 mx-auto">
                    <label class="block mb-2 text-sm font-medium text-white " for="image">Choissisez une image pour
                        votre
                        base</label>
                    <input
                        class="block w-full text-sm text-[#1a2539] border border-gray-300 rounded-lg cursor-pointer bg-gray-50  focus:outline-none  "
                        aria-describedby="image_help" id="imageBase" type="file" name="image">
                </div>
            </div>
            <div class="mt-4">
                <button
                    class=" gap-2 rounded-xl justify-center p-4 fill-white text-center bg-[#151b28] hover:bg-[#15244c] hover:ring-4 hover:ring-white/20 w-full hover:fill-blue-500 flex items-center h-full text-white/70 hover:text-white text-sm transition-all cursor-pointer"
                    type="submit">Enregistrer</button>
            </div>
        </form>
    </div>
    <div id="map" class="w-full  shadow relative z-40 col-span-2 overflow-hidden  rounded-e-xl"></div>
</div>
<div id="loader" class="fixed top-0 left-0 z-50 items-center justify-center hidden w-full h-full bg-black/50">
    <div class="flex items-center justify-center max-w-xl min-h-screen mx-auto">
        <svg fill="#ffffff" class="animate-spin" width="64px" height="64px" viewBox="0 0 24 24"
            xmlns="http://www.w3.org/2000/svg" stroke="#ffffff">
            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
            <g id="SVGRepo_iconCarrier">
                <circle cx="12" cy="20" r="2"></circle>
                <circle cx="12" cy="4" r="2"></circle>
                <circle cx="6.343" cy="17.657" r="2"></circle>
                <circle cx="17.657" cy="6.343" r="2"></circle>
                <circle cx="4" cy="12" r="2.001"></circle>
                <circle cx="20" cy="12" r="2"></circle>
                <circle cx="6.343" cy="6.344" r="2"></circle>
                <circle cx="17.657" cy="17.658" r="2"></circle>
            </g>
        </svg>
    </div>
</div>
<script>
     $('#loader').hide()
    $(document).ready(async function() {
        var osm = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        });
        map = L.map('map').setView([{{ $user->lat }}, {{ $user->lgt }}], 15);
        osm.addTo(map);

    })
    async function addBase(formData) {
            $('#loader').show()
            $.ajax({
            url: "/dashboard/api/create-user-base",
            type: 'POST',
            data: formData,
            headers: {
                'X-CSRF-TOKEN': token,
            },
            processData: false,
            cache: false,
            contentType: false,
            enctype: 'multipart/form-data',
            success: function(response) {
                $('#reset-base-form').click()
                $('#loader').hide()
                moneyLeaveAnimation(150000, false)
                showToast(response.status, response.message);
                initDashboard()
                loadBase()
                $('#map').addClass("col-span-3")
                $('#map').removeClass("col-span-2")
                $('#base-form-create-layout').addClass('hidden')
                $('#base-form-create-layout').removeClass('flex')
                marker.remove();
            },
            error: function(jqXHR, textStatus, errorThrown) {
                $('#loader').hide()
                console.error('Error posting data:', jqXHR, textStatus,
                    errorThrown);
                showToast("danger",
                    "Une erreur c'est produite lors de l'execution de votre demande!")
            }
        });     
    }

    $('.base-form').on('submit', async (e) => {
        e.preventDefault()
      
        const form = $(e.target)
        const formData = new FormData(form[0])
        formData.append("prix", 150000)
        // const formValues = Object.fromEntries(formData.entries())
        if (e.target.name == "base-form-create") {
            addBase(formData);
        } else {
            // addBase(formValues);
        }
    })
</script>
