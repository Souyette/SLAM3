<?php

namespace routes;

use routes\base\Route;
use controllers\Account;
use controllers\TodoWeb;
use controllers\VideoWeb;
use controllers\verifConn;
use utils\SessionHelpers;
use controllers\SampleWeb;

class Web
{
    function __construct()
    {
        $main = new SampleWeb();

        Route::Add('/', [$main, 'home']);
        Route::Add('/about', [$main, 'about']);

        $test = new verifConn();
        Route::Add('/login/home', [$test, 'login']);
        Route::Add('/login/inscription', [$test, 'create']);
        Route::Add('/login/loginn', [$test, 'loginn']);
        Route::Add('/login/logout', [$test, 'logout']);



       
        //        Exemple de limitation d'accès à une page en fonction de la SESSION.
        //        if (SessionHelpers::isLogin()) {
        //            Route::Add('/logout', [$main, 'home']);
        //        }
    }
}

