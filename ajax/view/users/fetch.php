<?php
// Array with names

//open connection to mysql db
$connection = mysqli_connect("localhost", "root", "", "helloWorld1") or die("Error " . mysqli_error($connection));

//fetch table rows from mysql db
$sql = "select * from users";
$result = mysqli_query($connection, $sql) or die("Error in Selecting " . mysqli_error($connection));

//create an array
$emparray = array();
while ($row = mysqli_fetch_assoc($result)) {
    $emparray[] = $row;
}
 echo json_encode($emparray);


$hint = "";

// lookup all hints from array if $q is different from ""
if ($row !== "") {
    $row = strtolower($row);
    foreach(array_keys($emparray) as $name) {
        if (stristr($row, substr($name, 0))) {
            if ($hint === "") {
                $hint = $name;
            } else {
                $hint .= ", $name";
            }
        }
    }
}

// Output "no suggestion" if no hint was found or output correct values
echo $hint === "" ? "no suggestion" : $hint;
?>