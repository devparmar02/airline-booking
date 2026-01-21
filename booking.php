<?php
$host = 'localhost';  
$username = 'root';   
$password = '';       
$dbname = 'airline';  

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$source = $_POST['source'];
$destination = $_POST['destination'];
$date = $_POST['date'];
$airline = $_POST['airline'];
$result = $conn->query("SELECT * FROM flights WHERE source='{$source}' AND destination='{$destination}' AND date='{$date}'");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Select Flight</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body {
            background-image: url('https://gumlet.assettype.com/swarajya/2023-03/cb5a92a6-5dfe-4687-b382-1658182595d3/Picture1_2.jpg?w=1200&auto=format%2Ccompress&ogImage=true');
            background-size: cover;
            background-position: center;
            min-height: 100vh;
        }
        .form-container {
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
        }
    </style>
</head>

<body class="d-flex align-items-center justify-content-center">
    <div class="container form-container">
        <h2 class="mb-4 text-center">Select a Flight</h2>

        <?php if ($result && $result->num_rows > 0): ?>
            <form action="book_flight.php" method="POST">
                <div class="mb-3">
                    <label for="flight" class="form-label">Available Flights</label>
                    <select class="form-select" name="flight_id" id="flight" required>
                        <?php while($row = $result->fetch_assoc()): ?>
                            <option value="<?= $row['id'] ?>">
                                <?= $row['airline'] ?> - <?= $row['source'] ?> to <?= $row['destination'] ?> (<?= date('d M Y', strtotime($row['date'])) ?>)
                            </option>
                        <?php endwhile; ?>
                    </select>
                </div>
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">Book Now</button>
                </div>
            </form>
        <?php else: ?>
            <div class="alert alert-warning text-center">No flights found.</div>
        <?php endif; ?>

        <?php $conn->close(); ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>