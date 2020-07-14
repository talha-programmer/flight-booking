<?php
require_once ("Database.php");
class UserDB extends Database
{
    /*This class deals with 2 tables in database:
       1. users
       2. user_profile
    */
    public function validateLogin($username, $password)
    {
        $hashedPassword = $this->createHash($password);
        $query = "SELECT password FROM users where username = '$username'";
        if($result = mysqli_query(self::$connection, $query))
        {
            if ($row = mysqli_fetch_assoc($result))
            {
                if($row["password"] == $hashedPassword)
                    return true;
                else
                    return false;
            }
            else
                return false;
        }
        else
            return false;
    }

    public function createProfile(array $data)
    {
        $username = $data["username"];
        $password = $this->createHash($data["password"]);

        $first_name = $data["first_name"];
        $last_name = $data["last_name"];
        $email = $data["email"];
        $phone_number = $data["phone_number"];

        $query = "INSERT INTO users ";
        $query .= "(username, password) ";
        $query .= "VALUES('$username', '$password');";
        if($result = mysqli_query(self::$connection, $query))
        {
            $user_id = mysqli_insert_id(self::$connection);
            $query2 = "INSERT INTO user_profile ";
            $query2 .= "(user_id, first_name, last_name, email, phone_number) ";
            $query2 .= "VALUES($user_id, '$first_name', '$last_name', '$email', '$phone_number');";
            if($result = mysqli_query(self::$connection, $query2))
                return true;

            else
                return false;
        }
        else
            return false;
    }

    private function createHash($password)
    {
        return md5($password);
    }



}