<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NosiArt'Afro Cup</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<?php
    //  $conn = new mysqli('localhost', 'afrocup_user', '123456', 'afrocup_db');

    $response = array();
    $upload_dir = 'upload/';
    $server_url = $_SERVER['REQUEST_URI'];
    $messageError = "";
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
     
        try {
            if($_FILES['file'])
            {
                $file_name = $_FILES["file"]["name"];
                $file_tmp_name = $_FILES["file"]["tmp_name"];
                $error = $_FILES["file"]["error"];
            
                if($error > 0){
                    $response = array(
                        "status" => "error",
                        "error" => true,
                        "message" => "Error uploading the file!"
                    );
                }else 
                {
                    $random_name = rand(1000,1000000)."-".$file_name;
                    $upload_name = $upload_dir.strtolower($random_name);
                    $upload_name = preg_replace('/\s+/', '-', $upload_name);
                    
                    try {
                        if(isset($_FILES['monFichier']) && $_FILES['monFichier']['error'] == 0){
                            $nomFichier = basename($_FILES['monFichier']['name']);
                            $cheminDestination = "uploads/" . $nomFichier;
                        
                            // Vérification de l'extension (exemple)
                            $extensionsAutorisees = array('jpg', 'jpeg', 'png', 'gif');
                            $extensionUpload = pathinfo($nomFichier, PATHINFO_EXTENSION);
                            if(in_array($extensionUpload, $extensionsAutorisees)){
                                if(move_uploaded_file($_FILES['monFichier']['tmp_name'], $cheminDestination)){
                                    echo "Le fichier a été téléchargé avec succès.";
                                } else {
                                    echo "Erreur lors du déplacement du fichier : " . error_get_last()['message'];
                                }
                            } else {
                                echo "Extension de fichier non autorisée.";
                            }
                        } else {
                            echo "Erreur lors du téléchargement du fichier.";
                        }
                    } catch (\Throwable $th) {
                        var_dump($th);
                    }
                }    
            
            }else{
                $response = array(
                    "status" => "error",
                    "error" => true,
                    "message" => "No file was sent!"
                );
            }
          
        } catch (\Throwable $th) {
                var_dump($th);
                $messageError = "Une erreur c'est produite veuillez recommencer";
            
        }
      
    }
 ?>

<body class="relative tracking-tight font-inter">
    <div class='relative z-10'>
        <div class="h-full min-h-screen ">
            <div style="background-color: #FBB03B">
                <div class="container mx-auto max-md:px-8  py-9">
                    <a href="./index.php"
                        class="relative z-50 font-semibold flex items-center gap-4 text-white text-3xl "> <svg
                            width="32px" height="32px" viewBox="0 0 48 48" class="rounded-full"
                            xmlns="http://www.w3.org/2000/svg" fill="#ffffff" stroke="#ffffff">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                                <path d="M0 0h48v48H0z" fill="none"></path>
                                <g id="Shopicon">
                                    <polygon
                                        points="40,22 14.828,22 28.828,8 26,5.172 7.172,24 26,42.828 28.828,40 14.828,26 40,26 ">
                                    </polygon>
                                </g>
                            </g>
                        </svg> <span>NosiArt'Afro Cup</span></a>
                </div>
            </div>
            <div class="container mx-auto max-md:px-8 py-9">
                <div method="POST" action="" class="max-w-2xl p-8 mx-auto bg-white shadow-md rounded-2xl">
                    <!-- <h1 class="mb-5 text-xl font-bold">NosiArt&apos;Afro Cup</h1> -->

                    <form enctype="multipart/form-data" method="POST" action=""
                        class="max-w-2xl p-8 mx-auto bg-white rounded-2xl">
                        <h4 class="text-sm text-red-500"> <?php if ($messageError != "") {
                                    echo $messageError;
                                } ?></h4>
                        <h2 class="font-medium">Envoie de dessin</h2>
                        <hr class="border  border-stone-200 " />
                        <div class="py-4">

                            <div class="mb-5">
                                <label for="nom" class="flex gap-2 mb-1 text-sm font-medium text-gray-900 ">Dessin
                                    <span class="text-red-500">*</span></label>
                                <input type="file" id="file" name="file"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                                    placeholder="" required />
                            </div>
                          
                        </div>
                        <button style="background-color: #FBB03B" type="submit"
                            class="text-stone-800 hover:bg-orange-500 focus:ring-4 w-full focus:outline-none focus:ring-orange-300 font-medium rounded-lg text-sm  px-5 py-2.5 text-center ">Soumettre</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class='fixed top-0 left-0 z-0 w-full h-full opacity-10'>
        <img alt="Logo nosiArt" src="./src/background.jpeg" width="500" height="500" class='w-full h-full' />
    </div>
</body>

</html>