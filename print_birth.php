<?php
session_start();
// Amniga: Hubi in maamuluhu soo galay nidaamka
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

require_once 'db.php';

// Hubi in ID-ga ilmaha la soo baasay
if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "ID lama helin!";
    exit();
}

$id = intval($_GET['id']);

// Soo kaxay xogta ilmahaas gaarka ah
$stmt = $conn->prepare("SELECT * FROM birth_certificates WHERE id = :id");
$stmt->execute([':id' => $id]);
$row = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$row) {
    echo "Shahaadadan laguma arki nidaamka!";
    exit();
}
?>
<!DOCTYPE html>
<html lang="so">
<head>
    <meta charset="UTF-8">
    <title>Birth Certificate - BRT-<?php echo $row['id']; ?></title>
    <style>
        body { font-family: 'Times New Roman', serif; background: #fff; margin: 0; padding: 0; display: flex; justify-content: center; align-items: center; min-height: 100vh; }
        
        /* Jirka Shahaadada */
        .certificate-border { width: 800px; padding: 40px; border: 15px double #1d4ed8; background: #fff; position: relative; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        .certificate-inner { border: 2px solid #1d4ed8; padding: 30px; }
        
        /* Header-ka Shahaadada */
        .header { text-align: center; margin-bottom: 30px; }
        .header h1 { margin: 0; font-size: 26px; color: #0b1426; }
        .header h2 { margin: 5px 0; font-size: 18px; color: #1d4ed8; letter-spacing: 1px; }
        .header p { margin: 5px 0; font-size: 14px; color: #64748b; font-weight: bold; }
        
        /* Cinwaanka Weyn */
        .title { text-align: center; margin: 40px 0 30px 0; }
        .title h3 { font-size: 28px; margin: 0; color: #0b1426; text-transform: uppercase; letter-spacing: 2px; border-bottom: 2px solid #0b1426; display: inline-block; padding-bottom: 5px; }
        
        /* Shaxda Xogta (Data Grid) */
        .info-section { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-top: 30px; }
        .info-group { font-size: 16px; line-height: 2; color: #1e293b; }
        .info-group strong { color: #0f172a; min-width: 150px; display: inline-block; }
        
        /* Qaybta Saxeexa Hoose */
        .footer-signatures { display: flex; justify-content: space-between; margin-top: 80px; padding: 0 20px; }
        .sig-box { text-align: center; width: 200px; }
        .sig-line { border-top: 1px solid #0f172a; margin-bottom: 5px; }
        
        /* Khasab ka dhig in marka la daabacayo ay badamada is qariyan */
        @media print {
            .no-print { display: none; }
            body { background: #fff; }
            .certificate-border { box-shadow: none; margin: 0; border-color: #000; }
            .certificate-inner { border-color: #000; }
            .header h2 { color: #000; }
        }
    </style>
</head>
<body>

    <div class="certificate-border">
        <!-- Badanka Dib u noqoshada iyo Daabacaadda ee shaashadda kaliya ka muuqda -->
        <div class="no-print" style="position: absolute; top: -50px; left: 0; right: 0; display: flex; justify-content: space-between;">
            <a href="birth_records.php" style="background: #f1f5f9; color: #475569; padding: 10px 20px; text-decoration: none; border-radius: 6px; font-weight: bold; border: 1px solid #cbd5e1;">⬅️ Back to List</a>
            <button onclick="window.print()" style="background: #15803d; color: white; padding: 10px 25px; border: none; border-radius: 6px; font-weight: bold; cursor: pointer;">🖨️ Print Certificate</button>
        </div>

        <div class="certificate-inner">
            <!-- Header-ka Dawladda -->
            <div class="header">
                <span style="font-size: 40px;">🏛️</span>
                <h1>CIVIL REGISTRY DEPARTMENT</h1>
                <h2>OFFICIAL BIRTH CERTIFICATE</h2>
                <p>REPUBLIC OF SOMALILAND</p>
            </div>

            <div style="text-align: right; font-size: 14px; font-weight: bold; color: #475569;">
                Certificate No: <span style="color: #b91c1c;">SR-BRT-<?php echo sprintf('%05d', $row['id']); ?></span>
            </div>

            <div class="title">
                <h3>Certificate of Birth</h3>
            </div>

            <!-- Xogta Ilmaha iyo Waalidka -->
            <div class="info-section">
                <div class="info-group">
                    <p><strong>Child's Full Name:</strong> <?php echo htmlspecialchars($row['first_name'] . ' ' . $row['middle_name'] . ' ' . $row['last_name']); ?></p>
                    <p><strong>Gender / Jinsi:</strong> <?php echo $row['gender']; ?></p>
                    <p><strong>Date of Birth:</strong> <?php echo date('F d, Y', strtotime($row['dob'])); ?></p>
                    <p><strong>Place of Birth:</strong> <?php echo htmlspecialchars($row['place_of_birth']); ?></p>
                </div>
                <div class="info-group">
                    <p><strong>Father's Name:</strong> <?php echo htmlspecialchars($row['father_name']); ?></p>
                    <p><strong>Father's NID:</strong> <?php echo htmlspecialchars($row['father_nid']); ?></p>
                    <p><strong>Mother's Name:</strong> <?php echo htmlspecialchars($row['mother_name']); ?></p>
                    <p><strong>Mother's NID:</strong> <?php echo htmlspecialchars($row['mother_nid']); ?></p>
                </div>
            </div>

            <div style="margin-top: 40px; font-size: 15px; line-height: 1.6; text-align: justify; border-top: 1px dashed #cbd5e1; padding-top: 20px;">
                I hereby certify that the above information is a true abstract from the official records of birth registration held at the Civil Registry Department.
            </div>

            <!-- Qaybta Saxeexyada -->
            <div class="footer-signatures">
                <div class="sig-box">
                    <div class="sig-line"></div>
                    <p style="font-size: 13px; margin: 0; font-weight: bold;">Registrar Officer</p>
                    <p style="font-size: 11px; color: #64748b; margin: 0;">Date: <?php echo date('d-m-Y'); ?></p>
                </div>
                <div class="sig-box">
                    <span style="font-size: 30px; opacity: 0.2; display: block; margin-top: -30px;"> Stamp 🛡️ </span>
                    <div class="sig-line" style="margin-top: 10px;"></div>
                    <p style="font-size: 13px; margin: 0; font-weight: bold;">Official Stamp</p>
                </div>
            </div>
        </div>
    </div>

</body>
</html>