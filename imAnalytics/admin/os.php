<?php
/**
 * Admin page to manage os
 *
 * List, add, edit and delete os objects
 *
 * @copyright	Steve Kenow
 * @license		http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License (GPL)
 * @since		1.0
 * @author		Steve Kenow <skenow@impresscms.org>
 * @package		analytics
 */

/**
 * Edit a Engine
 *
 * @param int $os_id Engineid to be edited
 */
function editos($os_id = 0) {
	global $analytics_os_handler, $icmsModule, $icmsAdminTpl;

	$osObj = $analytics_os_handler->get($os_id);

	if (!$osObj->isNew()) {
		$icmsModule->displayAdminMenu(4, _AM_ANALYTICS_OS . " > " . _CO_ICMS_EDITING);
		$sform = $osObj->getForm(_AM_ANALYTICS_OS_EDIT, 'addos');
		$sform->assign($icmsAdminTpl);

	} else {
		$icmsModule->displayAdminMenu(4, _AM_ANALYTICS_OS . " > " . _CO_ICMS_CREATINGNEW);
		$sform = $osObj->getForm(_AM_ANALYTICS_OS_CREATE, 'addos');
		$sform->assign($icmsAdminTpl);

	}
	$icmsAdminTpl->display('db:analytics_admin_os.html');
}

include_once "admin_header.php";

$analytics_os_handler = icms_getModuleHandler('os');
/** Use a naming convention that indicates the source of the content of the variable */
$clean_op = '';
/** Create a whitelist of valid values, be sure to use appropriate types for each value
 * Be sure to include a value for no parameter, if you have a default condition
 */
$valid_op = array ('mod','changedField','addos','del','view','');

if (isset($_GET['op'])) $clean_op = htmlentities($_GET['op']);
if (isset($_POST['op'])) $clean_op = htmlentities($_POST['op']);

/** Again, use a naming convention that indicates the source of the content of the variable */
$clean_os_id = isset($_GET['os_id']) ? (int) $_GET['os_id'] : 0 ;

/**
 * in_array() is a native PHP function that will determine if the value of the
 * first argument is found in the array listed in the second argument. Strings
 * are case sensitive and the 3rd argument determines whether type matching is
 * required
 */
if (in_array($clean_op,$valid_op,TRUE)) {
	switch ($clean_op) {
		case "mod":
		case "changedField":

			icms_cp_header();

			editos($clean_os_id);
			break;
			
		case "addos":
			$controller = new icms_ipf_Controller($analytics_os_handler);
			$controller->storeFromDefaultForm(_AM_ANALYTICS_OS_CREATED, _AM_ANALYTICS_OS_MODIFIED);

			break;

		case "del":
			$controller = new icms_ipf_Controller($analytics_os_handler);
			$controller->handleObjectDeletion();

			break;

		case "view" :
			$osObj = $analytics_os_handler->get($clean_os_id);

			icms_cp_header();
			icms_adminMenu(1, _AM_ANALYTICS_OS_VIEW . ' > ' . $osObj->getVar('os_name'));

			icms_collapsableBar('osview', $osObj->getVar('os_name') . $osObj->getEditEngineLink(), _AM_ANALYTICS_OS_VIEW_DSC);

			$osObj->displaySingleObject();

			icms_close_collapsable('osview');

			break;

		default:

			icms_cp_header();

			$icmsModule->displayAdminMenu(4, _AM_ANALYTICS_OS);

			$objectTable = new icms_ipf_view_Table($analytics_os_handler);
			$objectTable->addColumn(new icms_ipf_view_Column('name'));

			$objectTable->addIntroButton('addos', 'os.php?op=mod', _AM_ANALYTICS_OS_CREATE);
			$icmsAdminTpl->assign('analytics_os_table', $objectTable->fetch());
			$icmsAdminTpl->display('db:analytics_admin_os.html');
			break;
	}
	icms_cp_footer();
}
/**
 * If you want to have a specific action taken because the user input was invalid,
 * place it at this point. Otherwise, a blank page will be displayed
 */
