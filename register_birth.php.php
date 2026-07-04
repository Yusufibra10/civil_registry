<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="so">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Birth Certificate</title>
    <link rel="stylesheet" href="dashboard_style.css">
    <style>
        .form-container { background: white; padding: 30px; border-radius: 12px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); }
        .form-section-title { font-size: 15px; color: #1d4ed8; font-weight: bold; margin-top: 20px; margin-bottom: 15px; border-bottom: 1px solid #e2e8f0; padding-bottom: 5px; }
        .form-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 15px; }
        .form-group { display: flex; flex-direction: column; }
        .form-group label { font-size: 13px; color: #475569; margin-bottom: 5px; font-weight: 600; }
        .form-group input, .form-group select { padding: 10px; border: 1px solid #cbd5e1; border-radius: 6px; outline: none; font-size: 14px; }
        .form-group input:focus, .form-group select:focus { border-color: #1d4ed8; }
        .btn-submit { background: #1d4ed8; color: white; border: none; padding: 12px 25px; border-radius: 6px; font-weight: bold; cursor: pointer; transition: 0.3s; margin-top: 20px; }
        .btn-submit:hover { background: #0b1a3a; }
    </style>
</head>
<body>
    <div class="dashboard-wrapper">
        <!-- SIDEBAR -->
        <aside class="sidebar">
            <div class="sidebar-brand">
                <span class="logo-icon">🏛️</span>
                <div>
                    <h3>CIVIL REGISTRY</h3>
                    <small>E-GOVERNMENT PORTAL</small>
                </div>
            </div>
            <nav class="sidebar-menu">
                <a href="dashboard.php">📊 Dashboard</a>
                <a href="register_birth.php" class="active">👶 Birth Certificates</a>
                <a href="#">👥 Citizens</a>
                <a href="#">🪪 National ID</a>
                <a href="logout.php" class="logout-btn">🚪 Logout</a>
            </nav>
        </aside>

        <!-- MAIN CONTENT -->
        <main class="main-content">
            <header class="top-header">
                <div>
                    <h2>Register Birth Certificate</h2>
                    <p>Dashboard / Birth Certificates / Register</p>
                </div>
            </header>

            <div class="form-container">
                <form action="birth_process.php" method="POST">
                    
                    <!-- Qaybta 1aad: Child Information -->
                    <div class="form-section-title">Child Information</div>
                    <div class="form-grid">
                        <div class="form-group">
                            <label>First Name</label>
                            <input type="text" name="first_name" placeholder="Enter first name" required>
                        </div>
                        <div class="form-group">
                            <label>Middle Name</label>
                            <input type="text" name="middle_name" placeholder="Enter middle name" required>
                        </div>
                        <div class="form-group">
                            <label>Last Name</label>
                            <input type="text" name="last_name" placeholder="Enter last name" required>
                        </div>
                        <div class="form-group">
                            <label>Gender</label>
                            <select name="gender" required>
                                <option value="">Select gender</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Date of Birth</label>
                            <input type="date" name="dob" required>
                        </div>
                        <div class="form-group">
                            <label>Place of Birth</label>
                            <input type="text" name="place_of_birth" placeholder="Enter place of birth" required>
                        </div>
                    </div>

                    <!-- Qaybta 2aad: Father Information -->
                    <div class="form-section-title">Father Information</div>
                    <div class="form-grid">
                        <div class="form-group">
                            <label>Father's Full Name</label>
                            <input type="text" name="father_name" placeholder="Enter father's full name" required>
                        </div>
                        <div class="form-group">
                            <label>Father's National ID (NID)</label>
                            <input type="text" name="father_nid" placeholder="Enter father NID" required>
                        </div>
                    </div>

                    <!-- Qaybta 3aad: Mother Information -->
                    <div class="form-section-title">Mother Information</div>
                    <div class="form-grid">
                        <div class="form-group">
                            <label>Mother's Full Name</label>
                            <input type="text" name="mother_name" placeholder="Enter mother's full name" required>
                        </div>
                        <div class="form-group">
                            <label>Mother's National ID (NID)</label>
                            <input type="text" name="mother_nid" placeholder="Enter mother NID" required>
                        </div>
                    </div>

                    <!-- Qaybta 4aad: Additional Information -->
                    <div class="form-section-title">Additional Information</div>
                    <div class="form-grid">
                        <div class="form-group" style="grid-column: span 2;">
                            <label>Address</label>
                            <input type="text" name="address" placeholder="Enter current address" required>
                        </div>
                        <div class="form-group">
                            <label>Phone Number</label>
                            <input type="text" name="phone_number" placeholder="Enter phone number" required>
                        </div>
                    </div>

                    <div style="text-align: right;">
                        <button type="submit" class="btn-submit">💾 Save Certificate</button>
                    </div>
                </form>
            </div>
        </main>
    </div>
</body>
</html>