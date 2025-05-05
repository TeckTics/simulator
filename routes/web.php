<?php

use App\Events\PublicEvent;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\AppController;
use App\Http\Controllers\BaseController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\MissionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MapUserController;
use App\Http\Controllers\FormationController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MapController;
use App\Http\Controllers\MultiPlayer;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\UniteController;
use App\Http\Middleware\AppAdmin;
use App\Http\Middleware\guest;
use App\Http\Middleware\GuestAdmin;
use App\Http\Middleware\AppUser;
use App\Models\User;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Password;
use Illuminate\Http\Request;

Route::group(['prefix' => 'auth'], function () {
    Route::post('/register', [AuthController::class, "register"]);
});

Route::get('/api/hopitaux', [MapController::class, 'listHospital']);
Route::get('/api/base', [MapController::class, 'listBase']);
Route::get('/api/missions', [MapController::class, 'listMission']);
Route::post('/api/add-mission', [MapUserController::class, 'addUserMission']);
Route::post('/api/update-mission', [MapUserController::class, 'updateUserMission']);
Route::get('/api/get-mission', [MapUserController::class, 'missionList']);
Route::post('/api/update-unite-user', [MapUserController::class, 'updateUniteUser']);
Route::post("/api/send-message", [ChatController::class, "SendMessage"]);
Route::get("/api/base/{id}", [MapController::class, "getBaseById"]);
Route::get("/api/ville/{id}", [MapUserController::class, "getVilleId"]);
Route::get("/api/hopital/{id}", [MapController::class, "getHospitalById"]);
Route::post("/api/send-message-user", [ChatController::class, "SendMessageUser"]);
Route::get("/api/load-message", [ChatController::class, "LoadThePreviousMessages"]);
Route::get("/api/load-presence-user", [MultiPlayer::class, "LoadUserConnected"]);
Route::get("/api/unite-user/{id}", [MapUserController::class, "getUniteUserById"]);
Route::get("/api/unite/{id}", [MapUserController::class, "getUniteById"]);
Route::post('/api/add-unite-base', [FrontendController::class, 'addUniteToBase']);

Route::group(['prefix' => 'dashboard', 'middleware' => AppUser::class], function () {
    Route::get('/', [AppController::class, 'InitData']);
    Route::get('/boutique', [FrontendController::class, 'marketView']);
    Route::get('/boutique/unites', [FrontendController::class, 'marketUniteView']);
    Route::get('/boutique/personnels', [FrontendController::class, 'marketPersonnelView']);
    Route::get('/elements', [FrontendController::class, 'elementView']);
    Route::get('/elements/unite/{id}', [FrontendController::class, 'elementItemView']);
    Route::get('/elements/personnel/{id}', [FrontendController::class, 'elementItemPersonnelView']);
    // Route::get('/boutique', function () {
    //     return view('dashboard.boutique');
    // });
    Route::get('/jeu', [MapUserController::class, 'index']);
    Route::get('/multi', [MultiPlayer::class, 'index']);
    Route::get('/classement', [FrontendController::class, 'viewClassement']);
    Route::get('/classement-alliances', [FrontendController::class, 'viewClassementAlliance']);
    Route::get('/alliances', [FrontendController::class, 'alliancesView']);
    Route::get('/profil/echange-unite', [FrontendController::class, 'viewDemandeUnite']);
    Route::get('/profil/', [FrontendController::class, 'viewProfile']);
    Route::get('/alliance/{id}', [FrontendController::class, 'allianceView']);
    Route::get('/echange/{id}', [FrontendController::class, 'exchangeUniteView']);
    Route::post('/search_alliances', [FrontendController::class, 'searchClan'])->name('search.clan');
    Route::get('/statistique', function () {
        return view('dashboard.statistique');
    });
    Route::get('/deconnexion', [AuthController::class, 'userLogout'])->name('logoutUser');

    Route::group(['prefix' => 'api', 'middleware' => AppUser::class], function () {
        Route::post('/add-event-user', [FrontendController::class, 'addEventUser'])->name('add.event-user');
        Route::post('/add-clan', [FrontendController::class, 'addClan'])->name('add.clan');

        // Api for jquery 
        Route::get('/paris-time', [AppController::class, 'getParisTime']);
        Route::post('/purchase-unite', [AppController::class, 'PurchaseUnite']);
        Route::get('/first-base-form', [AppController::class, 'FirstBaseTemplate']);
        Route::post('/purchase-personnel', [AppController::class, 'PurchasePersonnel']);
        Route::post('/purchase-equipment', [AppController::class, 'PurchaseEquipement']);
        Route::post('/purchase-formation', [AppController::class, 'PurchaseFormation']);
        Route::get('/get-user', [AppController::class, 'GetUserData']);
        Route::get('/get-alliance', [AppController::class, 'GetAllianceList']);
        Route::get('/get-items', [AppController::class, 'GetItemList']);
        Route::get('/check-day', [AppController::class, 'CheckLastLogin']);
        Route::get('/get-map-data', [AppController::class, 'InitMapData']);
        Route::get('/get-mission', [AppController::class, 'GetMission']);

        Route::get('/api/hopitaux-proches', [AppController::class, 'getClosestHopitaux']);
        Route::get('/import-hopital', [AppController::class, 'ImportHopital']);


        Route::get('/get-missions', [AppController::class, 'GetMissions']);
        Route::get('/missions/pending', [AppController::class, 'GetMissionsPending']);
        Route::get('/check-user-data', [AppController::class, 'GetUserGameData']);
        Route::get('/get-alliance/{id}', [AppController::class, 'GetClan']);
        Route::get('/get-unite/{id}', [AppController::class, 'GetUnite']);
        Route::get('/get-formations/{id}', [AppController::class, 'GetFormationList']);
        Route::post('/accept-daily-gain', [AppController::class, 'AcceptDailyGain']);
        Route::post('/search-alliances', [AppController::class, 'GetClanListByName']);
        Route::post('/create-alliance', [AppController::class, 'CreateAlliance']);
        Route::post('/enter-into-alliance', [AppController::class, 'EnterIntoAlliance']);
        Route::post('/leave-alliance', [AppController::class, 'LeaveAlliance']);
        Route::delete('/delete-alliance/{id}', [AppController::class, 'DestroyAlliance']);
        Route::delete('/delete-base/{id}', [AppController::class, 'DestroyBase']);
        Route::delete('/delete-personnel/{id}', [AppController::class, 'DestroyPersonnel']);
        Route::post('/create-user-base', [AppController::class, 'CreateUserBase']);
        Route::post('/send-message-public-chat', [AppController::class, 'SendMessageToPublicChat']);
        Route::post('/send-message-private-chat', [AppController::class, 'SendMessageToPrivateChat']);
        Route::put('/update-alliance/{id}', [AppController::class, 'EditAlliance']);
        Route::put('/upgrade-personnel/{id}', [AppController::class, 'UpgradePersonnel']);
        Route::put('/update-mission', [AppController::class, 'UpdateMissionUser']);
        Route::put('/upgrade-alliance/{id}', [AppController::class, 'UpgradeAlliance']);
        Route::get('/get-public-chat-message', [AppController::class, 'LoadPublicChatMessage']);
        Route::get('/get-private-chat-message/{id}', [AppController::class, 'LoadPrivateChatMessage']);
        Route::get('/get-bases', [AppController::class, 'GetBases']);
        Route::get('/get-base/{id}', [AppController::class, 'GetBase']);
        // End Api for jquery
        Route::get('/delete-demande/{id}', [FrontendController::class, 'deleteDemande']);
        Route::get('/get-demande', [FrontendController::class, 'getDemandeUnite'])->name('get.demande');
        Route::get('/accept-demande/{id}', [FrontendController::class, 'acceptUniteExchange']);
        Route::get('/reject-demande/{id}', [FrontendController::class, 'rejectDemande']);
        Route::post('/init-demande', [FrontendController::class, 'initUniteExchange'])->name('init.demande');
        Route::get('/delete-clan/{id}', [FrontendController::class, 'destroyAlliance']);
        Route::post('/update-clan', [FrontendController::class, 'updateClan'])->name('update.clan');
        Route::post('/add-base-user', [MapUserController::class, 'storeBase'])->name('add.user.base');
        Route::post('/add-clan-user', [FrontendController::class, 'addClanUser'])->name('add.clan-user');
        Route::post('/update-unite', [FrontendController::class, 'updateUniteUser'])->name('update.unite-user');
        Route::post('/add-personnel-formation', [FrontendController::class, 'addPersonnelFormation'])->name('add.personnel-formation');
        Route::post('/add-unite-user', [FrontendController::class, 'addUniteUser'])->name('add.unite-user');
        Route::post('/add-personnel-user', [FrontendController::class, 'addPersonnelUser'])->name('add.personnel-user');

    });
});

Route::group(['prefix' => 'admin'], function () {
    Route::group(['middleware' => GuestAdmin::class], function () {
        Route::get('/connexion', function () {
            return view('admin.auth.login');
        });
        Route::post('/connexion', [AuthController::class, "loginAdmin"])->name('admin-connexion');
        Route::get('/', function () {
            return view('admin.auth.login');
        });
        Route::get('/mot-passe-oublie', function () {
            return view('admin.auth.forgot');
        });
    });
    Route::group(['prefix' => 'api', 'middleware' => AppAdmin::class], function () {
        Route::post('/add-evenement', [EventController::class, 'store'])->name('add.event');
        Route::post('/add-unite', [UniteController::class, 'store'])->name('add.unite');
        Route::post('/edit-unite', [UniteController::class, 'update'])->name('edit.unite');
        Route::get('/delete-unite/{id}', [UniteController::class, 'delete']);
        Route::post('/add-type-unite', [UniteController::class, 'storeTypeUnite'])->name('add.typeUnite');
        Route::post('/edit-type-unite', [UniteController::class, 'updateTypeUnite'])->name('edit.typeUnite');
        Route::get('/delete-type-unite/{id}', [UniteController::class, 'deleteTypeUnite']);
        Route::post('/edit-evenement', [EventController::class, 'update'])->name('edit.event');
        Route::get('/delete-evenement/{id}', [EventController::class, 'delete']);
        Route::post('/add-type-base', [BaseController::class, 'store'])->name('add.typebase');
        Route::post('/banned', [UserController::class, 'bannedUser'])->name('banned.user');
        Route::post('/add-mission', [MissionController::class, 'store'])->name('add.mission');
        Route::post('/edit-mission', [MissionController::class, 'update'])->name('edit.mission');
        Route::get('/delete-mission/{id}', [MissionController::class, 'delete']);
        Route::post('/add-personnel', [FormationController::class, 'storePersonnel'])->name('add.personnel');
        Route::post('/edit-personnel', [FormationController::class, 'updatePersonnel'])->name('edit.personnel');
        Route::get('/delete-personnel/{id}', [FormationController::class, 'deletePersonnel']);
        Route::post('/add-formation', [FormationController::class, 'storeFormation'])->name('add.formation');
        Route::post('/edit-formation', [FormationController::class, 'updateFormation'])->name('edit.formation');
        Route::get('/delete-formation/{id}', [FormationController::class, 'deleteFormation']);
        Route::post('/add-hopital', [MapController::class, 'storeHopital'])->name('add.hopital');
        Route::post('/edit-hopital', [MapController::class, 'updateHopital'])->name('edit.hopital');
        Route::get('/delete-hopital/{id}', [MapController::class, 'deleteHopital']);
        Route::get('/hopitaux', [MapController::class, 'listHopital']);
    });
    Route::group(['prefix' => 'dashboard', 'middleware' => AppAdmin::class], function () {

        Route::get('/', [AdminController::class, "index"]);
        Route::get('/joueurs', [UserController::class, 'index']);
        Route::get('/joueur/{id}', [UserController::class, 'detailUser']);
        Route::get('/evenements', [EventController::class, 'index']);
        Route::get('/evenement/{id}', [EventController::class, 'show']);
        Route::get('/personnels', [FormationController::class, 'index']);
        Route::get('/unites', [UniteController::class, 'index']);
        Route::get('/type-unite', [UniteController::class, 'typeUniteView']);
        Route::get('/formations', [FormationController::class, 'formation']);
        Route::get('/hopitaux', [BaseController::class, 'hospitalList']);
        Route::get('/chatlog', [ChatController::class, 'index']);
        Route::get('/parametre_general', [SettingController::class, 'generalSetting']);
        Route::get('/parametre_boutique', [SettingController::class, 'boutiqueSetting']);
        Route::get('/parametre_chat', [SettingController::class, 'chatView']);
        Route::get('/personnel/{id}', [FormationController::class, 'detail']);
        Route::get('/missions', [MissionController::class, 'index']);
        Route::get('/mission/{id}', [MissionController::class, 'show']);
        Route::get('/type-base', [BaseController::class, 'index']);
        Route::get('/map', [MapController::class, 'index']);
        Route::get('/joueurs-classement', [UserController::class, 'rankingUser']);
        Route::get('/jeu', function () {
            return view('dashboard.game');
        });

        Route::get('/deconnexion', [AuthController::class, 'logoutAdmin']);
        Route::get('/classement', function () {
            return view('dashboard.classement');
        });
        Route::get('/statistique', function () {
            return view('dashboard.statistique');
        });
        // Route::get('/deconnexion', [AuthController::class, 'userLogout'])->name('logoutUser');
    });
});

Route::group(['middleware' => guest::class], function () {
    Route::get('/', [HomeController::class, 'index']);
    Route::get('/mentions-legales', [HomeController::class, 'viewMentionLegal']);
    Route::get('/conditions-utilisations', [HomeController::class, 'viewCondition']);
    Route::get('/faq', [HomeController::class, 'viewFaq']);
    Route::get('/connexion', function () {
        return view('authentification.connexion');
    });
    Route::post('/connexion', [AuthController::class, "userLogin"]);
    Route::get('/forgot-password',  function () {

        return view('authentification.forgot-password');
    });
    Route::get('/email/verify/{id}/{hash}', function ($id) {
        $user = User::find($id);

        if ($user) {
            $user->is_verified = true;
            $user->email_verified_at = now();
            $user->save();

            return redirect('connexion')->with('success', 'Email verified successfully!');
        }

        return redirect('/connexion')->with('error', 'User not found.');
    })->name('verification.verify');

    Route::post('/forgot-password', function (Request $request) {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? back()->with(['status' => __($status)])
            : back()->withErrors(['email' => __($status)]);
    })->middleware('guest')->name('password.email');

    Route::get('/forgot-password', function () {
        return view('auth.forgot-password');
    })->middleware('guest')->name('password.request');

    Route::post('/email/verification-notification', [AuthController::class, 'verificationNotif'])->middleware(['auth', 'throttle:6,1'])->name('verification.send');

    Route::get('/email/verify', function () {
        return view('authentification.verify-email');
    })->name('verification.notice');

    Route::get('/inscription-complet', function () {
        return view('authentification.successInscription');
    });

    //     Route::get('/reset-password/{token}', function (string $token) {
    //     return view('auth.reset-password', ['token' => $token]);
    // })->middleware('guest')->name('password.reset');

    //    Route::post('/reset-password', function (Request $request) {
    //     $request->validate([
    //         'token' => 'required',
    //         'email' => 'required|email',
    //         'password' => 'required|min:8|confirmed',
    //     ]);

    //     $status = Password::reset(
    //        )->middleware('guest')->name('password.update');

    Route::get('/inscription', function () {
        return view('authentification.inscription');
    });
});

Route::get('/user/login', function () {
    return redirect('/dashboard');
});
Route::get('/design-1', function () {
    return view('design-1');
});

Route::get('/test', function () {
    event(new PublicEvent("hello word"));
});

