<?php
/**
 * Analytics version infomation
 *
 * This file holds the configuration information of this module
 *
 * @copyright	Steve Kenow
 * @license		http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License (GPL)
 * @since		1.0
 * @author		Steve Kenow <skenow@impresscms.org>
 * @package		analytics
  */

defined("ICMS_ROOT_PATH") or die("ICMS root path not defined");

/*  General Information  */
$modversion = array(
  'name'=> _MI_ANALYTICS_MD_NAME,
  'version'=> 1.0,
  'description'=> _MI_ANALYTICS_MD_DESC,
  'author'=> "Steve Kenow",
  'credits'=> "",
  'help'=> "",
  'license'=> "GNU General Public License (GPL)",
  'official'=> 0,
  'dirname'=> basename(__DIR__),

/*  Images information  */
  'iconsmall'=> "images/icon_small.png",
  'iconbig'=> "images/icon_big.png",
  'image'=> "images/icon_big.png",

/*  Development information */
  'status_version'=> "1.0",
  'status'=> "Beta",
  'date'=> "Unreleased",
  'author_word'=> "",

/* Contributors */
  'developer_website_url' => "www.ChristianWebResources.net",
  'developer_website_name' => "Christian Web Resources",
  'developer_email' => "skenow@impresscms.org");

$modversion['people']['developers'][] = "Steve Kenow";
//$modversion['people']['testers'][] = "";
//$modversion['people']['translators'][] = "";
//$modversion['people']['documenters'][] = "";
//$modversion['people']['other'][] = "";

/* Manual */
$modversion['manual']['wiki'][] = "";

$modversion['warning'] = _CO_ICMS_WARNING_BETA;

/* Administrative information */
$modversion['hasAdmin'] = 1;
$modversion['adminindex'] = "admin/index.php";
$modversion['adminmenu'] = "admin/menu.php";

/* Database information */
$modversion['object_items'] = array(
	'1' => 'visit',
	'2' => 'engine',
	'3' => 'browser',
	'4' => 'os',
	'5' => 'country',
);

$modversion["tables"] = icms_getTablesArray(
	$modversion['dirname'],
	$modversion['object_items']);

/* Install and update information */
$modversion['onInstall'] = "include/onupdate.inc.php";
$modversion['onUpdate'] = "include/onupdate.inc.php";
$modversion['onUninstall'] = "include/onupdate.inc.php";

/* Search information */
$modversion['hasSearch'] = 0;

/* Menu information */
$modversion['hasMain'] = 1;

/* Blocks information */
 /*
 $modversion['blocks'][1] = array(
 'file' => 'post_recent.php',
 'name' => _MI_ANALYTICS_POSTRECENT,
 'description' => _MI_ANALYTICS_POSTRECENTDSC,
 'show_func' => 'analytics_post_recent_show',
 'edit_func' => 'analytics_post_recent_edit',
 'options' => '5',
 'template' => 'analytics_post_recent.html');

 $modversion['blocks'][] = array(
 'file' => 'post_by_month.php',
 'name' => _MI_ANALYTICS_POSTBYMONTH,
 'description' => _MI_ANALYTICS_POSTBYMONTHDSC,
 'show_func' => 'analytics_post_by_month_show',
 'edit_func' => 'analytics_post_by_month_edit',
 'options' => '',
 'template' => 'analytics_post_by_month.html');
 */

/* Templates information */
$modversion['templates'][1] = array(
  'file' => 'analytics_header.html',
  'description' => _MI_ANALYTICS_MOD_HEADER);

$modversion['templates'][] = array(
  'file' => 'analytics_footer.html',
  'description' => _MI_ANALYTICS_MOD_FOOTER);

$modversion['templates'][]= array(
  'file' => 'analytics_admin_visit.html',
  'description' => _MI_ANALYTICS_VISIT_ADMIN);

$modversion['templates'][]= array(
  'file' => 'analytics_visit.html',
  'description' => _MI_ANALYTICS_VISIT);

$modversion['templates'][]= array(
  'file' => 'analytics_admin_engine.html',
  'description' => _MI_ANALYTICS_ENGINE_ADMIN);

$modversion['templates'][]= array(
  'file' => 'analytics_engine.html',
  'description' => _MI_ANALYTICS_ENGINE);

$modversion['templates'][]= array(
  'file' => 'analytics_admin_browser.html',
  'description' => _MI_ANALYTICS_BROWSER_ADMIN);

$modversion['templates'][]= array(
  'file' => 'analytics_browser.html',
  'description' => _MI_ANALYTICS_BROWSER);

$modversion['templates'][]= array(
  'file' => 'analytics_admin_country.html',
  'description' => _MI_ANALYTICS_COUNTRY_ADMIN);

$modversion['templates'][]= array(
  'file' => 'analytics_country.html',
  'description' => _MI_ANALYTICS_COUNTRY);

$modversion['templates'][]= array(
  'file' => 'analytics_admin_os.html',
  'description' => _MI_ANALYTICS_OS_ADMIN);

$modversion['templates'][]= array(
  'file' => 'analytics_os.html',
  'description' => _MI_ANALYTICS_OS_INDEX);

/** Preferences information */
/*
 $modversion['config'][1] = array(
 'name' => 'poster_groups',
 'title' => '_MI_ANALYTICS_POSTERGR',
 'description' => '_MI_ANALYTICS_POSTERGRDSC',
 'formtype' => 'select_multi',
 'valuetype' => 'array',
 'options' => $select_groups_options,
 'default' =>  '1');

 $modversion['config'][] = array(
 'name' => 'posts_limit',
 'title' => '_MI_ANALYTICS_LIMIT',
 'description' => '_MI_ANALYTICS_LIMITDSC',
 'formtype' => 'textbox',
 'valuetype' => 'text',
 'default' => 5);
 */

/* Comments information */
$modversion['hasComments'] = 0;

/* Notification information */
$modversion['hasNotification'] = 0;
/*
 $modversion['notification'] = array (
 'lookup_file' => 'include/notification.inc.php',
 'lookup_func' => 'analytics_notify_iteminfo');

 $modversion['notification']['category'][1] = array (
 'name' => 'global',
 'title' => _MI_ANALYTICS_GLOBAL_NOTIFY,
 'description' => _MI_ANALYTICS_GLOBAL_NOTIFY_DSC,
 'subscribe_from' => array('index.php', 'post.php'));

 $modversion['notification']['event'][1] = array(
 'name' => 'post_published',
 'category'=> 'global',
 'title'=> _MI_ANALYTICS_GLOBAL_POST_PUBLISHED_NOTIFY,
 'caption'=> _MI_ANALYTICS_GLOBAL_POST_PUBLISHED_NOTIFY_CAP,
 'description'=> _MI_ANALYTICS_GLOBAL_POST_PUBLISHED_NOTIFY_DSC,
 'mail_template'=> 'global_post_published',
 'mail_subject'=> _MI_ANALYTICS_GLOBAL_POST_PUBLISHED_NOTIFY_SBJ);
 */
