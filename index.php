<?php
/**
 * Created by PhpStorm.
 * User: archil
 * Date: 07.03.2017
 * Time: 10:07
 */

require_once 'lib/config.php';

require_once 'lib/start.php';

require_once 'lib/loader.php';

$loader = new loader;

$loader->createController();