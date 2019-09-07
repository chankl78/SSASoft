<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <title>SSA Student Division</title>

        <link href="{{{ asset('assets/css/bootstrap.min.css') }}}" rel="stylesheet" />
        <link href="{{{ asset('assets/css/font-awesome.min.css') }}}" rel="stylesheet" />
        <link href="https://cdn.datatables.net/responsive/2.1.1/css/responsive.dataTables.min.css" rel="stylesheet" />
        <link href="https://cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css" rel="stylesheet" />
        <link href="https://cdn.datatables.net/buttons/1.2.4/css/buttons.dataTables.min.css" rel="stylesheet" />
		
        <style>
            body {
                /* Pad space for the navbar-fixed-top */
                padding-top: 60px;
            }
        </style>
    </head>
    <body>
        <nav class="navbar navbar-inverse navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">SSA Student Division</a>
                </div>
                <div id="navbar" class="collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="/StudentDivision">Home</a>
                    </li>
                    <li>
                        <a href="/StudentDivision/members">Members</a>
                    </li>
                    <li>
                        <a href="/StudentDivision/kenshu">Kenshu</a>
                    </li>
                    <li>
                        <a href="/StudentDivision/statistics">Statistics</a>
                    </li>
                </ul>
                </div>
            </div>
        </nav>
        <div class="container">
            @yield('content')
        </div>
        <script src="{{{ asset('assets/js/jquery.min.js') }}}"></script>
        <script src="{{{ asset('assets/js/bootstrap.min.js') }}}"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/1.10.13/js/dataTables.bootstrap.min.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.1.1/js/dataTables.responsive.min.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.2.4/js/dataTables.buttons.min.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.flash.min.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.html5.min.js"></script>
        @yield('js')
    </body>
</html>