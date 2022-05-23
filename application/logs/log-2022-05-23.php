<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2022-05-23 06:59:49 --> Unable to connect to the database
ERROR - 2022-05-23 07:00:10 --> 404 Page Not Found: User/images
ERROR - 2022-05-23 07:00:17 --> 404 Page Not Found: Payment/images
ERROR - 2022-05-23 07:00:32 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-23 07:00:43 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-23 07:00:49 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-23 07:03:19 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-23 07:03:23 --> Query error: Unknown column 'tbl_employees.emp_id1' in 'group statement' - Invalid query: SELECT `tbl_assigned_centres`.`employee_id`, `tbl_employees`.`name`, `tbl_items`.`item_id`, `item_name`, 0 as `category_id`, CASE reading
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
LEFT JOIN `tbl_close_shift_fuels` ON `tbl_close_shift_fuels`.`centre_id` = `tbl_assigned_centres`.`centre_id` AND `tbl_close_shift_fuels`.`shift_id` = `tbl_assigned_centres`.`shift_id`
LEFT JOIN `tbl_pumps` ON `tbl_pumps`.`pump_id` = `tbl_close_shift_fuels`.`pump_id` AND `tbl_pumps`.`centre_id` = `tbl_close_shift_fuels`.`centre_id`
LEFT JOIN `tbl_items` ON `tbl_items`.`item_id` = `tbl_pumps`.`fuel_product_id`
LEFT JOIN `tbl_measurement_type` ON `tbl_measurement_type`.`type_id` = `tbl_items`.`measurement_unit_id`
LEFT JOIN `tbl_shifts` ON `tbl_shifts`.`shift_id` = `tbl_close_shift_fuels`.`shift_id`
LEFT JOIN `tbl_close_shift_fuels_vat` ON `tbl_close_shift_fuels_vat`.`id` = `tbl_close_shift_fuels`.`close_shift_fuel_id`
WHERE `tbl_close_shift_fuels`.`shift_id` IN('300', '299', '298', '297', '296', '295', '294', '293', '292', '291', '290', '289', '288', '287', '286', '285', '284', '283', '282', '281', '280', '279', '278', '277', '276', '275', '274', '273', '272', '271', '270', '269', '268', '267', '266', '265', '264', '263', '262', '261', '260', '259', '258', '257', '256', '255', '254', '253', '252', '251', '250', '249', '248', '247', '246', '245', '244', '243', '242', '241')
GROUP BY `tbl_employees`.`emp_id1`
ORDER BY `tbl_assigned_centres`.`employee_id`
ERROR - 2022-05-23 07:27:30 --> 404 Page Not Found: ShiftReports/images
