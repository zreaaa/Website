<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Discount Result</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Discount Result</h1>

        <?php
        //this will retrive the value from the form
        $amount = $_POST['amount'];
        $usertype = $_POST['usertype'];
        $discount = 0;
        $finalAmount = 0;

        //this will validate the users input 
        if ($amount <= 0) {
            echo "<p>Invalid amount entered.</p>";
        } else {
            //this will be the discount base on the user input
            switch ($usertype) {
                case "Regular":
                    if ($amount >= 1000) {
                        $discount = 0.05;
                    }
                    break;
                case "Premium":
                    if ($amount >= 500) {
                        $discount = 0.10;
                    }
                    break;
                default:
                    $discount = 0;
            }

            //this will calculate the final amount 
            $discountAmount = $amount * $discount;
            $finalAmount = $amount - $discountAmount;

            //this will be the results
            echo "<p>User Type: <strong>$usertype</strong></p>";
            echo "<p>Original Amount: PHP " . number_format($amount, 2) . "</p>";
            echo "<p>Discount Applied: PHP " . number_format($discountAmount, 2) . "</p>";
            echo "<p><strong>Final Amount: PHP " . number_format($finalAmount, 2) . "</strong></p>";
        }
        ?>
        <a href="index.html"><button>Back</button></a>
    </div>
</body>
</html>
