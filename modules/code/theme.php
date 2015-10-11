<?php

/**
 * @Project NUKEVIET 4.x
 * @Author Hồ Ngọc Triển (hongoctrien@2mit.org)
 * @Copyright (C) 2015 Hồ Ngọc Triển. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate Tue, 14 Jul 2015 04:03:52 GMT
 */

if ( ! defined( 'NV_IS_MOD_CODE' ) ) die( 'Stop!!!' );

/**
 * nv_theme_code_main()
 *
 * @param mixed $array_data
 * @param mixed $page
 * @return
 */
function nv_theme_code_main ( $array_data, $page = '' )
{
    global $global_config, $module_name, $module_file, $lang_module, $module_config, $module_info, $op;

    $xtpl = new XTemplate( 'main.tpl', NV_ROOTDIR . '/themes/' . $module_info['template'] . '/modules/' . $module_file );
    $xtpl->assign( 'LANG', $lang_module );

	if( !empty( $array_data ) )
	{
		foreach( $array_data as $data )
		{
			$xtpl->assign( 'DATA', $data );

			if( !empty( $data['image'] ) )
			{
				$xtpl->parse( 'main.loop.image' );
			}
			else
			{
				$xtpl->parse( 'main.loop.icon' );
			}

			$xtpl->parse( 'main.loop' );
		}
	}

	if( !empty( $page ) )
	{
		$xtpl->assign( 'PAGE', $page );
		$xtpl->parse( 'main.page' );
	}

    $xtpl->parse( 'main' );
    return $xtpl->text( 'main' );
}

/**
 * nv_theme_code_viewcat()
 *
 * @param mixed $array_data
 * @param mixed $page
 * @return
 */
function nv_theme_code_viewcat( $array_data, $page = '' )
{
    global $global_config, $module_name, $module_file, $lang_module, $module_config, $module_info, $op;

    $xtpl = new XTemplate( 'viewcat.tpl', NV_ROOTDIR . '/themes/' . $module_info['template'] . '/modules/' . $module_file );
    $xtpl->assign( 'LANG', $lang_module );

	if( !empty( $array_data ) )
	{
		$data = nv_theme_code_main( $array_data, $page );
		$xtpl->assign( 'DATA', $data );
	}

    $xtpl->parse( 'main' );
    return $xtpl->text( 'main' );
}

/**
 * nv_theme_code_detail()
 *
 * @param mixed $array_data
 * @return
 */
function nv_theme_code_detail ( $array_data )
{
    global $global_config, $module_name, $module_file, $lang_module, $module_config, $module_info, $op;

    $xtpl = new XTemplate( $op . '.tpl', NV_ROOTDIR . '/themes/' . $module_info['template'] . '/modules/' . $module_file );
    $xtpl->assign( 'LANG', $lang_module );
    $xtpl->assign( 'ROW', $array_data );
    $xtpl->assign( 'NV_BASE_SITEURL', NV_BASE_SITEURL );
    $xtpl->assign( 'MODULE_FILE', $module_file );

	if( !empty( $array_data ) )
	{
		foreach( $array_data as $key => $value )
		{
			if( !empty( $value ) )
			{
				$xtpl->parse( 'main.tabs.' . $key );
			}
		}
		$xtpl->parse( 'main.tabs' );
		$xtpl->parse( 'main.tabs_content' );
	}

    $xtpl->parse( 'main' );
    return $xtpl->text( 'main' );
}

function nv_build_demo( $array_data )
{
	global $db, $nv_Request, $module_name, $module_upload, $op, $my_footer;

	$contents = '';

	if( !empty( $array_data['code_html'] ) and !file_exists( NV_ROOTDIR . '/' . NV_FILES_DIR . '/' . $module_upload . '/' . $array_data['alias'] . '-' . $array_data['id'] . '.tpl' ) )
	{
		file_put_contents( NV_ROOTDIR . '/' . NV_FILES_DIR . '/' . $module_upload . '/' . $array_data['alias'] . '-' . $array_data['id'] . '.tpl', $array_data['code_html_unhtml'] );
	}

	if( !empty( $array_data['code_css'] ) )
	{
		$contents .= '<style type="text/css">' . $array_data['code_css_unhtml'] . '</style>';
	}

	if( !empty( $array_data['code_js'] ) )
	{
		$contents .= '<script type="text/javascript">var id=' . $array_data['id'] .  '</script>';
		$my_footer .= '<script type="text/javascript">' . $array_data['code_js_unhtml'] . '</script>';
	}

	if( !empty( $array_data['code_php_template'] ) )
	{
		$xtpl = new XTemplate( $array_data['alias'] . '-' . $array_data['id'] . '.tpl', NV_ROOTDIR . '/' . NV_FILES_DIR . '/' . $module_upload );
		$xtpl->assign( 'ROW', $array_data );
	}

	if( !empty( $array_data['code_php'] ) )
	{
		$array_data['code_php_unhtml'] = str_replace( '<?php', '', $array_data['code_php_unhtml'] );
		echo eval( $array_data['code_php_unhtml'] );
	}

	if( !empty( $array_data['code_php_template'] ) )
	{
		$array_data['code_php_template_unhtml'] = str_replace( '<?php', '', $array_data['code_php_template_unhtml'] );
		echo eval( $array_data['code_php_template_unhtml'] );
	}
	elseif( !empty( $array_data['code_html'] ) )
	{
		$contents .= $array_data['code_html_unhtml'];
	}

	return $contents;
}