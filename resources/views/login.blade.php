<!DOCTYPE html>
<html lang="en">

<head>
    <style>
        a {
            text-decoration: none;
        }

        body {
            background: -webkit-linear-gradient(bottom, #EEF5FF, #83A2FF);
            height: 609px;
        }

        label {
            font-family: "Raleway", sans-serif;
            font-size: 11pt;
        }

        #forgot-pass {
            color: #83A2FF;
            font-family: "Raleway", sans-serif;
            font-size: 10pt;
            margin-top: 3px;
            text-align: right;
        }

        #card {
            background: #fbfbfb;
            border-radius: 8px;
            box-shadow: 1px 2px 8px rgba(0, 0, 0, 0.65);
            height: 410px;
            margin: 6rem auto 8.1rem auto;
            width: 329px;
        }

        #card-content {
            padding: 12px 44px;
        }

        #card-title {
            font-family: "Raleway Thin", sans-serif;
            letter-spacing: 4px;
            padding-bottom: 23px;
            padding-top: 13px;
            text-align: center;
        }

        #signup {
            color: #2dbd6e;
            font-family: "Raleway", sans-serif;
            font-size: 10pt;
            margin-top: 16px;
            text-align: center;
        }

        #submit-btn {
            background: -webkit-linear-gradient(right, #EEF5FF, #83A2FF);
            border: none;
            border-radius: 21px;
            box-shadow: 0px 1px 8px #83A2FF;
            cursor: pointer;
            color: rgb(103, 103, 103);
            font-family: "Raleway SemiBold", sans-serif;
            height: 42.3px;
            margin: 0 auto;
            margin-top: 50px;
            transition: 0.25s;
            width: 153px;
        }

        #submit-btn:hover {
            box-shadow: 0px 1px 18px #83A2FF;
        }

        .form {
            align-items: left;
            display: flex;
            flex-direction: column;
        }

        .form-border {
            background: -webkit-linear-gradient(right, #EEF5FF, #83A2FF);
            height: 1px;
            width: 100%;
        }

        .form-content {
            background: #fbfbfb;
            border: none;
            outline: none;
            padding-top: 14px;
        }

        .underline-title {
            background: -webkit-linear-gradient(right, #EEF5FF, #83A2FF);
            height: 2px;
            margin: -0.95rem auto 0 auto;
            width: 116px;
        }
    </style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="app.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <title>Document</title>
</head>

<body>
    <div id="card">
        <div id="card-content">
            <div id="card-title">
                <h2>LOGIN</h2>
                <div class="underline-title"></div>
            </div>
            <form action="{{ route('login.auth') }}" class="form" method="POST">
                @csrf
                @if (Session::get('failed'))
                    <div class="alert alert-danger">{{ Session::get('failed') }}</div>
                @endif
                <label for="user-email" style="padding-top:13px">
                    &nbsp;Email
                </label>
                <input id="user-email" class="form-content" type="email" name="email" autocomplete="on" required />
                <div class="form-border"></div>
                @error('email')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
                <label for="user-password" style="padding-top:22px">&nbsp;Password
                </label>
                <input id="user-password" class="form-content" type="password" name="password" required />
                <div class="form-border"></div>
                @error('password')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
                <a href="#">
                    <br>
                    <div class="mb-3">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="dropdownCheck" onclick="myFunction()">
                            <label class="form-check-label" for="dropdownCheck">
                                &nbsp;Lihat Password
                            </label>
                        </div>
                    </div>
                    <center>
                        <input id="submit-btn" type="submit" name="submit" value="LOGIN" />
                    </center>
            </form>
        </div>

        <script>
            function myFunction() {
                var x = document.getElementById("user-password")
                if (x.type === "password") {
                    x.type = "text"
                } else {
                    x.type = "password"
                }
            }
        </script>
</body>

</html>
