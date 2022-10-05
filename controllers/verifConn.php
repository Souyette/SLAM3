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

    function loginn($login = "", $password = "")
    {
        if (SessionHelpers::isLogin()) {
            $this->redirect("/");
        }

        $erreur = "";
        if (!empty($login) && !empty($password)) {
            $verificationLogin = new \models\VerifC();

            $Verif = $verificationLogin->loginn($login,$password);
            if ($Verif != null) {
                SessionHelpers::login($Verif);
                $this->redirect("./ConnTrue");
            } else {
                SessionHelpers::logout();
                $this->redirect("../login/Inscr");
                $erreur = "Connexion impossible avec vos identifiants";
            }
        }

        return Template::render("views/global/connexion.php", array("erreur" => $erreur));
    }

    function create($login = "", $password = "",$password1 = "")
    {

        $loginInscrire = htmlspecialchars($login);

        $mdp1 = strip_tags($password);
        $mdp2 = strip_tags($password1);
        $verificationLogin = new \models\VerifC();
        $VerifLoginInscrire = $verificationLogin->VerifLogin($loginInscrire);
        if(!empty($password) && !empty($password1)){
        
            if(!$VerifLoginInscrire){
                if ($mdp1 == $mdp2)
                {          
                    $this->verifC->create($login, $password);
                    $this->redirect("/login/home");
                }else $erreur = "Vos mots de passe ne sont pas identiques";
            }else $erreur = "Un compte portant se nom éxiste déjà";
            
        }else $erreur = "Veuillez rentrez un login et un mdp";
        Template::render("views/global/pageInscription.php" , array('erreur' => $erreur));    
    }

    function logout(): void
    {
        SessionHelpers::logout();
        $this->redirect("../login/home");
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