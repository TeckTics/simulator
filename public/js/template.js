
    let latitude = 51.505;
    let longitude = -0.09;
    $("#toast-success").hide();
    let userDataInfo;
    const token = "{{ csrf_token() }}";
    $("#toast-danger").hide();
    $("#toast-warning").hide();
    let accordionBol = false;
    let realTimer;
    $('#loader').hide()
    let clanId;
    let experienceClan;
    let niveauClan;
    $('#chat-form-alliance').hide()
    $("#loading").show();
    $('#loader-detail-alliance').hide()
    $('#loader-detail-unite').hide()
    $('#remove-money-animate').hide();
    $('#title-chat').text('"Générale"')
    $("#toasts").addClass("z-50");
    $('#messagesContainer-alliance').hide()
    $('#loader-personnel').hide()
    $('#timer-alliance-panel').hide()
    $('#daily-gain').hide();
    $('#confirm-action-panel').hide();
    $('#destroy-alliance-btn').hide()
    $('#leave-alliance-btn').hide()
    $('#button-chat-alliance').hide()
    $("#view-clan-name").hide()
    $('#view-chat-alliance').hide()
    $('#view-chat-generale').hide()
    $('#loader-personnel-card').hide()
    $(document).ready(async function() {
        formatDateTime("{{ $dateNow }}", "simple")

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
                attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            });
            var map = L.map('map').setView([{{ $user->lat }},{{ $user->lgt }}], 15);
            osm.addTo(map);

            var marker;
            marker = L.marker([latitude, longitude]).bindPopup(
                "<p class='text-center'>Ma base</p>").addTo(map);   

            marker.on('dragend', function(event) {
                var newLatLng = event.target.getLatLng();
                const posX = document.getElementById('position_x_base');
                const posY = document.getElementById('position_y_base');
                posY.value = newLatLng.lat;
                posX.value = newLatLng.lng;
            });
            marker.dragging.enable();
            $('#ville_id').on('change', (e) => {
                const wesPromise = fetch("/api/ville/" + e.target.value);
                wesPromise.then((response) => {
                    return response.json();
                }).then(function(data) {
                    longitude = data.response.longitude;
                    latitude = data.response.latitude;
                    marker.setLatLng([latitude, longitude])
                    map.panTo(new L.LatLng(latitude, longitude));
                    const posX = document.getElementById('position_x_base');
                    const posY = document.getElementById('position_y_base');
                    posX.value = longitude;
                    posY.value = latitude;
                })

            })
        }
        checkNewDay()
        refreshData()
        loadDataMap()
        initDashboard()
        initGameMap()

    })
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

        if (str != null) {
            const date = new Date(str);
            const day = date.getDate();
            const year = date.getFullYear();
            const month = getMonth(date.getMonth() + 1)
            const hours = date.getHours();
            const minutes = date.getMinutes();
            switch (type) {
                case "simple":
                    $("#date-now").text(
                        `${day} ${month} ${year} à ${hours + 1}h${minutes < 10 ? "0"+minutes : minutes}`)
                    break;
                case "formation":
                    return `Fini le ${day} ${month} ${year} à ${hours + 1}h${minutes < 10 ? "0"+minutes : minutes}`
                    break;
                default:
                    break;
            }
        } else {
            return ""
        }
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
                        const timeFormationDiv = document.createElement('p');
                        timeFormationDiv.classList.add("text-white", "font-bold", "text-sm")
                        countDownTimer(item.dateFin, timeFormationDiv, item.personnel.niveau, "Fin de la formation dans",
                            "end-formation", `niveau-element-personnel-${item.personnel.id}`);
                        const divContainer = document.createElement('div');
                        const divContainer2 = document.createElement('div');
                        formationButton.addEventListener('click', () => {
                            $('#card-personnel-formation-panel').removeClass('hidden')
                            $('#card-personnel-formation-panel').addClass('flex')
                            fetchDataFormation(item.personnel.id)
                        })
                        deleteButton.addEventListener('click', () => {
                            deletePersonnel(item.personnel.id)
                        })
                        formationButton.classList.add("gap-2", "p-2", "fill-white", "bg-white", "hover:bg-[#15244c]",
                            "w-fit", "hover:fill-blue-500", "flex", "items-center", "h-full", "text-[#15244c]",
                            "font-bold", "hover:text-white", "text-left", "text-sm", "transition-all", "rounded-xl",
                            "cursor-pointer")
                        formationButton.innerText = "Former";
                        deleteButton.classList.add("gap-2", "p-2", "fill-white", "bg-red-500", "hover:bg-red-600",
                            "w-fit", "hover:fill-blue-500", "flex", "items-center", "h-full", "text-white/70",
                            "hover:text-white", "text-left", "text-sm", "transition-all", "rounded-xl",
                            "cursor-pointer")
                        deleteButton.innerText = "Retirer du personnel SAMU";
                        divContainer.classList.add("flex", "items-center", "justify-end", "gap-2")
                        divContainer2.classList.add("flex", "items-center", "justify-between", "mt-2", "gap-2")
                        divContainer.appendChild(formationButton);
                        divContainer.appendChild(deleteButton);
                        divContainer2.appendChild(timeFormationDiv);
                        divContainer2.appendChild(divContainer);
                        divElement.innerHTML = `
                                 <div
                                class="w-full col-span-1 sm:flex block sm:flex-row bg-[#151b28] h-fit text-sm relative  rounded-2xl  ">
                                <div class="w-full overflow-hidden rounded-md shadow-2xl sm:w-64 basis-52 h-52 shadow-blue-800/20" style="height: 208px">
                                    <img class="w-full h-full " height="208px" src="/${item.personnel.image}"
                                        alt="product image" />
                                </div>
                                <div
                                    class="px-2 py-2 bg-[#151b28] absolute bottom-2 right-2 sm:left-1/2 sm:-transform-x-1/2 transform-x-1/2  text-white">
                                    <h5 class="text-sm font-bold tracking-tight text-center text-white ">
                                       ${item.personnel.titre_personnel}</h5>
                                </div>
                                <div class="p-6">
                                    
                                    <div id="niveau-element-personnel-${item.personnel.id}" title="Niveau ${item.personnel.niveau}"
                                        class=" w-fit h-fit absolute px-3 font-bold bg-black/50 text-[14px] shadow-2xl shadow-black p-2 rounded-md text-stone-100 top-2 right-2 ">
                                        Niv  ${item.personnel.niveau}</div>
                                    <ul class="text-white">
                                        <li><span class="font-bold">Prénom:
                                            </span><span> ${item.personnel.prenom_personnel}</span></li>
                                        <li><span class="font-bold">Nom:
                                            </span><span> ${item.personnel.nom_personnel}</span></li>
                                        <li><span class="font-bold">Position actuelle:
                                            </span><span> ${item.personnel.etat_formation_personnel ?? "aucune"}</span></li>
                                        <li><span class="font-bold">En déplacement:
                                            </span><span>${item.personnel.etat_mouvement_personnel}</span></li>
                                        <li><span class="font-bold">Missions effectuées:
                                            </span><span> ${item.personnel.total_used}</span></li>
                                        <li><span class="font-bold">Niveau: </span><span  id="2-niveau-element-personnel-${item.personnel.id}"> ${item.personnel.niveau}</span>
                                        </li>
                                    </ul>
                                    
                                </div>
                            </div>
                    `;
                        divElement.appendChild(divContainer2)
                        break;
                    default:
                        break;
                }
                divElement.setAttribute('name', item.id);
                htmlElement.appendChild(divElement)
            }
        }
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
            listItemListToHtml('personnel-list', data.data.personnels, "personnel")
        }).catch((err) => {
        })
    }

    function clearTimer() {
        clearInterval(realTimer);
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
                showToast("danger",
                    "Une erreur c'est produite lors de l'execution de votre demande!")
            }
        });
    }



    function countDownTimer(str, element, id, message, type, action) {
        if (str != null) {
            const strToTime = new Date(str).getTime();
            var realTimer1 = setInterval(() => {
                const dateNow = new Date().getTime();
                var timer = strToTime - dateNow;

                if (timer > 0) {
                    var minutes = Math.floor((timer / 1000 / 60) % 60);
                    var seconds = Math.floor((timer / 1000) % 60);
                    var hours = Math.floor((timer / 1000 / 60 / 60) % 24);
                    var days = Math.floor(timer / (1000 * 60 * 60 * 24));

                    element.innerHTML =
                        `<p>${message} ${days == 0 ? "" : days + "jour" }${days > 1 ? "s" : ""} ${hours < 10 ? "0" + hours : hours}:${minutes < 10 ? "0" + minutes : minutes}:${seconds < 10 ? "0" + seconds : seconds}</p>`;
                } else {
                    clearTimer(realTimer1)
                    const d = document.getElementById(action);
                    const d2 = document.getElementById("2-" + action);
                    if (d) {
                        d.innerHTML = "Niv " +( parseInt(id) + 1); 
                    }
                     if (d2) {
                        d2.innerHTML = parseInt(id) + 1; 
                    }
                    element.innerHTML = "";
                }

            }, 1000);
        }
    }

    function initDashboard() {
        const promise = fetch("/dashboard/api/get-user");
        promise.then((response) => {
            return response.json();
        }).then(function(data) {
            userDataInfo = data.data;


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
        }).finally(function() {
            $("#loading").hide();
        })
    }

    $('.show-modal').on('click', function() {
        let name = $(this).attr('name');
        switch (name) {
            case "shop-panel":
                $('#info-user').removeClass("hidden")
                $('#info-user').removeClass("relative")
                $('#info-user').addClass(["max-sm:z-40", "max-sm:flex", "max-sm:left-0", "max-sm:fixed",
                    "max-sm:top-0", "max-sm:bg-[#051129b3]", "max-sm:w-full", "max-sm:t-0",
                    "max-sm:items-center"
                ])
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
        $('#' + name).addClass('flex')
        $('#' + name).removeClass('hidden')
    });

    $('.close-modal-button').on('click', function() {
        let name = $(this).attr('name');
        $('#' + name).addClass('hidden')
        $('#' + name).removeClass('flex')
        clearTimer()
    });

    $('.close-action-modal').on('click', function() {
        let name = $(this).attr('name');
        $('#' + name).addClass('hidden')
        $('#' + name).removeClass('flex')
        clearTimer()
    });

    $("#declined-button-confirm-action-panel").on('click', function() {
        $('#confirm-action-panel').hide();
    });


    $('#leave-alliance-btn').on('click', function() {
        confirmActionHandler("leave-alliance", "Voulez vous quitter cette alliance?", 0)
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

        confirmActionHandler("delete-alliance", "Voulez vous détruire votre alliance?")
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
                            class="flex show-event gap-4 justify-between odd:bg-blue-500 odd:text-white even:text-[#1a2539] even:bg-white p-1 items-center">
                            <div class="flex items-center gap-4">
                                <div
                                    class="w-10 h-10 text-[14px] rounded-md flex justify-center items-center border">
                                    ${index + 1}
                                </div>
                                <span class="text-[14px]  font-medium">${element.pseudo}</span>
                            </div>
                             <div>
                                <span class="text-[14px] font-medium ">0</span>
                            </div>
                           
                            <div
                                class="flex items-center gap-2 p-2 bg-[#1a2539] text-white font-medium rounded-md shadow-inner">
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

        }).catch((err) => {
        }).finally(() => {
            setTimeout(() => {
                $('#loader-detail-alliance').hide()
            }, 2000);
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

    function getRestTimeFormation(time1, time2, clear) {
        var timer = Math.abs(Date.parse(time2) - Date.parse(time1));

        if (Date.parse(time2) - Date.parse(time1) > 0) {
            var timeinterval = setInterval(() => {
                timer = timer - 1000;
                var minutes = Math.floor((timer / 1000 / 60) % 60);
                var seconds = Math.floor((timer / 1000) % 60);
                var hours = Math.floor((timer / 1000 / 60 / 60) % 24);
                var days = Math.floor(timer / (1000 * 60 * 60 * 24));


                if (timer == 0) {
                    clearInterval(timeinterval);
                    return "Formation terminée";

                } else {
                    return `${timer}`;
                }
            }, 1000);
        } else {
            return "Error timer"
        }

    }

    function fetchDataFormation(id) {
        $('#loader-personnel-card').show()
        const promise = fetch("/dashboard/api/get-formations/" + id);
        promise.then((response) => {
            return response.json();
        }).then(function(data) {
            const htmlElement = document.getElementById('formation-list')
            htmlElement.innerHTML = "";
            data.data.forEach((element, index) => {
                const divElement = document.createElement('div');


                divElement.addEventListener('click', () => {
                    if (!element.isLocked && !element.isBuy) {
                        purchaseFormation(element)
                    }
                })
                divElement.classList.add("w-fit",
                    "text-center",
                    "h-96",
                    "w-full",
                    `${!element.isBuy ? "cursor-pointer" : "cursor-default"}`,
                    "flex",
                    "flex-col",
                    "items-center",
                    "justify-start",
                    `${(element.isBuy && element.isFinish )? "grayscale" : "grayscale-0"}`,
                    "shadow-xl", "bg-[#080b10]", "overflow-hidden",
                    "text-sm", "relative", "rounded-md",
                )
                // <img width="200"  class="w-full h-full opacity-50 objet-contain rounded-xl"
                //     src="/${element.image}" alt="product image" />
                divElement.innerHTML = `                                       
                                  
                                    <div class="flex flex-col items-center  justify-center w-full bg-blue-500 h-[100px] "> 
                                          <div class=" text-[14px] bg-white size-8 flex justify-center items-center rounded-full font-semibold text-center text-blue-500 uppercase">${index + 1}
                                        </div>
                                        <h4 class="my-2 text-[14px] font-thin text-center text-white uppercase">${element.libelle}
                                        </h4>
                                    </div> 
                                    ${(element.isBuy && element.isFinish )?  `<h2 class="text-center text-[18px] text-white my-2">Formation terminée</h2>` : `<h2 class="text-center text-[16px] text-white my-2">Durée de la formation</h2>
                                    <h2 class="text-center text-[18px] text-white my-2">${element.temps_formation}</h2>` }
                                
                                    <p  class="text-center p-4  text-white text-[12px]">
                                        ${element.description}
                                        </p>
                                    
                                    
                                         ${!element.isBuy ? `<button type="button"
                                            class=" gap-2 rounded-xl mx-auto mb-2 p-2.5 px-4 fill-white bg-white hover:bg-[#15244c] w-fit  flex items-center h-fit text-[#15244c] font-bold hover:text-white   text-left text-sm transition-all  cursor-pointer">Acheter
                                                <span 
                                                    class="font-bold text-yellow-500 ">${element.prix}</span>
                                                <img width="32" height="32"
                                                    src="{{ url('assets/images/icons8-money-48.png') }}" alt=""
                                                    srcset="">

                                        </button>` : ``}
                                    
                                     ${element.isLocked ? `
                                              <div
                                                class="absolute top-0 left-0 z-10 flex items-center justify-center w-full h-full mx-auto bg-black/60 ">
                                                <img width="64" height="64"
                                                    src="{{ url('assets/images/locked-svgrepo-com.png') }}" alt=""
                                                    srcset="">
                                            </div>
                                    ` : ""}
                `;

                if (element.isBuy && !element.isFinish) {
                    const divElementTimer = document.createElement('div');
                    divElementTimer.classList.add("w-full", "py-4", "text-yellow-400", "bottom-0",
                        "text-xl",
                        "left-0", "absolute", )
                    divElementTimer.id = "timer-card-personnel" + element.id;
                    countDownTimer(element.date_fin, divElementTimer, id,
                        "Fin de la formation dans", "end-formation", "action");
                    divElement.appendChild(divElementTimer)
                } else {

                }
                htmlElement.appendChild(divElement)
            });


        }).catch((err) => {
        }).finally(() => {
            setTimeout(() => {
                $('#loader-personnel-card').hide()
            }, 1500);
        })
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
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    $('#loader').hide()
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
        const formValues = Object.fromEntries(formData.entries())
        purchaseItem(e.target.name, formValues);
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
            })
            messagesContainer = document.getElementById("messagesContainer");
            messagesContainer.scrollTop = messagesContainer
                .scrollHeight;
            $("#messagesContainer").animate({
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
                $('#message-input').val(message);
                $('#button-chat').attr('disabled', false);
                $('#button-chat').text('Envoyer');
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
                $('#message-input-alliance').val(message);
                $('#button-chat-alliance').attr('disabled', false);
                $('#button-chat-alliance').text('Envoyer');
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

    $("#alert-mission").hide();
    //#region Map data
    function getRandomArbitrary(min, max) {
        return Math.random() * (max - min) + min;
    }
    let lockAlertMission = false;

    function loadDataMap() {
        const promise = fetch("/dashboard/api/get-map-data");
        promise.then((response) => {
            return response.json();
        }).then(function(data) {
            if (data.data.totalMissions > 2) {
                lockAlertMission = true;
                $("#alert-mission").hide();
            }
            if (!lockAlertMission) {
                loadMission()
            }

        }).catch((err) => {
        })
    }

    
    function loadMission() {
        const wesPromiseMission = fetch("/dashboard/api/get-mission");
        wesPromiseMission.then((response) => {
            return response.json();
        }).then(function(data) {
            setTimeout(() => {
                const audio = document.getElementById('audio')
                audio.play()
                $("#alert-mission").show();
                $("#timer-regulation-samu").text(countDownTimer(data.data.temps_restant, document.getElementById("timer-regulation-samu"), "", "", ""))
                $('#message-regulation-samu').text(data.data.mission.description_mission)
            }, getRandomArbitrary(10, 20) * 1000);
        })
    }
    //#endregion End Map data
