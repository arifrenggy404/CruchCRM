<?php
/*******************************************************************************
 *
 *  filename    : Include/Config.php
 *  website     : https://churchcrm.io
 *  description : ChurchCRM Configuration (Docker & Railway friendly)
 *
 ******************************************************************************/

$sSERVERNAME = getenv('MYSQLHOST') ?: getenv('DB_SERVER_NAME') ?: 'localhost';
$dbPort = getenv('MYSQLPORT') ?: getenv('DB_SERVER_PORT') ?: '3306';
$sUSER = getenv('MYSQLUSER') ?: getenv('DB_USER') ?: 'root';
$sPASSWORD = getenv('MYSQLPASSWORD') ?: getenv('DB_PASSWORD') ?: '';
$sDATABASE = getenv('MYSQLDATABASE') ?: getenv('DB_NAME') ?: 'churchcrm';
$sRootPath = getenv('ROOT_PATH') ?: '';

$primaryUrl = getenv('PRIMARY_URL');
if (empty($primaryUrl)) {
    $railwayDomain = getenv('RAILWAY_PUBLIC_DOMAIN');
    if (!empty($railwayDomain)) {
        $primaryUrl = 'https://' . $railwayDomain . '/';
    } else {
        $primaryUrl = 'http://localhost:8080/';
    }
}
// Ensure trailing slash
if (substr($primaryUrl, -1) !== '/') {
    $primaryUrl .= '/';
}
$URL[0] = $primaryUrl;

error_reporting(E_ERROR);
require_once(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'LoadConfigs.php');
