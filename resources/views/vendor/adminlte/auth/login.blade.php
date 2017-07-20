@extends('adminlte::layouts.auth')

    <style>
        body{
         background-color: #2B2B2B;   
        }

        *{
            font-family: 'Raleway', sans-serif;
            color : #FFF;
            
        }

        div h3 span{
             color : #FFF;
             font-size:14px;
        }

        div span {
             font-weight: 200;
        }

        h1{
             font-weight: 200;
        }

        .login_box{
            background: #367fa9; /* Old browsers */
            /* IE9 SVG, needs conditional override of 'filter' to 'none' */
            background: -moz-linear-gradient(45deg,  #367fa9 5%, #2b6688 99%); /* FF3.6+ */
            background: -webkit-gradient(linear, left bottom, right top, color-stop(5%,#367fa9), color-stop(99%,#2b6688)); /* Chrome,Safari4+ */
            background: -webkit-linear-gradient(45deg,  #367fa9 5%,#2b6688 99%); /* Chrome10+,Safari5.1+ */
            background: -o-linear-gradient(45deg,  #367fa9 5%,#2b6688 99%); /* Opera 11.10+ */
            background: -ms-linear-gradient(45deg,  #367fa9 5%,#2b6688 99%); /* IE10+ */
            background: linear-gradient(45deg,  #367fa9 5%,#2b6688 99%); /* W3C */
            filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#367fa9', endColorstr='#2b6688',GradientType=1 ); /* IE6-8 fallback on horizontal gradient */
            
            width:35%;
           /* height:70%; */
            position:absolute;
            top:15%;
            left:32.5%;
            
            -webkit-box-shadow: 0px 0px 8px 0px rgba(50, 50, 50, 0.54);
        -moz-box-shadow:    0px 0px 8px 0px rgba(50, 50, 50, 0.54);
        box-shadow:         0px 0px 8px 0px rgba(50, 50, 50, 0.54);
        }

        @media (max-width: 767px) {
            .login_box{
                background: #367fa9; /* Old browsers */
                background: -moz-linear-gradient(45deg,  #367fa9 5%, #2b6688 99%); /* FF3.6+ */
                background: -webkit-gradient(linear, left bottom, right top, color-stop(5%,#367fa9), color-stop(99%,#2b6688)); /* Chrome,Safari4+ */
                background: -webkit-linear-gradient(45deg,  #367fa9 5%,#2b6688 99%); /* Chrome10+,Safari5.1+ */
                background: -o-linear-gradient(45deg,  #367fa9 5%,#2b6688 99%); /* Opera 11.10+ */
                background: -ms-linear-gradient(45deg,  #367fa9 5%,#2b6688 99%); /* IE10+ */
                background: linear-gradient(45deg,  #367fa9 5%,#2b6688 99%); /* W3C */
                filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#367fa9', endColorstr='#2b6688',GradientType=1 ); /* IE6-8 fallback on horizontal gradient */
                
                width:90%;
                height:80%;
                position:absolute;
                top:10%;
                left:5%;
                
                -webkit-box-shadow: 0px 0px 8px 0px rgba(50, 50, 50, 0.54);
        -moz-box-shadow:    0px 0px 8px 0px rgba(50, 50, 50, 0.54);
        box-shadow:         0px 0px 8px 0px rgba(50, 50, 50, 0.54);
            }
        }

        .img-circle{
            border-radius: 50%;
            width: 175px;
            height: 175px;
            border: 4px solid #FFF;
            margin: 10px;
        }

        .login_control{
            background-color:#FFF;
            padding:10px;
            
        }

        .control {
            color:#000;
            margin:10px;
        }

        .label {
            color: #EB4F26;
            font-size: 18px;
            font-weight: 500;
        }

        .form-control{
            color: #000000 !important;
            font-size: 25px;
            border: none;
            padding: 25px;
            padding-left: 10px;
            border-bottom: 1px solid #CCC;
            margin-bottom: 10px;
            outline: none;
            -webkit-box-shadow: none !important;
            -moz-box-shadow: none !important;
            box-shadow: none !important;
        }

        .form-control:focus{
            border-radius: 0px;
            border-bottom: 1px solid #FC563B;
            margin-bottom: 10px;
            outline: none;
            -webkit-box-shadow: none !important;
            -moz-box-shadow: none !important;
            box-shadow: none !important;
        }
        .btn-orange{
            background-color: #367fa9;
            border-radius: 0px;
            margin: 5px;
            padding: 5px;
            width: 150px;
            font-size: 20px;
            font-weight: inherit;
        }

        .btn-orange:hover {
            background-color: #F22F26;
            border-radius: 0px;
            margin: 5px;
            padding: 5px;
            width: 150px;
            font-size: 20px;
            font-weight: inherit;
            color:#FFF !important;
        }

        .line{
            border-bottom : 2px solid #367fa9;
        }
    </style>
@section('htmlheader_title')
    Log in
@endsection
@section('content')
    <body class="hold-transition login-page">
    <div id="app" v-cloak>
        <div class="container">
            <div class="row login_box">
                <div class="col-md-12 col-xs-12" align="center">
                    <div class="line"><h3>UMSA</h3></div>
                    <div class="wrapper"></div>   
                    <h1>AuXys</h1>
                    <span>Sistema de Convocatoria de Auxiliares</span>
                </div>

                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <strong>Whoops!</strong> {{ trans('adminlte_lang::message.someproblems') }}<br><br>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                
                <div class="col-md-12 col-xs-12 login_control">
                    <form action="{{ url('/login') }}" method="post">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="control">
                            <div class="label">Email Address</div>
                            <input type="text" class="form-control" placeholder="{{ trans('adminlte_lang::message.username') }}" name="username"/>
                        </div>
                        <div class="control">
                            <input type="password" class="form-control" placeholder="{{ trans('adminlte_lang::message.password') }}" name="password"/>
                            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                        </div>
                        <div class="text-center">
                             {{-- <button class="btn btn-orange">LOGIN</button> --}}
                             <button type="submit" class="btn btn-orange">LOGIN</button>
                        </div>
                    </form>
                </div>
                
                
                    
            </div>
        </div>
    </div>
    @include('adminlte::layouts.partials.scripts_auth')

    
    </body>

@endsection