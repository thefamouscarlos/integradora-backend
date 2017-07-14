<?php

class logic
{
    private $conn;
    private $server = "127.0.0.1";
    private $user = "root";
    private $passw = "";
    private $bd = "event";



    function generateSalt(){
        $salt = base64_encode(openssl_random_pseudo_bytes(16, $secure));
        return $salt;
    }

    function hashPwd($username, $password){
        $username = "";
        $password = "";

        // A higher "cost" is more secure but consumes more processing power
        $cost = 15;

        // Create a random salt
        $salt = strtr(base64_encode(mcrypt_create_iv(64, MCRYPT_DEV_URANDOM)), '+', '.');

        // Prefix information about the hash so PHP knows how to verify it later.
        // "$2a$" Means we're using the Blowfish algorithm. The following two digits are the cost parameter.
        $salt = sprintf("$2a$%02d$", $cost) . $salt;

        // Value:
        // $2a$10$eImiTXuWVxfM37uY4JANjQ==

        // Hash the password with the salt
        $hash = crypt($password, $salt);
        return $hash;
    }

    // DATA BASE BULLSHIT

    public function __construct() {
        // Create connection
        $this->conn = new mysqli($this->server, $this->user, $this->passw, $this->bd);

        // Check connection
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function select($sql,$type, $p1, $p2="",$p3="",$p4="", $p5="", $p6="") {
        // prepare and bind
        $stmt = $this->conn->prepare($sql);
        if($p3<>""){
            $stmt->bind_param($type, $p1,$p2,$p3,$p4,$p5,$p6);
        }else if($p2<>""){
            $stmt->bind_param($type, $p1,$p2);
        }else{
            $stmt->bind_param($type, $p1);
        }

        $stmt->execute();
        $result = $stmt->get_result();
        $reg=array();
        while ($myrow = $result->fetch_assoc()) {

            $reg[]=$myrow;
        }
        return $reg;
    }

    // END DATABASE BULLSHIT

    function loginParam($username, $password){
        $connect = mysqli_connect('127.0.0.1','root','','sirfic');
        mysqli_query($connect,"SELECT password FROM userbase WHERE username = :username LIMIT 1");
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        $user = $stmt->get_result();
        // Hashing the password with its hash as the salt returns the same hash
        if ( hash_equals($user->hash, crypt($password, $username->hash)) ) {
            $_SESSION["validUser"]=$username;
            $hello = 'hello world';
            return $hello;
        }else{
            return false;
        }
    }
}