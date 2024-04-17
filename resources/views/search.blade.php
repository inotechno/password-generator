<!doctype html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.84.0">
    <title>Password Generator</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

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
        <header class="mb-4">
            <div>
                <h3 class="float-md-start mb-0">Password Generator</h3>
                <nav class="nav nav-masthead justify-content-center float-md-end">
                    <a class="nav-link " aria-current="page" href="{{ url('/') }}">Home</a>
                    <a class="nav-link active" href="{{ route('search') }}">Search</a>
                </nav>
            </div>
        </header>

        <main class="px-3">
            <form id="form-search" method="POST">
                @csrf
                <div class="mb-4 mt-4">
                    <input type="text" class="form-control form-control text-center fs-3" placeholder="Search ..."
                        style="border-radius: 30px" name="search">
                </div>
            </form>
        </main>

        <div id="password" class="mb-4">

        </div>

        <footer class="mt-auto text-white-50">
            <p>Cover template for <a href="https://getbootstrap.com/" class="text-white">Bootstrap</a>, by <a
                    href="https://twitter.com/mdo" class="text-white">@mdo</a>.</p>
        </footer>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

    <script>
        $(document).ready(function() {

            $('[name="search"]').keyup(function() {
                var data = $('#form-search').serialize();

                $.ajax({
                    type: "POST",
                    url: "{{ route('search.process') }}",
                    data: data,
                    dataType: "JSON",
                    success: function(response) {
                        var html = '';

                        $.each(response.data, function(i, v) {
                            html += '<div class="row mt-3">' +
                                '        <div class="col-md">' +
                                '            <div class="card px-2" style="border-radius: 30px" >' +
                                '                <div class="card-body bg-dark px-2" style="border-radius: 30px" >' +
                                '                    <div class="row">' +
                                '                        <div class="col-md">' +
                                '                            <h6>' + v.title + '</h6>' +
                                '                        </div>' +
                                '                        <div class="col-md">' +
                                '                            <h6>' + v.password +
                                '                               <a class="btn-copy" data-password="' +
                                v.password +
                                '" href="#"><i class="bx bx-copy ms-2"></i></a>' +
                                '                            </h6 > ' +
                                '                        </div>' +
                                '                    </div>' +
                                '                </div>' +
                                '            </div>' +
                                '        </div>' +
                                '    </div>';
                        });

                        $('#password').html(html);
                    }
                });

                return false;
            });

            $('#password').on('click', '.btn-copy', function() {
                var password = $(this).data('password');

                console.log(password);
                var $tmp = $('<input>');
                $('body').append($tmp);

                $tmp.val(password).select();
                document.execCommand("copy");

                $tmp.remove();
            })
        });
    </script>
</body>

</html>
