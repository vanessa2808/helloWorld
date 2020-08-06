$(document).ready(function() {

    $(document).on('click', '.delete', function () {
        var id = $(this).data('id');
        $clicked_btn = $(this);
        $.ajax({
            url: 'index.php?action=delete_users&id=<?php echo $id ?>',
            type: 'GET',
            data: {
                'delete': 1,
                'id': id,
            },
            success: function (response) {
                // remove the deleted comment
                $clicked_btn.parent().remove();
                $('#name').val('');
                $('#birthday').val('');
            }
        });
    });
});