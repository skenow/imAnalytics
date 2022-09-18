<?php
/**
* Country page
*
* @copyright	Steve Kenow
* @license		http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License (GPL)
* @since		1.0
* @author		Steve Kenow <skenow@impresscms.org>
* @package		analytics
*/

include_once 'header.php';

$xoopsOption['template_main'] = 'analytics_country.html';
include_once ICMS_ROOT_PATH . '/header.php';

$analytics_country_handler = icms_getModuleHandler('country');

/* Use a naming convention that indicates the source of the content of the variable */
$clean_country_id = isset($_GET['country_id']) ? (int) $_GET['country_id'] : 0 ;
$countryObj = $analytics_country_handler->get($clean_country_id);

if($countryObj && !$countryObj->isNew()) {
	// display this country
	$icmsTpl->assign('analytics_country', $countryObj->toArray());
} else {
	// list countries
	$icmsTpl->assign('analytics_title', _MD_ANALYTICS_ALL_COUNTRIES);

	$objectTable = new icms_ipf_view_Table($analytics_country_handler, $criteria, array());
	$objectTable->isForUserSide();
	$objectTable->addColumn(new icms_ipf_view_Column('name'));
	$icmsTpl->assign('analytics_country_table', $objectTable->fetch());
}

$icmsTpl->assign('analytics_module_home', analytics_getModuleName(true, true));

include_once 'footer.php';
