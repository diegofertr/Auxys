<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <li class="header">{{ trans('adminlte_lang::message.header') }}</li>
            <!-- Optionally, you can add icons to the links -->

            <li class="active"><a href="{{ url('home') }}"><i class='fa fa-home'></i> <span>{{ trans('adminlte_lang::message.home') }}</span></a></li>
            <li><a href="/convocatoria"><i class='fa fa-file-text-o'></i> <span>Convocatorias</span></a></li>
            <li><a href="/materias"><i class='fa fa-book'></i> <span>Materias</span></a></li>
            <li><a href="/student"><i class='fa fa-graduation-cap'></i> <span>Estudiantes</span></a></li>
            <li><a href="/postulants"><i class="fa fa-users"></i> <span>Postulantes</span></a></li>
        </ul><!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>
