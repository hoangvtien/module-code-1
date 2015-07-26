<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC (contact@vinades.vn)
 * @Copyright (C) 2015 VINADES.,JSC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate Tue, 14 Jul 2015 04:13:18 GMT
 */

if ( ! defined( 'NV_MAINFILE' ) ) die( 'Stop!!!' );

$sql_drop_module = array();
$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "";
$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_cat";

$sql_create_module = $sql_drop_module;
$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "(
  id int(11) unsigned NOT NULL AUTO_INCREMENT,
  catid smallint(4) unsigned NOT NULL,
  title varchar(255) NOT NULL,
  alias varchar(255) NOT NULL,
  description TEXT NOT NULL,
  descriptionhtml TEXT NOT NULL,
  image varchar(255) NOT NULL DEFAULT '',
  code_php text NOT NULL,
  code_php_template text NOT NULL,
  code_html text NOT NULL,
  code_css text NOT NULL,
  code_js text NOT NULL,
  adduser int(11) NOT NULL DEFAULT '0',
  addtime int(11) NOT NULL DEFAULT '0',
  viewdemo tinyint(1) unsigned NOT NULL DEFAULT '1',
  viewcount mediumint(8) unsigned NOT NULL DEFAULT '0',
  status tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (id)
) ENGINE=MyISAM";

$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_cat(
  id smallint(4) unsigned NOT NULL AUTO_INCREMENT,
  title varchar(255) NOT NULL COMMENT 'Tiêu đề',
  alias varchar(255) NOT NULL COMMENT 'Liên kết tĩnh',
  description mediumtext NOT NULL COMMENT 'Mô tả',
  keywords varchar(255) NOT NULL DEFAULT '' COMMENT 'Từ khóa',
  image varchar(255) NOT NULL DEFAULT '' COMMENT 'Hình ảnh',
  weight smallint(4) unsigned NOT NULL DEFAULT '0',
  status tinyint(1) NOT NULL COMMENT 'Trạng thái',
  PRIMARY KEY (id)
) ENGINE=MyISAM";