$(document).ready(function() {
// ===================================================
//     $(".like").bind("click", function(event) {
//         var promise = {
//             'author_id': $(event.target).closest('li').children('.author').attr('id'),
//             'date': $(event.target).closest('li').children('.date').text(),
//             'table': $(event.target).parent().parent().attr('table'),
//         };
//         $.ajax({
//             url: "http://blog.loc/like/like",
//             type: "POST",
//             data: promise,
//             dataType: "text",
//             success: function(result) {
//
//                 console.log(result);
//                 if(result === 'zero likes') {
//                     $(event.target).closest('li').children('.likeNum').text('0');
//                 }else if(result !== 'error') {
//                     $(event.target).closest('li').children('.likeNum').text(result);
//                 }
//
//                 // $("#likeNum").text(result);
//             }
//         });
//     });
// =======================================================
//     var action;
//
//     $(".comment, .edit").bind("click", function(event) {
//         action = $(event.target).attr('class');
//         if($('.input-comment').length) {
//             $('.input-comment').remove();
//             $(event.target).after('<div class="input-comment"><input type="text" name="comment"><span id="input-comment" style="margin-left: 10px">save</span></div>');
//         }else{
//             $(event.target).after('<div class="input-comment"><input type="text" name="comment" class="comment-input"><span id="input-comment" style="margin-left: 10px">save</span></div>');
//         }
//     });
//
//     $(document).on('click','#input-comment', function(event){
//         var promise = {
//             'author_id': $(event.target).closest('li').children('.author').attr('id'),
//             'date': $(event.target).closest('li').children('.date').text(),
//             'table': $(event.target).parent().parent().parent().attr('table'),
//             'content': $(event.target).parent().children('.comment-input').val()
//         };
//         $('.input-comment').remove();
//
//         $.ajax({
//             url: "http://blog.loc/like/" + action,
//             type: "POST",
//             data: promise,
//             dataType: "text",
//             success: function(result) {
//
//                 // console.log(result);
//
//             }
//         });
//     });

// ========================================================

    // $(".read").bind("click", function(event) {
    //     var promise = {
    //         'date': $(event.target).parent().children('.date').text(),
    //
    //     };
    //     $.ajax({
    //         url: "http://blog.loc/like/read",
    //         type: "POST",
    //         data: promise,
    //         dataType: "text",
    //         success: function(result) {
    //
    //             // console.log(result);
    //             $(event.target).parent().children('.read').text('done')
    //         }
    //     });
    // });

// ========================================================

    // $('.read').bind("click", function (event) {
    //     console.log(event.target);
    //     console.log($(event.target).parent().children('.date').text());
    //     // console.log($(event.target).closest('li').children('.author').text());
    // });

    $(".like").bind("click", function(event) {
        var promise = {
            'author_id': $(event.target).attr('author_id'),
            'date': $(event.target).attr('date'),
            'table': $(event.target).attr('table'),
        };
        $.ajax({
            url: "http://blog.loc/like/like",
            type: "POST",
            data: promise,
            dataType: "text",
            success: function(result) {

                console.log(result);
                if(result === 'zero likes') {
                    $(event.target).parent().children('.like-num').text(0);
                }else if(result !== 'error') {
                    $(event.target).parent().children('.like-num').text(result);
                }

            }
        });
        event.stopImmediatePropagation();
    });
//    =================================================================================

    // var action;
    //
    // $(".comment, .edit").bind("click", function(event) {
    //     action = $(event.target).attr('class');
    //     if($('.input-comment').length) {
    //         $('.input-comment').remove();
    //         $(event.target).parent().after('<div class="input-comment"><input type="text" name="comment"><span id="input-comment" style="margin-left: 10px">save</span></div>');
    //     }else{
    //         $(event.target).parent().after('<div class="input-comment"><input type="text" name="comment"><span id="input-comment" style="margin-left: 10px">save</span></div>');
    //     }
    //     event.stopImmediatePropagation();
    // });

    // $(document).on('click','#input-comment', function(event){
        // var promise = {
        //     'author_id': $(event.target).closest('li').children('.author').attr('id'),
        //     'date': $(event.target).closest('li').children('.date').text(),
        //     'table': $(event.target).parent().parent().parent().attr('table'),
        //     // 'content': $(event.target).parent().children('.comment-input').val()
        //     'content': $(event.target).parent().parent().children('.comment-input').val()
        // };
        // console.log($(event.target).parent().parent().children('.comment-input').val());
        // $('.input-comment').remove();
        //
        // $.ajax({
        //     url: "http://blog.loc/like/" + action,
        //     type: "POST",
        //     data: promise,
        //     dataType: "text",
        //     success: function(result) {
        //
        //         // console.log(result);
        //
        //     }
        // });
        // event.stopImmediatePropagation();
    // });

});
