$(document).ready(function(){

    var edit_id;
var $edit_comment;
$(document).on('click', '.edit', function(){
    edit_id = $(this).data('id');
    $edit_comment = $(this).parent();
    // grab the comment to be editted
    var name = $(this).siblings('.display_name').text();
    var birthday = $(this).siblings('.comment_text').text();
    // place comment in form
    $('#name').val(name);
    $('#birthday').val(birthday);
    $('#edit_users_form').hide();
    $('#edit_users_form').show();
});
$(document).on('click', '#edit_users_form', function(){
    var id = edit_id;
    var name = $('#name').val();
    var birthday = $('#birthday').val();
    $.ajax({
        url: 'index.php?action=edit_users&id= <?php echo $id ?>',
        type: 'POST',
        data: {
            'update': 1,
            'id': id,
            'name': name,
            'birthday': birthday,
        },
        success: function(response){
            $('#name').val('');
            $('#birthday').val('');
            $('#edit_users_form').show();
            $('#edit_users_form').hide();
            $edit_comment.replaceWith(response);
        }
    });
});
});