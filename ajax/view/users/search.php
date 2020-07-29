<?php require_once "model/userModel.php";
if(isset($_POST['q'])){
    $q = $_POST['q'];
    $q = "%".$q."%";
    $usr = new userModel();
    $data = $usr->search($q);
    echo $data;
}
?>
<script type="text/javascript">
    function get_edit_id(){
        let url = new URLSearchParams(window.location.search);
        let id = url.get('id');
        id = parseInt(id);
        return id;
    }
    function get_rows(){
        let id = get_edit_id();
        $.get(
            "includes/get.php",
            {id : id},
            function(data){
                data = JSON.parse(data);
                $("#upd_name").val(data.first);
                $("#upd_birthday").val(data.last);

                console.log(data);
            });
    }
    if(get_edit_id()){
        get_rows();
    }

</script>