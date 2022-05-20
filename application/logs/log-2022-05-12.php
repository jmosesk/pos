<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2022-05-12 09:58:54 --> 404 Page Not Found: User/images
ERROR - 2022-05-12 10:11:01 --> 404 Page Not Found: User/images
ERROR - 2022-05-12 10:29:40 --> 404 Page Not Found: User/images
ERROR - 2022-05-12 10:29:51 --> 404 Page Not Found: Payment/images
ERROR - 2022-05-12 10:30:00 --> 404 Page Not Found: Admin/images
ERROR - 2022-05-12 10:30:06 --> 404 Page Not Found: Images/favicon.png
ERROR - 2022-05-12 10:38:19 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-12 10:38:25 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-12 10:39:16 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-12 10:45:26 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-12 10:49:59 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-12 10:54:18 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-12 11:14:45 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-12 11:16:13 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-12 11:17:00 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-12 11:18:11 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-12 11:29:21 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-12 11:29:47 --> 404 Page Not Found: Shift/images
ERROR - 2022-05-12 11:31:39 --> 404 Page Not Found: Shift/images
ERROR - 2022-05-12 11:31:43 --> Severity: Notice --> Undefined offset: 0 C:\xampp\htdocs\fms_prod\application\views\shift\viewAllocations.php 1
ERROR - 2022-05-12 11:31:43 --> Severity: Notice --> Trying to get property 'shift_name' of non-object C:\xampp\htdocs\fms_prod\application\views\shift\viewAllocations.php 14
ERROR - 2022-05-12 11:31:43 --> Severity: Notice --> Trying to get property 'shift_date' of non-object C:\xampp\htdocs\fms_prod\application\views\shift\viewAllocations.php 14
ERROR - 2022-05-12 11:31:54 --> Severity: Notice --> Undefined offset: 0 C:\xampp\htdocs\fms_prod\application\views\shift\viewAllocations.php 1
ERROR - 2022-05-12 11:31:54 --> Severity: Notice --> Trying to get property 'shift_name' of non-object C:\xampp\htdocs\fms_prod\application\views\shift\viewAllocations.php 14
ERROR - 2022-05-12 11:31:54 --> Severity: Notice --> Trying to get property 'shift_date' of non-object C:\xampp\htdocs\fms_prod\application\views\shift\viewAllocations.php 14
ERROR - 2022-05-12 11:32:19 --> 404 Page Not Found: Shift/images
ERROR - 2022-05-12 11:33:24 --> 404 Page Not Found: Payment/images
ERROR - 2022-05-12 11:33:52 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-12 11:36:33 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-12 11:37:31 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-12 11:57:16 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-12 12:17:05 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-12 12:25:43 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-12 12:25:47 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-12 12:28:44 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-12 12:29:12 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-12 12:29:32 --> 404 Page Not Found: Shift/images
ERROR - 2022-05-12 12:29:49 --> 404 Page Not Found: Shift/images
ERROR - 2022-05-12 12:32:19 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-12 12:33:17 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-12 12:42:45 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-12 12:43:09 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-12 19:40:50 --> Unable to delete cache file for Export
ERROR - 2022-05-12 21:52:53 --> 404 Page Not Found: Payment/images
ERROR - 2022-05-12 21:53:48 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-12 21:54:20 --> 404 Page Not Found: Assets/js
ERROR - 2022-05-12 21:54:26 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-12 21:54:28 --> Query error: Unknown column 'tbl_close_shift_products.item_id' in 'on clause' - Invalid query: SELECT `tbl_assigned_centres`.`employee_id`, `tbl_employees`.`name`, SUM(tbl_close_shift_job_card.quantity * tbl_measurement_type.value) as vol, SUM(quantity * tbl_close_shift_job_card.unit_price) as amnt, SUM(quantity  * (tbl_close_shift_job_card.unit_price / (1+tbl_close_shift_job_card_vat.vat))) as netamnt, `item_name`, SUM((quantity * (tbl_close_shift_job_card.unit_price / (1+tbl_close_shift_job_card_vat.vat))) * tbl_close_shift_job_card_vat.vat) as vat, "jc" as `category_id`
FROM `tbl_employees`
LEFT JOIN `tbl_assigned_centres` ON `tbl_assigned_centres`.`employee_id` = `tbl_employees`.`emp_id`
LEFT JOIN `tbl_close_shift_job_card` ON `tbl_close_shift_job_card`.`centre_id` = `tbl_assigned_centres`.`centre_id`
LEFT JOIN `tbl_items` ON `tbl_items`.`item_id` = `tbl_close_shift_products`.`item_id`
LEFT JOIN `tbl_close_shift_job_card_vat` ON `tbl_close_shift_job_card_vat`.`id` = `tbl_close_shift_job_card`.`close_shift_id`
LEFT JOIN `tbl_measurement_type` ON `tbl_measurement_type`.`type_id` = `tbl_items`.`measurement_unit_id`
WHERE `quantity` > 0
AND `tbl_close_shift_job_card`.`shift_id` IN('309', '308', '307', '306', '305', '304', '303', '302', '301')
GROUP BY `tbl_assigned_centres`.`employee_id`
ORDER BY `tbl_assigned_centres`.`employee_id`
ERROR - 2022-05-12 21:57:45 --> 404 Page Not Found: Assets/js
ERROR - 2022-05-12 21:57:46 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-12 21:57:58 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-12 21:57:59 --> Query error: Unknown column 'tbl_close_shift_fuels.pump_id' in 'on clause' - Invalid query: SELECT `tbl_assigned_centres`.`employee_id`, `tbl_employees`.`name`, `tbl_items`.`item_id`, `item_name`, 0 as `category_id`, CASE reading
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
LEFT JOIN `tbl_pumps` ON `tbl_pumps`.`pump_id` = `tbl_close_shift_fuels`.`pump_id`
LEFT JOIN `tbl_assigned_centres` ON `tbl_assigned_centres`.`employee_id` = `tbl_employees`.`emp_id`
LEFT JOIN `tbl_close_shift_fuels` ON `tbl_close_shift_fuels`.`centre_id` = `tbl_assigned_centres`.`centre_id`
LEFT JOIN `tbl_items` ON `tbl_items`.`item_id` = `tbl_close_shift_products`.`item_id`
LEFT JOIN `tbl_measurement_type` ON `tbl_measurement_type`.`type_id` = `tbl_items`.`measurement_unit_id`
LEFT JOIN `tbl_shifts` ON `tbl_shifts`.`shift_id` = `tbl_close_shift_fuels`.`shift_id`
LEFT JOIN `tbl_close_shift_fuels_vat` ON `tbl_close_shift_fuels_vat`.`id` = `tbl_close_shift_fuels`.`close_shift_fuel_id`
WHERE `tbl_close_shift_fuels`.`shift_id` IN('309', '308', '307', '306', '305', '304', '303', '302', '301')
GROUP BY `tbl_employees`.`employee_id`
ORDER BY `tbl_assigned_centres`.`employee_id`
ERROR - 2022-05-12 22:00:35 --> 404 Page Not Found: Assets/js
ERROR - 2022-05-12 22:00:47 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-12 22:00:47 --> Query error: Unknown column 'tbl_close_shift_products.item_id' in 'on clause' - Invalid query: SELECT `tbl_assigned_centres`.`employee_id`, `tbl_employees`.`name`, `tbl_items`.`item_id`, `item_name`, 0 as `category_id`, CASE reading
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
LEFT JOIN `tbl_close_shift_fuels` ON `tbl_close_shift_fuels`.`centre_id` = `tbl_assigned_centres`.`centre_id`
LEFT JOIN `tbl_items` ON `tbl_items`.`item_id` = `tbl_close_shift_products`.`item_id`
LEFT JOIN `tbl_pumps` ON `tbl_pumps`.`pump_id` = `tbl_close_shift_fuels`.`pump_id`
LEFT JOIN `tbl_measurement_type` ON `tbl_measurement_type`.`type_id` = `tbl_items`.`measurement_unit_id`
LEFT JOIN `tbl_shifts` ON `tbl_shifts`.`shift_id` = `tbl_close_shift_fuels`.`shift_id`
LEFT JOIN `tbl_close_shift_fuels_vat` ON `tbl_close_shift_fuels_vat`.`id` = `tbl_close_shift_fuels`.`close_shift_fuel_id`
WHERE `tbl_close_shift_fuels`.`shift_id` IN('309', '308', '307', '306', '305', '304', '303', '302', '301')
GROUP BY `tbl_employees`.`employee_id`
ORDER BY `tbl_assigned_centres`.`employee_id`
ERROR - 2022-05-12 22:02:10 --> 404 Page Not Found: Assets/js
ERROR - 2022-05-12 22:02:19 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-12 22:02:19 --> Query error: Unknown column 'tbl_close_shift_fuels.item_id' in 'on clause' - Invalid query: SELECT `tbl_assigned_centres`.`employee_id`, `tbl_employees`.`name`, `tbl_items`.`item_id`, `item_name`, 0 as `category_id`, CASE reading
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
LEFT JOIN `tbl_close_shift_fuels` ON `tbl_close_shift_fuels`.`centre_id` = `tbl_assigned_centres`.`centre_id`
LEFT JOIN `tbl_items` ON `tbl_items`.`item_id` = `tbl_close_shift_fuels`.`item_id`
LEFT JOIN `tbl_pumps` ON `tbl_pumps`.`pump_id` = `tbl_close_shift_fuels`.`pump_id`
LEFT JOIN `tbl_measurement_type` ON `tbl_measurement_type`.`type_id` = `tbl_items`.`measurement_unit_id`
LEFT JOIN `tbl_shifts` ON `tbl_shifts`.`shift_id` = `tbl_close_shift_fuels`.`shift_id`
LEFT JOIN `tbl_close_shift_fuels_vat` ON `tbl_close_shift_fuels_vat`.`id` = `tbl_close_shift_fuels`.`close_shift_fuel_id`
WHERE `tbl_close_shift_fuels`.`shift_id` IN('309', '308', '307', '306', '305', '304', '303', '302', '301')
GROUP BY `tbl_employees`.`employee_id`
ORDER BY `tbl_assigned_centres`.`employee_id`
ERROR - 2022-05-12 22:06:17 --> 404 Page Not Found: Assets/js
ERROR - 2022-05-12 22:06:25 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-12 22:06:25 --> Query error: Unknown column 'tbl_employees.employee_id' in 'group statement' - Invalid query: SELECT `tbl_assigned_centres`.`employee_id`, `tbl_employees`.`name`, `tbl_items`.`item_id`, `item_name`, 0 as `category_id`, CASE reading
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
LEFT JOIN `tbl_close_shift_fuels` ON `tbl_close_shift_fuels`.`centre_id` = `tbl_assigned_centres`.`centre_id`
LEFT JOIN `tbl_pumps` ON `tbl_pumps`.`pump_id` = `tbl_close_shift_fuels`.`pump_id`
LEFT JOIN `tbl_items` ON `tbl_items`.`item_id` = `tbl_pumps`.`fuel_product_id`
LEFT JOIN `tbl_measurement_type` ON `tbl_measurement_type`.`type_id` = `tbl_items`.`measurement_unit_id`
LEFT JOIN `tbl_shifts` ON `tbl_shifts`.`shift_id` = `tbl_close_shift_fuels`.`shift_id`
LEFT JOIN `tbl_close_shift_fuels_vat` ON `tbl_close_shift_fuels_vat`.`id` = `tbl_close_shift_fuels`.`close_shift_fuel_id`
WHERE `tbl_close_shift_fuels`.`shift_id` IN('309', '308', '307', '306', '305', '304', '303', '302', '301')
GROUP BY `tbl_employees`.`employee_id`
ORDER BY `tbl_assigned_centres`.`employee_id`
ERROR - 2022-05-12 22:08:29 --> 404 Page Not Found: Assets/js
ERROR - 2022-05-12 22:08:37 --> 404 Page Not Found: ShiftReports/images
