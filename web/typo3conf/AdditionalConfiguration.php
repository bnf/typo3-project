<?php
if (!defined('TYPO3_MODE')) {
    die('Access denied.');
}

$home = getenv("HOME");
if (!$home) {
    $user = posix_getpwuid(posix_getuid());
    $home = $user['dir'];
    unset($user);
}
if ($home . '/.my.cnf') {
    $mysql_config = parse_ini_file($home . '/.my.cnf', true);
    if (isset($mysql_config['client']['user'])) {
        $GLOBALS['TYPO3_CONF_VARS']['DB']['Connections']['Default']['user'] = $mysql_config['client']['user'];
    }
    if (isset($mysql_config['client']['password'])) {
        $GLOBALS['TYPO3_CONF_VARS']['DB']['Connections']['Default']['password'] = $mysql_config['client']['password'];
    }
}
unset($home);