<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Footer</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        .footer {
            background-color: #2C5F8A;
            color: #fff;
            width: 100%;
            bottom: 0;
            position: fixed;
            padding: 10px 0;
            z-index: 1000; 
            text-align: center;

        }
        .container {
            width: 100%;
            text-align: center;
        }
    </style>
</head>
<body>

    <footer class="footer mt-auto py-3">
        <div class="container text-center">
            <span class="text-light">&copy; Doctor Appointment System by Pratikshya Karki. All rights reserved.</span>
        </div>
    </footer>
</body>
</html>
