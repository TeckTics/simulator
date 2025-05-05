<script>
    $("#toast-success").hide();
    let userDataInfo;
    const token = "{{ csrf_token() }}";
    $("#toast-danger").hide();
    $("#toast-warning").hide();
    $('#shop-button-mission-form-panel').addClass('hidden')
    let accordionBol = false;
    let realTimer;
    $('#loader').hide()
    let clanId;
    $('#focus-hopital-id').addClass('hidden')
    $('#focus-base-id').addClass('hidden')

    let baseId;
    let experienceClan;
    let niveauClan;
    let currentAddresseBase = "";
    let cities = @json($villes);
    let isFirstBase = false;
    let muted = false;
    let personnels = [];
    let setting = {
        muted: false,
        viewNameUnite: false,
        viewNameBase: false,
        viewNameMission: false,
        viewAllianceBase: false,
        viewUniteAlliance: false,
        notification: false,
    }
    let posX = 45.650002;
    let posY = 0.16;
    let startRoute = false;

    const currentRouting = [];
    let indexCurrentRouting = 0;
    let uniteSelected = [];
    let personnelSelected = [];
    let equipementSelected = [];
    let userGameDataTimeout = null;

    $('#chat-form-alliance').hide()
    $("#loading").show();
    $('#loader-detail-alliance').hide()
    $('#loader-detail-base').hide();
    $('#loader-detail-unite').hide()
    $('#remove-money-animate').hide();
    $('#loader-personnel').hide()
    $('#title-chat').text('"Générale"')
    $("#toasts").addClass("z-50");
    $('#messagesContainer-alliance').hide()

    $('#timer-alliance-panel').hide()
    $('#daily-gain').hide();
    $('#confirm-action-panel').hide();
    $('#destroy-alliance-btn').hide()
    $('#leave-alliance-btn').hide()
    $('#button-chat-alliance').hide()
    $("#view-clan-name").hide()
    $('#view-chat-alliance').hide()
    $('#view-chat-generale').hide()

    $('#button-chat-alliance2').hide()
    $("#view-clan-name2").hide()
    $('#view-chat-alliance2').hide()
    $('#view-chat-generale2').hide()
    $('#message-input-alliance2').hide()
    $('#messagesContainer2-alliance').hide()
    $('#loader-personnel-card').hide()

    let baseMarker = true;
    let marker;
    var map;

    let currentBaseMission;
    let currentHopital;



    let realTimer2;
    let lockAlertMission = false;
    const tabMarkerMission = []
    let currentMissionPositions = {
        positionX: 0,
        positionY: 0,
    };
    let markerMission;
    let baseIdMission;
    let hopitalIdMission;
    let tabMarkerBase = [];
    let bases = []
    let tabHopital = []
    let address = {
        country: "",
        county: "",
        municipality: "",
        quarter: "",
        road: "",
        state: "",
        town: "",
        region: "",
        display_name: "",
    }

    // Définir les limites de la France métropolitaine
    const franceMinLat = 41.0;
    const franceMaxLat = 51.0;
    const franceMinLon = -5.0;
    const franceMaxLon = 9.0;
    // Rayon en kilomètres
    const radiusKm = 30;

    const SELECTORS = {
        CONFIRM_DESTROY_BASE: "#confirm-destroy-base",
        CANCEL_DESTROY_BASE_ICON: "#cancel-destroy-base-icon",
        CANCEL_DESTROY_BASE: "#cancel-destroy-base",
        DESTROY_BASE_MODAL: "#destroy-base-modal",
        BASE_DETAILS_PANEL: "#base-details-panel",
        BASE_ID_TO_DELETE: "#base-id-to-delete"
    };

    $('#accept-cookie').on("click", () => {
        const cookieAccepted = window.localStorage.setItem('accepted-cookie', JSON.stringify(true))
        $('#cookie-consent-banner-panel').remove()
    })

    $('#decline-cookie').on("click", () => {
        const cookieAccepted = window.localStorage.setItem('accepted-cookie', JSON.stringify(false))
        $('#cookie-consent-banner-panel').remove()
    })

    function getCookie(key = "cookie-setting") {
        if (window && window.cookieStore) {
            return window.cookieStore.get(key);
        } else {
            return localStorage.getItem(key);
        }
    }

    $(document).ready(async function() {
        setInterval(() => {
            // "{{ $dateNow }}"
            formatDateTime(new Date(), "simple")
        }, 1000);

        const cookie = await getCookie();
        if (cookie) {
            setting = JSON.parse(cookie.value);

        } else {
        }
        const cookieAccepted = window.localStorage.getItem('accepted-cookie')
        if (cookieAccepted) {
            if (JSON.parse(cookieAccepted) == true) {
                $('#cookie-consent-banner-panel').remove()
            } else {
                $("#cookie-consent-banner-panel").addClass('block');
                $("#cookie-consent-banner-panel").removeClass('hidden');
            }
        } else {
            $("#cookie-consent-banner-panel").addClass('block');
            $("#cookie-consent-banner-panel").removeClass('hidden');
        }


        function checkNewDay() {
            const promise = fetch("/dashboard/api/check-day");
            promise.then((response) => {
                return response.json();
            }).then(function(data) {
                if (data.data === true) {
                    $('#daily-gain').show();
                }
            }).catch((err) => {
            })
        }


        function initGameMap() {
            var osm = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
            });

            map = L.map('map').setView([46.52865965005863, 2.8117984762181347], 18);
            var southWest = L.latLng(42.35842653923198, -
                4.699014964607643); // Coin sud-ouest de la France (approximatif)
            var northEast = L.latLng(51.01388134677095,
                8.217469443861178); // Coin nord-est de la France (approximatif)
            var bounds = L.latLngBounds(southWest, northEast);
            map.setMaxBounds(bounds);
            osm.addTo(map);
            // L.easyButton('fa-globe', function(btn, map) {

            map.fitBounds([
                [42.35842653923198, -4.699014964607643],
                [51.01388134677095, 8.217469443861178]
            ]); // Limites approximatives de la France
            $.getJSON("{{ asset('geojson/departement.geojson') }}", function(data) {
                var zone = L.geoJson(data, {
                    style: function(feature) {
                        return {
                            color: '#00000038',
                            weight: 1
                        };
                    },
                    onEachFeature: function(feature, layer) {
                        layer.bindPopup("<b>" + feature.properties.nom + "</b><br>" +
                            feature.properties.description);
                    }
                }).addTo(map);


            });
        }
        function disableRouteCreationUI() {
    // Disable form or button related to route creation
    const routeCreateButton = document.getElementById('createRouteButton');
    if (routeCreateButton) {
        routeCreateButton.disabled = true; // Disables button
    }
    
    // Disable any other relevant UI elements
    const routeForm = document.getElementById('routeForm');
    if (routeForm) {
        routeForm.style.display = 'none'; // Hide the form or inputs
    }
}


        function initGameMap() {
            map = L.map('map').setView([45.650002, 0.16], 7);
            var osm = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            });

            osm.addTo(map);
            var southWest = L.latLng(41.5, -5.1); // Coin sud-ouest de la France (approximatif)
            var northEast = L.latLng(51.1, 9.5); // Coin nord-est de la France (approximatif)
            var bounds = L.latLngBounds(southWest, northEast);
            map.setMaxBounds(bounds);
            // L.easyButton('fa-globe', function(btn, map) {

            map.fitBounds([
                [41.5, -5.1],
                [51.1, 9.5]
            ]); // Limites approximatives de la France
        }
        changeSetting()
        checkNewDay()
        loadItemList()
        refreshData()
        loadHopitaux()
        loadDataMap()
        loadMissions()
        initDashboard()
        initGameMap()
    })

    function isPointInMultiPolygon(point, multiPolygon) {
        for (let i = 0; i < multiPolygon.geometry.coordinates.length; i++) {
            const polygon = multiPolygon.geometry.coordinates[i];
            const leafletPolygon = L.polygon(polygon);

            if (leafletPolygon.contains(point)) {
                return true; // Point is within at least one polygon of the MultiPolygon
            }
        }

        return false; // Point is not within any of the polygons in the MultiPolygon
    }

    //#region Other data

    document.addEventListener("DOMContentLoaded", function() {

        const carousel = document.querySelector(".carousel");
        // const arrowBtns = document.querySelectorAll("button.button-scrolling")
        const wrapper = document.querySelector(".wrapper");
        const firstCard = carousel.querySelector(".card");
        const firstCardWidth = firstCard.offsetWidth;
        let isDragging = false,
            startX,
            startScrollLeft,
            timeoutId;

        const dragStart = (e) => {
            isDragging = true;
            carousel.classList.add("dragging");
            startX = e.pageX;
            startScrollLeft = carousel.scrollLeft;
        };

        const dragging = (e) => {
            if (!isDragging) return;

            // Calculate the new scroll position
            const newScrollLeft = startScrollLeft - (e.pageX - startX);

            // Check if the new scroll position exceeds
            // the carousel boundaries
            if (newScrollLeft <= 0 || newScrollLeft >=
                carousel.scrollWidth - carousel.offsetWidth) {

                // If so, prevent further dragging
                isDragging = false;
                return;
            }

            // Otherwise, update the scroll position of the carousel
            carousel.scrollLeft = newScrollLeft;
        };

        const dragStop = () => {
            isDragging = false;
            carousel.classList.remove("dragging");
        };

        const autoPlay = () => {

            // Return if window is smaller than 800
            if (window.innerWidth < 800) return;

            // Calculate the total width of all cards
            const totalCardWidth = carousel.scrollWidth;

            // Calculate the maximum scroll position
            const maxScrollLeft = totalCardWidth - carousel.offsetWidth;

            // If the carousel is at the end, stop autoplay
            if (carousel.scrollLeft >= maxScrollLeft) return;

            // Autoplay the carousel after every 2500ms
            timeoutId = setTimeout(() =>
                carousel.scrollLeft += firstCardWidth, 2500);
        };

        carousel.addEventListener("mousedown", dragStart);
        carousel.addEventListener("mousemove", dragging);
        document.addEventListener("mouseup", dragStop);
        wrapper.addEventListener("mouseenter", () =>
            clearTimeout(timeoutId));
        wrapper.addEventListener("mouseleave", autoPlay);
    });

    $('.button-scrolling').on('click', function() {
        const name = $(this).attr('name');
        const id = $(this).attr('id');
        const carouselItem = document.querySelector("#" + name);
        carouselItem.scrollLeft += id === "left" ? 229 : -229;
    });

    $('#accept-daily-gain').on('submit', function(e) {
        e.preventDefault()
        $.ajax({
            url: '/dashboard/api/accept-daily-gain',
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': token,
                'Content-Type': 'application/json'
            },
            dataType: 'json',
            success: function(response) {
                if (response.data) {
                    $('#daily-gain').hide();
                    moneyLeaveAnimation(500, true)
                    initDashboard()
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {

                console.error('Error posting data:', textStatus,
                    errorThrown);
                showToast("danger",
                    "Une erreur c'est produite lors de l'execution de votre demande!"
                )
            }
        });
    })

    function getImageNivAlliance(params) {
        let image;
        switch (params) {
            case 1:
                image = `<img title="niveau ${item.niveau}"
                                                src="{{ asset('assets/images/image1_0 (15).png') }}" width="30"
                                                height="30" alt="">`;
            case 2:
                image = `<img title="niveau ${item.niveau}"
                                                src="{{ asset('assets/images/image1_0 (15).png') }}" width="30"
                                                height="30" alt="">`;
            case 3:
                image = `<img title="niveau ${item.niveau}"
                                                src="{{ asset('assets/images/image0_0 (15).png') }}" width="30"
                                                height="30" alt="">`;
            case 3:
                image = `<img title="niveau ${item.niveau}"
                                                src="{{ asset('assets/images/image0_0 (15).png') }}" width="30"
                                                height="30" alt="">`;
            case 3:
                image = `<img title="niveau ${item.niveau}"
                                                src="{{ asset('assets/images/image0_0 (15).png') }}" width="30"
                                                height="30" alt="">`;
            case 4:
                image = `<img title="niveau ${item.niveau}"
                                                src="{{ asset('assets/images/image0_0 (15).png') }}" width="30"
                                                height="30" alt="">`;
            case 5:
                image = `<img title="niveau ${item.niveau}"
                                                src="{{ asset('assets/images/image0_0 (15).png') }}" width="30"
                                                height="30" alt="">`;
            default:
                image = '';
        }

        return image;
    }

    function listAllianceToHtml(htmlId, array) {
        let htmlText = '';
        const htmlElement = document.getElementById(htmlId)
        htmlElement.innerHTML = ''
        for (let index = 0; index < array.length; index++) {
            const item = array[index];
            if (item !== undefined) {
                const divElement = document.createElement('div');
                divElement.addEventListener('click', () => {
                    $('#alliance-details').removeClass('hidden')
                    $('#alliance-details').addClass('flex')
                    fetchDataAlliance(item.id)
                })
                divElement.innerHTML = `   <div name="${item.id}" class="gap-4  bg-[#0a0d12] justify-between pr-4 items-center my-2  cursor-pointer flex flex-row text-white">
                                    <div class="flex flex-row items-center gap-4">
                                        <div class="h-full p-2 py-3 bg-white ">
                                            <img src="/${item.banner}" width="30" height="30" alt="">
                                        </div>
                                        <div>
                                            ${item.nom_clan}
                                            <div class="flex items-center gap-1">
                                                <span class="text-xs">Alliance de niveau ${item.niveau}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="bg-white text-[#151b28] font-bold p-2 shadow-inner rounded-md">
                                            ${item.user_count}/${item.max}
                                        </div>
                                    </div>
                                </div>
                           `;
                divElement.setAttribute('name', item.id);
                divElement.classList.add('show-detail');
                htmlElement.appendChild(divElement)
            }
        }
        // $('#' + htmlId).html(htmlText)
    }

    $('.accordion-collapse-heading').on('click', function() {
        if (accordionBol) {
            $('.accordion-collapse-body').removeClass('block')
            $('.accordion-collapse-body').addClass('hidden')
            accordionBol = !accordionBol;
        } else {
            $('.accordion-collapse-body').addClass('block')
            $('.accordion-collapse-body').removeClass('hidden')
            accordionBol = !accordionBol;
        }
    })

    function getMonth($month) {
        switch ($month) {
            case 1:
                return "Janvier"
            case 2:
                return "Février"
            case 2:
                return "Mars"
            case 2:
                return "Avril"
            case 2:
                return "Mai"
            case 2:
                return "Juin"
            case 2:
                return "Juillet"
            case 2:
                return "Août"
            case 2:
                return "Septembre"
            case 2:
                return "Octobre"
            case 2:
                return "Novembre"
            case 2:
                return "Décembre"
            default:
                return "Nan"
        }
    }

    function formatDateTime(str, type) {
        const date = new Date();

        // Formatter la date et l'heure en français, fuseau horaire de Paris
        const options = {
            timeZone: "Europe/Paris",
            year: "numeric",
            month: "long",
            day: "numeric",
            hour: "2-digit",
            minute: "2-digit",
            hour12: false
        };

        const formattedDate = date.toLocaleString("fr-FR", options);

        switch (type) {
            case "simple":
                $("#date-now").text(`${formattedDate}`);
                break;
            case "formation":
                return `Fini le ${formattedDate}`;
            default:
                return formattedDate;
        }
    }

    // Fonction pour obtenir le mois en français
    function getMonth(month) {
        const months = ["janvier", "février", "mars", "avril", "mai", "juin", "juillet", "août", "septembre", "octobre",
            "novembre", "décembre"
        ];
        return months[month - 1];
    }

    function getBgColorStatus(status) {
        switch (status) {
            case "a la base":
                return "bg-green-500/80";
            case "en mission":
                return "bg-yellow-500/80"
            case "pas de base attribuee":
                return "bg-stone-500/80"
            case "en reparation":
                return "bg-orange-500/80"
            default:
                return "bg-[#14264b]"
        }
    }

    function listItemListToHtml(htmlId, array, type) {
        let htmlText = '';
        const htmlElement = document.getElementById(htmlId)
        htmlElement.innerHTML = ''
        for (let index = 0; index < array.length; index++) {
            const item = array[index];
            if (item !== undefined) {
                const divElement = document.createElement('div');
                switch (type) {
                    case "unite":
                        divElement.addEventListener('click', () => {
                            $('#card-unite-panel').removeClass('hidden')
                            $('#card-unite-panel').addClass('flex')
                            fetchDataUnite(item.id)
                        })
                        divElement.innerHTML = `
                        <div
                            class="relative w-40 p-1 overflow-hidden text-sm bg-white shadow cursor-pointer sm:basis-52 basis-40 h-fit sm:w-52 rounded-xl">
                            <img class=" py-2 w-full h-[224px] object-contain "
                                src="/${item.image}" alt="product image" />
                            <div class="px-2 py-2 bg-[#151b28] text-white">
                                <h5
                                    class="text-sm font-bold tracking-tight text-center text-white ">
                                    ${item.nom}</h5>
                                      <div class="flex gap-2 mt-1 items-center text-center justify-center shadow-xl rounded-md  p-1  ${getBgColorStatus(item.etat_unite)} ">
                                        <span class="text-xs text-center text-white">${item.etat_unite ? item.etat_unite : "Non utilisée"}</span></div>
                                <div class="flex items-center justify-between w-full gap-2 ">
                                    <div class="flex gap-2 items-center shadow-xl rounded-md absolute top-1 left-1 p-1 bg-[#14264b] ">
                                        <span class="text-xs text-white">${item.nom_type_unite}</span></div>
                                </div>
                            </div>
                        </div>
                        `;
                        break;
                    case "personnel":
                        const deleteButton = document.createElement('button');
                        const formationButton = document.createElement('button');
                        const divContainer = document.createElement('div');
                        const divContainer2 = document.createElement('div');
                        const timeFormationDiv = document.createElement('p');
                        if (item.personnel.base_id) {
                            const viewBaseButton = document.createElement('button');
                            viewBaseButton.classList.add("gap-2", "p-2", "fill-white", "bg-blue-500", "bg-blue-600",
                                "w-full", "hover:fill-blue-500", "flex", "justify-center", "items-center", "h-full",
                                "text-white",
                                "text-left", "text-sm", "transition-all", "rounded-md",
                                "cursor-pointer")
                            viewBaseButton.addEventListener('click', () => {
                                $('#base-details-panel').removeClass('hidden')
                                $('#base-details-panel').addClass('flex')
                                $('#base-details-panel').addClass('z-50')
                                $('#base-details-panel').removeClass('z-40')
                                loadBaseById(item.personnel.base_id);
                            })
                            viewBaseButton.innerText = "Afficher sa base"
                            divContainer.appendChild(viewBaseButton)
                        }

                        timeFormationDiv.classList.add("text-white", "py-2", "text-center", "font-bold", "text-sm")
                        
                        // Personnel formation Countdown
                        countDownTimer(
                            item.dateFin, 
                            timeFormationDiv, 
                            item.personnel.niveau,
                            "Fin de la formation dans",
                            "end-formation", `niveau-element-personnel-${item.personnel.id}`,
                        );

                        formationButton.addEventListener('click', () => {
                            $('#card-personnel-formation-panel').removeClass('hidden')
                            $('#card-personnel-formation-panel').addClass('flex')
                            fetchDataFormation(item.personnel.id)
                        })
                        deleteButton.addEventListener('click', () => {
                            deletePersonnel(item.personnel.id)
                        })
                        divElement.classList.add('bg-[#151b28]', 'rounded-2xl', "max-sm:w-72", "mx-auto", 'p-2',
                            'h-fit')

                        formationButton.classList.add("gap-2", "p-2", "fill-white", "bg-white", "hover:bg-[#15244c]",
                            "w-full", "hover:fill-blue-500", "flex", "justify-center", "items-center", "h-full",
                            "text-[#15244c]",
                            "hover:text-white", "text-left", "text-sm", "transition-all", "rounded-md",
                            "cursor-pointer")
                        formationButton.innerText = "Former";
                        deleteButton.classList.add("gap-2", "p-2", "fill-white", "bg-red-500", "hover:bg-red-600",
                            "w-full", "hover:fill-blue-500", "flex", "justify-center", "text-center",
                            "items-center", "h-full", "text-white/70",
                            "hover:text-white", "text-left", "text-sm", "transition-all", "rounded-md",
                            "cursor-pointer")
                        deleteButton.innerText = "Retirer du personnel";
                        divContainer.classList.add("grid", "w-full", "items-center", "justify-end", "gap-2",
                            "sm:grid-cols-3", "grid-cols-1")
                        divContainer2.classList.add("flex", "items-center", "justify-between", "mt-2", "gap-2")
                        divContainer.appendChild(formationButton);
                        divContainer.appendChild(deleteButton);
                        divContainer2.appendChild(divContainer);

                        if (item.personnel.is_busy) {
                            // formationButton
                            formationButton.disabled = true;
                            formationButton.classList.add("bg-[#15244c]");
                            formationButton.innerText = "En cours de formation";
                            formationButton.style.cursor = "not-allowed";

                            // deleteButton
                            // deleteButton.disabled = true;
                            // deleteButton.classList.add("bg-red-600");
                            // deleteButton.innerText = "En cours de formation";
                            // deleteButton.style.cursor = "not-allowed";
                            // deleteButton.style.display = "none";
                        }
                        divElement.innerHTML = `
                                <div class="relative block w-full col-span-1 text-sm sm:flex sm:flex-row h-fit ">
                                    <div class="w-full overflow-hidden rounded-md shadow-2xl sm:w-64 basis-52 h-52 shadow-blue-800/20" style="height: 208px">
                                        <img class="w-full h-full " height="208px" src="/${item.personnel.image}"
                                            alt="product image" />
                                    </div>

                                    <div class="px-4">
                                        <div id="niveau-element-personnel-${item.personnel.id}" title="Niveau ${item.personnel.niveau}"
                                            class=" w-fit h-fit absolute px-3 font-bold bg-black/50 text-[14px] shadow-2xl shadow-black p-2 rounded-md text-stone-100 top-2 right-0 ">
                                            Niveau  ${item.personnel.niveau}</div>
                                    <ul class="text-white">
                                        <li class="py-2"><span class="font-bold">Prénom:
                                            </span><span> ${item.personnel.prenom_personnel}</span></li>
                                        <li class="py-2"><span class="font-bold">Nom:
                                            </span><span> ${item.personnel.nom_personnel}</span></li>
                                        <li class="py-2"><span class="font-bold">État actuel:
                                            </span><span> ${item.personnel.etat_formation_personnel ?? "aucune"}</span></li>
                                        <li class="py-2"><span class="font-bold">En déplacement:
                                            </span><span>${item.personnel.etat_mouvement_personnel}</span></li>
                                        <li class="py-2"><span class="font-bold">Missions effectuées:
                                            </span><span> ${item.personnel.total_used}</span></li>
                                        <li class="py-2"><span class="font-bold">Niveau: </span><span  id="2-niveau-element-personnel-${item.personnel.id}"> ${item.personnel.niveau}</span>
                                        </li>
                                         <li class="py-2"><span class="font-bold">Rôle: </span><span> ${item.personnel.titre_personnel}</span>
                                        </li>

                                    </ul>
                                </div>
                            </div>
                    `;

                        divElement.appendChild(divContainer2)
                        divElement.appendChild(timeFormationDiv);
                        if (item.personnel.etat_mouvement_personnel === "oui") {
                            const divPosition = document.createElement('button')
                            divPosition.classList.add("bg-green-400", "personnel-routing", "rounded-md", "mt-2",
                                "text-white", "p-2");

                            divPosition.name = item.personnel.base_id;
                            divPosition.disabled = true;
                            divElement.appendChild(divPosition)

                        }


                        break;
                    default:
                        break;
                }
                divElement.setAttribute('name', item.id);
                htmlElement.appendChild(divElement)
            }
        }
        reloadPosition()
        // $('#' + htmlId).html(htmlText)
    }

    function deletePersonnel(id) {
        $('#loader-personnel').show()
        const idAlliance = $("#id-alliance").val();
        $.ajax({
            url: "/dashboard/api/delete-personnel/" + id,
            type: 'DELETE',
            data: JSON.stringify({
                "clan_id": idAlliance
            }),
            headers: {
                'X-CSRF-TOKEN': token,
                'Content-Type': 'application/json'
            },
            dataType: 'json',
            success: function(response) {
                showToast(response.status, response.message);
                initDashboard();
                loadItemList();
                $('#loader-personnel').hide()
            },
            error: function(jqXHR, textStatus, errorThrown) {
                $('#loader-personnel').hide()
                console.error('Error posting data:', textStatus,
                    errorThrown);
                showToast("danger",
                    "Une erreur c'est produite lors de l'execution de votre demande!")
            }
        });
    }

    function loadAlliance() {
        const promise = fetch("/dashboard/api/get-alliance?page=1");
        promise.then((response) => {
            return response.json();
        }).then(function(data) {
            listAllianceToHtml('alliance-list', data.data)
        }).catch((err) => {
        })
    }


    function loadItemList() {
        const promise = fetch("/dashboard/api/get-items");
        promise.then((response) => {
            return response.json();
        }).then(function(data) {
            listItemListToHtml('equipment-unite-list', data.data.unites, "unite")
            personnels = data.data.personnels;
            listItemListToHtml('personnel-list', data.data.personnels, "personnel")
        }).catch((err) => {
        })
    }

    function clearTimer() {
        // clearInterval(realTimer);
    }

    function timerRealTime(time2, htmlId, message) {
        const strToTime = new Date(time2).getTime();
        realTimer = setInterval(() => {
            const dateNow = new Date().getTime();
            var timer = strToTime - dateNow;
            if (timer > 0) {
                var minutesSpan = document.getElementById(htmlId);
                timer = timer - 1000;
                var minutes = Math.floor((timer / 1000 / 60) % 60);
                var seconds = Math.floor((timer / 1000) % 60);
                var hours = Math.floor((timer / 1000 / 60 / 60) % 24);
                var days = Math.floor(timer / (1000 * 60 * 60 * 24));
                if (minutesSpan) {
                    minutesSpan.innerHTML =
                        ` ${message} ${days == 0 ? "" : days + "jour" }${days > 1 ? "s" : ""} ${hours < 10 ? "0" + hours : hours}:${minutes < 10 ? "0" + minutes : minutes}:${seconds < 10 ? "0" + seconds : seconds}`;
                }
                if (timer == 0) {
                    $("#" + htmlId).hide()
                    clearInterval(realTimer);
                }
            }
        }, 1000);
    }

    function upgradePersonnel(id) {
        const idAlliance = $("#id-alliance").val();
        $.ajax({
            url: "/dashboard/api/upgrade-personnel/" + id,
            type: 'PUT',
            headers: {
                'X-CSRF-TOKEN': token,
                'Content-Type': 'application/json'
            },
            dataType: 'json',
            success: function(response) {
                showToast(response.status, response.message);
                loadItemList();
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error('Error posting data:', textStatus,
                    errorThrown);
                showToast("danger",
                    "Une erreur c'est produite lors de l'execution de votre demande!")
            }
        });
    }

    // Fonction pour obtenir l'heure actuelle en France (UTC+1 ou UTC+2)
    function getDateNowFrancex() {
        const now = new Date();
        // Obtenir le décalage horaire pour la France (en minutes)
        const timezoneOffset = now.getTimezoneOffset();
        // Convertir en millisecondes
        const timezoneOffsetMs = timezoneOffset * 60 * 1000;
        // Ajouter le décalage horaire pour la France (UTC+1 ou UTC+2)
        const franceOffsetMs = 60 * 60 * 1000; // UTC+1 (heure d'hiver)
        const isSummerTime = now.toTimeString().includes("CEST"); // Heure d'été (UTC+2)
        const totalOffsetMs = timezoneOffsetMs + (isSummerTime ? 2 * 60 * 60 * 1000 : franceOffsetMs);
        return now.getTime() + totalOffsetMs;
    }

    function countDownTimer(str, element, id, message, type, action) {
        // add detail {date_debut, date_fin, time}

        if (str != null) {
            // Convertir la chaîne de date en temps UTC en tenant compte du fuseau horaire de la France
            const strToTime = new Date(str).getTime();

            const realTimer1 = setInterval(async() => {
                // Obtenir l'heure actuelle en France (UTC+1 ou UTC+2)
                const dateNowFrance = await getDateNowFrance();
                const timer = strToTime - dateNowFrance;

                if (timer > 0) {
                    const seconds = Math.floor((timer / 1000) % 60);
                    const minutes = Math.floor((timer / 1000 / 60) % 60);
                    const hours = Math.floor((timer / 1000 / 60 / 60) % 24);
                    const days = Math.floor(timer / (1000 * 60 * 60 * 24));

                    if (element) {
                        element.innerHTML =
                            `<p>${message} ${days == 0 ? "" : days + " jour" + (days > 1 ? "s" : "")} ${hours < 10 ? "0" + hours : hours}:${minutes < 10 ? "0" + minutes : minutes}:${seconds < 10 ? "0" + seconds : seconds}</p>`;
                    }
                } else {
                    clearInterval(realTimer1);
                    const d = document.getElementById(action);
                    const d2 = document.getElementById("2-" + action);
                    if (d) {
                        d.innerHTML = "Niv " + (parseInt(id) + 1);
                    }
                    if (d2) {
                        d2.innerHTML = parseInt(id) + 1;
                    }
                    if (element) {
                        element.innerHTML = "";
                    }
                }
            }, 1000);
        }
    }

    async function getDateNowFrance() {
        const response = await fetch('/dashboard/api/paris-time'); // à adapter selon ta route
        const data = await response.json();
        return data.timestamp; // timestamp en ms
    }
    const promise = fetch("/dashboard/api/get-alliance?page=1");
        promise.then((response) => {
            return response.json();
        }).then(function(data) {
            listAllianceToHtml('alliance-list', data.data)
        }).catch((err) => {
        })

    function countDownTimer2(str, element, id, message, type, action) {
        if (str != null) {
            // Convertir la chaîne de date en temps UTC
            const strToTime = new Date(str).getTime();

            realTimer2 = setInterval(async() => {
                // Obtenir l'heure actuelle en France
                const dateNowFrance = await getDateNowFrance();
                var timer = strToTime - dateNowFrance;

                if (timer > 0) {
                    var minutes = Math.floor((timer / 1000 / 60) % 60);
                    var seconds = Math.floor((timer / 1000) % 60);
                    var hours = Math.floor((timer / 1000 / 60 / 60) % 24);
                    var days = Math.floor(timer / (1000 * 60 * 60 * 24));

                    if (element) {
                        element.innerHTML =
                            `<p>${message} ${days == 0 ? "" : days + "jour" }${days > 1 ? "s" : ""} ${hours < 10 ? "0" + hours : hours}h:${minutes < 10 ? "0" + minutes : minutes}m:${seconds < 10 ? "0" + seconds : seconds}s</p>`;
                    }
                } else {
                    clearInterval(realTimer2); // Correction : utiliser clearInterval au lieu de clearTimer
                    const d = document.getElementById(action);
                    const d2 = document.getElementById("2-" + action);
                    if (d) {
                        d.innerHTML = "Niv " + (parseInt(id) + 1);
                    }
                    if (d2) {
                        d2.innerHTML = parseInt(id) + 1;
                    }
                    if (element) {
                        element.innerHTML = "";
                    }
                }

            }, 1000);
        }
    }

    function initDashboard() {
        const promise = fetch("/dashboard/api/get-user");
        promise.then((response) => {
            return response.json();
        }).then(function(data) {
            if (data.data.countBase == 0) {
                $('#first-base').addClass('block');
                $('#first-base').removeClass('hidden');
            } else {
                $('#first-base').remove()
            }
            userDataInfo = data.data;
            $('#nbIntervention').text(userDataInfo.nbIntervention);
            $('#nbUnite').text(userDataInfo.nbUnite);
            $('#nbPersonnel').text(userDataInfo.nbPersonnel);
            $('#percentageSuccess').text(`${userDataInfo.percentageSuccess}%`)
            $('#nbEquipement').text(userDataInfo.nbEquipement)
            $('#nbAmelioration').text(userDataInfo.nbAmelioration)
            $('#reactMission').text(0.00)
            if (data.data.noAccessCreateAlliance && data.data.user.last_alliance_created_at) {
                $("#create-alliance-button").hide()
                $('#timer-alliance-panel').show()
                timerRealTime(data.data.user.last_alliance_created_at,
                    'timer-alliance-panel', "Vous pouvez créer une nouvelle alliance dans")
            } else {
                $('#timer-alliance-panel').hide()
                if (data.data.belongsToAlliance) {
                    $("#view-clan-name").hide()
                    $("#create-alliance-button").hide()
                } else {
                    $("#view-clan-name").show()
                    $("#create-alliance-button").show()
                }
            }

            if (data.data.clan) {
                clanId = data.data.clan.id;
                $('#view-clan-name').show()
                $('#view-chat-alliance').show()
                document.querySelectorAll(".clan-user-name").forEach((e) => e.innerHTML = data.data.clan
                    .nom_clan)
                $('#clan-name-chat').text(data.data.clan.nom_clan)
                $("#user-clan-name").text(data.data.clan.nom_clan);
                $('#button-chat-alliance').show()
            } else {
                $("#view-clan-name").hide()
                $('#button-chat-alliance').hide()
            }
            $("#user-experience").text(data.data.user.experience);
            $("#user-argent").text(data.data.user.argent);
        }).catch((err) => {
        })
    }
    $('.change-stat').on('click', function() {
        let name = $(this).attr('name');
        let n = 'du';
        if (name == "semaine") {
            n = 'de la'
        }
        $('#periodStat').text(`${n} ${name}`)
    })
    $('.close-loader').on('click', function() {
        let name = $(this).attr('name');
        $('#' + name).addClass('hidden')
        $('#' + name).removeClass('flex')
        $('#loader-detail-alliance').hide()
        $('#loader-detail-base').hide();
        $('#loader-detail-unite').hide()
        $('#remove-money-animate').hide();
        $('#loader-personnel').hide()
    })
    $('.show-modal').on('click', function() {
        let name = $(this).attr('name');
        $('#' + name).addClass('flex')
        $('#' + name).removeClass('hidden')
        switch (name) {
            case "base-form-create-layout":
                $('#map').addClass("col-span-2")
                $('#map').removeClass("col-span-3")
                addMarkerToMap(posX, posY)
                break;
            case "shop-panel":
                // $('#info-user').removeClass("hidden")
                // $('#info-user').removeClass("relative")
                // $('#info-user').addClass(["max-sm:z-40", "max-sm:flex", "max-sm:left-0", "max-sm:fixed",
                //     "max-sm:top-0", "max-sm:bg-[#051129b3]", "max-sm:w-full", "max-sm:t-0",
                //     "max-sm:items-center"
                // ])
                break;
            case "alliance-panel":
                loadAlliance()
                break;
            case "personnels-panel":
                loadItemList()
                break;
            default:
                break;
        }

    });

    $('.tab-action').on('click', function() {
        let name = $(this).attr('name');
        $(this).removeClass('border-transparent')
        $(this).addClass('text-blue-600', 'border-blue-600')
        if (name == "unite") {
            $('#tab-action-personnel').addClass('border-transparent')
            $('#tab-action-personnel').removeClass('text-blue-600', 'border-blue-600')
            $('#table-unite-base-details-panel').show()
            $('#table-personnel-base-details-panel').hide()
        } else {
            $('#tab-action-unite').addClass('border-transparent')
            $('#tab-action-unite').removeClass('text-blue-600', 'border-blue-600')
            $('#table-unite-base-details-panel').hide()
            $('#table-personnel-base-details-panel').show()
        }
    });

    // Ajout des gestionnaires d'événements pour les boutons "Afficher"
    $('#show-vehicles').on('click', function() {
        $('#tab-action-unite').click()
        $('#tab-action-unite').get(0).scrollIntoView({
            behavior: 'smooth'
        });
    });

    $('#show-personnel').on('click', function() {
        $('#tab-action-personnel').click()
        $('#tab-action-personnel').get(0).scrollIntoView({
            behavior: 'smooth'
        });
    });

    $('.close-modal-button').on('click', function() {
        let name = $(this).attr('name');
        if (name == "base-form-create-layout") {
            $('#map').removeClass("col-span-2")
            $('#map').addClass("col-span-3")
            if (marker) {
                marker.remove();
            }
        }

        $('#' + name).addClass('hidden')
        $('#' + name).removeClass('flex')
        // clearTimer()
    });

    $('.close-action-modal').on('click', function() {
        let name = $(this).attr('name');
        $('#' + name).addClass('hidden')
        $('#' + name).removeClass('flex')
        // clearTimer()
    });

    $("#declined-button-confirm-action-panel").on('click', function() {
        $('#confirm-action-panel').hide();
    });


    $('#leave-alliance-btn').on('click', function() {
        if (confirm('Vous vous quitter cette alliance?')) {
            deleteAlliance(0)
        }
    })

    function leaveAlliance() {
        const idAlliance = $("#id-alliance").val();
        $.ajax({
            url: "/dashboard/api/leave-alliance",
            type: 'POST',
            data: JSON.stringify({
                "clan_id": idAlliance
            }),
            headers: {
                'X-CSRF-TOKEN': token,
                'Content-Type': 'application/json'
            },
            dataType: 'json',
            success: function(response) {
                $('#loader-detail-alliance').show()
                $('#select-alliance-button').hide()
                showToast(response.status, response.message);
                initDashboard();
                fetchDataAlliance(idAlliance)
                $('#loader-detail-alliance').hide()
                $('#title-chat').text('"Générale"')
                $('#messagesContainer-alliance').hide()
                $('#messagesContainer').show()
                $("#chat-form-alliance").hide()
                $("#chat-form").show()
                $('#view-chat-alliance').hide()
                $('#view-chat-generale').hide()
            },
            error: function(jqXHR, textStatus, errorThrown) {
                $('#loader-detail-alliance').hide()
                console.error('Error posting data:', textStatus,
                    errorThrown);
                showToast("danger",
                    "Une erreur c'est produite lors de l'execution de votre demande!")
            }
        });
    }

    function deleteAlliance(id) {
        const idAlliance = $("#id-alliance").val();
        $.ajax({
            url: "/dashboard/api/delete-alliance/" + id,
            type: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': token,
                'Content-Type': 'application/json'
            },
            dataType: 'json',
            success: function(response) {
                $('#loader-detail-alliance').show()
                showToast(response.status, "Alliance détruite");
                initDashboard();
                loadAlliance()
                $('#loader-detail-alliance').hide()
                $('#alliance-details').addClass('hidden')
                $('#alliance-details').removeClass('flex')
                $('#title-chat').text('"Générale"')
                $('#messagesContainer-alliance').hide()
                $('#messagesContainer').show()
                $("#chat-form-alliance").hide()
                $("#chat-form").show()
                $('#view-chat-alliance').hide()
                $('#view-chat-generale').hide()
            },
            error: function(jqXHR, textStatus, errorThrown) {
                $('#loader-detail-alliance').hide()
                console.error('Error posting data:', textStatus,
                    errorThrown);
                showToast("danger",
                    "Une erreur c'est produite lors de l'execution de votre demande!")
            }
        });
    }

    function confirmActionHandler(type, message, id) {
        $('#confirm-action-panel').show();
        $('#message-confirm-action-panel').text(message);
        const acceptButtonConfirmActionPanelHandler = document.getElementById('accept-button-confirm-action-panel')
        if (acceptButtonConfirmActionPanelHandler) {
            switch (type) {
                case "delete-alliance-3":
                    acceptButtonConfirmActionPanelHandler.removeEventListener('click', deleteAlliance, false)
                    acceptButtonConfirmActionPanelHandler.addEventListener('click', deleteAlliance, false)
                    break;
                case "leave-alliance":
                    acceptButtonConfirmActionPanelHandler.removeEventListener('click', leaveAlliance, false)
                    acceptButtonConfirmActionPanelHandler.addEventListener('click', leaveAlliance, false)
                    break;
                case "delete-alliance":
                    acceptButtonConfirmActionPanelHandler.removeEventListener('click', deleteAlliance(id), false)
                    acceptButtonConfirmActionPanelHandler.addEventListener('click', deleteAlliance(id), false)
                    break;
                default:
                    break;
            }
            $('#confirm-action-panel').hide()
        }
    }
    $('#destroy-alliance-btn').on('click', function() {
        if (confirm("Voulez vous detruire votre alliance?")) {
            deleteAlliance(0)
        }
    })

    $('#select-alliance-button').on('click', function() {
        $('#loader-detail-alliance').show()
        const idAlliance = $("#id-alliance").val();
        $.ajax({
            url: "/dashboard/api/enter-into-alliance",
            type: 'POST',
            data: JSON.stringify({
                "clan_id": idAlliance
            }),
            headers: {
                'X-CSRF-TOKEN': token,
                'Content-Type': 'application/json'
            },
            dataType: 'json',
            success: function(response) {
                showToast(response.status, response.message);
                initDashboard();
                fetchDataAlliance(idAlliance)
                $('#loader-detail-alliance').hide()
            },
            error: function(jqXHR, textStatus, errorThrown) {
                $('#loader-detail-alliance').hide()
                console.error('Error posting data:', textStatus,
                    errorThrown);
                showToast("danger",
                    "Une erreur c'est produite lors de l'execution de votre demande!")
            }
        });
    })

    $('#view-chat-alliance').on('click', function() {
        $('#title-chat').text('"' + $('#clan-name-chat').text() + '"')
        $('#messagesContainer-alliance').show()
        $('#messagesContainer').hide()
        $("#chat-form-alliance").show()
        $("#chat-form").hide()
        $('#view-chat-generale').show()
        $('#view-chat-alliance').hide()
        refreshDataPrivateChat()
    })

    $('#view-chat-generale').on('click', function() {
        $('#title-chat').text('"Générale"')
        $('#messagesContainer-alliance').hide()
        $('#messagesContainer').show()
        $("#chat-form-alliance").hide()
        $("#chat-form").show()
        $('#view-chat-alliance').show()
        $('#view-chat-generale').hide()
    })
    $('#view-chat-alliance2').on('click', function() {
        $('#title-chat2').text('"' + $('#clan-name-chat2').text() + '"')
        $('#messagesContainer-alliance2').show()
        $('#messagesContainer2').hide()
        $("#chat-form-alliance2").show()
        $("#chat-form2").hide()
        $('#view-chat-generale2').show()
        $('#view-chat-alliance2').hide()
        refreshDataPrivateChat()
    })

    $('#view-chat-generale2').on('click', function() {
        $('#title-chat2').text('"Générale"')
        $('#messagesContainer-alliance2').hide()
        $('#messagesContainer2').show()
        $("#chat-form-alliance2").hide()
        $("#chat-form2").show()
        $('#view-chat-alliance2').show()
        $('#view-chat-generale2').hide()
    })

    function fetchDataAlliance(id) {
        $('#loader-detail-alliance').show()
        const promise = fetch("/dashboard/api/get-alliance/" + id);
        promise.then((response) => {
            return response.json();
        }).then(function(data) {

            const htmlElement = document.getElementById("alliance-detail-users")
            $('#alliance-detail-banner').attr('src', "/" + data.data.info_clan.banner);
            if (data.data.checkIsMyClan) {
                $('#destroy-alliance-btn').show()
                $('#edit-alliance-btn').show()
                $('#upgrade-alliance-btn').show()
            } else {
                $('#destroy-alliance-btn').hide()
                $('#edit-alliance-btn').hide()
                $('#upgrade-alliance-btn').hide()
            }

            if (!data.data.checkIsMyClan && data.data.checkBelongClan) {
                $('#leave-alliance-btn').show()
            } else {
                $('#leave-alliance-btn').hide()
            }
            if (!data.data.checkIsMyClan && !data.data.checkBelongClan && !data.data.userIntoAnotherClan) {
                $('#select-alliance-button').show()
            } else {
                $('#select-alliance-button').hide()
            }
            if (data.data.noAccessToAlliance && data.data.last_alliance_belong_date && !data.data
                .checkIsMyClan) {
                $("#select-alliance-button").hide()
                $('#timer-alliance-detail-panel').show()
                timerRealTime(data.data.last_alliance_belong_date,
                    'timer-alliance-detail-panel', "Cette alliance sera disponible dans")
            } else {
                $('#timer-alliance-detail-panel').hide()
            }

            let messageUpgrade;

            switch (data.data.info_clan.niveau) {
                case 1:
                    messageUpgrade =
                        "Il vous faut 10000 points d'experience pour évoluer votre alliance au niveau 2"
                    break;
                case 2:
                    messageUpgrade =
                        "Il vous faut 25000 points d'experience pour évoluer votre alliance au niveau 3"
                    break;
                case 3:
                    messageUpgrade =
                        "Il vous faut 50000 points d'experience pour évoluer votre alliance au niveau 4"
                    break;
                case 4:
                    messageUpgrade =
                        "Il vous faut 100000 pièces pour évoluer votre alliance au niveau 5"
                    break;
                default:
                    messageUpgrade = "Votre alliance est au niveau max"
                    break;
            }

            $("#id-alliance").val(data.data.info_clan.id)
            $('#message-upgrade-alliance').text(messageUpgrade)
            experienceClan = data.data.info_clan.experience;
            niveauClan = data.data.info_clan.niveau;

            $('#alliance-detail-niveau-name').text(data.data.info_clan.niveau);
            $('#alliance-detail-experience').text(data.data.info_clan.experience);
            $('#alliance-detail-max').text(data.data.info_clan.max);
            $('#edit-clan-form-id').val(data.data.info_clan.id)
            $('#edit-clan-form-description').text(data.data.info_clan.description_clan)
            $('#alliance-detail-description').text(data.data.info_clan.description_clan)
            $('#alliance-detail-name').text(data.data.info_clan.nom_clan)
            $('#edit-clan-form-nom').val(data.data.info_clan.nom_clan)

            htmlElement.innerHTML = '';
            data.data.members.forEach((element, index) => {
                const divElement = document.createElement('div');
                divElement.innerHTML = `
                        <div
                            class="grid items-center justify-between grid-cols-3 odd:bg-blue-500 odd:text-white even:text-[#1a2539] even:bg-white p-1 items-center">
                                <div class="flex items-center justify-center gap-4">

                                    <span class="text-[14px]  font-medium">${element.pseudo}</span>
                                </div>
                                <div class="text-center">
                                    <span class="text-[14px]  font-medium ">0</span>
                                </div>

                                <div
                                    class="flex items-center justify-between gap-2 p-2 bg-[#1a2539] text-white font-medium rounded-md shadow-inner">
                                    <svg width="25px" height="25px" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg"
                                            fill="#fff  ">
                                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                            <g id="SVGRepo_iconCarrier">
                                                <path fill="#fff"
                                                    d="M256 29.816l-231 154v106.368l231-154 231 154V183.816zm0 128.043L105 259.783v90.283l151-101.925 151 101.925v-90.283zm0 112l-87 58.725v67.6l87-58 87 58v-67.6zm0 89.957l-87 58v64.368l87-58 87 58v-64.368z">
                                                </path>
                                            </g>
                                    </svg>
                                    <span>${element.experience}</span>
                                </div>
                        </div>
                           `;
                htmlElement.appendChild(divElement)
            });
            setTimeout(() => {
                $('#loader-detail-alliance').hide()
            }, 2000);

        }).catch((err) => {
        })
    }

    function fetchDataUnite(id) {
        $('#loader-detail-unite').show()
        const promise = fetch("/dashboard/api/get-unite/" + id);
        promise.then((response) => {
            return response.json();
        }).then(function(data) {

            $('#unite-detail-image').attr('src', "/" + data.data.unite.image);
            $('#unite-detail-description').text(data.data.typeUnite.description_type_unite);
            $('#unite-detail-speed').text(data.data.uniteUser.vitesse);
            $('#unite-detail-position').text(data.data.uniteUser.etat_unite ? data.data.uniteUser
                .etat_unite :
                "Non utilisée");
            $('#unite-detail-sante').text(data.data.uniteUser.sante + "%");
            $('#unite-detail-usure').text(data.data.uniteUser.taux_usure + "%");
            $('#unite-detail-places').text(data.data.uniteUser.places_disponible);
            $('#unite-detail-name').text(data.data.uniteUser.nom);
            $('#unite-detail-type-unite').text(data.data.typeUnite.nom_type_unite);

        }).catch((err) => {
        }).finally(() => {
            setTimeout(() => {
                $('#loader-detail-unite').hide()
            }, 1500);
        })
    }

    function purchaseFormation(item) {
        $('#loader-personnel-card').show()
        $.ajax({
            url: "/dashboard/api/purchase-formation",
            type: 'POST',
            data: JSON.stringify(item),
            headers: {
                'X-CSRF-TOKEN': token,
                'Content-Type': 'application/json'
            },
            dataType: 'json',
            success: function(response) {
                $('#loader-personnel-card').hide()
                fetchDataFormation(item.personnel_id)
                loadItemList()
                moneyLeaveAnimation(item.prix, false)
                showToast(response.status, response.message);
                initDashboard()

            },
            error: function(jqXHR, textStatus, errorThrown) {
                $('#loader-personnel-card').hide()
                console.error('Error posting data:', textStatus,
                    errorThrown);
                showToast("danger",
                    "Une erreur c'est produite lors de l'execution de votre demande!")

            }
        });
    }

    $('#button-upgrade-alliance').on('click', async (e) => {

        $('#loader').show()
        let upgradeBol = false;
        switch (niveauClan) {
            case 1:
                if (experienceClan >= 10000) {
                    upgradeBol = true;
                }
                break;
            case 2:
                if (experienceClan >= 25000) {
                    upgradeBol = true;
                }
                break;
            case 3:
                if (experienceClan >= 50000) {
                    upgradeBol = true;
                }
                break;
            case 4:
                if (experienceClan >= 100000) {
                    upgradeBol = true;
                }
                break;
            default:
                upgradeBol = false
                break;
        }
        if (!upgradeBol) {
            $('#message-error-upgrade-alliance').text("Vous pouvez pas monter de niveau");
            $('#loader').hide();
        } else {
            $.ajax({
                url: '/dashboard/api/upgrade-alliance/' + $('#edit-clan-form-id').val(),
                type: 'PUT',
                headers: {
                    'X-CSRF-TOKEN': token,
                    'Content-Type': 'application/json'
                },
                dataType: 'json',
                success: function(response) {
                    loadAlliance()
                    $('#message-upgrade-alliance').text(response.data.message)
                    showToast(response.status, response.message);
                    initDashboard()
                    $('#modal-upgrade-alliance').addClass('hidden')
                    $('#modal-upgrade-alliance').removeClass('flex')
                    fetchDataAlliance($('#edit-clan-form-id').val())
                    $('#loader').hide()
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    showToast("danger",
                        "Impossible de modifier un alliance pour le moment")
                    $('#loader').hide()
                }
            });
        }
    })



    function fetchDataFormation(id) {
        $('#loader-personnel-card').show();

        const promise = fetch("/dashboard/api/get-formations/" + id);
        promise.then((response) => {
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            return response.json();
        }).then(function(data) {
            const htmlElement = document.getElementById('formation-list');
            if (!htmlElement) {
                console.error("L'élément HTML 'formation-list' n'a pas été trouvé.");
                return;
            }

            htmlElement.innerHTML = "";

            data.data.forEach((element, index) => {

                const divElement = document.createElement('div');

                divElement.addEventListener('click', () => {
                    if (!element.isLocked && !element.isBuy) {
                        purchaseFormation(element);
                    }
                });

                divElement.classList.add(
                    "w-fit", "text-center", "h-96", "w-full",
                    `${!element.isBuy ? "cursor-pointer" : "cursor-default"}`,
                    "flex", "flex-col", "items-center", "justify-start",
                    `${(element.isBuy && element.isFinish) ? "grayscale" : "grayscale-0"}`,
                    "shadow-xl", "bg-[#080b10]", "overflow-hidden",
                    "text-sm", "relative", "rounded-md"
                );

                divElement.innerHTML = `
                <div class="flex flex-col items-center justify-center w-full bg-blue-500 h-[100px]">
                    <div class="text-[14px] bg-white size-8 flex justify-center items-center rounded-full font-semibold text-center text-blue-500 uppercase">${index + 1}</div>
                    <h4 class="my-2 text-[14px] font-thin text-center text-white uppercase">${element.libelle}</h4>
                </div>
                ${(element.isBuy && element.isFinish) ? 
                    `<h2 class="text-center text-[18px] text-white my-2">Formation terminée</h2>` : 
                    `<h2 class="text-center text-[16px] text-white my-2">Durée de la formation</h2>
                     <h2 class="text-center text-[18px] text-white my-2">${element.temps_formation}</h2>`}
                <p class="text-center p-4 text-white text-[12px]">
                    ${element.description ? element.description : "Aucune description pour cette formation"}
                </p>
                ${!element.isBuy ? 
                    `<button type="button" class="gap-2 rounded-xl mx-auto mb-2 p-2.5 px-4 fill-white bg-white hover:bg-[#15244c] w-fit flex items-center h-fit text-[#15244c] font-bold hover:text-white text-left text-sm transition-all cursor-pointer">Acheter
                        <span class="font-bold text-yellow-500 ">${element.prix}</span>
                        <img width="32" height="32" src="{{ url('assets/images/icons8-money-48.png') }}" alt="" srcset="">
                    </button>` : ``}
                ${element.isLocked ? 
                    `<div class="absolute top-0 left-0 z-10 flex items-center justify-center w-full h-full mx-auto bg-black/60">
                        <img width="64" height="64" src="{{ url('assets/images/locked-svgrepo-com.png') }}" alt="" srcset="">
                    </div>` : ""}
            `;

                if (element.isBuy && !element.isFinish) {
                    const divElementTimer = document.createElement('div');
                    divElementTimer.classList.add(
                        "w-full", "py-4", "text-yellow-400", "bottom-0", "text-xl", "left-0",
                        "absolute"
                    );
                    divElementTimer.id = "timer-card-personnel" + element.id;

                    countDownTimer(
                        element.date_fin, 
                        divElementTimer, 
                        id, 
                        "Fin de la formation dans",
                        "end-formation", 
                        "action",
                    );
                    divElement.appendChild(divElementTimer);
                }
                htmlElement.appendChild(divElement);
            });

        }).catch((err) => {
            console.error("Erreur lors de la récupération des données:", err);
        }).finally(() => {
            setTimeout(() => {
                $('#loader-personnel-card').hide();
            }, 1500);
        });
    }


    function hideToast() {
        $("#toast-success").hide(1000);
        $("#toast-danger").hide(1000);
        $("#toast-warning").hide(1000);
    }

    function showToast(type, message) {
        switch (type) {
            case "success":
                $("#toast-success").show(1000);
                $("#toast-success p").text(message);
                setTimeout(() => {
                    $("#toast-success").hide(1000);
                }, 15000);
                break;
            case "danger":
                $("#toast-danger").show(1000);
                $("#toast-danger p").text(message);
                setTimeout(() => {
                    $("#toast-danger").hide(1000);
                }, 5000);
                break;
            case "warning":
                $("#toast-warning").show(1000);
                $("#toast-warning p").text(message);
                setTimeout(() => {
                    $("#toast-warning").hide(1000);
                }, 5000);
                break;
            default:
                break;
        }
    }

    function moneyLeaveAnimation(amount, bol) {
        let signe = bol ? "+" : "-";
        $('#remove-money-animate').text(signe + amount);
        $('#remove-money-animate').show(1000);
        setTimeout(() => {
            $('#remove-money-animate').hide();
        }, 2000);
    }

    function purchaseItem(type, data) {
        let url;
        switch (type) {
            case "unite":
                url = `/dashboard/api/purchase-unite`;
                break;
            case "personnel":
                url = `/dashboard/api/purchase-personnel`;
                break;
            case "equipment":
                url = "/dashboard/api/purchase-equipment";
                break;
            default:
                url = ""
                break;
        }
        if (url != "") {
            $.ajax({
                url: url,
                type: 'POST',
                data: JSON.stringify(data),
                headers: {
                    'X-CSRF-TOKEN': token,
                    'Content-Type': 'application/json'
                },
                dataType: 'json',
                success: function(response) {
                    $('#loader').hide()
                    moneyLeaveAnimation(data.prix, false)
                    showToast(response.status, response.message);
                    initDashboard()
                    $('.close-action-modal').click()
                    loadItemList()
                    loadBase()
                    loadBaseById(baseId);
                    if (type != "equipment") {
                        loadMission()
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    $('#loader').hide()
                    console.error('Error posting data:', jqXHR, textStatus,
                        errorThrown);
                    showToast("danger",
                        "Une erreur c'est produite lors de l'execution de votre demande!")

                }
            });
        } else {
            showToast("warning", "Aucune demande à été envoyé");
        }
    }

    $('.purchase-item').on('submit', async (e) => {
        e.preventDefault()
        $('#loader').show()
        const form = $(e.target)
        const formData = new FormData(form[0])
        let formValues;
        if (e.target.name == "unite" || e.target.name == "personnel") {
            formData.append('base_id', baseId);
            formData.append('etat_unite', 'base');
            formData.append('etat_formation_personnel', 'base');
            formValues = Object.fromEntries(formData.entries())
        } else {
            formValues = Object.fromEntries(formData.entries())
        }
        if (formValues) {
            purchaseItem(e.target.name, formValues);
        }
    })

    $('#search-personnel-form').on('submit', async function(e) {
        e.preventDefault()
        $('#input-error-search-alliance').text('')
        const personnelResult = personnels.filter(e => e)
        listItemListToHtml('personnel-list', data.data.personnels, "personnel")
    })

    $('#search-alliance-form').on('submit', async function(e) {
        e.preventDefault()
        $('#input-error-search-alliance').text('')
        const form = $(e.target)
        const formData = new FormData(form[0])
        const data = Object.fromEntries(formData.entries())
        if (data.name.trim() === "@all") {
            loadAlliance()
        } else {
            if (data.name.trim() != "") {
                $('#alliance-list').html('<p class="text-white">Chagement du resultat...</p>')
                $.ajax({
                    url: '/dashboard/api/search-alliances?page=1',
                    type: 'POST',
                    data: JSON.stringify(data),
                    headers: {
                        'X-CSRF-TOKEN': token,
                        'Content-Type': 'application/json'
                    },
                    dataType: 'json',
                    success: function(response) {
                        if (response.data.length != 0) {
                            listAllianceToHtml('alliance-list', response.data)
                        } else {
                            $('#alliance-list').html(
                                '<p class="text-white">Aucun resultat...</p>')
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        $('#alliance-list').html(
                            '<p class="text-white">Aucun resultat...</p>')
                        console.error('Error posting data:', textStatus,
                            errorThrown);
                        showToast("danger",
                            "Une erreur c'est produite lors de l'execution de votre demande!"
                        )
                    }
                });
            } else {
                $('#input-error-search-alliance').text('Champ de recherche vide')
            }
        }
    })

    $('#edit-clan-form').on('submit', async function(e) {
        e.preventDefault()
        $('#loader').show()
        const form = $(e.target)
        const formData = new FormData(form[0])
        const data = Object.fromEntries(formData.entries())


        if (data.nom_clan.trim().search("@all") != -1 || data.nom_clan.trim() == "@all") {
            $('#message-error-create-alliance-edit').text("Ce mot est reservé")
        } else {
            $.ajax({
                url: '/dashboard/api/update-alliance/' + $('#edit-clan-form-id').val(),
                type: 'PUT',
                data: JSON.stringify({
                    'description_clan': $('#edit-clan-form-description').val(),
                    'nom_clan': $('#edit-clan-form-nom').val(),
                }),
                headers: {
                    'X-CSRF-TOKEN': token,
                    'Content-Type': 'application/json'
                },
                dataType: 'json',
                success: function(response) {
                    loadAlliance()
                    $('#success-alliance-message-alliance').text(response.data.message)
                    showToast(response.status, response.message);
                    initDashboard()
                    $('#modal-form-edit').addClass('hidden')
                    $('#modal-form-edit').removeClass('flex')
                    fetchDataAlliance($('#edit-clan-form-id').val())
                    $('#loader').hide()
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    showToast("danger",
                        "Impossible de modifier un alliance pour le moment")
                    $('#loader').hide()
                }
            });
        }
    })

    $('#create-clan-form').on('submit', async function(e) {
        e.preventDefault()
        $('#loader').show()
        const form = $(e.target)
        const formData = new FormData(form[0])
        const data = Object.fromEntries(formData.entries())


        if (data.nom_clan.trim().search("@all") != -1 || data.nom_clan.trim() == "@all") {
            $('#message-error-create-alliance').text("Ce mot est reservé")
        } else {
            $.ajax({
                url: '/dashboard/api/create-alliance',
                type: 'POST',
                data: JSON.stringify(data),
                headers: {
                    'X-CSRF-TOKEN': token,
                    'Content-Type': 'application/json'
                },
                dataType: 'json',
                success: function(response) {
                    loadAlliance()
                    $('#success-alliance-message').text(response.data.message)
                    showToast(response.status, response.message);
                    $('#create-alliance-button').remove()
                    moneyLeaveAnimation(data.prix, false)
                    initDashboard()
                    $('#modal-form').addClass('hidden')
                    $('#modal-form').removeClass('flex')
                    $('#loader').hide()
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    showToast("danger",
                        "Impossible de créer un alliance pour le moment")
                    $('#loader').hide()
                }
            });
        }

    })
    let panelOptionShow = false;
    $('#show-panel-option').on('click', () => {
        if (panelOptionShow) {
            $('#panel-option').addClass('hidden');
            $('#panel-option').removeClass('flex');

        } else {
            $('#panel-option').removeClass('hidden');
            $('#panel-option').addClass('flex');
        }
        panelOptionShow = !panelOptionShow;
    })

    function setBg() {
        let randomColor = Math.floor(Math.random() * 16777215).toString(16);
        if (randomColor == "ffffff") {
            randomColor = Math.floor(Math.random() * 16777215).toString(16);
        }
        return randomColor
    }

    function refreshData() {
        let messagesContainer = document.getElementById("messagesContainer");
        messagesContainer.scrollTop = messagesContainer
            .scrollHeight;
        $("#messagesContainer").animate({
            scrollTop: 20000000
        }, "slow");
        let messagesContainer2 = document.getElementById("messagesContainer2");
        messagesContainer2.scrollTop = messagesContainer2
            .scrollHeight;
        $("#messagesContainer2").animate({
            scrollTop: 20000000
        }, "slow");
        const wesPromiseMission = fetch("/dashboard/api/get-public-chat-message");
        wesPromiseMission.then((response) => {
            return response.json();
        }).then(function(data) {
            $.each(data, (index, val) => {
                $('#MessageSentContent').append(
                    `<div  style="font-family: 'Inter'" class="flex ${"{{ Auth::guard('appuser')->user()->id }}" == val.id ? 'justify-end' : 'justify-start'}  items-start gap-3">
                            <div class=" ${"{{ Auth::guard('appuser')->user()->id }}" == val.id ? 'bg-[#151b28]' : 'bg-white'}  shadow-md text-white w-fit min-w-40 rounded-md p-1.5">
                                <span style="color: #${setBg()}; " class="font-thin">${val.pseudo}</span>
                                <p class="text-sm ${"{{ Auth::guard('appuser')->user()->id }}" == val.id ? ' text-white' : ' text-[#1a2539]'}">${val.text}</p>
                            </div>
                        </div>
                    `);
                $('#MessageSentContent2').append(
                    `<div  style="font-family: 'Inter'" class="flex ${"{{ Auth::guard('appuser')->user()->id }}" == val.id ? 'justify-end' : 'justify-start'}  items-start gap-3">
                            <div class=" ${"{{ Auth::guard('appuser')->user()->id }}" == val.id ? 'bg-[#151b28]' : 'bg-white'}  shadow-md text-white w-fit min-w-40 rounded-md p-1.5">
                                <span style="color: #${setBg()}; " class="font-thin">${val.pseudo}</span>
                                <p class="text-sm ${"{{ Auth::guard('appuser')->user()->id }}" == val.id ? ' text-white' : ' text-[#1a2539]'}">${val.text}</p>
                            </div>
                        </div>
                    `);
            })
            messagesContainer = document.getElementById("messagesContainer");
            messagesContainer.scrollTop = messagesContainer
                .scrollHeight;
            $("#messagesContainer").animate({
                scrollTop: 20000000
            }, "slow");
            messagesContainer2 = document.getElementById("messagesContainer2");
            messagesContainer2.scrollTop = messagesContainer2
                .scrollHeight;
            $("#messagesContainer2").animate({
                scrollTop: 20000000
            }, "slow");

        })
        setTimeout(() => {
            window.Echo.channel('public-chat').listen('PublicChat', (e) => {
                messagesContainer = document.getElementById("messagesContainer");
                messagesContainer.scrollTop = messagesContainer
                    .scrollHeight;
                $("#messagesContainer").animate({
                    scrollTop: 20000000
                }, "slow");
                $('#MessageSentContent').append(`
                        <div style="font-family: 'Inter'" class="flex items-start  ${"{{ Auth::guard('appuser')->user()->id }}" == e.message.user_id ? 'justify-end' : 'justify-start'} gap-3">
                            <div class="  ${"{{ Auth::guard('appuser')->user()->id }}" == e.message.user_id ? 'bg-[#151b28]' : 'bg-white'} shadow-md text-white w-fit min-w-40 rounded-md p-1.5">
                                <span style="color:  #${setBg()}; " class="font-thin">${e.name}</span>
                                <p class="text-sm ${"{{ Auth::guard('appuser')->user()->id }}" == e.message.user_id ? ' text-white' : ' text-[#1a2539]'}">${e.message.text}</p>
                            </div>
                        </div>
            `);
                messagesContainer2 = document.getElementById("messagesContainer2");
                messagesContainer2.scrollTop = messagesContainer2
                    .scrollHeight;
                $("#messagesContainer2").animate({
                    scrollTop: 20000000
                }, "slow");
                $('#MessageSentContent').append(`
                        <div style="font-family: 'Inter'" class="flex items-start  ${"{{ Auth::guard('appuser')->user()->id }}" == e.message.user_id ? 'justify-end' : 'justify-start'} gap-3">
                            <div class="  ${"{{ Auth::guard('appuser')->user()->id }}" == e.message.user_id ? 'bg-[#151b28]' : 'bg-white'} shadow-md text-white w-fit min-w-40 rounded-md p-1.5">
                                <span style="color:  #${setBg()}; " class="font-thin">${e.name}</span>
                                <p class="text-sm ${"{{ Auth::guard('appuser')->user()->id }}" == e.message.user_id ? ' text-white' : ' text-[#1a2539]'}">${e.message.text}</p>
                            </div>
                        </div>
            `);
            })
        }, 1500);
    }

    $('#chat-form').on('submit', (e) => {
        e.preventDefault();
        $('#button-chat').attr('disabled', true);
        $('#button-chat').text('...Chargement');
        const message = $('#message-input').val();
        const messagesContainer = document.getElementById("messagesContainer");
        messagesContainer.scrollTop = messagesContainer
            .scrollHeight;

        $.ajax({
            url: `/dashboard/api/send-message-public-chat`, // Replace with the target API URL
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': token
            },
            data: {
                "text": $('#message-input').val()
            },
            dataType: "json",
            success: function(response) {

                $('#message-input').attr('value', '');
                $('#message-input').val('');
                $('#button-chat').attr('disabled', false);
                $('#button-chat').text('Envoyer');
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error('Error posting data:', jqXHR, textStatus, errorThrown);
                $('#message-input').val(message);
                $('#button-chat').attr('disabled', false);
                $('#button-chat').text('Envoyer');
            }
        });
    })
    $('#chat-form2').on('submit', (e) => {
        e.preventDefault();
        $('#button-chat2').attr('disabled', true);
        $('#button-chat2').text('...Chargement');
        const message = $('#message-input').val();
        const messagesContainer2 = document.getElementById("messagesContainer2");
        messagesContainer2.scrollTop = messagesContainer2
            .scrollHeight;

        $.ajax({
            url: `/dashboard/api/send-message-public-chat`, // Replace with the target API URL
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': token
            },
            data: {
                "text": $('#message-input2').val()
            },
            dataType: "json",
            success: function(response) {

                $('#message-input2').attr('value', '');
                $('#message-input2').val('');
                $('#button-chat2').attr('disabled', false);
                $('#button-chat2').text('Envoyer');
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error('Error posting data:', jqXHR, textStatus, errorThrown);
                $('#message-input2').val(message);
                $('#button-chat2').attr('disabled', false);
                $('#button-chat2').text('Envoyer');
            }
        });
    })

    function refreshDataPrivateChat() {
        let messagesContainer = document.getElementById("messagesContainer-alliance");
        messagesContainer.scrollTop = messagesContainer
            .scrollHeight;
        $("#messagesContainer-alliance").animate({
            scrollTop: 20000000
        }, "slow");
        const wesPromiseMission = fetch("/dashboard/api/get-private-chat-message/" + clanId);
        wesPromiseMission.then((response) => {
            return response.json();
        }).then(function(data) {
            $('#MessageSentContent-alliance').append('')
            $.each(data, (index, val) => {
                $('#MessageSentContent-alliance').append(
                    `<div  style="font-family: 'Inter'" class="flex ${"{{ Auth::guard('appuser')->user()->id }}" == val.id ? 'justify-end' : 'justify-start'}  items-start gap-3">
                            <div class=" ${"{{ Auth::guard('appuser')->user()->id }}" == val.id ? 'bg-[#151b28]' : 'bg-white'}  shadow-md text-white w-fit min-w-40 rounded-md p-1.5">
                                <span style="color: #${setBg()}; " class="font-thin">${val.pseudo}</span>
                                <p class="text-sm ${"{{ Auth::guard('appuser')->user()->id }}" == val.id ? ' text-white' : ' text-[#1a2539]'}">${val.text}</p>
                            </div>
                        </div>
                    `);
            })
            messagesContainer = document.getElementById("messagesContainer-alliance");
            messagesContainer.scrollTop = messagesContainer
                .scrollHeight;
            $("#messagesContainer-alliance").animate({
                scrollTop: 20000000
            }, "slow");

        })

        window.Echo.channel("chat.1").listen(
            'MessageSent', (e) => {
                messagesContainer = document.getElementById("messagesContainer-alliance");
                messagesContainer.scrollTop = messagesContainer
                    .scrollHeight;
                $("#messagesContainer-alliance").animate({
                    scrollTop: 20000000
                }, "slow");
                $('#MessageSentContent-alliance').append(`
                        <div style="font-family: 'Inter'" class="flex items-start  ${"{{ Auth::guard('appuser')->user()->id }}" == e.message.user_id ? 'justify-end' : 'justify-start'} gap-3">
                            <div class="  ${"{{ Auth::guard('appuser')->user()->id }}" == e.message.user_id ? 'bg-[#151b28]' : 'bg-white'} shadow-md text-white w-fit min-w-40 rounded-md p-1.5">
                                <span style="color:  #${setBg()}; " class="font-thin">${e.name}</span>
                                <p class="text-sm ${"{{ Auth::guard('appuser')->user()->id }}" == e.message.user_id ? ' text-white' : ' text-[#1a2539]'}">${e.message.text}</p>
                            </div>
                        </div>
            `);
            })

    }


    function refreshDataPrivateChat2() {
        let messagesContainer2 = document.getElementById("messagesContainer2-alliance");
        messagesContainer2.scrollTop = messagesContainer2
            .scrollHeight;
        $("#messagesContainer2-alliance").animate({
            scrollTop: 20000000
        }, "slow");
        const wesPromiseMission = fetch("/dashboard/api/get-private-chat-message/" + clanId);
        wesPromiseMission.then((response) => {
            return response.json();
        }).then(function(data) {
            $('#MessageSentContent-alliance').append('')
            $.each(data, (index, val) => {
                $('#MessageSentContent-alliance').append(
                    `<div  style="font-family: 'Inter'" class="flex ${"{{ Auth::guard('appuser')->user()->id }}" == val.id ? 'justify-end' : 'justify-start'}  items-start gap-3">
                            <div class=" ${"{{ Auth::guard('appuser')->user()->id }}" == val.id ? 'bg-[#151b28]' : 'bg-white'}  shadow-md text-white w-fit min-w-40 rounded-md p-1.5">
                                <span style="color: #${setBg()}; " class="font-thin">${val.pseudo}</span>
                                <p class="text-sm ${"{{ Auth::guard('appuser')->user()->id }}" == val.id ? ' text-white' : ' text-[#1a2539]'}">${val.text}</p>
                            </div>
                        </div>
                    `);
            })
            messagesContainer2 = document.getElementById("messagesContainer2-alliance");
            messagesContainer2.scrollTop = messagesContainer2
                .scrollHeight;
            $("#messagesContainer2-alliance").animate({
                scrollTop: 20000000
            }, "slow");

        })

        window.Echo.channel("chat.1").listen(
            'MessageSent', (e) => {
                messagesContainer2 = document.getElementById("messagesContainer2-alliance");
                messagesContainer2.scrollTop = messagesContainer2
                    .scrollHeight;
                $("#messagesContainer2-alliance").animate({
                    scrollTop: 20000000
                }, "slow");
                $('#MessageSentContent-alliance').append(`
                        <div style="font-family: 'Inter'" class="flex items-start  ${"{{ Auth::guard('appuser')->user()->id }}" == e.message.user_id ? 'justify-end' : 'justify-start'} gap-3">
                            <div class="  ${"{{ Auth::guard('appuser')->user()->id }}" == e.message.user_id ? 'bg-[#151b28]' : 'bg-white'} shadow-md text-white w-fit min-w-40 rounded-md p-1.5">
                                <span style="color:  #${setBg()}; " class="font-thin">${e.name}</span>
                                <p class="text-sm ${"{{ Auth::guard('appuser')->user()->id }}" == e.message.user_id ? ' text-white' : ' text-[#1a2539]'}">${e.message.text}</p>
                            </div>
                        </div>
            `);
            })

    }

    $('#chat-form-alliance').on('submit', (e) => {
        e.preventDefault();
        $('#button-chat-alliance').attr('disabled', true);
        $('#button-chat-alliance').text('...Chargement');
        const message = $('#message-input-alliance').val();
        const messagesContainer = document.getElementById("messagesContainer-alliance");
        messagesContainer.scrollTop = messagesContainer
            .scrollHeight;
        $.ajax({
            url: `/dashboard/api/send-message-private-chat`, // Replace with the target API URL
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': token
            },
            data: {
                "text": $('#message-input-alliance').val(),
                "clan_id": clanId ?? 0
            },
            dataType: "json",
            success: function(response) {
                $('#message-input-alliance').attr('value', '');
                $('#message-input-alliance').val('');
                $('#button-chat-alliance').attr('disabled', false);
                $('#button-chat-alliance').text('Envoyer');
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error('Error posting data:', jqXHR, textStatus, errorThrown);
                $('#message-input-alliance').val(message);
                $('#button-chat-alliance').attr('disabled', false);
                $('#button-chat-alliance').text('Envoyer');
            }
        });
    })
    $('#chat-form-alliance2').on('submit', (e) => {
        e.preventDefault();
        $('#button-chat-alliance2').attr('disabled', true);
        $('#button-chat-alliance2').text('...Chargement');
        const message = $('#message-input-alliance2').val();
        const messagesContainer2 = document.getElementById("messagesContainer2-alliance");
        messagesContainer2.scrollTop = messagesContainer2
            .scrollHeight;
        $.ajax({
            url: `/dashboard/api/send-message-private-chat`, // Replace with the target API URL
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': token
            },
            data: {
                "text": $('#message-input-alliance2').val(),
                "clan_id": clanId ?? 0
            },
            dataType: "json",
            success: function(response) {
                $('#message-input-alliance2').attr('value', '');
                $('#message-input-alliance2').val('');
                $('#button-chat-alliance2').attr('disabled', false);
                $('#button-chat-alliance2').text('Envoyer');
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error('Error posting data:', jqXHR, textStatus, errorThrown);
                $('#message-input-alliance2').val(message);
                $('#button-chat-alliance2').attr('disabled', false);
                $('#button-chat-alliance2').text('Envoyer');
            }
        });
    })

    $('.check-spc').on('click', function(e) {
        let name = $(this).attr('name');
        const checkSpc = document.querySelectorAll('.check-spc');
        checkSpc.forEach(element => {
            if (element.name != name) {
                element.classList.remove('shadow-xl');
                element.classList.replace('border-purple-400', 'border-white');
            } else {
                element.classList.add('shadow-xl');
                element.classList.replace('border-white', 'border-purple-400');
            }
        });
        let bannerClan = document.getElementById("banner_clan");
        bannerClan.value = name;
    });
    $('.check-spc-2').on('click', function(e) {
        let name = $(this).attr('name');
        const checkSpc = document.querySelectorAll('.check-spc-2');
        checkSpc.forEach(element => {
            if (element.name != name) {
                element.classList.remove('shadow-xl');
                element.classList.replace('border-blue-400', 'border-white');
            } else {
                element.classList.add('shadow-xl');
                element.classList.replace('border-white', 'border-blue-400');
            }
        });
        let chackInput = document.getElementById("check-input");
        chackInput.value = name;
    });
    //#endregion End Other data


    //#region Map data
    function getRandomArbitrary(min, max) {
        return Math.random() * (max - min) + min;
    }

    function loadDataMap() {
        const promise = fetch("/dashboard/api/get-map-data");
        promise.then((response) => {
            return response.json();
        }).then(function(data) {

            const resultat = data.data;
            const typeBaseCreateFormElement = document.getElementById("type_base_id_create");
            if (typeBaseCreateFormElement) {
                if (resultat.types.length > 0) {
                    resultat.types.forEach((e) => {
                        typeBaseCreateFormElement.innerHTML +=
                            `<option value="${e.id}">${e.label}</option>`;
                    })
                }
            }
            if (data.data.totalMissions > 2) {
                lockAlertMission = true;
                const alertMission = document.getElementById("alert-mission");
                if (alertMission) {
                    alertMission.innerHTML = ""
                }
            }
            if (!lockAlertMission) {
                loadMission()
            }
            loadBase()
            $("#loading").hide();
        }).catch((err) => {
            $("#loading").hide();
        })
    }

    let allowRouteUpdate = false;  // Flag to control route update


 
    let missionId;

    function getDistanceBetweenTwoPoints(position_x, position_y, target_x, target_y) {
        const radiusKm = 30; // Rayon de 30 km

        // Conversion des degrés en radians
        const toRadians = (degrees) => degrees * (Math.PI / 180);

        const R = 6371; // Rayon de la Terre en km

        const dLat = toRadians(target_x - position_x);
        const dLon = toRadians(target_y - position_y);

        const a =
            Math.sin(dLat / 2) * Math.sin(dLat / 2) +
            Math.cos(toRadians(position_x)) * Math.cos(toRadians(target_x)) *
            Math.sin(dLon / 2) * Math.sin(dLon / 2);

        const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));

        const distance = R * c; // Distance en km

        // Retourne true si la distance est inférieure ou égale à 30 km, sinon false
        // return distance <= radiusKm;
        return distance;
    }

    let intervalLoadMission = undefined;

    function loadMission() {
        // Réinitialiser les variables liées au compteur
        if (realTimer2) {
            clearInterval(realTimer2);
            realTimer2 = null;
        }
        if (intervalLoadMission) {
            clearInterval(intervalLoadMission);
            intervalLoadMission = null;
        }

        try {
            const alertMission = document.getElementById("message-mission-information");
            const alertMissionDiv = document.getElementById("alert-mission");

            // Nettoyer les messages précédents
            alertMissionDiv.innerHTML = "";
            alertMission.innerHTML = "";

            let timer = getRandomArbitrary(10, 20);
            let time = timer;

            checkUserGameData().then(function(res) {
                if (res.mission_pending) {
                    return;
                }

                const wesPromiseMission = fetch("/dashboard/api/get-mission");
                wesPromiseMission.then((response) => {
                    return response.json();
                }).then(function(data) {
                    if (data.data && data.data.bases == 0 || res && res.unities.length == 0) {
                        timer = 0;
                        time = 0;
                        if (intervalLoadMission) {
                            clearInterval(intervalLoadMission);
                            intervalLoadMission = null;
                        }
                        lockAlertMission = true;
                        alertMissionDiv.innerHTML = "";
                        alertMission.innerHTML = `<p class='p-4 text-white bg-black/50'>
                        Bonjour, je suis Olivier de la régulation du SAMU. Une mission est en cours sur votre secteur. <br>
                        Vous devriez créer une base SAMU en France via le bouton "Nouvelle base" et y ajouter des unités pour pouvoir intervenir.
                    </p>`;
                        return;
                    } else {
                        alertMission.innerHTML = "";
                        alertMissionDiv.innerHTML = "";
                    }

                    if (alertMission) {
                        if (intervalLoadMission) {
                            clearInterval(intervalLoadMission);
                            intervalLoadMission = null;
                        }
                        intervalLoadMission = setInterval(() => {
                            time = Math.abs(Math.floor(time - 1));
                            alertMissionDiv.innerHTML = "";
                            alertMission.innerHTML =
                                "<p class='p-4 text-white bg-black/50'>Votre mission arrive dans " +
                                time +
                                " secondes  </p>";
                            if (time < 1) {
                                alertMission.innerHTML = "";
                                alertMissionDiv.innerHTML = "";
                                clearInterval(intervalLoadMission);
                                intervalLoadMission = null;
                            }
                        }, 1000);
                    }        

                    if (data.data !== "no more mission") {

                        if (userGameDataTimeout) {
                            clearTimeout(userGameDataTimeout);
                        }

                        missionId = data.data.mission.id;
                        const t = document.getElementById('alert-mission');
                        userGameDataTimeout = setTimeout(() => {
                            const elemTimer = document.createElement('div');
                            const buttonSend = document.createElement('button');
                            const buttonReject = document.createElement('button');
                            const div = document.createElement('div');
                            div.classList.add("flex", "gap-2", "items-center", "sm:flex-row",
                                "flex-col");
                            const buttonFocus = document.createElement('button');
                            const add = document.createElement("div");
                            add.classList.add("text-white", "p-2");
                            t.classList.add('bg-black/50', "p-2", "flex", "flex-col", "h-fit");
                            buttonSend.name = "mission-form-panel";
                            buttonSend.innerText = "Accepter la mission";
                            buttonSend.classList.add("show-modal", "sm:w-fit", "w-full",
                                "text-sm", "text-white/70", "transition-all", "rounded-md",
                                "gap-2", "p-4", "fill-orange-500", "bg-[#151b28]",
                                "hover:bg-orange-500");
                            buttonReject.classList.add("show-modal", "sm:w-fit", "w-full",
                                "text-sm", "text-white/70", "transition-all", "rounded-md",
                                "gap-2", "p-4", "fill-orange-500", "bg-[#151b28]",
                                "hover:bg-orange-500");
                            buttonReject.innerText = "Refuser la mission";
                            buttonSend.addEventListener('click', () => {
                                $('#mission-form-panel').addClass("flex");
                                $('#mission-form-panel').removeClass("hidden");
                            });

                            buttonReject.addEventListener('click', () => {
                                const alertMission = document.getElementById(
                                    "alert-mission");
                                if (alertMission) {
                                    alertMission.innerHTML = "";
                                    alertMissionDiv.innerHTML = "";
                                }
                                markerMission.remove();
                                clearTimer(realTimer2);
                                setTimeout(() => {
                                    loadMission();
                                }, getRandomArbitrary(10000, 20000));
                            });
                            add.id = "lieu-regulation-samu";
                            elemTimer.classList.add('text-white', 'bg-red-500', "sm:w-fit",
                                "w-full", "p-2");

                            countDownTimer2(data.data.temps_restant, elemTimer, "Message", "",
                                "");
                            const htmlElement = `
                        <div id="card-mission" hidden style="display: flex;"
                                class="flex flex-col items-center justify-between gap-2 text-sm alert rounded-xl backdrop-blur-sm w-fit">
                                <div
                                    class="flex-row items-center block gap-8 p-2 sm:flex rounded-xl fill-red-500 sm:p-4">
                                    <svg width="64px" height="64px" viewBox="0 0 512 512"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round">
                                        </g>
                                        <g id="SVGRepo_iconCarrier">
                                            <title>ionicons-v5-a</title>
                                            <polygon points="240 304 272 304 278 144 234 144 240 304"
                                                style="fill:none">
                                            </polygon>
                                            <path
                                                d="M256,48C141.31,48,48,141.31,48,256s93.31,208,208,208,208-93.31,208-208S370.69,48,256,48Zm20,319.91H236v-40h40ZM272,304H240l-6-160h44Z">
                                            </path>
                                        </g>
                                    </svg>
                                    <div class="text-white ">
                                        <span class="font-bold text-white">Régulation du SAMU:</span> <br>
                                        <p>Bonjour, je suis Olivier de la régulation du SAMU, nous avons une mission sur
                                            votre
                                            secteur:
                                        </p>
                                        <span class="font-bold ">Message: </span>
                                        <p id="message-regulation-samu">${data.data.mission.nom_mission}</p>

                                    </div>
                                </div>
                            </div>
                        `;

                            if (t) {
                                t.innerHTML = htmlElement;

                                div.appendChild(buttonSend);
                                div.appendChild(buttonReject);
                                t.appendChild(elemTimer);
                                t.appendChild(add);
                            }

                            if (bases.length > 0) {
                                const audio = new Audio("{{ asset('assets/son/p_33009051_98.mp3') }}");
                                document.getElementById('playButton').addEventListener('click', () => {
                                    audio.play();
                                });
                            
                                const base = data.data.base;
                                                        
                                const hopital = data?.data?.hopital;
                                const baseLat = base.position_y;
                                const baseLon = base.position_x;
                                let hopitalLat = null;
                                let hopitalLon = null;
                                if (hopital) {
                                     hopitalLat = hopital.position_y;
                                     hopitalLon = hopital.position_x;
                                    }
                                else {
                                    hopitalLat = base.position_y;
                                    hopitalLon = base.position_x;
                                }


                                const radiusMaxKm = 30;

                                function haversineDistance(lat1, lon1, lat2, lon2) {
                                    const R = 6371; // Earth radius in km
                                    const dLat = (lat2 - lat1) * Math.PI / 180;
                                    const dLon = (lon2 - lon1) * Math.PI / 180;
                                    const a = Math.sin(dLat / 2) ** 2 +
                                            Math.cos(lat1 * Math.PI / 180) * Math.cos(lat2 * Math.PI / 180) *
                                            Math.sin(dLon / 2) ** 2;
                                    const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
                                    return R * c;
                                }


                                function getNewPositionMission(baseLat, baseLon) {
                                    
                                    // Rayon aléatoire entre 5 km et 30 km
                                    const radiusKm = getRandomArbitrary(5, 30);
                                
                                    // Calculs de conversion km -> degrés
                                    const kmPerDegLat = 111;
                                    const kmPerDegLon = 111 * Math.cos((baseLat * Math.PI) / 180);
                                
                                    const radiusDegLat = radiusKm / kmPerDegLat;
                                    const radiusDegLon = radiusKm / kmPerDegLon;
                                
                                    // Choisir un angle aléatoire (en radians)
                                    const angle = getRandomArbitrary(0, 2 * Math.PI);
                                
                                    // Calculer la position de la mission
                                    return {
                                        lonBase: baseLon + radiusDegLon * Math.cos(angle),
                                        latBase: baseLat + radiusDegLat * Math.sin(angle),
                                        radius: radiusKm
                                    }
                                }
                                let distToHopital, position;
                                let tries = 0;
                                do {
                                    tries++;
                                    position = getNewPositionMission(baseLat, baseLon);

                                    distToHopital = haversineDistance(position.latBase, position.lonBase, hopitalLat, hopitalLon);
                                } while (distToHopital > radiusMaxKm && tries < 10000);

                                const missionLat = position.latBase;
                                const missionLon = position.lonBase;

                            
                                currentMissionPositions.positionX = missionLon;
                                currentMissionPositions.positionY = missionLat;
                            
                                if (map) {
                                    var myIcon = L.icon({
                                        iconUrl: window.location.origin + "/assets/images/point.svg",
                                        iconSize: [25, 25],
                                        iconAnchor: [20, 20],
                                        popupAnchor: [-3, -76]
                                    });
                            
                                    getAddress(missionLon, missionLat, 'lieu-regulation-samu');
                                    getAddress(missionLon, missionLat, 'address-incident');
                            
                                    markerMission = L.marker([missionLat, missionLon], { icon: myIcon })
                                        .bindPopup("<p class='text-center'>Unité urgenceSamu</p>")
                                        .addTo(map);
                            
                                    tabMarkerMission.push(markerMission);
                                }
                            
                                buttonFocus.classList.add("show-modal", "sm:w-fit", "w-full",
                                    "text-sm", "text-white/70", "transition-all",
                                    "rounded-md", "gap-2", "p-4", "fill-orange-500",
                                    "bg-[#151b28]", "hover:bg-orange-500");
                                buttonFocus.innerText = "Afficher la mission sur la carte";
                            
                                buttonFocus.addEventListener('click', () => {
                                    focusToPoint(currentMissionPositions.positionX, currentMissionPositions.positionY);
                                });
                            
                                div.appendChild(buttonFocus);
                            
                                $('#name-patient').text(data.data.patient_name);
                                $('#age-patient').text(Math.floor(getRandomArbitrary(10, 100)));
                                $('#phone-patient').text(data.data.tel);
                            
                                $("#timer-regulation-samu").text(countDownTimer2(
                                    data.data.temps_restant,
                                    document.getElementById("timer-regulation-samu"),
                                    "", "", ""
                                ));
                            
                                t.appendChild(div);
                            }
                             else {
                                const missionX = getRandomArbitrary(41.5, -5.1);
                                const missionY = getRandomArbitrary(51.1, 9.5);
                                currentMissionPositions.positionX = missionX;
                                currentMissionPositions.positionY = missionY;
                                if (map) {
                                    var myIcon = L.icon({
                                        iconUrl: window.location.origin +
                                            "/assets/images/point.svg",
                                        iconSize: [25, 25],
                                        iconAnchor: [20, 20],
                                        popupAnchor: [-3, -76]
                                    });
                                    getAddress(missionX, missionY, 'lieu-regulation-samu');
                                    getAddress(missionX, missionY, 'address-incident');

                                    markerMission = L.marker([missionX, missionY], {
                                            icon: myIcon
                                        }).bindPopup(
                                            "<p class='text-center'>Unité urgenceSamu</p>")
                                        .addTo(map);
                                    tabMarkerMission.push(markerMission);
                                }

                                $('#name-patient').text(data.data.patient_name);
                                $('#age-patient').text(Math.floor(getRandomArbitrary(10, 100)));
                                $('#phone-patient').text(data.data.tel);
                                $("#timer-regulation-samu").text(countDownTimer2(data.data
                                    .temps_restant,
                                    document.getElementById("timer-regulation-samu"),
                                    "", "", ""
                                ));
                                $('#message-regulation-samu').text(data.data.mission
                                    .nom_mission);
                            }
                        }, timer * 1000);
                    }
                });
            });
        } catch (error) {
        }
    }

    // On logout
    $("#logout-button").on("click", confirmLogout);
    $("#cancel-logout").on("click", cancelLogout);
    $("#cancel-btn-logout").on("click", cancelLogout);
    // $("#cancel-btn-logout").

    function cancelLogout() {
        $("#logout-modal")[0].classList.remove("flex");
        $("#logout-modal")[0].classList.add("hidden");
    }

    function openModal(id) {
        const target = $(`#${id}`);
        target.addClass("flex");
        target.removeClass("hidden");

    }

    function confirmLogout() {
        event.preventDefault(); // Empêche la redirection immédiate
        someMissionIsPending().then(function(_isPending) {

            if (_isPending) {
                $('#logout-message').removeClass('hidden');
            }

            // window.location.href = window.location.origin + "/dashboard/deconnexion ";
            // return;

            $("#logout-modal")[0].classList.remove("hidden");
            $("#logout-modal")[0].classList.add("flex");
            // $("#drawer-example").addClass("hidden");
            return;
        });
    }

    // Fonction pour manipuler les classes CSS
    function toggleClass(element, classToRemove, classToAdd) {
        element.classList.remove(classToRemove);
        element.classList.add(classToAdd);
    }

    // Fonction pour ouvrir le modal de confirmation
    function openConfirmDestroyBase(baseId) {
        const input = document.querySelector(SELECTORS.BASE_ID_TO_DELETE);
        input.value = baseId;

        const destroyBaseModal = document.querySelector(SELECTORS.DESTROY_BASE_MODAL);
        const baseDetailsPanel = document.querySelector(SELECTORS.BASE_DETAILS_PANEL);

        if (!destroyBaseModal.classList.contains("hidden")) {
            toggleClass(baseDetailsPanel, "hidden", "flex");
        } else {
            toggleClass(destroyBaseModal, "hidden", "flex");
        }
    }

    // Fonction pour confirmer la suppression
    function confirmDestroyBase() {
        const input = document.querySelector(SELECTORS.BASE_ID_TO_DELETE);

        if (input.value) {
            deleteBase(input.value);
        } else {
            console.error("confirmDestroyBase", "baseId is not defined");
            showToast("Une erreur s'est produite lors de la suppression de la base, veuillez réessayer plus tard",
                "error");
        }
        cancelDestroyBase();
    }

    // Fonction pour annuler la suppression
    function cancelDestroyBase() {
        const destroyBaseModal = document.querySelector(SELECTORS.DESTROY_BASE_MODAL);
        const baseDetailsPanel = document.querySelector(SELECTORS.BASE_DETAILS_PANEL);

        if (!destroyBaseModal.classList.contains("hidden")) {
            toggleClass(baseDetailsPanel, "flex", "hidden");
        }

        toggleClass(destroyBaseModal, "flex", "hidden");
    }

    // Événements
    document.querySelector(SELECTORS.CONFIRM_DESTROY_BASE).addEventListener("click", confirmDestroyBase);
    document.querySelector(SELECTORS.CANCEL_DESTROY_BASE_ICON).addEventListener("click", cancelDestroyBase);
    document.querySelector(SELECTORS.CANCEL_DESTROY_BASE).addEventListener("click", cancelDestroyBase);

    // Fonction pour vérifier si une mission est en cours
    async function someMissionIsPending() {
        try {
            const response = await fetch('dashboard/api/missions/pending');
            if (!response.ok) {
                throw new Error(`Erreur HTTP: ${response.status}`);
            }

            const data = await response.json();
            return data.data ?? false; // Retourne true si une mission est en cours, sinon false
        } catch (error) {
            console.error('Erreur dans someMissionIsPending:', error);
            return false; // En cas d'erreur, on suppose qu'aucune mission n'est en cours
        }
    }

    async function checkUserGameData() {
        try {
            const response = await fetch('dashboard/api/check-user-data');
            if (!response.ok) {
                throw new Error(`Erreur HTTP: ${response.status}`);
            }

            const data = await response.json();
            return data.data ?? false; // Retourne true si une mission est en cours, sinon false
        } catch (error) {
            console.error('Erreur dans someMissionIsPending:', error);
            return false; // En cas d'erreur, on suppose qu'aucune mission n'est en cours
        }
    }

    function dataToTableHtml(array, array2) {
        const table = document.getElementById('table-unite-base-details-panel');
        const table2 = document.getElementById('table-personnel-base-details-panel');

        if (table && table2) {
            table.innerHTML = "";
            table2.innerHTML = "";
            array.forEach((element) => {
                const deleteButton = document.createElement('button');
                deleteButton.innerText = "Retirer"
                const sendOtherBaseButton = document.createElement('button');
                sendOtherBaseButton.innerText = "Envoyer dans une autre base";
                const formationButton = document.createElement('button');
                formationButton.innerText = "Améliorer";
                sendOtherBaseButton.classList.add("text-center", "bg-[#1a2539]", "text-xs", "text-white", "p-2",
                    "plus-jakarta-sans-200", "w-full")
                formationButton.classList.add("text-center", "gap-2", "w-full", "hover:fill-white",
                    "hover:bg-white", "text-stone-500", "p-2", "px-4", "text-xs",
                    "transition-all", "bg-white/80", "fill-stone-500", "rounded-md")
                deleteButton.classList.add("text-center", "gap-2", "w-full", "hover:fill-white",
                    "hover:bg-red-500", "text-white", "p-2", "px-4", "text-xs",
                    "transition-all", "bg-red-600", "fill-stone-500", "rounded-md")
                const cardUniteBaseDetail = document.createElement('div');
                cardUniteBaseDetail.classList.add("shadow-xl", "p-4", "bg-gradient-to-tr", "bg-[#1a2539]",
                    "from-[#14264b]", "rounded-xl", "relative")
                const cardUniteBaseDetailTitle = document.createElement('h4');
                cardUniteBaseDetailTitle.classList.add('text-[14px]', "text-white", "text-center");
                cardUniteBaseDetailTitle.innerText = element.nom;
                const cardUniteBaseDetailIcon = document.createElement('img');
                cardUniteBaseDetailIcon.classList.add("w-6", "h-6", "rounded-xl", "absolute", "left-2", "top-2")
                cardUniteBaseDetailIcon.src = window.location.origin + element.icon;
                const cardUniteBaseDetailButton = document.createElement('div');
                cardUniteBaseDetailButton.classList.add("flex", 'fle-col', "gap-1", "w-full");
                cardUniteBaseDetail.appendChild(cardUniteBaseDetailIcon)
                cardUniteBaseDetailButton.appendChild(formationButton)
                cardUniteBaseDetailButton.appendChild(deleteButton)
                const cardUniteBaseDetailHr = document.createElement('hr');
                cardUniteBaseDetailHr.classList.add("w-20", "opacity-50", "mx-auto", "my-2");
                const cardUniteBaseDetailListe = document.createElement('ul');
                cardUniteBaseDetailListe.innerHTML = `
                    <li class="flex items-start justify-between gap-2 p-3 text-white text-[12px]"><span
                            class="font-bold">Santé:</span><span class="text-[12px]">${element.sante} %</span>
                    </li>
                    <li class="flex items-start justify-between gap-2 p-3 text-white text-[12px]"><span
                            class="font-bold">Vitesse de déplacement:</span><span class="text-right text-[12px]">${element.vitesse} km/h</span>
                    </li>
                    <li class="flex items-start justify-between gap-2 p-3 text-white text-[12px]"><span
                            class="font-bold">Capacité:</span><span class="text-[12px]">${element.places_disponible}</span>
                    </li>
                `
                cardUniteBaseDetail.appendChild(cardUniteBaseDetailTitle)
                cardUniteBaseDetail.appendChild(cardUniteBaseDetailHr)
                cardUniteBaseDetail.appendChild(cardUniteBaseDetailButton)
                cardUniteBaseDetail.appendChild(cardUniteBaseDetailListe)
                cardUniteBaseDetail.appendChild(sendOtherBaseButton)

                table.appendChild(cardUniteBaseDetail)
            })
            array2.forEach((element) => {
                const deleteButton = document.createElement('button');
                deleteButton.innerText = "Retirer"
                const sendOtherBaseButton = document.createElement('button');
                sendOtherBaseButton.innerText = "Envoyer dans une autre base";
                const formationButton = document.createElement('button');
                formationButton.innerText = "Formations";
                sendOtherBaseButton.classList.add("text-center", "bg-[#1a2539]", "text-xs", "text-white", "p-2",
                    "plus-jakarta-sans-200", "w-full")
                formationButton.classList.add("text-center", "gap-2", "w-full", "hover:fill-white",
                    "hover:bg-white", "text-stone-500", "p-2", "px-4", "text-xs",
                    "transition-all", "bg-white/80", "fill-stone-500", "rounded-md")
                deleteButton.classList.add("text-center", "gap-2", "w-full", "hover:fill-white",
                    "hover:bg-red-500", "text-white", "p-2", "px-4", "text-xs",
                    "transition-all", "bg-red-600", "fill-stone-500", "rounded-md");
                formationButton.addEventListener('click', () => {
                    // $('#formation-panel').addClass("flex")
                    // $('#formation-panel').removeClass("hidden")

                    $('#card-personnel-formation-panel').removeClass('hidden')
                    $('#card-personnel-formation-panel').addClass('flex')
                    fetchDataFormation(element.personnel.id)
                })
                const cardUniteBaseDetail = document.createElement('div');
                cardUniteBaseDetail.classList.add("shadow-xl", "p-4", "bg-gradient-to-tr", "bg-[#1a2539]",
                    "from-[#14264b]", "rounded-xl", "relative")
                const cardUniteBaseDetailTitle = document.createElement('h4');
                cardUniteBaseDetailTitle.classList.add('text-[14px]', "text-white", "text-center");
                cardUniteBaseDetailTitle.innerText = element.personnel.nom_personnel + '(' + element.personnel
                    .titre_personnel + ')';
                const cardUniteBaseDetailIcon = document.createElement('img');
                cardUniteBaseDetailIcon.classList.add("w-6", "h-6", "rounded-xl", "absolute", "left-2", "top-2")
                cardUniteBaseDetailIcon.src = window.location.origin + '/' + element.personnel.image;
                const cardUniteBaseDetailButton = document.createElement('div');
                cardUniteBaseDetailButton.classList.add("flex", 'fle-col', "gap-1", "w-full");
                cardUniteBaseDetail.appendChild(cardUniteBaseDetailIcon)
                cardUniteBaseDetailButton.appendChild(formationButton)
                cardUniteBaseDetailButton.appendChild(deleteButton)
                const cardUniteBaseDetailHr = document.createElement('hr');
                cardUniteBaseDetailHr.classList.add("w-20", "opacity-50", "mx-auto", "my-2");
                const cardUniteBaseDetailNiveau = document.createElement('div');
                cardUniteBaseDetailNiveau.classList.add("w-6", "h-6", "rounded-xl", "absolute", "left-2",
                    "top-2")
                cardUniteBaseDetailNiveau.innerText = element.personnel.niveau;
                cardUniteBaseDetailNiveau.id = 'cardUniteBaseDetail-' + element.personnel.id;
                const cardUniteBaseDetailListe = document.createElement('ul');
                cardUniteBaseDetailListe.innerHTML = `
                 <li class="flex items-start justify-between gap-2 p-3 text-white text-[12px]">
                    <span class="font-bold">Niveau:</span><span class="text-[12px]">${element.personnel.niveau} %</span>
                 </li>
                 <li class="flex items-start justify-between gap-2 p-3 text-white text-[12px]">
                    <span class="font-bold">Status:</span>
                    <span class="text-right text-[12px]">
                        ${element.personnel.etat_formation_personnel == 'base' ? "à la base" : ""}
                        ${element.personnel.etat_formation_personnel != 'base' ? element.personnel.etat_formation_personnel+ "km/h" : ""}
                    </span>
                 </li>

                `;

                if (element.dateFin) {
                    countDownTimer(
                        element.dateFin, 
                        cardUniteBaseDetailNiveau, 
                        element.personnel.niveau,
                        "Fin de la formation dans",
                        "end-formation", 
                        `cardUniteBaseDetail-${element.personnel.id}`,
                    );
                }
                cardUniteBaseDetail.appendChild(cardUniteBaseDetailTitle)
                cardUniteBaseDetail.appendChild(cardUniteBaseDetailHr)
                cardUniteBaseDetail.appendChild(cardUniteBaseDetailButton)
                cardUniteBaseDetail.appendChild(cardUniteBaseDetailListe)
                cardUniteBaseDetail.appendChild(sendOtherBaseButton)
                table2.appendChild(cardUniteBaseDetail)
            })
        }
    }

    const MESSAGE_CANNOT_DELETE_BASE_WHEN_MISSION_PENDING =
        "Lorsqu'une mission est en cours, la suppression de cette base est impossible. Des unités de cette base sont actuellement en intervention. Merci d'attendre la fin de la mission avant de réessayer.";

    function deleteBase(id) {
        const idAlliance = $("#id-alliance").val();
        $.ajax({
            url: "/dashboard/api/delete-base/" + id,
            type: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': token,
                'Content-Type': 'application/json'
            },
            dataType: 'json',
            success: function(response) {
                $('#loader-detail-alliance').show()
                showToast(response.status, "Base détruite");
                loadBase();
                loadMission();
            },
            error: function(jqXHR, textStatus, errorThrown) {
                $('#loader-detail-alliance').hide()
                showToast("danger",
                    "Une erreur c'est produite lors de l'execution de votre demande!")
            }
        });
    }

    $('#delete-base').on('click', () => {
        someMissionIsPending().then(function(_isPending) {
            if (_isPending) {
                showToast("danger", MESSAGE_CANNOT_DELETE_BASE_WHEN_MISSION_PENDING);
                return;
            }

            if (baseId) {
                openConfirmDestroyBase(baseId);
                $('#base-details-panel').addClass('hidden');
                $('#base-details-panel').removeClass('flex');
                loadBase();
            } else {
                showToast(
                    "danger",
                    "Une erreur c'est produite lors de la suppression de la base"
                );
            }
        });
    })

    function focusToPoint(x, y) {
        // Centrer la carte sur le point [x, y]
        centerMapOnPoint(x, y);

        // Ajouter un marqueur de surbrillance animé
        addHighlightMarker(x, y);

    }

    function centerMapOnPoint(_x, _y) {
        if (!map) {
            console.error("La carte n'est pas encore initialisée.");
            return;
        }

        const missionFormPanel = document.getElementById('mission-form-panel');
        const missionFormPanelIsOpen = !missionFormPanel.classList.contains('hidden');

        // Définir un niveau de zoom approprié pour centrer l'élément
        let zoom = map.getZoom() <= 5 ? map.getZoom() * 1.9 : map.getZoom();
        if (missionFormPanelIsOpen) {
            zoom = map.getZoom() <= 7 ? map.getZoom() * 1.1 : map.getZoom();
        }
        let x = _x;
        let y = _y;

        // Centrer la carte sur le point [x, y] avec le zoom ajusté

        map.setView([x, y], zoom, {
            animate: true
        });

        map.panTo([x, y]);

        // Optionnel : Ajuster le zoom pour s'assurer que l'élément est bien visible
        map.once('zoomend', function() {
            map.setView([x, y], zoom, {
                animate: true
            });
        });
    }

    function addHighlightMarker(x, y) {
        // Supprimer l'ancien marqueur de surbrillance s'il existe
        if (window.highlightMarker) {
            map.removeLayer(window.highlightMarker);
            restoreMarkersOpacity(); // Restaurer l'opacité des autres marqueurs
        }

        // Ajuster les coordonnées pour le centrage
        const adjustedX = x + 0.008;
        const adjustedY = y - 0.009;

        // Créer un nouveau marqueur de surbrillance
        window.highlightMarker = L.circleMarker([adjustedX, adjustedY], {
            radius: getAdjustedRadius(), // Taille initiale du cercle
            color: '#ffB500', // Couleur de la bordure
            fillColor: '#fff1ccbf', // Couleur de remplissage
            fillOpacity: 0.5, // Opacité du remplissage
            weight: 1 // Épaisseur de la bordure
        }).addTo(map);

        // Ajouter une classe pour l'animation
        window.highlightMarker.getElement().classList.add('pulsating-marker');

        // Réduire l'opacité de tous les autres marqueurs
        reduceMarkersOpacity(window.highlightMarker);

        // Activer le popup de l'élément à la position (x, y)
        activatePopupAtPosition(x, y);

        // Ajuster la position du marqueur en fonction du zoom
        map.on('zoomend', function() {
            const zoom = map.getZoom();
            const xAdjust = zoom <= 5 ? 0.008 * (1 - (zoom / 5)) : 0;
            const yAdjust = zoom <= 5 ? -0.009 * (1 - (zoom / 5)) : 0;

            window.highlightMarker.setLatLng([x + xAdjust, y + yAdjust]);
        });
    }

    function getAdjustedRadius() {
        const baseRadius = 40; // Taille de base du cercle
        const zoomLevel = map.getZoom();
        const scaleFactor = 1.2; // Facteur de redimensionnement
        const adjustedRadius = baseRadius - Math.pow(scaleFactor, zoomLevel - 6);

        return adjustedRadius;
    }

    // Fonction pour réduire l'opacité de tous les marqueurs sauf celui en surbrillance
    let reduceMarkersOpacityTimer = null;

    function reduceMarkersOpacity(highlightMarker) {
        clearTimeout(reduceMarkersOpacityTimer); // Réinitialiser le timer
        restoreMarkersOpacity(); // Restaurer l'opacité de tous les marqueurs avant de réduire à nouveau

        // Réduire l'opacité de tous les marqueurs sauf celui en surbrillance
        map.eachLayer(layer => {
            if (layer instanceof L.Marker && layer !== highlightMarker) {
                layer.setOpacity(0.2); // Réduire l'opacité des autres marqueurs
            }
        });

        // Restaurer l'opacité après 5 secondes
        reduceMarkersOpacityTimer = setTimeout(() => {
            restoreMarkersOpacity();
        }, 5000); // 5000 millisecondes = 5 secondes
    }

    // Fonction pour restaurer l'opacité de tous les marqueurs
    function restoreMarkersOpacity() {
        map.eachLayer(layer => {
            if (layer instanceof L.Marker) {
                layer.setOpacity(1); // Restaurer l'opacité à 1
            }
        });
    }

    // Fonction pour restaurer l'opacité de tous les marqueurs
    function restoreMarkersOpacity() {
        map.eachLayer(layer => {
            if (layer instanceof L.Marker) {
                layer.setOpacity(1); // Restaurer l'opacité à 100%
            }
        });
    }

    function activatePopupAtPosition(x, y) {
        // Trouver l'élément (marqueur ou autre) à la position (x, y)
        const targetLayer = findLayerAtPosition(x, y);

        if (targetLayer && targetLayer.getPopup()) {
            // Ouvrir le popup de l'élément
            targetLayer.setOpacity(1); // Rétablir l'opacité de l'élément
            targetLayer.openPopup();
        } else {
            console.warn("Aucun élément trouvé à cette position ou l'élément n'a pas de popup.");
        }
    }

    function findLayerAtPosition(x, y) {
        // Parcourir les layers de la carte pour trouver un élément à la position (x, y)
        let targetLayer = null;

        map.eachLayer(layer => {
            if (layer.getLatLng && layer.getLatLng().equals([x, y], 0.0001)) {
                targetLayer = layer;
            }
        });

        return targetLayer;
    }

    $('#focus-mission').on('click', () => {
        focusToPoint(currentMissionPositions.positionX, currentMissionPositions.positionY)
    })

    function loadBaseById(id) {
        baseId = id;
        $('#loader-detail-base').show();
        const wesPromiseMission = fetch("/dashboard/api/get-base/" + id);
        wesPromiseMission.then((response) => {
            return response.json();
        }).then(function(data) {
            dataToTableHtml(data.data.unites, data.data.personnel)
            $('#base-detail-unite-disponible').text(
                `${data.data.totalUniteDisponible} sur ${data.data.totalUnite}`)
            $('#base-detail-address').text(currentAddresseBase)
            $('#base-detail-name').text(data.data.base.nom_base);
            $('#base-detail-personnel-disponible').text(
                `${data.data.totalPersonnelDisponible} sur ${data.data.totalPersonnel}`)
            $('#base-detail-description').text(
                `${data.data.base.description_base ? data.data.base.description_base : ''}`)
            $('#loader-detail-base').hide();
        })
    }

    $('#hopital_id_mission').on('change', function() {
        hopitalIdMission = $(this)[0].value;

        $('#focus-hopital-id').removeClass('hidden')

        const currentH = tabHopital.filter((e) => e.id === parseInt($(this)[0].value))[0];

        currentHopital = currentH;

        const validateHopital = validationMission30Km();
        if (validateHopital != undefined) {
            if (validateHopital) {

            } else {
                hopitalIdMission = null;
                $('#hopital_id_mission').val(null).trigger('change');
            }
        }
        $('#focus-hopital-id').on('click', () => {
            focusToPoint(currentH.position_x, currentH.position_y)
        })
    })
    // Data for mission

    $('#base_id_mission').on('change', function() {
        baseIdMission = $(this)[0].value;
        // const selectedBase = cities.filter((e) => e.id === parseInt($(this)[0].value))[0];
        validationMission30Km();
        loadMissionDataBase($(this)[0].value)
    })

    function validationMission30Km() {
        const hostipalSelected = tabHopital.filter((e) => e.id === parseInt(hopitalIdMission))[0];

        const baseSelected = bases.filter((e) => e.base.id === parseInt(baseIdMission))[0];

        if (baseSelected && hostipalSelected) {
            const checkDistance = getDistanceBetweenTwoPoints(hostipalSelected.position_x, hostipalSelected.position_y,
                baseSelected.base.position_x, baseSelected.base.position_y);
            // TODO : remove true to check distance
            if (checkDistance <= 30) {
                return true;
            } else {
                // la distance entre la base et l'hopital est de " + checkDistance + " km
                showToast("danger",
                    "La base choisie est trop loin de l'hopital. La distance maximale autorisée est de 30 km.");
                return false;
            }
        }

        return undefined;
    }

    function loadMissionDataBase(id) {
        $('#loader-detail-base').show();
        const wesPromiseMission = fetch("/dashboard/api/get-base/" + id);
        wesPromiseMission.then((response) => {
            return response.json();
        }).then(function(data) {
            const table = document.getElementById('tbody-unite');
            table.innerHTML = ""
            $('#focus-base-id').removeClass('hidden')
            $('#reload-data-mission-form-panel').removeClass('hidden')
            $('#shop-button-mission-form-panel').removeClass('hidden')
            $('#focus-base-id').on('click', () => {
                focusToPoint(data.data.base.position_x, data.data.base.position_y)
            })
            $('#shop-button-mission-form-panel').on('click', () => {
                baseId = data.data.base.id;
            })
            $('#reload-data-mission-form-panel').on('click', () => {
                loadMissionDataBase(id)
            })

            currentBaseMission = data.data;
            if (table) {
                data.data.uniteDisponible.forEach((element) => {
                    const tr = document.createElement('div');
                    tr.classList.add('grid', "items-center", "grid-cols-4");
                    const thName = document.createElement('div');
                    thName.innerText = element.nom;
                    thName.classList.add('col-span-1', 'py-3', 'font-medium', 'text-center',
                        'text-white');
                    const tdSante = document.createElement('div');
                    tdSante.innerText = element.sante + "%";
                    tdSante.classList.add('col-span-1', 'py-3', 'text-blue-500', 'text-center');
                    const tdPlacesDisponible = document.createElement('div');
                    tdPlacesDisponible.innerText = element.places_disponible;
                    tdPlacesDisponible.classList.add('col-span-1', 'py-3', 'text-blue-500',
                        'text-center');
                    const tdAction = document.createElement('td');
                    tdAction.classList.add('col-span-1', 'py-3', 'text-blue-500', 'text-center');
                    const selectButton = document.createElement('button');
                    selectButton.innerText = "Sélectionner"
                    selectButton.classList.add('w-full', 'text-white', 'bg-green-500',
                        'hover:bg-green-600', 'rounded-lg', 'text-sm', 'px-2', 'py-1',
                        'text-center');

                    selectButton.addEventListener('click', () => {
                        const index = uniteSelected.indexOf(element.id);
                        console.table(uniteSelected)
                        if (index == -1) {
                            uniteSelected.push(element.id);
                            selectButton.classList.replace('bg-green-500',
                                'bg-stone-500');
                            selectButton.classList.replace('hover:bg-green-600',
                                'hover:bg-stone-600');
                            selectButton.innerText = "Retirer";
                        } else {
                            selectButton.classList.replace('bg-stone-500',
                                'bg-green-500');
                            selectButton.classList.replace('hover:bg-stone-600',
                                'hover:bg-green-600');
                            selectButton.innerText = "Sélectionner";
                            uniteSelected.splice(index, 1);
                        }
                    })
                    tdAction.appendChild(selectButton)
                    tr.appendChild(thName);
                    tr.appendChild(tdSante);
                    tr.appendChild(tdPlacesDisponible);
                    tr.appendChild(tdAction);
                    table.appendChild(tr)
                })
            }
            if (data.data.uniteDisponible.length == 0) {
                const tr = document.getElementById('table-unite');
                tr.innerHTML = "Aucune unité dans votre base"
            }
            const tablepersonnel = document.getElementById('tbody-personnel');
            tablepersonnel.innerHTML = ""
            if (tablepersonnel) {
                data.data.personnelDisponible.forEach((element) => {
                    const tr = document.createElement('div');
                    tr.classList.add('grid', "items-center", "grid-cols-3");
                    const thName = document.createElement('div');
                    thName.innerText = element.nom_personnel;
                    thName.classList.add('text-center', 'col-span-1', 'py-3', 'font-medium',
                        'whitespace-nowrap',
                        'text-white');

                    const tdTitre = document.createElement('div');
                    tdTitre.innerText = element.titre_personnel + ' de niveau ' + element.niveau;
                    tdTitre.classList.add('text-center', 'col-span-1', 'py-3', 'text-blue-500');
                    const tdAction = document.createElement('div');
                    tdAction.classList.add('text-center', 'col-span-1', 'py-3', 'text-blue-500');
                    const selectButton = document.createElement('button');
                    selectButton.innerText = "Sélectionner"
                    selectButton.classList.add('w-full', 'text-white', 'bg-green-500',
                        'hover:bg-green-600', 'rounded-lg', 'text-sm', 'px-2', 'py-1',
                        'text-center');
                    selectButton.addEventListener('click', () => {
                        const index = personnelSelected.indexOf(element.id);

                        if (index == -1) {
                            personnelSelected.push(element.id);
                            selectButton.classList.replace('bg-green-500',
                                'bg-stone-500');
                            selectButton.classList.replace('hover:bg-green-600',
                                'hover:bg-stone-600');
                            selectButton.innerText = "Retirer";
                        } else {
                            selectButton.classList.replace('bg-stone-500',
                                'bg-green-500');
                            selectButton.classList.replace('hover:bg-stone-600',
                                'hover:bg-green-600');
                            selectButton.innerText = "Sélectionner";
                            personnelSelected.splice(index, 1);
                        }

                    })
                    tdAction.appendChild(selectButton)
                    tr.appendChild(thName);
                    tr.appendChild(tdTitre);

                    tr.appendChild(tdAction);
                    tablepersonnel.appendChild(tr)
                })
            }
            if (data.data.personnelDisponible.length == 0) {
                const tr = document.getElementById('table-personnel');
                tr.innerHTML = "Aucun personnel dans votre base"
            }
        })
    }

    function dataBaseTohtmlElement(array) {
        const baseListContent = document.getElementById("base-list-content");
        baseListContent.innerHTML = "";
        if (baseListContent) {
            array.forEach((element) => {
                const divElement = document.createElement('div');
                const buttonsActionElement = document.createElement('div');
                divElement.classList.add('relative', "text-white");
                const buttonActionElement = document.createElement('button');
                buttonActionElement.classList.add("text-center", "gap-2", "w-full", "hover:fill-white",
                    "hover:text-white", "text-white/70", "hover:bg-blue-500", "p-2", "px-4", "text-xs",
                    "transition-all", "bg-blue-600", "fill-blue-500", "rounded-md")
                const buttonActionElement2 = document.createElement('button');
                buttonActionElement2.classList.add("text-center", "gap-2", "w-full", "hover:fill-white",
                    "hover:bg-white", "text-stone-500", "p-2", "px-4", "text-xs",
                    "transition-all", "bg-white/80", "fill-stone-500", "rounded-md")

                // Création de card pour les bases;
                const cardBaseList = document.createElement('div');
                const cardTitleBaseList = document.createElement('h4');
                const cardContainerBaseList = document.createElement('div');
                const cardAddressBaseList = document.createElement('div');
                const cardStatBaseList = document.createElement('div');
                const cardUniteBaseList = document.createElement('div');
                const cardPersonnelBaseList = document.createElement('div');
                const cardEquipementBaseList = document.createElement('div');
                const buttonDeleteBaseList = document.createElement('button');
                const imageBaseList = document.createElement('img');
                const hrBaseList = document.createElement('hr');
                const divAddressImageBaseList = document.createElement('div');
                // Ajouter les classes
                buttonDeleteBaseList.addEventListener('click', () => {
                    someMissionIsPending().then(function(_isPending) {
                        if (_isPending) {
                            showToast(
                                "danger", MESSAGE_CANNOT_DELETE_BASE_WHEN_MISSION_PENDING
                            );
                            return;
                        } else {}


                        if (element.base.id) {
                            openConfirmDestroyBase(element.base.id);
                        } else {
                            showToast(
                                "danger",
                                "Une erreur c'est produite lors de la suppression de la base"
                            );
                        }
                    });
                })
                cardBaseList.classList.add("w-full",
                    "gap-4", "p-4", "bg-[#091327]", "shadow-2xl", "rounded-xl");
                cardTitleBaseList.classList.add('text-white', "sm:text-left", "font-medium", "text-center",
                    "text-lg");
                hrBaseList.classList.add("my-2", "border-white/50");
                cardContainerBaseList.classList.add('flex', "flex-col", "gap-4");
                divAddressImageBaseList.classList.add("flex", "flex-row", "gap-1");
                cardAddressBaseList.classList.add("text-white/70", "text-[10px]");
                cardStatBaseList.classList.add("flex", "flex-row", "gap-2", "items-center");
                cardUniteBaseList.classList.add("flex", "bg-[#1c222f]", "shadow-inner", "text-xs", "py-1",
                    "px-2", "rounded-md", "justify-between", "w-14", "items-center", "gap-2")
                cardPersonnelBaseList.classList.add("flex", "bg-[#1c222f]", "shadow-inner", "text-xs", "py-1",
                    "px-2", "rounded-md", "justify-between", "w-14", "items-center", "gap-2",
                    "fill-blue-500")
                cardEquipementBaseList.classList.add("flex", "bg-[#1c222f]", "shadow-inner", "text-xs", "py-1",
                    "px-2", "rounded-md", "justify-between", "w-14", "items-center", "gap-2")
                buttonDeleteBaseList.classList.add("gap-2", "w-full", "hover:fill-white",
                    "hover:text-white", "text-white/70", "hover:bg-red-500", "p-2", "px-4", "text-xs",
                    "text-center", "transition-all", "bg-red-600", "fill-red-500", "rounded-md");
                imageBaseList.classList.add("object-cover", "w-4", "h-4");

                // Ajouter du html brute

                buttonDeleteBaseList.id = "button-delete-base-list";
                buttonDeleteBaseList.innerText = "Détruire ma base";
                cardUniteBaseList.innerHTML = `<img src="{{ asset('assets/icons/icons8-vehicle-50.png') }}" alt=""
                                                class="object-cover rounded-sm shadow-xl" width="18" height="18">
                                            ${element.details.uniteDisponible}`;
                cardPersonnelBaseList.innerHTML = `
                                            <svg width="18" height="18" viewBox="0 0 24 24"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M16.5 7.063C16.5 10.258 14.57 13 12 13c-2.572 0-4.5-2.742-4.5-5.938C7.5 3.868 9.16 2 12 2s4.5 1.867 4.5 5.063zM4.102 20.142C4.487 20.6 6.145 22 12 22c5.855 0 7.512-1.4 7.898-1.857a.416.416 0 0 0 .09-.317C19.9 18.944 19.106 15 12 15s-7.9 3.944-7.989 4.826a.416.416 0 0 0 .091.317z" />
                                            </svg>
                                             ${element.details.personnelDisponible}`;
                imageBaseList.src = window.location.origin + "/" + element.base.icon_base;
                cardTitleBaseList.innerText = element.base.nom_base;
                divAddressImageBaseList.appendChild(imageBaseList);
                getAddress2(element.base.position_x, element.base.position_y, cardAddressBaseList);

                buttonActionElement.addEventListener('click', () => {
                    $('#base-details-panel').addClass('flex')
                    $('#base-details-panel').removeClass('hidden')
                    loadBaseById(element.base.id)
                    currentAddresseBase = cardAddressBaseList.innerText;
                });
                buttonActionElement2.addEventListener('click', () => {
                    focusToPoint(element.base.position_x, element.base.position_y);
                    $('#base-list-panel').addClass('hidden')
                    $('#base-list-panel').removeClass('flex')
                })

                buttonsActionElement.classList.add('grid', "sm:grid-cols-3", "grid-cols-1", "gap-2", "mt-2");
                buttonActionElement.innerText = "Détails";
                buttonActionElement2.innerText = "Focus sur la carte";
                cardBaseList.appendChild(cardTitleBaseList)
                cardBaseList.appendChild(hrBaseList)

                divAddressImageBaseList.appendChild(cardAddressBaseList)
                cardContainerBaseList.appendChild(divAddressImageBaseList)
                cardStatBaseList.appendChild(cardUniteBaseList)
                cardStatBaseList.appendChild(cardPersonnelBaseList)
                cardStatBaseList.appendChild(cardEquipementBaseList)
                cardContainerBaseList.appendChild(cardStatBaseList)

                cardBaseList.appendChild(cardContainerBaseList)
                divElement.appendChild(cardBaseList)
                buttonsActionElement.appendChild(buttonActionElement)
                buttonsActionElement.appendChild(buttonActionElement2)
                buttonsActionElement.appendChild(buttonDeleteBaseList)
                divElement.appendChild(buttonsActionElement)
                baseListContent.appendChild(divElement)
            })
        }
    }


    function loadBase() {
        const wesPromiseMission = fetch("/dashboard/api/get-bases");
        wesPromiseMission.then((response) => {
            return response.json();
        }).then(function(data) {
            tabMarkerBase.forEach(element => {
                element.remove()
            });
            dataBaseTohtmlElement(data.data)
            bases.length = 0;
            bases = data.data;
            const baseIdMissionLoadBase = document.getElementById('base_id_mission');
            const baseIdPersonnelLoadBase = document.getElementById('base_id_personnel');

            $.each(data.data, function(index, element) {
                baseIdMissionLoadBase.innerHTML = " <option>Selectionner une base</option>";
                baseIdPersonnelLoadBase.innerHTML = " <option>Selectionner une base</option>";
                if (baseIdMissionLoadBase) {
                    baseIdMissionLoadBase.innerHTML +=
                        `<option value="${element.base.id}">${element.base.nom_base}</option>`
                }
                if (baseIdPersonnelLoadBase) {
                    baseIdPersonnelLoadBase.innerHTML +=
                        `<option value="${element.base.id}">${element.base.nom_base}</option>`
                }
                if (map) {
                    const adjustedSize = getAdjustedSize();
                    var myIcon = L.icon({
                        iconUrl: window.location.origin + "/" + element.base.icon_base,
                        iconSize: [adjustedSize, adjustedSize], // taille de l'icône en pixels
                        iconAnchor: [20, 20], // point d'ancrage de l'icône
                        popupAnchor: [0, -10] // point d'ancrage du popup
                    });

                    var markerBase = L.marker([element.base.position_x, element.base.position_y], {
                            icon: myIcon
                        }).bindPopup("<p class='text-center'>" + element.base.nom_base + "</p>")
                        .addTo(map);
                    tabMarkerBase.push(markerBase)
                    markerBase.on('click', function() {
                        $('#base-details-panel').addClass('flex')
                        $('#base-details-panel').removeClass('hidden')
                        loadBaseById(element.base.id)
                    });

                    // Ajuster les icônes dès que les marqueurs sont ajoutés
                    adjustIconsOnMap();

                    // Écouter l'événement de zoom pour ajuster la taille des icônes
                    map.on('zoomend', adjustIconsOnMap);
                }
            });
        })
    }

    let hospitalMarkers = []; // Tableau pour stocker les marqueurs des hôpitaux
    let unitMakers = [];
    let maladeMarker = null;
    const baseSize = 25; // Taille de base en pixels
    const scaleFactor = 1.2; // Facteur de redimensionnement
    const minSize = 5; // Taille minimale
    const maxSize = 100; // Taille maximale

    function loadHopitaux() {
        const wesPromise = fetch("/api/hopitaux");
        wesPromise.then((response) => {
            return response.json();
        }).then(function(data) {
            tabHopital = data.response;
            const adjustedSize = getAdjustedSize(10);

            $.each(data.response, function(index, element) {
                if (map) {
                    var myIcon = L.icon({
                        iconUrl: window.location.origin + "/" + element.icon_hopital,
                        iconSize: [adjustedSize,
                            adjustedSize
                        ], // taille de base de l'icône en pixels
                        iconAnchor: [22, 94], // point d'ancrage de l'icône
                        popupAnchor: [-3, -76] // point d'ancrage du popup
                    });

                    let markerData = L.marker([element.position_x, element.position_y], {
                        icon: myIcon
                    }).addTo(map);

                    markerData.bindPopup("<p class='text-center'>" + element.nom_hopital + "</p>");
                    hospitalMarkers.push(markerData); // Ajouter le marqueur au tableau
                }
            });

            // Ajuster les icônes dès que les marqueurs sont ajoutés
            adjustIconsOnMap();

            // Écouter l'événement de zoom pour ajuster la taille des icônes
            map.on('zoomend', adjustIconsOnMap);
        });
    }

    function getAdjustedSize(sizeDefault = null) {
        const iconBaseSize = sizeDefault ? sizeDefault : baseSize;
        try {
            const zoomLevel = map.getZoom();
            const adjustedSize = iconBaseSize * Math.pow(scaleFactor, zoomLevel - 6);
            return adjustedSize;
        } catch (error) {
            console.error("Error getting adjusted size:", error);
            return iconBaseSize;
        }
    }

    function adjustOffsetOnMap(_offsetX, _offsetY) {
        const offsetX = _offsetX ? _offsetX : 10;
        const offsetY = _offsetY ? _offsetY : -20;
        const scaleFactor_ = 0.5
        const zoomLevel = map.getZoom()
        const adjustedOffsetX = offsetX * Math.pow(scaleFactor_, zoomLevel - 6);
        const adjustedOffsetY = offsetY * Math.pow(scaleFactor_, zoomLevel - 6);
        // Mettre à jour l'offset des icônes des unité
        return {
            x: adjustedOffsetX,
            y: adjustedOffsetY
        }
    }

    /*
     *  Fonction pour ajuster la taille des icônes des hôpitaux en fonction du zoom
     */
    function adjustIconsOnMap() {
        const adjustedSize = getAdjustedSize();

        // Mettre à jour la taille des icônes des hôpitaux
        hospitalMarkers.forEach(marker => {
            marker.setIcon(L.icon({
                iconUrl: marker.options.icon.options.iconUrl,
                iconSize: [adjustedSize, adjustedSize] // Mettre à jour la taille de l'icône
            }));
        });

        if(maladeMarker) {
            maladeMarker.setIcon(L.icon({
                iconUrl: maladeMarker.options.icon.options.iconUrl,
                iconSize: [adjustedSize, adjustedSize] // Mettre à jour la taille de l'icône
            }));
        }

        // Mettre à jour la taille des icônes des unité
        const adjustedUnitIconSize = getAdjustedSize(5);
        const offset = adjustOffsetOnMap();
        unitMakers.forEach(marker => {
            marker.setIcon(L.icon({
                iconUrl: marker.options.icon.options.iconUrl,
                iconSize: [adjustedUnitIconSize,
                    adjustedUnitIconSize
                ], // Mettre à jour la taille de l'icône
                offset: [10, -20]
            }));
        })

        tabMarkerBase.forEach(marker => {
            marker.setIcon(L.icon({
                iconUrl: marker.options.icon.options.iconUrl,
                iconSize: [adjustedSize, adjustedSize] // Mettre à jour la taille de l'icône
            }));
        })
    }

    async function addBase(formData) {
        if ({{ Auth::guard('appuser')->user()->argent }} > 150000 || isFirstBase) {
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
                    if (bases.length == 0) {
                        // loadMission()
                    }
                    loadBase()
                    $('#map').addClass("col-span-3")
                    $('#map').removeClass("col-span-2")
                    $('#base-form-create-layout').addClass('hidden')
                    $('#base-form-create-layout').removeClass('flex')
                    marker.remove();
                    loadMission();
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    $('#loader').hide()
                    console.error('Error posting data:', jqXHR, textStatus,
                        errorThrown);
                    let errorString = JSON.parse(jqXHR.responseText);
                    showToast(
                        "danger",
                        errorString && errorString.message ? errorString.message :
                        "Une erreur c'est produite lors de l'execution de votre demande!"
                    );
                }
            });
        } else {
            $('#first-base-form-message-error').text("Votre Argent est insuffisant pour effectuer créer ");
            showToast("warning", "Pas vous n\'avez pas assez d\'argent pour effectuer cette achat")
        }

    }



    $('.base-form').on('submit', async (e) => {
        e.preventDefault()

        const form = $(e.target)
        const formData = new FormData(form[0])
        formData.append("prix", 150000)
        // const formValues = Object.fromEntries(formData.entries())
        // getAddress($('#position_x_base_create').val(), $('#position_y_base_create').val())
        if (e.target.name == "base-form-create") {
            addBase(formData);
        } else {
            addBase(formValues);
        }
    })

    $('.test-btn').on('click', function() {
        let name = $(this).attr('name');
        alert(name)
    });

    /**
     * Fonction pour obtenir l'URL de l'icône de la voiture en fonction de son type
     *
     */
    function getVehicleIcon(icon = null) {
        // default icon
        const vehicle = {
            car: window.location.origin + "/assets/images/ambulance-svgrepo-com.png",
            motocycle: window.location.origin + "/assets/images/motorcycle.png",
        }

        let output = vehicle.car
        if (icon && icon != null) {
            output = icon
        }
        return output;
    }
    let lastAmbulanceMarker = null;
    let missionSens = '';

    function loadMissions() {
        try {
            // Supprimer l'ancien marqueur s'il existe
            if (markerMission) {
                map.removeLayer(markerMission);
                markerMission = null;
            }
    
            const documentElement = document.getElementById("mission-panel-content");
            documentElement.innerHTML = "";
    
            fetch("/dashboard/api/get-missions")
                .then(response => response.json())
                .then(async function(data) {
                    let markerMissionPosition = JSON.parse(localStorage.getItem("missionEnCoursPosition"));
    
                    if (markerMissionPosition) {
                        const modal = document.getElementById("resumeModal");
                        modal.classList.remove("hidden");
    
                        const doContinue = await new Promise((resolve) => {
                            document.getElementById("continueMissionBtn").addEventListener("click", () => {
                                modal.classList.add("hidden");
                                resolve(true); // continuer
                            });
    
                            document.getElementById("restartMissionBtn").addEventListener("click", () => {
                                modal.classList.add("hidden");
                                localStorage.removeItem("missionEnCoursPosition");
                                localStorage.removeItem("missionSens");
                                resolve(false); // recommencer
                            });
                        });
    
                        if (!doContinue) {
                            markerMissionPosition = null;
                        }
                    }
    
                    lancerMission(data.data, markerMissionPosition);
                });
        } catch (error) {
            console.error("Error loading missions:", error);
        }
    }


    function lancerMission(missions, markerMissionPosition) {
    missions.forEach((element) => {
        const mission = element.mission;
        const units = element.units;
        let vehiculeIcon = null;

        if (units && units.length > 0) {
            units.forEach((unit) => {
                if (unit?.type?.image) {
                    vehiculeIcon = unit.type.image;
                }
            });
        }

        const uniteIcon50 = getAdjustedSize(10);
        const startIcon = L.icon({
            iconUrl: window.location.origin + "/assets/images/point.svg",
            iconSize: [10, 10],
            iconAnchor: [20, 20],
            popupAnchor: [-3, -76]
        });
        const endIcon = startIcon;
        const uniteIcon = L.icon({
            iconUrl: getVehicleIcon(vehiculeIcon),
            iconSize: [uniteIcon50, uniteIcon50],
            iconAnchor: [40, 40],
            popupAnchor: [-3, -76]
        });
        const missionIcon = L.icon({
            iconUrl: window.location.origin + "/assets/icons/heart.png",
            iconSize: [50, 50],
            iconAnchor: [50, 50],
            popupAnchor: [-3, -76]
        });
        const initIcon = L.icon({
            iconUrl: window.location.origin + "/assets/images/point.svg",
            iconSize: [1, 1],
            iconAnchor: [50, 50],
            popupAnchor: [-3, -76]
        });

        markerMission = L.marker([
            markerMissionPosition ? markerMissionPosition.lat : element.base.position_x,
            markerMissionPosition ? markerMissionPosition.lng : element.base.position_y
        ], {
            icon: uniteIcon
        }).addTo(map);

        maladeMarker = L.marker(
            [element.info.position_x, element.info.position_y],
            { icon: missionIcon }
        ).addTo(map);

        unitMakers.push(markerMission);
        markerMission.unitData = units[0];

        markerMission.on('click', function () {
            const unit = markerMission.unitData;
            let passagers = '';
            const type = unit?.type?.nom_type_unite?.toLowerCase();

            switch (type) {
                case 'hélicoptère':
                    passagers = '👨‍✈️ Pilote, 🧑‍⚕️ Médecin, 👩‍⚕️ Infirmier';
                    break;
                case 'ambulance':
                    passagers = '🚑 Ambulancier, 🧑‍🎓 Stagiaire';
                    break;
                case 'moto':
                    passagers = '🏍️ Médecin';
                    break;
                default:
                    passagers = '👥 Inconnu';
            }

            const popupContent = `
                <div style="min-width: 250px">
                    <h4 class="font-bold text-blue-600 mb-2">${unit.nom_unite || 'Unité'}</h4>
                    <p><strong>🚀 Vitesse:</strong> ${unit.vitesse_unite} km/h</p>
                    <p><strong>⚙️ Usure:</strong> ${unit.taux_usure} %</p>
                    <p><strong>👥 Capacité:</strong> ${unit.capacite_unite}</p>
                    <p><strong>👤 Membres:</strong> ${passagers}</p>
                </div>
            `;
            L.popup().setLatLng(markerMission.getLatLng()).setContent(popupContent).openOn(map);
        });

        maladeMarker.on('click', function () {
            const etatSante = element.info.etat_sante || 'Inconnu';
            const gravite = element.info.gravite || 'Non précisée';
            const diagnostic = element.info.diagnostic || 'Aucun diagnostic';

            const popupContent = `
                <div style="min-width: 250px">
                    <h4 class="font-bold text-red-600 mb-2">🩺 Informations du patient</h4>
                    <p><strong>🧠 État :</strong> ${etatSante}</p>
                    <p><strong>📊 Gravité :</strong> ${gravite}</p>
                    <p><strong>📝 Diagnostic :</strong> ${diagnostic}</p>
                </div>
            `;
            L.popup().setLatLng(maladeMarker.getLatLng()).setContent(popupContent).openOn(map);
        });

        const myCallback = function(isDestinationReached, routing = null) {
            const missionSensFromLocalStorage = localStorage.getItem("missionSens");
            const departX = (markerMissionPosition && missionSensFromLocalStorage === "vers-hopital") ? markerMissionPosition.lat : element.info.position_x;
            const departY = (markerMissionPosition && missionSensFromLocalStorage === "vers-hopital") ? markerMissionPosition.lng : element.info.position_y;

            if (isDestinationReached) {
                if (maladeMarker) {
                    map.removeLayer(maladeMarker);
                    maladeMarker = null;
                }
                routing?.remove();
                setTimeout(() => {
                    routage(departX, departY, element.hopital.position_x, 200, element.hopital.position_y, markerMission, initIcon, endIcon, myCallback1);
                }, 1000);
            }
            missionSens = 'vers-hopital';
        };

        const myCallback1 = function(isDestinationReached, routing) {
            if (isDestinationReached) {
                routing.remove();
                setTimeout(() => {
                    routage(element.hopital.position_x, element.hopital.position_y, element.info.position_x, 200, element.info.position_y, markerMission, startIcon, endIcon, myCallback2);
                }, 1000);
            }
            missionSens = '';
            missionEnCoursPosition = null;
            localStorage.removeItem("missionEnCoursPosition");
            localStorage.removeItem("missionSens");
        };

        const myCallback2 = function(isDestinationReached, routing) {
            routing.remove();
            markerMission.remove();
            $('card-mission-item-' + name).hide();
        };

        if (element.info.etat === "PENDING") {
            const missionSensFromLocalStorage = localStorage.getItem("missionSens");

            if (missionSensFromLocalStorage === "vers-hopital") {
                myCallback(true);
            } else {
                const departX = markerMissionPosition ? markerMissionPosition.lat : element.base.position_x;
                const departY = markerMissionPosition ? markerMissionPosition.lng : element.base.position_y;
                routage(departX, departY, element.info.position_x, 200, element.info.position_y, markerMission, startIcon, initIcon, myCallback, false);
                missionSens = "vers-patient";
            }
        }

        const positionDiv = document.createElement('div');
        positionDiv.classList.add('posUpdate');
        const cardMission = document.createElement('div');
        cardMission.classList.add('p-4', 'bg-white', 'rounded-md', 'shadow-xl');
        cardMission.innerHTML = `
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="mr-2">
                        <div class="mb-1 text-xl font-semibold text-blue-400 uppercase">${element.mission.nom_mission}</div>
                        <p class="text-gray-400/80 max-h-20 text-[14px]">${element.mission.description_mission}</p>
                        <p><span class="font-bold text-green-500">Position actuelle: </span><span class="text-gray-400/80 text-[14px]"></span></p>
                        <div id="timer" class="font-semibold text-red-500 w-96"><span id="countdown" class=""></span></div>
                    </div>
                </div>
            </div>
        `;
        cardMission.appendChild(positionDiv);
        document.getElementById("mission-panel-content").appendChild(cardMission);

        lastAmbulanceMarker = markerMission;
    });

    adjustIconsOnMap();
}


    window.addEventListener("beforeunload", function () {
    if (lastAmbulanceMarker) {
        const pos = lastAmbulanceMarker.getLatLng();
        const save = {
                lat: pos.lat,
                lng: pos.lng
        };
        if(lastAmbulanceMarker)
            localStorage.setItem("missionEnCoursPosition", JSON.stringify(save));
        if(missionSens)
        localStorage.setItem("missionSens", missionSens);
    }
});


    function addMarkerToMap(x, y) {
        if (baseMarker) {
            const mapElement = document.getElementById('map');
            if (mapElement) {
                mapElement.classList.replace('col-span-full', 'col-span-2')
            }
            if (map) {
                if ((x < 51.1 && x > 41.5) && (y > -5.1 && y < 9.5)) {
                    marker = L.marker([x, y]).addTo(map);
                } else {
                    alert("Vous etes pas en France")
                }
            }
            $('#position_x_base_create').val(x);
            $('#position_y_base_create').val(y);
            if (marker) {
                marker.on('dragend', function(event) {
                    var newLatLng = event.target.getLatLng();

                    if ((newLatLng.lat < 51.01388134677095 && newLatLng.lat > 42.35842653923198) && (newLatLng
                            .lng > -4.699014964607643 && newLatLng.lng < 8.217469443861178)) {
                        $('#position_x_base_create').val(newLatLng.lat);
                        $('#position_y_base_create').val(newLatLng.lng);
                    } else {
                        alert("Vous etes pas en France")
                    }
                });
                marker.dragging.enable();
            }
            baseMarker = false;
        } else {
            baseMarker = true;
        }
    }

    //#endregion End Map data

    //#region Parametre

    function changeSetting() {
        const son = document.getElementById('son-checked');
        son.checked = setting.muted;
        if (!setting.muted) {
            const audio = document.getElementById('audio');
            if (audio) {
                audio.muted = audio
            }
        }
    }

    $('#save-setting').on('click', function() {
        $('#loader').show();

        const son = document.getElementById('son-checked');
        if (son) {
            if (!setting) {
                console.error("Setting object is not defined.");
                $('#loader').hide();
                return;
            }
            setting.muted = son.checked;
        }

        const expire = 2629800000;
        try {
            if (window && window.cookieStore) {
                window.cookieStore.set({
                    name: "cookie-setting",
                    value: JSON.stringify(setting),
                    expires: Date.now() + expire,
                    // domain: "gifted-wozniak.213-136-85-46.plesk.page",
                });
            } else {
                localStorage.setItem("cookie-setting", JSON.stringify(setting));
            }
            changeSetting();
        } catch (error) {
            console.error("Failed to set cookie:", error);
        }

        // Hide loader after a delay or based on actual operation completion
        setTimeout(() => {
            $('#loader').hide();
        }, 3000);
    });


    $('#countries').on('change', function() {
        const currentCity = cities.filter((e) => e.id === parseInt($(this)[0].value))[0];
        if (map) {
            posX = currentCity.latitude;
            posY = currentCity.longitude;
            map.panTo([currentCity.latitude, currentCity.longitude], 15);
            if (marker) {
                marker.setLatLng([currentCity.latitude, currentCity.longitude])
            }
        }
    })

    $('#reject-mission').on("click", async (e) => {
        const alertMission = document.getElementById("alert-mission");
        if (alertMission) {
            alertMission.innerHTML = ""
        }
        markerMission.remove()
        clearTimer(realTimer2)
        setTimeout(() => {

            loadMission()
        }, getRandomArbitrary(1000, 2000));
    })

    async function getAddress(latitude, longitude, htmlId) {
        var url = `https://nominatim.openstreetmap.org/reverse?format=json&lat=${latitude}&lon=${longitude}`;
        fetch(url)
            .then(response => response.json())
            .then(data => {
                // var address = data.display_name;
                // marker.bindPopup(address).openPopup();
                // address.display_name = data.display_name;
                // address.country = data.address.country;
                // address.county = data.address.county;
                // address.municipality = data.address.municipality;
                // address.quarter = data.address.quarter;
                // address.road = data.address.road;
                // address.state = data.address.state;
                // address.town = data.address.town;
                // address.region = data.address.region;
                const htmlElement = document.getElementById(htmlId);
                htmlElement.innerText = data.display_name;
            }).catch((err) => {
            })

    }

    async function getAddress2(latitude, longitude, htmlElement) {
        var url = `https://nominatim.openstreetmap.org/reverse?format=json&lat=${latitude}&lon=${longitude}`;
        fetch(url)
            .then(response => response.json())
            .then(data => {
                htmlElement.innerText += data.display_name;
            }).catch((err) => {
            })

    }


    function routage(lat, lng, latF, vitesseUnite, lngF, marqueur, startIcon, endIcon, callback, last) {
    if (typeof callback !== 'function') {
        throw new Error('routage function requires a callback function as the last argument');
    }

    let startRoute = false; // Ensure it's defined
    let v = vitesseUnite < 200 ? vitesseUnite * 100 : vitesseUnite;

    const r = L.Routing.control({
        waypoints: [
            L.latLng(lat, lng),
            L.latLng(latF, lngF),
        ],
        createMarker: function(i, waypoint) {
            return L.marker(waypoint.latLng, {
                icon: i === 0 ? startIcon : endIcon
            });
        },
        routeWhileDragging: false,  // Disable route recalculation while dragging
        draggableWaypoints: false,  // Prevent waypoint dragging
        addWaypoints: false,        // Disable adding new waypoints
        geocoder: L.Control.Geocoder.nominatim() 
    }).on('routesfound', function(e) {
        if (startRoute) return;
        startRoute = true;

        const route = e.routes[0];
        if (!route || !route.coordinates.length) {
            console.error("Error: No route found.");
            callback(false, r);
            return;
        }

        const totalSteps = route.coordinates.length;
        let currentStep = 0;

        function animateRoute() {
            if (currentStep < totalSteps) {
                marqueur.setLatLng(route.coordinates[currentStep]);
                currentStep++;

                if (route.name) {
                    marqueur.bindTooltip(route.name, {
                        permanent: true,
                        direction: 'top',
                        offset: [-15, -16]
                    });

                    document.querySelectorAll('.posUpdate').forEach(el => {
                        el.innerHTML = route.name;
                    });
                }

                setTimeout(animateRoute, 250);
            } else {
                callback(true, r);
            }
        }

        animateRoute();
    }).addTo(map);

    // Remove Leaflet route panel
    const leafletRightTab = document.querySelector('.leaflet-right');
    if (leafletRightTab) {
        leafletRightTab.remove();
    }
}

    $('#start-routing').on("click", async (e) => {
        updateMission()
    });

    // let markerMission = null; // Variable globale pour stocker le marqueur de l'unité

    async function updateMission() {
        // Supprimer l'ancien marqueur s'il existe
        if (markerMission) {
            map.removeLayer(markerMission);
            markerMission = null;
        }

        // ! error management
        // Base not selected
        if (!baseIdMission || baseIdMission == "") {
            alert("Veuillez sélectionner une base pour pouvoir accepter la mission.");
            return;
        } else if (!hopitalIdMission || hopitalIdMission == "") {
            alert("Veuillez sélectionner un hôpital pour pouvoir accepter la mission.");
            return;
        } else if (!uniteSelected || uniteSelected.length == 0) {
            alert(
                "Aucune unité du SAMU n'est actuellement disponible. Merci d'affecter au moins une unité à votre base pour pouvoir accepter la mission."
            );
            return;
        } else if (!personnelSelected || personnelSelected.length == 0) {
            alert(
                "Aucun membre du personnel n'a été sélectionné. Merci de choisir au moins un professionnel du SAMU pour pouvoir accepter la mission."
            );
            return;
        }

        if (baseIdMission != "" && baseIdMission != undefined && hopitalIdMission != undefined &&
            hopitalIdMission != "" && personnelSelected.length > 0 && uniteSelected.length > 0) {

            var startIcon = L.icon({
                iconUrl: window.location.origin + "/assets/images/point.svg",
                iconSize: [10, 10],
                iconAnchor: [20, 20],
                popupAnchor: [-3, -76]
            });
            var endIcon = L.icon({
                iconUrl: window.location.origin + "/assets/images/point.svg",
                iconSize: [10, 10],
                iconAnchor: [20, 20],
                popupAnchor: [-3, -76]
            });
            var uniteIcon = L.icon({
                iconUrl: getVehicleIcon(),
                iconSize: [50, 50],
                iconAnchor: [50, 50],
                popupAnchor: [-3, -76]
            });
            var missionIcon = L.icon({
                iconUrl: window.location.origin +
                    "/assets/images/point.svg",
                iconSize: [10, 10],
                iconAnchor: [50, 50],
                popupAnchor: [-3, -76]
            })
            markerMission = L.marker([currentBaseMission.base.position_x, currentBaseMission.base
                .position_y
            ]).addTo(map)

            const myCallback = function(isDestinationReached, routing) {
                if (isDestinationReached) {
                    routing.remove()
                    currentRouting[indexCurrentRouting] = {
                        posX: currentMissionPositions.position_x,
                        posY: currentMissionPositions.position_y,
                        baseId: currentBaseMission.base.id,
                    }

                    reloadPosition()
                    setTimeout(() => {
                        routage(currentMissionPositions.positionX, currentMissionPositions
                            .positionY, currentHopital.position_x, 200, currentHopital
                            .position_y, markerMission, missionIcon, endIcon,
                            myCallback1)
                    }, 1000);

                }
            };
            const myCallback1 = function(isDestinationReached, routing) {
                if (isDestinationReached) {
                    routing.remove()
                    currentRouting[indexCurrentRouting] = {
                        posX: currentHopital.position_x,
                        posY: currentHopital.position_y,
                        baseId: currentBaseMission.base.id,
                    }
                    reloadPosition()
                    setTimeout(() => {
                        routage(currentHopital.position_x, currentHopital.position_y,
                            currentBaseMission.base.position_x, 200, currentBaseMission.base
                            .position_y,
                            markerMission,
                            startIcon, endIcon, myCallback2)
                    }, 1000);

                }
            };
            const myCallback2 = function(isDestinationReached, routing) {
                routing.remove()
                currentRouting[indexCurrentRouting] = {
                    posX: currentBaseMission.base.position_x,
                    posY: currentBaseMission.base.position_y,
                    baseId: currentBaseMission.base.id,
                }
                reloadPosition()
                markerMission.remove()
                $('card-mission-item-' + name).hide()
            }
            $.ajax({
                url: "/dashboard/api/update-mission",
                type: 'PUT',
                data: JSON.stringify({
                    base_id: baseIdMission,
                    hopital_id: hopitalIdMission,
                    unites: uniteSelected,
                    personnel: personnelSelected,
                    action: 4,
                    mission_id: missionId,
                    position_x: currentMissionPositions.positionX,
                    position_y: currentMissionPositions.positionY,
                    etat: 'PENDING',
                    duree: "",
                    icon: "/assets/images/point.svg"
                }),
                headers: {
                    'X-CSRF-TOKEN': token,
                    'Content-Type': 'application/json'
                },
                dataType: 'json',

                success: function(response) {
                    $('#mission-form-panel').addClass('hidden')
                    $('#mission-form-panel').removeClass('flex')
                    loadMissions()
                    const alertMission = document.getElementById("alert-mission");
                    if (alertMission) {
                        alertMission.innerHTML = ""
                    }
                    routage(currentBaseMission.base.position_x, currentBaseMission.base
                        .position_y,
                        currentMissionPositions.positionX,
                        200, currentMissionPositions.positionY, markerMission,
                        startIcon, missionIcon,
                        myCallback, false)
                    if (indexCurrentRouting < 2) {
                        currentRouting[indexCurrentRouting] = {
                            posX: currentBaseMission.base.position_x,
                            posY: currentBaseMission.base.position_y,
                            baseId: currentBaseMission.base.id,
                        }
                        reloadPosition()
                        indexCurrentRouting++;
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {

                    console.error('Error posting data:', jqXHR, textStatus,
                        errorThrown);
                    showToast("danger",
                        "Une erreur c'est produite lors de l'execution de votre demande!")
                }
            });

        } else {
            alert("Veuillez remplir le formulaire")
        }
    }

    const reloadPosition = () => {
        const selection = document.querySelectorAll('.personnel-routing');

        for (let index = 0; index < currentRouting.length; index++) {
            const elementRouting = currentRouting[index];
            selection.forEach((element) => {
                if (`${element.name}` === `${elementRouting.baseId}`) {
                    getAddress2(elementRouting.posX, elementRouting.posY, element)
                }
            })
        }
    }

    //#endregion Parametre
</script>
