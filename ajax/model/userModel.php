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

        public function search($text){
            $text = strtolower($text);
            $query = "SELECT * FROM users WHERE name LIKE ? OR birthday LIKE ? ";
            $stmt = $this->connect()->prepare($query);
            $stmt->execute([$text,$text]);
            $out = "";
            $out .= "<table style='font-size:14px;' class='table table-responsive table-hover'><tr class='bg-light'><th>ID</th><th> Name</th><th>Birthday </th><th colspan='2'>Action</th></tr>";
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                $id = $row['id'];
                $name = $row['name'];
                $birthday = $row['birthday'];
                $out .="<tr><td>$id</td><td>$name</td><td>$birthday</td>";
                $out .="<td><a href='edit.php?id=$id' class='edit btn btn-sm btn-success' title='edit'><i class='fa fa-fw fa-pencil'></i></a></td>";
                $out .="<td><span id='$id' class='del btn btn-sm btn-danger' title='delete'><i class='fa fa-fw fa-trash'></i></span></td>";
            }
            $out .= "</table>";
            if($stmt->rowCount() == 0 ){
                $out = "";
                $out .= "<p class='alert alert-danger text-center col-sm-3 mx-auto'>Not Found.</p>";
            }
            return $out;
        }

    }
?>