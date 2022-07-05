<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body id="body-pd">
    <header class="header" id="header">
        <title>{{ config('app.name', 'RMG') }}</title>
        <div class="header_toggle">
            <i class='bx bx-menu' id="header-toggle"></i>
        </div>
        <div class="header_img">
            {{-- <img src="https://i.imgur.com/hczKIze.jpg" alt=""> --}}
        </div>
        {{-- CSS --}}

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css">
        <!-- CSS only -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
        <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.10.1/bootstrap-table.min.css">
        <link href="https://unpkg.com/bootstrap-table@1.20.0/dist/bootstrap-table.min.css" rel="stylesheet">

        {{-- JQuery --}}
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="//code.jquery.com/jquery.js"></script>
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>

        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/"
        crossorigin="anonymous">


        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS"
            crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.2.1/css/flag-icon.min.css">
        
        
        {{-- JavaScript --}}
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
        <script src="{{ asset('js/sidebar.js') }}"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.10.1/bootstrap-table.min.js"></script>
        <script src="https://unpkg.com/tableexport.jquery.plugin/tableExport.min.js"></script>
        <script src="https://unpkg.com/bootstrap-table@1.20.0/dist/bootstrap-table.min.js"></script>
        <script src="https://unpkg.com/bootstrap-table@1.20.0/dist/extensions/export/bootstrap-table-export.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
        <script
                src="https://unpkg.com/bootstrap-table@1.16.0/dist/extensions/filter-control/bootstrap-table-filter-control.min.js">
        </script>
        <script src="https://unpkg.com/multiple-select@1.5.2/dist/multiple-select.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>

        <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    




        <div>
            {{-- <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                    {{ app()->getLocale() == 'de'? 'de':'English' }}
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                  <li><a class="dropdown-item" href="{{ url(app()->getLocale() == 'de'? 'en':'de' ) }}"> {{ app()->getLocale() == 'de'? 'English':'Deutsche' }}</a></li>
                </ul>
              </div> --}}


            {{-- <div class="container">
                <div class="row">
                    <div class="col-md-12 bg-light text-right">

                        <a href="{{ route(Route::currentRouteName(), 'en') }}" class="nav-link">EN</a>

                        <a href="{{ route(Route::currentRouteName(), 'de') }}" class="nav-link">DE</a>

                        <hr />
                    </div>
                </div>
            </div>
            <div class="float-container"> --}}
               
                

                <div class="nav-item dropdown">
                    
                    <a class="nav-link dropdown-toggle" href="#" id="dropdown09" data-toggle="dropdown" aria-expanded="false">
                        <span class="flag-icon flag-icon-us"> </span>
                        English
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="{{ route(Route::currentRouteName(), 'en') }}"><span class="flag-icon flag-icon-us"> </span> English</a>
                        <a class="dropdown-item" href="{{ route(Route::currentRouteName(), 'de') }}"><span class="flag-icon flag-icon-de"> </span> Deutsch</a>
                        {{-- <a class="dropdown-item" href="#ru"><span class="flag-icon flag-icon-ru"> </span> Russian</a> --}}
                    </div>
                </div>

                {{-- <div class="float-child">
                    <div class="green"> <a href="{{ route(Route::currentRouteName(), 'en') }}"
                            class="nav-link">EN</a></div>
                </div>

                <div class="float-child">
                    <div class="blue"><a href="{{ route(Route::currentRouteName(), 'de') }}"
                            class="nav-link">DE</a></div>
                </div> --}}

            



        </div>
        
    </header>
    <div class="l-navbar" id="nav-bar">
        <br/>
        <nav class="nav">
            <div>
                <a href="#" class="nav_logo">
                    <i class='bx bx-layer nav_logo-icon'></i>
                    <span class="nav_logo-name">RMG Application</span>
                </a>
                <div class="nav_list">
                    <a href="/manager_dashboard" class="nav_link active">
                        <i class='bx bx-grid-alt nav_icon'></i>
                        <span class="nav_name">Dashboard</span>
                    </a>
                    {{-- <a href="#" class="nav_link">
                        <i class='bx bx-user nav_icon'></i>
                        <span class="nav_name">Accounts</span>
                    </a> --}}
                </div>
            </div>
            <a href="{{ route('logout') }}" class="nav_link" onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">
                <i class='bx bx-log-out nav_icon'></i>
                <span class="nav_name">
                    Logout
                </span>


            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </nav>
    </div>
    <!--Container Main start-->
    <div class="height-100 bg-light">
        @yield('content')
    </div>
    <!--Container Main end-->
</body>

</html> 
