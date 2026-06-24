<?php
/**
 * =====================================================
 * EMERGENCY ACCOUNT RESET - ChurchCRM
 * =====================================================
 * Masukkan kunci rahasia → semua akun dihapus →
 * akun Admin baru dibuat: username=Admin, password=changeme
 * =====================================================
 */

// ============ GANTI KUNCI RAHASIA INI ============
define('RESET_SECRET_KEY', 'gereja2024reset');
// =================================================

$error   = '';
$success = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $submitted = trim($_POST['secret_key'] ?? '');

    if ($submitted !== RESET_SECRET_KEY) {
        $error = 'Kunci rahasia salah!';
    } else {
        try {
            // Baca variabel koneksi dari Config.php
            require_once __DIR__ . '/Include/Config.php';

            // Config.php menyimpan di $sSERVERNAME, $sUSER, $sPASSWORD, $sDATABASE, $dbPort
            $host = $sSERVERNAME ?? getenv('MYSQLHOST') ?: '127.0.0.1';
            $port = $dbPort      ?? getenv('MYSQLPORT') ?: '3306';
            $user = $sUSER       ?? getenv('MYSQLUSER') ?: 'root';
            $pass = $sPASSWORD   ?? getenv('MYSQLPASSWORD') ?: '';
            $db   = $sDATABASE   ?? getenv('MYSQLDATABASE') ?: 'churchcrm';

            // Ganti 'localhost' dengan '127.0.0.1' agar pakai TCP, bukan socket
            if ($host === 'localhost') {
                $host = '127.0.0.1';
            }

            $dsn = "mysql:host={$host};port={$port};dbname={$db};charset=utf8mb4";
            $pdo = new PDO($dsn, $user, $pass, [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            ]);

            // 1. Hapus semua akun pengguna
            $pdo->exec("DELETE FROM user_usr");

            // 2. Pastikan person ID=1 ada
            $exists = $pdo->query("SELECT COUNT(*) FROM person_per WHERE per_ID = 1")->fetchColumn();
            if (!$exists) {
                $pdo->exec("INSERT INTO person_per (per_ID, per_FirstName, per_LastName, per_Gender) VALUES (1, 'Admin', 'ChurchCRM', 0)");
            }

            // 3. Hash bcrypt untuk 'changeme'
            $hash = password_hash('changeme', PASSWORD_DEFAULT);

            // 4. Buat akun Admin baru dengan akses penuh
            $pdo->prepare("
                INSERT INTO user_usr (
                    usr_per_ID, usr_Password, usr_NeedPasswordChange,
                    usr_LastLogin, usr_LoginCount, usr_FailedLogins,
                    usr_AddRecords, usr_EditRecords, usr_DeleteRecords,
                    usr_MenuOptions, usr_ManageGroups, usr_Finance,
                    usr_Notes, usr_Admin, usr_SearchLimit, usr_Style,
                    usr_showPledges, usr_showPayments, usr_showSince,
                    usr_defaultFY, usr_currentDeposit, usr_UserName, usr_EditSelf
                ) VALUES (
                    1, ?, 1,
                    NOW(), 0, 0,
                    1, 1, 1,
                    1, 1, 1,
                    1, 1, 10, 'skin-blue',
                    1, 1, '2016-01-01',
                    10, 0, 'Admin', 1
                )
            ")->execute([$hash]);

            $success = true;

            // 5. Hapus script ini demi keamanan
            @unlink(__FILE__);

        } catch (Exception $e) {
            $error = 'Error: ' . htmlspecialchars($e->getMessage());
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Reset Akun Darurat — ChurchCRM</title>
<style>
  *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
  body {
    font-family: 'Segoe UI', system-ui, sans-serif;
    background: linear-gradient(135deg, #0f0c29, #302b63, #24243e);
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 20px;
  }
  .card {
    background: rgba(255,255,255,0.06);
    backdrop-filter: blur(24px);
    border: 1px solid rgba(255,255,255,0.12);
    border-radius: 24px;
    padding: 44px 40px;
    width: 100%;
    max-width: 420px;
    color: #fff;
    box-shadow: 0 32px 64px rgba(0,0,0,0.6);
  }
  .logo { text-align: center; font-size: 56px; margin-bottom: 12px; }
  h1 { text-align: center; font-size: 20px; font-weight: 700; margin-bottom: 4px; }
  .sub { text-align:center; color:rgba(255,255,255,0.45); font-size:13px; margin-bottom:28px; }
  .warn {
    background: rgba(255,193,7,0.12);
    border: 1px solid rgba(255,193,7,0.35);
    border-radius: 12px;
    padding: 14px 16px;
    font-size: 13px;
    color: #ffc107;
    line-height: 1.6;
    margin-bottom: 24px;
  }
  .warn strong { display:block; margin-bottom:4px; font-size:14px; }
  label { display:block; font-size:13px; color:rgba(255,255,255,0.6); margin-bottom:7px; }
  input[type=password] {
    width: 100%;
    padding: 13px 16px;
    background: rgba(255,255,255,0.07);
    border: 1px solid rgba(255,255,255,0.15);
    border-radius: 12px;
    color: #fff;
    font-size: 15px;
    margin-bottom: 18px;
    outline: none;
    transition: border-color .2s, box-shadow .2s;
  }
  input[type=password]:focus {
    border-color: #7c5cbf;
    box-shadow: 0 0 0 3px rgba(124,92,191,0.25);
  }
  input::placeholder { color: rgba(255,255,255,0.25); }
  .info {
    background: rgba(255,255,255,0.04);
    border-radius: 12px;
    padding: 14px 16px;
    font-size: 13px;
    color: rgba(255,255,255,0.55);
    margin-bottom: 22px;
    line-height: 1.8;
  }
  .info strong { color: #a78bfa; }
  button {
    width: 100%;
    padding: 14px;
    background: linear-gradient(135deg, #7c5cbf, #a855f7);
    border: none;
    border-radius: 12px;
    color: #fff;
    font-size: 15px;
    font-weight: 700;
    cursor: pointer;
    letter-spacing: .4px;
    transition: transform .15s, box-shadow .15s;
  }
  button:hover { transform: translateY(-2px); box-shadow: 0 10px 24px rgba(168,85,247,0.4); }
  .alert-error {
    background: rgba(220,53,69,0.13);
    border: 1px solid rgba(220,53,69,0.35);
    border-radius: 12px;
    padding: 13px 16px;
    color: #ff8089;
    font-size: 13px;
    margin-bottom: 18px;
  }
  .success-wrap { text-align: center; }
  .success-wrap .check { font-size: 64px; margin-bottom: 12px; }
  .success-wrap h2 { font-size: 22px; margin-bottom: 6px; }
  .success-wrap p { color:rgba(255,255,255,0.5); font-size:13px; margin-bottom:20px; }
  .cred {
    background: rgba(0,0,0,0.35);
    border: 1px solid rgba(255,255,255,0.1);
    border-radius: 14px;
    padding: 18px 20px;
    text-align: left;
    margin-bottom: 18px;
  }
  .cred-row { display:flex; justify-content:space-between; align-items:center; padding: 6px 0; }
  .cred-row:not(:last-child) { border-bottom: 1px solid rgba(255,255,255,0.06); }
  .cred-label { font-size:12px; color:rgba(255,255,255,0.4); }
  .cred-value { font-family: monospace; font-size:15px; color:#a78bfa; font-weight:700; }
  .login-link {
    display:block;
    padding: 13px;
    background: rgba(255,255,255,0.08);
    border: 1px solid rgba(255,255,255,0.15);
    border-radius: 12px;
    color: #fff;
    text-decoration: none;
    font-size:14px;
    font-weight:600;
    transition: background .2s;
    margin-bottom: 14px;
  }
  .login-link:hover { background: rgba(255,255,255,0.15); }
  .deleted { color:rgba(255,255,255,0.25); font-size:11px; }
</style>
</head>
<body>
<div class="card">

<?php if ($success): ?>
  <div class="success-wrap">
    <div class="check">✅</div>
    <h2>Akun Berhasil Direset!</h2>
    <p>Semua akun lama telah dihapus.<br>Gunakan kredensial berikut untuk masuk:</p>
    <div class="cred">
      <div class="cred-row">
        <span class="cred-label">👤 Username</span>
        <span class="cred-value">Admin</span>
      </div>
      <div class="cred-row">
        <span class="cred-label">🔑 Kata Sandi</span>
        <span class="cred-value">changeme</span>
      </div>
    </div>
    <a href="/" class="login-link">🔐 Pergi ke Halaman Masuk</a>
    <p class="deleted">⚡ File ini telah otomatis dihapus dari server</p>
  </div>

<?php else: ?>
  <div class="logo">🔐</div>
  <h1>Reset Akun Darurat</h1>
  <p class="sub">ChurchCRM — Pemulihan Akses Admin</p>

  <div class="warn">
    <strong>⚠️ Peringatan!</strong>
    Tindakan ini akan <strong>MENGHAPUS SEMUA AKUN PENGGUNA</strong> yang ada,
    lalu membuat satu akun admin baru. Data jemaat &amp; keuangan tidak terpengaruh.
  </div>

  <?php if ($error): ?>
    <div class="alert-error">❌ <?= htmlspecialchars($error) ?></div>
  <?php endif; ?>

  <form method="post">
    <div class="info">
      Akun baru yang akan dibuat:<br>
      👤 Username: <strong>Admin</strong><br>
      🔑 Kata Sandi: <strong>changeme</strong>
    </div>

    <label>Kunci Rahasia</label>
    <input type="password" name="secret_key" placeholder="Masukkan kunci rahasia..." autofocus required>

    <button type="submit">🔓 Reset &amp; Buat Ulang Akun Admin</button>
  </form>
<?php endif; ?>

</div>
</body>
</html>
