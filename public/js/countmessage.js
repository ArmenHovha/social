$(document).ready(function(){
    setInterval(function () {
        countMessage()
     },1000);

    function countMessage() {
        token = $("input[name=_token]").val();
        $.ajax({
            url: "/countmessage",
            type: "post",
            dataType: "json",
            data: {_token: token},
            success: function (data) {

            $('.online').text(data)

            }


        })
    }

         setInterval (function () {
            countOneMessage()
         }, 1000);

        function countOneMessage() {
            token = $("input[name=_token]").val();
            $.ajax({
                url: "/countOneMessage",
                type: "post",
                dataType: "json",
                data: {_token: token},
                success: function (data) {
                    if (data) {

                        $.each(data, function (key, value) {
                            $('.online_' + key).text(value);
                        })

                    }

                }


            })
        }

})
