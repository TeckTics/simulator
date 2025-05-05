<div class="flex flex-col items-center gap-2 justify-evenly">
    <div class="w-24 flex justify-center items-center h-24 overflow-hidden p-2 rounded-full bg-[#14213e]">
        <img class="w-20 h-20 rounded-full "
            src="{{ asset(Auth::guard('appuser')->user()->profile ?? '/assets/images/user-profile.png') }}"
            alt="Default avatar">
    </div>
    <h3 class="text-white">{{ Auth::guard('appuser')->user()->pseudo }}</h3>
    <h3 class="text-white clan-user-name"></h3>
    <h3 class="text-sm font-thin text-white/70" style="font-weight: 100">
        {{ Auth::guard('appuser')->user()->email }}</h3>
</div>
<div class="p-2">
    <ul class=" bg-[#051129b3] rounded-xl ">
        {{-- <li>
            <button name="shop-panel" @class([
                'w-full gap-8 p-4 fill-white show-modal hover:fill-blue-500 flex items-center h-full text-white/70 hover:text-white hover:text-blue-500 hover:border-r-8 hover:border-r-blue-500 text-left text-sm transition-all rounded-sm cursor-pointer',
            ])>
                <!-- Uploaded to: SVG Repo, www.svgrepo.com, Generator: SVG Repo Mixer Tools -->
                <svg height="25px" width="25px" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg"
                    xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 44.16 44.16" xml:space="preserve">
                    <g>
                        <path d="M44.16,6.6H11.592L10.66,1.179H2.408C1.076,1.179,0,2.257,0,3.588v2.408h6.602l4.248,24.709
                       c0.094,0.544,0.617,0.985,1.17,0.985h28.527c1.332,0,2.41-1.077,2.41-2.411v-2.406H15.078l-0.587-3.414h22.042
                       c2.66,0,5.172-2.128,5.611-4.75L44.16,6.6z" />
                        <circle cx="19.47" cy="38.817" r="4.165" />
                        <path d="M29.762,38.816c0,2.299,1.863,4.164,4.162,4.164c2.301,0,4.168-1.865,4.168-4.164
                       c0-2.299-1.867-4.166-4.168-4.166C31.625,34.65,29.762,36.518,29.762,38.816z" />
                    </g>
                </svg>
                Boutique
            </button>
        </li> --}}
        <li>

            <button data-drawer-hide="drawer-example" aria-controls="drawer-example" name="alliance-panel"
                @class([
                    'w-full gap-8 p-4 fill-white show-modal hover:fill-blue-500 flex items-center h-full  text-white/70 hover:text-white hover:text-blue-500 hover:border-r-8 hover:border-r-blue-500 text-left text-sm transition-all rounded-sm cursor-pointer',
                ])>
                <?xml version="1.0" encoding="iso-8859-1"?>
                <!-- Uploaded to: SVG Repo, www.svgrepo.com, Generator: SVG Repo Mixer Tools -->
                <?xml version="1.0" encoding="utf-8"?>
                <!-- Uploaded to: SVG Repo, www.svgrepo.com, Generator: SVG Repo Mixer Tools -->
                <svg width="25px" height="25px" viewBox="-3 0 32 32" version="1.1"
                    xmlns="http://www.w3.org/2000/svg">
                    <title>group</title>
                    <path
                        d="M20.906 20.75c1.313 0.719 2.063 2 1.969 3.281-0.063 0.781-0.094 0.813-1.094 0.938-0.625 0.094-4.563 0.125-8.625 0.125-4.594 0-9.406-0.094-9.75-0.188-1.375-0.344-0.625-2.844 1.188-4.031 1.406-0.906 4.281-2.281 5.063-2.438 1.063-0.219 1.188-0.875 0-3-0.281-0.469-0.594-1.906-0.625-3.406-0.031-2.438 0.438-4.094 2.563-4.906 0.438-0.156 0.875-0.219 1.281-0.219 1.406 0 2.719 0.781 3.25 1.938 0.781 1.531 0.469 5.625-0.344 7.094-0.938 1.656-0.844 2.188 0.188 2.469 0.688 0.188 2.813 1.188 4.938 2.344zM3.906 19.813c-0.5 0.344-0.969 0.781-1.344 1.219-1.188 0-2.094-0.031-2.188-0.063-0.781-0.188-0.344-1.625 0.688-2.25 0.781-0.5 2.375-1.281 2.813-1.375 0.563-0.125 0.688-0.469 0-1.656-0.156-0.25-0.344-1.063-0.344-1.906-0.031-1.375 0.25-2.313 1.438-2.719 1-0.375 2.125 0.094 2.531 0.938 0.406 0.875 0.188 3.125-0.25 3.938-0.5 0.969-0.406 1.219 0.156 1.375 0.125 0.031 0.375 0.156 0.719 0.313-1.375 0.563-3.25 1.594-4.219 2.188zM24.469 18.625c0.75 0.406 1.156 1.094 1.094 1.813-0.031 0.438-0.031 0.469-0.594 0.531-0.156 0.031-0.875 0.063-1.813 0.063-0.406-0.531-0.969-1.031-1.656-1.375-1.281-0.75-2.844-1.563-4-2.063 0.313-0.125 0.594-0.219 0.719-0.25 0.594-0.125 0.688-0.469 0-1.656-0.125-0.25-0.344-1.063-0.344-1.906-0.031-1.375 0.219-2.313 1.406-2.719 1.031-0.375 2.156 0.094 2.531 0.938 0.406 0.875 0.25 3.125-0.188 3.938-0.5 0.969-0.438 1.219 0.094 1.375 0.375 0.125 1.563 0.688 2.75 1.313z">
                    </path>
                </svg>
                Alliances
            </button>
        </li>
        <li id="accordion-collapse">
            <button type="button" @class([
                'w-full gap-8 p-4 accordion-collapse-heading fill-white  hover:fill-blue-500 flex items-center h-full  text-white/70 hover:text-white hover:text-blue-500 hover:border-r-8 hover:border-r-blue-500 text-left text-sm transition-all rounded-sm cursor-pointer',
            ])>
                <svg width="25px" height="25px" viewBox="0 0 50 50" xmlns="http://www.w3.org/2000/svg"
                    xmlns:xlink="http://www.w3.org/1999/xlink">
                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                    <g id="SVGRepo_iconCarrier">
                        <path
                            d="M26 0C25.449219 0 25 0.449219 25 1L25 3C25 3.550781 25.449219 4 26 4C26.554688 4 27 3.550781 27 3L27 1C27 0.449219 26.554688 0 26 0 Z M 18.9375 2.9375C18.683594 2.9375 18.414063 3.023438 18.21875 3.21875C17.828125 3.609375 17.828125 4.234375 18.21875 4.625L19.625 6.0625C19.820313 6.257813 20.085938 6.34375 20.34375 6.34375C20.601563 6.34375 20.867188 6.257813 21.0625 6.0625C21.453125 5.671875 21.453125 5.015625 21.0625 4.625L19.625 3.21875C19.429688 3.023438 19.191406 2.9375 18.9375 2.9375 Z M 33.0625 2.9375C32.808594 2.9375 32.570313 3.023438 32.375 3.21875L30.9375 4.625C30.546875 5.015625 30.546875 5.671875 30.9375 6.0625C31.132813 6.257813 31.398438 6.34375 31.65625 6.34375C31.914063 6.34375 32.179688 6.257813 32.375 6.0625L33.78125 4.625C34.171875 4.234375 34.171875 3.609375 33.78125 3.21875C33.585938 3.023438 33.316406 2.9375 33.0625 2.9375 Z M 26 6C23.792969 6 22 7.792969 22 10L22 11L30 11L30 10C30 7.792969 28.207031 6 26 6 Z M 16 9C15.449219 9 15 9.449219 15 10C15 10.550781 15.449219 11 16 11L18 11C18.550781 11 19 10.550781 19 10C19 9.449219 18.550781 9 18 9 Z M 34 9C33.445313 9 33 9.449219 33 10C33 10.550781 33.445313 11 34 11L36 11C36.554688 11 37 10.550781 37 10C37 9.449219 36.554688 9 36 9 Z M 2.78125 13C1.253906 13 0 14.234375 0 15.75L0 40.25C0 41.765625 1.253906 43 2.78125 43L7 43C7 46.308594 9.691406 49 13 49C16.308594 49 19 46.308594 19 43L33 43C33 46.308594 35.691406 49 39 49C42.308594 49 45 46.308594 45 43L47.21875 43C48.746094 43 50 41.765625 50 40.25L50 33.25C50 31.324219 48.628906 29.363281 48.5 29.1875L39.46875 15.21875C39.445313 15.183594 39.402344 15.125 39.375 15.09375L39.1875 14.90625C38.414063 13.976563 37.640625 13 35.96875 13 Z M 32 18L38.84375 18L46 29L32 29 Z M 14 21L16 21L16 25L20 25L20 27L16 27L16 31L14 31L14 27L10 27L10 25L14 25 Z M 13 39C15.207031 39 17 40.792969 17 43C17 45.207031 15.207031 47 13 47C10.792969 47 9 45.207031 9 43C9 40.792969 10.792969 39 13 39 Z M 39 39C41.207031 39 43 40.792969 43 43C43 45.207031 41.207031 47 39 47C36.792969 47 35 45.207031 35 43C35 40.792969 36.792969 39 39 39Z">
                        </path>
                    </g>
                </svg>
                Equipements & unités
            </button>
            <div class="hidden accordion-collapse-body">
                <div class="py-2 bg-gray-900 pl-14">
                    <button data-drawer-hide="drawer-example" aria-controls="drawer-example" type="button"
                        name="equipments-panel" @class([
                            'w-full gap-8 p-3  fill-white show-modal  hover:fill-blue-500 flex items-center h-full  text-white/70 hover:text-white hover:text-blue-500 hover:border-r-8 hover:border-r-blue-500 text-left text-sm transition-all rounded-sm cursor-pointer',
                        ])>

                        Unités
                    </button>
                    <button data-drawer-hide="drawer-example" aria-controls="drawer-example" type="button"
                        name="personnels-panel" @class([
                            'w-full gap-8 p-3  fill-white show-modal  hover:fill-blue-500 flex items-center h-full  text-white/70 hover:text-white hover:text-blue-500 hover:border-r-8 hover:border-r-blue-500 text-left text-sm transition-all rounded-sm cursor-pointer',
                        ])>

                        Personnel SAMU
                    </button>
                    <button data-drawer-hide="drawer-example" aria-controls="drawer-example" type="button"
                        @class([
                            '   w-full gap-8 p-3  fill-white show-modal  hover:fill-blue-500 flex items-center h-full  text-white/70 hover:text-white hover:text-blue-500 hover:border-r-8 hover:border-r-blue-500 text-left text-sm transition-all rounded-sm cursor-pointer',
                        ])>

                        Equipements
                    </button>
                </div>
            </div>
        </li>
        <li>
            <button data-drawer-hide="drawer-example" aria-controls="drawer-example" name="ranking-panel"
                @class([
                    'w-full gap-8 p-4 fill-white show-modal hover:fill-blue-500 flex items-center h-full  text-white/70 hover:text-white hover:text-blue-500 hover:border-r-8 hover:border-r-blue-500 text-left text-sm transition-all rounded-sm cursor-pointer',
                ])>
                <svg width="25px" height="25px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                    <g id="SVGRepo_iconCarrier">
                        <path
                            d="M11 10H13C14.4142 10 15.1213 10 15.5607 10.4393C16 10.8787 16 11.5858 16 13V19C16 17.5858 16 16.8787 16.4393 16.4393C16.8787 16 17.5858 16 19 16C20.4142 16 21.1213 16 21.5607 16.4393C22 16.8787 22 17.5858 22 19V22H16H8H2C2 20.5858 2 19.8787 2.43934 19.4393C2.87868 19 3.58579 19 5 19C6.41421 19 7.12132 19 7.56066 19.4393C8 19.8787 8 20.5858 8 22V13C8 11.5858 8 10.8787 8.43934 10.4393C8.87868 10 9.58579 10 11 10Z">
                        </path>
                        <path
                            d="M11.1459 3.02251C11.5259 2.34084 11.7159 2 12 2C12.2841 2 12.4741 2.34084 12.8541 3.02251L12.9524 3.19887C13.0603 3.39258 13.1143 3.48944 13.1985 3.55334C13.2827 3.61725 13.3875 3.64097 13.5972 3.68841L13.7881 3.73161C14.526 3.89857 14.895 3.98205 14.9828 4.26432C15.0706 4.54659 14.819 4.84072 14.316 5.42898L14.1858 5.58117C14.0429 5.74833 13.9714 5.83191 13.9392 5.93531C13.9071 6.03872 13.9179 6.15023 13.9395 6.37327L13.9592 6.57632C14.0352 7.36118 14.0733 7.75361 13.8435 7.92807C13.6136 8.10252 13.2682 7.94346 12.5773 7.62535L12.3986 7.54305C12.2022 7.45265 12.1041 7.40745 12 7.40745C11.8959 7.40745 11.7978 7.45265 11.6014 7.54305L11.4227 7.62535C10.7318 7.94346 10.3864 8.10252 10.1565 7.92807C9.92674 7.75361 9.96476 7.36118 10.0408 6.57632L10.0605 6.37327C10.0821 6.15023 10.0929 6.03872 10.0608 5.93531C10.0286 5.83191 9.95713 5.74833 9.81418 5.58117L9.68403 5.42898C9.18097 4.84072 8.92945 4.54659 9.01723 4.26432C9.10501 3.98205 9.47396 3.89857 10.2119 3.73161L10.4028 3.68841C10.6125 3.64097 10.7173 3.61725 10.8015 3.55334C10.8857 3.48944 10.9397 3.39258 11.0476 3.19887L11.1459 3.02251Z">
                        </path>
                    </g>
                </svg>
                Classement
            </button>
        </li>

        <li>
            <button data-drawer-hide="drawer-example" aria-controls="drawer-example" name="setting-panel"
                @class([
                    'w-full gap-8 p-4 show-modal fill-white  hover:fill-blue-500 flex items-center h-full  text-white/70 hover:text-white hover:text-blue-500 hover:border-r-8 hover:border-r-blue-500 text-left text-sm transition-all rounded-sm cursor-pointer',
                ])>
                <svg width="25px" height="25px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                    <g id="SVGRepo_iconCarrier">
                        <path
                            d="M20.1 9.2214C18.29 9.2214 17.55 7.9414 18.45 6.3714C18.97 5.4614 18.66 4.3014 17.75 3.7814L16.02 2.7914C15.23 2.3214 14.21 2.6014 13.74 3.3914L13.63 3.5814C12.73 5.1514 11.25 5.1514 10.34 3.5814L10.23 3.3914C9.78 2.6014 8.76 2.3214 7.97 2.7914L6.24 3.7814C5.33 4.3014 5.02 5.4714 5.54 6.3814C6.45 7.9414 5.71 9.2214 3.9 9.2214C2.86 9.2214 2 10.0714 2 11.1214V12.8814C2 13.9214 2.85 14.7814 3.9 14.7814C5.71 14.7814 6.45 16.0614 5.54 17.6314C5.02 18.5414 5.33 19.7014 6.24 20.2214L7.97 21.2114C8.76 21.6814 9.78 21.4014 10.25 20.6114L10.36 20.4214C11.26 18.8514 12.74 18.8514 13.65 20.4214L13.76 20.6114C14.23 21.4014 15.25 21.6814 16.04 21.2114L17.77 20.2214C18.68 19.7014 18.99 18.5314 18.47 17.6314C17.56 16.0614 18.3 14.7814 20.11 14.7814C21.15 14.7814 22.01 13.9314 22.01 12.8814V11.1214C22 10.0814 21.15 9.2214 20.1 9.2214ZM12 15.2514C10.21 15.2514 8.75 13.7914 8.75 12.0014C8.75 10.2114 10.21 8.7514 12 8.7514C13.79 8.7514 15.25 10.2114 15.25 12.0014C15.25 13.7914 13.79 15.2514 12 15.2514Z">
                        </path>
                    </g>
                </svg>
                Paramètres
            </button>
        </li>

        <li>
            <button data-drawer-hide="drawer-example" aria-controls="drawer-example" name="profil-panel"
                @class([
                    'w-full gap-8 p-4 fill-white show-modal hover:fill-blue-500 flex items-center h-full  text-white/70 hover:text-white hover:text-blue-500 hover:border-r-8 hover:border-r-blue-500 text-left text-sm transition-all rounded-sm cursor-pointer',
                ])>
                <svg width="25px" height="25px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                    <g id="SVGRepo_iconCarrier">
                        <path
                            d="M20.1 9.2214C18.29 9.2214 17.55 7.9414 18.45 6.3714C18.97 5.4614 18.66 4.3014 17.75 3.7814L16.02 2.7914C15.23 2.3214 14.21 2.6014 13.74 3.3914L13.63 3.5814C12.73 5.1514 11.25 5.1514 10.34 3.5814L10.23 3.3914C9.78 2.6014 8.76 2.3214 7.97 2.7914L6.24 3.7814C5.33 4.3014 5.02 5.4714 5.54 6.3814C6.45 7.9414 5.71 9.2214 3.9 9.2214C2.86 9.2214 2 10.0714 2 11.1214V12.8814C2 13.9214 2.85 14.7814 3.9 14.7814C5.71 14.7814 6.45 16.0614 5.54 17.6314C5.02 18.5414 5.33 19.7014 6.24 20.2214L7.97 21.2114C8.76 21.6814 9.78 21.4014 10.25 20.6114L10.36 20.4214C11.26 18.8514 12.74 18.8514 13.65 20.4214L13.76 20.6114C14.23 21.4014 15.25 21.6814 16.04 21.2114L17.77 20.2214C18.68 19.7014 18.99 18.5314 18.47 17.6314C17.56 16.0614 18.3 14.7814 20.11 14.7814C21.15 14.7814 22.01 13.9314 22.01 12.8814V11.1214C22 10.0814 21.15 9.2214 20.1 9.2214ZM12 15.2514C10.21 15.2514 8.75 13.7914 8.75 12.0014C8.75 10.2114 10.21 8.7514 12 8.7514C13.79 8.7514 15.25 10.2114 15.25 12.0014C15.25 13.7914 13.79 15.2514 12 15.2514Z">
                        </path>
                    </g>
                </svg>
                Profile
            </button>
        </li>
        <li>
            {{-- href="{{ route('logout') }}" --}}
            <a id="logout-button" onclick="confirmLogout()">
                <button @class([
                    'w-full gap-8 w-full fill-white p-4  hover:fill-red-500 flex items-center h-full text-red-500/70 hover:text-red-500 hover:text-red-500 hover:border-r-8 hover:border-r-red-500 text-left text-sm transition-all rounded-sm cursor-pointer',
                ])>
                    <svg height="24" width="24" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 496.158 496.158" xml:space="preserve"
                        fill="#000000">
                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                        <g id="SVGRepo_iconCarrier">
                            <path style="fill:#ffffff05;"
                                d="M496.158,248.085c0-137.021-111.07-248.082-248.076-248.082C111.07,0.003,0,111.063,0,248.085 c0,137.002,111.07,248.07,248.082,248.07C385.088,496.155,496.158,385.087,496.158,248.085z">
                            </path>
                            <g>
                                <path style="fill:#D63232;"
                                    d="M373.299,154.891c-19.558-26.212-47.401-46.023-78.401-55.787c-0.759-0.238-1.588-0.103-2.229,0.369 c-0.643,0.471-1.021,1.22-1.021,2.016l0.16,40.256c0,1.074,0.514,2.06,1.332,2.562c31.732,19.456,66.504,47,66.504,103.237 c0,61.515-50.047,111.56-111.562,111.56c-61.517,0-111.566-50.045-111.566-111.56c0-58.737,35.199-84.661,67.615-103.917 c0.836-0.496,1.363-1.492,1.363-2.58l0.154-39.909c0-0.793-0.375-1.539-1.013-2.01c-0.638-0.472-1.46-0.611-2.219-0.381 c-31.283,9.586-59.41,29.357-79.202,55.672c-20.467,27.215-31.285,59.603-31.285,93.662c0,86.099,70.049,156.146,156.152,156.146 c86.1,0,156.147-70.047,156.147-156.146C404.228,214.235,393.533,182.01,373.299,154.891z">
                                </path>
                                <path style="fill:#D63232;"
                                    d="M251.851,67.009h-7.549c-11.788,0-21.378,9.59-21.378,21.377v181.189 c0,11.787,9.59,21.377,21.378,21.377h7.549c11.788,0,21.378-9.59,21.378-21.377V88.386 C273.229,76.599,263.64,67.009,251.851,67.009z">
                                </path>
                            </g>
                        </g>
                    </svg>
                    Se déconnecter
                </button>
            </a>
        </li>
    </ul>
</div>


@include('components.confirm.logout-confirm')
