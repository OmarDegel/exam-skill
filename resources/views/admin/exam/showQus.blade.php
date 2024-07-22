@extends('admin.layout')
@section('content')
    

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">{{$exam->name("en")}} question</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route("dashHome")}}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{route("exam.index")}}">all exams</a></li>
            <li class="breadcrumb-item"><a href="{{route("exam.show",["exam"=>$exam->id])}}">exam</a></li>
            <li class="breadcrumb-item">question</a></li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->
  <div class="card">
    <div class="card-header">
      <h3 class="card-title">Exam question</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4"><div class="row"><div class="col-sm-12 col-md-6"></div><div class="col-sm-12 col-md-6"></div></div><div class="row"><div class="col-sm-12"><table id="example2" class="table table-bordered table-hover dataTable dtr-inline" aria-describedby="example2_info">
        <thead>
        <tr><th class="sorting sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">id</th><th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">title</th><th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">option</th><th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">rigth ans</th><th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending">actions</th></tr>
        </thead>
        @foreach ($ques as $q)
            
        <tbody>
            
            <tr class="odd">
            <td>{{$loop->iteration}}</td>
            <td>{{$q->title}}</td>
            <td>
                1_{{$q->option_1}} <br>
                2_{{$q->option_2}} <br>
                3_{{$q->option_3}} <br>
                4_{{$q->option_4}} <br>
            </td>
            <td>{{$q->right_ans}}</td>
            
            <td>
            
            <td>

                {{-- <div class="modal fade" id="edit-modal" aria-hidden="true" style="display: none;">

                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h4 class="modal-title">edit category</h4>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <form  action="{{route("skill.update",["skill"=>$skill->id])}}"  id="edit-form"  method="POST" enctype="multipart/form-data">
                            @csrf
                            @method("PATCH")
                            <input type="hidden" name="id" id="edit-form-id">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Name(en)</label>
                                        <input type="text" name="name_en" class="form-control" id="edit-form-name-en">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Name(ar)</label>
                                        <input type="text" name="name_ar" class="form-control" id="edit-form-name-ar">
                                    </div>
                                </div>
                                <div class="form-group">
                                  <label> category</label>
                                  <select class="custom-select form-control" name="cat_id">
                                      @foreach ($cats as $cat)
                                      
                                      <option  value="{{$cat->id}}">{{$cat->name("en")}}</option>
                                      @endforeach
                                  </select>
                                </div>
                                <div class="col-6">
                                <div class="form-group">
                                  <label >img</label>
                                  <div class="input-group">
                                    <div class="custom-file">
                                      <input type="file" class="custom-file-input" name="img">
                                      <label class="custom-file-label" >Choose file</label>
                                    </div>
                                    
                                  </div>
                                
                              </div>
                              
                              </div>
                              
                            
                  
                            </div>
                  
                        </form>
                    </div>
                  
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" form="edit-form" class="btn btn-primary">submit</button>
                    </div>
                            
                      </div>
                      <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                  </div>    
              </div> --}}
                
                <a href="{{url("dashboard/edit/exam/$exam->id/questions/$q->id")}}"   class="btn btn-sm btn-info edit-btn" >
                    <i class="fas fa-edit"></i>
                </a>
              <form action="{{ route('ques.destroy', ['ques_id' => $q->id]) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
            </form>
              
            </td>
            
          </tr></tbody>
          @endforeach
          
        </table>
        
<!-- /.card-body -->
</div>
</div>
<a href="{{route("exam.index",["id"=>$exam->id])}}" class="btn btn-sm btn-info ">exams</a>
<a href="{{(route("exam.show",["exam"=>$exam->id]))}}" class="btn btn-sm btn-success ">back to exam</a>
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