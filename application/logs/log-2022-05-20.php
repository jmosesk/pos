<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2022-05-20 08:18:32 --> 404 Page Not Found: User/images
ERROR - 2022-05-20 14:12:16 --> 404 Page Not Found: /index
ERROR - 2022-05-20 14:12:30 --> 404 Page Not Found: User/images
ERROR - 2022-05-20 14:13:22 --> 404 Page Not Found: Payment/images
ERROR - 2022-05-20 14:14:00 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-20 14:14:14 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-20 14:15:16 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-20 14:18:48 --> 404 Page Not Found: Payment/images
ERROR - 2022-05-20 14:18:53 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-20 14:19:59 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-20 14:20:44 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-20 14:24:15 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-20 14:24:55 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-20 14:30:59 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-20 14:30:59 --> Query error: Unknown column 'tbl_shifts.shift_date1' in 'where clause' - Invalid query: SELECT CONCAT(tbl_shifts_names.name, " of ", DATE_FORMAT(tbl_shifts.shift_date, "%d-%b-%Y")) as shift_name, reading, tbl_shifts.shift_id, operator.name as operator, bbf_amt, DATE_FORMAT(tbl_shifts.shift_date, "%d-%b-%Y") as shift_date
FROM `tbl_shifts`
LEFT JOIN `tbl_shifts_names` ON `tbl_shifts_names`.`shift_name_id` = `tbl_shifts`.`shift_name_id`
LEFT JOIN `tbl_users` `operator` ON `operator`.`user_id` = `tbl_shifts`.`close_user_id`
WHERE DATE(tbl_shifts.shift_date1) >= '2022-04-01' AND DATE(tbl_shifts.shift_date) <= '2022-04-30'
ORDER BY `tbl_shifts`.`shift_id` DESC
ERROR - 2022-05-20 14:32:57 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-20 14:57:13 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-20 14:57:13 --> Query error: Table 'posmain.tbl_items1' doesn't exist - Invalid query: SELECT SUM(tbl_close_shift_lubes.sales_qty) as qty, SUM(sales_qty * tbl_measurement_type.value) as vol, SUM(sales_qty * price) as amnt, SUM(sales_qty * (price / (1+tbl_close_shift_lubes_vat.vat))) as netamnt, `item_name`, `category_id`, SUM((sales_qty * (price / (1+tbl_close_shift_lubes_vat.vat))) * tbl_close_shift_lubes_vat.vat) as vat
FROM `tbl_close_shift_lubes`
LEFT JOIN `tbl_items1` ON `tbl_items`.`item_id` = `tbl_close_shift_lubes`.`item_id`
LEFT JOIN `tbl_products` ON `tbl_products`.`item_id` = `tbl_items`.`item_id`
LEFT JOIN `tbl_measurement_type` ON `tbl_measurement_type`.`type_id` = `tbl_items`.`measurement_unit_id`
LEFT JOIN `tbl_close_shift_lubes_vat` ON `tbl_close_shift_lubes_vat`.`id` = `tbl_close_shift_lubes`.`close_shift_id`
WHERE `sales_qty` > 0
AND `tbl_close_shift_lubes`.`shift_id` IN('300', '299', '298', '297', '296', '295', '294', '293', '292', '291', '290', '289', '288', '287', '286', '285', '284', '283', '282', '281', '280', '279', '278', '277', '276', '275', '274', '273', '272', '271', '270', '269', '268', '267', '266', '265', '264', '263', '262', '261', '260', '259', '258', '257', '256', '255', '254', '253', '252', '251', '250', '249', '248', '247', '246', '245', '244', '243', '242', '241')
GROUP BY `tbl_close_shift_lubes`.`item_id`
ORDER BY `tbl_items`.`item_name`
ERROR - 2022-05-20 15:00:50 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-20 15:01:04 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-20 15:03:42 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-20 15:05:57 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-20 15:22:10 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-20 15:23:34 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-20 15:25:36 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-20 15:25:53 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-20 15:28:21 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-20 15:32:01 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-20 15:33:06 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-20 15:43:44 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-20 15:43:44 --> Query error: Not unique table/alias: 'tbl_close_shift_lubes' - Invalid query: SELECT SUM(tbl_close_shift_lubes.sales_qty * tbl_measurement_type.value) as vol, SUM(tbl_close_shift_lubes.sales_qty *tbl_close_shift_lubes.price) as amnt, SUM(tbl_close_shift_lubes.sales_qty * (price / (1+tbl_close_shift_lubes_vat.vat))) as netamnt, `item_name`, `category_id`, SUM((sales_qty * (price / (1+tbl_close_shift_lubes_vat.vat))) * tbl_close_shift_lubes_vat.vat) as vat
FROM `tbl_close_shift_lubes`
LEFT JOIN `tbl_assigned_centres` ON `tbl_assigned_centres`.`employee_id` = `tbl_employees`.`emp_id`
LEFT JOIN `tbl_close_shift_lubes` ON `tbl_close_shift_lubes`.`centre_id` = `tbl_assigned_centres`.`centre_id`
LEFT JOIN `tbl_items` ON `tbl_items`.`item_id` = `tbl_close_shift_lubes`.`item_id`
LEFT JOIN `tbl_products` ON `tbl_products`.`item_id` = `tbl_items`.`item_id`
LEFT JOIN `tbl_measurement_type` ON `tbl_measurement_type`.`type_id` = `tbl_items`.`measurement_unit_id`
LEFT JOIN `tbl_close_shift_lubes_vat` ON `tbl_close_shift_lubes_vat`.`id` = `tbl_close_shift_lubes`.`close_shift_id`
WHERE `sales_qty` > 0
AND `tbl_close_shift_lubes`.`shift_id` IN('300', '299', '298', '297', '296', '295', '294', '293', '292', '291', '290', '289', '288', '287', '286', '285', '284', '283', '282', '281', '280', '279', '278', '277', '276', '275', '274', '273', '272', '271', '270', '269', '268', '267', '266', '265', '264', '263', '262', '261', '260', '259', '258', '257', '256', '255', '254', '253', '252', '251', '250', '249', '248', '247', '246', '245', '244', '243', '242', '241')
GROUP BY `tbl_close_shift_lubes`.`item_id`
ORDER BY `tbl_items`.`item_name`
ERROR - 2022-05-20 15:56:35 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-20 15:56:35 --> Query error: Unknown column 'tbl_close_shift_lubes.sales_qty' in 'field list' - Invalid query: SELECT SUM(tbl_close_shift_lubes.sales_qty * tbl_measurement_type.value) as vol, SUM(tbl_close_shift_lubes.sales_qty *tbl_close_shift_lubes.price) as amnt, SUM(tbl_close_shift_lubes.sales_qty * (price / (1+tbl_close_shift_lubes_vat.vat))) as netamnt, `item_name`, `category_id`, SUM((sales_qty * (price / (1+tbl_close_shift_lubes_vat.vat))) * tbl_close_shift_lubes_vat.vat) as vat
FROM `tbl_employees`
LEFT JOIN `tbl_items` ON `tbl_items`.`item_id` = `tbl_close_shift_lubes`.`item_id`
LEFT JOIN `tbl_products` ON `tbl_products`.`item_id` = `tbl_items`.`item_id`
LEFT JOIN `tbl_measurement_type` ON `tbl_measurement_type`.`type_id` = `tbl_items`.`measurement_unit_id`
LEFT JOIN `tbl_close_shift_lubes_vat` ON `tbl_close_shift_lubes_vat`.`id` = `tbl_close_shift_lubes`.`close_shift_id`
WHERE `sales_qty` > 0
AND `tbl_close_shift_lubes`.`shift_id` IN('300', '299', '298', '297', '296', '295', '294', '293', '292', '291', '290', '289', '288', '287', '286', '285', '284', '283', '282', '281', '280', '279', '278', '277', '276', '275', '274', '273', '272', '271', '270', '269', '268', '267', '266', '265', '264', '263', '262', '261', '260', '259', '258', '257', '256', '255', '254', '253', '252', '251', '250', '249', '248', '247', '246', '245', '244', '243', '242', '241')
GROUP BY `tbl_employees`.`emp_id`
ORDER BY `tbl_employees`.`emp_id`
ERROR - 2022-05-20 15:57:01 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-20 15:57:01 --> Query error: Unknown column 'tbl_close_shift_lubes.sales_qty' in 'field list' - Invalid query: SELECT SUM(tbl_close_shift_lubes.sales_qty * tbl_measurement_type.value) as vol, SUM(tbl_close_shift_lubes.sales_qty *tbl_close_shift_lubes.price) as amnt, SUM(tbl_close_shift_lubes.sales_qty * (price / (1+tbl_close_shift_lubes_vat.vat))) as netamnt, `item_name`, `category_id`, SUM((sales_qty * (price / (1+tbl_close_shift_lubes_vat.vat))) * tbl_close_shift_lubes_vat.vat) as vat
FROM `tbl_employees`
LEFT JOIN `tbl_items` ON `tbl_items`.`item_id` = `tbl_close_shift_lubes`.`item_id`
LEFT JOIN `tbl_products` ON `tbl_products`.`item_id` = `tbl_items`.`item_id`
LEFT JOIN `tbl_measurement_type` ON `tbl_measurement_type`.`type_id` = `tbl_items`.`measurement_unit_id`
LEFT JOIN `tbl_close_shift_lubes_vat` ON `tbl_close_shift_lubes_vat`.`id` = `tbl_close_shift_lubes`.`close_shift_id`
WHERE `sales_qty` > 0
AND `tbl_close_shift_lubes`.`shift_id` IN('300', '299', '298', '297', '296', '295', '294', '293', '292', '291', '290', '289', '288', '287', '286', '285', '284', '283', '282', '281', '280', '279', '278', '277', '276', '275', '274', '273', '272', '271', '270', '269', '268', '267', '266', '265', '264', '263', '262', '261', '260', '259', '258', '257', '256', '255', '254', '253', '252', '251', '250', '249', '248', '247', '246', '245', '244', '243', '242', '241')
GROUP BY `tbl_employees`.`emp_id`
ORDER BY `tbl_employees`.`emp_id`
ERROR - 2022-05-20 15:58:33 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-20 15:58:33 --> Query error: Unknown column 'tbl_assigned_centres.centre_id' in 'on clause' - Invalid query: SELECT SUM(tbl_close_shift_lubes.sales_qty * tbl_measurement_type.value) as vol, SUM(tbl_close_shift_lubes.sales_qty *tbl_close_shift_lubes.price) as amnt, SUM(tbl_close_shift_lubes.sales_qty * (price / (1+tbl_close_shift_lubes_vat.vat))) as netamnt, `item_name`, `category_id`, SUM((sales_qty * (price / (1+tbl_close_shift_lubes_vat.vat))) * tbl_close_shift_lubes_vat.vat) as vat
FROM `tbl_employees`
LEFT JOIN `tbl_close_shift_lubes` ON `tbl_close_shift_lubes`.`centre_id` = `tbl_assigned_centres`.`centre_id`
LEFT JOIN `tbl_items` ON `tbl_items`.`item_id` = `tbl_close_shift_lubes`.`item_id`
LEFT JOIN `tbl_products` ON `tbl_products`.`item_id` = `tbl_items`.`item_id`
LEFT JOIN `tbl_measurement_type` ON `tbl_measurement_type`.`type_id` = `tbl_items`.`measurement_unit_id`
LEFT JOIN `tbl_close_shift_lubes_vat` ON `tbl_close_shift_lubes_vat`.`id` = `tbl_close_shift_lubes`.`close_shift_id`
WHERE `sales_qty` > 0
AND `tbl_close_shift_lubes`.`shift_id` IN('300', '299', '298', '297', '296', '295', '294', '293', '292', '291', '290', '289', '288', '287', '286', '285', '284', '283', '282', '281', '280', '279', '278', '277', '276', '275', '274', '273', '272', '271', '270', '269', '268', '267', '266', '265', '264', '263', '262', '261', '260', '259', '258', '257', '256', '255', '254', '253', '252', '251', '250', '249', '248', '247', '246', '245', '244', '243', '242', '241')
GROUP BY `tbl_employees`.`emp_id`
ORDER BY `tbl_employees`.`emp_id`
ERROR - 2022-05-20 16:03:41 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-20 16:07:32 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-20 16:08:04 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-20 16:09:20 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-20 19:56:41 --> 404 Page Not Found: Payment/images
ERROR - 2022-05-20 20:00:07 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-20 20:00:12 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-20 20:00:12 --> Query error: Not unique table/alias: 'tbl_close_shift_lubes' - Invalid query: SELECT SUM(tbl_close_shift_lubes.sales_qty * tbl_measurement_type.value) as vol, SUM(tbl_close_shift_lubes.sales_qty *tbl_close_shift_lubes.price) as amnt, SUM(tbl_close_shift_lubes.sales_qty * (price / (1+tbl_close_shift_lubes_vat.vat))) as netamnt, `item_name`, `category_id`, SUM((sales_qty * (price / (1+tbl_close_shift_lubes_vat.vat))) * tbl_close_shift_lubes_vat.vat) as vat
FROM `tbl_employees`
LEFT JOIN `tbl_assigned_centres` ON `tbl_assigned_centres`.`employee_id` = `tbl_employees`.`emp_id`
LEFT JOIN `tbl_close_shift_lubes` ON `tbl_close_shift_lubes`.`centre_id` = `tbl_assigned_centres`.`centre_id`
LEFT JOIN `tbl_close_shift_lubes` ON `tbl_close_shift_lubes`.`shift_id` = `tbl_assigned_centres`.`shift_id`
LEFT JOIN `tbl_items` ON `tbl_items`.`item_id` = `tbl_close_shift_lubes`.`item_id`
LEFT JOIN `tbl_products` ON `tbl_products`.`item_id` = `tbl_items`.`item_id`
LEFT JOIN `tbl_measurement_type` ON `tbl_measurement_type`.`type_id` = `tbl_items`.`measurement_unit_id`
LEFT JOIN `tbl_close_shift_lubes_vat` ON `tbl_close_shift_lubes_vat`.`id` = `tbl_close_shift_lubes`.`close_shift_id`
WHERE `sales_qty` > 0
AND `tbl_close_shift_lubes`.`shift_id` IN('300', '299', '298', '297', '296', '295', '294', '293', '292', '291', '290', '289', '288', '287', '286', '285', '284', '283', '282', '281', '280', '279', '278', '277', '276', '275', '274', '273', '272', '271', '270', '269', '268', '267', '266', '265', '264', '263', '262', '261', '260', '259', '258', '257', '256', '255', '254', '253', '252', '251', '250', '249', '248', '247', '246', '245', '244', '243', '242', '241')
GROUP BY `tbl_employees`.`emp_id`
ORDER BY `tbl_employees`.`emp_id`
ERROR - 2022-05-20 20:00:53 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-20 20:00:53 --> Query error: Not unique table/alias: 'tbl_close_shift_lubes' - Invalid query: SELECT SUM(tbl_close_shift_lubes.sales_qty * tbl_measurement_type.value) as vol, SUM(tbl_close_shift_lubes.sales_qty *tbl_close_shift_lubes.price) as amnt, SUM(tbl_close_shift_lubes.sales_qty * (price / (1+tbl_close_shift_lubes_vat.vat))) as netamnt, `item_name`, `category_id`, SUM((sales_qty * (price / (1+tbl_close_shift_lubes_vat.vat))) * tbl_close_shift_lubes_vat.vat) as vat
FROM `tbl_employees`
LEFT JOIN `tbl_assigned_centres` ON `tbl_assigned_centres`.`employee_id` = `tbl_employees`.`emp_id`
LEFT JOIN `tbl_close_shift_lubes` ON `tbl_close_shift_lubes`.`centre_id` = `tbl_assigned_centres`.`centre_id`
LEFT JOIN `tbl_close_shift_lubes` ON `tbl_close_shift_lubes`.`shift_id` = `tbl_assigned_centres`.`shift_id`
LEFT JOIN `tbl_items` ON `tbl_items`.`item_id` = `tbl_close_shift_lubes`.`item_id`
LEFT JOIN `tbl_products` ON `tbl_products`.`item_id` = `tbl_items`.`item_id`
LEFT JOIN `tbl_measurement_type` ON `tbl_measurement_type`.`type_id` = `tbl_items`.`measurement_unit_id`
LEFT JOIN `tbl_close_shift_lubes_vat` ON `tbl_close_shift_lubes_vat`.`id` = `tbl_close_shift_lubes`.`close_shift_id`
WHERE `sales_qty` > 0
AND `tbl_close_shift_lubes`.`shift_id` IN('300', '299', '298', '297', '296', '295', '294', '293', '292', '291', '290', '289', '288', '287', '286', '285', '284', '283', '282', '281', '280', '279', '278', '277', '276', '275', '274', '273', '272', '271', '270', '269', '268', '267', '266', '265', '264', '263', '262', '261', '260', '259', '258', '257', '256', '255', '254', '253', '252', '251', '250', '249', '248', '247', '246', '245', '244', '243', '242', '241')
GROUP BY `tbl_employees`.`emp_id`
ORDER BY `tbl_employees`.`emp_id`
ERROR - 2022-05-20 20:03:06 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-20 20:04:47 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-20 20:06:01 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-20 20:07:13 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-20 20:10:43 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-20 20:13:43 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-20 20:14:37 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-20 20:16:25 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-20 20:20:47 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-20 20:25:39 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-20 20:25:39 --> Severity: error --> Exception: syntax error, unexpected '->' (T_OBJECT_OPERATOR) F:\xamp\htdocs\posmain\application\models\ShiftReports_model.php 638
ERROR - 2022-05-20 20:26:26 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-20 20:28:12 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-20 20:31:28 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-20 20:46:46 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-20 20:46:46 --> Severity: error --> Exception: syntax error, unexpected '->' (T_OBJECT_OPERATOR) F:\xamp\htdocs\posmain\application\models\ShiftReports_model.php 638
ERROR - 2022-05-20 20:46:52 --> Severity: error --> Exception: syntax error, unexpected '->' (T_OBJECT_OPERATOR) F:\xamp\htdocs\posmain\application\models\ShiftReports_model.php 638
ERROR - 2022-05-20 20:48:53 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-20 20:48:53 --> Severity: error --> Exception: syntax error, unexpected '->' (T_OBJECT_OPERATOR) F:\xamp\htdocs\posmain\application\models\ShiftReports_model.php 638
ERROR - 2022-05-20 20:49:50 --> Severity: error --> Exception: syntax error, unexpected ',' F:\xamp\htdocs\posmain\application\models\ShiftReports_model.php 638
ERROR - 2022-05-20 20:50:08 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-20 20:54:16 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-20 20:54:16 --> Query error: Unknown column 'tbl_assigned_centres.employee_id' in 'field list' - Invalid query: SELECT `tbl_assigned_centres`.`employee_id`, `tbl_employees`.`name`, SUM(tbl_close_shift_job_card.quantity * tbl_measurement_type.value) as vol, SUM(quantity * tbl_close_shift_job_card.unit_price) as amnt, SUM(quantity  * (tbl_close_shift_job_card.unit_price / (1+tbl_close_shift_job_card_vat.vat))) as netamnt, `item_name`, SUM((quantity * (tbl_close_shift_job_card.unit_price / (1+tbl_close_shift_job_card_vat.vat))) * tbl_close_shift_job_card_vat.vat) as vat, "jc" as `category_id`
FROM `tbl_employees`
LEFT JOIN `tbl_close_shift_job_card` ON `tbl_close_shift_job_card`.`employee_id` = `tbl_employees`.`emp_id`
LEFT JOIN `tbl_items` ON `tbl_items`.`item_id` = `tbl_close_shift_job_card`.`item_id`
LEFT JOIN `tbl_close_shift_job_card_vat` ON `tbl_close_shift_job_card_vat`.`id` = `tbl_close_shift_job_card`.`close_shift_id`
LEFT JOIN `tbl_measurement_type` ON `tbl_measurement_type`.`type_id` = `tbl_items`.`measurement_unit_id`
WHERE `quantity` > 0
AND `tbl_close_shift_job_card`.`shift_id` IN('300', '299', '298', '297', '296', '295', '294', '293', '292', '291', '290', '289', '288', '287', '286', '285', '284', '283', '282', '281', '280', '279', '278', '277', '276', '275', '274', '273', '272', '271', '270', '269', '268', '267', '266', '265', '264', '263', '262', '261', '260', '259', '258', '257', '256', '255', '254', '253', '252', '251', '250', '249', '248', '247', '246', '245', '244', '243', '242', '241')
GROUP BY `tbl_employees`.`emp_id`
ORDER BY `tbl_assigned_centres`.`employee_id`
ERROR - 2022-05-20 20:55:57 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-20 20:55:57 --> Query error: Unknown column 'tbl_assigned_centres.employee_id' in 'field list' - Invalid query: SELECT `tbl_assigned_centres`.`employee_id`, `tbl_employees`.`name`, SUM(tbl_close_shift_job_card.quantity * tbl_measurement_type.value) as vol, SUM(quantity * tbl_close_shift_job_card.unit_price) as amnt, SUM(quantity  * (tbl_close_shift_job_card.unit_price / (1+tbl_close_shift_job_card_vat.vat))) as netamnt, `item_name`, SUM((quantity * (tbl_close_shift_job_card.unit_price / (1+tbl_close_shift_job_card_vat.vat))) * tbl_close_shift_job_card_vat.vat) as vat, "jc" as `category_id`
FROM `tbl_employees`
LEFT JOIN `tbl_close_shift_job_card` ON `tbl_close_shift_job_card`.`employee_id` = `tbl_employees`.`emp_id`
LEFT JOIN `tbl_items` ON `tbl_items`.`item_id` = `tbl_close_shift_job_card`.`item_id`
LEFT JOIN `tbl_close_shift_job_card_vat` ON `tbl_close_shift_job_card_vat`.`id` = `tbl_close_shift_job_card`.`close_shift_id`
LEFT JOIN `tbl_measurement_type` ON `tbl_measurement_type`.`type_id` = `tbl_items`.`measurement_unit_id`
WHERE `quantity` > 0
AND `tbl_close_shift_job_card`.`shift_id` IN('300', '299', '298', '297', '296', '295', '294', '293', '292', '291', '290', '289', '288', '287', '286', '285', '284', '283', '282', '281', '280', '279', '278', '277', '276', '275', '274', '273', '272', '271', '270', '269', '268', '267', '266', '265', '264', '263', '262', '261', '260', '259', '258', '257', '256', '255', '254', '253', '252', '251', '250', '249', '248', '247', '246', '245', '244', '243', '242', '241')
GROUP BY `tbl_employees`.`emp_id`
ORDER BY `tbl_close_shift_job_card`.`employee_id`
ERROR - 2022-05-20 20:56:57 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-20 20:56:57 --> Query error: Unknown column 'tbl_close_shift_job_card.employee_id' in 'field list' - Invalid query: SELECT `tbl_close_shift_job_card`.`employee_id`, `tbl_employees`.`name`, SUM(tbl_close_shift_job_card.quantity * tbl_measurement_type.value) as vol, SUM(quantity * tbl_close_shift_job_card.unit_price) as amnt, SUM(quantity  * (tbl_close_shift_job_card.unit_price / (1+tbl_close_shift_job_card_vat.vat))) as netamnt, `item_name`, SUM((quantity * (tbl_close_shift_job_card.unit_price / (1+tbl_close_shift_job_card_vat.vat))) * tbl_close_shift_job_card_vat.vat) as vat, "jc" as `category_id`
FROM `tbl_employees`
LEFT JOIN `tbl_close_shift_job_card` ON `tbl_close_shift_job_card`.`employee_id` = `tbl_employees`.`emp_id`
LEFT JOIN `tbl_items` ON `tbl_items`.`item_id` = `tbl_close_shift_job_card`.`item_id`
LEFT JOIN `tbl_close_shift_job_card_vat` ON `tbl_close_shift_job_card_vat`.`id` = `tbl_close_shift_job_card`.`close_shift_id`
LEFT JOIN `tbl_measurement_type` ON `tbl_measurement_type`.`type_id` = `tbl_items`.`measurement_unit_id`
WHERE `quantity` > 0
AND `tbl_close_shift_job_card`.`shift_id` IN('300', '299', '298', '297', '296', '295', '294', '293', '292', '291', '290', '289', '288', '287', '286', '285', '284', '283', '282', '281', '280', '279', '278', '277', '276', '275', '274', '273', '272', '271', '270', '269', '268', '267', '266', '265', '264', '263', '262', '261', '260', '259', '258', '257', '256', '255', '254', '253', '252', '251', '250', '249', '248', '247', '246', '245', '244', '243', '242', '241')
GROUP BY `tbl_employees`.`emp_id`
ORDER BY `tbl_close_shift_job_card`.`employee_id`
ERROR - 2022-05-20 21:02:14 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-20 21:02:15 --> Query error: Unknown column 'tbl_close_shift_job_card.employee_id' in 'field list' - Invalid query: SELECT `tbl_close_shift_job_card`.`employee_id`, `tbl_employees`.`name`, SUM(tbl_close_shift_job_card.quantity * tbl_measurement_type.value) as vol, SUM(quantity * tbl_close_shift_job_card.unit_price) as amnt, SUM(quantity  * (tbl_close_shift_job_card.unit_price / (1+tbl_close_shift_job_card_vat.vat))) as netamnt, `item_name`, SUM((quantity * (tbl_close_shift_job_card.unit_price / (1+tbl_close_shift_job_card_vat.vat))) * tbl_close_shift_job_card_vat.vat) as vat, "jc" as `category_id`
FROM `tbl_employees`
LEFT JOIN `tbl_close_shift_job_card` ON `tbl_close_shift_job_card`.`employee_id` = `tbl_employees`.`emp_id`
LEFT JOIN `tbl_items` ON `tbl_items`.`item_id` = `tbl_close_shift_job_card`.`item_id`
LEFT JOIN `tbl_close_shift_job_card_vat` ON `tbl_close_shift_job_card_vat`.`id` = `tbl_close_shift_job_card`.`close_shift_id`
LEFT JOIN `tbl_measurement_type` ON `tbl_measurement_type`.`type_id` = `tbl_items`.`measurement_unit_id`
WHERE `quantity` > 0
AND `tbl_close_shift_job_card`.`shift_id` IN('300', '299', '298', '297', '296', '295', '294', '293', '292', '291', '290', '289', '288', '287', '286', '285', '284', '283', '282', '281', '280', '279', '278', '277', '276', '275', '274', '273', '272', '271', '270', '269', '268', '267', '266', '265', '264', '263', '262', '261', '260', '259', '258', '257', '256', '255', '254', '253', '252', '251', '250', '249', '248', '247', '246', '245', '244', '243', '242', '241')
GROUP BY `tbl_employees`.`emp_id`
ORDER BY `tbl_close_shift_job_card`.`employee_id`
ERROR - 2022-05-20 21:06:07 --> 404 Page Not Found: Payment/images
ERROR - 2022-05-20 21:07:47 --> Severity: error --> Exception: syntax error, unexpected ',' F:\xamp\htdocs\posmain\application\models\ShiftReports_model.php 638
ERROR - 2022-05-20 21:09:40 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-20 21:09:44 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-20 21:09:44 --> Query error: Unknown column 'tbl_assigned_centres.employee_id' in 'field list' - Invalid query: SELECT `tbl_assigned_centres`.`employee_id`, `tbl_employees`.`name`, `tbl_items`.`item_id`, `item_name`, 0 as `category_id`, CASE reading
						      WHEN 4 THEN SUM(sales_manual_meter * tbl_measurement_type.value )
						      WHEN 3 THEN SUM(tbl_close_shift_fuels.sales_elec_meter * tbl_measurement_type.value)
						      WHEN 2 THEN SUM(tbl_close_shift_fuels.sales_elec_cash / tbl_close_shift_fuels.unit_price * tbl_measurement_type.value)
						      WHEN 5 THEN GREATEST(SUM(tbl_close_shift_fuels.sales_elec_meter), SUM(tbl_close_shift_fuels.sales_elec_cash / tbl_close_shift_fuels.unit_price) * tbl_measurement_type.value)
						      ELSE GREATEST(SUM(sales_manual_meter), SUM(tbl_close_shift_fuels.sales_elec_meter), SUM(tbl_close_shift_fuels.sales_elec_cash / tbl_close_shift_fuels.unit_price) * tbl_measurement_type.value)
					  		END as vol, CASE reading
						      WHEN 4 THEN SUM(sales_manual_cash)
						      WHEN 3 THEN SUM(sales_elec_meter * tbl_close_shift_fuels.unit_price)
						      WHEN 2 THEN SUM(sales_elec_cash)
						      WHEN 5 THEN GREATEST(SUM(sales_elec_meter * tbl_close_shift_fuels.unit_price), SUM(sales_elec_cash))
						      ELSE GREATEST(SUM(sales_manual_cash), SUM(sales_elec_meter * tbl_close_shift_fuels.unit_price), SUM(sales_elec_cash))
					  		END as amnt, CASE reading
						      WHEN 4 THEN SUM(sales_manual_cash/(1+tbl_close_shift_fuels_vat.vat))
						      WHEN 3 THEN SUM(sales_elec_meter * (tbl_close_shift_fuels.unit_price/(1+tbl_close_shift_fuels_vat.vat)))
						      WHEN 2 THEN SUM(sales_elec_cash/(1+tbl_close_shift_fuels_vat.vat))
						      WHEN 5 THEN GREATEST(SUM(sales_elec_meter * (tbl_close_shift_fuels.unit_price/(1+tbl_close_shift_fuels_vat.vat))), SUM(sales_elec_cash/(1+tbl_close_shift_fuels_vat.vat)))
						      ELSE GREATEST(SUM(sales_manual_cash/(1+tbl_close_shift_fuels_vat.vat)), SUM(sales_elec_meter * (tbl_close_shift_fuels.unit_price/(1+tbl_close_shift_fuels_vat.vat))), SUM(sales_elec_cash/(1+tbl_close_shift_fuels_vat.vat)))
					  		END as netamnt, CASE reading
						      WHEN 4 THEN SUM((sales_manual_cash/(1+tbl_close_shift_fuels_vat.vat)) * tbl_close_shift_fuels_vat.vat)
						      WHEN 3 THEN SUM((sales_elec_meter * (tbl_close_shift_fuels.unit_price/(1+tbl_close_shift_fuels_vat.vat))) * tbl_close_shift_fuels_vat.vat)
						      WHEN 2 THEN SUM((sales_elec_cash/(1+tbl_close_shift_fuels_vat.vat)) * tbl_close_shift_fuels_vat.vat)
						      WHEN 5 THEN GREATEST(SUM(sales_elec_meter * (tbl_close_shift_fuels.unit_price/(1+tbl_close_shift_fuels_vat.vat)) * tbl_close_shift_fuels_vat.vat), SUM((sales_elec_cash/(1+tbl_close_shift_fuels_vat.vat)) * tbl_close_shift_fuels_vat.vat))
						      ELSE GREATEST(SUM((sales_manual_cash/(1+tbl_close_shift_fuels_vat.vat)) * tbl_close_shift_fuels_vat.vat), SUM(sales_elec_meter * (tbl_close_shift_fuels.unit_price/(1+tbl_close_shift_fuels_vat.vat)) * tbl_close_shift_fuels_vat.vat), SUM((sales_elec_cash/(1+tbl_close_shift_fuels_vat.vat)) * tbl_close_shift_fuels_vat.vat))
					  		END as vat
FROM `tbl_employees`
LEFT JOIN `tbl_close_shift_fuels` ON `tbl_close_shift_fuels`.`employee_id` = `tbl_employees`.`emp_id`
LEFT JOIN `tbl_pumps` ON `tbl_pumps`.`pump_id` = `tbl_close_shift_fuels`.`pump_id`
LEFT JOIN `tbl_items` ON `tbl_items`.`item_id` = `tbl_pumps`.`fuel_product_id`
LEFT JOIN `tbl_measurement_type` ON `tbl_measurement_type`.`type_id` = `tbl_items`.`measurement_unit_id`
LEFT JOIN `tbl_shifts` ON `tbl_shifts`.`shift_id` = `tbl_close_shift_fuels`.`shift_id`
LEFT JOIN `tbl_close_shift_fuels_vat` ON `tbl_close_shift_fuels_vat`.`id` = `tbl_close_shift_fuels`.`close_shift_fuel_id`
WHERE `tbl_close_shift_fuels`.`shift_id` IN('300', '299', '298', '297', '296', '295', '294', '293', '292', '291', '290', '289', '288', '287', '286', '285', '284', '283', '282', '281', '280', '279', '278', '277', '276', '275', '274', '273', '272', '271', '270', '269', '268', '267', '266', '265', '264', '263', '262', '261', '260', '259', '258', '257', '256', '255', '254', '253', '252', '251', '250', '249', '248', '247', '246', '245', '244', '243', '242', '241')
GROUP BY `tbl_employees`.`emp_id`
ORDER BY `tbl_assigned_centres`.`employee_id`
ERROR - 2022-05-20 21:10:05 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-20 21:10:05 --> Query error: Unknown column 'tbl_assigned_centres.employee_id' in 'field list' - Invalid query: SELECT `tbl_assigned_centres`.`employee_id`, `tbl_employees`.`name`, `tbl_items`.`item_id`, `item_name`, 0 as `category_id`, CASE reading
						      WHEN 4 THEN SUM(sales_manual_meter * tbl_measurement_type.value )
						      WHEN 3 THEN SUM(tbl_close_shift_fuels.sales_elec_meter * tbl_measurement_type.value)
						      WHEN 2 THEN SUM(tbl_close_shift_fuels.sales_elec_cash / tbl_close_shift_fuels.unit_price * tbl_measurement_type.value)
						      WHEN 5 THEN GREATEST(SUM(tbl_close_shift_fuels.sales_elec_meter), SUM(tbl_close_shift_fuels.sales_elec_cash / tbl_close_shift_fuels.unit_price) * tbl_measurement_type.value)
						      ELSE GREATEST(SUM(sales_manual_meter), SUM(tbl_close_shift_fuels.sales_elec_meter), SUM(tbl_close_shift_fuels.sales_elec_cash / tbl_close_shift_fuels.unit_price) * tbl_measurement_type.value)
					  		END as vol, CASE reading
						      WHEN 4 THEN SUM(sales_manual_cash)
						      WHEN 3 THEN SUM(sales_elec_meter * tbl_close_shift_fuels.unit_price)
						      WHEN 2 THEN SUM(sales_elec_cash)
						      WHEN 5 THEN GREATEST(SUM(sales_elec_meter * tbl_close_shift_fuels.unit_price), SUM(sales_elec_cash))
						      ELSE GREATEST(SUM(sales_manual_cash), SUM(sales_elec_meter * tbl_close_shift_fuels.unit_price), SUM(sales_elec_cash))
					  		END as amnt, CASE reading
						      WHEN 4 THEN SUM(sales_manual_cash/(1+tbl_close_shift_fuels_vat.vat))
						      WHEN 3 THEN SUM(sales_elec_meter * (tbl_close_shift_fuels.unit_price/(1+tbl_close_shift_fuels_vat.vat)))
						      WHEN 2 THEN SUM(sales_elec_cash/(1+tbl_close_shift_fuels_vat.vat))
						      WHEN 5 THEN GREATEST(SUM(sales_elec_meter * (tbl_close_shift_fuels.unit_price/(1+tbl_close_shift_fuels_vat.vat))), SUM(sales_elec_cash/(1+tbl_close_shift_fuels_vat.vat)))
						      ELSE GREATEST(SUM(sales_manual_cash/(1+tbl_close_shift_fuels_vat.vat)), SUM(sales_elec_meter * (tbl_close_shift_fuels.unit_price/(1+tbl_close_shift_fuels_vat.vat))), SUM(sales_elec_cash/(1+tbl_close_shift_fuels_vat.vat)))
					  		END as netamnt, CASE reading
						      WHEN 4 THEN SUM((sales_manual_cash/(1+tbl_close_shift_fuels_vat.vat)) * tbl_close_shift_fuels_vat.vat)
						      WHEN 3 THEN SUM((sales_elec_meter * (tbl_close_shift_fuels.unit_price/(1+tbl_close_shift_fuels_vat.vat))) * tbl_close_shift_fuels_vat.vat)
						      WHEN 2 THEN SUM((sales_elec_cash/(1+tbl_close_shift_fuels_vat.vat)) * tbl_close_shift_fuels_vat.vat)
						      WHEN 5 THEN GREATEST(SUM(sales_elec_meter * (tbl_close_shift_fuels.unit_price/(1+tbl_close_shift_fuels_vat.vat)) * tbl_close_shift_fuels_vat.vat), SUM((sales_elec_cash/(1+tbl_close_shift_fuels_vat.vat)) * tbl_close_shift_fuels_vat.vat))
						      ELSE GREATEST(SUM((sales_manual_cash/(1+tbl_close_shift_fuels_vat.vat)) * tbl_close_shift_fuels_vat.vat), SUM(sales_elec_meter * (tbl_close_shift_fuels.unit_price/(1+tbl_close_shift_fuels_vat.vat)) * tbl_close_shift_fuels_vat.vat), SUM((sales_elec_cash/(1+tbl_close_shift_fuels_vat.vat)) * tbl_close_shift_fuels_vat.vat))
					  		END as vat
FROM `tbl_employees`
LEFT JOIN `tbl_close_shift_fuels` ON `tbl_close_shift_fuels`.`employee_id` = `tbl_employees`.`emp_id`
LEFT JOIN `tbl_pumps` ON `tbl_pumps`.`pump_id` = `tbl_close_shift_fuels`.`pump_id`
LEFT JOIN `tbl_items` ON `tbl_items`.`item_id` = `tbl_pumps`.`fuel_product_id`
LEFT JOIN `tbl_measurement_type` ON `tbl_measurement_type`.`type_id` = `tbl_items`.`measurement_unit_id`
LEFT JOIN `tbl_shifts` ON `tbl_shifts`.`shift_id` = `tbl_close_shift_fuels`.`shift_id`
LEFT JOIN `tbl_close_shift_fuels_vat` ON `tbl_close_shift_fuels_vat`.`id` = `tbl_close_shift_fuels`.`close_shift_fuel_id`
WHERE `tbl_close_shift_fuels`.`shift_id` IN('300', '299', '298', '297', '296', '295', '294', '293', '292', '291', '290', '289', '288', '287', '286', '285', '284', '283', '282', '281', '280', '279', '278', '277', '276', '275', '274', '273', '272', '271', '270', '269', '268', '267', '266', '265', '264', '263', '262', '261', '260', '259', '258', '257', '256', '255', '254', '253', '252', '251', '250', '249', '248', '247', '246', '245', '244', '243', '242', '241')
GROUP BY `tbl_employees`.`emp_id`
ORDER BY `tbl_assigned_centres`.`employee_id`
ERROR - 2022-05-20 21:11:38 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-20 21:11:38 --> Query error: Unknown column 'tbl_assigned_centres.employee_id' in 'order clause' - Invalid query: SELECT `tbl_employees`.`emp_id`, `tbl_employees`.`name`, `tbl_items`.`item_id`, `item_name`, 0 as `category_id`, CASE reading
						      WHEN 4 THEN SUM(sales_manual_meter * tbl_measurement_type.value )
						      WHEN 3 THEN SUM(tbl_close_shift_fuels.sales_elec_meter * tbl_measurement_type.value)
						      WHEN 2 THEN SUM(tbl_close_shift_fuels.sales_elec_cash / tbl_close_shift_fuels.unit_price * tbl_measurement_type.value)
						      WHEN 5 THEN GREATEST(SUM(tbl_close_shift_fuels.sales_elec_meter), SUM(tbl_close_shift_fuels.sales_elec_cash / tbl_close_shift_fuels.unit_price) * tbl_measurement_type.value)
						      ELSE GREATEST(SUM(sales_manual_meter), SUM(tbl_close_shift_fuels.sales_elec_meter), SUM(tbl_close_shift_fuels.sales_elec_cash / tbl_close_shift_fuels.unit_price) * tbl_measurement_type.value)
					  		END as vol, CASE reading
						      WHEN 4 THEN SUM(sales_manual_cash)
						      WHEN 3 THEN SUM(sales_elec_meter * tbl_close_shift_fuels.unit_price)
						      WHEN 2 THEN SUM(sales_elec_cash)
						      WHEN 5 THEN GREATEST(SUM(sales_elec_meter * tbl_close_shift_fuels.unit_price), SUM(sales_elec_cash))
						      ELSE GREATEST(SUM(sales_manual_cash), SUM(sales_elec_meter * tbl_close_shift_fuels.unit_price), SUM(sales_elec_cash))
					  		END as amnt, CASE reading
						      WHEN 4 THEN SUM(sales_manual_cash/(1+tbl_close_shift_fuels_vat.vat))
						      WHEN 3 THEN SUM(sales_elec_meter * (tbl_close_shift_fuels.unit_price/(1+tbl_close_shift_fuels_vat.vat)))
						      WHEN 2 THEN SUM(sales_elec_cash/(1+tbl_close_shift_fuels_vat.vat))
						      WHEN 5 THEN GREATEST(SUM(sales_elec_meter * (tbl_close_shift_fuels.unit_price/(1+tbl_close_shift_fuels_vat.vat))), SUM(sales_elec_cash/(1+tbl_close_shift_fuels_vat.vat)))
						      ELSE GREATEST(SUM(sales_manual_cash/(1+tbl_close_shift_fuels_vat.vat)), SUM(sales_elec_meter * (tbl_close_shift_fuels.unit_price/(1+tbl_close_shift_fuels_vat.vat))), SUM(sales_elec_cash/(1+tbl_close_shift_fuels_vat.vat)))
					  		END as netamnt, CASE reading
						      WHEN 4 THEN SUM((sales_manual_cash/(1+tbl_close_shift_fuels_vat.vat)) * tbl_close_shift_fuels_vat.vat)
						      WHEN 3 THEN SUM((sales_elec_meter * (tbl_close_shift_fuels.unit_price/(1+tbl_close_shift_fuels_vat.vat))) * tbl_close_shift_fuels_vat.vat)
						      WHEN 2 THEN SUM((sales_elec_cash/(1+tbl_close_shift_fuels_vat.vat)) * tbl_close_shift_fuels_vat.vat)
						      WHEN 5 THEN GREATEST(SUM(sales_elec_meter * (tbl_close_shift_fuels.unit_price/(1+tbl_close_shift_fuels_vat.vat)) * tbl_close_shift_fuels_vat.vat), SUM((sales_elec_cash/(1+tbl_close_shift_fuels_vat.vat)) * tbl_close_shift_fuels_vat.vat))
						      ELSE GREATEST(SUM((sales_manual_cash/(1+tbl_close_shift_fuels_vat.vat)) * tbl_close_shift_fuels_vat.vat), SUM(sales_elec_meter * (tbl_close_shift_fuels.unit_price/(1+tbl_close_shift_fuels_vat.vat)) * tbl_close_shift_fuels_vat.vat), SUM((sales_elec_cash/(1+tbl_close_shift_fuels_vat.vat)) * tbl_close_shift_fuels_vat.vat))
					  		END as vat
FROM `tbl_employees`
LEFT JOIN `tbl_close_shift_fuels` ON `tbl_close_shift_fuels`.`employee_id` = `tbl_employees`.`emp_id`
LEFT JOIN `tbl_pumps` ON `tbl_pumps`.`pump_id` = `tbl_close_shift_fuels`.`pump_id`
LEFT JOIN `tbl_items` ON `tbl_items`.`item_id` = `tbl_pumps`.`fuel_product_id`
LEFT JOIN `tbl_measurement_type` ON `tbl_measurement_type`.`type_id` = `tbl_items`.`measurement_unit_id`
LEFT JOIN `tbl_shifts` ON `tbl_shifts`.`shift_id` = `tbl_close_shift_fuels`.`shift_id`
LEFT JOIN `tbl_close_shift_fuels_vat` ON `tbl_close_shift_fuels_vat`.`id` = `tbl_close_shift_fuels`.`close_shift_fuel_id`
WHERE `tbl_close_shift_fuels`.`shift_id` IN('300', '299', '298', '297', '296', '295', '294', '293', '292', '291', '290', '289', '288', '287', '286', '285', '284', '283', '282', '281', '280', '279', '278', '277', '276', '275', '274', '273', '272', '271', '270', '269', '268', '267', '266', '265', '264', '263', '262', '261', '260', '259', '258', '257', '256', '255', '254', '253', '252', '251', '250', '249', '248', '247', '246', '245', '244', '243', '242', '241')
GROUP BY `tbl_employees`.`emp_id`
ORDER BY `tbl_assigned_centres`.`employee_id`
ERROR - 2022-05-20 21:12:35 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-20 21:13:02 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-20 21:18:41 --> 404 Page Not Found: ShiftReports/images
