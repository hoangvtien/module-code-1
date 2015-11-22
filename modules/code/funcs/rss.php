<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES (contact@vinades.vn)
 * @Copyright (C) 2014 VINADES. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate Apr 20, 2010 10:47:41 AM
 */

if( ! defined( 'NV_IS_MOD_CODE' ) ) die( 'Stop!!!' );

$channel = array();
$items = array();

$channel['title'] = $module_info['custom_title'];
$channel['link'] = NV_MY_DOMAIN . NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name;
$channel['description'] = ! empty( $module_info['description'] ) ? $module_info['description'] : $global_config['site_description'];

$catid = 0;
if( isset( $array_op[1] ) )
{
	$alias_cat_url = $array_op[1];
	$cattitle = '';
	foreach( $array_cat as $catid_i => $array_cat_i )
	{
		if( $alias_cat_url == $array_cat_i['alias'] )
		{
			$catid = $catid_i;
			break;
		}
	}
}

$db->sqlreset()
	->select( 'id, title, alias, description, image, addtime' )
	->order( 'id DESC' )
	->limit( 30 );

if( ! empty( $catid ) )
{
	$channel['title'] = $module_info['custom_title'] . ' - ' . $array_cat[$catid]['title'];
	$channel['link'] = NV_MY_DOMAIN . NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $alias_cat_url;
	$channel['description'] = $array_cat[$catid]['description'];
}

$db->from( NV_PREFIXLANG . '_' . $module_data )
	->where( 'status=1 AND catid > 0' );

if( $module_info['rss'] )
{
	$result = $db->query( $db->sql() );
	while( list( $id, $title, $alias, $description, $image, $addtime ) = $result->fetch( 3 ) )
	{
		if( !empty( $image ) )
		{
			$img_url = NV_UPLOADS_REAL_DIR . '/' . $module_upload . '/' . $image;
			$image = nv_resize_crop_image( $img_url, 90, 70, $module_name );
		}
		$image = ( ! empty( $image ) ) ? '<img src="' . $image . '" width="100" align="left" border="0">' : '';

		$items[] = array(
			'title' => $title,
			'link' => NV_MY_DOMAIN . NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '/' . $alias . '-' . $id, //
			'guid' => $module_name . '_' . $id,
			'description' => $image . $description,
			'pubdate' => $addtime
		);
	}
}
nv_rss_generate( $channel, $items );
die();