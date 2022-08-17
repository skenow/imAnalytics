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
* @package		analytics*/

if (!defined("ICMS_ROOT_PATH")) die("ICMS root path not defined");

function analytics_search($queryarray, $andor, $limit, $offset, $userid)
{
/** To come soon in imBuilding...

	$analytics_post_handler = icms_getModuleHandler('post', 'analytics');
	$postsArray = $analytics_post_handler->getPostsForSearch($queryarray, $andor, $limit, $offset, $userid);

	$ret = array();

	foreach ($postsArray as $postArray) {
		$item['image'] = "images/post.png";
		$item['link'] = str_replace(ANALYTICS_URL, '', $postArray['itemUrl']);
		$item['title'] = $postArray['post_title'];
		$item['time'] = strtotime($postArray['post_published_date']);
		$item['uid'] = $postArray['post_posterid'];
		$ret[] = $item;
		unset($item);
	}
	return $ret;*/
}
