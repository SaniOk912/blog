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

    $("#like").bind("click", function(event) {
        var promise = {
            'id'  : $("#like").attr("data-id"),
            'user_id': $("#like").attr("user-id"),
            'table': $("#like").attr("table")
        };
        console.log(promise);
        $.ajax({
            url: "http://blog.loc/like",
            type: "POST",
            data: promise,
            dataType: "text",
            success: function(result) {

                console.log(result);
                // $("#likeNum").text(result);

            }
        });
    });

    // $('body').bind("click", function (event) {
    //     // console.log(event.target);
    //     console.log($(event.target).attr("table"));
    // });

});
