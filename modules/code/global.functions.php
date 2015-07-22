<?php

/**
 * @Project NUKEVIET 4.x
 * @Author Hồ Ngọc Triển (hongoctrien@2mit.org)
 * @Copyright (C) 2015 Hồ Ngọc Triển. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate Tue, 14 Jul 2015 04:03:52 GMT
 */

if( !defined( 'NV_MAINFILE' ) )	die( 'Stop!!!' );

// Categories
$sql = 'SELECT * FROM ' . NV_PREFIXLANG . '_' . $module_data . '_cat ORDER BY weight ASC';
$array_cat = nv_db_cache( $sql, 'id', $module_name );