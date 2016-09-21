<?php

/**
 * @Project NUKEVIET 4.x
 * @Author Hồ Ngọc Triển (hongoctrien@2mit.org)
 * @Copyright (C) 2015 Hồ Ngọc Triển. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate Tue, 14 Jul 2015 04:03:52 GMT
 */
if (! defined('NV_ADMIN') or ! defined('NV_MAINFILE') or ! defined('NV_IS_MODADMIN'))
    die('Stop!!!');

define('NV_IS_FILE_ADMIN', true);
require_once NV_ROOTDIR . '/modules/' . $module_file . '/global.functions.php';

$allow_func = array(
    'main',
    'config',
    'content',
    'cat',
    'sources',
    'sourceajax',
    'list_source',
    'del_source'
);

/**
 * nv_show_sources_list()
 *
 * @return
 *
 */
function nv_show_sources_list()
{
    global $db, $lang_module, $lang_global, $module_name, $module_data, $nv_Request, $module_file, $global_config;
    
    $num = $db->query('SELECT COUNT(*) FROM ' . NV_PREFIXLANG . '_' . $module_data . '_sources')->fetchColumn();
    $base_url = NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_data . '&amp;' . NV_OP_VARIABLE . '=sources';
    $num_items = ($num > 1) ? $num : 1;
    $per_page = 15;
    $page = $nv_Request->get_int('page', 'get', 1);
    
    $xtpl = new XTemplate('sources_list.tpl', NV_ROOTDIR . '/themes/' . $global_config['module_theme'] . '/modules/' . $module_file);
    $xtpl->assign('LANG', $lang_module);
    $xtpl->assign('GLANG', $lang_global);
    
    if ($num > 0) {
        $db->sqlreset()
            ->select('*')
            ->from(NV_PREFIXLANG . '_' . $module_data . '_sources')
            ->order('weight')
            ->limit($per_page)
            ->offset(($page - 1) * $per_page);
        
        $result = $db->query($db->sql());
        while ($row = $result->fetch()) {
            $xtpl->assign('ROW', array(
                'sourceid' => $row['sourceid'],
                'title' => $row['title'],
                'link' => $row['link'],
                'url_edit' => NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=sources&amp;sourceid=' . $row['sourceid'] . '#edit'
            ));
            
            for ($i = 1; $i <= $num; ++ $i) {
                $xtpl->assign('WEIGHT', array(
                    'key' => $i,
                    'title' => $i,
                    'selected' => $i == $row['weight'] ? ' selected="selected"' : ''
                ));
                $xtpl->parse('main.loop.weight');
            }
            
            $xtpl->parse('main.loop');
        }
        $result->closeCursor();
        
        $generate_page = nv_generate_page($base_url, $num_items, $per_page, $page);
        if (! empty($generate_page)) {
            $xtpl->assign('GENERATE_PAGE', $generate_page);
            $xtpl->parse('main.generate_page');
        }
        
        $xtpl->parse('main');
        $contents = $xtpl->text('main');
    } else {
        $contents = '&nbsp;';
    }
    
    return $contents;
}

/**
 * nv_fix_source()
 *
 * @return
 *
 */
function nv_fix_source()
{
    global $db, $module_data;
    
    $sql = 'SELECT sourceid FROM ' . NV_PREFIXLANG . '_' . $module_data . '_sources ORDER BY weight ASC';
    $result = $db->query($sql);
    $weight = 0;
    while ($row = $result->fetch()) {
        ++ $weight;
        $sql = 'UPDATE ' . NV_PREFIXLANG . '_' . $module_data . '_sources SET weight=' . $weight . ' WHERE sourceid=' . intval($row['sourceid']);
        $db->query($sql);
    }
    $result->closeCursor();
}