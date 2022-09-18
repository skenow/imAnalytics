<?php
/**
 * Gathers and records visitor events for analysis
 *
 * Place this file in <htdocs>/plugins/preloads/ after you install the Analytics module
 *
 * @copyright	Steve Kenow
 * @license		http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License (GPL)
 * @since		1.0
 * @author		Steve Kenow <skenow@impresscms.org>
 * @package		analytics
 */

/**
 * Custom methods to run during system events for gathering and recording visits and activities
 */
class IcmsPreloadAnalytics extends icms_preload_Item {
	
	static private $_http_request;
	static private $_visit;
	static private $_session_id;
	
	/**
	 * Function to be triggered at the start of the core boot process, near the beginning of include/common.php
	 *
	 * @return    void
	 */
	function eventStartCoreBoot() {
	
	}

	/**
	 * Function to be triggered at the end of the core boot process, near the end of include/common.php
	 *
	 * @return    void
	 */
	function eventFinishCoreBoot() {

		include_once ICMS_ROOT_PATH . '/modules/analytics/class/visit.php';
	//	if (class_exists('AnalyticsVisit')) {
			$this::$_visit = new AnalyticsVisit(icms_getModuleHandler('visit', 'analytics'));
			$this::$_visit->setNew();
			$this::$_visit->getRemoteInfo();
	//	}
	}

	/**
	 * Function to be triggered at the end of the output init process, in header.php after instantiation of $xoopsTpl
	 *
	 * @return    void
	 */
	function eventStartOutputInit() {
		$this::$_visit->setStart();
		$this::$_visit->store(true);
	}

	/**
	 * Function to be triggered when footer.php is called, at the beginning of the file
	 *
	 * @return    void
	 */
	function eventBeforeFooter() {
		$this::$_visit->setEnd();
		$this::$_visit->store(true);
	}

	/**
	 * Function to be triggered when calling xoops_cp_header() in include/cp_functions.php and is used to output content in the head section of the admin side
	 *
	 * @return    void
	 */
	function eventAdminHeader() {

	}

	/**
	 * Function to be triggered when calling xoops_cp_header() in include/cp_functions.php and is used to output content at the end of the head section of the admin side
	 *
	 * @return    void
	 */
	function eventAdminBeforeFooter() {

	}
	
	/**
	 * Function to be triggered when entering MyTextSanitizer::displayTarea() function
	 *
	 * The $array var is structured like this:
	 * $array[0] = $text
	 * $array[1] = $html
	 * $array[2] = $smiley
	 * $array[3] = $xcode
	 * $array[4] = $image
	 * $array[5] = $br
	 *
	 * @param array array containing parameters passed by MyTextSanitizer::displayTarea()
	 *
	 * @return    void
	 */
	function eventBeforePreviewTarea($array) {

	}

	/**
	 * Function to be triggered when exiting MyTextSanitizer::displayTarea() function
	 *
	 * The $array var is structured like this:
	 * $array[0] = $text
	 * $array[1] = $html
	 * $array[2] = $smiley
	 * $array[3] = $xcode
	 * $array[4] = $image
	 * $array[5] = $br
	 *
	 * @param array array containing parameters passed by MyTextSanitizer::displayTarea()
	 *
	 * @return    void
	 */
	function eventBeforeDisplayTarea($array) {

	}

	/**
	 * Function to be triggered when entering icms_HTMLPurifier::displayHTMLarea() function
	 *
	 * The $array var is structured like this:
	 * $array[0] = $html
	 * $array[1] = $config
	 *
	 * @param array array containing parameters passed by icms_HTMLPurifier::displayHTMLarea()
	 *
	 * @return    void
	 */
	function eventBeforedisplayHTMLarea($array) {

	}

	/**
	 * Function to be triggered when exiting icms_HTMLPurifier::displayHTMLarea() function
	 *
	 * The $array var is structured like this:
	 * $array[0] = $html
	 * $array[1] = $config
	 *
	 * @param array array containing parameters passed by icms_HTMLPurifier::displayHTMLarea()
	 *
	 * @return    void
	 */
	function eventAfterdislayHTMLarea($array) {

	}
}
