<?php

/**
 * @Project NUKEVIET 4.x
 * @Author Hồ Ngọc Triển (hongoctrien@2mit.org)
 * @Copyright (C) 2015 Hồ Ngọc Triển. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate Tue, 14 Jul 2015 04:03:52 GMT
 */

if ( ! defined( 'NV_SYSTEM' ) ) die( 'Stop!!!' );

define( 'NV_IS_MOD_CODE', true );
require_once NV_ROOTDIR . '/modules/' . $module_file . '/global.functions.php';

$page = 1;
$per_page = 20;
$id = 0;

if( $op == 'main' )
{
	if( sizeof( $array_op ) == 1 )
	{
		if( preg_match( '/^page\-([0-9]+)$/', ( isset( $array_op[0] ) ? $array_op[0] : '' ), $m ) )
		{
			$page = ( int )$m[1];
		}
		elseif( preg_match( '/^([a-z0-9\-]+)\-([0-9]+)$/i', $array_op[0], $m1 ) and ! preg_match( '/^page\-([0-9]+)$/', $array_op[0], $m2 ) )
		{
			$op = 'detail';
			$id = $m1[2];
		}
	}
}

$post_id = 0; // ID bài viết
$cat_id = 0; // ID chủ đề
$alias = isset( $array_op[0] ) ? $array_op[0] : '';

foreach( $array_cat as $cat )
{
	// Xây dựng URL chủ đề
	$array_cat[$cat['id']]['link'] =  NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $cat['alias'];

	if( $alias == $cat['alias'] )
	{
		$cat_id = $cat['id'];
	}
}

$alias_url = ''; // alias bài viết
$page = 1; // Trang mặc định
$per_page = 20; // Số lượng bản ghi trên một trang

if( $op == 'main' )
{
	if( empty( $cat_id ) )
	{
		if( preg_match( '/^page\-([0-9]+)$/', ( isset( $array_op[0] ) ? $array_op[0] : '' ), $m ) )
		{
			$page = ( int )$m[1];
		}
	}
	else
	{
		if( sizeof( $array_op ) == 2 and preg_match( '/^([a-z0-9\-]+)\-([0-9]+)$/i', $array_op[1], $m1 ) and ! preg_match( '/^page\-([0-9]+)$/', $array_op[1], $m2 ) )
		{
			// Nếu thỏa mãn điều kiện này thì là chi tiết bài viết
			$op = 'viewdetail';
			$alias_url = $m1[1];
			$post_id = $m1[2];
		}
		else
		{
			if( preg_match( '/^page\-([0-9]+)$/', ( isset( $array_op[1] ) ? $array_op[1] : '' ), $m ) )
			{
				$page = ( int )$m[1];
			}
			$op = 'viewcat';
		}
	}
}