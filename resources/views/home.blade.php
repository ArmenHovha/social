@extends('layouts.app')

@section('content')
	 <div class="row profile profilecontent">

		<div class="col-md-3 ">
			<div class="profile-sidebar fb-profile">
				<!-- SIDEBAR USERPIC -->
				<div class="profile-userpic avatar">
				 @if($param->avatar == false)
                                <img src="/images/nophoto.png"  class="img-responsive" alt="">
                                @else
                                 <img src="/uploads/{{$param->avatar}}"  class="img-responsive" alt="">
                                @endif
				</div>
				<!-- END SIDEBAR USERPIC -->
				<!-- SIDEBAR USER TITLE -->
				<div class="profile-usertitle">
					<div class="profile-usertitle-name">
						{{$param->name}}
					</div>
					<div class="profile-usertitle-job">

					</div>
				</div>
				<!-- END SIDEBAR USER TITLE -->
				<!-- SIDEBAR BUTTONS -->
				<div class="profile-userbuttons">



					<form action = "/upload" method = "post" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{csrf_token()}}"/>
						<span class="btn btn-default btn-file browse btn btn-primary "><i class="glyphicon glyphicon-search"></i>Browse<input type="file" name='image' multiple='true' ></span>
						<button class="browse btn btn-success input-lg" type="submit" name= "add_image"> Add images</button>
					</form><br>
				</div>


			</div>

		</div>
		<div class="col-md-9">
            <div class="profile-content ">




					@foreach($users as $u)
					@if( $id != $u->id )

					<div class="row">


						<div class="searchable-container">



								<div class="info-block block-info clearfix">
									<div class="square-box pull-left">

										@if($u->avatar == false)
											<img src="/images/nophoto.png"  class="img-responsive " alt="">
										@else
											<img src="/uploads/{{$u->avatar}}"  class="img-responsive" alt="">
										@endif
									</div>

									<h4>Name: <a href="userpage/{{$u->id}}">{{$u->name}}</a>
									@if($u->isOnline())
											<span>online
										<img src="/images/onlineicon.png"  class="img-responsive " alt=""></span>
									@endif
									</h4>
									<p>Title: Manager</p>
									<span >Message: </span>
									<img src="/images/Messages.png" style="display:inline-block; padding:5px;cursor:pointer" class="img-responsive chatBlock" data-user_name="{{Auth::user()->name}}" data-to_name = '{{$u->name}}'
																data-from_id="{{$id}}" data-to_id = '{{$u->id}}'data-content="{{csrf_token()}}"alt=""></br>
									<span>Phone: 555-555-5555</span></br>
									<span>Email: sample@company.com</span></br>


																{{--chat--}}





									<div class="container chtaContaner">
										<div class="row">
											<div class="col-md-5">
												<div class="panel panel-primary ">
													<div class="panel-heading">
														<span class="glyphicon glyphicon-comment"></span> Chat
														<div class="btn-group pull-right">
															<button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
																<span class="glyphicon glyphicon-chevron-down"></span>
															</button>
															<ul class="dropdown-menu slidedown">
																<li><a href="#"><span class="glyphicon glyphicon-refresh">
                            </span>Refresh</a></li>
																<li><a href="#"><span class="glyphicon glyphicon-ok-sign">
                            </span>Available</a></li>
																<li><a href="#"><span class="glyphicon glyphicon-remove">
                            </span>Busy</a></li>
																<li><a href="#"><span class="glyphicon glyphicon-time"></span>
																		Away</a></li>
																<li class="divider"></li>
																<li><a href="#"><span class="glyphicon glyphicon-off"></span>
																		Sign Out</a></li>
															</ul>
														</div>
													</div>
													<div class="panel-body chat_1">
														<ul class="chat">
															<li class="left clearfix">
																<div class="chat-body clearfix message_{{$u->id}}">





																</div>
															</li>



														</ul>
													</div>
													<div class="panel-footer">
														<div class="input-group">
															<input id="btn-input" type="text" class="form-control input-sm chatValeu" placeholder="Type your message here..." />
															<span class="input-group-btn">
															<button class="btn btn-warning btn-sm send" id="btn-chat" data-to_name="{{$user_name}}" data-to_id = '{{$u->id}}'data-content="{{csrf_token()}}">
																Send</button>
														</span>
														</div>
														<div class="modal-footer">
															<button type="button" class="btn btn-default closeChat" >Close</button>
														</div>
													</div>
												</div>
											</div>
										</div>

									</div>


																					{{--chat--}}







								@if( $u->in_id == $id and $u->status == 1 )

										<button type="button" data-content="{{csrf_token()}}"  data-to_id = "{{$u->id}}" style="opacity:0.2"
												class="btn btn-sm btn-primary  right ">Request</button>


									@elseif( $u->to_id == $id and $u->status == 2 or $u->in_id == $id and $u->status == 2  )

										<button type="button" data-content="{{csrf_token()}}"  data-to_id = "{{$u->id}}"
												class="btn btn-sm btn-danger  right add_friends" data-key="no" > delete friends</button>

									@elseif($u->to_id == $id)

										<button type="button" data-content="{{csrf_token()}}"  data-to_id = "{{$u->id}}"
												class="btn btn-sm btn-primary  right add_friends"data-key="yes"> Add </button>
										<button type="button" data-content="{{csrf_token()}}"  data-to_id = "{{$u->id}}"
												class="btn btn-sm btn-danger  right add_friends nofr" data-key="no"> Delete</button>
									@else

										<button type="button" data-content="{{csrf_token()}}"  data-to_id = "{{$u->id}}"

												class="btn btn-sm btn-primary  right add_friends" data-key="add"> Add friends</button>

									@endif

								</div>



						</div>
					</div>
					@endif



					@endforeach


						<div id="pagination">{{ $users->links() }}</div>


						<!-- Modal -->
						<div id="myModal" class="modal fade" role="dialog">
							<div class="modal-dialog">

								<!-- Modal content-->
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal">&times;</button>
										<h4 class="modal-title">Modal Header</h4>
									</div>
									<div id="calendar"></div>
									<div class="modal-body">



										<div class="modal-footer">
											<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
										</div>
									</div>

								</div>

							</div>
						</div>
							<!--- Modal-->
            </div>
		</div>
	</div>






@endsection
