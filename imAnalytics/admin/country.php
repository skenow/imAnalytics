<?php
/**
 * Admin page to manage countries
 *
 * List, add, edit and delete country objects
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
 * @param int $country_id Engineid to be edited
 */
function editcountry($country_id = 0) {
	global $analytics_country_handler, $icmsModule, $icmsAdminTpl;

	$countryObj = $analytics_country_handler->get($country_id);

	if (!$countryObj->isNew()) {
		$icmsModule->displayAdminMenu(3, _AM_ANALYTICS_COUNTRIES . " > " . _CO_ICMS_EDITING);
		$sform = $countryObj->getForm(_AM_ANALYTICS_COUNTRY_EDIT, 'addcountry');
		$sform->assign($icmsAdminTpl);

	} else {
		$icmsModule->displayAdminMenu(3, _AM_ANALYTICS_COUNTRIES . " > " . _CO_ICMS_CREATINGNEW);
		$sform = $countryObj->getForm(_AM_ANALYTICS_COUNTRY_CREATE, 'addcountry');
		$sform->assign($icmsAdminTpl);

	}
	$icmsAdminTpl->display('db:analytics_admin_country.html');
}

include_once "admin_header.php";

$analytics_country_handler = icms_getModuleHandler('country');
/** Use a naming convention that indicates the source of the content of the variable */
$clean_op = '';
/** Create a whitelist of valid values, be sure to use appropriate types for each value
 * Be sure to include a value for no parameter, if you have a default condition
 */
$valid_op = array ('mod','changedField','addcountry','del','view','');

if (isset($_GET['op'])) $clean_op = htmlentities($_GET['op']);
if (isset($_POST['op'])) $clean_op = htmlentities($_POST['op']);

/** Again, use a naming convention that indicates the source of the content of the variable */
$clean_country_id = isset($_GET['country_id']) ? (int) $_GET['country_id'] : 0 ;

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

			editcountry($clean_country_id);
			break;
			
		case "addcountry":
			$controller = new icms_ipf_Controller($analytics_country_handler);
			$controller->storeFromDefaultForm(_AM_ANALYTICS_COUNTRY_CREATED, _AM_ANALYTICS_COUNTRY_MODIFIED);

			break;

		case "del":
			$controller = new icms_ipf_Controller($analytics_country_handler);
			$controller->handleObjectDeletion();

			break;

		case "view" :
			$countryObj = $analytics_country_handler->get($clean_country_id);

			icms_cp_header();
			icms_adminMenu(1, _AM_ANALYTICS_COUNTRY_VIEW . ' > ' . $countryObj->getVar('country_name'));

			icms_collapsableBar('countryview', $countryObj->getVar('country_name') . $countryObj->getEditEngineLink(), _AM_ANALYTICS_COUNTRY_VIEW_DSC);

			$countryObj->displaySingleObject();

			icms_close_collapsable('countryview');

			break;

		default:

			icms_cp_header();

			$icmsModule->displayAdminMenu(3, _AM_ANALYTICS_COUNTRIES);

			$objectTable = new icms_ipf_view_Table($analytics_country_handler);
			$objectTable->addColumn(new icms_ipf_view_Column('name'));

			$objectTable->addIntroButton('addcountry', 'country.php?op=mod', _AM_ANALYTICS_COUNTRY_CREATE);
			$icmsAdminTpl->assign('analytics_country_table', $objectTable->fetch());
			$icmsAdminTpl->display('db:analytics_admin_country.html');
			break;
	}
	icms_cp_footer();
}
/**
 * If you want to have a specific action taken because the user input was invalid,
 * place it at this point. Otherwise, a blank page will be displayed
 */
