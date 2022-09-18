<?php
/**
 *
 */
defined("ICMS_ROOT_PATH") or die("ICMS root path not defined");

/* @todo	allow for other paths, not a hard coded one */
include_once ICMS_ROOT_PATH . '/modules/analytics/include/functions.php';

/**
 * Search engine information
 *
 */
class AnalyticsBrowser extends icms_ipf_Object  {

	public function __construct(&$handler) {
		parent::__construct($handler);
		
		$this->quickInitVar('browser_id', XOBJ_DTYPE_INT, true);
		$this->quickInitVar('name', XOBJ_DTYPE_TXTBOX, false);
		$this->quickInitVar('user_agent', XOBJ_DTYPE_TXTBOX, false);
		$this->quickInitVar('version', XOBJ_DTYPE_TXTBOX, false);
		
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
		if ($format == 's' && in_array($key, array ())) {
			return call_user_func(array ($this,	$key));
		}
		return parent::getVar($key, $format);
	}
}

/**
 * Handler for search engines
 *
 */
class AnalyticsBrowserHandler extends icms_ipf_Handler {
	
	public function __construct(&$db) {
		parent::__construct($db, 'browser', 'browser_id', 'name', 'version', 'analytics');
	}
}
