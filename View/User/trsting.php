<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QR Code Scanner</title>
    <script src="https://unpkg.com/html5-qrcode/minified/html5-qrcode.min.js"></script>
    <style>
        body {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
        }
        #reader {
            width: 100%;
            max-width: 400px; /* Restrict maximum width on large screens */
        }
        #result {
            text-align: center;
            font-size: 20px;
            margin-top: 20px;
        }
        button {
            padding: 10px 20px;
            margin-top: 20px;
            font-size: 16px;
        }
    </style>
</head>
<body>

    <h2>QR Code Scanner</h2>
    <div id="reader"></div>
    <div id="result">Scan a QR code</div>

    <button id="stopScanner">Stop Scanning</button>

    <script>
        let html5QrcodeScanner;

        function onScanSuccess(decodedText, decodedResult) {
            document.getElementById('result').innerHTML = `Scanned Code: ${decodedText}`;
        }

        function onScanFailure(error) {
            console.warn(`QR code scan error: ${error}`);
        }

        // Initialize the scanner when the page loads
        window.onload = function() {
            html5QrcodeScanner = new Html5QrcodeScanner(
                "reader", { fps: 10, qrbox: { width: 250, height: 250 } }
            );

            html5QrcodeScanner.render(onScanSuccess, onScanFailure);
        };

        // Add functionality to stop the scanner
        document.getElementById('stopScanner').addEventListener('click', function() {
            html5QrcodeScanner.clear(); // Stop the scanner
            document.getElementById('reader').innerHTML = ''; // Clear the video feed
        });
    </script>

</body>
</html>
