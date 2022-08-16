<?php
/**
* Engine page
*
* @copyright	Steve Kenow
* @license		http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License (GPL)
* @since		1.0
* @author		Steve Kenow <skenow@impresscms.org>
* @package		analytics
*/

include_once 'header.php';

$xoopsOption['template_main'] = 'analytics_engine.html';
include_once ICMS_ROOT_PATH . '/header.php';

$analytics_engine_handler = icms_getModuleHandler('engine');

/* Use a naming convention that indicates the source of the content of the variable */
$clean_engine_id = isset($_GET['engine_id']) ? (int) $_GET['engine_id'] : 0 ;
$engineObj = $analytics_engine_handler->get($clean_engine_id);

if($engineObj && !$engineObj->isNew()) {
	// display this engine
	$icmsTpl->assign('analytics_engine', $engineObj->toArray());
} else {
	// list engines
	$icmsTpl->assign('analytics_title', _MD_ANALYTICS_ALL_ENGINES);

	$objectTable = new icms_ipf_view_Table($analytics_engine_handler, $criteria, array());
	$objectTable->isForUserSide();
	$objectTable->addColumn(new icms_ipf_view_Column('name'));
	$icmsTpl->assign('analytics_engine_table', $objectTable->fetch());
}

$icmsTpl->assign('analytics_module_home', analytics_getModuleName(TRUE, TRUE));

include_once 'footer.php';
