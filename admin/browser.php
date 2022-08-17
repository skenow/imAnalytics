<?php
/**
 * Admin page to manage browsers
 *
 * List, add, edit and delete browser objects
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
 * @param int $browser_id Engineid to be edited
 */
function editbrowser($browser_id = 0) {
	global $analytics_browser_handler, $icmsModule, $icmsAdminTpl;

	$browserObj = $analytics_browser_handler->get($browser_id);

	if (!$browserObj->isNew()) {
		$icmsModule->displayAdminMenu(2, _AM_ANALYTICS_BROWSERS . " > " . _CO_ICMS_EDITING);
		$sform = $browserObj->getForm(_AM_ANALYTICS_BROWSER_EDIT, 'addbrowser');
		$sform->assign($icmsAdminTpl);

	} else {
		$icmsModule->displayAdminMenu(2, _AM_ANALYTICS_BROWSER . " > " . _CO_ICMS_CREATINGNEW);
		$sform = $browserObj->getForm(_AM_ANALYTICS_BROWSER_CREATE, 'addbrowser');
		$sform->assign($icmsAdminTpl);

	}
	$icmsAdminTpl->display('db:analytics_admin_browser.html');
}

include_once "admin_header.php";

$analytics_browser_handler = icms_getModuleHandler('browser');
/** Use a naming convention that indicates the source of the content of the variable */
$clean_op = '';
/** Create a whitelist of valid values, be sure to use appropriate types for each value
 * Be sure to include a value for no parameter, if you have a default condition
 */
$valid_op = array ('mod','changedField','addbrowser','del','view','');

if (isset($_GET['op'])) $clean_op = htmlentities($_GET['op']);
if (isset($_POST['op'])) $clean_op = htmlentities($_POST['op']);

/** Again, use a naming convention that indicates the source of the content of the variable */
$clean_browser_id = isset($_GET['browser_id']) ? (int) $_GET['browser_id'] : 0 ;

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

			editbrowser($clean_browser_id);
			break;
			
		case "addbrowser":
			$controller = new icms_ipf_Controller($analytics_browser_handler);
			$controller->storeFromDefaultForm(_AM_ANALYTICS_BROWSER_CREATED, _AM_ANALYTICS_BROWSER_MODIFIED);

			break;

		case "del":
			$controller = new icms_ipf_Controller($analytics_browser_handler);
			$controller->handleObjectDeletion();

			break;

		case "view" :
			$browserObj = $analytics_browser_handler->get($clean_browser_id);

			icms_cp_header();
			icms_adminMenu(1, _AM_ANALYTICS_BROWSER_VIEW . ' > ' . $browserObj->getVar('browser_name'));

			icms_collapsableBar('browserview', $browserObj->getVar('browser_name') . $browserObj->getEditEngineLink(), _AM_ANALYTICS_ENGINE_VIEW_DSC);

			$browserObj->displaySingleObject();

			icms_close_collapsable('browserview');

			break;

		default:

			icms_cp_header();

			$icmsModule->displayAdminMenu(2, _AM_ANALYTICS_BROWSERS);

			$objectTable = new icms_ipf_view_Table($analytics_browser_handler);
			$objectTable->addColumn(new icms_ipf_view_Column('name'));

			$objectTable->addIntroButton('addbrowser', 'browser.php?op=mod', _AM_ANALYTICS_BROWSER_CREATE);
			$icmsAdminTpl->assign('analytics_browser_table', $objectTable->fetch());
			$icmsAdminTpl->display('db:analytics_admin_browser.html');
			break;
	}
	icms_cp_footer();
}
/**
 * If you want to have a specific action taken because the user input was invalid,
 * place it at this point. Otherwise, a blank page will be displayed
 */
