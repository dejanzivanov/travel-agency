<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Registration Page</title>
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

        .form-label {
            color: #000;
        }
    </style>
</head>

<body>
<div id='app' >
    <div class="text-white">
        <header-component></header-component>
        <registration-form></registration-form>
    </div>
</div>
<script src="{{ asset('js/app.js') }}"></script>

</body>

</html>
