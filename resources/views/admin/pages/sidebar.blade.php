<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      <img src="{{ asset('adminlte/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">{{ config('app.name') }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('adminlte/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ auth()->user()->name }}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          
          <li class="nav-item">
            <a href="{{ route('dashboard') }}" class="nav-link">
              <i class="nav-icon fas fa-home"></i>
              <p>Inicio</p>
            </a>
          </li>
          @canany(['admin.posts.index','admin.posts.create','admin.posts.edit','admin.posts.destroy'])
          <li class="nav-item">
            <a href="{{ route('admin.posts.index') }}" class="nav-link">
              <i class="nav-icon fas fa-file"></i>
              <p>Articulos</p>
            </a>
          </li>
          @endcan
          @canany(['admin.categories.index','admin.categories.create','admin.categories.edit','admin.categories.destroy'])
          <li class="nav-item">
            <a href="{{ route('admin.categories.index') }}" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>Categorias</p>
            </a>
          </li>
          @endcan
          @canany(['admin.tags.index','admin.tags.create','admin.tags.edit','admin.tags.destroy'])
          <li class="nav-item">
            <a href="{{ route('admin.tags.index') }}" class="nav-link">
              <i class="nav-icon fas fa-tags"></i>
              <p>Etiquetas</p>
            </a>
          </li>
          @endcan
          @role('Super_Admin')
          <li class="nav-item has-treeview {{ request()->is(['admin/users*','admin/roles*']) ? 'menu-open' : '' }}">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-edit"></i>
              <p>
                Administración
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">

              <li class="nav-item">
                <a href="{{ route('admin.users.index') }}" class="nav-link">
                  <i class="nav-icon fas fa-users"></i>
                  <p>Usuarios</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('admin.roles.index') }}" class="nav-link">
                  <i class="far fa-registered"></i>
                  <p>Roles</p>
                </a>
              </li>
            </ul>
          </li>
          @endrole
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>