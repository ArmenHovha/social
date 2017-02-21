$(document).ready(function(){


    $(".edit").click(function(){
        news_text = $(this).parent().parent().find(".text").text();
        news_title = $(this).parent().parent().find(".h4text").text();
        id = $(this).attr('data-id');
        image = document.getElementById('input_'+id).files[0];
        parent = $(this).parent().parent().find('.news_image');
        error = $(this).parent().find('.newsError')
         var formData = new FormData();

            formData.append('id',id);
            formData.append('news_text',news_text);
            formData.append('news_title',news_title);
            formData.append('image',image);
            
        
        var CSRF_TOKEN = $(this).attr('content');
		$.ajax({
				url:'/edit',
				type:"POST",
                              cache: false,
                            enctype: 'multipart/form-data',
                            data:formData,
                            dataType: "json",
                            processData: false,
                            contentType: false,
                              headers: { 'X-CSRF-TOKEN': $(this).attr('content')},    
				success:function(data){
                                    if(data == 1){
                                        error.css('display','block')
                                    }
                                        console.log(data[0]['news_image']);
                                        parent.attr('src','/uploads/news/'+data[0]['news_image']);
				}
			})
	});
        
        
         $(".delete").click(function(){
        id = $(this).attr('data-id');
        parent = $(this).parent();
        var CSRF_TOKEN = $(this).attr('data-content');
		$.ajax({
				url:'/delete',
				type:"POST",
				data:{id:id,_token: CSRF_TOKEN},
				success:function(data){
					if(data == 1){
                                            parent.slideUp(1000,function(){
						$(this).remove();
                                            })
                                        }
				
					
				}
			})
	});

    $(".like").click(function(){
        key = $(this).attr('data-key');
        id_news = $(this).attr('data-id');
        like = $(this);
        var CSRF_TOKEN = $(this).attr('data-content');
        ikon = $(this).find('.ikon')

        $.ajax({
            url:"/like",
            type:"post",

            data:{id_news:id_news,key:key,_token: CSRF_TOKEN},
            success:function(data){

                    $(like).find(".number").text(data);
                if(key == 'unlike'){
                    $(ikon).toggleClass('glyphicon-thumbs-down ');
                }else{
                    $(ikon).toggleClass('glyphicon-thumbs-up ');
                }

            }
        })

    });


    $(".add_friends").click(function(){
        nofr = $(this).parent().find('.nofr');
         to_id = $(this).attr('data-to_id');
        butt = $(this);
        token = $(this).attr('data-content');
        key = $(this).attr('data-key')

        $.ajax({
           url:"/addfriends",
            type:"post",

            data:{to_id:to_id,key:key,_token:token},
             success:function(data){
                if(data == '1'){
                    $(butt).removeClass('add_friends').off('click');
                    $(butt).text("Request");
                    $(butt).css("opacity","0.2");

                }
                 else if(data == '2') {

                    // $(butt).text("Delete friends");
                    $(butt).hide();
                    $(nofr).hide();


                 }
                 else if(data == '3') {

                   //  $(butt).text("Add friends");
                   $(butt).parent().hide();

                 }

                else{
                    alert("not");
                }





             }
        })
    })


    $('.chatBlock').click(function(){

        $(this).parent().find('.chtaContaner').slideDown(1000)
        from_id = $(this).attr('data-from_id')
        to_id = $(this).attr('data-to_id');
        token = $(this).attr('data-content');
        user_name  = $(this).attr('data-user_name')
        to_name =$(this).attr('data-to_name')
        butt = $(this)
        $(".message_"+to_id).empty();

        $.ajax({
            url: "/showmessage",
            type: "post",
            dataType: "json",
            data: {to_id: to_id, from_id: from_id, _token: token},
            success: function (data) {
                $.each(data,function(){


                        if(this.from_id == from_id){
                            $(".message_"+this.to_id)
                                .append( "<strong class='primary-font'>"+user_name+"</strong></br>")
                                .append("<p>"+this.message+"</p>")
                        }
                        if(this.to_id == from_id) {
                            $(".message_"+this.from_id)
                                .append( "<strong class='primary-font'>"+to_name+"</strong></br>")
                                .append("<p>"+this.message+"</p>")
                        }

                        //$(butt).removeClass('chatBlock').off('click');

                })


            }
        })
        // (function () {
        //     getmessages(to_id)
        // }, 5000);
    })



    $('.closeChat').click(function(){
        $(this).parent().parent().parent().parent().parent().parent().slideUp(1000)
    })




    $('.send').click(function(){
        message = $(this).parent().parent().find('.chatValeu').val()
         to_name = $(this).attr('data-to_name')
         to_id = $(this).attr('data-to_id');
        token = $(this).attr('data-content');


      $(this).parent().parent().find('.chatValeu').val(" ")
        $.ajax({
            url:"/postmessage",
            type:"post",

            data:{to_id:to_id,to_name:to_name,message:message,_token:token},
            success:function(data){
                if(data){

                    $('.message_'+to_id)

                        .append( "<strong class='primary-font'>"+user_name+"</strong></br>")
                        .append("<p>"+ message+"</p>");
                }








            }
        })

    })

    function getmessages(id) {
        token = $("input[name=_token]").val();
        $.ajax({
            url: "/showintervalmessage",
            type: "post",
            dataType: "json",
            data: { _token: token},
            success: function (data) {
                $.each(data, function (key,value) {

                    var html = '<strong class="primary-font">' + value.to_name + '</strong></br>'+
                            '<p>' + value.message + '</p>';
                        $(".message_" + value.from_id).append(html)

                })


            }
        })
    }

    $('.chatM').click(function(){


        from_id = $(this).attr('data-from_id')

        to_id = $(this).attr('data-to_id');
        token = $(this).attr('data-content');
        user_name  = $(this).attr('data-user_name')
        to_name =$(this).attr('data-to_name')
        butt = $(this)
        $(this).find('.online_'+to_id).text('');
        $(".message").empty();

        $.ajax({
            url: "/showOneMessage",
            type: "post",
            dataType: "json",
            data: {to_id: to_id, from_id: from_id, _token: token},
            success: function (data) {
                $.each(data,function(key,value){


                    if(this.from_id == from_id){
                         if(this.file != 0 && this.message == ""){

                             $(".message")  .append("<div class='chat_time pull-right thime'>"+this.updated_at+"</div></br>"+
                                 "<p class='messParagraf'><strong class='primary-font'>"+user_name+"</strong></br>"+
                                "<a class='pull-right' href='downloadFile/"+this.file+"'>" +
                                 "<img  class=' img-responsive imgmessage' src='/uploads/file/"+this.file+" ' alt='profile'>" +
                                 " </a></p>" )
                        }
                       else if(this.file == 0){
                            $(".message")  .append("<div class='chat_time pull-right thime'>"+this.updated_at+"</div></br>"+
                                "<p><strong class='primary-font'>"+user_name+"</strong></br>"+this.message+"</p>")

                        }
                         else if(this.file != 0 && this.message != "" ){
                             $(".message") .append("<div class='chat_time pull-right thime'>"+this.updated_at+"</div></br>"+
                                 "<p class='messParagraf'><strong class='primary-font'>"+user_name+"</strong></br>"+this.message+
                                 "<a class='pull-right' href='downloadFile/"+this.file+"'>" +
                                 "<img  class=' img-responsive imgmessage' src='/uploads/file/"+this.file+" ' alt='profile'>" +
                                 " </a></p>" )
                         }
                    }
                    if(this.to_id == from_id) {
                        if(this.file != 0 && this.message == ""){

                            $(".message")  .append("<div class='chat_time pull-right thime'>"+this.updated_at+ "</div></br>" +
                                "<p class='messParagraf'><strong class='primary-font'>"+to_name+"</strong></br><a class='pull-right' href='downloadFile/"+this.file+"'>" +
                                "<img  class=' img-responsive imgmessage' src='/uploads/file/"+this.file+" ' alt='profile'>" +
                                " </a></p></br>" )
                        }
                        else if(this.file == 0 ){

                            $(".message")  .append("<div class='chat_time pull-right thime'>"+this.updated_at+ "</div></br>" +
                               " <p class='messParagraf'><strong class='primary-font'>"+to_name+"</strong></br>"
                               +this.message+"</p></br>")

                        }
                        else if(this.file != 0 && this.message != "" ){

                            $(".message")
                                // .append("<div class='chat_time pull-right thime'>"+this.updated_at+ "</div>" +
                                // "<strong class='primary-font'>"+to_name+"</strong></br><p>"+this.message+"</br><a class='pull-left' href='downloadFile/"+this.file+"'>" +
                                // "<img width='50' height='50' class=' img-circle' src='/uploads/file/"+this.file+" ' alt='profile'>" +
                                // " </a></p>" )


                                .append( "<div class='chat_time pull-right thime'>"+this.updated_at+ "</div></br>" +
                                    "<p class='messParagraf'><strong class='primary-font'>"+to_name+"</strong>" +
                                    "</br><a class='pull-right' href='downloadFile/"+this.file+"'>" +
                                    "<img  class=' img-responsive imgmessage' src='/uploads/file/"+this.file+" ' alt='profile'>" +
                                    " </a></br>"+this.message+"</p></br>" )
                        }




                    }

                    //$(butt).removeClass('chatBlock').off('click');

                })


            }
        })
         // (function () {
         //    getmessagesChat(to_id)
         // }, 1000);
    })


    $('.sendChat').click(function(){
        message = $(this).parent().parent().find('.text').val()
        user_name  = $(this).attr('data-user_name')
        token = $(this).attr('data-content');
        file = document.getElementById('input').files[0];

        $(this).parent().parent().find('.text').val(" ")


        if(file == null) {
            $.ajax({
                url:"/postChatMessage",
                type:"post",

                data:{to_id:to_id,to_name:to_name,message:message,_token:token},
                success:function(data){
                    if(data){

                        $('.message') .append( "<p><strong class='primary-font'>"+user_name+"</strong></br>"+ message+"</p></br>")

                    }
                }
            })

        }
             else{

            filename =  document.getElementById('input').files[0].name;


                    formData = new FormData();

                    formData.append('user_name',user_name);
                    formData.append('message',message);
                    formData.append('to_name',to_name);
                    formData.append('to_id',to_id);
                    formData.append('file',file);



                    var CSRF_TOKEN = $(this).attr('content');
                    $.ajax({
                        url:'/postChatMessage',
                        type:"POST",
                        cache: false,
                        enctype: 'multipart/form-data',
                        data:formData,
                        //dataType: "json",
                        processData: false,
                        contentType: false,
                        headers: { 'X-CSRF-TOKEN':  token},
                        success:function(data){
                            if (this.data){


                                    $('.message')
                                            .append( "<p><strong class='primary-font'>"+user_name+"</strong></br><a class='pull-right' href='downloadFile/"+data+"'>" +
                                                "<img  class=' img-responsive imgmessage' src='/uploads/file/"+data+" ' alt='profile'>" +
                                                " </a></br>"+message+"</p></br>" )
                                }


                        }

                    })
}

        $('#input').val("")


    })
    function getmessagesChat(id) {
        token = $("input[name=_token]").val();
        $.ajax({
            url: "/showintervalOneMessage",
            type: "post",
            dataType: "json",
            data: { _token: token},
            success: function (data) {
                $.each(data, function (key,value) {

                    if(this.from_id == from_id){
                        $(".message")
                           .append("<div class='chat_time pull-right thime'>"+this.updated_at+ "</div>")
                            .append( "<strong class='primary-font'>"+user_name+"</strong></br>")
                            .append("<p>"+this.message+"</p>")
                    }
                    if(this.to_id == from_id) {
                        $(".message")
                            .append("<div class='chat_time pull-right thime'>"+this.updated_at+ "</div>")
                            .append( "<strong class='primary-font'>"+to_name+"</strong></br>")
                            .append("<p>"+this.message+"</p>")
                    }

                   // var html = '<strong class="primary-font">' + value.to_name + '</strong></br>'+
                      //  '<p>' + value.message + '</p>';


                   // $(".message").append(html)




                })


            }
        })
    }




    //
    //     $(document).on("click",".dow",function () {
    //         filename = $(this).text();
    //         token = $("input[name=_token]").val();
    //
    //
    //      $.ajax({
    //          url:"/downloadFile",
    //         type:"get",
    //
    //         data:{filename:filename,_token:token},
    //          success:function(data){
    //             if(data){
    //
    //              }
    //
    //          }
    //     })
    //
    // })




})
