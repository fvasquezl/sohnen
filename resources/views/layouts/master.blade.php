<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @stack('styles')
    <style>
        a {
            color: #337ab7;
            text-decoration: none;
        }
        i{
            margin-bottom:4px;
        }

        .btn {
            display: inline-block;
            font-size: 14px;
            font-weight: 400;
            line-height: 1.42857143;
            text-align: center;
            white-space: nowrap;
            vertical-align: middle;
            cursor: pointer;
            user-select: none;
            background-image: none;
            border: 1px solid transparent;
            border-radius: 4px;
        }


        .btn-app {
            color: white;
            box-shadow: none;
            border-radius: 3px;
            position: relative;
            padding: 10px 15px;
            margin: 0;
            min-width: 60px;
            max-width: 80px;
            text-align: center;
            border: 1px solid #ddd;
            background-color: #f4f4f4;
            font-size: 12px;
            transition: all .2s;
            background-color: steelblue !important;
        }

        .btn-app > .fa, .btn-app > .glyphicon, .btn-app > .ion {
            font-size: 30px;
            display: block;
        }

        .btn-app:hover {
            border-color: #aaa;
            transform: scale(1.1);
        }

        button.dt-button, div.dt-button, a.dt-button {
            background-image:none;
            color:white;
        }

        .pdf {
            background-color: #dc2f2f !important;
        }

        .excel{
            background-color: #3ca23c !important;
        }

        .csv {
            background-color: #e86c3a !important;
        }

        .imprimir {
            background-color: #8766b1 !important;
        }

        /*
        Esto es opcional pero sirve para que todos los botones de exportacion se distribuyan de manera equitativa usando flexbox

        .flexcontent {
            display: flex;
            justify-content: space-around;
        }
        */

        .selectTable{
            height:40px;
            float:right;

        }

        div.dataTables_wrapper div.dataTables_filter {
            text-align: left;
            margin-top: 15px;
        }

        .btn-secondary {
            color: #fff;
            background-color: #4682b4;
            border-color: #4682b4;
        }
        .btn-secondary:hover {
            color: #fff;
            background-color: #315f86;
            border-color: #545b62;
        }



        .titulo-tabla{
            color:#606263;
            text-align:center;
            margin-top:15px;
            margin-bottom:15px;
            font-weight:bold;
        }






        .inline{
            display:inline-block;
            padding:0;
        }



        button.dt-button:hover:not(.disabled), div.dt-button:hover:not(.disabled), a.dt-button:hover:not(.disabled) {

            background-color: no;
            background-image: none;
            filter: none;
        }

        button.dt-button, div.dt-button, a.dt-button {
            background-color:steelblue;
            border:none;
        }

        button.dt-button:hover:not(.disabled), div.dt-button:hover:not(.disabled), a.dt-button:hover:not(.disabled) {

            background-color: steelblue;
        }

        div.dt-button-collection {
            padding:0;
            background-color:steelblue;
        }


        button.dt-button:active:not(.disabled), button.dt-button.active:not(.disabled), div.dt-button:active:not(.disabled), div.dt-button.active:not(.disabled), a.dt-button:active:not(.disabled), a.dt-button.active:not(.disabled) {
            background-color:steelblue;
            background-image:none;
        }




        div.dt-button-collection button.dt-button, div.dt-button-collection div.dt-button, div.dt-button-collection a.dt-button {
            margin-bottom:0;
            border:none;
        }

        div.dt-button-collection button.dt-button:active:not(.disabled), div.dt-button-collection button.dt-button.active:not(.disabled), div.dt-button-collection div.dt-button:active:not(.disabled), div.dt-button-collection div.dt-button.active:not(.disabled), div.dt-button-collection a.dt-button:active:not(.disabled), div.dt-button-collection a.dt-button.active:not(.disabled) {
            background-image:none;
            background-color: rgba(0,0,0,0.3)

        }


        div.dt-button-collection button.dt-button:active:not(.disabled), div.dt-button-collection button.dt-button.active:not(.disabled), div.dt-button-collection div.dt-button:active:not(.disabled), div.dt-button-collection div.dt-button.active:not(.disabled), div.dt-button-collection a.dt-button:active:not(.disabled), div.dt-button-collection a.dt-button.active:not(.disabled) {
            border:none;

        }


        button.dt-button:hover:not(.disabled), div.dt-button:hover:not(.disabled), a.dt-button:hover:not(.disabled) {
            border:none;
            background-color: #3b72a0;
        }





        button.dt-button:active:not(.disabled):hover:not(.disabled), button.dt-button.active:not(.disabled):hover:not(.disabled), div.dt-button:active:not(.disabled):hover:not(.disabled), div.dt-button.active:not(.disabled):hover:not(.disabled), a.dt-button:active:not(.disabled):hover:not(.disabled), a.dt-button.active:not(.disabled):hover:not(.disabled) {
            box-shadow: none;
            background-color: rgba(0,0,0,0.3);
            background-image: none;
            filter: none;
        }

        button.dt-button:focus:not(.disabled), div.dt-button:focus:not(.disabled), a.dt-button:focus:not(.disabled) {
            border: 1px solid #426c9e;
            text-shadow: 0 1px 0 #c4def1;
            outline: none;
            background-color: steelblue;
            background-image: none;
            filter:none;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.current, .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
            color: white !important;
            border: 1px solid #979797;
            background: none;
            background-color: steelblue;

        }














        .dataTables_wrapper .dataTables_paginate .paginate_button:active {
            outline: none;
            background: none;
            background-color: #2e5475;
            box-shadow: inset 0 0 3px #111;
        }





        .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            color: white !important;
            border: 1px solid #111;
            background: none;
            background-color: #2e5475;

        }
    </style>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper" id="app">

    <!-- Navbar -->
    @include('layouts.partials.navbar')
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    @include('layouts.partials.sidebar')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    @yield('content')
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Main Footer -->
    @include('layouts.partials.footer')
</div>
<!-- ./wrapper -->

<script src="{{ asset('js/app.js') }}"></script>
@stack('scripts')
</body>
</html>
