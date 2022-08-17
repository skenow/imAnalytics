<?php
/**
 *
 */
defined("ICMS_ROOT_PATH") or die("ICMS root path not defined");

include_once ICMS_ROOT_PATH . '/modules/analytics/include/functions.php';

/**
 * Search engine information
 *
 */
class AnalyticsEngine extends icms_ipf_Object {

	public function __construct(&$handler) {
		parent::__construct($handler);
		
		$this->quickInitVar('engine_id', XOBJ_DTYPE_INT, TRUE);
		$this->quickInitVar('name', XOBJ_DTYPE_TXTBOX, FALSE);
		$this->quickInitVar('domain', XOBJ_DTYPE_TXTBOX, FALSE);
		$this->quickInitVar('user_agent', XOBJ_DTYPE_TXTBOX, FALSE);
		$this->quickInitVar('ip_start', XOBJ_DTYPE_INT, FALSE);
		$this->quickInitVar('ip_end', XOBJ_DTYPE_INT, FALSE);
		$this->quickInitVar('query_var', XOBJ_DTYPE_TXTBOX, FALSE);
		
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
class AnalyticsEngineHandler extends icms_ipf_Handler {
	
	public function __construct(&$db) {
		parent::__construct($db, 'engine', 'engine_id', 'name', 'domain', 'analytics');
	}
}
