<?php
namespace models;

use PDO;
use models\base\SQL;

class VerifC extends SQL
{
    public function __construct()
    {
        parent::__construct('utilisateur', 'login');
    }

    public function loginn(string $login, string $password)
    {
        $stmt = $this->pdo->prepare('SELECT * FROM utilisateur WHERE login = ? LIMIT 1');
        $stmt->execute([$login]);
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);
        if(password_verify($password, $result['mdp'])){
            return $result; 
        }else return false;
       
    }

    function VerifLogin(mixed $login)
    {
        strip_tags($login);
        $stmt = $this->pdo->prepare("SELECT `login` FROM utilisateur WHERE `login` = ?");
        $stmt->execute([$login]);
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);
        if($result){ 
            return true;
        }else return false;
    }

    function create(mixed $login, mixed $password)
    {
        $stmt = $this->pdo->prepare("INSERT INTO utilisateur VALUES(?, ?, 2012-08-08,2014-04-04,4)");
        $stmt->execute([$login, password_hash($password, PASSWORD_BCRYPT)]);;      
    }
}    