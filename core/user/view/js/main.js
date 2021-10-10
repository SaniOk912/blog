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

    $(".like").bind("click", function(event) {
        var promise = {
            'author_id': $(event.target).closest('li').children('.author').attr('id'),
            'date': $(event.target).closest('li').children('.date').text(),
            'table': $(event.target).parent().parent().attr('table'),

        };
        $.ajax({
            url: "http://blog.loc/like",
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

                // $("#likeNum").text(result);
            }
        });
    });

    // $('.posts').bind("click", function (event) {
    //     // console.log(event.target);
    //     console.log($(event.target).closest('li').children('.author').attr('id'));
    //     console.log($(event.target).closest('li').children('.author').text());
    // });


});
