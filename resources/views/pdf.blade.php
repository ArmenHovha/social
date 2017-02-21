<html lang="en">
<head>
    <meta charset="utf-8">


    <!-- CSRF Token -->



    <!-- Styles -->
    {{--<link href="/css/app.css" rel="stylesheet">--}}
    {{--<link rel="stylesheet" href="/css/bootstrap.css" />--}}
    {{--<link rel="stylesheet" href="/css/style.css" />--}}
{{--    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">--}}
{{--    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.css') }}" media="all"/>--}}
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" media="all" />
{{--    <link type="text/css" media="all" rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">--}}
    {{--<link   rel="stylesheet" href="{{ asset('css/bootstrap.css') }}" media="all"  />--}}



    <!-- Scripts -->

</head>
<body>

<div class="chat_area">
    <ul class="list-unstyled">

        <li class="left clearfix" >
                     <span class="chat-img1" >
                    {{--// <img src="https://lh6.googleusercontent.com/-y-MY2satK-E/AAAAAAAAAAI/AAAAAAAAAJU/ER_hFddBheQ/photo.jpg" alt="User Avatar" class="img-circle">--}}
                     </span>
            <div class="chat-body1 clearfix message">
                @foreach($getmessage as $v)





                    @if($v->from_id == $from_id)
                                @if($v->file != 0 and empty($v->message))

                               <div class='chat_time pull-right thime' >{{$v->updated_at}}</div></br>
                                <p class='messParagraf'><strong class='primary-font text-warning'style="margin-left:200px;">{{$user_name}}</strong></br>
                                 </p>
                                @endif
                               @if($v->file == 0)
                               <div class='chat_time pull-right thime'style="margin-left:80%;">{{$v->updated_at}}</div></br>
                                <p><strong class='primary-font'>{{$user_name}}</strong><br><br>{{$v->message}}</p>

                                @endif
                            @if($v->file != 0 and !empty($v->message))
                             <div class='chat_time pull-right thime'style="margin-left:80%;">{{$v->updated_at}}</div></br>
                                <p class='messParagraf'><strong class='primary-font'>{{$user_name}}</strong><br><br></br>{{$v->message}}
                                 </p>
                             @endif
                    @endif

                    @if($v->to_id == $from_id)
                            @if($v->file != 0 and empty($v->message) )

                           <div class='chat_time pull-right thime'style="margin-left:80%;">{{$v->updated_at}}</div></br>
                            <p class='messParagraf'><strong class='primary-font'>{{$to_name}}</strong></p><br>
                            @endif

                            @if($v->file == 0)

                          <div class='chat_time pull-right thime'style="margin-left:80%;">{{$v->updated_at}}</div></br>
                            <p class='messParagraf'><strong class='primary-font'>{{$to_name}}</strong><br><br></br>
                                {{$v->message}}</p></br>

                            @endif

                            @if($v->file != 0 and !empty($v->message)  )



                            <div class='chat_time pull-right thime'style="margin-left:80%;">{{$v->updated_at}}</div></br>
                            <p class='messParagraf'><strong class='primary-font'>{{$to_name}}</strong>
                                <br>  <br>{{$v->message}}</p></br>
                        @endif

                      @endif

                    @endforeach

            </div>
        </li>
    </ul>
</div>
</body>
</html>