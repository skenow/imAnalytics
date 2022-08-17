<?php
/**
* Check requirements of the module
*
* @copyright	Steve Kenow
* @license		http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License (GPL)
* @since		1.0
* @author		Steve Kenow <skenow@impresscms.org>
* @package		analytics
*/

defined("ICMS_ROOT_PATH") or die("ICMS root path not defined");

$failed_requirements = array();

/* ImpressCMS Built needs to be at lest 19 */
if (ICMS_VERSION_BUILD < 19) {
	$failed_requirements[] = _AM_ANALYTICS_REQUIREMENTS_ICMS_BUILD;
}

if (count($failed_requirements) > 0) {
	icms_cp_header();
	$icmsAdminTpl->assign('failed_requirements', $failed_requirements);
	$icmsAdminTpl->display(ANALYTICS_ROOT_PATH . 'templates/analytics_requirements.html');
	icms_cp_footer();
	exit;
}
