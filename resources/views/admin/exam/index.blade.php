@extends('admin.layout')
@section('content')
    

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">exams</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route("dashHome")}}">Home</a></li>
            <li class="breadcrumb-item active">exams</li>
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
        <div class="col-md-12">
          <section class="content">
            <div class="container-fluid">
                  @include('admin.inc.msg')
                  <div class="row">
                    <div class="col-12">
                      <div class="card">
                        <div class="card-header">
                          <h3 class="card-title">
                            <a href="{{route("exam.create")}}" class="badge text-bg-success"  >
                            <i class="fa-solid fa-pen-to-square">add exam</i>
                          </a></h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4"><div class="row"><div class="col-sm-12 col-md-6"></div><div class="col-sm-12 col-md-6"></div></div><div class="row"><div class="col-sm-12"><table id="example2" class="table table-bordered table-hover dataTable dtr-inline" aria-describedby="example2_info">
                            <thead>
                            <tr><th class="sorting sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">nums</th><th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">name en</th><th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">name ar</th><th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">img</th><th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending">skill name</th><th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">question number</th><th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending">active</th><th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending">action</th></tr>
                            </thead>
                            @foreach ($exams as $exam)
                                
                            <tbody>
                                
                                <tr class="odd">
                                <td>{{$loop->iteration}}</td>
                                <td>{{$exam->name("en")}}</td>
                                <td>{{$exam->name("ar")}}</td>
                                <td><img src="{{asset("uploads/$exam->img")}}" height="50px"></td>
                                <td>{{$exam->skill->name("en")}}</td>
                                <td>{{$exam->question_no}}</td>
                                
                                <td>
                                @if ($exam->active ==1)
                                    
                                    <span class="badge text-bg-success">active</span>
                                @else
                                    
                                <span class="badge text-bg-danger">non-active</span></td>
                                @endif
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
                                    <a href="{{route("exam.show",["exam"=>$exam->id])}}"   class="btn btn-sm btn-primary edit-btn" >
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{route("examQues.show",["id"=>$exam->id])}}"   class="btn btn-sm btn-success edit-btn" >
                                        <i class="fas fa-question"></i>
                                    </a>
                                    <a href="{{route("exam.edit",["exam"=>$exam->id])}}"   class="btn btn-sm btn-info edit-btn" >
                                        <i class="fas fa-edit"></i>
                                    </a>
                                  <form action="{{ route('exam.destroy', ['exam' => $exam->id]) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                </form>
                                  <form action="{{ route('exam.toggle', ['id' => $exam->id]) }}"  style="display:inline;">
                                    @csrf
                                    
                                    <button type="submit" class="btn btn-sm btn-secondary"><i class="fas fa-toggle-on"></i></button>
                                </form>
                                </td>
                                
                              </tr></tbody>
                              @endforeach
                              
                            </table>
                            <div class="d-flex justify-content-center">
                            {{$exams->links()}}
                        </div>
                        </div>
                        <!-- /.card-body -->
                      </div>
                      <!-- /.card -->
          
                     
                      <!-- /.card -->
                    </div>
                    <!-- /.col -->
                  </div>
                  <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
              </section>
        </div>
      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content -->
</div>
<!-- /add -->
{{-- <div class="modal fade" id="add-modal" aria-hidden="true" style="display: none;">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Large Modal</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        @include('admin.inc.erorr')
        <form  action="{{route("skill.store")}}" method="POST" enctype="multipart/form-data">
          @csrf
            <div class="form-group">
              <label>Name (ar)</label>
              <input type="text" class="form-control" name="name_ar">
            </div>
            <div class="form-group">
              <label >Name (en)</label>
              <input type="text" class="form-control" name="name_en">
            </div>
            <div class="form-group">
                <label> category</label>
                <select class="custom-select form-control" name="cat_id">
                    @foreach ($cats as $cat)
                    
                    <option  value="{{$cat->id}}">{{$cat->name("en")}}</option>
                    @endforeach
                </select>
              </div>
            <div class="form-group">
                <label >img</label>
                <div class="input-group">
                  <div class="custom-file">
                    <input type="file" class="custom-file-input" name="img">
                    <label class="custom-file-label" >Choose file</label>
                  </div>
                  
                </div>
              </div>
            
          
          <!-- /.card-body -->

        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit"  class="btn btn-primary">add</button>
        </div>
          
        </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div> --}}
<!-- /edit -->

</div>


@endsection