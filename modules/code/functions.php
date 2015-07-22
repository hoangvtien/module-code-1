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