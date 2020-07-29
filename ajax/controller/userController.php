<?php
include 'model/userModel.php';
include 'libs/function.php';
class userController {

    public function handleRequest() {
        $model = new userModel();
        $functionCommon = new FunctionCommon();
        $action = isset($_GET['action'])?$_GET['action']:'list_users';
        switch ($action) {

            case 'list_users':
                $userList = $model->getUserPage();
                include 'view/users/list_users.php';
                break;

            case 'delete_users':
                $id = $_GET['id'];
                if ($model->deleteUsers($id) === TRUE) {
                    $functionCommon->redirectPage('index.php?action=list_users');
                }
                break;
            case 'add_users':

                if (isset($_POST['add_user_form'])) {
                    $name = $_POST['name'];
                    $birthday = date('Y-m-d h:i:s');
                    $created = date('Y-m-d h:i:s');
                    if ($model->addUsers($name, $birthday, $created) === TRUE) {
                        $functionCommon->redirectPage('index.php?action=list_users');
                    }
                }
                include 'view/users/add_users.php';
                break;
            case 'edit_users':
                $id = $_GET['id'];
                $model = new userModel();
                $editUsers = $model->getUsers($id);
                if (isset($_POST['edit_users_form'])) {
                    $name = $_POST['name'];
                    $birthday = date('Y-m-d h:i:s');
                    $created = date('Y-m-d h:i:s');

                    if ($model->editUsers($id,$name, $birthday, $created) === TRUE) {
                        $functionCommon->redirectPage('index.php?action=list_users');
                    }
                }
                include 'view/users/edit_users.php';
                break;

            default:
                # code...
                break;
        }
    }

}
?>