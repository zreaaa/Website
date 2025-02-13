<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Valentine's Day Invitation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #ffe4e1;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .invite-button {
            background: #ff6f91;
            color: white;
            border: none;
            padding: 15px 25px;
            font-size: 18px;
            border-radius: 8px;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .invite-button:hover {
            background: #ff4757;
        }

        .popup {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
            text-align: center;
        }

        .popup h2 {
            color: #ff6f91;
        }

        .popup p {
            margin: 15px 0;
        }

        .popup .close-btn {
            background: #ff4757;
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
        }

        .popup .close-btn:hover {
            background: #e63946;
        }
    </style>
</head>
<body>
    <button class="invite-button" onclick="showPopup()">Click Me for a Surprise!</button>

    <div class="popup" id="valentinePopup">
        <h2>You're Invited! 💌</h2>
        <p>Join us for a special Valentine's Day celebration filled with love, laughter, and joy! 💖</p>
        <p><strong>Date:</strong> February 14, 2025<br><strong>Time:</strong> 7:00 PM<br><strong>Location:</strong> Lovebird Café</p>
        <button class="close-btn" onclick="hidePopup()">Close</button>
    </div>

    <script>
        function showPopup() {
            document.getElementById('valentinePopup').style.display = 'block';
        }

        function hidePopup() {
            document.getElementById('valentinePopup').style.display = 'none';
        }
    </script>
</body>
</html>
