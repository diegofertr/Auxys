<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <li class="header">{{ trans('adminlte_lang::message.header') }}</li>
            <!-- Optionally, you can add icons to the links -->
            <li class="active"><a href="{{ url('home') }}"><i class='fa fa-link'></i> <span>{{ trans('adminlte_lang::message.home') }}</span></a></li>
            <li><a href="/convocatoria"><i class='fa fa-link'></i> <span>Convocatorias</span></a></li>
            <li><a href="/materias"><i class="fa fa-graduation-cap"></i> <span>Materias</span></a></li>
            <li><a href="/student"><i class='fa fa-link'></i> <span>Estudiantes</span></a></li>
            <li><a href="{{url('student/import')}}"><i class='glyphicon glyphicon-import '></i> <span>Importar estudiantes</span></a></li>
            {{-- <li class="treeview">
                <a href="#"><i class='fa fa-link'></i> <span>{{ trans('adminlte_lang::message.multilevel') }}</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="#">{{ trans('adminlte_lang::message.linklevel2') }}</a></li>
                    <li><a href="#">{{ trans('adminlte_lang::message.linklevel2') }}</a></li>
                </ul>
            </li> --}}
        </ul><!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>
