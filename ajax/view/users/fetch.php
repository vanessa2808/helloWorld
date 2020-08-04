

<?php

$q = @$_GET["query"];

$con = mysqli_connect('localhost','root','','helloWorld1');
if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}

mysqli_select_db($con,"users");

$sql = "SELECT * FROM users WHERE name = '".$q."'";
$result = mysqli_query($con,$sql);
echo "<table id=\"txtHint\" class=\"table table-bordered\">
    <tr>
        <th style=\"width: 10px\">#</th>
        <th>Name</th>
        <th>Bithday</th>
        <th>Created</th>
        <th colspan=\"2\" style=\"text-align: center\">Action
        </th>

    </tr>

</tr>";
while($row = mysqli_fetch_array($result)) {
    echo "<td>" .$row['id'].  "</td>";
    echo "<td>". $row['name'] ."</td>";
    echo "<td>" . $row['birthday'] . "</td>";
    echo "<td>" . $row['created'] . "</td>";

    echo "<td>" . " <div class=\"w3-container\">
                        <button  onclick=\"document.getElementById('id01').style.display='block'\" class=\"btn-success\">
                            Edit
                        </button>

                        <div id=\"id01\" class=\"w3-modal\">
                            <div class=\"w3-modal-content\">
                                <div class=\"w3-container\">
                                    <span onclick=\"document.getElementById('id01').style.display='none'\"
                                          class=\"w3-button w3-display-topright\">&times;</span>
                                    <?php include 'edit_users.php'; ?>
                                </div>
                            </div>
                        </div>
                    </div>" . "</td>";
    echo "<td>" . " <div class=\"w3-container\">
                        <button onclick=\"document.getElementById('id02').style.display='block'\" class=\"btn-danger\">
                            Delete
                        </button>

                        <div id=\"id02\" class=\"w3-modal\">
                            <div class=\"w3-modal-content\">
                                <div class=\"w3-container\">
                                    <span onclick=\"document.getElementById('id02').style.display='none'\"
                                          class=\"w3-button w3-display-topright\">&times;</span>
                                    <p style=\"height: 100px; position: center;margin-top: 60px; padding-left: 200px\">


                                        <a href=\"index.php?action=delete_users&id=<?php echo ?>\"
                                           class=\"btn btn-danger\">Delete</a>
                                        <a hregitf=\"index.php?action=list_users\" class=\"btn btn-success \">Back</a>

                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </td>" . "</td>";



    echo "</tr>";

}
echo "</table>";
mysqli_close($con);
?>
