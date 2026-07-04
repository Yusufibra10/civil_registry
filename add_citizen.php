<?php
// Ku xidh database-ka
$conn = mysqli_connect("localhost", "root", "", "civil_registry");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Marka la gujiyo badhanka Submit
if (isset($_POST['save_citizen'])) {
    $citizen_id = $_POST['citizen_id'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $birth_date = $_POST['birth_date'];
    $gender = $_POST['gender'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    // Koodhka lagu keydinayo database-ka
    $sql = "INSERT INTO citizens (citizen_id, first_name, last_name, birth_date, gender, phone, address) 
            VALUES ('$citizen_id', '$first_name', '$last_name', '$birth_date', '$gender', '$phone', '$address')";

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Muwaadinka waa la diiwangeliyey guul!');</script>";
    } else {
        echo "Qalad ayaa dhacay: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="so">
<head>
    <meta charset="UTF-8">
    <title>Diiwangelinta Muwaadinka</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; background-color: #f4f4f4; }
        .form-container { background: white; padding: 20px; border-radius: 5px; max-width: 500px; margin: auto; box-shadow: 0px 0px 10px #ccc; }
        .form-group { margin-bottom: 15px; }
        .form-group label { display: block; margin-bottom: 5px; font-weight: bold; }
        .form-group input, .form-group select, .form-group textarea { width: 100%; padding: 8px; box-sizing: border-box; }
        .btn { background: #28a745; color: white; padding: 10px 15px; border: none; cursor: pointer; width: 100%; }
    </style>
</head>
<body>

<div class="form-container">
    <h2>Diiwangelinta Muwaadin Cusub</h2>
    <form action="" method="POST">
        <div class="form-group">
            <label>Nambarka Aqoonsiga (Citizen ID):</label>
            <input type="text" name="citizen_id" required>
        </div>
        <div class="form-group">
            <label>Magaca:</label>
            <input type="text" name="first_name" required>
        </div>
        <div class="form-group">
            <label>Naanays/Awoowo:</label>
            <input type="text" name="last_name" required>
        </div>
        <div class="form-group">
            <label>Taariikhda Dhalashada:</label>
            <input type="date" name="birth_date" required>
        </div>
        <div class="form-group">
            <label>Lab ama Dheddig:</label>
            <select name="gender" required>
                <option value="Male">Lab</option>
                <option value="Female">Dheddig</option>
            </select>
        </div>
        <div class="form-group">
            <label>Talefoonka:</label>
            <input type="text" name="phone">
        </div>
        <div class="form-group">
            <label>Ciwaanka/Halku degan yahay:</label>
            <textarea name="address" rows="3"></textarea>
        </div>
        <button type="submit" name="save_citizen" class="btn">Kaydi Muwaadinka</button>
    </form>
</div>

</body>
</html>