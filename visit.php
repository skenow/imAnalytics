<?php
/**
 * Visit page
 *
 * @copyright	Steve Kenow
 * @license		http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License (GPL)
 * @since		1.0
 * @author		Steve Kenow <skenow@impresscms.org>
 * @package		analytics
  */

include_once 'header.php';

$xoopsOption['template_main'] = 'analytics_visit.html';
include_once ICMS_ROOT_PATH . '/header.php';

$analytics_visit_handler = icms_getModuleHandler('visit');

/** Use a naming convention that indicates the source of the content of the variable */
$clean_visit_id = isset($_GET['visit_id']) ? (int) $_GET['visit_id'] : 0 ;
$visitObj = $analytics_visit_handler->get($clean_visit_id);

$icmsTpl->assign('analytics_title', _MD_ANALYTICS_ALL_VISITS);

$objectTable = new icms_ipf_view_Table($analytics_visit_handler, false, array());
$objectTable->isForUserSide();
$objectTable->addColumn(new icms_ipf_view_Column('datetime_start'));
$objectTable->addColumn(new icms_ipf_view_Column('request_uri'));
$objectTable->addColumn(new icms_ipf_view_Column('remote_addr'));
$objectTable->setDefaultSort('datetime_start');
$objectTable->setDefaultOrder('DESC');

$icmsTpl->assign('analytics_visit_table', $objectTable->fetch());

$icmsTpl->assign('analytics_module_home', analytics_getModuleName(true, true));

include_once 'footer.php';
