<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Login Page</title>
    <style>
        body {
            background-color: #343a40;
            color: #fff;
        }

        .form-control {
            background-color: #222;
            border: none;
            color: #fff;
        }

        .form-control:focus {
            background-color: #333;
            color: #fff;
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
<div id="app">
    <header-component></header-component>

    <login-form></login-form>
</div>
</body>
<script src="{{ asset('js/app.js') }}"></script>


</html>
