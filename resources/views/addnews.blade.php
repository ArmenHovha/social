
@extends('layouts.app')
@section('content')



    <div class="panel-heading"><h4>Add News</h4></div>
    <div class="panel-body">
        <form action="/postnews" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="email">News title:</label>
                <input type="text" class="form-control" id="email" name="news_title"required>
            </div>

            <input type="hidden" name="_token" value="{{csrf_token()}}"/>



            <div class="form-group">
                <label for="comment">News Text:</label>
                <textarea class="form-control" rows="5" id="comment" name="news_text"></textarea>
            </div>
            <div class="form-group">
                <label >News images:</label>
                <span class="btn btn-default btn-file browse btn btn-primary "><i class="glyphicon glyphicon-search"></i>Images News<input type="file" name='image' multiple='true' ></span>

            </div>

            <button type="submit" class="btn btn-success" name="add_prod">Add news</button>
        </form>
        <div class="panel-heading">
            @if(Session::has('error_danger'))
                <div class="alert alert-danger">
                    {{Session::get('error_danger')}}
               </div>
           @endif
        </div>
    </div>
    </div>













@endsection