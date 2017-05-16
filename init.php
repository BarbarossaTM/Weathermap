<?php

/*
 * Intelligent Weathermap initialization
 *
 * @author Maximilian Wilhelm <max@rfc2324.org>
 * @copyright 2017 @BarbarossaTM
 * @license GPL
 * @package Weathermap
 *
 * This init "module" makes sure that the Weathermap will be initialized correctly
 * for use with LibreNMS. It will determine the installation directory of LibreNMS
 * and then initialize itself accordingly.
 *
 * The goal is to allow users to install the Weathermap plugin within the LibreNMS
 * html/plugins directory (which is the default) and also allow users to install a
 * Weathermap somewhere else and just symlink the installation directory into the
 * html/plugins directory.
 */

$librenms_base = '../../../';

# Valid config.php paths
$config_file_paths = array (
   '/etc/librenms/config.php',	# Designated config file path when installed by package
   '/opt/librenms/config.php',	# default installation path
   '../../../config.php',	# relativ installation path, when plugin is directly installed within LibreNMS dir
);

/*
 * Try to find and include the LibreNMS config, so we know about the LibreNMS
 * install dir.
 *
 * Include config first to get install dir, then do a full init to load
 * functions, defaults and config again to get a full picture.
 */
foreach ($config_file_paths as $path) {
	if (file_exists ($path)) {
		require ($path);
		$librenms_base = $config['install_dir'];
		break;
	}
}

$init_modules = array ('web', 'auth');
require $librenms_base . '/includes/init.php';

?>
