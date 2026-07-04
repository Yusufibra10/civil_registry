<!DOCTYPE html>
<html lang="so">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Civil Registry Portal - Register</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="login-container">
        <!-- Dhinaca Bidix (Buluugga - la mid ah Login-ka) -->
        <div class="login-sidebar">
            <div class="logo-section">
                <div class="logo-icon">🏛️</div>
                <h2>CIVIL REGISTRY PORTAL</h2>
                <p>E-GOVERNMENT SYSTEM</p>
            </div>
            <div class="sidebar-footer">
                <p>Secure Access to Birth Certificate & National ID Services</p>
                <small>Government of Somaliland</small>
            </div>
        </div>

        <!-- Dhinaca Midig (Foomka Diiwangelinta) -->
        <div class="login-form-section">
            <div class="form-box">
                <h2>Create Account</h2>
                <p>Register a new system administrator</p>
                
                <form action="register_process.php" method="POST">
                    <div class="input-group">
                        <label>Full Name</label>
                        <input type="text" name="fullname" placeholder="Enter your full name" required>
                    </div>

                    <div class="input-group">
                        <label>Email Address</label>
                        <input type="email" name="email" placeholder="Enter your email" required>
                    </div>
                    
                    <div class="input-group">
                        <label>Password</label>
                        <input type="password" name="password" placeholder="Create a strong password" required>
                    </div>
                    
                    <button type="submit" class="btn-login">👤 Register</button>
                    
                    <div style="text-align: center; margin-top: 15px; font-size: 13px;">
                        <a href="login.php" style="color: #0f4c9b; text-decoration: none; font-weight: bold;">Already have an account? Login here</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>