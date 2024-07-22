@extends('admin.layout')
@section('content')
    

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">{{$exam->name("en")}}</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route("dashHome")}}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{route("exam.index")}}">exams</a></li>
            <li class="breadcrumb-item">{{$exam->name("en")}}</a></li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->
  <div class="card">
    <div class="card-header">
      <h3 class="card-title">Exam Details</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body p-0">
      <table class="table table-sm">
        
        <tbody>
          <tr>
            <td>name en</td>
            <td>
                {{$exam->name("en")}}
            </td>
          </tr>
          <tr>
            <td>name ar</td>
            <td>
                {{$exam->name("ar")}}
            </td>
          </tr>
          <tr>
            <td>desc en</td>
            <td>
                {{$exam->desc("en")}}
            </td>
          </tr>
          <tr>
            <td>desc ar</td>
            <td>
                {{$exam->desc("ar")}}
            </td>
          </tr>
          <tr>
            <td>skill name (en)</td>
            <td>
                {{$exam->skill->name("en")}}
            </td>
          </tr>
          <tr>
            <td>img</td>
            <td>
                <img src="{{asset("uploads/$exam->img")}}" height="100px" alt="">
            </td>
          </tr>
          <tr>
            <td>question</td>
            <td>
                {{$exam->question_no}}
            </td>
          </tr>
          <tr>
            <td>difficulty</td>
            <td>
                {{$exam->difficulty}}
            </td>
          </tr>
          <tr>
            <td>duration_mins</td>
            <td>
                {{$exam->duration_mins}}
            </td>
          </tr>
          <tr>
            <td>active</td>
            <td>
                @if ($exam->active ==1)
                                    
                                    <span class="badge text-bg-success">active</span>
                                @else
                                    
                                <span class="badge text-bg-danger">non-active</span></td>
                                @endif
                                <td>
            </td>
        </tr>
        
    </tbody>
</table>
</div>
<!-- /.card-body -->
</div>
<a href="{{route("examQues.show",["id"=>$exam->id])}}" class="btn btn-sm btn-info ">show ques</a>
<a href="{{url()->previous()}}" class="btn btn-sm btn-success ">back</a>
  <!-- Main content -->
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        
      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content -->
</div>
  @endsection