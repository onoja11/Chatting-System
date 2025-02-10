<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Success</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f7f6;
            color: #333;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background-color: #ffffff;
            padding: 20px 30px;
            border-radius: 12px;
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
            text-align: center;
            max-width: 400px;
            width: 90%;
        }

        .container h1 {
            font-size: 2rem;
            color: #1F2937;
            margin: 0 0 10px;
        }

        .container p {
            font-size: 1rem;
            margin: 0 0 20px;
            color: #555;
        }

        .container .spinner {
            border: 4px solid #f3f3f3;
            border-radius: 50%;
            border-top: 4px solid #1F2937;
            width: 40px;
            height: 40px;
            animation: spin 1s linear infinite;
            margin: 10px auto;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }
            100% {
                transform: rotate(360deg);
            }
        }

        .container .button {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #1F2937;
            color: #fff;
            text-decoration: none;
            border-radius: 6px;
            font-size: 1rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .container .button:hover {
            background-color: #1F2937;
            transform: translateY(-2px);
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Payment Successful</h1>
        <p>Your payment was successful, and your download will start shortly.</p>
        <div class="spinner"></div>
        <p>If the download doesn't start, you can <a href="{{ $downloadUrl }}" class="button">Download Here</a>.</p>
    </div>

    <script>
        // Start file download
        window.location.href = "{{ $downloadUrl }}";

        // Redirect to the marketplace after a delay
        setTimeout(() => {
            window.location.href = "{{ route('marketplace.shop') }}";
        }, 1000); // Redirect after 1 second
    </script>
</body>
</html>
