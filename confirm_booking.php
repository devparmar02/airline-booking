<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "airline";

$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


    $seatno      = $conn->real_escape_string($_POST['seatno']);
    $price       = (float)$_POST['price'];
    $source      = $conn->real_escape_string($_POST['source']);
    $destination = $conn->real_escape_string($_POST['destination']);
    $name        = $conn->real_escape_string($_POST['name']);
    $email       = $conn->real_escape_string($_POST['email']);
    $date        = $conn->real_escape_string($_POST['date']);
    $phone       = $conn->real_escape_string($_POST['phone']);
    $id          = $conn->real_escape_string($_POST['id']);
    $airline     = $conn->real_escape_string($_POST['airline']);

    
  
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Confirm Booking</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
 
    <style>
    body {
            
        
        
        }
</style>
</head>
<body >

<div class="container mt-5">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Review Your Booking</h4>
        </div>
        <div class="card-body">
            <form method="POST"  onsubmit="return validateForm();">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <strong>Passenger Name:</strong> <?php echo $name; ?>
                        <input type="hidden" name="name" value="<?php echo $name; ?>">
                    </div>
                    <div class="col-md-6">
                        <strong>Email:</strong> <?php echo $email; ?>
                        <input type="hidden" name="email" value="<?php echo $email; ?>">
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <strong>Phone:</strong> <?php echo $phone; ?>
                        <input type="hidden" name="phone" value="<?php echo $phone; ?>">
                    </div>
                    <div class="col-md-6">
                        <strong>Seat No:</strong> <?php echo $seatno; ?>
                        <input type="hidden" name="seatno" value="<?php echo $seatno; ?>">
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <strong>Flight ID:</strong> <?php echo $id; ?>
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                    </div>
                    <div class="col-md-6">
                        <strong>Airline:</strong> <?php echo $airline; ?>
                        <input type="hidden" name="airline" value="<?php echo $airline; ?>">
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <strong>Source:</strong> <?php echo $source; ?>
                        <input type="hidden" name="source" value="<?php echo $source; ?>">
                    </div>
                    <div class="col-md-6">
                        <strong>Destination:</strong> <?php echo $destination; ?>
                        <input type="hidden" name="destination" value="<?php echo $destination; ?>">
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <strong>Date of Travel:</strong> <?php echo $date; ?>
                        <input type="hidden" name="date" value="<?php echo $date; ?>">
                    </div>
                    <div class="col-md-6">
                        <strong>Price:</strong> $<?php echo number_format($price, 2); ?>
                        <input type="hidden" name="price" value="<?php echo $price; ?>">
                    </div>
                </div>

                <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" name="termsCheck" id="termsCheck">
                    <label class="form-check-label" for="termsCheck">
                        I agree to the <a href="#">Terms and Conditions</a>
                    </label>
                </div>
                <div id="paymentSection" class="card mt-4 d-none">
    <div class="card-header bg-dark text-white">
        <h5 class="mb-0">Payment Details</h5>
    </div>
    <div class="card-body">
        <div class="mb-3">
            <label for="cardNumber" class="form-label">Card Number</label>
            <input type="text" class="form-control" id="cardNumber" name="cardNumber" maxlength="19" placeholder="1234 5678 9012 3456">
        </div>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="expiry" class="form-label">Expiry Date (MM/YY)</label>
                <input type="text" class="form-control" id="expiry" name="expiry" maxlength="5" placeholder="MM/YY">
            </div>
            <div class="col-md-6 mb-3">
                <label for="cvv" class="form-label">CVV</label>
                <input type="text" class="form-control" id="cvv" name="cvv" maxlength="4" placeholder="123">
            </div>
        </div>
    </div>
</div>

<div class="d-grid mb-3">
    <button type="button" id="showPaymentBtn" class="btn btn-warning btn-lg">
        Proceed to Payment
    </button>
</div>

<div class="d-grid">
    <button type="submit" name="confirm_booking" class="btn btn-success btn-lg" id="confirmBtn" style="display:none;">
        Confirm Booking
    </button>
</div>


            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
    // Show card details on button click
    $('#showPaymentBtn').on('click', function () {
        $('#paymentSection').removeClass('d-none');
        $('#showPaymentBtn').hide();
        $('#confirmBtn').show();
    });

    function validateForm() {
        if (!$('#termsCheck').is(':checked')) {
            alert("Please accept the Terms and Conditions before confirming.");
            return false;
        }

        if ($('#paymentSection').is(':visible')) {
            const cardNumber = $('#cardNumber').val().replace(/\s+/g, '');
            const expiry = $('#expiry').val();
            const cvv = $('#cvv').val();

            const cardRegex = /^[0-9]{16}$/;
            const expiryRegex = /^(0[1-9]|1[0-2])\/\d{2}$/;
            const cvvRegex = /^[0-9]{3,4}$/;

            if (!cardRegex.test(cardNumber)) {
                alert("Please enter a valid 16-digit card number.");
                return false;
            }

            if (!expiryRegex.test(expiry)) {
                alert("Please enter a valid expiry date (MM/YY).");
                return false;
            }

            if (!cvvRegex.test(cvv)) {
                alert("Please enter a valid CVV.");
                return false;
            }
        }

        return true;
    }

    // Optional: Format card number
    $('#cardNumber').on('input', function () {
        let input = $(this).val().replace(/\D/g, '').substring(0, 16);
        input = input !== '' ? input.match(/.{1,4}/g).join(' ') : '';
        $(this).val(input);
    });
</script>

</script>

</body>
</html>
