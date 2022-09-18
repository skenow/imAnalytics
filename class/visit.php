<?php
/**
 * Classes responsible for managing Analytics visit objects
 *
 * @copyright	Steve Kenow
 * @license		http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License (GPL)
 * @since		1.0
 * @author		Steve Kenow <skenow@impresscms.org>
 * @package		analytics
 */

defined("ICMS_ROOT_PATH") or die("ICMS root path not defined");

/* @todo	allow for other paths, not a hard coded one */
include_once ICMS_ROOT_PATH . '/modules/analytics/include/functions.php';

/**
 * Defines the AnalyticsVisit object
 *
 */
class AnalyticsVisit extends icms_ipf_Object {

	/**
	 * Constructor
	 *
	 * @param object $handler AnalyticsVisitHandler object
	 */
	public function __construct(& $handler) {
		global $icmsConfig;

		parent::__construct($handler);

		$this->quickInitVar('visit_id', XOBJ_DTYPE_INT, true);
		
		$this->quickInitVar('request_time', XOBJ_DTYPE_LTIME, false);
		$this->quickInitVar('request_method', XOBJ_DTYPE_TXTBOX, false);
		$this->quickInitVar('request_uri', XOBJ_DTYPE_TXTBOX, false);
		$this->quickInitVar('query_string', XOBJ_DTYPE_TXTBOX, false);
		$this->quickInitVar('http_referer', XOBJ_DTYPE_TXTBOX, false);
		$this->quickInitVar('http_user_agent', XOBJ_DTYPE_TXTBOX, false);
		$this->quickInitVar('http_accept_language', XOBJ_DTYPE_TXTBOX, false);
		$this->quickInitVar('remote_addr', XOBJ_DTYPE_TXTBOX, false);
		$this->quickInitVar('remote_host', XOBJ_DTYPE_TXTBOX, false);
		
		$this->quickInitVar('hostname', XOBJ_DTYPE_TXTBOX, false);
		$this->quickInitVar('datetime_start', XOBJ_DTYPE_LTIME, false);
		$this->quickInitVar('datetime_end', XOBJ_DTYPE_LTIME, false);
		$this->quickInitVar('user_id', XOBJ_DTYPE_INT, false);
		$this->quickInitVar('session_id', XOBJ_DTYPE_TXTBOX, false);

		$this->makeFieldReadOnly(array_keys($this->getVars()));
		$this->setControl('datetime_start', 'text');
		$this->setControl('datetime_end', 'text');
		$this->setControl('request_time', 'text');
	}

	/**
	 * Overriding the icms_ipf_Object::getVar method to assign a custom method on some
	 * specific fields to handle the value before returning it
	 *
	 * @param str $key key of the field
	 * @param str $format format that is requested
	 * @return mixed value of the field that is requested
	 */
	public function getVar($key, $format = 's') {
		if (in_array($key, array('request_time', 'datetime_start', 'datetime_end'))) {
            return parent::getVar($key);
		}
		if (in_array($key, array('request_uri', 'query_string', 'http_referer', 'http_user_agent', 'remote_host'))) {
			return urldecode(parent::getVar($key));
		}
		return parent::getVar($key, $format);
	}
	
	/**
	 * Gathers information from remote request and sets proper filters for them
	 *  - filter options are found at www.php.net/manual/en/filter.constants.php
	 */
	public function getRemoteInfo() {
		$filter_args = array(
			'REMOTE_ADDR' => FILTER_VALIDATE_IP,
			'REMOTE_HOST' => FILTER_SANITIZE_ENCODED,
			'REQUEST_URI' => FILTER_SANITIZE_ENCODED,
			'HTTP_REFERER' => FILTER_SANITIZE_ENCODED,
			'HTTP_ACCEPT_LANGUAGE' => FILTER_SANITIZE_STRING,
			'HTTP_METHOD' => FILTER_SANITIZE_STRING,
			'QUERY_STRING' => FILTER_SANITIZE_ENCODED,
			'HTTP_USER_AGENT' => FILTER_SANITIZE_ENCODED,
			'REQUEST_TIME' => FILTER_VALIDATE_INT,
			'REQUEST_METHOD' => FILTER_SANITIZE_STRING,
		);

		foreach (array_intersect_key($_SERVER, $filter_args) as $key=>$value) {
			$http_request[strtolower($key)] = filter_var($_SERVER[$key], $filter_args[$key]);
		}
		$this->setVars($http_request);
		// This needs to run before any page output or other headers are sent
		$session_id = icms_getCookieVar('icms_analytics', false);
		if (!$session_id) {
			// This is in case the browser is not accepting cookies. Doesn't help with bot tracking
			if (isset($_SESSION['icms_analytics'])) {
				$session_id = $_SESSION['icms_analytics'];
			} else {
				$session_id = time();
				icms_setCookieVar('icms_analytics', $session_id, time() + 3600);
				$_SERVER['icms_analytics'] = $session_id;
			}
  		}
		$this->setVar('session_id', $session_id);
		
		$hostname = gethostbyaddr($_SERVER['REMOTE_ADDR']);
		$this->setVar('hostname', $hostname);
	}
	
	/**
	 * Sets the start time of the page rendering and determines the visitor's identity
	 */
	public function setStart() {
		$user_id = $GLOBALS['icmsUser'] ? $GLOBALS['icmsUser']->getVar('uid') : 0;
		$this->setVars(array(
		    'datetime_start' => microtime(true),
		    'user_id' => $user_id,
			)
		);
	}
	
	/**
	 * Sets the end time of the page rendering
	 */
	public function setEnd() {
		$this->setVars(array('datetime_end' => microtime(true)));
	}
}

/**
 * Handles the Analytics Visit object
 */
class AnalyticsVisitHandler extends icms_ipf_Handler {

	/**
	 * Constructor
	 */
	public function __construct(& $db) {
		parent::__construct($db, 'visit', 'visit_id', 'datetime_start', 'request_uri', 'analytics');
	}
}
