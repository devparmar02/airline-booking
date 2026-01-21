<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HOOPER AIRLINES</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@600&family=Roboto&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <style>
        body {
            background-image: url('https://sdmntprwestus.oaiusercontent.com/files/00000000-eb3c-6230-8272-e46172fdd8f2/raw?se=2025-04-26T18%3A34%3A49Z&sp=r&sv=2024-08-04&sr=b&scid=57d0c981-8373-5616-b099-07dd7a1dec21&skoid=cbbaa726-4a2e-4147-932c-56e6e553f073&sktid=a48cca56-e6da-484e-a814-9c849652bcb3&skt=2025-04-26T15%3A58%3A16Z&ske=2025-04-27T15%3A58%3A16Z&sks=b&skv=2024-08-04&sig=EKW0nNZDDqI0hh5jfW6mp3ZlrPyuBPkLZDoE5kAAs90%3D');

            /* background-color: skyblue; */
            background-size: cover;
            background-position: center;
        }

        .navbar {
            /* background-color:rgb(109, 153, 199); */
        }

        /* .navbar-brand img {
            height: 40px;
            background-image: url('https://sdmntprwestus.oaiusercontent.com/files/00000000-eb3c-6230-8272-e46172fdd8f2/raw?se=2025-04-26T18%3A34%3A49Z&sp=r&sv=2024-08-04&sr=b&scid=57d0c981-8373-5616-b099-07dd7a1dec21&skoid=cbbaa726-4a2e-4147-932c-56e6e553f073&sktid=a48cca56-e6da-484e-a814-9c849652bcb3&skt=2025-04-26T15%3A58%3A16Z&ske=2025-04-27T15%3A58%3A16Z&sks=b&skv=2024-08-04&sig=EKW0nNZDDqI0hh5jfW6mp3ZlrPyuBPkLZDoE5kAAs90%3D');
        } */
        .brand-text {
            font-family: 'Montserrat', sans-serif;
            font-size: 1.1rem;
            font-weight: 600;
            color: #ffffff; /* or #333 for dark on light background */
            text-transform: uppercase;
            letter-spacing: 1px;
            margin: 0;
        }
        .form-container {
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
            max-width: 500px;
            margin-left: auto; /* Shift to the right */
            margin-right: 20px; /* Add some space from the right */
        }

        .signature-title {
            font-family: 'Arial', sans-serif;
            font-weight: bold;
            font-size: 2rem;
            color: white;
        }

        .btn-custom {
    background-color: #28a745;
    color: white;
    padding: 8px 25px;
    border: none;
    border-radius: 5px;
    font-family: 'Montserrat', sans-serif;
}

        .btn-custom:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
    <a class="navbar-brand" href="#">
        <!-- <img src="air.jpg" alt="Dev Airline Logo" style="height: 40px;"> -->
        <h2 class="brand-text">dev AIRLINES</h2> 
    </a>
        <!-- <div class="collapse navbar-collapse">
            <h4 class="signature-title mx-auto">HOOPER AIRLINRS</h4>
            <button type="button" class="btn btn-custom w-100 mt-3" onclick="location.href='user.php'">
            View Your Booking
            </button>
        </div> -->
    </div>
</nav>

<div class="d-flex justify-content-center align-items-center vh-100">
<form id="flightForm" method="POST" action="booking.php" class="form-container">
    <h3 class="text-center mb-4">Book Your Flight</h3>
    
    <!-- Source -->
    <div class="mb-3">
        <label for="source" class="form-label">Source</label>
        <select id="source" name="source" class="form-select" required>
            <option value="">Select a Source</option>
            <option value="DEL">Delhi</option>
            <option value="MUM">Mumbai</option>
            <option value="HYD">Hyderabad</option>
        </select>
        <div class="invalid-feedback">Please select a source.</div>
    </div>

    <!-- Destination -->
    <div class="mb-3">
        <label for="destination" class="form-label">Destination</label>
        <select id="destination" name="destination" class="form-select" required>
            <option value="">Select a Destination</option>
            <option value="DEL">Delhi</option>
            <option value="MUM">Mumbai</option>
            <option value="HYD">Hyderabad</option>
        </select>
        <div class="invalid-feedback">Please select a destination.</div>
    </div>

    <!-- Date -->
    <div class="mb-3">
        <label for="date" class="form-label">Date</label>
        <input type="date" id="date" name="date" class="form-control" required>
        <div class="invalid-feedback">Please select a date.</div>
    </div>

    <!-- Airline -->
    <div class="mb-3">
        <label for="airline" class="form-label">Airline</label>
        <input type="text" id="airline" name="airline" class="form-control" placeholder="Airline" required>
        <div class="invalid-feedback">Please enter an airline.</div>
    </div>

    <!-- Submit -->
    <button type="submit" class="btn btn-custom w-100">Submit</button>

    <!-- View Booking -->
    <button type="button" class="btn btn-custom w-100 mt-3" onclick="location.href='user.php'">
        View Your Booking
    </button>
</form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/index.js"></script>

</body>
</html>