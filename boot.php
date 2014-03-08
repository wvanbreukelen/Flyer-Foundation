<?php

use Flyer\Components\Facade;

/**
 * Bind the Application into the container
 */

$app->instance('app', $app);

/**
 * Load the facades
 */

// Facade::clearResolvedInstances();
Facade::setFacadeApplication($app);




