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
        $query = "SELECT * FROM users where username = '$username'";
        if($result = mysqli_query(self::$connection, $query))
        {
            if ($row = mysqli_fetch_assoc($result))
            {
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

    public function getProfile(int $user_id)
    {
        $query = "SELECT * FROM user_profile WHERE user_id = $user_id LIMIT 1";
        $result = mysqli_query(self::$connection, $query);
        if($profile = mysqli_fetch_assoc($result))
        {
            return $profile;
        }
        else
            return false;

    }

    public function updateProfile(int $user_id, array $data)
    {
        $first_name = $data["first_name"];
        $last_name = $data["last_name"];
        $email = $data["email"];
        $phone_number = $data["phone_number"];

        $query = "UPDATE user_profile ";
        $query .= "SET first_name = '$first_name', ";
        $query .= "last_name = '$last_name', ";
        $query .= "email = '$email', ";
        $query .= "phone_number = '$phone_number' ";
        $query .= "WHERE user_id = $user_id;";

        return mysqli_query(self::$connection, $query);

    }


}