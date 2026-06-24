<?php
/**
 * =====================================================
 * EMERGENCY PASSWORD RESET - ChurchCRM
 * =====================================================
 * Gunakan script ini HANYA jika Anda lupa kata sandi admin.
 *
 * CARA PAKAI:
 *   Buka di browser: https://domain-anda.com/reset-password.php
 *
 * KEAMANAN:
 *   Script ini akan OTOMATIS TERHAPUS setelah digunakan.
 *   Jika tidak digunakan, hapus file ini segera!
 * =====================================================
 */

// ==================== KONFIGURASI ====================
// Ganti nilai ini sesuai kebutuhan SEBELUM upload
define('RESET_SECRET_KEY', 'ganti-kunci-rahasia-ini-12345'); // WAJIB diubah!
define('NEW_PASSWORD',     'Admin@1234');                     // Kata sandi baru
define('TARGET_USERNAME',  'Admin');                          // Username yang direset
// =====================================================

// Keamanan: hanya bisa diakses jika ada kunci rahasia
$submitted_key = $_POST['secret_key'] ?? $_GET['key'] ?? '';
$is_confirmed  = isset($_POST['confirm']) && $_POST['confirm'] === '1';

$error   = '';
$success = '';
$newpass = '';

if ($is_confirmed) {
    if ($submitted_key !== RESET_SECRET_KEY) {
        $error = 'Kunci rahasia salah!';
    } else {
        try {
            require_once __DIR__ . '/Include/Config.php';

            $dsn  = 'mysql:host=' . $GLOBALS['adb_host'] . ';dbname=' . $GLOBALS['adb_name'] . ';charset=utf8';
            $pdo  = new PDO($dsn, $GLOBALS['adb_user'], $GLOBALS['adb_pass'], [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            ]);

            // Ambil usr_per_ID dari username
            $stmt = $pdo->prepare("SELECT usr_per_ID FROM user_usr WHERE usr_UserName = ?");
            $stmt->execute([TARGET_USERNAME]);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$row) {
                $error = 'Username "' . htmlspecialchars(TARGET_USERNAME) . '" tidak ditemukan di database!';
            } else {
                $personId   = $row['usr_per_ID'];
                $newpass    = NEW_PASSWORD;
                $bcrypt     = password_hash($newpass, PASSWORD_DEFAULT);

                $update = $pdo->prepare(
                    "UPDATE user_usr SET usr_Password = ?, usr_NeedPasswordChange = 0, usr_FailedLogins = 0 WHERE usr_UserName = ?"
                );
                $update->execute([$bcrypt, TARGET_USERNAME]);

                if ($update->rowCount() > 0) {
                    $success = true;
                    // Hapus script ini demi keamanan
                    @unlink(__FILE__);
                } else {
                    $error = 'Gagal memperbarui kata sandi. Periksa koneksi database.';
                }
            }
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
<title>Reset Kata Sandi Darurat — ChurchCRM</title>
<style>
  * { box-sizing: border-box; margin: 0; padding: 0; }
  body {
    font-family: 'Segoe UI', sans-serif;
    background: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%);
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 20px;
  }
  .card {
    background: rgba(255,255,255,0.05);
    backdrop-filter: blur(20px);
    border: 1px solid rgba(255,255,255,0.1);
    border-radius: 20px;
    padding: 40px;
    width: 100%;
    max-width: 440px;
    color: #fff;
    box-shadow: 0 25px 50px rgba(0,0,0,0.5);
  }
  .icon { font-size: 48px; text-align: center; margin-bottom: 16px; }
  h1 { text-align: center; font-size: 22px; font-weight: 700; margin-bottom: 6px; }
  .subtitle { text-align: center; color: rgba(255,255,255,0.5); font-size: 13px; margin-bottom: 28px; }
  .warning {
    background: rgba(255, 193, 7, 0.15);
    border: 1px solid rgba(255, 193, 7, 0.4);
    border-radius: 10px;
    padding: 12px 16px;
    font-size: 13px;
    color: #ffc107;
    margin-bottom: 24px;
    line-height: 1.5;
  }
  label { display: block; font-size: 13px; color: rgba(255,255,255,0.7); margin-bottom: 6px; }
  input[type=password], input[type=text] {
    width: 100%;
    padding: 12px 16px;
    background: rgba(255,255,255,0.08);
    border: 1px solid rgba(255,255,255,0.15);
    border-radius: 10px;
    color: #fff;
    font-size: 14px;
    margin-bottom: 20px;
    outline: none;
    transition: border-color .2s;
  }
  input:focus { border-color: #e94560; }
  .info-box {
    background: rgba(255,255,255,0.05);
    border-radius: 10px;
    padding: 14px 16px;
    font-size: 13px;
    color: rgba(255,255,255,0.6);
    margin-bottom: 20px;
    line-height: 1.8;
  }
  .info-box strong { color: #fff; }
  button[type=submit] {
    width: 100%;
    padding: 14px;
    background: linear-gradient(135deg, #e94560, #c0392b);
    border: none;
    border-radius: 10px;
    color: #fff;
    font-size: 15px;
    font-weight: 700;
    cursor: pointer;
    transition: transform .15s, box-shadow .15s;
    letter-spacing: .5px;
  }
  button:hover { transform: translateY(-2px); box-shadow: 0 8px 20px rgba(233,69,96,0.4); }
  .alert-error {
    background: rgba(220,53,69,0.15);
    border: 1px solid rgba(220,53,69,0.4);
    border-radius: 10px;
    padding: 12px 16px;
    color: #ff6b7a;
    font-size: 13px;
    margin-bottom: 20px;
  }
  .alert-success {
    background: rgba(40, 167, 69, 0.15);
    border: 1px solid rgba(40, 167, 69, 0.4);
    border-radius: 10px;
    padding: 20px;
    text-align: center;
    color: #5cff8a;
  }
  .alert-success h2 { font-size: 20px; margin-bottom: 12px; }
  .cred-box {
    background: rgba(0,0,0,0.3);
    border-radius: 8px;
    padding: 12px 16px;
    font-family: monospace;
    font-size: 14px;
    margin: 12px 0;
    color: #fff;
    text-align: left;
  }
  .cred-box span { color: #5cff8a; font-weight: bold; }
  .login-btn {
    display: block;
    margin-top: 16px;
    padding: 12px;
    background: rgba(255,255,255,0.1);
    border: 1px solid rgba(255,255,255,0.2);
    border-radius: 8px;
    color: #fff;
    text-decoration: none;
    font-size: 14px;
    transition: background .2s;
  }
  .login-btn:hover { background: rgba(255,255,255,0.2); }
  .deleted-notice {
    color: rgba(255,255,255,0.4);
    font-size: 11px;
    text-align: center;
    margin-top: 12px;
  }
</style>
</head>
<body>
<div class="card">
  <?php if ($success): ?>
    <div class="alert-success">
      <h2>✅ Kata Sandi Berhasil Direset!</h2>
      <p style="margin-bottom:12px;color:rgba(255,255,255,0.7);font-size:13px;">Gunakan kredensial berikut untuk masuk:</p>
      <div class="cred-box">
        👤 Username: <span><?= htmlspecialchars(TARGET_USERNAME) ?></span><br>
        🔑 Kata Sandi: <span><?= htmlspecialchars($newpass) ?></span>
      </div>
      <p style="font-size:12px;color:rgba(255,255,255,0.5);margin-top:10px;">
        ⚠️ Segera ganti kata sandi setelah masuk!
      </p>
      <a href="<?= rtrim(dirname($_SERVER['SCRIPT_NAME']), '/') ?>/" class="login-btn">
        🔐 Pergi ke Halaman Masuk
      </a>
      <p class="deleted-notice">⚡ Script reset telah otomatis dihapus dari server</p>
    </div>
  <?php else: ?>
    <div class="icon">🔐</div>
    <h1>Reset Kata Sandi Darurat</h1>
    <p class="subtitle">ChurchCRM — Pemulihan Akun Admin</p>

    <div class="warning">
      ⚠️ <strong>Peringatan Keamanan:</strong> Script ini hanya untuk kondisi darurat.
      Segera hapus file ini setelah digunakan, atau ia akan terhapus otomatis setelah berhasil.
    </div>

    <?php if ($error): ?>
      <div class="alert-error">❌ <?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form method="post">
      <input type="hidden" name="confirm" value="1">

      <div class="info-box">
        Username yang akan direset: <strong><?= htmlspecialchars(TARGET_USERNAME) ?></strong><br>
        Kata sandi baru: <strong><?= htmlspecialchars(NEW_PASSWORD) ?></strong>
      </div>

      <label>Kunci Rahasia (wajib)</label>
      <input type="password" name="secret_key" placeholder="Masukkan kunci rahasia..." autofocus required>

      <button type="submit">🔓 Reset Kata Sandi Sekarang</button>
    </form>
  <?php endif; ?>
</div>
</body>
</html>
