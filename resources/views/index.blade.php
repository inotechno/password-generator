<!doctype html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.84.0">
    <title>Password Generator</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/cover/">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>


    <!-- Custom styles for this template -->
    <link href="style.css" rel="stylesheet">
</head>

<body class="d-flex h-100 text-center text-white bg-dark">

    <div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">
        <header class="mb-auto">
            <div>
                <h3 class="float-md-start mb-0">Password Generator</h3>
                <nav class="nav nav-masthead justify-content-center float-md-end">
                    <a class="nav-link active" aria-current="page" href="#">Home</a>
                    <a class="nav-link" href="{{ route('search') }}">Search</a>
                </nav>
            </div>
        </header>

        <main class="px-3">
            <h1>Password Generator</h1>
            <p class="lead">Create and Generate secure, random passwords to stay safe online.</p>

            <form id="form-save" method="POST">
                @csrf
                <div class="mb-4 mt-4">
                    <h5 for="exampleFormControlInput1" class="form-label text-start">TITLE</h5>
                    <input type="text" class="form-control form-control-lg text-center fs-3"
                        id="exampleFormControlInput1" placeholder="name@example.com" name="title">
                </div>

                <div class="mb-4">
                    <h5 for="field-password" class="form-label text-start">PASSWORD</h5>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control form-control-lg text-center fw-bold fs-3 text-break"
                            id="field-password" readonly name="password">
                        <button type="button" class="input-group-text" id="regenerate">
                            <box-icon name='refresh'></box-icon>
                        </button>
                    </div>
                </div>
            </form>

            <div class="row mb-4">
                <div class="col-md">
                    <form id="form-option">
                        <div class="mb-3">
                            <label for="length" class="form-label">Length</label>
                            <input type="range" name="length" class="form-range" id="length" value="10">
                        </div>

                        <div class="form-check form-switch form-check-inline">
                            <input class="form-check-input" name="upper_case" type="checkbox" id="upper_case">
                            <label class="form-check-label" for="upper_case">Upper Case</label>
                        </div>

                        <div class="form-check form-switch form-check-inline">
                            <input class="form-check-input" name="lower_case" type="checkbox" id="lower_case">
                            <label class="form-check-label" for="lower_case">Lower Case</label>
                        </div>

                        <div class="form-check form-switch form-check-inline">
                            <input class="form-check-input" name="number" type="checkbox" id="number">
                            <label class="form-check-label" for="number">Number</label>
                        </div>

                        <div class="form-check form-switch form-check-inline">
                            <input class="form-check-input" name="symbol" type="checkbox" id="symbol">
                            <label class="form-check-label" for="symbol">Symbol</label>
                        </div>
                    </form>
                </div>
            </div>

            <p class="lead">
                <span class="badge rounded-pill bg-danger" id="notif-error"></span>
                <span class="badge rounded-pill bg-success" id="notif-success"></span>
            </p>

            <p class="lead">
                <button id="btn-save" class="btn btn-lg btn-secondary fw-bold border-white bg-white">Copy &
                    Save</button>
            </p>


        </main>

        <footer class="mt-auto text-white-50">
            <p>Cover template for <a href="https://getbootstrap.com/" class="text-white">Bootstrap</a>, by <a
                    href="https://twitter.com/mdo" class="text-white">@mdo</a>.</p>
        </footer>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>

    <script>
        $(document).ready(function() {
            password_generator();

            function password_generator() {
                var form_option = $('#form-option').serialize();
                $.ajax({
                    type: "GET",
                    url: "{{ route('generate') }}",
                    data: form_option,
                    dataType: "JSON",
                    success: function(response) {
                        $('#field-password').val(response.data);
                    }
                });

                return false;
            }

            $('#regenerate').click(() => {
                password_generator();
            })

            $('.form-check-input').on('change', function() {
                password_generator();
            });

            $('.form-range').on('change', function() {
                password_generator();
            });

            $('#btn-save').on('click', function() {
                $('#notif-error').html("");
                $('#notif-success').html("");
                var data = $('#form-save').serialize();
                $.ajax({
                    type: "POST",
                    url: "{{ route('save') }}",
                    data: data,
                    dataType: "JSON",
                    success: function(response) {
                        if (response.success == false) {
                            $('#notif-error').html(response.data);
                        }

                        $('[name=password]').select().val();
                        document.execCommand("copy");
                        $('#notif-success').html(response.data);
                        // console.log(response);
                    }
                });

                return false;
            })
        });
    </script>
</body>

</html>
