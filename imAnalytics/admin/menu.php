<?php
/**
* Configuring the amdin side menu for the module
*
* @copyright	Steve Kenow
* @license		http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License (GPL)
* @since		1.0
* @author		Steve Kenow <skenow@impresscms.org>
* @package		analytics
*/

$adminmenu[] = array(
	'title' => _MI_ANALYTICS_VISITS,
	'link' => 'admin/visit.php',
);
$adminmenu[] = array(
	'title' => _MI_ANALYTICS_ENGINES,
	'link' => 'admin/engine.php',
);
$adminmenu[] = array(
	'title' => _MI_ANALYTICS_BROWSERS,
	'link' => 'admin/browser.php',
);
$adminmenu[] = array(
	'title' => _MI_ANALYTICS_COUNTRIES,
	'link' => 'admin/country.php',
);
$adminmenu[] = array(
	'title' => _MI_ANALYTICS_OS,
	'link' => 'admin/os.php',
);

global $icmsModule;
if (isset($icmsModule)) {

	$headermenu[] = array(
		'title' => _PREFERENCES,
		'link' => '../../system/admin.php?fct=preferences&amp;op=showmod&amp;mod=' . $icmsModule->getVar('mid'),
	);

	$headermenu[] = array(
		'title' => _CO_ICMS_GOTOMODULE,
		'link' => ICMS_URL . '/modules/analytics/'
	);

	$headermenu[] = array(
		'title' => _CO_ICMS_UPDATE_MODULE,
		'link' => ICMS_URL . '/modules/system/admin.php?fct=modulesadmin&op=update&module=' . $icmsModule->getVar('dirname'),
	);

	$headermenu[] = array(
		'title' => _MODABOUT_ABOUT,
		'link' => ICMS_URL . '/modules/analytics/admin/about.php',
	);
}
