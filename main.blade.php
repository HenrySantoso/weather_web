<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!-- CSS for Datatables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.7/css/dataTables.dataTables.css">
    <!-- CSS for icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <title>Weather Forecast - @yield('title')</title>
    <style>
        body {
            background-color: #0B131E; /* Grey background color */
            margin: 0;
            padding: 0;
        }
        .header {
            background-color: #202C3C; /* Change this to your desired header color */
        }
        .footer {
            background-color: #202C3C;
            position: absolute;
            bottom: 0;
            width: 100%;
        }
        .container-fluid {
            height: 100vh;
            display: flex;
            flex-direction: column;
        }
        .content {
            flex: 1;
            padding: 20px;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <!--header-->
        <div class="row">
            <div class="header col-lg-12 py-2">
                <div class="dropdown float-right">
                    <button class="btn btn-dark dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="bi bi-person-fill"></i> User
                    </button>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                      <a class="dropdown-item" href="#"><i class="bi bi-person-fill"></i> {{ Auth::user()->name ?? "" }}</a>
                      <a class="dropdown-item" href="/user"><i class="bi bi-key-fill"></i> Change Password</a>
                      <a class="dropdown-item" href="/logout"><i class="bi bi-power"></i> Logout</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- content and menu -->
        <div class="row flex-grow-1">
            <div class="col-lg-1">
                <!-- menu -->
                <div class="col-3">
                    <div class="navs">
                        <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                            <a class="nav-link {{ $key == 'News' ? 'active' : '' }}" id="v-pills-news-tab" href="/news">News</a>
                            <a class="nav-link {{ $key == 'Weather Forecast' ? 'active' : '' }}" id="v-pills-weather-tab" href="/weatherforecast">Weather Forecast</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-11 content">
                <!-- content -->
                <div class="card mt-4">
                    <div class="card-header"></div>
                    <div class="card-body">
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- footer -->
    <footer class="footer text-center py-3">
        <div class="container">
            <span class="text-light">Template By - Henry Yohanes Santoso</span>
        </div>
    </footer>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>
    <!-- JavaScript for Datatables -->
    <script src="https://cdn.datatables.net/2.0.7/js/dataTables.js"></script>
    <script>
        new DataTable('#example');
    </script>
</body>

</html>