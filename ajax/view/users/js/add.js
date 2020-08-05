$(document).ready(function() {

    $(document).on('click', '#add_user_form', function () {
        var name = $('#name').val();
        var birthday = $('#birthday').val();
        $.ajax({
            url: 'index.php?action=userModel.php',
            type: 'POST',
            data: {
                'save': 1,
                'name': name,
                'birthday': birthday,
            },
            success: function (response) {
                $('#name').val('');
                $('#birthday').val('');
                $('#txtHint').append(response);
            }
        });
    });
});