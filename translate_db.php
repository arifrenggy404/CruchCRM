<?php
/*******************************************************************************
 *
 *  filename    : translate_db.php
 *  description : Automatically translate default database list values to Indonesian
 *
 ******************************************************************************/

// Setup basic environment to load configuration
$sSERVERNAME = getenv('MYSQLHOST') ?: getenv('DB_SERVER_NAME') ?: 'localhost';
$dbPort = getenv('MYSQLPORT') ?: getenv('DB_SERVER_PORT') ?: '3306';
$sUSER = getenv('MYSQLUSER') ?: getenv('DB_USER') ?: 'root';
$sPASSWORD = getenv('MYSQLPASSWORD') ?: getenv('DB_PASSWORD') ?: '';
$sDATABASE = getenv('MYSQLDATABASE') ?: getenv('DB_NAME') ?: 'churchcrm';

try {
    $dsn = "mysql:host={$sSERVERNAME};port={$dbPort};dbname={$sDATABASE};charset=utf8";
    $pdo = new PDO($dsn, $sUSER, $sPASSWORD, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);

    echo "=== Auto-translating database default values ===\n";

    // 1. Person Classifications (lst_ID = 1)
    $classifications = [
        1 => 'Anggota',
        2 => 'Jemaat Aktif',
        3 => 'Tamu',
        4 => 'Bukan Jemaat (Staf)',
        5 => 'Bukan Jemaat'
    ];
    foreach ($classifications as $optionId => $name) {
        $stmt = $pdo->prepare("UPDATE list_lst SET lst_OptionName = ? WHERE lst_ID = 1 AND lst_OptionID = ? AND lst_OptionName IN ('Member', 'Regular Attender', 'Guest', 'Non-Attender (staff)', 'Non-Attender')");
        $stmt->execute([$name, $optionId]);
    }

    // 2. Family Roles (lst_ID = 2)
    $familyRoles = [
        1 => 'Kepala Keluarga',
        2 => 'Pasangan (Suami/Istri)',
        3 => 'Anak',
        4 => 'Kerabat Lain',
        5 => 'Bukan Kerabat'
    ];
    foreach ($familyRoles as $optionId => $name) {
        $stmt = $pdo->prepare("UPDATE list_lst SET lst_OptionName = ? WHERE lst_ID = 2 AND lst_OptionID = ? AND lst_OptionName IN ('Head of Household', 'Spouse', 'Child', 'Other Relative', 'Non Relative')");
        $stmt->execute([$name, $optionId]);
    }

    // 3. Group Types (lst_ID = 3)
    $groupTypes = [
        1 => 'Pelayanan',
        2 => 'Tim Kerja',
        3 => 'PA (Pendalaman Alkitab)',
        4 => 'Kelas Sekolah Minggu'
    ];
    foreach ($groupTypes as $optionId => $name) {
        $stmt = $pdo->prepare("UPDATE list_lst SET lst_OptionName = ? WHERE lst_ID = 3 AND lst_OptionID = ? AND lst_OptionName IN ('Ministry', 'Team', 'Bible Study', 'Sunday School Class')");
        $stmt->execute([$name, $optionId]);
    }

    echo "Database translation completed successfully!\n";
} catch (Exception $e) {
    echo "Skipping translation: " . $e->getMessage() . "\n";
}
