@extends('admin.layout')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"> add exam</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route("dashHome")}}">Home</a></li>
                        <li class="breadcrumb-item active">add exam</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
        <!-- Main content -->
        <div class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- <card body> -->
                <div class="col-12 pb-3">
                    @include("admin.inc.erorr")
                    <form method="POST" action="{{route("admin.store")}}" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                          <div class="form-group">
                            <label">name</label>
                            <input type="text" class="form-control" name="name" >
                          </div>
                          <div class="form-group">
                            <label">Email address</label>
                            <input type="email" class="form-control" name="email" >
                          </div>
                          <div class="form-group">
                            <label>Password</label>
                            <input type="password" class="form-control" name="password">
                          </div>
                          <div class="form-group">
                            <label >confirm Password</label>
                            <input type="password" class="form-control" name="password_confirmation">
                          </div>
                          
                          <div class="form-group">
                            <label>Role</code></label>
                            <select class="custom-select form-control-border border-width-2" name="role_id">
                                @foreach ($roles as $role)
                                  
                              <option value="{{$role->id}}">{{$role->name}}</option>
                              @endforeach
                            </select>
                          </div>

                        </div>
                        <!-- /.card-body -->
        
                        <div class="card-footer">
                          <button type="submit" class="btn btn-primary">Submit</button>
                          <a href="{{url()->previous()}}" class="btn btn-primary">back </a>
                        </div>
                      </form>
                </div>

            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection
