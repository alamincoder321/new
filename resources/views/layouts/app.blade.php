<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
        <meta name="author" content="Coderthemes">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        @php
            $settings = App\Models\Setting::latest()->limit(1)->get(); 
        @endphp
        @foreach($settings as $setting)
        <link rel="shortcut icon" href="{{asset($setting->logo)}}">
        <title>{{ $setting->title }}</title>
        @endforeach
      @include('layouts.backend.style')
        
    </head>



    <body class="fixed-left">
        
        <!-- Begin page -->
        <div id="wrapper">
        
        @include('layouts.backend.navbar')
        @include('layouts.backend.sidebar')

            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->                      
            <div class="content-page">
                <!-- Start content -->
                <div class="content">
                    <div class="container">

                        @yield('content')

                    </div> <!-- container -->
                               
                </div> <!-- content -->



            </div>
            <!-- ============================================================== -->
            <!-- End Right content here -->
            <!-- ============================================================== -->
        </div>
        <!-- END wrapper -->
        @include('layouts.backend.script')

    </body>
</html>