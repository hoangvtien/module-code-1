<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC (contact@vinades.vn)
 * @Copyright (C) 2014 VINADES.,JSC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate 2-10-2010 18:49
 */
if (! defined('NV_IS_FILE_ADMIN'))
    die('Stop!!!');

$sourceid = $nv_Request->get_int('sourceid', 'post', 0);

$contents = 'NO_' . $sourceid;
list ($sourceid, $title, $logo_old) = $db->query('SELECT sourceid, title, logo FROM ' . NV_PREFIXLANG . '_' . $module_data . '_sources WHERE sourceid=' . $sourceid)->fetch(3);
if ($sourceid > 0) {
    $result = $db->query('SELECT id FROM ' . NV_PREFIXLANG . '_' . $module_data . ' WHERE sourceid = ' . $sourceid);
    while (list($_id) = $result->fetch(3)) {
        $db->query('UPDATE ' . NV_PREFIXLANG . '_' . $module_data . ' SET sourceid = 0 WHERE id =' . $_id);
    }
    $result->closeCursor();
    $db->exec('DELETE FROM ' . NV_PREFIXLANG . '_' . $module_data . '_sources WHERE sourceid=' . $sourceid);
    
    if (! empty($logo_old)) {
        $_count = $db->query('SELECT COUNT(*) FROM ' . NV_PREFIXLANG . '_' . $module_data . '_sources WHERE sourceid != ' . $sourceid . ' AND logo =' . $db->quote(basename($logo_old)))->fetchColumn();
        if (empty($_count)) {
            @unlink(NV_ROOTDIR . '/' . NV_UPLOADS_DIR . '/' . $module_upload . '/source/' . $logo_old);
            @unlink(NV_ROOTDIR . '/' . NV_FILES_DIR . '/' . $module_upload . '/source/' . $logo_old);
            
            $_did = $db->query('SELECT did FROM ' . NV_UPLOAD_GLOBALTABLE . '_dir WHERE dirname=' . $db->quote(dirname(NV_UPLOADS_DIR . '/' . $module_upload . '/source/' . $logo_old)))->fetchColumn();
            $db->query('DELETE FROM ' . NV_UPLOAD_GLOBALTABLE . '_file WHERE did = ' . $_did . ' AND title=' . $db->quote(basename($logo_old)));
        }
    }
    nv_fix_source();
    nv_del_moduleCache($module_name);
    $contents = 'OK_' . $sourceid;
}

include NV_ROOTDIR . '/includes/header.php';
echo $contents;
include NV_ROOTDIR . '/includes/footer.php';