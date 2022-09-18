<?php
/**
* browsers page
*
* @copyright	Steve Kenow
* @license		http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License (GPL)
* @since		1.0
* @author		Steve Kenow <skenow@impresscms.org>
* @package		analytics
*/

include_once 'header.php';

$xoopsOption['template_main'] = 'analytics_browser.html';
include_once ICMS_ROOT_PATH . '/header.php';

$analytics_browser_handler = icms_getModuleHandler('browser');

/* Use a naming convention that indicates the source of the content of the variable */
$clean_browser_id = isset($_GET['browser_id']) ? (int) $_GET['browser_id'] : 0 ;
$browserObj = $analytics_browser_handler->get($clean_browser_id);

if($browserObj && !$browserObj->isNew()) {
	// display this browser
	$icmsTpl->assign('analytics_browser', $browserObj->toArray());
} else {
	// list browsers
	$icmsTpl->assign('analytics_title', _MD_ANALYTICS_ALL_BROWSERS);

	$objectTable = new icms_ipf_view_Table($analytics_browser_handler, $criteria, array());
	$objectTable->isForUserSide();
	$objectTable->addColumn(new icms_ipf_view_Column('name'));
	$icmsTpl->assign('analytics_browser_table', $objectTable->fetch());
}

$icmsTpl->assign('analytics_module_home', analytics_getModuleName(true, true));

include_once 'footer.php';
