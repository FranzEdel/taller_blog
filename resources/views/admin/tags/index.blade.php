@extends('admin.layout')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Todas las Etiquetas</h1>
                </div>
                <!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.tags.create') }}" class="btn btn-sm btn-success pull-right">
                                <i class="fa fa-plus"></i> Nueva Etiqueta
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
                                <th>Nombre</th>
                                <th>Slug</th>
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
    {{-- <link rel="stylesheet" href=" {{ asset('/adminlte/datatables/dataTables.bootstrap4.min.css') }}"> --}}
    <link rel="stylesheet" href=" {{ asset('/adminlte/datatables/responsive.bootstrap4.min.css') }}">
@endpush

@push('scripts')
    <script src="{{ asset('/adminlte/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('/adminlte/datatables/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('/adminlte/datatables/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('/adminlte/datatables/buttons.colVis.min.js') }}"></script>
    <script src="{{ asset('/adminlte/datatables/jszip.min.js') }}"></script>
    <script src="{{ asset('/adminlte/datatables/pdfmake.min.js') }}"></script>
    <script src="{{ asset('/adminlte/datatables/vfs_fonts.js') }}"></script>

    <script src="{{ asset('/adminlte/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('/adminlte/datatables/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('/adminlte/datatables/responsive.bootstrap4.min.js') }}"></script>
    
    <script>
        $(function () {
            $('#tblistado').dataTable({
                responsive: true,
                autoWidth: false,
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
                    search: "Buscar:",
                    "info": "Mostrando la pagina _PAGE_ de _PAGES_ ",
                    "loadingRecords": "Cargando...",
                                    "paginate": {
                        "first":      "Primero",
                        "last":       "Ultimo",
                        "next":       "Siguiente",
                        "previous":   "Anterior"
                    },
                },
                "ajax": '{{ route("admin.tags.list") }}',
                "columns": [
                    {data: 'id'},
                    {data: 'name'},
                    {data: 'slug'},
                    {data: 'actions'},
                ],
            })
        });
    </script>

    @if (Session::has('success'))
    <script>
        Swal.fire({
            position: 'center',
            icon: 'success',
            title: 'Correcto!',
            text: '{{ Session::get('success') }}',
            showConfirmButton: false,
            timer: 3000
        })
    </script>
    @endif

    <script>
        function eliminar(id)
        {
            //alert(id);
            var token = '{{ csrf_token() }}';
            var url = '{{ route("admin.tags.destroy", ":id") }}';
            url = url.replace(':id', id);

            Swal.fire({
                title: '¿Esta seguro?',
                text: "La Etiqueta se eliminar definitivamente!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, Eliminar!',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    
                    var data = {
                        '_token':token,
                        'id':id,
                    };
                    $.ajax({
                        type:'DELETE',
                        url:url,
                        data:data,
                        success: function(response){
                            Swal.fire(
                                'Eliminado!',
                                response.status,
                                'success'
                            )
                            .then((result) => {
                                $('#tblistado').DataTable().ajax.reload();
                            });
                        }
                    });
                    
                }
            })
        }
    </script>

@endpush