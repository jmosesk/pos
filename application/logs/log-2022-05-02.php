<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2022-05-02 11:07:59 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-02 11:10:09 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-02 11:10:30 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-02 11:11:30 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-02 11:16:57 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-02 11:16:57 --> Query error: Unknown column 'tbl_receiving_fuel_meta.tax' in 'field list' - Invalid query: SELECT SUM(tbl_recieving_items.total_price) as net_amount, SUM(tbl_recieving_items.tax_percentage) as tax_amount, `tbl_recieving_items`.`tax` as `tax_perc`, SUM(tbl_recieving_items_fuel.net_amount) as fuel_net_amount, SUM(tbl_recieving_items_fuel.vat_amount) as fuel_tax_amount, `tbl_recieving_items_fuel`.`tax_percentage` as `fuel_tax_perc`, SUM(tbl_receiving_fuel_meta.license_fees) as netfee, SUM(tbl_receiving_fuel_meta.license_fees) * 0.16 as fee_tax, `tbl_receiving_fuel_meta`.`tax` as `fee_rate`
FROM `tbl_receivings`
LEFT JOIN `tbl_recieving_items_fuel` ON `tbl_recieving_items_fuel`.`recieving_id` = `tbl_receivings`.`receiving_id`
LEFT JOIN `tbl_recieving_items` ON `tbl_recieving_items`.`recieving_id` = `tbl_receivings`.`receiving_id`
LEFT JOIN `tbl_receiving_fuel_meta` ON `tbl_receiving_fuel_meta`.`receiving_id` = `tbl_receivings`.`receiving_id`
WHERE `tbl_receivings`.`shift_id` IN('66', '67', '68', '69', '70', '71', '72', '73', '74', '75', '76', '77', '78', '79', '80', '81', '82', '83', '84', '85', '86', '87', '88', '89', '90', '91', '92', '93', '94', '95', '96', '97', '98', '99', '100', '101', '102', '103', '104', '105', '106', '107', '108', '109', '110', '111', '112', '113', '114', '115', '116', '117', '118')
GROUP BY `tbl_recieving_items`.`tax`, `tbl_receiving_fuel_meta`.`tax`
ORDER BY `tbl_recieving_items`.`tax` DESC, `tbl_receiving_fuel_meta`.`tax` DESC
ERROR - 2022-05-02 11:17:09 --> 404 Page Not Found: Assets/DataTables
ERROR - 2022-05-02 11:17:09 --> 404 Page Not Found: Assets/js
ERROR - 2022-05-02 11:17:17 --> 404 Page Not Found: Assets/js
ERROR - 2022-05-02 11:19:29 --> 404 Page Not Found: Assets/js
ERROR - 2022-05-02 11:19:29 --> 404 Page Not Found: Assets/DataTables
ERROR - 2022-05-02 11:19:42 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-02 11:20:25 --> Severity: Notice --> Array to string conversion C:\xampp\htdocs\fms_prod\application\views\shiftReports\supplier_summary_statement.php 35
ERROR - 2022-05-02 11:20:31 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-02 11:24:23 --> 404 Page Not Found: Shift/images
ERROR - 2022-05-02 11:24:46 --> Query error: Unknown column 'images' in 'field list' - Invalid query: SELECT SUM(IF((tbl_bankings.shift_id = images), (tbl_bankings.amount), 0)) as total_bankings
FROM `tbl_bankings`
WHERE `tbl_bankings`.`shift_id` = 'images'
GROUP BY `shift_id`
ERROR - 2022-05-02 11:27:22 --> Severity: error --> Exception: Call to a member function result() on null C:\xampp\htdocs\fms_prod\application\views\shift\cash_reconcilliation_sheet.php 551
ERROR - 2022-05-02 11:36:41 --> 404 Page Not Found: Shift/images
ERROR - 2022-05-02 11:55:49 --> Severity: error --> Exception: Call to a member function result() on null C:\xampp\htdocs\fms_prod\application\views\shift\cash_reconcilliation_sheet.php 551
ERROR - 2022-05-02 14:25:35 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-02 17:33:41 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-02 18:20:51 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-02 18:20:52 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'as netamnt, `item_name`, `category_id`, SUM((sales_qty * price) * tbl_close_s...' at line 1 - Invalid query: SELECT SUM(tbl_close_shift_lubes.sales_qty) as qty, SUM(sales_qty * tbl_measurement_type.value) as vol, SUM(sales_qty * price) as amnt, SUM(sales_qty * (price / (1+tbl_close_shift_lubes_vat.vat)) as netamnt, `item_name`, `category_id`, SUM((sales_qty * price) * tbl_close_shift_lubes_vat.vat) as vat
FROM `tbl_close_shift_lubes`
LEFT JOIN `tbl_items` ON `tbl_items`.`item_id` = `tbl_close_shift_lubes`.`item_id`
LEFT JOIN `tbl_products` ON `tbl_products`.`item_id` = `tbl_items`.`item_id`
LEFT JOIN `tbl_measurement_type` ON `tbl_measurement_type`.`type_id` = `tbl_items`.`measurement_unit_id`
LEFT JOIN `tbl_close_shift_lubes_vat` ON `tbl_close_shift_lubes_vat`.`id` = `tbl_close_shift_lubes`.`close_shift_id`
WHERE `sales_qty` > 0
AND `tbl_close_shift_lubes`.`shift_id` IN('119', '118', '117', '116', '115', '114', '113', '112', '111', '110', '109', '108', '107', '106', '105', '104', '103', '102', '101', '100', '99', '98', '97', '96', '95', '94', '93', '92', '91', '90', '89', '88', '87', '86', '85', '84', '83', '82', '81', '80', '79', '78', '77', '76', '75', '74', '73', '72', '71', '70', '69', '68', '67', '66')
GROUP BY `tbl_close_shift_lubes`.`item_id`
ORDER BY `tbl_items`.`item_name`
ERROR - 2022-05-02 18:21:04 --> 404 Page Not Found: Assets/js
ERROR - 2022-05-02 18:21:04 --> 404 Page Not Found: Assets/DataTables
ERROR - 2022-05-02 18:21:11 --> 404 Page Not Found: Assets/js
ERROR - 2022-05-02 18:21:11 --> 404 Page Not Found: Assets/DataTables
ERROR - 2022-05-02 18:21:23 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-02 18:21:23 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'as netamnt, `item_name`, `category_id`, SUM((sales_qty * price) * tbl_close_s...' at line 1 - Invalid query: SELECT SUM(tbl_close_shift_lubes.sales_qty) as qty, SUM(sales_qty * tbl_measurement_type.value) as vol, SUM(sales_qty * price) as amnt, SUM(sales_qty * (price / (1+tbl_close_shift_lubes_vat.vat)) as netamnt, `item_name`, `category_id`, SUM((sales_qty * price) * tbl_close_shift_lubes_vat.vat) as vat
FROM `tbl_close_shift_lubes`
LEFT JOIN `tbl_items` ON `tbl_items`.`item_id` = `tbl_close_shift_lubes`.`item_id`
LEFT JOIN `tbl_products` ON `tbl_products`.`item_id` = `tbl_items`.`item_id`
LEFT JOIN `tbl_measurement_type` ON `tbl_measurement_type`.`type_id` = `tbl_items`.`measurement_unit_id`
LEFT JOIN `tbl_close_shift_lubes_vat` ON `tbl_close_shift_lubes_vat`.`id` = `tbl_close_shift_lubes`.`close_shift_id`
WHERE `sales_qty` > 0
AND `tbl_close_shift_lubes`.`shift_id` IN('119', '118', '117', '116', '115', '114', '113', '112', '111', '110', '109', '108', '107', '106', '105', '104', '103', '102', '101', '100', '99', '98', '97', '96', '95', '94', '93', '92', '91', '90', '89', '88', '87', '86', '85', '84', '83', '82', '81', '80', '79', '78', '77', '76', '75', '74', '73', '72', '71', '70', '69', '68', '67', '66')
GROUP BY `tbl_close_shift_lubes`.`item_id`
ORDER BY `tbl_items`.`item_name`
ERROR - 2022-05-02 18:24:06 --> 404 Page Not Found: Assets/js
ERROR - 2022-05-02 18:24:06 --> 404 Page Not Found: Assets/DataTables
ERROR - 2022-05-02 18:24:27 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-02 18:24:27 --> Query error: Unknown column 'sales_qty' in 'field list' - Invalid query: SELECT SUM(tbl_close_shift_job_card.quantity) as qty, SUM(tbl_close_shift_job_card.quantity * tbl_measurement_type.value) as vol, SUM(quantity * tbl_close_shift_job_card.unit_price) as amnt, SUM(sales_qty * (price / (1+tbl_close_shift_job_card_vat.vat))) as netamnt, `item_name`, SUM((quantity * tbl_close_shift_job_card.unit_price) * tbl_close_shift_job_card_vat.vat) as vat, "jc" as `category_id`
FROM `tbl_close_shift_job_card`
LEFT JOIN `tbl_items` ON `tbl_items`.`item_id` = `tbl_close_shift_job_card`.`item_id`
LEFT JOIN `tbl_close_shift_job_card_vat` ON `tbl_close_shift_job_card_vat`.`id` = `tbl_close_shift_job_card`.`close_shift_id`
LEFT JOIN `tbl_measurement_type` ON `tbl_measurement_type`.`type_id` = `tbl_items`.`measurement_unit_id`
WHERE `quantity` > 0
AND `tbl_close_shift_job_card`.`shift_id` IN('119', '118', '117', '116', '115', '114', '113', '112', '111', '110', '109', '108', '107', '106', '105', '104', '103', '102', '101', '100', '99', '98', '97', '96', '95', '94', '93', '92', '91', '90', '89', '88', '87', '86', '85', '84', '83', '82', '81', '80', '79', '78', '77', '76', '75', '74', '73', '72', '71', '70', '69', '68', '67', '66')
GROUP BY `tbl_close_shift_job_card`.`item_id`
ORDER BY `tbl_items`.`item_name`
ERROR - 2022-05-02 18:26:05 --> 404 Page Not Found: Assets/js
ERROR - 2022-05-02 18:26:05 --> 404 Page Not Found: Assets/DataTables
ERROR - 2022-05-02 18:26:14 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-02 18:26:14 --> Query error: Unknown column 'price' in 'field list' - Invalid query: SELECT SUM(tbl_close_shift_job_card.quantity) as qty, SUM(tbl_close_shift_job_card.quantity * tbl_measurement_type.value) as vol, SUM(quantity * tbl_close_shift_job_card.unit_price) as amnt, SUM(quantity  * (price / (1+tbl_close_shift_job_card_vat.vat))) as netamnt, `item_name`, SUM((quantity * tbl_close_shift_job_card.unit_price) * tbl_close_shift_job_card_vat.vat) as vat, "jc" as `category_id`
FROM `tbl_close_shift_job_card`
LEFT JOIN `tbl_items` ON `tbl_items`.`item_id` = `tbl_close_shift_job_card`.`item_id`
LEFT JOIN `tbl_close_shift_job_card_vat` ON `tbl_close_shift_job_card_vat`.`id` = `tbl_close_shift_job_card`.`close_shift_id`
LEFT JOIN `tbl_measurement_type` ON `tbl_measurement_type`.`type_id` = `tbl_items`.`measurement_unit_id`
WHERE `quantity` > 0
AND `tbl_close_shift_job_card`.`shift_id` IN('119', '118', '117', '116', '115', '114', '113', '112', '111', '110', '109', '108', '107', '106', '105', '104', '103', '102', '101', '100', '99', '98', '97', '96', '95', '94', '93', '92', '91', '90', '89', '88', '87', '86', '85', '84', '83', '82', '81', '80', '79', '78', '77', '76', '75', '74', '73', '72', '71', '70', '69', '68', '67', '66')
GROUP BY `tbl_close_shift_job_card`.`item_id`
ORDER BY `tbl_items`.`item_name`
ERROR - 2022-05-02 18:28:38 --> 404 Page Not Found: Assets/DataTables
ERROR - 2022-05-02 18:28:38 --> 404 Page Not Found: Assets/js
ERROR - 2022-05-02 18:28:48 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-02 18:28:48 --> Query error: Column 'unit_price' in field list is ambiguous - Invalid query: SELECT SUM(tbl_close_shift_job_card.quantity) as qty, SUM(tbl_close_shift_job_card.quantity * tbl_measurement_type.value) as vol, SUM(quantity * tbl_close_shift_job_card.unit_price) as amnt, SUM(quantity  * (unit_price / (1+tbl_close_shift_job_card_vat.vat))) as netamnt, `item_name`, SUM((quantity * tbl_close_shift_job_card.unit_price) * tbl_close_shift_job_card_vat.vat) as vat, "jc" as `category_id`
FROM `tbl_close_shift_job_card`
LEFT JOIN `tbl_items` ON `tbl_items`.`item_id` = `tbl_close_shift_job_card`.`item_id`
LEFT JOIN `tbl_close_shift_job_card_vat` ON `tbl_close_shift_job_card_vat`.`id` = `tbl_close_shift_job_card`.`close_shift_id`
LEFT JOIN `tbl_measurement_type` ON `tbl_measurement_type`.`type_id` = `tbl_items`.`measurement_unit_id`
WHERE `quantity` > 0
AND `tbl_close_shift_job_card`.`shift_id` IN('119', '118', '117', '116', '115', '114', '113', '112', '111', '110', '109', '108', '107', '106', '105', '104', '103', '102', '101', '100', '99', '98', '97', '96', '95', '94', '93', '92', '91', '90', '89', '88', '87', '86', '85', '84', '83', '82', '81', '80', '79', '78', '77', '76', '75', '74', '73', '72', '71', '70', '69', '68', '67', '66')
GROUP BY `tbl_close_shift_job_card`.`item_id`
ORDER BY `tbl_items`.`item_name`
ERROR - 2022-05-02 18:30:22 --> 404 Page Not Found: Assets/js
ERROR - 2022-05-02 18:30:23 --> 404 Page Not Found: Assets/DataTables
ERROR - 2022-05-02 18:30:27 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-02 18:39:08 --> 404 Page Not Found: Assets/js
ERROR - 2022-05-02 18:39:08 --> 404 Page Not Found: Assets/DataTables
ERROR - 2022-05-02 18:39:20 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-02 18:42:27 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-02 18:46:17 --> Unable to delete cache file for Export
ERROR - 2022-05-02 18:48:36 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-02 18:48:39 --> Unable to delete cache file for Export
ERROR - 2022-05-02 19:17:21 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-02 19:17:24 --> Unable to delete cache file for Export
ERROR - 2022-05-02 19:21:19 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-02 19:21:22 --> Unable to delete cache file for Export
ERROR - 2022-05-02 19:23:29 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-02 19:23:39 --> Unable to delete cache file for Export
ERROR - 2022-05-02 19:24:20 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-02 19:24:22 --> Unable to delete cache file for Export
ERROR - 2022-05-02 19:25:47 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-02 19:25:49 --> Unable to delete cache file for Export
ERROR - 2022-05-02 19:31:16 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-02 19:31:18 --> Unable to delete cache file for Export
ERROR - 2022-05-02 19:31:18 --> Severity: Notice --> Undefined variable: title C:\xampp\htdocs\fms_prod\application\controllers\Export.php 165
ERROR - 2022-05-02 19:32:52 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-02 19:32:54 --> Unable to delete cache file for Export
ERROR - 2022-05-02 19:32:54 --> Severity: Notice --> Undefined variable: tcpdf C:\xampp\htdocs\fms_prod\application\controllers\Export.php 163
ERROR - 2022-05-02 19:32:54 --> Severity: error --> Exception: Call to a member function SetCreator() on null C:\xampp\htdocs\fms_prod\application\controllers\Export.php 163
ERROR - 2022-05-02 19:34:04 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-02 19:34:06 --> Unable to delete cache file for Export
ERROR - 2022-05-02 19:36:09 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-02 19:36:11 --> Unable to delete cache file for Export
ERROR - 2022-05-02 19:37:13 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-02 19:37:14 --> Unable to delete cache file for Export
ERROR - 2022-05-02 19:40:05 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-02 19:40:06 --> Unable to delete cache file for Export
ERROR - 2022-05-02 19:44:50 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-02 19:44:52 --> Unable to delete cache file for Export
ERROR - 2022-05-02 19:47:43 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-02 19:47:45 --> Unable to delete cache file for Export
ERROR - 2022-05-02 19:49:47 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-02 19:49:49 --> Unable to delete cache file for Export
ERROR - 2022-05-02 19:57:42 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-02 19:57:45 --> Unable to delete cache file for Export
ERROR - 2022-05-02 19:59:02 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-02 19:59:04 --> Unable to delete cache file for Export
ERROR - 2022-05-02 20:23:18 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-02 20:37:22 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-02 20:38:59 --> Unable to delete cache file for Export
ERROR - 2022-05-02 20:41:13 --> Unable to delete cache file for Export
ERROR - 2022-05-02 20:54:54 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-02 20:55:19 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-02 20:57:49 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-02 21:09:15 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-02 21:09:15 --> Query error: Unknown column 'tbl_close_shift_lubes_vat.vat' in 'field list' - Invalid query: SELECT SUM(sales_qty * (price / (1+tbl_close_shift_lubes_vat.vat))) as net_amount, SUM((sales_qty * (price / (1+tbl_close_shift_lubes_vat.vat))) * tbl_close_shift_products_vat.vat) as tax_amount, `vat`
FROM `tbl_close_shift_products`
LEFT JOIN `tbl_close_shift_products_vat` ON `tbl_close_shift_products_vat`.`id` = `tbl_close_shift_products`.`close_shift_id`
WHERE `sales_qty` > 0
AND `tbl_close_shift_products`.`shift_id` IN('66', '67', '68', '69', '70', '71', '72', '73', '74', '75', '76', '77', '78', '79', '80', '81', '82', '83', '84', '85', '86', '87', '88', '89', '90', '91', '92', '93', '94', '95', '96', '97', '98', '99', '100', '101', '102', '103', '104', '105', '106', '107', '108', '109', '110', '111', '112', '113', '114', '115', '116', '117', '118', '119')
GROUP BY `vat`
ERROR - 2022-05-02 21:09:37 --> 404 Page Not Found: Assets/DataTables
ERROR - 2022-05-02 21:09:37 --> 404 Page Not Found: Assets/js
ERROR - 2022-05-02 21:09:41 --> 404 Page Not Found: Assets/DataTables
ERROR - 2022-05-02 21:09:41 --> 404 Page Not Found: Assets/js
ERROR - 2022-05-02 21:09:52 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-02 21:09:52 --> Query error: Unknown column 'tbl_close_shift_lubes_vat.vat' in 'field list' - Invalid query: SELECT SUM(sales_qty * (price / (1+tbl_close_shift_lubes_vat.vat))) as net_amount, SUM((sales_qty * (price / (1+tbl_close_shift_lubes_vat.vat))) * tbl_close_shift_products_vat.vat) as tax_amount, `vat`
FROM `tbl_close_shift_products`
LEFT JOIN `tbl_close_shift_products_vat` ON `tbl_close_shift_products_vat`.`id` = `tbl_close_shift_products`.`close_shift_id`
WHERE `sales_qty` > 0
AND `tbl_close_shift_products`.`shift_id` IN('66', '67', '68', '69', '70', '71', '72', '73', '74', '75', '76', '77', '78', '79', '80', '81', '82', '83', '84', '85', '86', '87', '88', '89', '90', '91', '92', '93', '94', '95', '96', '97', '98', '99', '100', '101', '102', '103', '104', '105', '106', '107', '108', '109', '110', '111', '112', '113', '114', '115', '116', '117', '118', '119')
GROUP BY `vat`
ERROR - 2022-05-02 21:12:06 --> 404 Page Not Found: Assets/js
ERROR - 2022-05-02 21:12:06 --> 404 Page Not Found: Assets/DataTables
ERROR - 2022-05-02 21:12:13 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-02 21:12:13 --> Query error: Unknown column 'tbl_close_shift_lubes_vat.vat' in 'field list' - Invalid query: SELECT SUM(sales_qty * (price / (1+tbl_close_shift_products_vat.vat))) as net_amount, SUM((sales_qty * (price / (1+tbl_close_shift_lubes_vat.vat))) * tbl_close_shift_products_vat.vat) as tax_amount, `vat`
FROM `tbl_close_shift_products`
LEFT JOIN `tbl_close_shift_products_vat` ON `tbl_close_shift_products_vat`.`id` = `tbl_close_shift_products`.`close_shift_id`
WHERE `sales_qty` > 0
AND `tbl_close_shift_products`.`shift_id` IN('66', '67', '68', '69', '70', '71', '72', '73', '74', '75', '76', '77', '78', '79', '80', '81', '82', '83', '84', '85', '86', '87', '88', '89', '90', '91', '92', '93', '94', '95', '96', '97', '98', '99', '100', '101', '102', '103', '104', '105', '106', '107', '108', '109', '110', '111', '112', '113', '114', '115', '116', '117', '118', '119')
GROUP BY `vat`
ERROR - 2022-05-02 21:13:34 --> 404 Page Not Found: Assets/js
ERROR - 2022-05-02 21:13:35 --> 404 Page Not Found: Assets/DataTables
ERROR - 2022-05-02 21:13:44 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-02 21:15:56 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-02 21:25:59 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-02 21:26:21 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-02 21:26:43 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-02 21:27:16 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-02 21:28:17 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-02 21:28:37 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-02 21:30:07 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-02 21:30:27 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-02 21:30:55 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-02 21:31:04 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-02 21:31:30 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-02 21:31:40 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-02 21:32:01 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-02 21:32:12 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-02 21:32:44 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-02 21:32:54 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-02 21:33:08 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-02 21:33:24 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-02 21:37:25 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-02 21:37:41 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-02 21:39:12 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-02 21:39:25 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-02 21:39:36 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-02 21:39:49 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-02 21:40:42 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-02 21:40:53 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-02 21:41:38 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-02 21:41:48 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-02 21:41:57 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-02 21:42:05 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-02 21:42:13 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-02 21:42:21 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-02 21:42:35 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-02 21:42:43 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-02 21:42:52 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-02 21:43:05 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-02 21:43:13 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-02 21:43:38 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-02 21:43:47 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-02 21:44:08 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-02 21:44:26 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-02 21:44:43 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-02 21:45:00 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-02 21:45:11 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-02 21:45:22 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-02 21:45:37 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-02 21:45:49 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-02 21:46:04 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-02 21:46:17 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-02 21:46:49 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-02 21:47:04 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-02 21:47:19 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-02 21:47:33 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-02 21:47:48 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-02 21:47:59 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-02 21:48:20 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-02 21:48:33 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-02 21:48:46 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-02 21:49:01 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-02 21:49:14 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-02 21:49:27 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-02 21:49:41 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-02 21:49:56 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-02 21:50:15 --> 404 Page Not Found: ShiftReports/images
