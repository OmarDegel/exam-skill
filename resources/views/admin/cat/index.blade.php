@extends('admin.layout')
@section('content')
    

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">category</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route("dashHome")}}">Home</a></li>
            <li class="breadcrumb-item active">Starter Page</li>
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
              @include('admin.inc.msg')
                <div class="container-fluid">
                  <div class="row">
                    <div class="col-12">
                      <div class="card">
                        <div class="card-header">
                          <h3 class="card-title">
                            <button type="button" class="badge text-bg-success" data-toggle="modal" data-target="#add-modal" >
                            <i class="fa-solid fa-pen-to-square">add cat</i>
                          </a></h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4"><div class="row"><div class="col-sm-12 col-md-6"></div><div class="col-sm-12 col-md-6"></div></div><div class="row"><div class="col-sm-12"><table id="example2" class="table table-bordered table-hover dataTable dtr-inline" aria-describedby="example2_info">
                              <thead>
                              <tr><th class="sorting sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">nums</th><th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">name</th><th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending">active</th><th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">action</th></tr>
                              </thead>
                              @foreach ($cats as $cat)
                                  
                              <tbody>
                                  
                                  <tr class="odd">
                                  <td>{{$loop->iteration}}</td>
                                {{-- <td>{{$cat->name("en")}}</td> --}}
                                {{-- <td>{{$cat->name("ar")}}</td> --}}
                                <td>{{$cat->name()}}</td>
                                
                                <td>
                                  @if ($cat->active ==1)
                                    
                                    <span class="badge text-bg-success">active</span>
                                @else
                                    
                                <span class="badge text-bg-danger">non-active</span></td>
                                @endif
                                <td>

                                  
                                  <div class="modal fade" id="edit-modal" aria-hidden="true" style="display: none;">
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
                                  </div>
                                    <button type="button" class="btn btn-sm btn-info edit-btn" data-toggle="modal" data-target="#edit-modal" data-id="{{$cat->id}}" data-name-ar="{{$cat->name("ar")}}" data-name-en="{{$cat->name("en")}}">
                                      <i class="fas fa-edit"></i>
                                          </button >
                                  <form action="{{ route('cat.destroy', ['cat' => $cat->id]) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                </form>
                                  <form action="{{ route('cat.toggle', ['id' => $cat->id]) }}"  style="display:inline;">
                                    @csrf
                                    
                                    <button type="submit" class="btn btn-sm btn-secondary">
                                      <i class="fas fa-toggle-on"></i>

                                    </button>
                                </form>
                                </td>
                                
                              </tr></tbody>
                              @endforeach
                              
                            </table>
                            <div class="d-flex justify-content-center">
                            {{$cats->links()}}
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
<div class="modal fade" id="add-modal" aria-hidden="true" style="display: none;">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Add Category</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        @include('admin.inc.erorr')

        <form  action="{{route("cat.store")}}" method="POST">
          @csrf
            <div class="form-group">
              <label>Name (en)</label>
              <input type="text" class="form-control" name="name_en">
            </div>
            <div class="form-group">
              <label >Name (ar)</label>
              <input type="text" class="form-control" name="name_ar">
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
</div>
<!-- /edit -->

</div>
@section('js.admin')
    <script>
      $('.edit-btn').click(function() {
        let id = $(this).attr('data-id');
        let nameEn = $(this).attr('data-name-en');
        let nameAr = $(this).attr('data-name-ar');
        $('#edit-form-id').val(id)
        $('#edit-form-name-en').val(nameEn)
        $('#edit-form-name-ar').val(nameAr)
    })
    </script>
@endsection















  @endsection