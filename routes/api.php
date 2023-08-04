<?php

use App\Routes\api\UserRoutes;
use App\Routes\api\TaskRoutes;
use App\Routes\api\AuthRoutes;



AuthRoutes::getRoutes();
UserRoutes::getRoutes();
TaskRoutes::getRoutes();
