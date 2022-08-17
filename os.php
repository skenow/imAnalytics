<?php
/**
* Operating system page
*
* @copyright	Steve Kenow
* @license		http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License (GPL)
* @since		1.0
* @author		Steve Kenow <skenow@impresscms.org>
* @package		analytics
*/

include_once 'header.php';

$xoopsOption['template_main'] = 'analytics_os.html';
include_once ICMS_ROOT_PATH . '/header.php';

$analytics_os_handler = icms_getModuleHandler('os');

/* Use a naming convention that indicates the source of the content of the variable */
$clean_os_id = isset($_GET['os_id']) ? (int) $_GET['os_id'] : 0 ;
$osObj = $analytics_os_handler->get($clean_os_id);

if($osObj && !$osObj->isNew()) {
	// display this os
	$icmsTpl->assign('analytics_os', $osObj->toArray());
} else {
	// list os
	$icmsTpl->assign('analytics_title', _MD_ANALYTICS_ALL_OS);

	$objectTable = new icms_ipf_view_Table($analytics_os_handler, $criteria, array());
	$objectTable->isForUserSide();
	$objectTable->addColumn(new icms_ipf_view_Column('name'));
	$icmsTpl->assign('analytics_os_table', $objectTable->fetch());
}

$icmsTpl->assign('analytics_module_home', analytics_getModuleName(TRUE, TRUE));

include_once 'footer.php';
