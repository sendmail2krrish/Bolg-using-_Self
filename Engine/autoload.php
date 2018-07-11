<?php
/**
 * Loads all modules created by the user.
 */

require_once 'Config/modules.php';

/**
 * Loads database configuration & class.
 */

require_once "Config/database.php";

/**
 * Loads the App. This is the core part of framework.
 */

require_once 'Framework/App.php';

/**
 * Loads the DB. This is the core part of framework.
 */

require_once 'Framework/DB.php';

/**
 * Loads the View. This is the core part of framework.
 */

require_once 'Framework/View.php';

/**
 * Loads all the exception.
 */

require_once 'Framework/Exception.php';

/**
 * Loads routes created by the user.
 */

require_once 'Framework/Route.php';

use _Self\App;
/**
 * App's object which helps to run the framework.
 */

$app = new App();

/**
 * This is run method to run the framework.
 */

$app->run();
