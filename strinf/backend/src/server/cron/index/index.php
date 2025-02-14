<?php

declare(strict_types=1);

namespace straininfo\server\cron\index;

require_once dirname(__FILE__, 2) . '/../../vendor/autoload.php';

(new SmartSearch())->start();
exit(0);
