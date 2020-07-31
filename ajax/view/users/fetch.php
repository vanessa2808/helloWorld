

<?php
$q = intval($_GET['q']);

$con = mysqli_connect('localhost','root','','helloWorld1');
if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}

mysqli_select_db($con,"helloWorld1");
$sql="SELECT * FROM users WHERE id = '".$q."'";
$result = mysqli_query($con,$sql);

echo "<table>
<tr>
<th>Name</th>
<th>birthday</th>

</tr>";
while($row = mysqli_fetch_array($result)) {
    echo "<tr>";
    echo "<td>" . $row['name'] . "</td>";
    echo "<td>" . $row['birthday'] . "</td>";

    echo "</tr>";
}
echo "</table>";
mysqli_close($con);
?>
