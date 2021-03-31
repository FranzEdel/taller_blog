@extends('admin.layout')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Todas las publicaciones</h1>
                </div>
                <!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.posts.create') }}" class="btn btn-sm btn-success pull-right">
                                <i class="fa fa-plus"></i> Nuevo Articulo
                            </a>
                        </li>
                    </ol>
                    
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-primary card-outline table-responsive">
                        <div class="card-body">
                            <table id="tblistado" class="table table-bordered table-hover">
                              <thead>
                              <tr>
                                <th>ID</th>
                                <th>Categoria</th>
                                <th>Título</th>
                                <th>Estracto</th>
                                <th>Acciones</th>
                              </tr>
                              </thead>
                            </table>
                          </div>
                          <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col-md-6 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection

@push('styles')
    <link rel="stylesheet" href=" {{ asset('/adminlte/datatables/buttons.dataTables.min.css') }}">
    <link rel="stylesheet" href=" {{ asset('/adminlte/datatables/jquery.dataTables.min.css') }}">
    <link rel="stylesheet" href=" {{ asset('/adminlte/datatables/responsive.dataTables.min.css') }}">
@endpush

@push('scripts')
    <script src="{{ asset('/adminlte/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('/adminlte/datatables/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('/adminlte/datatables/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('/adminlte/datatables/buttons.colVis.min.js') }}"></script>
    <script src="{{ asset('/adminlte/datatables/jszip.min.js') }}"></script>
    <script src="{{ asset('/adminlte/datatables/pdfmake.min.js') }}"></script>
    <script src="{{ asset('/adminlte/datatables/vfs_fonts.js') }}"></script>
    <script>
        $(function () {
            $('#tblistado').dataTable({
                "aProcessing": true, //activa el dataTable
                "aServerSide": true, // Paginacion y filtrado
                dom: "Bfrtip", // Elementos de control
                buttons: [
                    'copyHtml5',
                    'excelHtml5',
                    'csvHtml5',
                    'pdf'
                ],
                "bDestroy": true,
                "iDisplayLength": 5, //Paginacion
                "order": [
                    [0, "desc"]
                ],
                language: {
                    search: "Buscar:"
                },
                "ajax": '{{ route("admin.posts.list") }}',
                "columns": [
                    {data: 'id'},
                    {data: 'category'},
                    {data: 'name'},
                    {data: 'excerpt'},
                    {data: 'actions'},
                ],
            })
        });
    </script>
@endpush