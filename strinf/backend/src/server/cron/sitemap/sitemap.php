<?php

declare(strict_types=1);

namespace straininfo\server\cron\sitemap;

require_once dirname(__FILE__, 2) . '/../../vendor/autoload.php';

(new SiteMapGen($argv[1] ?? ''))->start();
exit(0);
