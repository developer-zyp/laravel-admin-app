<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recipe Details</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Bootstrap Font Icon CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" />
    <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <!-- Custom Styles -->
    <style>
        .full-height {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .main-content {
            max-width: 80vh;
            padding: 0px;
        }

        .card-container {
            padding: 10px;
            margin-bottom: 10px;
            padding-bottom: 50px;
        }

        .elevation {
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
            /* Adjust values as needed */
        }

        .recipe-content {
            font-family: "Pyidaungsu";
            font-size: 16px;
            line-height: 1.9;
            transition: font-size 0.3s;
        }
    </style>
</head>

<body class="full-height">

    <div class="container-fluid main-content">
        @yield('content')
    </div>

    <!-- Include Bootstrap JS and Popper.js -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>
