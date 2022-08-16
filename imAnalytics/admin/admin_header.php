<?php
/**
* Admin header file
*
* This file is included in all pages of the admin side and being so, it proceeds to a few
* common things.
*
* @copyright	Steve Kenow
* @license		http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License (GPL)
* @since		1.0
* @author		Steve Kenow <skenow@impresscms.org>
* @package		analytics
*/

include_once '../../../include/cp_header.php';

include_once ICMS_ROOT_PATH.'/modules/' . basename(dirname(__DIR__)) .'/include/common.php';
if (!defined("ANALYTICS_ADMIN_URL")) define('ANALYTICS_ADMIN_URL', ANALYTICS_URL . "admin/");
include_once ANALYTICS_ROOT_PATH . 'include/requirements.php';
