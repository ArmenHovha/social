@extends('layouts.app')
@section('content')
<div class="main_section">
   <div class="container">
      <div class="chat_container">
         <div class="col-sm-3 chat_sidebar">
    	 <div class="row">
            <div id="custom-search-input">
               <div class="input-group col-md-12">
                  <input type="text" class="  search-query form-control" placeholder="Conversation" />
                  <button class="btn btn-danger" type="button">
                  <span class=" glyphicon glyphicon-search"></span>
                  </button>
               </div>
            </div>
            <div class="dropdown all_conversation">
               <button class="dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
               <i class="fa fa-weixin" aria-hidden="true"></i>
               All Users
               <span class="caret pull-right"></span>
               </button>

            </div>
            <div class="member_list">
               <ul class="list-unstyled">
                  @foreach($users as $u)


                       @if( $id != $u->id )
                  <li class="left clearfix chatM" data-user_name="{{Auth::user()->name}}" data-to_name = '{{$u->name}}'
                      data-from_id="{{$id}}" data-to_id = '{{$u->id}}'data-content="{{csrf_token()}}">
                     <span class="chat-img pull-left">

                        @if($u->avatar == false)
                           <img src="/images/nophoto.png" alt="User Avatar" class="img-circle">
                        @else
                           <img src="/uploads/{{$u->avatar}}"  alt="User Avatar" class="img-circle">
                        @endif
                     </span>
                     <div class="chat-body clearfix">
                        <div class="header_sec">
                           <strong class="primary-font message_{{$u->id}}">{{$u->name}}</strong>
                                @if($u->messagesCount)
                               @foreach($u->messagesCount as $co )
                                   @if(!empty($co->countmessage))
                                   {{--// <span class="badge pull-right online_{{$u->id}}">--}}
{{--                                  // {{$co->countmessage}}--}}
                                       {{--</span></br>--}}
                                    @endif
                               @endforeach


                                    @endif
                            <span class="badge pull-right online_{{$u->id}}"></span></br>
                        </div>

                     </div>
                  </li>

                       @endif

                  @endforeach

               </ul>
            </div></div>
         </div>
         <!--chat_sidebar-->
		 
		 
         <div class="col-sm-9 message_section">
		 <div class="row">
		 <div class="new_message_head">
		 <div class="pull-left"><button><i class="fa fa-plus-square-o" aria-hidden="true"></i> New Message</button></div><div class="pull-right">
            </div>
		 </div><!--new_message_head-->

		 <div class="chat_area">
		 <ul class="list-unstyled">

		        <li class="left clearfix">
                     <span class="chat-img1 pull-left">
                    {{--// <img src="https://lh6.googleusercontent.com/-y-MY2satK-E/AAAAAAAAAAI/AAAAAAAAAJU/ER_hFddBheQ/photo.jpg" alt="User Avatar" class="img-circle">--}}
                     </span>
                     <div class="chat-body1 clearfix message">


                     </div>
                  </li>
		 </ul>
		 </div><!--chat_area-->
          <div class="message_write">
             <textarea class="form-control text" placeholder="type a message" ></textarea>
             <div class="clearfix"></div>
             <div class="chat_bottom">

                     <label for="input" style="cursor: pointer;">Add Files</label>
								<span class="btn btn-default btn-file browse btn btn-primary " style="visibility: hidden;">
									<input id="input"type="file" name='file' >
								</span>


                  <button class="btn btn-warning btn-sm sendChat pull-right" id="btn-chat"  data-user_name="{{Auth::user()->name}}" data-content="{{csrf_token()}}">
                      Send</button>
                  </span>
             </div>
		 </div>
         </div> <!--message_section-->
      </div>
   </div>
</div>











@endsection