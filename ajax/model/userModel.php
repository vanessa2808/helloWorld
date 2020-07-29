<?php
    include "config/ConnectDB.php";
    Class userModel extends ConnectDB {
        public function  getUserPage(){
            $sql = "SELECT * FROM users";
            $userList = mysqli_query($this->connect(),$sql);
            return $userList;
        }
        public function getUsers($id) {
            $sql = "SELECT * FROM users WHERE id = $id";
            $result = mysqli_query($this->connect(), $sql);
            return $result->fetch_assoc();
        }
        public function deleteUsers($id) {
            $sql = "DELETE FROM users where id = $id";
            return mysqli_query($this->connect(), $sql);

        }
        public function addUsers($name,$birthday,$created) {
            $sql = "INSERT INTO users (name, birthday, created) VALUES ('$name','$birthday', '$created')";
            return mysqli_query($this->connect(), $sql);

        }
        public function editUsers($id, $name, $birthday, $created) {
            $sql = "UPDATE users SET name = '$name', birthday = '$birthday',created = '$created' WHERE id = $id";

            return mysqli_query($this->connect(), $sql);

        }

    }
?>