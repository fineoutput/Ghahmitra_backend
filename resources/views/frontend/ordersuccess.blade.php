<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Payment Success</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

    <style>
        body {
            background: #f5f6fa;
            font-family: 'Poppins', sans-serif;
        }

        .success-card {
            max-width: 400px;
            margin: auto;
            margin-top: 80px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            padding: 30px;
            text-align: center;
            background: #fff;
        }

        .checkmark {
            width: 80px;
            height: 80px;
            background: #28a745;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: auto;
            margin-bottom: 20px;
        }

        .checkmark i {
            color: white;
            font-size: 40px;
        }

        .amount {
            font-size: 28px;
            font-weight: 600;
            color: #333;
        }

        .btn-home {
            background: #6f42c1;
            color: #fff;
            border-radius: 30px;
            padding: 10px 25px;
            margin-top: 20px;
        }

        .btn-home:hover {
            background: #5a32a3;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="success-card">

        <!-- Icon -->
        <div class="checkmark">
            ✔
        </div>

        <!-- Text -->
        <h4 class="mb-2">Order Successfully</h4>
        <p class="text-muted">Your transaction has been completed</p>

        <!-- Amount -->
        {{-- <div class="amount">BACK TO HOME</div> --}}

        <!-- Details -->
        {{-- <p class="text-muted mt-2">Transaction ID: TXN123456789</p> --}}

        <!-- Button -->
        <a href="{{route('/')}}" class="btn btn-home">Back to Home</a>

    </div>
</div>

</body>
</html>