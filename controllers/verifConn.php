<?php
namespace controllers;

use models\VerifC;
use utils\Template;
use controllers\base\Web;
use utils\SessionHelpers;

class verifConn extends Web
{
    private $verifC;

    function __construct(){
       $this->verifC = new VerifC();
    }

    function login()
    {
        Template::render("views/global/connexion.php" , array());
    }

    function create($login = "", $password = "")
    {
        $equipe = $this->verifC->create($login, $password);
        $this->redirect("/login/home");
    }

    function loginn($login = "", $password = "")
    {
        if (SessionHelpers::isLogin()) {
            $this->redirect("../views/global/about.php");
        }

        $erreur = "";
        if (!empty($login) && !empty($password)) {
            $verificationLogin = new \models\VerifC();

            $Verif = $verificationLogin->loginn($login);
            if ($Verif != null) {
                SessionHelpers::login($Verif);
                $this->redirect("./ConnTrue");
            } else {
                SessionHelpers::logout();
                $this->redirect("./Inscr");
                $erreur = "Connexion impossible avec vos identifiants";
            }
        }

        return Template::render("views/global/connexion.php", array("erreur" => $erreur));
    }

    function logout(): void
    {
        SessionHelpers::logout();
        $this->redirect("./home");
    }

    function Inscr()
    {
        Template::render("views/global/pageInscription.php" , array());
    }

    function ConnTrue()
    {
        Template::render("views/global/pageConnecter.php" , array());
    }

}    