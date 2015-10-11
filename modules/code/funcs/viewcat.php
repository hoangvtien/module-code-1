<?php

/**
 * @Project NUKEVIET 4.x
 * @Author Hồ Ngọc Triển (hongoctrien@2mit.org)
 * @Copyright (C) 2015 Hồ Ngọc Triển. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate Tue, 14 Jul 2015 04:03:52 GMT
 */

if ( ! defined( 'NV_IS_MOD_CODE' ) ) die( 'Stop!!!' );

$array_data = array();
$base_url = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '/' . $array_cat[$cat_id]['alias'];

// Fetch Limit
$db->sqlreset()
  ->select( 'COUNT(*)' )
  ->from( NV_PREFIXLANG . '_' . $module_data )
  ->where( 'status=1 AND catid=' . $cat_id );

$all_page = $db->query( $db->sql() )->fetchColumn();

$db->select( 'id, title, alias, description, image' )
  ->order( 'id DESC' )
  ->limit( $per_page )
  ->offset( ($page - 1) * $per_page );

$_query = $db->query( $db->sql() );
while( $row = $_query->fetch() )
{
	if( !empty( $row['image'] ) )
	{
		$img_url = NV_UPLOADS_REAL_DIR . '/' . $module_upload . '/' . $row['image'];
		$row['image'] = nv_resize_crop_image( $img_url, 90, 70, $module_name );
	}
	$row['url_view'] = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '/' . $row['alias'] . '-' . $row['id'];
	$array_data[] = $row;
}

if( $page > 1 )
{
	$page_title = $array_cat[$cat_id]['title'] . ' - ' . $lang_module['page'] . ' ' . $page;
}
else
{
	$page_title = $array_cat[$cat_id]['title'];
}

$key_words = !empty( $array_cat['keywords'] ) ? $array_cat['keywords'] : $module_info['keywords'];
$page = nv_alias_page( $page_title, $base_url, $all_page, $per_page, $page );

$contents = nv_theme_code_viewcat( $array_data, $page );

include NV_ROOTDIR . '/includes/header.php';
echo nv_site_theme( $contents );
include NV_ROOTDIR . '/includes/footer.php';