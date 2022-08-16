<?php
/**
 * Common file of the module included on all pages of the module
 *
 * @copyright	Steve Kenow
 * @license		http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License (GPL)
 * @since		1.0
 * @author		Steve Kenow <skenow@impresscms.org>
 * @package		analytics
 */

defined("ICMS_ROOT_PATH") or die("ICMS root path not defined");

if(!defined("ANALYTICS_DIRNAME"))		define("ANALYTICS_DIRNAME", $modversion['dirname'] = basename(dirname(__DIR__)));
if(!defined("ANALYTICS_URL"))			define("ANALYTICS_URL", ICMS_URL.'/modules/'.ANALYTICS_DIRNAME.'/');
if(!defined("ANALYTICS_ROOT_PATH"))	define("ANALYTICS_ROOT_PATH", ICMS_ROOT_PATH.'/modules/'.ANALYTICS_DIRNAME.'/');
if(!defined("ANALYTICS_IMAGES_URL"))	define("ANALYTICS_IMAGES_URL", ANALYTICS_URL.'images/');
if(!defined("ANALYTICS_ADMIN_URL"))	define("ANALYTICS_ADMIN_URL", ANALYTICS_URL.'admin/');

// Include the common language file of the module
icms_loadLanguageFile('analytics', 'common');

include_once ANALYTICS_ROOT_PATH . "include/functions.php";

// Creating the module object to make it available throughout the module
$analyticsModule = icms_getModuleInfo(ANALYTICS_DIRNAME);
if (is_object($analyticsModule)){
	$analytics_moduleName = $analyticsModule->getVar('name');
}

// Find if the user is admin of the module and make this info available throughout the module
$analytics_isAdmin = icms_userIsAdmin(ANALYTICS_DIRNAME);

// Creating the module config array to make it available throughout the module
$analyticsConfig = icms_getModuleConfig(ANALYTICS_DIRNAME);

// creating the icmsPersistableRegistry to make it available throughout the module
global $icmsPersistableRegistry;
$icmsPersistableRegistry = icms_ipf_registry_Handler::getInstance();

