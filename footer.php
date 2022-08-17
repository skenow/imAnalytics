<?php
/**
* Footer page included at the end of each page on user side of the mdoule
*
* @copyright	Steve Kenow
* @license		http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License (GPL)
* @since		1.0
* @author		Steve Kenow <skenow@impresscms.org>
* @package		analytics
*/

defined("ICMS_ROOT_PATH") or die("ICMS root path not defined");

$icmsTpl->assign("analytics_adminpage", analytics_getModuleAdminLink());
$icmsTpl->assign("analytics_is_admin", $analytics_isAdmin);
$icmsTpl->assign('analytics_url', ANALYTICS_URL);
$icmsTpl->assign('analytics_images_url', ANALYTICS_IMAGES_URL);

$xoTheme->addStylesheet(ANALYTICS_URL . 'module' . (( defined("_ADM_USE_RTL") && _ADM_USE_RTL )
		? '_rtl'
		: '')
	.'.css');

include_once ICMS_ROOT_PATH . '/footer.php';
