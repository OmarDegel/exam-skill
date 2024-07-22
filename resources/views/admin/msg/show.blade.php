@extends('admin.layout')
@section('content')

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Message Details</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('dashHome') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('msg.index') }}">Messages</a></li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <div class="card">
    <div class="card-header">
      <h3 class="card-title">Message Details</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body p-0">
      <table class="table table-sm">
        <tbody>
          <tr>
            <td>Name</td>
            <td>{{ $msg->name }}</td>
          </tr>
          <tr>
            <td>Email</td>
            <td>{{ $msg->email }}</td>
          </tr>
          <tr>
            <td>Subject</td>
            <td>{{ $msg->subject }}</td>
          </tr>
          <tr>
            <td>Body</td>
            <td>{{ $msg->body }}</td>
          </tr>
        </tbody>
      </table>
    </div>
    <!-- /.card-body -->
  </div>

  <a href="{{ url()->previous() }}" class="btn btn-sm btn-success">Back</a>

  <!-- Main content -->
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="card card-info">
          <div class="card-header">
            <h3 class="card-title">Horizontal Form</h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          @include("admin.inc.erorr")
                    <form method="POST" action="" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>title</label>
                                        <input type="text" class="form-control" name="name_en">
                                    </div>
                                </div>
                                
                            </div>
                            <div class="form-group">
                                <label>Description</label>
                                <textarea type="text" class="form-control" name="desc"></textarea>
                            </div>
                           
                            
                            
                            <div>
                                <button type="submit" class="btn btn-success">Submit</button>
                                <a href="{{url()->previous()}}" class="btn btn-primary">back </a>
                            </div>
                        </div>
                    </form>
        </div>
      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content -->
</div>

@endsection
