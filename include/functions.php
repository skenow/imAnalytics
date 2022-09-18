<?php
/**
 * Common functions used by the module
 *
 * @copyright	Steve Kenow
 * @license		http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License (GPL)
 * @since		1.0
 * @author		Steve Kenow <skenow@impresscms.org>
 * @package		analytics
 */

defined("ICMS_ROOT_PATH") or die("ICMS root path not defined");

/**
 * Get module admin link
 *
 * @todo to be move in icms core
 *
 * @param string $moduleName dirname of the module
 * @return string URL of the admin side of the module
 */

function analytics_getModuleAdminLink($moduleName='analytics') {
	global $icmsModule;
	if (!$moduleName && (isset ($icmsModule) && is_object($icmsModule))) {
		$moduleName = $icmsModule->getVar('dirname');
	}
	$ret = '';
	if ($moduleName) {
		$ret = "<a href='" . ICMS_URL . "/modules/$moduleName/admin/index.php'>" . _MD_ANALYTICS_ADMIN_PAGE . "</a>";
	}
	return $ret;
}

/**
 * @todo to be move in icms core
 */
function analytics_getModuleName($withLink = true, $forBreadCrumb = false, $moduleName = false) {
	if (!$moduleName) {
		global $icmsModule;
		$moduleName = $icmsModule->getVar('dirname');
	}
	$icmsModule = icms_getModuleInfo($moduleName);
	$icmsModuleConfig = icms_getModuleConfig($moduleName);
	if (!isset ($icmsModule)) {
		return '';
	}

	if (!$withLink) {
		return $icmsModule->getVar('name');
	} else {
		/*	    $seoMode = smart_getModuleModeSEO($moduleName);
		 if ($seoMode == 'rewrite') {
		 $seoModuleName = smart_getModuleNameForSEO($moduleName);
		 $ret = ICMS_URL . '/' . $seoModuleName . '/';
		 } elseif ($seoMode == 'pathinfo') {
		 $ret = ICMS_URL . '/modules/' . $moduleName . '/seo.php/' . $seoModuleName . '/';
		 } else {
			$ret = ICMS_URL . '/modules/' . $moduleName . '/';
			}
			*/
		$ret = ICMS_URL . '/modules/' . $moduleName . '/';
		return '<a href="' . $ret . '">' . $icmsModule->getVar('name') . '</a>';
	}
}
