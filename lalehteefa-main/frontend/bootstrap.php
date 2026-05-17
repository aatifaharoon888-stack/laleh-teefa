<?php
declare(strict_types=1);

/**
 * Shared bootstrap for all frontend .php pages.
 */
$configPath = dirname(__DIR__) . '/backend/config.php';
if (is_file($configPath)) {
    require_once $configPath;
}
