<?php
/**
 * Author: Joris Rietveld <jorisrietveld@gmail.com>
 * Created: 16-09-2016 13:31
 */

declare(strict_types = 1);

/**
 * TODO remove global constants and create classes to easily search on the file system.
 */
define('ROOT_DIR', __DIR__ . DIRECTORY_SEPARATOR);
define('CONFIG_DIR', ROOT_DIR . 'config' . DIRECTORY_SEPARATOR);
define('WEBSITE_DIR', ROOT_DIR . 'src' . DIRECTORY_SEPARATOR . 'Website' . DIRECTORY_SEPARATOR);
define('RESOURCES_DIR', WEBSITE_DIR . 'Resources' . DIRECTORY_SEPARATOR);

require __DIR__ . DIRECTORY_SEPARATOR . "vendor/autoload.php";


$application = new JorisRietveld\Website\Core\Application();
$request = new Symfony\Component\HttpFoundation\Request();

// Handle the request and send an response
$application->handle( $request::createFromGlobals() )->send();

