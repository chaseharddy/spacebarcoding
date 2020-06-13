<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Admin</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
    <!-- Bootstrap core CSS -->
    <link href="css/admin/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css"
        integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <!-- Material Design Bootstrap -->
    <link href="css/admin/mdb.min.css" rel="stylesheet">
    <!-- Your custom styles (optional) -->
    <link href="css/admin/style.min.css" rel="stylesheet">
    <link href="css/table/table.css" rel="stylesheet">
    <link href="css/admin/admin.css" rel="stylesheet">
    <style>
        .map-container {
            overflow: hidden;
            padding-bottom: 56.25%;
            position: relative;
            height: 0;
        }

        .map-container iframe {
            left: 0;
            top: 0;
            height: 100%;
            width: 100%;
            position: absolute;
        }
    </style>
</head>

<body class="grey lighten-3">

    <!-- Remove User Modal -->
    <div id="remove-user-modal" class="modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="fas fa-exclamation-triangle"></i>
                        Remove User
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to remove this user?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"
                        id="remove-row-button">Yes</button>
                    <button type="button" class="btn" data-dismiss="modal">No</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Migrate Modal -->
    <div id="migrate-modal" class="modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="fas fa-exclamation-triangle"></i>
                        Migration Complete
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Student has been successfully moved to public</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal"
                        id="migrate-ok-button">Ok</button>
                </div>
            </div>
        </div>
    </div>

    <!--Main Navigation-->
    <header>

        <!-- Navbar -->
        <nav class="navbar fixed-top navbar-expand-lg navbar-light white scrolling-navbar">
            <div class="container-fluid">

                <!-- Brand -->
                <a class="navbar-brand waves-effect" href="https://mdbootstrap.com/docs/jquery/" target="_blank">
                    <strong class="blue-text">Space Bar</strong>
                </a>

                <!-- Collapse -->
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <!-- Links -->
                <div class="collapse navbar-collapse" id="navbarSupportedContent">

                    <!-- Left -->
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item active">
                            <a class="nav-link waves-effect" href="#">Home
                                <span class="sr-only">(current)</span>
                            </a>
                        </li>

                    </ul>

                    <!-- Right -->
                    <ul class="navbar-nav nav-flex-icons">
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                    style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>

                    </ul>

                </div>

            </div>
            <div style="display: none;" id="nav-spinner" class="spinner-border text-primary" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </nav>
        
        <!-- Navbar -->

        <!-- Sidebar -->
        <div class="sidebar-fixed position-fixed">

            <a class="logo-wrapper waves-effect">
               <!-- <img src="https://mdbootstrap.com/img/logo/mdb-email.png" class="img-fluid" alt="">-->
               <span style="font-size: 20pt;">SB</span>
            </a>

            <div class="list-group list-group-flush">
                <a href="#" class="list-group-item list-group-item-action waves-effect">
                    <i class="fas fa-chart-pie mr-3"></i>Staff
                </a>
                <a href="#students" class="list-group-item list-group-item-action waves-effect">
                    <i class="fas fa-user mr-3"></i>Students</a>
                <a href="#migration" class="list-group-item list-group-item-action waves-effect">
                    <i class="fas fa-table mr-3"></i>Migration</a>
                <a href="#computers" class="list-group-item list-group-item-action waves-effect">
                    <i class="fas fa-map mr-3"></i>Computers</a>
            </div>


        </div>
        <!-- Sidebar -->

    </header>
    <!--Main Navigation-->

    <!--Main layout-->
    <main class="pt-5 mx-lg-5">
        <div class="container-fluid mt-5">

            <!-- Register Staff -->
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">Register New Staff</div>

                            <div class="card-body">
                                <form method="POST" action="/api/staff">
                                    @csrf

                                    <div class="form-group row">
                                        <label
                                            class="col-md-4 col-form-label text-md-right">{{ __('Name') ?? '' }}</label>

                                        <div class="col-md-6">
                                            <input id="name" type="text"
                                                class="form-control @error('name') is-invalid @enderror" name="name"
                                                value="{{ old('name') ?? '' }}" required autocomplete="name" autofocus>


                                            @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message ?? '' }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label
                                            class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                        <div class="col-md-6">
                                            <input id="email" type="email"
                                                class="form-control @error('email') is-invalid @enderror" name="email"
                                                value="{{ old('email') }}" required autocomplete="email">

                                            @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label
                                            class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                        <div class="col-md-6">
                                            <input id="password" type="password"
                                                class="form-control @error('password') is-invalid @enderror"
                                                name="password" required autocomplete="new-password">

                                            @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <input type="hidden" class="form-control" name="api_token"
                                                value="<?php echo $token; ?>">
                                        </div>
                                    </div>

                                    <div class="form-group row mb-0">
                                        <div class="col-md-6 offset-md-4">
                                            <button type="submit" class="btn btn-primary">
                                                {{ __('Register') }}
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--Staff Table-->
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">Staff Table</div>

                            <div id="staff_table"></div>
                            <div id="staff_pag" class="pag-box"></div>

                            <div class="card-body">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <hr id="students">

            <!-- Register Students -->
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">Register New Student</div>

                            <div class="card-body">
                                <form method="POST" action="/api/student">
                                    @csrf

                                    <div class="form-group row">
                                        <label
                                            class="col-md-4 col-form-label text-md-right">{{ __('Name') ?? '' }}</label>

                                        <div class="col-md-6">
                                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                                name="name" value="{{ old('name') ?? '' }}" required autocomplete="name"
                                                autofocus>


                                            @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message ?? '' }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label
                                            class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                        <div class="col-md-6">
                                            <input type="password" name="password"
                                                class="form-control @error('password') is-invalid @enderror" required
                                                autocomplete="new-password">

                                            @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>


                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <input type="hidden" class="form-control" name="api_token"
                                                value="<?php echo $token; ?>">
                                        </div>
                                    </div>

                                    <div class="form-group row mb-0">
                                        <div class="col-md-6 offset-md-4">
                                            <button type="submit" class="btn btn-primary">
                                                {{ __('Register') }}
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--Student Table-->
            <div id="migration" class="container">
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">Student Table</div>

                            <div id="student_table"></div>
                            <div id="student_pag" class="pag-box"></div>

                            <div class="card-body">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <hr>

            <!--Update Public-->
            <div id="computers" class="container">
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">Migrate Students To Public</div>

                            <button id="migrate-button" class="btn btn-primary" onclick="migrateStudents()">
                                Migrate
                            </button>

                            <div class="card-body">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <hr>

            <!-- Add Students to Computer -->
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">Assign Student To Computer</div>

                            <div class="card-body">
                                <form method="POST" action="/api/studenttocomputer">
                                    @csrf

                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label text-md-right">Student</label>

                                        <div class="col-md-6">
                                            <select name="student_id" class="form-control" id="student-select">
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label text-md-right">Computer</label>

                                        <div class="col-md-6">
                                            <select name="computer_id" class="form-control" id="computer-select">
                                            </select>
                                        </div>
                                    </div>


                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <input type="hidden" class="form-control" name="api_token"
                                                value="<?php echo $token; ?>">
                                        </div>
                                    </div>

                                    <div class="form-group row mb-0">
                                        <div class="col-md-6 offset-md-4">
                                            <button id="assign-button" type="submit" class="btn btn-primary">
                                                Assign
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--Student Table-->
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">Student To Computer</div>

                            <div id="studenttocomputer_table"></div>
                            <div id="studenttocomputer_pag" class="pag-box"></div>

                            <div class="card-body">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!--Computer Table-->
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">Computer Table</div>

                            <div id="computer_table"></div>
                            <div id="computer_pag" class="pag-box"></div>

                            <div class="card-body">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </main>
    <!--Main layout-->

    <!--Footer-->
    <footer class="page-footer text-center font-small primary-color-dark darken-2 mt-4 wow fadeIn">


        <!--/.Call to action-->

        <hr class="my-4">

        <!-- Social icons -->
        <div class="pb-4">
            <a href="https://www.facebook.com/mdbootstrap" target="_blank">
                <i class="fab fa-facebook-f mr-3"></i>
            </a>

            <a href="https://twitter.com/MDBootstrap" target="_blank">
                <i class="fab fa-twitter mr-3"></i>
            </a>

            <a href="https://www.youtube.com/watch?v=7MUISDJ5ZZ4" target="_blank">
                <i class="fab fa-youtube mr-3"></i>
            </a>

            <a href="https://plus.google.com/u/0/b/107863090883699620484" target="_blank">
                <i class="fab fa-google-plus mr-3"></i>
            </a>

            <a href="https://dribbble.com/mdbootstrap" target="_blank">
                <i class="fab fa-dribbble mr-3"></i>
            </a>

            <a href="https://pinterest.com/mdbootstrap" target="_blank">
                <i class="fab fa-pinterest mr-3"></i>
            </a>

            <a href="https://github.com/mdbootstrap/bootstrap-material-design" target="_blank">
                <i class="fab fa-github mr-3"></i>
            </a>

            <a href="http://codepen.io/mdbootstrap/" target="_blank">
                <i class="fab fa-codepen mr-3"></i>
            </a>
        </div>
        <!-- Social icons -->

        <!--Copyright-->
        <div class="footer-copyright py-3">
            © 2019 Copyright:
            <a href="https://mdbootstrap.com/education/bootstrap/" target="_blank"> MDBootstrap.com </a>
        </div>
        <!--/.Copyright-->

    </footer>
    <!--/.Footer-->

    <!-- SCRIPTS -->
    <script>
        var token = '<?php echo $token; ?>';
    </script>
    <!-- JQuery -->
    <script type="text/javascript" src="js/admin/jquery-3.4.1.min.js"></script>
    <!-- Bootstrap tooltips -->
    <script type="text/javascript" src="js/admin/popper.min.js"></script>
    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript" src="js/admin/bootstrap.min.js"></script>
    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="js/admin/mdb.min.js"></script>
    <!-- Data (must preexist table) -->
    <script type="text/javascript" src="js/data/data.js"></script>
    <!-- Table JS (has DATA dependency) -->
    <script type="text/javascript" src="js/table/paginator.js"></script>
    <script type="text/javascript" src="js/table/table.js"></script>
    <!-- Initializations -->
    <script type="text/javascript">
        // Animations initialization
        new WOW().init();
    </script>

    <!-- Tables Initialization -->
    <script type="text/javascript">
        window.addEventListener("load", function () {
            var data = new Data();
            load_table("staff_table", "staff_pag", data.nameEnum.staff);
            load_table("student_table", "student_pag", data.nameEnum.student);
            load_table("studenttocomputer_table", "studenttocomputer_pag", data.nameEnum.studenttocomputer);
            load_table("computer_table", "computer_pag", data.nameEnum.computer);
            loadStudentsComputers(data);
        }, false);

        function migrateStudents() {
            var data = new Data();
            var s = document.getElementById("migration-student-select");
            data.migrate("#migrate-modal");
        }

        function loadStudentsComputers(data) {
            /* load computers */
            data.get(data.nameEnum.computer, (response) => {
                var computerSelect = document.getElementById("computer-select");
                var results = JSON.parse(response);
                //check if there are results
                if (results.length == 0)
                    document.getElementById("assign-button").classList.add("disabled");
                /* loop through results */
                for (var i = 0; i < results.length; i++) {
                    var option = document.createElement("option");
                    option.text = results[i].name;
                    option.value = results[i].id;
                    computerSelect.add(option);
                }
            });
            /* load students */
            data.get(data.nameEnum.student, (response) => {
                var studentSelect = document.getElementById("student-select");
                var results = JSON.parse(response);
                //check if there are results
                if (results.length == 0)
                    document.getElementById("assign-button").classList.add("disabled");
                /* loop through results */
                for (var i = 0; i < results.length; i++) {
                    var option = document.createElement("option");
                    option.text = results[i].name;
                    option.value = results[i].id;
                    studentSelect.add(option);
                }
            });
        }
    </script>


</body>

</html>
