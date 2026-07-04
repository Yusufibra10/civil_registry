<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

require_once 'db.php';

// Qaybta Raadinta (Search)
$search = "";
if (isset($_GET['search'])) {
    $search = trim($_GET['search']);
    $query = $conn->prepare("SELECT * FROM birth_certificates WHERE first_name LIKE :search OR middle_name LIKE :search OR last_name LIKE :search ORDER BY id DESC");
    $query->execute([':search' => "%$search%"]);
} else {
    $query = $conn->query("SELECT * FROM birth_certificates ORDER BY id DESC");
}
$records = $query->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="so">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Birth Certificates Records</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: sans-serif; }
        body { background: #f8fafc; }
        .dashboard-wrapper { display: flex; min-height: 100vh; }
        .main-content { flex: 1; padding: 30px; background: #f8fafc; }
        .top-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px; }
        .top-header h2 { color: #0f172a; font-size: 24px; }
        
        /* Qaybta Taabalka iyo Raadinta */
        .table-container { background: white; padding: 25px; border-radius: 12px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); }
        .search-box { display: flex; gap: 10px; margin-bottom: 20px; }
        .search-box input { padding: 10px; border: 1px solid #cbd5e1; border-radius: 6px; width: 300px; outline: none; }
        .search-box button { background: #1d4ed8; color: white; border: none; padding: 10px 20px; border-radius: 6px; cursor: pointer; font-weight: bold; }
        
        /* Design-ka Taabalka */
        .records-table { width: 100%; border-collapse: collapse; text-align: left; font-size: 14px; }
        .records-table th { background: #f1f5f9; color: #475569; padding: 12px; font-weight: 600; }
        .records-table td { padding: 12px; border-bottom: 1px solid #f1f5f9; color: #1e293b; }
        
        /* Badamada Action-ka */
        .btn-action { padding: 5px 10px; border-radius: 4px; text-decoration: none; font-size: 12px; font-weight: bold; margin-right: 5px; display: inline-block; }
        .btn-print { background: #dcfce7; color: #15803d; }
        .btn-edit { background: #fef9c3; color: #a16207; }
        .btn-delete { background: #fee2e2; color: #b91c1c; }
    </style>
</head>
<body>
    <div class="dashboard-wrapper">
        
        <!-- SIDEBAR -->
        <aside class="sidebar" style="background: #0b1426; width: 260px; padding: 20px; color: #94a3b8; display: flex; flex-direction: column;">
            <div class="sidebar-brand" style="display: flex; align-items: center; gap: 10px; margin-bottom: 30px; padding: 10px 5px;">
                <span style="font-size: 24px;">🏛️</span>
                <div>
                    <h3 style="margin: 0; font-size: 16px; color: white;">CIVIL REGISTRY</h3>
                    <small style="font-size: 10px; color: #64748b; font-weight: bold;">E-GOVERNMENT PORTAL</small>
                </div>
            </div>
            <nav class="sidebar-menu" style="display: flex; flex-direction: column; gap: 5px; flex: 1;">
                <a href="dashboard.php" style="display: flex; align-items: center; gap: 12px; padding: 12px 15px; border-radius: 8px; text-decoration: none; font-size: 15px; color: #94a3b8;"><span>📊</span> Dashboard</a>
                <a href="birth_records.php" style="display: flex; align-items: center; gap: 12px; padding: 12px 15px; border-radius: 8px; text-decoration: none; font-size: 15px; background: #1d4ed8; color: white;"><span>👶</span> Birth Certificates</a>
                <a href="#" style="display: flex; align-items: center; gap: 12px; padding: 12px 15px; border-radius: 8px; text-decoration: none; font-size: 15px; color: #94a3b8;"><span>👥</span> Citizens</a>
                <a href="#" style="display: flex; align-items: center; gap: 12px; padding: 12px 15px; border-radius: 8px; text-decoration: none; font-size: 15px; color: #94a3b8;"><span>🪪</span> National ID</a>
                <hr style="border: 0; border-top: 1px solid #1e293b; margin: 20px 0;">
                <a href="logout.php" style="display: flex; align-items: center; gap: 12px; padding: 12px 15px; border-radius: 8px; text-decoration: none; font-size: 15px; color: #94a3b8; margin-top: auto;"><span>🚪</span> Logout</a>
            </nav>
        </aside>

        <!-- MAIN CONTENT -->
        <main class="main-content">
            <header class="top-header">
                <div>
                    <h2>Birth Certificate Records</h2>
                    <p style="color: #64748b; font-size: 14px;">Maamul dhammaan shahaadooyinka dhalashada ee la kaydiyey</p>
                </div>
                <a href="register_birth.php.php" style="background: #1d4ed8; color: white; padding: 10px 20px; text-decoration: none; border-radius: 6px; font-weight: bold; font-size: 14px;">+ Register New Birth</a>
            </header>

            <div class="table-container">
                <!-- Foomka Raadinta -->
                <form method="GET" class="search-box">
                    <input type="text" name="search" placeholder="Ku raadi magaca ilmaha..." value="<?php echo htmlspecialchars($search); ?>">
                    <button type="submit">Raadi</button>
                    <?php if (!empty($search)): ?>
                        <a href="birth_records.php" style="padding: 10px; color: #64748b; text-decoration: none;"></a>
                    <?php endif; ?>
                </form>

                <!-- Jadwalka Xogta -->
                <table class="records-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Magaca Ilmaha</th>
                            <th>Jinsiga</th>
                            <th>Taariikhda Dhalashada</th>
                            <th>Magaca Aabbaha</th>
                            <th>Address</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (count($records) > 0): ?>
                            <?php foreach ($records as $row): ?>
                                <tr>
                                    <td>BRT-<?php echo $row['id']; ?></td>
                                    <td style="font-weight: 600;"><?php echo htmlspecialchars($row['first_name'] . ' ' . $row['middle_name'] . ' ' . $row['last_name']); ?></td>
                                    <td><?php echo $row['gender']; ?></td>
                                    <td><?php echo date('d-m-Y', strtotime($row['dob'])); ?></td>
                                    <td><?php echo htmlspecialchars($row['father_name']); ?></td>
                                    <td><?php echo htmlspecialchars($row['address']); ?></td>
                                    <td>
                                        <a href="print_birth.php?id=<?php echo $row['id']; ?>" class="btn-action btn-print">🖨️ Print</a>
                                        <a href="#" class="btn-action btn-edit">📝 Edit</a>
                                        <a href="#" class="btn-action btn-delete" onclick="return confirm('Ma hubtaa inaad tirtirto xogtan?')">🗑️ Delete</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="7" style="text-align: center; padding: 30px; color: #64748b;">Wax xog ah lama helin.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </main>
    </div>
</body>
</html>