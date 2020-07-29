<h1>Edit User Page</h1>
<form action="index.php?action=edit_users&id=<?php echo $id?>" method="post">
    <p>Name: <input type="text" name="name" id="name" required value="<?php echo @$editUsers['name']; ?>" ></p>
    <p>Birthday: <input type="date" name="birthday" id="birthday" required value="<?php echo $editUsers['birthday']; ?>"></p>
    <div><input type="submit" class="btn btn-warning" name="edit_users_form" value="Edit user">
        <a href="index.php?action=list_users" class="btn btn-success ">Back</a>



</form>