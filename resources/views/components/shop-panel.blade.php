<style>
    .wrapper {
        width: 100%;
        position: relative;
        background-color: #20242e;
        border-radius: 20px;
    }

    .wrapper i {
        height: 50px;
        width: 50px;
        background: rgb(118, 233, 118);
        text-align: center;
        line-height: 50px;
        border-radius: 50%;
        cursor: pointer;
        position: absolute;
        top: 50%;
        font-size: 1.25 rem;
        transform: translateY(-50%);
        box-shadow: 0 3px 6px rgba(0, 0, 0, 0.23);

    }

    .wrapper i:first-child {
        left: -22px;

    }

    .wrapper i:last-child {
        right: -22px;

    }

    .wrapper .carousel {
        display: grid;
        grid-auto-flow: column;
        grid-auto-columns: calc((75% / 3));
        gap: 5px;
        overflow-x: auto;
        scroll-snap-type: x mandatory;
        scroll-behavior: smooth;
        scrollbar-width: 0;
    }

    .carousel::-webkit-scrollbar {
        display: none;
    }

    .carousel :where(.card) {
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .carousel.dragging {
        scroll-snap-type: none;
        scroll-behavior: auto;
    }

    .carousel.no-transition {
        scroll-behavior: auto;
    }

    .carousel.dragging .card {
        cursor: grab;
        user-select: none;
    }

    .carousel .card {
        scroll-snap-align: start;
        list-style: none;
        cursor: pointer;
    }


    @media screen and (max-width: 900px) {
        .wrapper .carousel {
            grid-auto-columns: calc((65% / 2) - 9px);

        }
    }

    @media screen and (max-width: 600px) {
        .wrapper .carousel {
            grid-auto-columns: 100%;

        }
    }
</style>
<div id="shop-panel"
class="fixed top-0 left-0 z-40 items-end sm:items-center justify-center hidden w-full h-full overflow-x-hidden overflow-y-auto bg-black/20">
    <div class="panel-size">
        <div class="relative ">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 border-b border-gray-600 rounded-t md:p-5">
                <h3 class="text-xl font-medium text-white">
                   Boutique
                </h3>
                <button type="button"  name="shop-panel"
                    class="flex items-center justify-center shadow-md close-modal-button backdrop-filter top-2 right-2">
                    <img src="{{ asset('assets/images/icons8-close-48.png') }}" class="size-8" alt=""
                        srcset="">
                    <span class="hidden">Close</span>
                </button>
            </div>
            
                <div class="h-[50vh] px-4 mx-auto overflow-y-auto">
                    <h4 class="px-4 py-3 mt-2 text-xl font-bold text-center uppercase text-white/80">Les véhicules</h4>
                    <div class="relative px-8 py-4 wrapper">
                        <ul class="relative carousel" id="unite-carousel">
                            @foreach ($unites as $unite)
                                <li
                                    class=" card w-[229px] shadow-xl flex flex-col justify-between relative bg-[#151b28]  overflow-hidden rounded-xl hover:shadow-xl ">
                                    <div style="height: 175px; width: 229px" class="overflow-hidden">
                                        <img class="w-full h-full objet-cover " src="{{ asset($unite->image) }}"
                                            alt="product image" />
                                    </div>
                                    <div class="p-2 ">
                                        <h5 class="w-full text-lg text-left text-white ">
                                            {{ $unite->nom_unite }}</h5>
                                        {{-- <p class="text-sm font-thin text-left text-white/70">Lorem ipsum dolor sit amet
                                            consectetur adipisicing elit. Earum veritatis nisissimos ipsam!</p> --}}
                                        <div class="mt-2">
                                            <button name="form-purchase-unite-{{ $unite->id }}"
                                                class=" gap-2 rounded-xl p-3 mt-1 fill-white show-modal bg-[#15244c] hover:bg-[#15244c] w-fit hover:fill-blue-500 flex items-center h-full text-white/70 hover:text-white   text-left text-sm transition-all cursor-pointer">
                                                <span>Acheter</span>
                                                <div class="flex items-center "> <span
                                                        class="font-bold text-yellow-500">{{ $unite->prix_unite }}</span>
                                                    <img width="24" height="24"
                                                        src="{{ asset('assets/images/icons8-money-48.png') }}"
                                                        alt="" />
                                                </div>
                                            </button>
                                        </div>
                                    </div>
                                    <form name="unite" method="POST" id="form-purchase-unite-{{ $unite->id }}"
                                        class="fixed top-0 left-0 z-50 items-center justify-center hidden w-full h-full py-8 purchase-item expend-modal bg-black/30 ">   
                                        <div class="relative">
                                            <input type="number" hidden name="unite_id" value="{{ $unite->id }}">
                                            <input type="number" hidden name="vitesse"
                                                value="{{ $unite->vitesse_unite }}">
                                            <input type="text" hidden name="nom"
                                                value="{{ $unite->nom_unite }}">
                                            <input type="number" hidden name="places_disponible"
                                                value="{{ $unite->capacite_unite }}">
                                            <input type="number" hidden name="taux_usure"
                                                value="{{ $unite->taux_usure }}">
                                            <input type="number" hidden name="prix"
                                                value="{{ $unite->prix_unite }}">
                                            <div class="py-2 bg-[#14264b]  rounded-lg min-w-96"
                                                style="max-width: 500px;">
                                                <h5
                                                    class="text-xl font-semibold tracking-tight text-center text-white ">
                                                    {{ $unite->nom_unite }}</h5>
                                                <div class="flex items-center justify-center gap-1 my-3">
                                                    <span
                                                        class="text-5xl font-bold text-white ">{{ $unite->prix_unite }}</span>
                                                    <img width="32" height="32"
                                                        src="{{ url('assets/images/icons8-money-48.png') }}"
                                                        alt="" srcset="">
                                                </div>
                                                <div class="flex justify-center mt-1">
                                                    <button type="submit"
                                                    class="p-2 px-4 m-auto text-sm font-bold text-blue-500 bg-white rounded-lg hover:shadow-xl w-fit hover:text-blue-600">Valider
                                                        l'achat</button>
                                                </div>
                                                <button type="button" name="form-purchase-unite-{{ $unite->id }}"
                                                    class="absolute flex items-center justify-center p-1 bg-white rounded-full shadow-md close-action-modal backdrop-filter size-8 -top-2 -right-2">
                                                    <img src="{{ asset('assets/images/icons8-close-48.png') }}"
                                                        class="size-4" alt="" srcset="">
                                                    <span class="hidden">Close</span>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </li>
                            @endforeach
                        </ul>
                        <button type="button" name="unite-carousel" id="right"
                            class="absolute left-0 z-30 flex items-center justify-center w-20 h-20 px-4 -translate-y-1/2 cursor-pointer top-1/2 button-scrolling end-0 group focus:outline-none"
                            data-carousel-next>
                            <span
                                class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-blue-300/30 group-hover:bg-blue-300/50 group-focus:ring-4 group-focus:ring-blue-300 group-focus:outline-none">
                                <img width="20" alt="arrow left" height="20"
                                    src="{{ asset('assets/icons/icons8-arrow-left-64.png') }}" />
                                <span class="sr-only">Previous</span>
                            </span>
                        </button>
                        <button type="button" name="unite-carousel" id="left"
                            class="absolute right-0 z-30 flex items-center justify-center w-20 h-20 px-4 -translate-y-1/2 cursor-pointer top-1/2 button-scrolling end-0 group focus:outline-none"
                            data-carousel-next>
                            <span
                                class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-blue-300/30 group-hover:bg-blue-300/50 group-focus:ring-4 group-focus:ring-blue-300 group-focus:outline-none">
                                <img width="20" alt="arrow right" height="20"
                                    src="{{ asset('assets/icons/icons8-arrow-right-64.png') }}" />
                                <span class="sr-only">Next</span>
                            </span>
                        </button>
                    </div>
                    <h4 class="px-4 py-3 mt-2 text-xl font-bold text-center uppercase text-white/80">Les Personnels
                    </h4>
                    <div class="relative px-8 py-4 wrapper">
                        <ul class="relative carousel" id="personnels-carousel" >
                            @foreach ($personnels as $personnel)
                                <li
                                    class=" card w-[229px] flex flex-col justify-between relative bg-[#151b28]  overflow-hidden rounded-xl hover:shadow-xl ">
                                    <div style="height: 175px; width: 229px" class="overflow-hidden">
                                        <img class="w-full h-full objet-cover " src="{{ asset($personnel->image) }}"
                                            alt="product image" />
                                    </div>
                                    <div class="p-2 ">
                                        <h5 class="w-full text-lg text-left text-white ">
                                            {{ $personnel->titre_personnel }}</h5>
                                        <p class="text-sm font-thin text-left text-white/70">
                                            {{ $personnel->description_personnel }}</p>
                                        <div class="mt-2">
                                            <button name="form-purchase-personnel-{{ $personnel->id }}"
                                                class=" gap-2 rounded-xl p-3 mt-1 fill-white show-modal bg-[#15244c] hover:bg-[#15244c] w-fit hover:fill-blue-500 flex items-center h-full text-white/70 hover:text-white   text-left text-sm transition-all cursor-pointer">
                                                <span>Acheter</span>
                                                <div class="flex items-center "> <span
                                                        class="font-bold text-yellow-500">{{ $personnel->prix_personnel }}</span>
                                                    <img width="24" height="24"
                                                        src="{{ asset('assets/images/icons8-money-48.png') }}"
                                                        alt="" />
                                                </div>
                                            </button>
                                        </div>
                                    </div>
                                    <form name="personnel" method="POST"
                                    id="form-purchase-personnel-{{ $personnel->id }}"
                                    class="fixed top-0 left-0 z-50 items-center justify-center hidden w-full h-full py-8 purchase-item expend-modal bg-black/30">
                                    @csrf
                                    <div class="relative">
                                        <input type="number" hidden name="personnel_id" value="{{ $personnel->id }}">
                                        <input type="number" hidden name="prix" value="{{ $personnel->prix_personnel }}">
                                        <input type="number" hidden name="base_id" value="{{ $personnel->base_id ?? 1 }}">
                                
                                        <div class="py-2 bg-[#14264b] rounded-lg min-w-96" style="max-width: 500px;">
                                            <h5 class="text-xl font-semibold tracking-tight text-center text-white">
                                                {{ $personnel->titre_personnel }}
                                            </h5>
                                
                                            <div class="flex items-center justify-center gap-1 my-3">
                                                <span class="text-5xl font-bold text-white">{{ $personnel->prix_personnel }}</span>
                                                <img width="32" height="32" src="{{ url('assets/images/icons8-money-48.png') }}" alt="">
                                            </div>
                                
                                            <div class="flex flex-col items-center justify-center mt-2 mb-2">
                                                <label for="prenom_personnel" class="text-white font-semibold mb-1">Prénom du personnel</label>
                                                <input
                                                    type="text"
                                                    name="prenom_personnel"
                                                    id="prenom_personnel"
                                                    class="w-4/5 p-2 rounded-md focus:outline-none"
                                                    placeholder="Entrez le prénom du personnel"
                                                    required
                                                >
                                                <label for="nom_personnel" class="text-white font-semibold mb-1 mt-4">Nom du personnel</label>
                                                <input
                                                    type="text"
                                                    name="nom_personnel"
                                                    id="nom_personnel"
                                                    class="w-4/5 p-2 rounded-md focus:outline-none"
                                                    placeholder="Entrez le nom du personnel"
                                                    required
                                                >
                                            </div>
                                            @if($personnel->informations->isNotEmpty())
                                            <div class="p-4">
                                                <div class="border border-gray-600 rounded-md p-4">
                                                    <div class="flex justify-center mb-2 text-white font-semibold">Informations</div>
                                                
                                                    <div class="flex flex-wrap justify-center gap-2 ">
                                                        @foreach($personnel->informations as $key => $info)
                                                            <label class="flex items-center gap-2 bg-white text-[#14264b]  font-semibold px-3 py-1 rounded-md  cursor-pointer">
                                                            <input
                                                    type="checkbox"
                                                    name="{{'personnel_information0'.$key}}" 
                                                    value="{{ $info->id }}"
                                                    class="form-checkbox"
                                                />
                                                                <span style="margin-bottom: 1px">{{ $info->information }}</span>
                                                            </label>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                            @endif
                                            <div class="flex justify-center mt-4">
                                                <button type="submit"
                                                    class="p-2 px-4 m-auto text-sm font-bold text-blue-500 bg-white rounded-lg hover:shadow-xl w-fit hover:text-blue-600">
                                                    Valider l'achat
                                                </button>
                                            </div>
                                
                                            <button type="button"
                                                name="form-purchase-personnel-{{ $personnel->id }}"
                                                class="absolute flex items-center justify-center rounded-full shadow-md close-action-modal backdrop-filter -top-2 -right-2">
                                                <img src="{{ asset('assets/images/icons8-close-48.png') }}" class="size-8" alt="">
                                                <span class="hidden">Close</span>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                                
                                
                                </li>
                            @endforeach
                        </ul>
                        <button type="button" name="personnels-carousel"  id="right"
                            class="absolute left-0 z-30 flex items-center justify-center w-20 h-20 px-4 -translate-y-1/2 cursor-pointer top-1/2 button-scrolling end-0 group focus:outline-none"
                            data-carousel-next>
                            <span
                                class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-blue-300/30 group-hover:bg-blue-300/50 group-focus:ring-4 group-focus:ring-blue-300 group-focus:outline-none">
                                <img width="20" alt="arrow left" height="20"
                                    src="{{ asset('assets/icons/icons8-arrow-left-64.png') }}" />
                                <span class="sr-only">Previous</span>
                            </span>
                        </button>
                        <button type="button" name="personnels-carousel" id="left"
                            class="absolute right-0 z-30 flex items-center justify-center w-20 h-20 px-4 -translate-y-1/2 cursor-pointer top-1/2 button-scrolling end-0 group focus:outline-none"
                            data-carousel-next>
                            <span
                                class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-blue-300/30 group-hover:bg-blue-300/50 group-focus:ring-4 group-focus:ring-blue-300 group-focus:outline-none">
                                <img width="20" alt="arrow right" height="20"
                                    src="{{ asset('assets/icons/icons8-arrow-right-64.png') }}" />
                                <span class="sr-only">Next</span>
                            </span>
                        </button>
                    </div>
                    <h4 class="px-4 py-3 mt-2 text-xl font-bold text-center uppercase text-white/80">Les Equipements
                    </h4>
                    <div class="relative px-8 py-4 wrapper">
                        <ul class="relative carousel">
                            @foreach ($equipements as $equipement)
                                <li
                                    class=" card w-[229px] flex flex-col justify-between relative bg-[#151b28]  overflow-hidden rounded-xl hover:shadow-xl ">
                                    <div class="p-2 ">
                                        <h5 class="w-full text-lg text-left text-white ">
                                            {{ $equipement->nom_equipement }}</h5>
                                        <p class="text-sm font-thin text-left text-white/70">
                                            {{ $equipement->description_equipement }}</p>
                                        <div class="mt-2">
                                            <button name="form-purchase-equipment-{{ $equipement->id }}"
                                                class=" gap-2 rounded-xl p-3 mt-1 fill-white show-modal bg-[#15244c] hover:bg-[#15244c] w-fit hover:fill-blue-500 flex items-center h-full text-white/70 hover:text-white   text-left text-sm transition-all cursor-pointer">
                                                <span>Acheter</span>
                                                <div class="flex items-center "> <span
                                                        class="font-bold text-yellow-500">{{ $equipement->prix_equipement }}</span>
                                                    <img width="24" height="24"
                                                        src="{{ asset('assets/images/icons8-money-48.png') }}"
                                                        alt="" />
                                                </div>
                                            </button>
                                        </div>
                                    </div>
                                    <form name="equipment" method="POST"
                                        id="form-purchase-equipment-{{ $equipement->id }}"
                                        class="fixed top-0 left-0 z-50 items-center justify-center hidden w-full h-full py-8 purchase-item expend-modal bg-black/30 ">
                                        <div class="relative">
                                            <input type="number" hidden name="equipement_id"
                                                value="{{ $equipement->id }}">

                                            <div class="py-2 bg-[#14264b]  rounded-lg min-w-96"
                                                style="max-width: 500px;">
                                                <h5
                                                    class="text-xl font-semibold tracking-tight text-center text-white ">
                                                    {{ $equipement->nom_equipement }}</h5>
                                                <div class="flex items-center justify-center gap-1 my-3">
                                                    <span
                                                        class="text-5xl font-bold text-white ">{{ $equipement->prix_equipement }}</span>
                                                    <img width="32" height="32"
                                                        src="{{ url('assets/images/icons8-money-48.png') }}"
                                                        alt="" srcset="">
                                                </div>
                                                <div class="flex justify-center mt-1">
                                                    <button type="submit"
                                                        class="p-2 px-4 m-auto text-sm font-bold text-blue-500 bg-white rounded-lg hover:shadow-xl w-fit hover:text-blue-600">Valider
                                                        l'achat</button>
                                                </div>
                                                <button type="button"
                                                    name="form-purchase-equipment-{{ $equipement->id }}"
                                                    class="absolute flex items-center justify-center rounded-full shadow-md close-action-modal backdrop-filter -top-2 -right-2">
                                                    <img src="{{ asset('assets/images/icons8-close-48.png') }}"
                                                        class="size-8" alt="" srcset="">
                                                    <span class="hidden">Close</span>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </li>
                            @endforeach
                        </ul>
                        <button type="button" id="right"
                            class="absolute left-0 z-30 flex items-center justify-center w-20 h-20 px-4 -translate-y-1/2 cursor-pointer top-1/2 end-0 group focus:outline-none"
                            data-carousel-next>
                            <span
                                class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-blue-300/30 group-hover:bg-blue-300/50 group-focus:ring-4 group-focus:ring-blue-300 group-focus:outline-none">
                                <img width="20" alt="arrow left" height="20"
                                    src="{{ asset('assets/icons/icons8-arrow-left-64.png') }}" />
                                <span class="sr-only">Previous</span>
                            </span>
                        </button>
                        <button type="button" id="left"
                            class="absolute right-0 z-30 flex items-center justify-center w-20 h-20 px-4 -translate-y-1/2 cursor-pointer top-1/2 end-0 group focus:outline-none"
                            data-carousel-next>
                            <span
                                class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-blue-300/30 group-hover:bg-blue-300/50 group-focus:ring-4 group-focus:ring-blue-300 group-focus:outline-none">
                                <img width="20" alt="arrow right" height="20"
                                    src="{{ asset('assets/icons/icons8-arrow-right-64.png') }}" />
                                <span class="sr-only">Next</span>
                            </span>
                        </button>
                    </div>
                </div>
            
        </div>
    </div>
</div>