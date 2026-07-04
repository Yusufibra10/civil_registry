<!DOCTYPE html>
<html lang="so">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Civil Registry Portal - Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="login-container">
        <!-- Dhinaca Bidix (Buluugga) -->
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

        <!-- Dhinaca Midig (Foomka) -->
        <div class="login-form-section">
            <div class="form-box">
                <h2>Welcome Back!</h2>
                <p>Please login to your account</p>
                
                <form action="login_process.php" method="POST">
                    <div class="input-group">
                        <label>Email Address</label>
                        <input type="email" name="email" placeholder="Enter your email" required>
                    </div>
                    
                    <div class="input-group">
                        <label>Password</label>
                        <input type="password" name="password" placeholder="Enter your password" required>
                    </div>
                    
                    <div class="form-actions">
                        <label><input type="checkbox"> Remember Me</label>
                        <a href="#">Forgot Password?</a>
                    </div>
                    
                    <button type="submit" class="btn-login">🔒 Login</button>
                    
                    <!-- LINK-GII REGISTRATION-KA OO COODHAN -->
                    <div style="text-align: center; margin-top: 25px; font-size: 14px; color: #64748b;">
                        Don't have an account? <a href="register.php" style="color: #0f4c9b; text-decoration: none; font-weight: bold;">Register here</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>