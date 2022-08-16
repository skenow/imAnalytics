<?php
/**
* English language constants commonly used in the module
*
* @copyright	Steve Kenow
* @license		http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License (GPL)
* @since		1.0
* @author		Steve Kenow <skenow@impresscms.org>
* @package		analytics
*/

defined("ICMS_ROOT_PATH") or die("ICMS root path not defined");

// visit
define("_CO_ANALYTICS_VISIT_DATETIME_START", "Date and Time of the start of the page load");
define("_CO_ANALYTICS_VISIT_DATETIME_START_DSC", " ");
define("_CO_ANALYTICS_VISIT_USER_ID", "ID of the logged in user (0 if anonymous or not logged in)");
define("_CO_ANALYTICS_VISIT_USER_ID_DSC", " ");
define("_CO_ANALYTICS_VISIT_HTTP_REFERER", "Referrer, as sent by the visitor&#039;s browser");
define("_CO_ANALYTICS_VISIT_HTTP_REFERER_DSC", " ");
define("_CO_ANALYTICS_VISIT_REMOTE_ADDR", "Remote IP address of visitor");
define("_CO_ANALYTICS_VISIT_REMOTE_ADDR_DSC", " ");
define("_CO_ANALYTICS_VISIT_REQUEST_URI", "HTTP request");
define("_CO_ANALYTICS_VISIT_REQUEST_URI_DSC", " ");
define("_CO_ANALYTICS_VISIT_QUERY_STRING", "Query portion of the HTTP request");
define("_CO_ANALYTICS_VISIT_QUERY_STRING_DSC", " ");
define("_CO_ANALYTICS_VISIT_HTTP_USER_AGENT", "User agent sent by the visitor&#039;s browser");
define("_CO_ANALYTICS_VISIT_HTTP_USER_AGENT_DSC", " ");
define("_CO_ANALYTICS_VISIT_SESSION_ID", "Session ID for the visit");
define("_CO_ANALYTICS_VISIT_SESSION_ID_DSC", " ");
define("_CO_ANALYTICS_VISIT_DATETIME_END", "Date and Time of the end of the page load");
define("_CO_ANALYTICS_VISIT_DATETIME_END_DSC", " ");
define("_CO_ANALYTICS_VISIT_HTTP_ACCEPT_LANGUAGE", "Accept-language value sent by the browser");
define("_CO_ANALYTICS_VISIT_HTTP_ACCEPT_LANGUAGE_DSC", " ");
define("_CO_ANALYTICS_VISIT_REMOTE_HOST", "Remote host sent by the visitor&#039;s browser");
define("_CO_ANALYTICS_VISIT_REMOTE_HOST_DSC", " ");
define("_CO_ANALYTICS_VISIT_REQUEST_TIME", "Date and Time the request was made");
define("_CO_ANALYTICS_VISIT_REQUEST_TIME_DSC", " ");
define("_CO_ANALYTICS_VISIT_REQUEST_METHOD", "Method");
define("_CO_ANALYTICS_VISIT_REQUEST_METHOD_DSC", "Will be get, post, head, or put");
define("_CO_ANALYTICS_VISIT_HOSTNAME", "Host Name");
define("_CO_ANALYTICS_VISIT_HOSTNAME_DSC", "The host name found by doing a reverse IP lookup");

// engine
define("_CO_ANALYTICS_ENGINE_NAME", "Name");
define("_CO_ANALYTICS_ENGINE_NAME_DSC", " Name of the search engine");
define("_CO_ANALYTICS_ENGINE_USER_AGENT", "User agent identifier");
define("_CO_ANALYTICS_ENGINE_USER_AGENT_DSC", " ");
define("_CO_ANALYTICS_ENGINE_DOMAIN", "Domain");
define("_CO_ANALYTICS_ENGINE_DOMAIN_DSC", " ");
define("_CO_ANALYTICS_ENGINE_IP_START", "Start of the IP range");
define("_CO_ANALYTICS_ENGINE_IP_START_DSC", " Start of the range of IP addresses for this bot");
define("_CO_ANALYTICS_ENGINE_IP_END", "End of IP Range");
define("_CO_ANALYTICS_ENGINE_IP_END_DSC", " End of the range of IP addresses for this bot");
define("_CO_ANALYTICS_ENGINE_QUERY_VAR", "Query Variable");
define("_CO_ANALYTICS_ENGINE_QUERY_VAR_DSC", " The variable used to indicate the search terms submitted");

// browser
define("_CO_ANALYTICS_BROWSER_NAME", "Name");
define("_CO_ANALYTICS_BROWSER_NAME_DSC", " Name of the browser");
define("_CO_ANALYTICS_BROWSER_USER_AGENT", "User agent identifier");
define("_CO_ANALYTICS_BROWSER_USER_AGENT_DSC", " ");
define("_CO_ANALYTICS_BROWSER_VERSION", "Browser version");
define("_CO_ANALYTICS_BROWSER_VERSION_DSC", " ");

// country
define("_CO_ANALYTICS_COUNTRY_NAME", "Name");
define("_CO_ANALYTICS_COUNTRY_NAME_DSC", " Name of the country");
define("_CO_ANALYTICS_COUNTRY_USER_AGENT", "Country User agent identifier");
define("_CO_ANALYTICS_COUNTRY_USER_AGENT_DSC", " ");

// operating system
define("_CO_ANALYTICS_OS_NAME", "Name");
define("_CO_ANALYTICS_OS_NAME_DSC", " Name of the operating system");
define("_CO_ANALYTICS_OS_USER_AGENT", "Operating system user agent identifier");
define("_CO_ANALYTICS_OS_USER_AGENT_DSC", " ");
define("_CO_ANALYTICS_OS_VERSION", "Operating system version");
define("_CO_ANALYTICS_OS_VERSION_DSC", " ");
