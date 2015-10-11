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
$cat_id = $id = 0;
$alias = isset( $array_op[0] ) ? $array_op[0] : '';
$alias_url = '';

foreach( $array_cat as $cat )
{
	$array_cat[$cat['id']]['link'] =  NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $cat['alias'];

	if( $alias == $cat['alias'] )
	{
		$cat_id = $cat['id'];
	}
}

if( $op == 'main' )
{
	if( empty( $cat_id ) )
	{
		if( preg_match( '/^page\-([0-9]+)$/', ( isset( $array_op[0] ) ? $array_op[0] : '' ), $m ) )
		{
			$page = ( int )$m[1];
		}

		if( sizeof( $array_op ) == 1 and preg_match( '/^([a-z0-9\-]+)\-([0-9]+)$/i', $array_op[0], $m1 ) and ! preg_match( '/^page\-([0-9]+)$/', $array_op[0], $m2 ) )
		{
			$op = 'detail';
			$alias_url = $m1[1];
			$id = $m1[2];
		}
	}
	else
	{
		if( preg_match( '/^page\-([0-9]+)$/', ( isset( $array_op[1] ) ? $array_op[1] : '' ), $m ) )
		{
			$page = ( int )$m[1];
		}
		$array_mod_title[] = array(
			'title' => $array_cat[$cat_id]['title'],
			'link' => ''
		);
		$op = 'viewcat';
	}
}

function nv_resize_crop_image( $img_path, $width, $height, $module_name = '', $id = 0 )
{
	$new_img_path = '';

	if( file_exists( $img_path ) )
	{
		$imginfo = nv_is_image( $img_path );
		$basename = basename( $img_path );
		if( $imginfo['width'] > $width or $imginfo['height'] > $height )
		{
			$basename = preg_replace( '/(.*)(\.[a-zA-Z]+)$/', $module_name . '_' . $id . '_\1_' . $width . '-' . $height . '\2', $basename );
			if( file_exists( NV_ROOTDIR . '/' . NV_TEMP_DIR . '/' . $basename ) )
			{
				$new_img_path = NV_BASE_SITEURL . NV_TEMP_DIR . '/' . $basename;
			}
			else
			{
				$img_path = new image( $img_path, NV_MAX_WIDTH, NV_MAX_HEIGHT );

				$thumb_width = $width;
				$thumb_height = $height;
				$maxwh = max( $thumb_width, $thumb_height );
				if( $img_path->fileinfo['width'] > $img_path->fileinfo['height'] )
				{
					$width = 0;
					$height = $maxwh;
				}
				else
				{
					$width = $maxwh;
					$height = 0;
				}

				$img_path->resizeXY( $width, $height );
				$img_path->cropFromCenter( $thumb_width, $thumb_height );
				$img_path->save( NV_ROOTDIR . '/' . NV_TEMP_DIR, $basename );
				if( file_exists( NV_ROOTDIR . '/' . NV_TEMP_DIR . '/' . $basename ) )
				{
					$new_img_path = NV_BASE_SITEURL . NV_TEMP_DIR . '/' . $basename;
				}
			}
		}
	}
	return $new_img_path;
}