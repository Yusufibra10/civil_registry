<?php
session_start();
require_once 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Soo qaado xogta foomka
    $first_name = trim($_POST['first_name']);
    $middle_name = trim($_POST['middle_name']);
    $last_name = trim($_POST['last_name']);
    $gender = $_POST['gender'];
    $dob = $_POST['dob'];
    $place_of_birth = trim($_POST['place_of_birth']);
    $father_name = trim($_POST['father_name']);
    $father_nid = trim($_POST['father_nid']);
    $mother_name = trim($_POST['mother_name']);
    $mother_nid = trim($_POST['mother_nid']);
    $address = trim($_POST['address']);
    $phone_number = trim($_POST['phone_number']);

    try {
        // SQL-ka lagu dhowrayo xogta
        $sql = "INSERT INTO birth_certificates (first_name, middle_name, last_name, gender, dob, place_of_birth, father_name, father_nid, mother_name, mother_nid, address, phone_number) 
                VALUES (:first_name, :middle_name, :last_name, :gender, :dob, :place_of_birth, :father_name, :father_nid, :mother_name, :mother_nid, :address, :phone_number)";
        
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            ':first_name' => $first_name,
            ':middle_name' => $middle_name,
            ':last_name' => $last_name,
            ':gender' => $gender,
            ':dob' => $dob,
            ':place_of_birth' => $place_of_birth,
            ':father_name' => $father_name,
            ':father_nid' => $father_nid,
            ':mother_name' => $mother_name,
            ':mother_nid' => $mother_nid,
            ':address' => $address,
            ':phone_number' => $phone_number
        ]);

        echo "<script>alert('Warqadda dhalashada waa la kaydiyey si guul ah!'); window.location.href='dashboard.php';</script>";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>