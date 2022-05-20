<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2022-05-15 18:21:49 --> 404 Page Not Found: /index
ERROR - 2022-05-15 18:23:12 --> 404 Page Not Found: User/images
ERROR - 2022-05-15 18:24:37 --> 404 Page Not Found: Payment/images
ERROR - 2022-05-15 18:25:55 --> 404 Page Not Found: Payment/images
ERROR - 2022-05-15 18:27:35 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-15 18:27:44 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-15 18:28:28 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-15 18:28:28 --> Query error: Expression #4 of SELECT list is not in GROUP BY clause and contains nonaggregated column 'posmain.tbl_shifts.reading' which is not functionally dependent on columns in GROUP BY clause; this is incompatible with sql_mode=only_full_group_by - Invalid query: SELECT `tbl_items`.`item_id` as `item_id`, 0 as `category_id`, `item_name`, CASE reading
                              WHEN 4 THEN SUM(sales_manual_meter)
                              WHEN 3 THEN SUM(tbl_close_shift_fuels.sales_elec_meter)
                              WHEN 2 THEN SUM(tbl_close_shift_fuels.sales_elec_cash / tbl_close_shift_fuels.unit_price)
                              WHEN 5 THEN GREATEST(SUM(tbl_close_shift_fuels.sales_elec_meter), SUM(tbl_close_shift_fuels.sales_elec_cash / tbl_close_shift_fuels.unit_price))
                              ELSE GREATEST(SUM(sales_manual_meter), SUM(tbl_close_shift_fuels.sales_elec_meter), SUM(tbl_close_shift_fuels.sales_elec_cash / tbl_close_shift_fuels.unit_price))
                            END as qty, CASE reading
                              WHEN 4 THEN SUM(sales_manual_cash)
                              WHEN 3 THEN SUM(sales_elec_meter * tbl_close_shift_fuels.unit_price)
                              WHEN 2 THEN SUM(sales_elec_cash)
                              WHEN 5 THEN GREATEST(SUM(sales_elec_meter * tbl_close_shift_fuels.unit_price), SUM(sales_elec_cash))
                              ELSE GREATEST(SUM(sales_manual_cash), SUM(sales_elec_meter * tbl_close_shift_fuels.unit_price), SUM(sales_elec_cash))
                            END as amnt
FROM `tbl_close_shift_fuels`
LEFT JOIN `tbl_pumps` ON `tbl_pumps`.`pump_id` = `tbl_close_shift_fuels`.`pump_id`
LEFT JOIN `tbl_items` ON `tbl_items`.`item_id` = `tbl_pumps`.`fuel_product_id`
LEFT JOIN `tbl_shifts` ON `tbl_shifts`.`shift_id` = `tbl_close_shift_fuels`.`shift_id`
WHERE `tbl_close_shift_fuels`.`shift_id` IN('300', '299', '298', '297', '296', '295', '294', '293', '292', '291', '290', '289', '288', '287', '286', '285', '284', '283', '282', '281', '280', '279', '278', '277', '276', '275', '274', '273', '272', '271', '270', '269', '268', '267', '266', '265', '264', '263', '262', '261', '260', '259', '258', '257', '256', '255', '254', '253', '252', '251', '250', '249', '248', '247', '246', '245', '244', '243', '242', '241')
GROUP BY `tbl_items`.`item_id`
ERROR - 2022-05-15 18:29:38 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-15 18:35:15 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-15 18:35:15 --> Query error: Expression #3 of SELECT list is not in GROUP BY clause and contains nonaggregated column 'posmain.tbl_customers_transactions.bbf' which is not functionally dependent on columns in GROUP BY clause; this is incompatible with sql_mode=only_full_group_by - Invalid query: SELECT `tbl_customers_transactions`.`customer_id`, `tbl_customers`.`company_name`, `tbl_customers_transactions`.`bbf`, SUM(IF((tbl_customers_transactions.debit = 1), ((tbl_customers_transactions.amount)), 0)) as debit, SUM(IF((tbl_customers_transactions.debit = 0), ((tbl_customers_transactions.amount)), 0)) as credit, `tbl_customers_transactions`.`amount`, `debit` as `debit_type`
FROM `tbl_customers_transactions`
LEFT JOIN `tbl_customers` ON `tbl_customers`.`customer_id` = `tbl_customers_transactions`.`customer_id`
WHERE `tbl_customers_transactions`.`shift_id` IN('309', '308', '307', '306', '305', '304', '303', '302', '301', '300', '299', '298', '297', '296', '295', '294', '293', '292', '291', '290', '289', '288', '287', '286', '285', '284', '283', '282', '281', '280', '279', '278', '277', '276', '275', '274', '273', '272', '271')
GROUP BY `tbl_customers_transactions`.`customer_id`
ERROR - 2022-05-15 18:35:20 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-15 18:35:26 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-15 18:35:26 --> Query error: Expression #3 of SELECT list is not in GROUP BY clause and contains nonaggregated column 'posmain.tbl_customers_transactions.bbf' which is not functionally dependent on columns in GROUP BY clause; this is incompatible with sql_mode=only_full_group_by - Invalid query: SELECT `tbl_customers_transactions`.`customer_id`, `tbl_customers`.`company_name`, `tbl_customers_transactions`.`bbf`, SUM(IF((tbl_customers_transactions.debit = 1), ((tbl_customers_transactions.amount)), 0)) as debit, SUM(IF((tbl_customers_transactions.debit = 0), ((tbl_customers_transactions.amount)), 0)) as credit, `tbl_customers_transactions`.`amount`, `debit` as `debit_type`
FROM `tbl_customers_transactions`
LEFT JOIN `tbl_customers` ON `tbl_customers`.`customer_id` = `tbl_customers_transactions`.`customer_id`
WHERE `tbl_customers_transactions`.`shift_id` IN('300', '299', '298', '297', '296', '295', '294', '293', '292', '291', '290', '289', '288', '287', '286', '285', '284', '283', '282', '281', '280', '279', '278', '277', '276', '275', '274', '273', '272', '271', '270', '269', '268', '267', '266', '265', '264', '263', '262', '261', '260', '259', '258', '257', '256', '255', '254', '253', '252', '251', '250', '249', '248', '247', '246', '245', '244', '243', '242', '241')
GROUP BY `tbl_customers_transactions`.`customer_id`
ERROR - 2022-05-15 18:35:34 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-15 18:35:34 --> Query error: Expression #3 of SELECT list is not in GROUP BY clause and contains nonaggregated column 'posmain.tbl_customers_transactions.bbf' which is not functionally dependent on columns in GROUP BY clause; this is incompatible with sql_mode=only_full_group_by - Invalid query: SELECT `tbl_customers_transactions`.`customer_id`, `tbl_customers`.`company_name`, `tbl_customers_transactions`.`bbf`, SUM(IF((tbl_customers_transactions.debit = 1), ((tbl_customers_transactions.amount)), 0)) as debit, SUM(IF((tbl_customers_transactions.debit = 0), ((tbl_customers_transactions.amount)), 0)) as credit, `tbl_customers_transactions`.`amount`, `debit` as `debit_type`
FROM `tbl_customers_transactions`
LEFT JOIN `tbl_customers` ON `tbl_customers`.`customer_id` = `tbl_customers_transactions`.`customer_id`
WHERE `tbl_customers_transactions`.`shift_id` IN('309', '308', '307', '306', '305', '304', '303', '302', '301', '300', '299', '298', '297', '296', '295', '294', '293', '292', '291', '290', '289', '288', '287', '286', '285', '284', '283', '282', '281', '280', '279', '278', '277', '276', '275', '274', '273', '272', '271')
GROUP BY `tbl_customers_transactions`.`customer_id`
ERROR - 2022-05-15 18:35:39 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-15 18:35:45 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-15 18:35:47 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-15 18:35:56 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-15 18:37:23 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-15 18:37:54 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-15 18:37:54 --> Query error: Expression #4 of SELECT list is not in GROUP BY clause and contains nonaggregated column 'posmain.tbl_shifts.reading' which is not functionally dependent on columns in GROUP BY clause; this is incompatible with sql_mode=only_full_group_by - Invalid query: SELECT `tbl_items`.`item_id` as `item_id`, 0 as `category_id`, `item_name`, CASE reading
                              WHEN 4 THEN SUM(sales_manual_meter)
                              WHEN 3 THEN SUM(tbl_close_shift_fuels.sales_elec_meter)
                              WHEN 2 THEN SUM(tbl_close_shift_fuels.sales_elec_cash / tbl_close_shift_fuels.unit_price)
                              WHEN 5 THEN GREATEST(SUM(tbl_close_shift_fuels.sales_elec_meter), SUM(tbl_close_shift_fuels.sales_elec_cash / tbl_close_shift_fuels.unit_price))
                              ELSE GREATEST(SUM(sales_manual_meter), SUM(tbl_close_shift_fuels.sales_elec_meter), SUM(tbl_close_shift_fuels.sales_elec_cash / tbl_close_shift_fuels.unit_price))
                            END as qty, CASE reading
                              WHEN 4 THEN SUM(sales_manual_cash)
                              WHEN 3 THEN SUM(sales_elec_meter * tbl_close_shift_fuels.unit_price)
                              WHEN 2 THEN SUM(sales_elec_cash)
                              WHEN 5 THEN GREATEST(SUM(sales_elec_meter * tbl_close_shift_fuels.unit_price), SUM(sales_elec_cash))
                              ELSE GREATEST(SUM(sales_manual_cash), SUM(sales_elec_meter * tbl_close_shift_fuels.unit_price), SUM(sales_elec_cash))
                            END as amnt
FROM `tbl_close_shift_fuels`
LEFT JOIN `tbl_pumps` ON `tbl_pumps`.`pump_id` = `tbl_close_shift_fuels`.`pump_id`
LEFT JOIN `tbl_items` ON `tbl_items`.`item_id` = `tbl_pumps`.`fuel_product_id`
LEFT JOIN `tbl_shifts` ON `tbl_shifts`.`shift_id` = `tbl_close_shift_fuels`.`shift_id`
WHERE `tbl_close_shift_fuels`.`shift_id` IN('300', '299', '298', '297', '296', '295', '294', '293', '292', '291', '290', '289', '288', '287', '286', '285', '284', '283', '282', '281', '280', '279', '278', '277', '276', '275', '274', '273', '272', '271', '270', '269', '268', '267', '266', '265', '264', '263', '262', '261', '260', '259', '258', '257', '256', '255', '254', '253', '252', '251', '250', '249', '248', '247', '246', '245', '244', '243', '242', '241')
GROUP BY `tbl_items`.`item_id`
ERROR - 2022-05-15 18:38:01 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-15 18:38:10 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-15 18:38:10 --> Query error: Expression #6 of SELECT list is not in GROUP BY clause and contains nonaggregated column 'posmain.tbl_products.category_id' which is not functionally dependent on columns in GROUP BY clause; this is incompatible with sql_mode=only_full_group_by - Invalid query: SELECT SUM(tbl_close_shift_lubes.sales_qty) as qty, SUM(sales_qty * tbl_measurement_type.value) as vol, SUM(sales_qty * price) as amnt, SUM(sales_qty * (price / (1+tbl_close_shift_lubes_vat.vat))) as netamnt, `item_name`, `category_id`, SUM((sales_qty * (price / (1+tbl_close_shift_lubes_vat.vat))) * tbl_close_shift_lubes_vat.vat) as vat
FROM `tbl_close_shift_lubes`
LEFT JOIN `tbl_items` ON `tbl_items`.`item_id` = `tbl_close_shift_lubes`.`item_id`
LEFT JOIN `tbl_products` ON `tbl_products`.`item_id` = `tbl_items`.`item_id`
LEFT JOIN `tbl_measurement_type` ON `tbl_measurement_type`.`type_id` = `tbl_items`.`measurement_unit_id`
LEFT JOIN `tbl_close_shift_lubes_vat` ON `tbl_close_shift_lubes_vat`.`id` = `tbl_close_shift_lubes`.`close_shift_id`
WHERE `sales_qty` > 0
AND `tbl_close_shift_lubes`.`shift_id` IN('300', '299', '298', '297', '296', '295', '294', '293', '292', '291', '290', '289', '288', '287', '286', '285', '284', '283', '282', '281', '280', '279', '278', '277', '276', '275', '274', '273', '272', '271', '270', '269', '268', '267', '266', '265', '264', '263', '262', '261', '260', '259', '258', '257', '256', '255', '254', '253', '252', '251', '250', '249', '248', '247', '246', '245', '244', '243', '242', '241')
GROUP BY `tbl_close_shift_lubes`.`item_id`
ORDER BY `tbl_items`.`item_name`
ERROR - 2022-05-15 18:39:23 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-15 18:39:23 --> Query error: Expression #6 of SELECT list is not in GROUP BY clause and contains nonaggregated column 'posmain.tbl_products.category_id' which is not functionally dependent on columns in GROUP BY clause; this is incompatible with sql_mode=only_full_group_by - Invalid query: SELECT SUM(tbl_close_shift_lubes.sales_qty) as qty, SUM(sales_qty * tbl_measurement_type.value) as vol, SUM(sales_qty * price) as amnt, SUM(sales_qty * (price / (1+tbl_close_shift_lubes_vat.vat))) as netamnt, `item_name`, `category_id`, SUM((sales_qty * (price / (1+tbl_close_shift_lubes_vat.vat))) * tbl_close_shift_lubes_vat.vat) as vat
FROM `tbl_close_shift_lubes`
LEFT JOIN `tbl_items` ON `tbl_items`.`item_id` = `tbl_close_shift_lubes`.`item_id`
LEFT JOIN `tbl_products` ON `tbl_products`.`item_id` = `tbl_items`.`item_id`
LEFT JOIN `tbl_measurement_type` ON `tbl_measurement_type`.`type_id` = `tbl_items`.`measurement_unit_id`
LEFT JOIN `tbl_close_shift_lubes_vat` ON `tbl_close_shift_lubes_vat`.`id` = `tbl_close_shift_lubes`.`close_shift_id`
WHERE `sales_qty` > 0
AND `tbl_close_shift_lubes`.`shift_id` IN('309', '308', '307', '306', '305', '304', '303', '302', '301', '300', '299', '298', '297', '296', '295', '294', '293', '292', '291', '290', '289', '288', '287', '286', '285', '284', '283', '282', '281', '280', '279', '278', '277', '276', '275', '274', '273', '272', '271')
GROUP BY `tbl_close_shift_lubes`.`item_id`
ORDER BY `tbl_items`.`item_name`
ERROR - 2022-05-15 18:39:34 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-15 18:39:34 --> Query error: Expression #6 of SELECT list is not in GROUP BY clause and contains nonaggregated column 'posmain.tbl_products.category_id' which is not functionally dependent on columns in GROUP BY clause; this is incompatible with sql_mode=only_full_group_by - Invalid query: SELECT SUM(tbl_close_shift_lubes.sales_qty) as qty, SUM(sales_qty * tbl_measurement_type.value) as vol, SUM(sales_qty * price) as amnt, SUM(sales_qty * (price / (1+tbl_close_shift_lubes_vat.vat))) as netamnt, `item_name`, `category_id`, SUM((sales_qty * (price / (1+tbl_close_shift_lubes_vat.vat))) * tbl_close_shift_lubes_vat.vat) as vat
FROM `tbl_close_shift_lubes`
LEFT JOIN `tbl_items` ON `tbl_items`.`item_id` = `tbl_close_shift_lubes`.`item_id`
LEFT JOIN `tbl_products` ON `tbl_products`.`item_id` = `tbl_items`.`item_id`
LEFT JOIN `tbl_measurement_type` ON `tbl_measurement_type`.`type_id` = `tbl_items`.`measurement_unit_id`
LEFT JOIN `tbl_close_shift_lubes_vat` ON `tbl_close_shift_lubes_vat`.`id` = `tbl_close_shift_lubes`.`close_shift_id`
WHERE `sales_qty` > 0
AND `tbl_close_shift_lubes`.`shift_id` IN('300', '299', '298', '297', '296', '295', '294', '293', '292', '291', '290', '289', '288', '287', '286', '285', '284', '283', '282', '281', '280', '279', '278', '277', '276', '275', '274', '273', '272', '271', '270', '269', '268', '267', '266', '265', '264', '263', '262', '261', '260', '259', '258', '257', '256', '255', '254', '253', '252', '251', '250', '249', '248', '247', '246', '245', '244', '243', '242', '241')
GROUP BY `tbl_close_shift_lubes`.`item_id`
ORDER BY `tbl_items`.`item_name`
ERROR - 2022-05-15 18:50:24 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-15 20:27:47 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-15 20:27:48 --> Query error: Expression #6 of SELECT list is not in GROUP BY clause and contains nonaggregated column 'posmain.tbl_products.category_id' which is not functionally dependent on columns in GROUP BY clause; this is incompatible with sql_mode=only_full_group_by - Invalid query: SELECT SUM(tbl_close_shift_lubes.sales_qty) as qty, SUM(sales_qty * tbl_measurement_type.value) as vol, SUM(sales_qty * price) as amnt, SUM(sales_qty * (price / (1+tbl_close_shift_lubes_vat.vat))) as netamnt, `item_name`, `category_id`, SUM((sales_qty * (price / (1+tbl_close_shift_lubes_vat.vat))) * tbl_close_shift_lubes_vat.vat) as vat
FROM `tbl_close_shift_lubes`
LEFT JOIN `tbl_items` ON `tbl_items`.`item_id` = `tbl_close_shift_lubes`.`item_id`
LEFT JOIN `tbl_products` ON `tbl_products`.`item_id` = `tbl_items`.`item_id`
LEFT JOIN `tbl_measurement_type` ON `tbl_measurement_type`.`type_id` = `tbl_items`.`measurement_unit_id`
LEFT JOIN `tbl_close_shift_lubes_vat` ON `tbl_close_shift_lubes_vat`.`id` = `tbl_close_shift_lubes`.`close_shift_id`
WHERE `sales_qty` > 0
AND `tbl_close_shift_lubes`.`shift_id` IN('309', '308', '307', '306', '305', '304', '303', '302', '301')
GROUP BY `tbl_close_shift_lubes`.`item_id`
ORDER BY `tbl_items`.`item_name`
ERROR - 2022-05-15 20:28:31 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-15 20:30:06 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-15 20:31:57 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-15 20:32:21 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-15 20:32:21 --> Query error: Expression #4 of SELECT list is not in GROUP BY clause and contains nonaggregated column 'posmain.tbl_shifts.reading' which is not functionally dependent on columns in GROUP BY clause; this is incompatible with sql_mode=only_full_group_by - Invalid query: SELECT `tbl_items`.`item_id` as `item_id`, 0 as `category_id`, `item_name`, CASE reading
                              WHEN 4 THEN SUM(sales_manual_meter)
                              WHEN 3 THEN SUM(tbl_close_shift_fuels.sales_elec_meter)
                              WHEN 2 THEN SUM(tbl_close_shift_fuels.sales_elec_cash / tbl_close_shift_fuels.unit_price)
                              WHEN 5 THEN GREATEST(SUM(tbl_close_shift_fuels.sales_elec_meter), SUM(tbl_close_shift_fuels.sales_elec_cash / tbl_close_shift_fuels.unit_price))
                              ELSE GREATEST(SUM(sales_manual_meter), SUM(tbl_close_shift_fuels.sales_elec_meter), SUM(tbl_close_shift_fuels.sales_elec_cash / tbl_close_shift_fuels.unit_price))
                            END as qty, CASE reading
                              WHEN 4 THEN SUM(sales_manual_cash)
                              WHEN 3 THEN SUM(sales_elec_meter * tbl_close_shift_fuels.unit_price)
                              WHEN 2 THEN SUM(sales_elec_cash)
                              WHEN 5 THEN GREATEST(SUM(sales_elec_meter * tbl_close_shift_fuels.unit_price), SUM(sales_elec_cash))
                              ELSE GREATEST(SUM(sales_manual_cash), SUM(sales_elec_meter * tbl_close_shift_fuels.unit_price), SUM(sales_elec_cash))
                            END as amnt
FROM `tbl_close_shift_fuels`
LEFT JOIN `tbl_pumps` ON `tbl_pumps`.`pump_id` = `tbl_close_shift_fuels`.`pump_id`
LEFT JOIN `tbl_items` ON `tbl_items`.`item_id` = `tbl_pumps`.`fuel_product_id`
LEFT JOIN `tbl_shifts` ON `tbl_shifts`.`shift_id` = `tbl_close_shift_fuels`.`shift_id`
WHERE `tbl_close_shift_fuels`.`shift_id` IN('300', '299', '298', '297', '296', '295', '294', '293', '292', '291', '290', '289', '288', '287', '286', '285', '284', '283', '282', '281', '280', '279', '278', '277', '276', '275', '274', '273', '272', '271', '270', '269', '268', '267', '266', '265', '264', '263', '262', '261', '260', '259', '258', '257', '256', '255', '254', '253', '252', '251', '250', '249', '248', '247', '246', '245', '244', '243', '242', '241')
GROUP BY `tbl_items`.`item_id`
ERROR - 2022-05-15 20:32:49 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-15 20:32:49 --> Query error: Expression #4 of SELECT list is not in GROUP BY clause and contains nonaggregated column 'posmain.tbl_shifts.reading' which is not functionally dependent on columns in GROUP BY clause; this is incompatible with sql_mode=only_full_group_by - Invalid query: SELECT `tbl_items`.`item_id` as `item_id`, 0 as `category_id`, `item_name`, CASE reading
                              WHEN 4 THEN SUM(sales_manual_meter)
                              WHEN 3 THEN SUM(tbl_close_shift_fuels.sales_elec_meter)
                              WHEN 2 THEN SUM(tbl_close_shift_fuels.sales_elec_cash / tbl_close_shift_fuels.unit_price)
                              WHEN 5 THEN GREATEST(SUM(tbl_close_shift_fuels.sales_elec_meter), SUM(tbl_close_shift_fuels.sales_elec_cash / tbl_close_shift_fuels.unit_price))
                              ELSE GREATEST(SUM(sales_manual_meter), SUM(tbl_close_shift_fuels.sales_elec_meter), SUM(tbl_close_shift_fuels.sales_elec_cash / tbl_close_shift_fuels.unit_price))
                            END as qty, CASE reading
                              WHEN 4 THEN SUM(sales_manual_cash)
                              WHEN 3 THEN SUM(sales_elec_meter * tbl_close_shift_fuels.unit_price)
                              WHEN 2 THEN SUM(sales_elec_cash)
                              WHEN 5 THEN GREATEST(SUM(sales_elec_meter * tbl_close_shift_fuels.unit_price), SUM(sales_elec_cash))
                              ELSE GREATEST(SUM(sales_manual_cash), SUM(sales_elec_meter * tbl_close_shift_fuels.unit_price), SUM(sales_elec_cash))
                            END as amnt
FROM `tbl_close_shift_fuels`
LEFT JOIN `tbl_pumps` ON `tbl_pumps`.`pump_id` = `tbl_close_shift_fuels`.`pump_id`
LEFT JOIN `tbl_items` ON `tbl_items`.`item_id` = `tbl_pumps`.`fuel_product_id`
LEFT JOIN `tbl_shifts` ON `tbl_shifts`.`shift_id` = `tbl_close_shift_fuels`.`shift_id`
WHERE `tbl_close_shift_fuels`.`shift_id` IN('309', '308', '307', '306', '305', '304', '303', '302', '301')
GROUP BY `tbl_items`.`item_id`
ERROR - 2022-05-15 20:32:58 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-15 20:33:06 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-15 20:33:10 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-15 20:33:10 --> Query error: Expression #4 of SELECT list is not in GROUP BY clause and contains nonaggregated column 'posmain.tbl_shifts.reading' which is not functionally dependent on columns in GROUP BY clause; this is incompatible with sql_mode=only_full_group_by - Invalid query: SELECT `tbl_items`.`item_id` as `item_id`, 0 as `category_id`, `item_name`, CASE reading
                              WHEN 4 THEN SUM(sales_manual_meter)
                              WHEN 3 THEN SUM(tbl_close_shift_fuels.sales_elec_meter)
                              WHEN 2 THEN SUM(tbl_close_shift_fuels.sales_elec_cash / tbl_close_shift_fuels.unit_price)
                              WHEN 5 THEN GREATEST(SUM(tbl_close_shift_fuels.sales_elec_meter), SUM(tbl_close_shift_fuels.sales_elec_cash / tbl_close_shift_fuels.unit_price))
                              ELSE GREATEST(SUM(sales_manual_meter), SUM(tbl_close_shift_fuels.sales_elec_meter), SUM(tbl_close_shift_fuels.sales_elec_cash / tbl_close_shift_fuels.unit_price))
                            END as qty, CASE reading
                              WHEN 4 THEN SUM(sales_manual_cash)
                              WHEN 3 THEN SUM(sales_elec_meter * tbl_close_shift_fuels.unit_price)
                              WHEN 2 THEN SUM(sales_elec_cash)
                              WHEN 5 THEN GREATEST(SUM(sales_elec_meter * tbl_close_shift_fuels.unit_price), SUM(sales_elec_cash))
                              ELSE GREATEST(SUM(sales_manual_cash), SUM(sales_elec_meter * tbl_close_shift_fuels.unit_price), SUM(sales_elec_cash))
                            END as amnt
FROM `tbl_close_shift_fuels`
LEFT JOIN `tbl_pumps` ON `tbl_pumps`.`pump_id` = `tbl_close_shift_fuels`.`pump_id`
LEFT JOIN `tbl_items` ON `tbl_items`.`item_id` = `tbl_pumps`.`fuel_product_id`
LEFT JOIN `tbl_shifts` ON `tbl_shifts`.`shift_id` = `tbl_close_shift_fuels`.`shift_id`
WHERE `tbl_close_shift_fuels`.`shift_id` IN('309', '308', '307', '306', '305', '304', '303', '302', '301')
GROUP BY `tbl_items`.`item_id`
