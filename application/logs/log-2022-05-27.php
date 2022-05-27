<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2022-05-27 05:27:33 --> Severity: error --> Exception: syntax error, unexpected 'endforeach' (T_ENDFOREACH) F:\xamp\htdocs\posmain\application\models\ShiftReports_model.php 641
ERROR - 2022-05-27 05:28:01 --> 404 Page Not Found: Payment/images
ERROR - 2022-05-27 05:28:05 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-27 05:30:00 --> Severity: error --> Exception: Call to a member function fetchForrptsales() on null F:\xamp\htdocs\posmain\application\models\ShiftReports_model.php 622
ERROR - 2022-05-27 05:31:34 --> Query error: Unknown column 'rpt_sales_mapping1' in 'where clause' - Invalid query: SELECT *
FROM `tbl_close_shift_lubes`
WHERE `rpt_sales_mapping1` = 0
AND `sales_qty` > 0
ERROR - 2022-05-27 08:39:13 --> 404 Page Not Found: User/images
ERROR - 2022-05-27 08:42:54 --> 404 Page Not Found: Payment/images
ERROR - 2022-05-27 08:43:45 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'IS NULL
AND  IS NULL' at line 3 - Invalid query: SELECT *
FROM `tbl_assigned_centres`
WHERE  IS NULL
AND  IS NULL
ERROR - 2022-05-27 08:45:53 --> Severity: error --> Exception: Call to a member function fetchSingleRowJoin() on null F:\xamp\htdocs\posmain\application\models\ShiftReports_model.php 653
ERROR - 2022-05-27 08:46:28 --> Query error: Table 'posmain.items' doesn't exist - Invalid query: SELECT *
FROM `items`
JOIN `tbl_tax_type` USING (`itemstbl_tax_typetype_id`)
WHERE `item_id` = '26'
ERROR - 2022-05-27 08:49:37 --> Query error: Unknown column 'tbl_close_shift_lubestbl_close_shift_lubes_vatid' in 'from clause' - Invalid query: SELECT *
FROM `tbl_close_shift_lubes`
JOIN `tbl_close_shift_lubes_vat` USING (`tbl_close_shift_lubestbl_close_shift_lubes_vatid`)
WHERE `close_shift_id` = '24'
ERROR - 2022-05-27 09:13:22 --> Severity: error --> Exception: Too few arguments to function ShiftReports_model::fetchSingleRowJoin(), 4 passed in F:\xamp\htdocs\posmain\application\models\ShiftReports_model.php on line 654 and exactly 5 expected F:\xamp\htdocs\posmain\application\models\ShiftReports_model.php 631
ERROR - 2022-05-27 09:13:54 --> Query error: Unknown column 'close_shift_id1' in 'where clause' - Invalid query: SELECT *
FROM `tbl_close_shift_lubes`
JOIN `tbl_close_shift_lubes_vat` ON `tbl_close_shift_lubes`.`close_shift_id`=`tbl_close_shift_lubes_vat`.`id`
WHERE `close_shift_id1` = '24'
ERROR - 2022-05-27 09:15:03 --> Severity: error --> Exception: Cannot use object of type stdClass as array F:\xamp\htdocs\posmain\application\models\ShiftReports_model.php 672
ERROR - 2022-05-27 09:15:35 --> Severity: error --> Exception: Call to undefined method CI_DB_mysqli_driver::rollback() F:\xamp\htdocs\posmain\application\models\ShiftReports_model.php 689
ERROR - 2022-05-27 09:21:02 --> Query error: Unknown column 'emp_id' in 'field list' - Invalid query: INSERT INTO `rpt_sales` (`amount`, `category_id`, `centre_id`, `close_shift_id`, `emp_id`, `item_id`, `price`, `shift_id`, `vat_rate`) VALUES ('1','1','5','24','55','26','7150','1',NULL), ('1','1','5','42','55','44','7890','1',NULL), ('96','1','5','109','55','15','140','96',NULL), ('96','1','5','111','55','11','260','96',NULL), ('98','1','5','212','56','13','140','98',NULL), ('98','1','5','213','56','11','260','98',NULL), ('98','1','5','214','56','8','320','98',NULL), ('98','1','5','220','56','10','130','98',NULL), ('98','1','5','223','56','9','440','98',NULL), ('98','1','5','224','56','25','8430','98',NULL), ('98','1','5','243','56','5','230','98',NULL), ('98','1','5','251','56','49','6340','98',NULL), ('100','1','5','307','55','12','210','100',NULL), ('100','1','5','311','55','3','260','100',NULL), ('100','1','5','314','55','13','140','100',NULL), ('100','1','5','345','55','5','230','100',NULL), ('100','1','5','347','55','32','390','100',NULL), ('102','1','5','411','54','42','390','102',NULL), ('102','1','5','417','54','11','260','102',NULL), ('102','1','5','449','54','32','390','102',NULL), ('102','1','5','453','54','21','1840','102',NULL), ('102','1','5','459','54','52','170','102',NULL), ('103','1','5','467','56','13','140','103',NULL), ('103','1','5','468','56','11','260','103',NULL), ('104','1','5','511','53','12','210','104',NULL), ('104','1','5','513','53','42','390','104',NULL), ('104','1','5','519','53','11','260','104',NULL), ('104','1','5','520','53','8','320','104',NULL), ('104','1','5','521','53','36','390','104',NULL), ('104','1','5','549','53','5','230','104',NULL), ('105','1','5','570','54','11','260','105',NULL), ('105','1','5','571','54','8','320','105',NULL), ('105','1','5','600','54','5','230','105',NULL), ('108','1','5','725','52','36','390','108',NULL), ('108','1','5','752','52','22','1650','108',NULL), ('108','1','5','753','52','5','230','108',NULL), ('108','1','5','758','52','4','210','108',NULL), ('110','1','5','827','55','36','390','110',NULL), ('110','1','5','833','55','40','510','110',NULL), ('110','1','5','857','55','32','390','110',NULL), ('112','1','5','919','52','3','260','112',NULL), ('112','1','5','924','52','8','320','112',NULL), ('112','1','5','927','52','11','260','112',NULL), ('112','1','5','928','52','12','210','112',NULL), ('112','1','5','940','52','24','1490','112',NULL), ('112','1','5','948','52','32','390','112',NULL), ('114','1','5','1021','53','3','260','114',NULL), ('114','1','5','1023','53','5','230','114',NULL), ('114','1','5','1026','53','8','320','114',NULL), ('116','1','5','1132','53','12','210','116',NULL), ('116','1','5','1133','53','13','140','116',NULL), ('116','1','5','1139','53','19','1820','116',NULL), ('116','1','5','1144','53','24','1490','116',NULL), ('118','1','5','1225','53','3','260','118',NULL), ('118','1','5','1227','53','5','230','118',NULL), ('118','1','5','1230','53','8','320','118',NULL), ('118','1','5','1233','53','11','260','118',NULL), ('118','1','5','1247','53','25','8430','118',NULL), ('118','1','5','1248','53','26','7150','118',NULL), ('118','1','5','1251','53','29','6380','118',NULL), ('118','1','5','1256','53','34','2070','118',NULL), ('118','1','5','1258','53','36','390','118',NULL), ('118','1','5','1263','53','41','2200','118',NULL), ('118','1','5','1271','53','49','6340','118',NULL), ('118','1','5','1273','53','51','9890','118',NULL), ('119','1','5','1309','54','36','390','119',NULL), ('120','1','5','1344','52','20','2210','120',NULL), ('120','1','5','1356','52','32','390','120',NULL), ('120','1','5','1360','52','36','390','120',NULL), ('120','1','5','1366','52','42','390','120',NULL), ('120','1','5','1374','52','50','1870','120',NULL), ('121','1','5','1380','54','5','230','121',NULL), ('121','1','5','1388','54','13','140','121',NULL), ('122','1','5','1431','55','5','230','122',NULL), ('122','1','5','1458','55','32','390','122',NULL), ('122','1','5','1462','55','36','390','122',NULL), ('122','1','5','1469','55','43','4150','122',NULL), ('125','1','5','1531','52','3','260','125',NULL), ('125','1','5','1533','52','5','230','125',NULL), ('125','1','5','1540','52','12','210','125',NULL), ('125','1','5','1541','52','13','140','125',NULL), ('125','1','5','1542','52','14','310','125',NULL), ('125','1','5','1558','52','30','1840','125',NULL), ('125','1','5','1560','52','32','390','125',NULL), ('128','1','5','1633','52','3','260','128',NULL), ('128','1','5','1635','52','5','230','128',NULL), ('128','1','5','1637','52','7','230','128',NULL), ('128','1','5','1638','52','8','320','128',NULL), ('128','1','5','1639','52','9','440','128',NULL), ('128','1','5','1641','52','11','260','128',NULL), ('128','1','5','1642','52','12','210','128',NULL), ('128','1','5','1662','52','32','390','128',NULL), ('130','1','5','1737','53','5','230','130',NULL), ('130','1','5','1743','53','11','260','130',NULL), ('130','1','5','1745','53','13','140','130',NULL), ('130','1','5','1768','53','36','390','130',NULL), ('130','1','5','1784','53','52','170','130',NULL), ('131','1','5','1825','54','42','390','131',NULL), ('132','1','5','1837','53','3','260','132',NULL), ('132','1','5','1839','53','5','230','132',NULL)
ERROR - 2022-05-27 09:24:19 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-27 09:26:51 --> Severity: error --> Exception: syntax error, unexpected ',' F:\xamp\htdocs\posmain\application\models\ShiftReports_model.php 665
ERROR - 2022-05-27 09:28:33 --> 404 Page Not Found: Payment/images
ERROR - 2022-05-27 09:30:13 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-27 09:30:22 --> Could not find the language line "insert_batch() called with no data"
ERROR - 2022-05-27 09:30:56 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-27 09:31:09 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-27 09:40:48 --> Could not find the language line "insert_batch() called with no data"
ERROR - 2022-05-27 09:54:19 --> Severity: error --> Exception: syntax error, unexpected '$r1' (T_VARIABLE), expecting ';' or ',' F:\xamp\htdocs\posmain\application\models\ShiftReports_model.php 688
ERROR - 2022-05-27 11:43:55 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-27 13:42:51 --> 404 Page Not Found: Payment/images
ERROR - 2022-05-27 13:42:56 --> Could not find the language line "insert_batch() called with no data"
ERROR - 2022-05-27 13:44:55 --> Could not find the language line "insert_batch() called with no data"
ERROR - 2022-05-27 13:45:18 --> Could not find the language line "insert_batch() called with no data"
ERROR - 2022-05-27 13:48:23 --> Query error: Table 'posmain.tbl_items1' doesn't exist - Invalid query: SELECT *
FROM `tbl_measurement_type`
JOIN `tbl_items1` ON `tbl_measurement_type`.`type_id` = `tbl_items`.`measurement_unit_id`
WHERE `item_id` = '26'
