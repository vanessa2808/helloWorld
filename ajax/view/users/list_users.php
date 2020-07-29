<h1>List Users here</h1>
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<style type="text/css">
    .modal {
        display: none;
        padding-top: 200px; /* Location of the box */
        left: 0;
        top: 0;
        width: 100%; /* Full width */
        height: 100%; /* Full height */
        overflow: auto; /* Enable scroll if needed */
        background-color: rgb(0, 0, 0); /* Fallback color */
        background-color: rgba(0, 0, 0, 0.4); /* Black w/ opacity */
    }

    /* Modal Content */
    .modal-content {
        background-color: #fefefe;
        margin: auto;
        padding: 20px;
        border: 1px solid #888;
        width: 60%;
    }

    /* The Close Button */
    .close {
        color: #aaaaaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }

    .close:hover,
    .close:focus {
        color: #000;
        text-decoration: none;
        cursor: pointer;
    }


</style>
<!--function1-->
<button id="myBtn">add user</button>
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




<div class="form-group">
    <div class="input-group">
        <span class="input-group-addon">Search</span>
        <input type="text" name="search_text" id="search_text" placeholder="Search by users Details" class="form-control" />
    </div>
</div>
<br />
<div id="result"></div>

<table class="table table-bordered">
    <tr>
        <th style="width: 10px">#</th>
        <th>Name</th>
        <th>Bithday</th>
        <th>Created</th>

        <th colspan="2" style="text-align: center">Action
        </th>

    </tr>

    <?php
    $connect = mysqli_connect('localhost', 'root', '', 'helloWorld1');

    if(isset($_POST["query"])){
        $search = mysqli_real_escape_string($connect, $_POST["query"]);

        $query = " SELECT * FROM users  WHERE name LIKE '%".$search."%' OR birthday LIKE '%".$search."%' ";
    } else {
        $query = "SELECT * FROM users ORDER BY id ";
    }
    $result = mysqli_query($connect, $query);


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
                        <button onclick="document.getElementById('id01').style.display='block'" class="btn-success">
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
<script>
    // Get the modal
    var modal = document.getElementById("myModal");

    // Get the button that opens the modal
    var btn = document.getElementById("myBtn");

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];

    // When the user clicks the button, open the modal
    btn.onclick = function () {
        modal.style.display = "block";
    };

    // When the user clicks on <span> (x), close the modal
    span.onclick = function () {
        modal.style.display = "none";
    };

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function (event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }

</script>



<script>
    $(document).ready(function(){
        function load_data(query){
            $.ajax({
                url:"list_users.php",
                method:"POST",
                data:{query:query},
                success:function(data) {
                    $('#result').html(data);
                }
            });
        }
        $('#search_text').keyup(function(){
            var search = $(this).val();
            if(search != ''){
                load_data(search);
            } else{
                load_data();
            }
        });
    });
</script>


