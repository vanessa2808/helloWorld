<!DOCTYPE html>
<html>
<head>
    <title>List users</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="webroot/css/modal.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" />



</head>
<body>
<h1>List Users here</h1>


<button id="myBtn" class="btn btn-success">add user</button>
<br/>

<br/>



<div id="myModal" class="modal">

    <div class="modal-content">
        <span class="close">&times;</span>
        <p>
            <?php include 'add_users.php'; ?>
        </p>
    </div>

</div>


<script>
    function showUser(str) {
        if (str == "") {
            document.getElementById("txtHint").innerHTML = "";
            return;
        } else {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("txtHint").innerHTML = this.responseText;
                }
            };
            xmlhttp.open("GET","index.php?action=fetch.php?q="+str,true);
            xmlhttp.send();
        }
    }

</script>




<p>Search: <input name="users" type="text" id="users" onchange="showUser(this.value)"></p>


<div id="txtHint"><b>Person info will be listed here...</b></div>



<table  class="table table-bordered">
    <tr>
        <th style="width: 10px">#</th>
        <th>Name</th>
        <th>Bithday</th>
        <th>Created</th>
        <th colspan="2" style="text-align: center">Action
        </th>

    </tr>

    <?php

    if ($userList->num_rows > 0) {
        while ($row = $userList->fetch_assoc()) {
            $id = $row['id'];

            ?>

            <tr>

                <td><?php echo $row['id'] ?></td>
                <td><?php echo $row['name'] ?></td>
                <td><?php echo $row['birthday'] ?></td>
                <td><?php echo $row['created'] ?></td>
                <td>
                    <div class="w3-container">
                        <button  onclick="document.getElementById('id01').style.display='block'" class="btn-success">
                            Edit
                        </button>

                        <div id="id01" class="w3-modal">
                            <div class="w3-modal-content">
                                <div class="w3-container">
                                    <span onclick="document.getElementById('id01').style.display='none'"
                                          class="w3-button w3-display-topright">&times;</span>
                                    <?php include 'edit_users.php'; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
                <td>
                    <div class="w3-container">
                        <button onclick="document.getElementById('id02').style.display='block'" class="btn-danger">
                            Delete
                        </button>

                        <div id="id02" class="w3-modal">
                            <div class="w3-modal-content">
                                <div class="w3-container">
                                    <span onclick="document.getElementById('id02').style.display='none'"
                                          class="w3-button w3-display-topright">&times;</span>
                                    <p style="height: 100px; position: center;margin-top: 60px; padding-left: 200px">


                                        <a href="index.php?action=delete_users&id=<?php echo $id ?>"
                                           class="btn btn-danger">Delete</a>
                                        <a href="index.php?action=list_users" class="btn btn-success ">Back</a>

                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </td>

            </tr>


            <?php
        }
    } else { ?>
        <tr>
            <td colspan="4">Khong co nguoi nao</td>
        </tr>
    <?php } ?>
</table>

</body>

<script type="text/javascript" src="webroot/js/modal.js"></script>


</html>








