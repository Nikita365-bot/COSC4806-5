<?php

class User {

    public $username;
    public $password;
    public $auth = false;

    public function __construct() {

    }

    public function test () {
        $db = db_connect();
        $statement = $db->prepare("select * from users;");
        $statement->execute();
        $rows = $statement->fetch(PDO::FETCH_ASSOC);
        return $rows;
    }

    public function authenticate($username, $password) {
        $username = strtolower($username);
        $db = db_connect();
        $statement = $db->prepare("select * from users WHERE username = :name;");
        $statement->bindValue(':name', $username);
        $statement->execute();
        $rows = $statement->fetch(PDO::FETCH_ASSOC);

        if (password_verify($password, $rows['password'])) {
            $_SESSION['auth'] = 1;
            $_SESSION['username'] = ucwords($username);
            $_SESSION['user_id'] = $rows['id'];  // <-- use 'id' not 'user_id'

            // ✅ Log successful login
            $log = $db->prepare("INSERT INTO log (username, attempt) VALUES (:username, 'good')");
            $log->execute(['username' => $username]);

            unset($_SESSION['failedAuth']);
            header('Location: /home');
            die;
        } else {
            // ✅ Log failed login
            $log = $db->prepare("INSERT INTO log (username, attempt) VALUES (:username, 'bad')");
            $log->execute(['username' => $username]);

            if(isset($_SESSION['failedAuth'])) {
                $_SESSION['failedAuth']++; //increment
            } else {
                $_SESSION['failedAuth'] = 1;
            }
            header('Location: /login');
            die;
        }
    }

    public function get_login_counts() {
          $db = db_connect();
          return $db->query("SELECT username, COUNT(*) as total FROM log GROUP BY username")->fetchAll(PDO::FETCH_ASSOC);
     }
}

?>

