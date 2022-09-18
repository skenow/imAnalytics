<?php
/**
 * Admin page to manage engines
 *
 * List, add, edit and delete engine objects
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
 * @param int $engine_id Engineid to be edited
 */
function editengine($engine_id = 0) {
	global $analytics_engine_handler, $icmsModule, $icmsAdminTpl;

	$engineObj = $analytics_engine_handler->get($engine_id);

	if (!$engineObj->isNew()) {
		$icmsModule->displayAdminMenu(1, _AM_ANALYTICS_ENGINES . " > " . _CO_ICMS_EDITING);
		$sform = $engineObj->getForm(_AM_ANALYTICS_ENGINE_EDIT, 'addengine');
		$sform->assign($icmsAdminTpl);

	} else {
		$icmsModule->displayAdminMenu(1, _AM_ANALYTICS_ENGINES . " > " . _CO_ICMS_CREATINGNEW);
		$sform = $engineObj->getForm(_AM_ANALYTICS_ENGINE_CREATE, 'addengine');
		$sform->assign($icmsAdminTpl);

	}
	$icmsAdminTpl->display('db:analytics_admin_engine.html');
}

include_once "admin_header.php";

$analytics_engine_handler = icms_getModuleHandler('engine');
/** Use a naming convention that indicates the source of the content of the variable */
$clean_op = '';
/** Create a whitelist of valid values, be sure to use appropriate types for each value
 * Be sure to include a value for no parameter, if you have a default condition
 */
$valid_op = array ('mod','changedField','addengine','del','view','');

if (isset($_GET['op'])) $clean_op = htmlentities($_GET['op']);
if (isset($_POST['op'])) $clean_op = htmlentities($_POST['op']);

/** Again, use a naming convention that indicates the source of the content of the variable */
$clean_engine_id = isset($_GET['engine_id']) ? (int) $_GET['engine_id'] : 0 ;

/**
 * in_array() is a native PHP function that will determine if the value of the
 * first argument is found in the array listed in the second argument. Strings
 * are case sensitive and the 3rd argument determines whether type matching is
 * required
 */
if (in_array($clean_op,$valid_op,true)) {
	switch ($clean_op) {
		case "mod":
		case "changedField":

			icms_cp_header();

			editengine($clean_engine_id);
			break;
			
		case "addengine":
			$controller = new icms_ipf_Controller($analytics_engine_handler);
			$controller->storeFromDefaultForm(_AM_ANALYTICS_ENGINE_CREATED, _AM_ANALYTICS_ENGINE_MODIFIED);

			break;

		case "del":
			$controller = new icms_ipf_Controller($analytics_engine_handler);
			$controller->handleObjectDeletion();

			break;

		case "view" :
			$engineObj = $analytics_engine_handler->get($clean_engine_id);

			icms_cp_header();
			icms_adminMenu(1, _AM_ANALYTICS_ENGINE_VIEW . ' > ' . $engineObj->getVar('engine_name'));

			icms_collapsableBar('engineview', $engineObj->getVar('engine_name') . $engineObj->getEditEngineLink(), _AM_ANALYTICS_ENGINE_VIEW_DSC);

			$engineObj->displaySingleObject();

			icms_close_collapsable('engineview');

			break;

		default:

			icms_cp_header();

			$icmsModule->displayAdminMenu(1, _AM_ANALYTICS_ENGINES);

			$objectTable = new icms_ipf_view_Table($analytics_engine_handler);
			$objectTable->addColumn(new icms_ipf_view_Column('name'));

			$objectTable->addIntroButton('addengine', 'engine.php?op=mod', _AM_ANALYTICS_ENGINE_CREATE);
			$icmsAdminTpl->assign('analytics_engine_table', $objectTable->fetch());
			$icmsAdminTpl->display('db:analytics_admin_engine.html');
			break;
	}
	icms_cp_footer();
}
/**
 * If you want to have a specific action taken because the user input was invalid,
 * place it at this point. Otherwise, a blank page will be displayed
 */
