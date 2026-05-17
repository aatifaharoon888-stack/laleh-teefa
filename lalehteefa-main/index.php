<?php
/**
 * Site entry — Railway / Apache document root.
 * Sends visitors to the frontend app (same host, shared cookies with /backend).
 */
header('Location: /frontend/index.php', true, 302);
exit;
