<?php

/**
 * @Project NUKEVIET 4.x
 * @Author Hồ Ngọc Triển (hongoctrien@2mit.org)
 * @Copyright (C) 2015 Hồ Ngọc Triển. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate Tue, 14 Jul 2015 04:03:52 GMT
 */

if ( ! defined( 'NV_IS_MOD_CODE' ) ) die( 'Stop!!!' );

$page_title = $module_info['custom_title'];
$key_words = $module_info['keywords'];
$contents = '';
$_id = $nv_Request->get_int( 'id', 'get, post', $id );

$_sql = 'SELECT * FROM ' . NV_PREFIXLANG . '_' . $module_data . ' WHERE status=1 AND id=' . $_id;
$array_data = $db->query( $_sql )->fetch();

if( empty( $array_data ) )
{
	Header( 'Location: ' . nv_url_rewrite( NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name, true ) );
	die();
}

$time_set = $nv_Request->get_int( $module_data . '_' . $op . '_' . $_id, 'session' );
if( empty( $time_set ) )
{
	$nv_Request->set_Session( $module_data . '_' . $op . '_' . $_id, NV_CURRENTTIME );
	$query = 'UPDATE ' . NV_PREFIXLANG . '_' . $module_data . ' SET viewcount=viewcount+1 WHERE id=' . $_id;
	$db->query( $query );
}

$array_data['code_html'] = nv_unhtmlspecialchars( $array_data['code_html'] );
$array_data['code_css'] = nv_unhtmlspecialchars( $array_data['code_css'] );
$array_data['code_js'] = nv_unhtmlspecialchars( $array_data['code_js'] );
$array_data['code_php'] = nv_unhtmlspecialchars( $array_data['code_php'] );
$array_data['code_php_template'] = nv_unhtmlspecialchars( $array_data['code_php_template'] );

$contents .= '<h1>' . $array_data['title'] . '</h1><hr />';
$contents .= nv_build_demo( $array_data );
$contents .= nv_theme_code_detail( $array_data );

$page_title = $array_data['title'];
$description = $array_data['description'];

include NV_ROOTDIR . '/includes/header.php';
echo nv_site_theme( $contents );
include NV_ROOTDIR . '/includes/footer.php';