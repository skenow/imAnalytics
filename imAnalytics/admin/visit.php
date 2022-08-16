<?php
/**
 * Admin page to manage visits
 *
 * List, add, edit and delete visit objects
 *
 * @copyright	Steve Kenow
 * @license		http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License (GPL)
 * @since		1.0
 * @author		Steve Kenow <skenow@impresscms.org>
 * @package		analytics
 */

/**
 * Edit a Visit
 *
 * @param int $visit_id Visitid to be edited
 */
function editvisit($visit_id = 0) {
	global $analytics_visit_handler, $icmsModule, $icmsAdminTpl;

	$visitObj = $analytics_visit_handler->get($visit_id);

	if (!$visitObj->isNew()){
		$icmsModule->displayAdminMenu(0, _AM_ANALYTICS_VISITS . " > " . _CO_ICMS_EDITING);
		$sform = $visitObj->getForm(_AM_ANALYTICS_VISIT_EDIT, 'addvisit');
		$sform->assign($icmsAdminTpl);

	} else {
		$icmsModule->displayAdminMenu(0, _AM_ANALYTICS_VISITS . " > " . _CO_ICMS_CREATINGNEW);
		$sform = $visitObj->getForm(_AM_ANALYTICS_VISIT_CREATE, 'addvisit');
		$sform->assign($icmsAdminTpl);

	}
	$icmsAdminTpl->display('db:analytics_admin_visit.html');
}

include_once "admin_header.php";

$analytics_visit_handler = icms_getModuleHandler('visit');
/** Use a naming convention that indicates the source of the content of the variable */
$clean_op = '';
/** Create a whitelist of valid values, be sure to use appropriate types for each value
 * Be sure to include a value for no parameter, if you have a default condition
 */
$valid_op = array ('mod', 'changedField', 'del', 'view', '');

if (isset($_GET['op'])) $clean_op = htmlentities($_GET['op']);
if (isset($_POST['op'])) $clean_op = htmlentities($_POST['op']);

/** Again, use a naming convention that indicates the source of the content of the variable */
$clean_visit_id = isset($_GET['visit_id']) ? (int) $_GET['visit_id'] : 0 ;

/**
 * in_array() is a native PHP function that will determine if the value of the
 * first argument is found in the array listed in the second argument. Strings
 * are case sensitive and the 3rd argument determines whether type matching is
 * required
 */
if (in_array($clean_op, $valid_op, TRUE)){
	switch ($clean_op) {
		case "mod":
		case "changedField":

			icms_cp_header();

			editvisit($clean_visit_id);
			break;

		case "del":
			$controller = new icms_ipf_Controller($analytics_visit_handler);
			$controller->handleObjectDeletion();

			break;

		case "view" :
			$visitObj = $analytics_visit_handler->get($clean_visit_id);

			icms_cp_header();
			icms_adminMenu(1, _AM_ANALYTICS_VISIT_VIEW . ' > ' . $visitObj->getVar('visit_name'));

			icms_collapsableBar('visitview', $visitObj->getVar('visit_name') . $visitObj->getEditVisitLink(), _AM_ANALYTICS_VISIT_VIEW_DSC);

			$visitObj->displaySingleObject();

			icms_close_collapsable('visitview');

			break;

		default:
			icms_cp_header();

			$icmsModule->displayAdminMenu(0, _AM_ANALYTICS_VISITS);

			$objectTable = new icms_ipf_view_Table($analytics_visit_handler);
			$objectTable->addColumn(new icms_ipf_view_Column('datetime_start'));
			$objectTable->addColumn(new icms_ipf_view_Column('request_uri'));
			$objectTable->addColumn(new icms_ipf_view_Column('remote_addr'));
			$objectTable->setDefaultSort('datetime_start');
			$objectTable->setDefaultOrder('DESC');

			$icmsAdminTpl->assign('analytics_visit_table', $objectTable->fetch());
			$icmsAdminTpl->display('db:analytics_admin_visit.html');
			break;
	}
	icms_cp_footer();
}
/**
 * If you want to have a specific action taken because the user input was invalid,
 * place it at this point. Otherwise, a blank page will be displayed
 */
