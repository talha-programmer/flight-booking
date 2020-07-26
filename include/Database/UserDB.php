<?php
require_once ("Database.php");
class UserDB extends Database {
    /*This class deals with 2 tables in database:
       1. users
       2. user_profile
    */
    public function validateLogin($username, $password) {
        $username = self::$mysqli->real_escape_string($username);
        $password = self::$mysqli->real_escape_string($password);

        $hashedPassword = $this->createHash($password);
        $query = "SELECT * FROM users where username = '$username'";
        if($result = self::$mysqli->query($query)) {
            if ($row = $result->fetch_assoc()) {
                if($row["password"] == $hashedPassword)
                    return $row['user_id'];
                else
                    return false;
            }
            else
                return false;
        }
        else
            return false;
    }

    public function getUsernames() {
        $query = "SELECT username FROM users";
        $result = self::$mysqli->query($query);
        if($data= $result->fetch_assoc()) {
            return $data;
        }
        else
            return false;
    }

    public function createProfile(array $data) {
        $username = $data["username"];
        $username = self::$mysqli->real_escape_string($username);
        $password = $this->createHash(self::$mysqli->real_escape_string($data["password"]));

        $first_name = self::$mysqli->real_escape_string($data["first_name"]);
        $last_name = self::$mysqli->real_escape_string($data["last_name"]);
        $email = self::$mysqli->real_escape_string($data["email"]);
        $phone_number = self::$mysqli->real_escape_string($data["phone_number"]);

        $query = "INSERT INTO users ";
        $query .= "(username, password) ";
        $query .= "VALUES('$username', '$password');";
        if($result = self::$mysqli->query($query)) {
            $user_id = self::$mysqli->insert_id();
            $query2 = "INSERT INTO user_profile ";
            $query2 .= "(user_id, first_name, last_name, email, phone_number) ";
            $query2 .= "VALUES($user_id, '$first_name', '$last_name', '$email', '$phone_number');";
            if($result = self::$mysqli->query($query2))
                return true;

            else
                return false;
        }
        else
            return false;
    }

    private function createHash($password) {
        return md5($password);
    }

    public function getProfile(int $user_id) {
        $query = "SELECT * FROM user_profile WHERE user_id = $user_id LIMIT 1";
        $result = self::$mysqli->query($query);
        if($profile = $result->fetch_assoc()) {
            return $profile;
        }
        else {
            return false;
        }

    }

    public function updateProfile(int $user_id, array $data) {
        $first_name = self::$mysqli->real_escape_string($data["first_name"]);
        $last_name = self::$mysqli->real_escape_string($data["last_name"]);
        $email = self::$mysqli->real_escape_string($data["email"]);
        $phone_number = self::$mysqli->real_escape_string($data["phone_number"]);

        $query = "UPDATE user_profile ";
        $query .= "SET first_name = '$first_name', ";
        $query .= "last_name = '$last_name', ";
        $query .= "email = '$email', ";
        $query .= "phone_number = '$phone_number' ";
        $query .= "WHERE user_id = $user_id;";

        return self::$mysqli->query($query);
    }

    public function formatName(string $name) {
        $name = trim($name);
        $name = ucwords(strtolower($name));
        return $name;
    }

}