<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2022-05-22 09:03:59 --> 404 Page Not Found: /index
ERROR - 2022-05-22 09:04:09 --> 404 Page Not Found: /index
ERROR - 2022-05-22 09:04:14 --> 404 Page Not Found: User/images
ERROR - 2022-05-22 09:04:23 --> 404 Page Not Found: Payment/images
ERROR - 2022-05-22 09:04:33 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-22 09:21:23 --> Severity: error --> Exception: syntax error, unexpected variable "$this" /var/www/html/posmain/application/models/ShiftReports_model.php 640
ERROR - 2022-05-22 09:22:01 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-22 09:22:01 --> Query error: Unknown column 'tbl_close_shift_products.center_id' in 'on clause' - Invalid query: SELECT `tbl_employees`.`name`, SUM(sales_qty * tbl_measurement_type.value) as vol, SUM(sales_qty * price) as amnt, SUM(sales_qty * (price / (1+tbl_close_shift_products_vat.vat))) as netamnt, `item_name`, `category_id`, SUM((sales_qty * (price / (1+tbl_close_shift_products_vat.vat))) * tbl_close_shift_products_vat.vat) as vat
FROM `tbl_employees`
LEFT JOIN `tbl_assigned_centres` ON `tbl_assigned_centres`.`employee_id` = `tbl_employees`.`emp_id`
LEFT JOIN `tbl_close_shift_products` ON `tbl_close_shift_products`.`center_id` =  `tbl_assigned_centres`.`centre_id` AND `tbl_close_shift_products`.`shift_id` = `tbl_assigned_centres`.`shift_id`
LEFT JOIN `tbl_items` ON `tbl_items`.`item_id` = `tbl_close_shift_products`.`item_id`
LEFT JOIN `tbl_products` ON `tbl_products`.`item_id` = `tbl_items`.`item_id`
LEFT JOIN `tbl_measurement_type` ON `tbl_measurement_type`.`type_id` = `tbl_items`.`measurement_unit_id`
LEFT JOIN `tbl_close_shift_products_vat` ON `tbl_close_shift_products_vat`.`id` = `tbl_close_shift_products`.`close_shift_id`
WHERE `sales_qty` > 0
AND `tbl_close_shift_products`.`shift_id` IN('300', '299', '298', '297', '296', '295', '294', '293', '292', '291', '290', '289', '288', '287', '286', '285', '284', '283', '282', '281', '280', '279', '278', '277', '276', '275', '274', '273', '272', '271', '270', '269', '268', '267', '266', '265', '264', '263', '262', '261', '260', '259', '258', '257', '256', '255', '254', '253', '252', '251', '250', '249', '248', '247', '246', '245', '244', '243', '242', '241')
GROUP BY `tbl_employees`.`emp_id`
ORDER BY `tbl_employees`.`emp_id`
ERROR - 2022-05-22 09:22:43 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-22 09:22:43 --> Query error: Unknown column 'tbl_close_shift_products.center_id' in 'on clause' - Invalid query: SELECT `tbl_employees`.`name`, SUM(sales_qty * tbl_measurement_type.value) as vol, SUM(sales_qty * price) as amnt, SUM(sales_qty * (price / (1+tbl_close_shift_products_vat.vat))) as netamnt, `item_name`, `category_id`, SUM((sales_qty * (price / (1+tbl_close_shift_products_vat.vat))) * tbl_close_shift_products_vat.vat) as vat
FROM `tbl_employees`
LEFT JOIN `tbl_assigned_centres` ON `tbl_assigned_centres`.`employee_id` = `tbl_employees`.`emp_id`
LEFT JOIN `tbl_close_shift_products` ON `tbl_close_shift_products`.`center_id` =  `tbl_assigned_centres`.`centre_id` AND `tbl_close_shift_products`.`shift_id` = `tbl_assigned_centres`.`shift_id`
LEFT JOIN `tbl_items` ON `tbl_items`.`item_id` = `tbl_close_shift_products`.`item_id`
LEFT JOIN `tbl_products` ON `tbl_products`.`item_id` = `tbl_items`.`item_id`
LEFT JOIN `tbl_measurement_type` ON `tbl_measurement_type`.`type_id` = `tbl_items`.`measurement_unit_id`
LEFT JOIN `tbl_close_shift_products_vat` ON `tbl_close_shift_products_vat`.`id` = `tbl_close_shift_products`.`close_shift_id`
WHERE `sales_qty` > 0
AND `tbl_close_shift_products`.`shift_id` IN('309', '308', '307', '306', '305', '304', '303', '302', '301')
GROUP BY `tbl_employees`.`emp_id`
ORDER BY `tbl_employees`.`emp_id`
ERROR - 2022-05-22 09:24:14 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-22 09:25:24 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-22 09:58:33 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-22 10:01:51 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-22 10:20:16 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-22 10:20:47 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-22 10:21:19 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-22 10:25:37 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-22 10:37:04 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-22 10:37:08 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-22 10:37:35 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-22 10:37:39 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-22 10:37:59 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-22 10:38:02 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-22 10:38:22 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-22 10:38:26 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-22 10:47:55 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-22 10:48:02 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-22 10:48:13 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-22 10:51:46 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-22 10:53:26 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-22 10:05:48 --> Unable to connect to the database
ERROR - 2022-05-22 10:06:42 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-22 10:08:21 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-22 10:08:38 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-22 10:08:51 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-22 10:10:24 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-22 10:17:16 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-22 10:27:00 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-22 10:27:17 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-22 10:28:07 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-22 10:29:41 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-22 10:34:39 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-22 10:38:16 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-22 10:46:49 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-22 10:48:08 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-22 10:54:42 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-22 10:55:05 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-22 11:13:24 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-22 11:16:40 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-22 11:23:08 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-22 11:23:08 --> Unable to connect to the database
ERROR - 2022-05-22 11:24:00 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-22 11:24:08 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-22 11:32:17 --> Severity: error --> Exception: Call to a member function vatDetailedForPayment() on null F:\xamp\htdocs\posmain\application\controllers\Payment.php 799
ERROR - 2022-05-22 11:33:04 --> Severity: error --> Exception: Unable to locate the model you have specified: ShiftsReport_model F:\xamp\htdocs\posmain\system\core\Loader.php 348
ERROR - 2022-05-22 11:37:32 --> Query error: Unknown column 'tbl_shifts1.shift_id' in 'order clause' - Invalid query: SELECT CONCAT(tbl_shifts_names.name, " of ", DATE_FORMAT(tbl_shifts.shift_date, "%d-%b-%Y")) as shift_name, reading, tbl_shifts.shift_id, operator.name as operator, bbf_amt, DATE_FORMAT(tbl_shifts.shift_date, "%d-%b-%Y") as shift_date
FROM `tbl_shifts`
LEFT JOIN `tbl_shifts_names` ON `tbl_shifts_names`.`shift_name_id` = `tbl_shifts`.`shift_name_id`
LEFT JOIN `tbl_users` `operator` ON `operator`.`user_id` = `tbl_shifts`.`close_user_id`
WHERE DATE(tbl_shifts.shift_date) >= '1970-01-01' AND DATE(tbl_shifts.shift_date) <= '1970-01-01'
ORDER BY `tbl_shifts1`.`shift_id` ASC
ERROR - 2022-05-22 11:38:37 --> Query error: Unknown column 'tbl_shifts1.shift_id' in 'order clause' - Invalid query: SELECT CONCAT(tbl_shifts_names.name, " of ", DATE_FORMAT(tbl_shifts.shift_date, "%d-%b-%Y")) as shift_name, reading, tbl_shifts.shift_id, operator.name as operator, bbf_amt, DATE_FORMAT(tbl_shifts.shift_date, "%d-%b-%Y") as shift_date
FROM `tbl_shifts`
LEFT JOIN `tbl_shifts_names` ON `tbl_shifts_names`.`shift_name_id` = `tbl_shifts`.`shift_name_id`
LEFT JOIN `tbl_users` `operator` ON `operator`.`user_id` = `tbl_shifts`.`close_user_id`
WHERE DATE(tbl_shifts.shift_date) >= '1970-01-01' AND DATE(tbl_shifts.shift_date) <= '1970-01-01'
ORDER BY `tbl_shifts1`.`shift_id` ASC
ERROR - 2022-05-22 11:43:20 --> Query error: Unknown column 'tbl_shifts1.shift_id' in 'order clause' - Invalid query: SELECT CONCAT(tbl_shifts_names.name, " of ", DATE_FORMAT(tbl_shifts.shift_date, "%d-%b-%Y")) as shift_name, reading, tbl_shifts.shift_id, operator.name as operator, bbf_amt, DATE_FORMAT(tbl_shifts.shift_date, "%d-%b-%Y") as shift_date
FROM `tbl_shifts`
LEFT JOIN `tbl_shifts_names` ON `tbl_shifts_names`.`shift_name_id` = `tbl_shifts`.`shift_name_id`
LEFT JOIN `tbl_users` `operator` ON `operator`.`user_id` = `tbl_shifts`.`close_user_id`
WHERE DATE(tbl_shifts.shift_date) >= '1970-01-01' AND DATE(tbl_shifts.shift_date) <= '1970-01-01'
ORDER BY `tbl_shifts1`.`shift_id` ASC
ERROR - 2022-05-22 11:43:53 --> Query error: Unknown column 'tbl_shifts.shift_date1' in 'where clause' - Invalid query: SELECT CONCAT(tbl_shifts_names.name, " of ", DATE_FORMAT(tbl_shifts.shift_date, "%d-%b-%Y")) as shift_name, reading, tbl_shifts.shift_id, operator.name as operator, bbf_amt, DATE_FORMAT(tbl_shifts.shift_date, "%d-%b-%Y") as shift_date
FROM `tbl_shifts`
LEFT JOIN `tbl_shifts_names` ON `tbl_shifts_names`.`shift_name_id` = `tbl_shifts`.`shift_name_id`
LEFT JOIN `tbl_users` `operator` ON `operator`.`user_id` = `tbl_shifts`.`close_user_id`
WHERE DATE(tbl_shifts.shift_date1) >= '1970-01-01' AND DATE(tbl_shifts.shift_date) <= '1970-01-01'
ORDER BY `tbl_shifts`.`shift_id` ASC
ERROR - 2022-05-22 11:45:05 --> Query error: Unknown column 'tbl_shifts.shift_date1' in 'where clause' - Invalid query: SELECT CONCAT(tbl_shifts_names.name, " of ", DATE_FORMAT(tbl_shifts.shift_date, "%d-%b-%Y")) as shift_name, reading, tbl_shifts.shift_id, operator.name as operator, bbf_amt, DATE_FORMAT(tbl_shifts.shift_date, "%d-%b-%Y") as shift_date
FROM `tbl_shifts`
LEFT JOIN `tbl_shifts_names` ON `tbl_shifts_names`.`shift_name_id` = `tbl_shifts`.`shift_name_id`
LEFT JOIN `tbl_users` `operator` ON `operator`.`user_id` = `tbl_shifts`.`close_user_id`
WHERE DATE(tbl_shifts.shift_date1) >= '1970-01-01' AND DATE(tbl_shifts.shift_date) <= '1970-01-01'
ORDER BY `tbl_shifts`.`shift_id` ASC
ERROR - 2022-05-22 11:45:34 --> Query error: Unknown column 'tbl_shifts.shift_date1' in 'where clause' - Invalid query: SELECT CONCAT(tbl_shifts_names.name, " of ", DATE_FORMAT(tbl_shifts.shift_date, "%d-%b-%Y")) as shift_name, reading, tbl_shifts.shift_id, operator.name as operator, bbf_amt, DATE_FORMAT(tbl_shifts.shift_date, "%d-%b-%Y") as shift_date
FROM `tbl_shifts`
LEFT JOIN `tbl_shifts_names` ON `tbl_shifts_names`.`shift_name_id` = `tbl_shifts`.`shift_name_id`
LEFT JOIN `tbl_users` `operator` ON `operator`.`user_id` = `tbl_shifts`.`close_user_id`
WHERE DATE(tbl_shifts.shift_date1) >= '1972-01-01' AND DATE(tbl_shifts.shift_date) <= '1970-01-01'
ORDER BY `tbl_shifts`.`shift_id` ASC
ERROR - 2022-05-22 11:46:36 --> Query error: Unknown column 'tbl_shifts.shift_date1' in 'where clause' - Invalid query: SELECT CONCAT(tbl_shifts_names.name, " of ", DATE_FORMAT(tbl_shifts.shift_date, "%d-%b-%Y")) as shift_name, reading, tbl_shifts.shift_id, operator.name as operator, bbf_amt, DATE_FORMAT(tbl_shifts.shift_date, "%d-%b-%Y") as shift_date
FROM `tbl_shifts`
LEFT JOIN `tbl_shifts_names` ON `tbl_shifts_names`.`shift_name_id` = `tbl_shifts`.`shift_name_id`
LEFT JOIN `tbl_users` `operator` ON `operator`.`user_id` = `tbl_shifts`.`close_user_id`
WHERE DATE(tbl_shifts.shift_date1) >= '1972-01-01' AND DATE(tbl_shifts.shift_date) <= '2022-05-22'
ORDER BY `tbl_shifts1`.`shift_id` ASC
ERROR - 2022-05-22 11:52:26 --> Severity: error --> Exception: Class 'date' not found F:\xamp\htdocs\posmain\application\controllers\Payment.php 790
ERROR - 2022-05-22 11:52:37 --> Severity: error --> Exception: Call to a member function format() on string F:\xamp\htdocs\posmain\application\controllers\Payment.php 791
ERROR - 2022-05-22 11:53:11 --> Severity: error --> Exception: Call to a member function format() on string F:\xamp\htdocs\posmain\application\controllers\Payment.php 791
ERROR - 2022-05-22 11:53:50 --> Severity: error --> Exception: Call to a member function format() on string F:\xamp\htdocs\posmain\application\controllers\Payment.php 791
ERROR - 2022-05-22 11:54:17 --> Severity: error --> Exception: Call to a member function format() on string F:\xamp\htdocs\posmain\application\controllers\Payment.php 791
ERROR - 2022-05-22 11:55:02 --> Query error: Unknown column 'tbl_shifts1.shift_id' in 'order clause' - Invalid query: SELECT CONCAT(tbl_shifts_names.name, " of ", DATE_FORMAT(tbl_shifts.shift_date, "%d-%b-%Y")) as shift_name, reading, tbl_shifts.shift_id, operator.name as operator, bbf_amt, DATE_FORMAT(tbl_shifts.shift_date, "%d-%b-%Y") as shift_date
FROM `tbl_shifts`
LEFT JOIN `tbl_shifts_names` ON `tbl_shifts_names`.`shift_name_id` = `tbl_shifts`.`shift_name_id`
LEFT JOIN `tbl_users` `operator` ON `operator`.`user_id` = `tbl_shifts`.`close_user_id`
WHERE DATE(tbl_shifts.shift_date) >= '1970-01-01' AND DATE(tbl_shifts.shift_date) <= '1970-01-01'
ORDER BY `tbl_shifts1`.`shift_id` ASC
ERROR - 2022-05-22 11:57:05 --> Query error: Unknown column 'tbl_shifts1.shift_id' in 'order clause' - Invalid query: SELECT CONCAT(tbl_shifts_names.name, " of ", DATE_FORMAT(tbl_shifts.shift_date, "%d-%b-%Y")) as shift_name, reading, tbl_shifts.shift_id, operator.name as operator, bbf_amt, DATE_FORMAT(tbl_shifts.shift_date, "%d-%b-%Y") as shift_date
FROM `tbl_shifts`
LEFT JOIN `tbl_shifts_names` ON `tbl_shifts_names`.`shift_name_id` = `tbl_shifts`.`shift_name_id`
LEFT JOIN `tbl_users` `operator` ON `operator`.`user_id` = `tbl_shifts`.`close_user_id`
WHERE DATE(tbl_shifts.shift_date) >= '1970-01-01' AND DATE(tbl_shifts.shift_date) <= '2022-05-22'
ORDER BY `tbl_shifts1`.`shift_id` ASC
ERROR - 2022-05-22 12:00:08 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-22 12:00:43 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-22 12:04:53 --> Severity: error --> Exception: syntax error, unexpected ')', expecting '[' F:\xamp\htdocs\posmain\application\models\ShiftReports_model.php 1801
ERROR - 2022-05-22 12:05:05 --> Severity: error --> Exception: syntax error, unexpected ')', expecting '[' F:\xamp\htdocs\posmain\application\models\ShiftReports_model.php 1801
ERROR - 2022-05-22 12:06:19 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-22 12:06:54 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-22 12:29:57 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-22 12:30:45 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-22 12:38:02 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-22 12:44:08 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-22 12:44:41 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-22 12:45:30 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-22 12:47:09 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-22 12:48:03 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-22 12:49:22 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-22 12:49:34 --> Query error: Unknown column 'tbl_assigned_centres.shift_id1' in 'on clause' - Invalid query: SELECT `tbl_employees`.`emp_id`, `tbl_employees`.`name`, `tbl_items`.`item_id`, `item_name`, 0 as `category_id`, CASE reading
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
LEFT JOIN `tbl_assigned_centres` ON `tbl_assigned_centres`.`employee_id` = `tbl_employees`.`emp_id`
JOIN `tbl_close_shift_fuels` ON `tbl_close_shift_fuels`.`centre_id` = `tbl_assigned_centres`.`centre_id` AND `tbl_close_shift_fuels`.`shift_id` = `tbl_assigned_centres`.`shift_id1`
LEFT JOIN `tbl_pumps` ON `tbl_pumps`.`pump_id` = `tbl_close_shift_fuels`.`pump_id`
LEFT JOIN `tbl_items` ON `tbl_items`.`item_id` = `tbl_pumps`.`fuel_product_id`
LEFT JOIN `tbl_measurement_type` ON `tbl_measurement_type`.`type_id` = `tbl_items`.`measurement_unit_id`
LEFT JOIN `tbl_shifts` ON `tbl_shifts`.`shift_id` = `tbl_close_shift_fuels`.`shift_id`
LEFT JOIN `tbl_close_shift_fuels_vat` ON `tbl_close_shift_fuels_vat`.`id` = `tbl_close_shift_fuels`.`close_shift_fuel_id`
WHERE `tbl_close_shift_fuels`.`shift_id` IN('309', '308', '307', '306', '305', '304', '303', '302', '301', '300', '299', '298', '297', '296', '295', '294', '293', '292', '291', '290', '289', '288', '287', '286', '285', '284', '283', '282', '281', '280', '279', '278', '277', '276', '275', '274', '273', '272', '271', '270', '269', '268', '267', '266', '265', '264', '263', '262', '261', '260', '259', '258', '257', '256', '255', '254', '253', '252', '251', '250', '249', '248', '247', '246', '245', '244', '243', '242', '241', '240', '239', '238', '237', '236', '235', '234', '233', '232', '231', '230', '229', '228', '227', '226', '225', '224', '223', '222', '221', '220', '219', '218', '217', '216', '215', '214', '213', '211', '210', '209', '208', '207', '206', '205', '204', '203', '202', '201', '200', '199', '198', '197', '196', '195', '194', '193', '192', '191', '190', '189', '188', '187', '186', '185', '184', '183', '182', '181', '180', '179', '178', '177', '176', '175', '174', '173', '172', '171', '170', '169', '168', '167', '166', '165', '164', '163', '162', '161', '160', '159', '158', '157', '156', '155', '154', '153', '152', '151', '150', '149', '148', '147', '146', '145', '144', '143', '142', '141', '140', '139', '138', '137', '136', '135', '134', '133', '132', '131', '130', '129', '128', '127', '125', '124', '122', '121', '120')
GROUP BY `tbl_employees`.`emp_id`
ORDER BY `tbl_employees`.`emp_id`
ERROR - 2022-05-22 12:58:13 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-22 12:59:34 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-22 13:03:28 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-22 13:04:17 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-22 13:10:40 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-22 13:11:19 --> 404 Page Not Found: ShiftReports/images
