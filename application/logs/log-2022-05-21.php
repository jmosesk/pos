<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2022-05-21 07:35:08 --> 404 Page Not Found: User/images
ERROR - 2022-05-21 07:35:20 --> 404 Page Not Found: Payment/images
ERROR - 2022-05-21 07:36:10 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-21 07:36:18 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-21 07:41:06 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-21 08:05:20 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-21 08:05:45 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-21 08:16:09 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-21 08:21:08 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-21 08:28:24 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-21 08:28:49 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-21 08:32:43 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-21 08:34:06 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-21 08:37:33 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-21 08:42:41 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-21 08:42:57 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-21 08:43:45 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-21 08:48:17 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-21 08:48:36 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-21 08:51:33 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-21 08:51:46 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-21 08:52:46 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-21 08:54:09 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-21 08:54:40 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-21 08:55:12 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-21 08:56:07 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-21 08:56:23 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-21 08:56:58 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-21 08:58:48 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-21 08:59:28 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-21 09:02:31 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-21 09:05:21 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-21 09:06:31 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-21 09:07:35 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-21 09:08:36 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-21 09:11:31 --> 404 Page Not Found: Payment/images
ERROR - 2022-05-21 09:12:57 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-21 09:15:26 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-21 09:22:01 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-21 09:25:23 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-21 09:25:32 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-21 11:31:54 --> Query error: Column 'supplier_id' cannot be null - Invalid query: INSERT INTO `tbl_vendors_transactions` (`supplier_id`, `shift_id`, `debit`, `source`, `amount`, `employee_id`, `transaction_type`, `payment_type`, `ref_number`, `bbf`) VALUES (NULL, '309', 1, 0, '4545', '64', 2, '1', 'PYtrtrtt', 0)
ERROR - 2022-05-21 11:50:31 --> Severity: error --> Exception: syntax error, unexpected 'public' (T_PUBLIC) F:\xamp\htdocs\posmain\application\controllers\Payment.php 748
ERROR - 2022-05-21 19:16:13 --> 404 Page Not Found: Payment/images
ERROR - 2022-05-21 19:25:21 --> Severity: error --> Exception: syntax error, unexpected '$statement' (T_VARIABLE) F:\xamp\htdocs\posmain\application\controllers\Payment.php 442
ERROR - 2022-05-21 19:30:22 --> Query error: Unknown column 'account_m' in 'field list' - Invalid query: INSERT INTO `tbl_vat_payments` (`reason`, `payment_type`, `account_m`, `account_c`, `account_b`, `ref_no`, `amount`, `invoice_date`, `remarks`) VALUES ('Invoice', '1', '', '', '200', 'ererrwrw', '4545', '05/24/2022', 'ererer')
ERROR - 2022-05-21 19:48:26 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-21 19:48:39 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-21 19:53:24 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-21 19:54:01 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-21 20:07:02 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-21 20:07:02 --> Query error: Unknown column 'tbl_centres.centre_id' in 'on clause' - Invalid query: SELECT `tbl_employees`.`name`, SUM(tbl_close_shift_lubes.sales_qty * tbl_measurement_type.value) as vol, SUM(tbl_close_shift_lubes.sales_qty *tbl_close_shift_lubes.price) as amnt, SUM(tbl_close_shift_lubes.sales_qty * (price / (1+tbl_close_shift_lubes_vat.vat))) as netamnt, `item_name`, `category_id`, SUM((sales_qty * (price / (1+tbl_close_shift_lubes_vat.vat))) * tbl_close_shift_lubes_vat.vat) as vat
FROM `tbl_employees`
LEFT JOIN `tbl_assigned_centres` ON `tbl_assigned_centres`.`employee_id` = `tbl_employees`.`emp_id`
LEFT JOIN `tbl_close_shift_lubes` ON `tbl_close_shift_lubes`.`centre_id` = `tbl_centres`.`centre_id`
LEFT JOIN `tbl_items` ON `tbl_items`.`item_id` = `tbl_close_shift_lubes`.`item_id`
LEFT JOIN `tbl_products` ON `tbl_products`.`item_id` = `tbl_items`.`item_id`
LEFT JOIN `tbl_measurement_type` ON `tbl_measurement_type`.`type_id` = `tbl_items`.`measurement_unit_id`
LEFT JOIN `tbl_close_shift_lubes_vat` ON `tbl_close_shift_lubes_vat`.`id` = `tbl_close_shift_lubes`.`close_shift_id`
WHERE `sales_qty` > 0
AND `tbl_close_shift_lubes`.`shift_id` IN('300', '299', '298', '297', '296', '295', '294', '293', '292', '291', '290', '289', '288', '287', '286', '285', '284', '283', '282', '281', '280', '279', '278', '277', '276', '275', '274', '273', '272', '271', '270', '269', '268', '267', '266', '265', '264', '263', '262', '261', '260', '259', '258', '257', '256', '255', '254', '253', '252', '251', '250', '249', '248', '247', '246', '245', '244', '243', '242', '241')
GROUP BY `tbl_employees`.`emp_id`
ORDER BY `tbl_employees`.`emp_id`
ERROR - 2022-05-21 20:07:22 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-21 20:07:22 --> Query error: Unknown column 'tbl_centres.centre_id' in 'on clause' - Invalid query: SELECT `tbl_employees`.`name`, SUM(tbl_close_shift_lubes.sales_qty * tbl_measurement_type.value) as vol, SUM(tbl_close_shift_lubes.sales_qty *tbl_close_shift_lubes.price) as amnt, SUM(tbl_close_shift_lubes.sales_qty * (price / (1+tbl_close_shift_lubes_vat.vat))) as netamnt, `item_name`, `category_id`, SUM((sales_qty * (price / (1+tbl_close_shift_lubes_vat.vat))) * tbl_close_shift_lubes_vat.vat) as vat
FROM `tbl_employees`
LEFT JOIN `tbl_assigned_centres` ON `tbl_assigned_centres`.`employee_id` = `tbl_employees`.`emp_id`
LEFT JOIN `tbl_close_shift_lubes` ON `tbl_close_shift_lubes`.`centre_id` = `tbl_centres`.`centre_id`
LEFT JOIN `tbl_items` ON `tbl_items`.`item_id` = `tbl_close_shift_lubes`.`item_id`
LEFT JOIN `tbl_products` ON `tbl_products`.`item_id` = `tbl_items`.`item_id`
LEFT JOIN `tbl_measurement_type` ON `tbl_measurement_type`.`type_id` = `tbl_items`.`measurement_unit_id`
LEFT JOIN `tbl_close_shift_lubes_vat` ON `tbl_close_shift_lubes_vat`.`id` = `tbl_close_shift_lubes`.`close_shift_id`
WHERE `sales_qty` > 0
AND `tbl_close_shift_lubes`.`shift_id` IN('300', '299', '298', '297', '296', '295', '294', '293', '292', '291', '290', '289', '288', '287', '286', '285', '284', '283', '282', '281', '280', '279', '278', '277', '276', '275', '274', '273', '272', '271', '270', '269', '268', '267', '266', '265', '264', '263', '262', '261', '260', '259', '258', '257', '256', '255', '254', '253', '252', '251', '250', '249', '248', '247', '246', '245', '244', '243', '242', '241')
GROUP BY `tbl_employees`.`emp_id`
ORDER BY `tbl_employees`.`emp_id`
ERROR - 2022-05-21 20:11:31 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-21 20:17:12 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-21 20:19:58 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-21 20:19:58 --> Query error: Unknown column 'tbl_assigned_centres.centre_id' in 'on clause' - Invalid query: SELECT `tbl_employees`.`name`, SUM(tbl_close_shift_lubes.sales_qty * tbl_measurement_type.value) as vol, SUM(tbl_close_shift_lubes.sales_qty *tbl_close_shift_lubes.price) as amnt, SUM(tbl_close_shift_lubes.sales_qty * (price / (1+tbl_close_shift_lubes_vat.vat))) as netamnt, `item_name`, `category_id`, SUM((sales_qty * (price / (1+tbl_close_shift_lubes_vat.vat))) * tbl_close_shift_lubes_vat.vat) as vat
FROM `tbl_employees`
LEFT JOIN `tbl_close_shift_lubes` ON `tbl_close_shift_lubes`.`centre_id` = `tbl_assigned_centres`.`centre_id`
LEFT JOIN `tbl_assigned_centres` ON `tbl_assigned_centres`.`employee_id` = `tbl_employees`.`emp_id`
LEFT JOIN `tbl_items` ON `tbl_items`.`item_id` = `tbl_close_shift_lubes`.`item_id`
LEFT JOIN `tbl_products` ON `tbl_products`.`item_id` = `tbl_items`.`item_id`
LEFT JOIN `tbl_measurement_type` ON `tbl_measurement_type`.`type_id` = `tbl_items`.`measurement_unit_id`
LEFT JOIN `tbl_close_shift_lubes_vat` ON `tbl_close_shift_lubes_vat`.`id` = `tbl_close_shift_lubes`.`close_shift_id`
WHERE `sales_qty` > 0
AND `tbl_assigned_centres`.`shift_id` IN('300', '299', '298', '297', '296', '295', '294', '293', '292', '291', '290', '289', '288', '287', '286', '285', '284', '283', '282', '281', '280', '279', '278', '277', '276', '275', '274', '273', '272', '271', '270', '269', '268', '267', '266', '265', '264', '263', '262', '261', '260', '259', '258', '257', '256', '255', '254', '253', '252', '251', '250', '249', '248', '247', '246', '245', '244', '243', '242', '241')
AND `tbl_close_shift_lubes`.`shift_id` IN('300', '299', '298', '297', '296', '295', '294', '293', '292', '291', '290', '289', '288', '287', '286', '285', '284', '283', '282', '281', '280', '279', '278', '277', '276', '275', '274', '273', '272', '271', '270', '269', '268', '267', '266', '265', '264', '263', '262', '261', '260', '259', '258', '257', '256', '255', '254', '253', '252', '251', '250', '249', '248', '247', '246', '245', '244', '243', '242', '241')
GROUP BY `tbl_employees`.`emp_id`
ORDER BY `tbl_employees`.`emp_id`
ERROR - 2022-05-21 20:21:54 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-21 20:22:39 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-21 20:22:39 --> Query error: Unknown column 'tbl_assigned_centres.shift_id1' in 'where clause' - Invalid query: SELECT `tbl_employees`.`name`, SUM(tbl_close_shift_lubes.sales_qty * tbl_measurement_type.value) as vol, SUM(tbl_close_shift_lubes.sales_qty *tbl_close_shift_lubes.price) as amnt, SUM(tbl_close_shift_lubes.sales_qty * (price / (1+tbl_close_shift_lubes_vat.vat))) as netamnt, `item_name`, `category_id`, SUM((sales_qty * (price / (1+tbl_close_shift_lubes_vat.vat))) * tbl_close_shift_lubes_vat.vat) as vat
FROM `tbl_employees`
LEFT JOIN `tbl_assigned_centres` ON `tbl_assigned_centres`.`employee_id` = `tbl_employees`.`emp_id`
LEFT JOIN `tbl_close_shift_lubes` ON `tbl_close_shift_lubes`.`centre_id` = `tbl_assigned_centres`.`centre_id`
LEFT JOIN `tbl_items` ON `tbl_items`.`item_id` = `tbl_close_shift_lubes`.`item_id`
LEFT JOIN `tbl_products` ON `tbl_products`.`item_id` = `tbl_items`.`item_id`
LEFT JOIN `tbl_measurement_type` ON `tbl_measurement_type`.`type_id` = `tbl_items`.`measurement_unit_id`
LEFT JOIN `tbl_close_shift_lubes_vat` ON `tbl_close_shift_lubes_vat`.`id` = `tbl_close_shift_lubes`.`close_shift_id`
WHERE `sales_qty` > 0
AND `tbl_assigned_centres`.`shift_id1` IN('300', '299', '298', '297', '296', '295', '294', '293', '292', '291', '290', '289', '288', '287', '286', '285', '284', '283', '282', '281', '280', '279', '278', '277', '276', '275', '274', '273', '272', '271', '270', '269', '268', '267', '266', '265', '264', '263', '262', '261', '260', '259', '258', '257', '256', '255', '254', '253', '252', '251', '250', '249', '248', '247', '246', '245', '244', '243', '242', '241')
AND `tbl_close_shift_lubes`.`shift_id` IN('300', '299', '298', '297', '296', '295', '294', '293', '292', '291', '290', '289', '288', '287', '286', '285', '284', '283', '282', '281', '280', '279', '278', '277', '276', '275', '274', '273', '272', '271', '270', '269', '268', '267', '266', '265', '264', '263', '262', '261', '260', '259', '258', '257', '256', '255', '254', '253', '252', '251', '250', '249', '248', '247', '246', '245', '244', '243', '242', '241')
GROUP BY `tbl_employees`.`emp_id`
ORDER BY `tbl_employees`.`emp_id`
ERROR - 2022-05-21 21:21:08 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-21 21:21:09 --> Query error: Not unique table/alias: 'tbl_close_shift_lubes' - Invalid query: SELECT `tbl_employees`.`name`, SUM(tbl_close_shift_lubes.sales_qty * tbl_measurement_type.value) as vol, SUM(tbl_close_shift_lubes.sales_qty *tbl_close_shift_lubes.price) as amnt, SUM(tbl_close_shift_lubes.sales_qty * (price / (1+tbl_close_shift_lubes_vat.vat))) as netamnt, `item_name`, `category_id`, SUM((sales_qty * (price / (1+tbl_close_shift_lubes_vat.vat))) * tbl_close_shift_lubes_vat.vat) as vat
FROM `tbl_employees`
LEFT JOIN `tbl_assigned_centres` ON `tbl_assigned_centres`.`employee_id` = `tbl_employees`.`emp_id`
LEFT JOIN `tbl_close_shift_lubes` ON `tbl_close_shift_lubes`.`centre_id` = `tbl_assigned_centres`.`centre_id`
LEFT JOIN `tbl_close_shift_lubes` ON `tbl_close_shift_lubes`.`shift_id` = `tbl_assigned_centres`.`shift_id`
LEFT JOIN `tbl_items` ON `tbl_items`.`item_id` = `tbl_close_shift_lubes`.`item_id`
LEFT JOIN `tbl_products` ON `tbl_products`.`item_id` = `tbl_items`.`item_id`
LEFT JOIN `tbl_measurement_type` ON `tbl_measurement_type`.`type_id` = `tbl_items`.`measurement_unit_id`
LEFT JOIN `tbl_close_shift_lubes_vat` ON `tbl_close_shift_lubes_vat`.`id` = `tbl_close_shift_lubes`.`close_shift_id`
WHERE `sales_qty` > 0
AND `tbl_assigned_centres`.`shift_id` IN('300', '299', '298', '297', '296', '295', '294', '293', '292', '291', '290', '289', '288', '287', '286', '285', '284', '283', '282', '281', '280', '279', '278', '277', '276', '275', '274', '273', '272', '271', '270', '269', '268', '267', '266', '265', '264', '263', '262', '261', '260', '259', '258', '257', '256', '255', '254', '253', '252', '251', '250', '249', '248', '247', '246', '245', '244', '243', '242', '241')
AND `tbl_close_shift_lubes`.`shift_id` IN('300', '299', '298', '297', '296', '295', '294', '293', '292', '291', '290', '289', '288', '287', '286', '285', '284', '283', '282', '281', '280', '279', '278', '277', '276', '275', '274', '273', '272', '271', '270', '269', '268', '267', '266', '265', '264', '263', '262', '261', '260', '259', '258', '257', '256', '255', '254', '253', '252', '251', '250', '249', '248', '247', '246', '245', '244', '243', '242', '241')
GROUP BY `tbl_employees`.`emp_id`
ORDER BY `tbl_employees`.`emp_id`
ERROR - 2022-05-21 21:22:17 --> 404 Page Not Found: ShiftReports/images
