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
