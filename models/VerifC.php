<?php
namespace models;

use PDO;
use models\base\SQL;

class VerifC extends SQL
{
    public function __construct()
    {
        parent::__construct('utilisateurs', 'ID');
    }

    public function loginn(string $login)
    {
        $stmt = $this->pdo->prepare('SELECT * FROM utilisateur WHERE login = ? LIMIT 1');
        $stmt->execute([$login]);
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);
        var_dump($login);
        echo 'yo' . $login;
       
    }

    function create(mixed $login, mixed $password)
    {
        $stmt = $this->pdo->prepare("INSERT INTO utilisateur VALUES(?, ?, 2012-08-08,2014-04-04,4)");
        $result = $stmt->execute([$login, password_hash($password, PASSWORD_BCRYPT)]);;      
    }
}    