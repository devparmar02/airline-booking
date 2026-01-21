
<?php
session_start();

$conn = new mysqli("localhost", "root", "", "airline");
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

if (isset($_POST['signup'])) {
    $username = $conn->real_escape_string($_POST['username']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $check = $conn->query("SELECT * FROM users WHERE username = '$username'");
    if ($check->num_rows == 0) {
        $conn->query("INSERT INTO users (username, password) VALUES ('$username', '$password')");
        $message = "Signup successful. Please log in.";
    } else {
        $message = "Username already exists.";
    }
}

if (isset($_POST['login'])) {
    $username = $conn->real_escape_string($_POST['username']);
    $password = $_POST['password'];

    $result = $conn->query("SELECT * FROM users WHERE username = '$username'");
    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['username'] = $username;
        } else {
            $message = "Invalid password.";
        }
    } else {
        $message = "User  not found.";
    }
}

if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: user.php");
    exit;
}

if (isset($_POST['cancel_flight_id'])) {
    $flight_id = intval($_POST['cancel_flight_id']);
    $conn->query("DELETE FROM booked WHERE id = $flight_id");
    $cancel_message = "Flight cancelled successfully.";
}

$flights = [];
if (isset($_SESSION['username'])) {
    $user = $_SESSION['username'];
    $result = $conn->query("SELECT * FROM booked WHERE name = '$user'");
    while ($row = $result->fetch_assoc()) {
        $flights[] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Flights</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-image: url('https://sdmntprwestus.oaiusercontent.com/files/00000000-eb3c-6230-8272-e46172fdd8f2/raw?se=2025-04-24T15%3A55%3A01Z&sp=r&sv=2024-08-04&sr=b&scid=7d45dc7a-8346-5a27-a549-f8b79d1a30eb&skoid=2f36945c-3adc-4614-ac2b-eced8f672c58&sktid=a48cca56-e6da-484e-a814-9c849652bcb3&skt=2025-04-24T03%3A35%3A46Z&ske=2025-04-25T03%3A35%3A46Z&sks=b&skv=2024-08-04&sig=b2KefQ1zw4RVsKhP%2BjPqjTOqOgQzWBtTSsBp9%2B6Dmwk%3D');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            min-height: 100vh;
        }
        .card {
            background-color: rgba(255, 255, 255, 0.8);
            border-radius: 15px;
        }
        .table-responsive {
            background-color: rgba(255, 255, 255, 0.7);
            border-radius: 8px;
        }
    </style>
</head>
<body>
<div class="container py-5">

    <?php if (!isset($_SESSION['username'])): ?>
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-4">
                <div class="card p-4 shadow-sm border-light">
                    <h4 class="text-center mb-3">Login or Sign Up</h4>
                    <?php if (isset($message )): ?>
                        <div class="alert alert-info"><?= $message ?></div>
                    <?php endif; ?>
                    <form method="POST">
                        <div class="mb-3">
                            <input type="text" name="username" class="form-control" placeholder="Username" required>
                        </div>
                        <div class="mb-3">
                            <input type="password" name="password" class="form-control" placeholder="Password" required>
                        </div>
                        <div class="d-grid gap-2">
                            <button type="submit" name="login" class="btn btn-primary">Login</button>
                            <button type="submit" name="signup" class="btn btn-secondary">Sign Up</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <?php else: ?>
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="text-dark">Welcome, <?= htmlspecialchars($_SESSION['username']) ?>!</h2>
            <a href="?logout=true" class="btn btn-danger btn-sm">Logout</a>
        </div>

        <h4 class="text-dark">Your Booked Flights</h4>
        
        <?php if (isset($cancel_message)): ?>
            <div class="alert alert-success"><?= $cancel_message ?></div>
        <?php endif; ?>
        <div class="table-responsive mt-3">
            <table class="table table-bordered table-hover">
                <thead class="table-primary">
                    <tr>
                        <th>#</th>
                        <th>Source</th>
                        <th>Destination</th>
                        <th>Date</th>
                        <th>Airline</th>
                        <th>Seat No</th>
                        <th>Price</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($flights): ?>
                        <?php foreach ($flights as $i => $flight): ?>
                            <tr>
                                <td><?= $i + 1 ?></td>
                                <td><?= htmlspecialchars($flight['source']) ?></td>
                                <td><?= htmlspecialchars($flight['destination']) ?></td>
                                <td><?= htmlspecialchars($flight['date']) ?></td>
                                <td><?= htmlspecialchars($flight['airline']) ?></td>
                                <td><?= htmlspecialchars($flight['seatno']) ?></td>
                                <td>$<?= htmlspecialchars($flight['price']) ?></td>
                                <td>
                                    <form method="POST" onsubmit="return confirm('Are you sure you want to cancel this flight?');">
                                        <input type="hidden" name="cancel_flight_id" value="<?= $flight['id'] ?>">
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="fas fa-trash"></i> Cancel
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr><td colspan="8" class="text-center text-muted">No bookings found.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>