@if (session("msg"))
    <div class="alert alert-success">
        {{session("msg")}}
    </div>
@endif
@if ($errors->any())
    <div class="alert alert-danger">
        @foreach ($errors->all() as $error)
            
        <p>{{$error}}</p>
        @endforeach
    </div>
@endif