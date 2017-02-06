
@extends('layouts.app')
@section('content')
    <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.1.0/css/font-awesome.min.css"/>
    <div class="container">
        @foreach($param as  $n)
            <div class="well news" id="news_{{ $n->id}}">

                @if($id == $n->id_user)
                    <button type="" class="btn btn-danger btn-sm delete" data-content="{{csrf_token()}}" data-id="{{$n->id}}">
                        <span class="glyphicon glyphicon-remove"></span> Remove
                    </button>
                @endif
                <div class="media">
                    <a class="pull-left" href="">
                        <img class="media-object news_image"  width="80" height="80" src="/uploads/news/{{$n->news_image}}">
                    </a>

                    <div class="media-body">
                        @if($id == $n->id_user)
                            <h4 contenteditable class="media-heading h4text">{{$n->news_title}}</h4>

                            <p contenteditable class="text">{{$n->news_text}}</p>
                        @else
                            <h4 class="media-heading h4text">{{$n->news_title}}</h4>

                            <p class="text">{{$n->news_text}}</p>
                        @endif
                        <ul class="list-inline list-unstyled">
                            <li><span><i class="glyphicon glyphicon-calendar"></i>11</span></li>
                            <li>|</li>
                            <span><i class="glyphicon glyphicon-comment"></i> 2 comments</span>
                            <li>|</li>
                            <li>
                                <span class="glyphicon glyphicon-star"></span>
                                <span class="glyphicon glyphicon-star"></span>
                                <span class="glyphicon glyphicon-star"></span>
                                <span class="glyphicon glyphicon-star"></span>
                                <span class="glyphicon glyphicon-star-empty"></span>
                            </li>
                            <li>|</li>
                            <li>
                                <!-- Use Font Awesome http://fortawesome.github.io/Font-Awesome/ -->
                                <span><i class="fa fa-facebook-square"></i></span>
                                <span><i class="fa fa-twitter-square"></i></span>
                                <span><i class="fa fa-google-plus-square"></i></span>

                            </li>
                        </ul>

                    </div>

                    @if($id == $n->id_user)
                        <div class="form-group">

                            <div class="alert alert-danger newsError">
                                error
                            </div>


                            <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                        <span class="btn btn-default btn-file browse btn btn-primary "><i class="glyphicon glyphicon-search"></i>Image
                    <input id="input_{{$n->id}}" type="file" name='image' multiple='true' ></span>
                            <!--<button class="browse btn btn-success input-lg" type="submit" name= "add_image"> Edit images</button>-->

                            </br>
                            <button type="" data-id="{{$n->id}}" content="{{csrf_token()}}" class="btn btn-success btn-sm edit">

                                <span class="glyphicon glyphicon-edit"></span> Edit
                            </button>
                        </div>

                    @endif


                </div>

                    <div class="iconlike">

                        @if($n->id_users == $id and $n->id_news == $n->id )

                        <span class="btn btn-default btn-sm like pull-right" data-content="{{csrf_token()}}" data-key ="like" data-id="{{$n->id}}">
                            <span class="ikon pull-right glyphicon glyphicon-thumbs-down  "></span> <span class="badge number">{{$n->lik}}</span>
						</span>
                       @else
                            <span  class="btn btn-default btn-sm like  pull-right" data-content="{{csrf_token()}}" data-key ="unlike" data-id="{{$n->id}}">
                                 <span class="ikon glyphicon pull-right  glyphicon-thumbs-up "></span> <span class="badge number pull-right">{{$n->lik}} </span>
                            </span>

                        @endif
                    </div>
            </div>

        @endforeach
    </div>


@endsection