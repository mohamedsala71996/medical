<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Terms and Conditions</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #8a8989;
        }

        .container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
            margin-top: 15% !important;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        p {
            line-height: 1.6;
        }

        .terms {
            max-height: 300px;
            overflow-y: auto;
            border: 1px solid #ccc;
            padding: 10px;
            background-color: #f9f9f9;
        }

        .btn-container {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        .accept-btn,
        .decline-btn {
            flex: 1;
            max-width: 200px;
            padding: 10px;
            border-radius: 5px;
            text-align: center;
            text-decoration: none;
            cursor: pointer;
        }

        .accept-btn {
            background-color: #007bff;
            color: #fff;
            margin-right: 10px;
            margin-left: 10rem;
        }

        .accept-btn:hover {
            background-color: #0056b3;
        }

        .decline-btn {
            background-color: #b1abab;
            color: #fff;
            margin-right: 10rem;
        }

        .decline-btn:hover {
            background-color: #bd2130;
        }

        @media (max-width: 576px) {
            .accept-btn,.decline-btn{
               margin-left: 1rem;
               margin-right: 0;
            }
        }
    </style>
</head>

<body>

    <div class="container">
        <h1>Terms and Conditions</h1>
        <div class="terms">
            <p>put you terms and condition here.</p>
            <!-- Add more paragraphs as needed -->
        </div>
        <div class="btn-container">
            <a href="{{ route('terms',1) }}" class="accept-btn">I Agree</a>
            <a href="{{ route('terms',0) }}" class="decline-btn">Decline</a>
        </div>
    </div>

</body>

</html>