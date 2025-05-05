<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../../../assets/output.css" rel="stylesheet">
    <!-- <link href="../../../assets/global.css" rel="stylesheet"> -->
  
    <title>Nouveau mot de passe - urgenceSamu</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script
        src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp,container-queries"></script>
</head>

<body>
    <main class="relative">
        <div class="fixed top-0 left-0 z-50 w-full h-full ">
        <div class="grid min-h-screen md:grid-cols-2 bg-violet-50" style="background-color: #dadaff;">
            <div class="flex flex-col items-center justify-center " style="background-color: #3232a7;">
                <div class="relative z-10">
                    <h1 class="text-7xl my-4 font-bold text-white">UrgenceSAMU</h1>
                    <p class="text-white">Entrez dans la monde des équipes du SAMU</p>
                </div>
                <img src="../assets/images/3d-business-black-doctor-standing-with-clipboard-and-writing.png" alt="" class="absolute opacity-20 z-0"  srcset="">
            </div>
            <div class="fixed top-0 flex items-center justify-center w-full h-full p-3 md:p-0 md:relative">
                <form id="form" class="z-0 w-full p-10 m-auto bg-white rounded-md shadow-xl "
                    style="max-width: 456px;  ">
                    <div class="space-y-12">
                        <div class="pb-12 ">
                            <h2 class="text-2xl leading-7 text-gray-900">Nouveau mot de passe</h2>
                            <div class="grid grid-cols-1 gap-4 py-4 mt-4">
                                <div class="block ">
                                    <label for="password" class="text-sm">Nouveau mot de passe</label>
                                    <div class="relative mt-1">
                                        <input type="password"
                                            class="w-full p-3 text-sm focus-visible:bg-violet-100/40 focus-visible:outline-violet-500 focus-visible:outline-1 focus-visible:placeholder:text-violet-500 rounded-xl bg-stone-100"
                                            placeholder="Password" name="password" id="password">
                                        <button type="button" id="passwordButton" name="showpasswordButton"
                                            class="absolute -translate-y-1/2 top-1/2 right-2 opacity-30">
                                            <svg id="hiddenPassword" width="24px" class="hidden" height="24px"
                                                viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                    stroke-linejoin="round"></g>
                                                <g id="SVGRepo_iconCarrier">
                                                    <path opacity="0.1"
                                                        d="M6.29528 7.87634L5 9.17162C3.66667 10.505 3 11.1716 3 12C3 12.8285 3.66667 13.4951 5 14.8285L7.12132 16.9498C9.85499 19.6835 14.2871 19.6835 17.0208 16.9498L17.4322 16.5384L14.5053 14.2619C13.9146 14.8713 13.0873 15.2501 12.1716 15.2501C10.3766 15.2501 8.92157 13.795 8.92157 12.0001C8.92157 11.3746 9.09827 10.7904 9.40447 10.2946L6.29528 7.87634Z"
                                                        fill="#323232"></path>
                                                    <path d="M3.17139 5.12988L21.1714 19.1299" stroke="#323232"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                    </path>
                                                    <path
                                                        d="M14.3653 13.8456C13.8162 14.5483 12.9609 15 12 15C10.3431 15 9 13.6569 9 12C9 11.3256 9.22253 10.7032 9.59817 10.2021"
                                                        stroke="#323232" stroke-width="2"></path>
                                                    <path
                                                        d="M9 5.62667C11.5803 4.45322 14.7268 4.92775 16.8493 7.05025L19.8511 10.052C20.3477 10.5486 20.5959 10.7969 20.7362 11.0605C21.0487 11.6479 21.0487 12.3521 20.7362 12.9395C20.5959 13.2031 20.3477 13.4514 19.8511 13.948V13.948L19.799 14"
                                                        stroke="#323232" stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round"></path>
                                                    <path
                                                        d="M7.01596 8.39827C7.40649 8.00774 7.40649 7.37458 7.01596 6.98406C6.62544 6.59353 5.99228 6.59353 5.60175 6.98406L7.01596 8.39827ZM7.65685 16.2427L5.53553 14.1213L4.12132 15.5356L6.24264 17.6569L7.65685 16.2427ZM16.1421 16.2427C13.799 18.5858 10 18.5858 7.65685 16.2427L6.24264 17.6569C9.36684 20.7811 14.4322 20.7811 17.5563 17.6569L16.1421 16.2427ZM5.53553 9.8787L7.01596 8.39827L5.60175 6.98406L4.12132 8.46449L5.53553 9.8787ZM16.7465 15.6383L16.1421 16.2427L17.5563 17.6569L18.1607 17.0526L16.7465 15.6383ZM5.53553 14.1213C4.84888 13.4347 4.40652 12.9893 4.12345 12.6183C3.85798 12.2704 3.82843 12.1077 3.82843 12H1.82843C1.82843 12.7208 2.1322 13.3056 2.53341 13.8315C2.917 14.3342 3.47464 14.8889 4.12132 15.5356L5.53553 14.1213ZM4.12132 8.46449C3.47464 9.11116 2.917 9.6658 2.53341 10.1686C2.1322 10.6944 1.82843 11.2792 1.82843 12H3.82843C3.82843 11.8924 3.85798 11.7297 4.12345 11.3817C4.40652 11.0107 4.84888 10.5654 5.53553 9.8787L4.12132 8.46449Z"
                                                        fill="#323232"></path>
                                                </g>
                                            </svg>
                                            <svg id="showPassword" width="24px" height="24px" viewBox="0 0 24 24"
                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                    stroke-linejoin="round"></g>
                                                <g id="SVGRepo_iconCarrier">
                                                    <g id="style=stroke">
                                                        <g id="eye-open">
                                                            <path id="vector (Stroke)" fill-rule="evenodd"
                                                                clip-rule="evenodd"
                                                                d="M12 9.75C10.755 9.75 9.75 10.755 9.75 12C9.75 13.245 10.755 14.25 12 14.25C13.245 14.25 14.25 13.245 14.25 12C14.25 10.755 13.245 9.75 12 9.75ZM8.25 12C8.25 9.92657 9.92657 8.25 12 8.25C14.0734 8.25 15.75 9.92657 15.75 12C15.75 14.0734 14.0734 15.75 12 15.75C9.92657 15.75 8.25 14.0734 8.25 12Z"
                                                                fill="#000000"></path>
                                                            <path id="vector (Stroke)_2" fill-rule="evenodd"
                                                                clip-rule="evenodd"
                                                                d="M2.28282 9.27342C4.69299 5.94267 8.19618 3.96997 12.0001 3.96997C15.8042 3.96997 19.3075 5.94286 21.7177 9.27392C22.2793 10.0479 22.5351 11.0421 22.5351 11.995C22.5351 12.948 22.2792 13.9424 21.7174 14.7165C19.3072 18.0473 15.804 20.02 12.0001 20.02C8.19599 20.02 4.69264 18.0471 2.28246 14.716C1.7209 13.942 1.46509 12.9478 1.46509 11.995C1.46509 11.0419 1.721 10.0475 2.28282 9.27342ZM12.0001 5.46997C8.74418 5.46997 5.66753 7.15436 3.49771 10.1532L3.497 10.1542C3.15906 10.6197 2.96509 11.2866 2.96509 11.995C2.96509 12.7033 3.15906 13.3703 3.497 13.8357L3.49771 13.8367C5.66753 16.8356 8.74418 18.52 12.0001 18.52C15.256 18.52 18.3326 16.8356 20.5025 13.8367L20.5032 13.8357C20.8411 13.3703 21.0351 12.7033 21.0351 11.995C21.0351 11.2866 20.8411 10.6197 20.5032 10.1542L20.5025 10.1532C18.3326 7.15436 15.256 5.46997 12.0001 5.46997Z"
                                                                fill="#000000"></path>
                                                        </g>
                                                    </g>
                                                </g>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                                <div class="block ">
                                    <label for="confirmPassword" class="text-sm">Confirmer le nouveau mot de passe</label>
                                    <div class="relative mt-1">
                                        <input type="password"
                                            class="w-full p-3 text-sm focus-visible:bg-violet-100/40 focus-visible:outline-violet-500 focus-visible:outline-1 focus-visible:placeholder:text-violet-500 rounded-xl bg-stone-100"
                                            placeholder="Confirm Password" name="confirmPassword" id="confirmPassword">
                                        <button type="button" id="confirmPasswordButton"
                                            name="showConfirmPasswordButton"
                                            class="absolute -translate-y-1/2 top-1/2 right-2 opacity-30">
                                            <svg id="hiddenConfirmPassword" width="24px" class="hidden" height="24px"
                                                viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                    stroke-linejoin="round"></g>
                                                <g id="SVGRepo_iconCarrier">
                                                    <path opacity="0.1"
                                                        d="M6.29528 7.87634L5 9.17162C3.66667 10.505 3 11.1716 3 12C3 12.8285 3.66667 13.4951 5 14.8285L7.12132 16.9498C9.85499 19.6835 14.2871 19.6835 17.0208 16.9498L17.4322 16.5384L14.5053 14.2619C13.9146 14.8713 13.0873 15.2501 12.1716 15.2501C10.3766 15.2501 8.92157 13.795 8.92157 12.0001C8.92157 11.3746 9.09827 10.7904 9.40447 10.2946L6.29528 7.87634Z"
                                                        fill="#323232"></path>
                                                    <path d="M3.17139 5.12988L21.1714 19.1299" stroke="#323232"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                    </path>
                                                    <path
                                                        d="M14.3653 13.8456C13.8162 14.5483 12.9609 15 12 15C10.3431 15 9 13.6569 9 12C9 11.3256 9.22253 10.7032 9.59817 10.2021"
                                                        stroke="#323232" stroke-width="2"></path>
                                                    <path
                                                        d="M9 5.62667C11.5803 4.45322 14.7268 4.92775 16.8493 7.05025L19.8511 10.052C20.3477 10.5486 20.5959 10.7969 20.7362 11.0605C21.0487 11.6479 21.0487 12.3521 20.7362 12.9395C20.5959 13.2031 20.3477 13.4514 19.8511 13.948V13.948L19.799 14"
                                                        stroke="#323232" stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round"></path>
                                                    <path
                                                        d="M7.01596 8.39827C7.40649 8.00774 7.40649 7.37458 7.01596 6.98406C6.62544 6.59353 5.99228 6.59353 5.60175 6.98406L7.01596 8.39827ZM7.65685 16.2427L5.53553 14.1213L4.12132 15.5356L6.24264 17.6569L7.65685 16.2427ZM16.1421 16.2427C13.799 18.5858 10 18.5858 7.65685 16.2427L6.24264 17.6569C9.36684 20.7811 14.4322 20.7811 17.5563 17.6569L16.1421 16.2427ZM5.53553 9.8787L7.01596 8.39827L5.60175 6.98406L4.12132 8.46449L5.53553 9.8787ZM16.7465 15.6383L16.1421 16.2427L17.5563 17.6569L18.1607 17.0526L16.7465 15.6383ZM5.53553 14.1213C4.84888 13.4347 4.40652 12.9893 4.12345 12.6183C3.85798 12.2704 3.82843 12.1077 3.82843 12H1.82843C1.82843 12.7208 2.1322 13.3056 2.53341 13.8315C2.917 14.3342 3.47464 14.8889 4.12132 15.5356L5.53553 14.1213ZM4.12132 8.46449C3.47464 9.11116 2.917 9.6658 2.53341 10.1686C2.1322 10.6944 1.82843 11.2792 1.82843 12H3.82843C3.82843 11.8924 3.85798 11.7297 4.12345 11.3817C4.40652 11.0107 4.84888 10.5654 5.53553 9.8787L4.12132 8.46449Z"
                                                        fill="#323232"></path>
                                                </g>
                                            </svg>
                                            <svg id="showConfirmPassword" width="24px" height="24px" viewBox="0 0 24 24"
                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                    stroke-linejoin="round"></g>
                                                <g id="SVGRepo_iconCarrier">
                                                    <g id="style=stroke">
                                                        <g id="eye-open">
                                                            <path id="vector (Stroke)" fill-rule="evenodd"
                                                                clip-rule="evenodd"
                                                                d="M12 9.75C10.755 9.75 9.75 10.755 9.75 12C9.75 13.245 10.755 14.25 12 14.25C13.245 14.25 14.25 13.245 14.25 12C14.25 10.755 13.245 9.75 12 9.75ZM8.25 12C8.25 9.92657 9.92657 8.25 12 8.25C14.0734 8.25 15.75 9.92657 15.75 12C15.75 14.0734 14.0734 15.75 12 15.75C9.92657 15.75 8.25 14.0734 8.25 12Z"
                                                                fill="#000000"></path>
                                                            <path id="vector (Stroke)_2" fill-rule="evenodd"
                                                                clip-rule="evenodd"
                                                                d="M2.28282 9.27342C4.69299 5.94267 8.19618 3.96997 12.0001 3.96997C15.8042 3.96997 19.3075 5.94286 21.7177 9.27392C22.2793 10.0479 22.5351 11.0421 22.5351 11.995C22.5351 12.948 22.2792 13.9424 21.7174 14.7165C19.3072 18.0473 15.804 20.02 12.0001 20.02C8.19599 20.02 4.69264 18.0471 2.28246 14.716C1.7209 13.942 1.46509 12.9478 1.46509 11.995C1.46509 11.0419 1.721 10.0475 2.28282 9.27342ZM12.0001 5.46997C8.74418 5.46997 5.66753 7.15436 3.49771 10.1532L3.497 10.1542C3.15906 10.6197 2.96509 11.2866 2.96509 11.995C2.96509 12.7033 3.15906 13.3703 3.497 13.8357L3.49771 13.8367C5.66753 16.8356 8.74418 18.52 12.0001 18.52C15.256 18.52 18.3326 16.8356 20.5025 13.8367L20.5032 13.8357C20.8411 13.3703 21.0351 12.7033 21.0351 11.995C21.0351 11.2866 20.8411 10.6197 20.5032 10.1542L20.5025 10.1532C18.3326 7.15436 15.256 5.46997 12.0001 5.46997Z"
                                                                fill="#000000"></path>
                                                        </g>
                                                    </g>
                                                </g>
                                            </svg>
                                        </button>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div>
                        <button type="submit"
                            class="w-full p-3 my-2 text-sm text-white rounded-md bg-stone-950 hover:bg-stone-900">Reinitialiser</button>
                        <p class="text-xs sm:text-sm text-stone-700">
                           Retourner à la page de connexion en cliquant <a href="connexion.html" class="text-violet-500 " id="backButton">ici </a>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </main>
</body>
<script>

    const passwordButton = document.getElementById("passwordButton");
    const hiddenPassword = document.getElementById("hiddenPassword");
    const showPassword = document.getElementById("showPassword");
    const password = document.getElementById("password");
    const confirmPasswordButton = document.getElementById("confirmPasswordButton");
    const hiddenConfirmPassword = document.getElementById("hiddenConfirmPassword");
    const showConfirmPassword = document.getElementById("showConfirmPassword");
    const confirmPassword = document.getElementById("confirmPassword");
    const form = document.getElementById("form");
    let signInMethod = false;
    window.addEventListener('load', () => {
        let show = false;
        let showConfirm = false;
        passwordButton.addEventListener('click', () => {
            if (!show) {
                hiddenPassword.classList.remove('hidden');
                showPassword.classList.add('hidden');
                password.type = 'text';
                show = true;
            } else {
                hiddenPassword.classList.add('hidden');
                showPassword.classList.remove('hidden');
                password.type = 'password';
                show = false;
            }
        })
        confirmPasswordButton.addEventListener('click', () => {
            if (!showConfirm) {
                hiddenConfirmPassword.classList.remove('hidden');
                showConfirmPassword.classList.add('hidden');
                confirmPassword.type = 'text';
                showConfirm = true;
            } else {
                hiddenConfirmPassword.classList.add('hidden');
                showConfirmPassword.classList.remove('hidden');
                confirmPassword.type = 'password';
                showConfirm = false;
            }
        })
        form.addEventListener('submit', (e) => {
            e.preventDefault()
            window.location.href = "signIn.html"
        })

    })

</script>

</html>