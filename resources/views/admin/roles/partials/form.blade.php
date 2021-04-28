<div class="row">
    <div class="col-md-12">
        <div class="card card-primary">
            <div class="card-body">
                <div class="form-group">
                    {{ Form::label('name', 'Nombre para el Rol del sistema')  }}
                    {{ Form::text('name', null, ['class' => 'form-control']) }}
                    {{ Form::hidden('guard_name', 'web')  }}
                </div>
                <div class="form-group">
                    {{ Form::label('role', 'Lista de todos los Permisos del sistema')  }}
                    <ul class="list-unstyled">
                    {{ csrf_field() }}
                        @foreach ($permissions as $id => $name)
                            <li style="display: block; width:20%; float: left;">
                                <label>
                                    {{ Form::checkbox('permissions[]', $id, null) }}
                                    {{ $name }}
                                </label>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Guardar</button>
                    <a href="{{ route('admin.roles.index') }}" class="btn btn-danger"><i class="fa fa-arrow-circle-left"></i> Cancelar</a>
                </div>

            </div>
        </div>
    </div>
</div>