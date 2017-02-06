@extends('layouts.app')

@section('content')
    <div class="row profile">

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



            </div>
        </div>
        <div class="col-md-9">
            <div class="profile-content">











            </div>
        </div>
    </div>

@endsection
