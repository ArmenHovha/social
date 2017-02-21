$(document).ready(function() {
    $(document).on('click', '.pagination   a', function (e) {
        e.preventDefault();

        var page = $(this).attr('href').split('page=')[1];

        $.ajax({
            type: "get",
            url: '/home/?page=' + page,
            success:function (data) {
                $('.emptyMe').empty();

                console.log(data);
                $('.profilecontent').html(data);
                location.hash = page;
        }

        })
   })
    $('.chatM').click(function(){
        to_id = $(this).attr('data-to_id');
        to_name =$(this).attr('data-to_name')
       //$(".formpdf").append("  <input type='post' name='to_id' valeu=1>")

 })

    $(".pdf").click(function(){
      // text = $('.message').html();

        token = $("input[name=_token]").val();


        $.ajax({

            url: '/pdf',
            type: "get",

            data: {_token: token},
            success:function (data) {


                console.log(data);

            }

        })
        location.href = '/pdf/'+to_id+'/'+to_name;
    })

})