<?php
/**
* About page of the module
*
* @copyright	Steve Kenow
* @license		http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License (GPL)
* @since		1.0
* @author		Steve Kenow <skenow@impresscms.org>
* @package		analytics
*/

include_once "admin_header.php";

$aboutObj = new icms_ipf_About();
$aboutObj->render();
