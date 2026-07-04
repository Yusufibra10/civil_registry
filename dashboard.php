<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
require_once 'db.php';

// Soo kaxay tirada guud ee shahaadooyinka dhalashada
$stmt = $conn->query("SELECT COUNT(*) FROM birth_certificates");
$total_births = $stmt->fetchColumn();

// Soo kaxay 5-tii cunug ee ugu dambaysay ee la diiwangeliyey
$stmt_recent = $conn->query("SELECT * FROM birth_certificates ORDER BY id DESC LIMIT 5");
$recent_records = $stmt_recent->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="so">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Civil Registry - Dashboard</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: sans-serif; }
        body { background: #f8fafc; }
        .dashboard-wrapper { display: flex; min-height: 100vh; }
        
        /* Sidebar CSS */
        .sidebar { background: #0b1426; width: 260px; padding: 20px; color: #94a3b8; display: flex; flex-direction: column; }
        .sidebar-brand { display: flex; align-items: center; gap: 10px; margin-bottom: 30px; padding: 10px 5px; }
        .sidebar-brand h3 { margin: 0; font-size: 16px; color: white; }
        .sidebar-menu { display: flex; flex-direction: column; gap: 5px; flex: 1; }
        .sidebar-menu a { display: flex; align-items: center; gap: 12px; padding: 12px 15px; border-radius: 8px; text-decoration: none; font-size: 15px; font-weight: 500; color: #94a3b8; transition: 0.3s; }
        .sidebar-menu a.active { background: #1d4ed8; color: white; }
        .sidebar-menu a:hover:not(.active) { background: rgba(255,255,255,0.05); color: white; }
        
        /* Main Content CSS */
        .main-content { flex: 1; padding: 30px; }
        .top-header { margin-bottom: 25px; }
        .top-header h2 { color: #0f172a; font-size: 24px; }
        
        /* Cards Design */
        .stats-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px; margin-bottom: 30px; }
        .stat-card { background: white; padding: 20px; border-radius: 12px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); display: flex; align-items: center; gap: 15px; }
        .card-icon { width: 50px; height: 50px; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 24px; }
        .card-info h3 { font-size: 24px; color: #0f172a; }
        .card-info p { color: #64748b; font-size: 13px; }
        
        /* Quick Actions Grid */
        .quick-actions { background: white; padding: 20px; border-radius: 12px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); margin-bottom: 30px; }
        .quick-actions h3 { font-size: 16px; margin-bottom: 15px; color: #1e293b; }
        .actions-grid { display: grid; grid-template-columns: repeat(6, 1fr); gap: 15px; }
        .action-item { display: flex; flex-direction: column; align-items: center; justify-content: center; background: #f8fafc; border: 1px solid #e2e8f0; padding: 15px; border-radius: 10px; text-decoration: none; color: #1e293b; text-align: center; transition: 0.3s; }
        .action-item:hover { background: #f1f5f9; border-color: #cbd5e1; }
        
        /* Recent Table CSS */
        .table-container { background: white; padding: 20px; border-radius: 12px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); }
        .table-container h3 { font-size: 16px; margin-bottom: 15px; color: #1e293b; }
        .recent-table { width: 100%; border-collapse: collapse; text-align: left; font-size: 14px; }
        .recent-table th { background: #f1f5f9; color: #475569; padding: 12px; font-weight: 600; }
        .recent-table td { padding: 12px; border-bottom: 1px solid #f1f5f9; color: #1e293b; }
    </style>
</head>
<body>
    <div class="dashboard-wrapper">
        
        <!-- SIDEBAR -->
        <aside class="sidebar">
            <div class="sidebar-brand">
                <span style="font-size: 24px;">🏛️</span>
                <div>
                    <h3>CIVIL REGISTRY</h3>
                    <small style="font-size: 10px; color: #64748b; font-weight: bold;">E-GOVERNMENT PORTAL</small>
                </div>
            </div>
            <nav class="sidebar-menu">
                <a href="dashboard.php" class="active">📊 Dashboard</a>
                
                <!-- Halkan waxaa toos loogu xiray Liiska Shahaadooyinka -->
                <a href="birth_records.php">👶 Birth Certificates</a>
                
                <a href="#">👥 Citizens</a>
                <a href="#">🪪 National ID</a>
                <a href="#">🔍 Track ID Status</a>
                <a href="#">📈 Reports</a>
                <a href="#">⚙️ Settings</a>
                <hr style="border: 0; border-top: 1px solid #1e293b; margin: 20px 0;">
                <a href="logout.php">🚪 Logout</a>
            </nav>
        </aside>

        <!-- MAIN CONTENT -->
        <main class="main-content">
            <header class="top-header">
                <h2>Welcome Back, Admin 👋</h2>
                <p style="color: #64748b; font-size: 14px;">Waa kan dulmarka guud ee nidaamka maanta.</p>
            </header>

            <!-- STATS CARDS -->
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="card-icon" style="background: #dcfce7;">👶</div>
                    <div class="card-info">
                        <h3><?php echo $total_births; ?></h3>
                        <p>Birth Certificates</p>
                    </div>
                </div>
                <div class="stat-card"><div class="card-icon" style="background: #e0f2fe;">👥</div><div class="card-info"><h3>0</h3><p>Total Citizens</p></div></div>
                <div class="stat-card"><div class="card-icon" style="background: #fef9c3;">🪪</div><div class="card-info"><h3>0</h3><p>National IDs</p></div></div>
                <div class="stat-card"><div class="card-icon" style="background: #fee2e2;">📈</div><div class="card-info"><h3>0%</h3><p>Growth Rate</p></div></div>
            </div>

            <!-- QUICK ACTIONS -->
            <div class="quick-actions">
                <h3>Quick Actions</h3>
                <div class="actions-grid">
                    <!-- Badanka Quick Action-ka isna waxaa loo weeciyey Liiska -->
                    <a href="birth_records.php" class="action-item">
                        <span style="font-size: 24px; margin-bottom: 8px;">👶</span>
                        <span style="font-size: 12px; font-weight: 600;">Birth Certificates</span>
                    </a>
                    <a href="#" class="action-item"><span style="font-size: 24px; margin-bottom: 8px;">👥</span><span style="font-size: 12px; font-weight: 600;">Add Citizen</span></a>
                    <a href="#" class="action-item"><span style="font-size: 24px; margin-bottom: 8px;">🪪</span><span style="font-size: 12px; font-weight: 600;">Issue NID</span></a>
                    <a href="#" class="action-item"><span style="font-size: 24px; margin-bottom: 8px;">🔍</span><span style="font-size: 12px; font-weight: 600;">Track Status</span></a>
                    <a href="#" class="action-item"><span style="font-size: 24px; margin-bottom: 8px;">📈</span><span style="font-size: 12px; font-weight: 600;">View Reports</span></a>
                    <a href="#" class="action-item"><span style="font-size: 24px; margin-bottom: 8px;">⚙️</span><span style="font-size: 12px; font-weight: 600;">Settings</span></a>
                </div>
            </div>

            <!-- RECENT APPLICATIONS -->
            <div class="table-container">
                <h3>Recent Applications</h3>
                <table class="recent-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Type</th>
                            <th>Date Created</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(count($recent_records) > 0): ?>
                            <?php foreach($recent_records as $row): ?>
                                <tr>
                                    <td>BRT-<?php echo $row['id']; ?></td>
                                    <td><?php echo htmlspecialchars($row['first_name'] . ' ' . $row['last_name']); ?></td>
                                    <td>Birth Certificate</td>
                                    <td><?php echo date('d-m-Y', strtotime($row['created_at'])); ?></td>
                                    <td><span style="background: #dcfce7; color: #15803d; padding: 4px 8px; border-radius: 4px; font-size: 12px; font-weight: bold;">Approved</span></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5" style="text-align: center; padding: 20px; color: #64748b;">Wax codsiyo ah weli lama soo gudbin.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </main>
    </div>
</body>
</html>