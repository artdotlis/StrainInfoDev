<?php

declare(strict_types=1);

namespace straininfo\server\cron\cache;

require_once dirname(__FILE__, 2) . '/../../vendor/autoload.php';

(new SearchCache())->start();
exit(0);
