$(document).ready(function() {
    // $('#loginform').submit(function(e) {
    //     e.preventDefault();
    //     $.ajax({
    //         type: "POST",
    //         url: 'http://blog.loc/admin/show',
    //         data: $(this).serialize(),
    //         success: function(response)
    //         {
    //             var jsonData = JSON.parse(response);
    //
    //             // user is logged in successfully in the back-end
    //             // let's redirect
    //             if (jsonData.success === 1)
    //             {
    //                 // location.href = 'my_profile.php';
    //                 var a = $('#like').html();
    //                 a ++;
    //                 $('#like').html(a);
    //             }
    //             else
    //             {
    //                 alert('Invalid Credentials!');
    //             }
    //         }
    //     });
    // });

    // $('#like').click(function() {
    //     $.ajax({
    //         type: "POST",
    //         url: 'http://blog.loc/admin/show',
    //         data: $(this).serialize(),
    //         success: function(response)
    //         {
    //         var jsonData = JSON.parse(response);
    //
    //         if (jsonData.success === 1)
    //         {
    //             // location.href = 'my_profile.php';
    //             var a = $('#like').html();
    //             a ++;
    //             $('#like').html(a);
    //         }
    //         else
    //         {
    //             alert('Invalid Credentials!');
    //         }
    //         }
    //     });
    // });
// ===================================================
    $(".like").bind("click", function(event) {
        var promise = {
            'author_id': $(event.target).closest('li').children('.author').attr('id'),
            'date': $(event.target).closest('li').children('.date').text(),
            'table': $(event.target).parent().parent().attr('table'),

        };
        $.ajax({
            url: "http://blog.loc/like/like",
            type: "POST",
            data: promise,
            dataType: "text",
            success: function(result) {

                console.log(result);
                if(result === 'zero likes') {
                    $(event.target).closest('li').children('.likeNum').text('0');
                }else if(result) {
                    $(event.target).closest('li').children('.likeNum').text(result);
                }

                $("#likeNum").text(result);
            }
        });
    });
// =======================================================
    var action;

    $(".comment, .edit").bind("click", function(event) {
        action = $(event.target).attr('class');
        if($('.input-comment').length) {
            $('.input-comment').remove();
            $(event.target).after('<div class="input-comment"><input type="text" name="comment"><span id="input-comment" style="margin-left: 10px">save</span></div>');
        }else{
            $(event.target).after('<div class="input-comment"><input type="text" name="comment" class="comment-input"><span id="input-comment" style="margin-left: 10px">save</span></div>');
        }
    });

    $(document).on('click','#input-comment', function(event){
        var promise = {
            'author_id': $(event.target).closest('li').children('.author').attr('id'),
            'date': $(event.target).closest('li').children('.date').text(),
            'table': $(event.target).parent().parent().parent().attr('table'),
            'content': $(event.target).parent().children('.comment-input').val()
        };
        $('.input-comment').remove();

        $.ajax({
            url: "http://blog.loc/like/" + action,
            type: "POST",
            data: promise,
            dataType: "text",
            success: function(result) {

                console.log(result);

            }
        });
    });

// ========================================================

    $(".read").bind("click", function(event) {
        var promise = {
            'date': $(event.target).parent().children('.date').text(),

        };
        $.ajax({
            url: "http://blog.loc/like/read",
            type: "POST",
            data: promise,
            dataType: "text",
            success: function(result) {

                // console.log(result);
                $(event.target).parent().children('.read').text('done')
            }
        });
    });

// ========================================================
//     $("#input-comment").bind("click", function(event) {
//         var promise = {
//             'author_id': $(event.target).closest('li').children('.author').attr('id'),
//             'date': $(event.target).closest('li').children('.date').text(),
//             'table': $(event.target).parent().parent().attr('table'),
//         };
//         $.ajax({
//             url: "http://blog.loc/like/comment",
//             type: "POST",
//             data: promise,
//             dataType: "text",
//             success: function(result) {
//
//                 console.log(result);
//
//
//                 // $("#likeNum").text(result);
//             }
//         });
//     });

    // $('.read').bind("click", function (event) {
    //     // console.log(event.target);
    //     console.log($(event.target).parent().children('.date').text());
    //     // console.log($(event.target).closest('li').children('.author').text());
    // });


});
