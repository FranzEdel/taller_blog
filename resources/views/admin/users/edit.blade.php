@extends('admin.layout')

@section('content')
<!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Actualizar Datos del Usuario</h1>
                </div>
                <!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Inicio</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.users.index') }}">Posts</a></li>
                        <li class="breadcrumb-item active">Editar</li>
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
        	<form action="{{ route('admin.users.update',$user->id) }}" method="POST">
        		{{  @csrf_field() }}
				@method('PUT')
	            <div class="row">
	            	
	                <div class="col-md-7">
	                    <div class="card card-primary card-outline table-responsive">
	                    	<div class="card-body">
								
								<div class="form-group">
                    				<label>Nombre</label>
									<input type="text" class="form-control basic-usage {{ $errors->has('name') ? 'is-invalid' : ''}}" name="name" id="name" value="{{ old('name', $user->name) }}" placeholder="Nombre de usuario">
									{!! $errors->first('name', '<small class="text-danger">:message</small>') !!}
									 
                    			</div>

                                <div class="form-group">
                    				<label>Email</label>
									<input type="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : ''}}" name="email" id="email" value="{{ old('email', $user->email) }}" placeholder="Correo del usuario">
									{!! $errors->first('email', '<small class="text-danger">:message</small>') !!}
									 
                    			</div>

                                <div class="form-group">
                    				<label for="password">Password</label>
									{{-- <input type="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : ''}}" name="password" id="password" placeholder="Password"> --}}
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="new-password">

									{!! $errors->first('password', '<small class="text-danger">:message</small>') !!}
									 
                    			</div>

                                <div class="form-group">
                    				<label for="password-confirm">Confirme su Password</label>
                                    <input id="password-confirm" type="password" class="form-control {{ $errors->has('password-confirm') ? 'is-invalid' : ''}}" name="password_confirmation" autocomplete="new-password">

									{!! $errors->first('password-confirm', '<small class="text-danger">:message</small>') !!}
									 
                    			</div>


								<div class="form-group">
									<label>Roles</label>

                                    <ul>
                                        @foreach($roles as $id => $name)
                                        <li>
                                            <label>
                                                <input type="checkbox" name="roles[]" value="{{ $name }}" 
                                                {{ $user->roles->contains($id) ? 'checked' : '' }}>
                                                {{ $name }}
                                            </label>
                                        </li>
                                        @endforeach
                                    </ul>
								
									{!! $errors->first('roles', '<small class="text-danger">:message</small>') !!}
							   	</div>

                                <div class="form-group">
	                				<button type="submit" class="btn btn-primary btn-block">Actualizar Datos</button>
	                			</div>



							</div>
	                    </div>
	                </div>
	               
	            </div>
	            <!-- /.row -->
        	</form>
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection



