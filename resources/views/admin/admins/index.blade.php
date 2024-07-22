@extends('admin.layout')
@section('content')
    

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Student</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="">Home</a></li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <section class="content">
              @include('admin.inc.msg')
                <div class="container-fluid">
                  <div class="row">
                    <div class="col-12">
                      <div class="card">
                        <div class="card-header">
                          @if (Auth::user()->role->name == "superadmin")
                              
                          <h3 class="card-title">
                              <a href="{{route("admin.create")}}" class="badge text-bg-success" >
                                  <i class="fa-solid fa-pen-to-square">add cat</i>
                                </a></h3>
                                @endif
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4"><div class="row"><div class="col-sm-12 col-md-6"></div><div class="col-sm-12 col-md-6"></div></div><div class="row"><div class="col-sm-12"><table id="example2" class="table table-bordered table-hover dataTable dtr-inline" aria-describedby="example2_info">
                              <thead>
                              <tr><th class="sorting sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">nums</th><th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">name</th><th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">email</th><th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending">active</th><th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">action</th></tr>
                              </thead>
                              @foreach ($admins as $admin)
                                  
                              <tbody>
                                  
                                  <tr class="odd">
                                  <td>{{$loop->iteration}}</td>
                                <td>{{$admin->name}}</td>
                                <td>{{$admin->email}}</td>
                                <td>{{$admin->role->name}}</td>
                                @if ($admin->role->name == "admin")
                                    
                                <td>
                                    <a href="{{route("adminPromote",["id"=>$admin->id])}}"   class="btn btn-sm btn-primary" >
                                        <i class="fa fa-arrow-up"></i>
                                    </a>
                                    </td>
                                    
                                    @else
                                    <td>
                                        <a href="{{route("adminDemote",["id"=>$admin->id])}}"   class="btn btn-sm btn-primary" >
                                            <i class="fa fa-arrow-down"></i>
                                        </a>
                                        </td>
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
                                          @include('admin.inc.erorr')

                                          <form  action="{{route("cat.update",["cat"=>$cat->id])}}" id="edit-form" method="POST">
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
                                  </div> --}}
                                    {{-- <button type="button" class="btn btn-sm btn-info edit-btn" data-toggle="modal" data-target="#edit-modal" data-id="{{$cat->id}}" data-name-ar="{{$cat->name("ar")}}" data-name-en="{{$cat->name("en")}}">
                                      <i class="fas fa-edit"></i>
                                          </button > --}}
                                          <a href="{{route("admin.show",["admin"=>$admin->id])}}"   class="btn btn-sm btn-primary edit-btn" >
                                            <i class="fas fa-eye"></i>
                                        </a>
                                  {{-- <form action="{{ route('cat.toggle', ['id' => $cat->id]) }}"  style="display:inline;">
                                    @csrf
                                    
                                    <button type="submit" class="btn btn-sm btn-secondary">
                                      <i class="fas fa-toggle-on"></i>

                                    </button>
                                </form> --}}
                                </td>
                                
                              </tr></tbody>
                              @endforeach
                              
                            </table>
                            <div class="d-flex justify-content-center">
                            {{$admins->links()}}
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