<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
        <meta name="generator" content="Hugo 0.79.0">
        <title>{{ trans('fr_login.title') }}</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        {{-- <link rel="stylesheet" href="{{ url('css/app.css') }}">
        --}}
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
        <style lang="text/css">
            .login-container {
                width: 50%;
                margin: 0 auto;
                clear: both;
            }

            ul {
                list-style: none;
                text-align: center;
                width: 70%;
                margin: auto;
            }

            ul li {
                padding: 3%;
                float: left;
            }

        </style>
    </head>

    <body>
        <div class="container">
            <ul>
                <li><a href="{{ url('locale/en') }}"><i class="fa fa-language"></i> EN</a></li>
                <li><a href="{{ url('locale/ja') }}"><i class="fa fa-language"></i> JA</a></li>
                <li><a href="{{ url('locale/vi') }}"><i class="fa fa-language"></i> VN</a></li>
            </ul>

            <div class="login-container">
                <form action="{{ route('index') }}" method="POST">
                    <div class="mb-3 row">
                        <label for="staticEmail"
                            class="col-sm-3 col-form-label">{{ trans('fr_login.userName') }}</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="userName" placeholder="{{ trans('fr_login.placeUserName') }}">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="inputPassword"
                            class="col-sm-3 col-form-label">{{ trans('fr_login.password') }}</label>
                        <div class="col-sm-9">
                            <input type="password" class="form-control" id="inputPassword" placeholder="{{ trans('fr_login.placePass') }}">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="inputPassword" class="col-sm-3 col-form-label"></label>
                        <div class="col-sm-9">
                            <button type="submit"
                                class="btn btn-primary">{{ trans('fr_login.login') }}</button> &nbsp;
                            <button type="reset"
                                class="btn btn-info">{{ trans('fr_login.cancel') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>


    </body>
    <script src="{{ url('js/app.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"
        integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js"
        integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous">
    </script>

</html>
