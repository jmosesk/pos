<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2022-04-24 10:31:50 --> 404 Page Not Found: Payment/images
ERROR - 2022-04-24 10:36:05 --> Query error: Unknown column 'images' in 'field list' - Invalid query: SELECT SUM(IF((tbl_bankings.shift_id = images), (tbl_bankings.amount), 0)) as total_bankings
FROM `tbl_bankings`
WHERE `tbl_bankings`.`shift_id` = 'images'
GROUP BY `shift_id`
ERROR - 2022-04-24 10:47:34 --> Severity: error --> Exception: Call to a member function result() on null C:\xampp\htdocs\fms_prod\application\views\shift\cash_reconcilliation_sheet.php 551
ERROR - 2022-04-24 10:59:20 --> Severity: error --> Exception: Call to a member function result() on null C:\xampp\htdocs\fms_prod\application\views\shift\cash_reconcilliation_sheet.php 551
ERROR - 2022-04-24 17:42:06 --> Query error: Column 'shift_id' in field list is ambiguous - Invalid query: SELECT `tbl_shifts`.`shift_date` as `datetime`, `shift_id`, `customer_transaction_id`, `debit`, `amount`, `tbl_users`.`name` as `employee`, `tbl_customers`.`company_name` as `customer`, `tbl_payment_type`.`name` as `payment_type`, `ref_number`, `tbl_customer_payments`.`remarks`, `tbl_customer_payments`.`payment_reason`
FROM `tbl_customers_transactions`
LEFT JOIN `tbl_shifts` ON `tbl_shifts`.`shift_id` = `tbl_customers_transactions`.`shift_id`
LEFT JOIN `tbl_users` ON `tbl_users`.`user_id` = `tbl_customers_transactions`.`employee_id`
JOIN `tbl_payment_type` ON `tbl_payment_type`.`type_id` = `tbl_customers_transactions`.`payment_type`
JOIN `tbl_customer_payments` ON `tbl_customer_payments`.`customers_transactions_id` = `tbl_customers_transactions`.`customer_transaction_id`
LEFT JOIN `tbl_customers` ON `tbl_customers`.`customer_id` = `tbl_customers_transactions`.`customer_id`
ORDER BY `customer_transaction_id` DESC
ERROR - 2022-04-24 19:32:24 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-04-24 19:55:11 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-04-24 19:55:11 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'as vat
FROM `tbl_close_shift_lubes`
LEFT JOIN `tbl_items` ON `tbl_items`.`ite...' at line 1 - Invalid query: SELECT SUM(tbl_close_shift_lubes.sales_qty) as qty, SUM(sales_qty * tbl_measurement_type.value) as vol, SUM(sales_qty * price) as amnt, `item_name`, `category_id`, SUM((sales_qty *( price/(1 + tbl_close_shift_lubes_vat.vat)) as vat
FROM `tbl_close_shift_lubes`
LEFT JOIN `tbl_items` ON `tbl_items`.`item_id` = `tbl_close_shift_lubes`.`item_id`
LEFT JOIN `tbl_products` ON `tbl_products`.`item_id` = `tbl_items`.`item_id`
LEFT JOIN `tbl_measurement_type` ON `tbl_measurement_type`.`type_id` = `tbl_items`.`measurement_unit_id`
LEFT JOIN `tbl_close_shift_lubes_vat` ON `tbl_close_shift_lubes_vat`.`id` = `tbl_close_shift_lubes`.`close_shift_id`
WHERE `sales_qty` > 0
AND `tbl_close_shift_lubes`.`shift_id` IN('65', '64', '63', '62', '61', '60', '59', '58', '57', '56', '55', '54', '53', '52', '51', '50', '49', '48', '47', '46', '45', '44', '43', '42', '41', '40', '39', '38', '36', '35', '34', '33', '32', '31', '30', '29', '28', '27', '26', '25', '24', '23', '22', '21', '20', '19', '18', '17', '16', '15', '14', '13', '12', '11', '10', '9', '7', '6', '5', '4', '3', '2')
GROUP BY `tbl_close_shift_lubes`.`item_id`
ORDER BY `tbl_items`.`item_name`
ERROR - 2022-04-24 19:55:49 --> 404 Page Not Found: Assets/DataTables
ERROR - 2022-04-24 19:55:49 --> 404 Page Not Found: Assets/js
ERROR - 2022-04-24 19:56:03 --> 404 Page Not Found: Assets/js
ERROR - 2022-04-24 19:56:03 --> 404 Page Not Found: Assets/DataTables
ERROR - 2022-04-24 19:59:18 --> 404 Page Not Found: Assets/js
ERROR - 2022-04-24 19:59:19 --> 404 Page Not Found: Assets/DataTables
ERROR - 2022-04-24 19:59:31 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-04-24 20:01:31 --> 404 Page Not Found: Assets/js
ERROR - 2022-04-24 20:01:31 --> 404 Page Not Found: Assets/DataTables
ERROR - 2022-04-24 20:01:38 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-04-24 20:04:09 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-04-24 20:33:47 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-04-24 20:33:47 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'as vat
FROM `tbl_close_shift_products`
LEFT JOIN `tbl_items` ON `tbl_items`.`...' at line 1 - Invalid query: SELECT SUM(tbl_close_shift_products.sales_qty) as qty, SUM(sales_qty * tbl_measurement_type.value) as vol, SUM(sales_qty * ( price/(1 + tbl_close_shift_products_vat.vat))) as amnt, `item_name`, `category_id`, SUM((sales_qty * (price - ( price/(1 + tbl_close_shift_products_vat.vat)))) as vat
FROM `tbl_close_shift_products`
LEFT JOIN `tbl_items` ON `tbl_items`.`item_id` = `tbl_close_shift_products`.`item_id`
LEFT JOIN `tbl_products` ON `tbl_products`.`item_id` = `tbl_items`.`item_id`
LEFT JOIN `tbl_measurement_type` ON `tbl_measurement_type`.`type_id` = `tbl_items`.`measurement_unit_id`
LEFT JOIN `tbl_close_shift_products_vat` ON `tbl_close_shift_products_vat`.`id` = `tbl_close_shift_products`.`close_shift_id`
WHERE `sales_qty` > 0
AND `tbl_close_shift_products`.`shift_id` IN('65', '64', '63', '62', '61', '60', '59', '58', '57', '56', '55', '54', '53', '52', '51', '50', '49', '48', '47', '46', '45', '44', '43', '42', '41', '40', '39', '38', '36', '35', '34', '33', '32', '31', '30', '29', '28', '27', '26', '25', '24', '23', '22', '21', '20', '19', '18', '17', '16', '15', '14', '13', '12', '11', '10', '9', '7', '6', '5', '4', '3', '2')
GROUP BY `tbl_close_shift_products`.`item_id`
ORDER BY `tbl_items`.`item_name`
ERROR - 2022-04-24 20:33:59 --> 404 Page Not Found: Assets/DataTables
ERROR - 2022-04-24 20:33:59 --> 404 Page Not Found: Assets/js
ERROR - 2022-04-24 20:34:13 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-04-24 20:34:13 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'as vat
FROM `tbl_close_shift_products`
LEFT JOIN `tbl_items` ON `tbl_items`.`...' at line 1 - Invalid query: SELECT SUM(tbl_close_shift_products.sales_qty) as qty, SUM(sales_qty * tbl_measurement_type.value) as vol, SUM(sales_qty * ( price/(1 + tbl_close_shift_products_vat.vat))) as amnt, `item_name`, `category_id`, SUM((sales_qty * (price - ( price/(1 + tbl_close_shift_products_vat.vat)))) as vat
FROM `tbl_close_shift_products`
LEFT JOIN `tbl_items` ON `tbl_items`.`item_id` = `tbl_close_shift_products`.`item_id`
LEFT JOIN `tbl_products` ON `tbl_products`.`item_id` = `tbl_items`.`item_id`
LEFT JOIN `tbl_measurement_type` ON `tbl_measurement_type`.`type_id` = `tbl_items`.`measurement_unit_id`
LEFT JOIN `tbl_close_shift_products_vat` ON `tbl_close_shift_products_vat`.`id` = `tbl_close_shift_products`.`close_shift_id`
WHERE `sales_qty` > 0
AND `tbl_close_shift_products`.`shift_id` IN('65', '64', '63', '62', '61', '60', '59', '58', '57', '56', '55', '54', '53', '52', '51', '50', '49', '48', '47', '46', '45', '44', '43', '42', '41', '40', '39', '38', '36', '35', '34', '33', '32', '31', '30', '29', '28', '27', '26', '25', '24', '23', '22', '21', '20', '19', '18', '17', '16', '15', '14', '13', '12', '11', '10', '9', '7', '6', '5', '4', '3', '2')
GROUP BY `tbl_close_shift_products`.`item_id`
ORDER BY `tbl_items`.`item_name`
ERROR - 2022-04-24 20:36:05 --> 404 Page Not Found: Assets/js
ERROR - 2022-04-24 20:36:06 --> 404 Page Not Found: Assets/DataTables
ERROR - 2022-04-24 20:36:10 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-04-24 20:59:12 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-04-24 21:56:20 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-04-24 21:56:21 --> Query error: Unknown column 'tbl_close_shift_fuels_vat' in 'field list' - Invalid query: SELECT `tbl_items`.`item_id`, `item_name`, 0 as `category_id`, CASE reading
						      WHEN 4 THEN SUM(sales_manual_meter)
						      WHEN 3 THEN SUM(tbl_close_shift_fuels.sales_elec_meter)
						      WHEN 2 THEN SUM(tbl_close_shift_fuels.sales_elec_cash / tbl_close_shift_fuels.unit_price)
						      WHEN 5 THEN GREATEST(SUM(tbl_close_shift_fuels.sales_elec_meter), SUM(tbl_close_shift_fuels.sales_elec_cash / tbl_close_shift_fuels.unit_price))
						      ELSE GREATEST(SUM(sales_manual_meter), SUM(tbl_close_shift_fuels.sales_elec_meter), SUM(tbl_close_shift_fuels.sales_elec_cash / tbl_close_shift_fuels.unit_price))
					  		END as qty, CASE reading
						      WHEN 4 THEN SUM(sales_manual_meter * tbl_measurement_type.value )
						      WHEN 3 THEN SUM(tbl_close_shift_fuels.sales_elec_meter * tbl_measurement_type.value)
						      WHEN 2 THEN SUM(tbl_close_shift_fuels.sales_elec_cash / tbl_close_shift_fuels.unit_price * tbl_measurement_type.value)
						      WHEN 5 THEN GREATEST(SUM(tbl_close_shift_fuels.sales_elec_meter), SUM(tbl_close_shift_fuels.sales_elec_cash / tbl_close_shift_fuels.unit_price) * tbl_measurement_type.value)
						      ELSE GREATEST(SUM(sales_manual_meter), SUM(tbl_close_shift_fuels.sales_elec_meter), SUM(tbl_close_shift_fuels.sales_elec_cash / tbl_close_shift_fuels.unit_price) * tbl_measurement_type.value)
					  		END as vol, CASE reading
						      WHEN 4 THEN SUM(sales_manual_cash / (1 + tbl_close_shift_fuels_vat.vat))
						      WHEN 3 THEN SUM(sales_elec_meter * (tbl_close_shift_fuels.unit_price / (1 + tbl_close_shift_fuels_vat.vat)))
						      WHEN 2 THEN SUM(sales_elec_cash / (1+ tbl_close_shift_fuels_vat.vat))
						      WHEN 5 THEN GREATEST(SUM(sales_elec_meter * (tbl_close_shift_fuels.unit_price / (1+ tbl_close_shift_fuels_vat.vat))), SUM(sales_elec_cash / (1+tbl_close_shift_fuels_vat.vat)))
						      ELSE GREATEST(SUM(sales_manual_cash / (1+tbl_close_shift_fuels_vat.vat)), SUM(sales_elec_meter * (tbl_close_shift_fuels.unit_price / (1+tbl_close_shift_fuels_vat.vat))), SUM(sales_elec_cash / (1+tbl_close_shift_fuels_vat.vat)))
					  		END as amnt, CASE reading
						      WHEN 4 THEN SUM(sales_manual_cash - (sales_manual_cash / (1 + tbl_close_shift_fuels_vat.vat)))
						      WHEN 3 THEN SUM(sales_elec_meter * (tbl_close_shift_fuels.unit_price - (tbl_close_shift_fuels.unit_price/(1 + tbl_close_shift_fuels_vat))))
						      WHEN 2 THEN SUM(sales_elec_cash - (sales_elec_cash / (1 + tbl_close_shift_fuels_vat.vat)))
						      WHEN 5 THEN GREATEST(SUM(sales_elec_meter * (tbl_close_shift_fuels.unit_price/(1 + tbl_close_shift_fuels_vat.vat)) * tbl_close_shift_fuels_vat.vat), SUM(sales_elec_cash - (sales_elec_cash / (1 + tbl_close_shift_fuels_vat.vat))))
						      ELSE GREATEST(SUM(sales_manual_cash -(sales_manual_cash / (1 + tbl_close_shift_fuels_vat.vat))), SUM(sales_elec_meter * (tbl_close_shift_fuels.unit_price/(1 + tbl_close_shift_fuels_vat.vat)) * tbl_close_shift_fuels_vat.vat), SUM(sales_elec_cash - (sales_elec_cash / (1 + tbl_close_shift_fuels_vat.vat))))
					  		END as vat
FROM `tbl_close_shift_fuels`
LEFT JOIN `tbl_pumps` ON `tbl_pumps`.`pump_id` = `tbl_close_shift_fuels`.`pump_id`
LEFT JOIN `tbl_items` ON `tbl_items`.`item_id` = `tbl_pumps`.`fuel_product_id`
LEFT JOIN `tbl_measurement_type` ON `tbl_measurement_type`.`type_id` = `tbl_items`.`measurement_unit_id`
LEFT JOIN `tbl_shifts` ON `tbl_shifts`.`shift_id` = `tbl_close_shift_fuels`.`shift_id`
LEFT JOIN `tbl_close_shift_fuels_vat` ON `tbl_close_shift_fuels_vat`.`id` = `tbl_close_shift_fuels`.`close_shift_fuel_id`
WHERE `tbl_close_shift_fuels`.`shift_id` IN('65', '64', '63', '62', '61', '60', '59', '58', '57', '56', '55', '54', '53', '52', '51', '50', '49', '48', '47', '46', '45', '44', '43', '42', '41', '40', '39', '38', '36', '35', '34', '33', '32', '31', '30', '29', '28', '27', '26', '25', '24', '23', '22', '21', '20', '19', '18', '17', '16', '15', '14', '13', '12', '11', '10', '9', '7', '6', '5', '4', '3', '2')
GROUP BY `tbl_items`.`item_id`
ORDER BY `tbl_items`.`item_name`
ERROR - 2022-04-24 21:56:42 --> 404 Page Not Found: Assets/DataTables
ERROR - 2022-04-24 21:56:42 --> 404 Page Not Found: Assets/js
ERROR - 2022-04-24 21:56:51 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-04-24 21:56:51 --> Query error: Unknown column 'tbl_close_shift_fuels_vat' in 'field list' - Invalid query: SELECT `tbl_items`.`item_id`, `item_name`, 0 as `category_id`, CASE reading
						      WHEN 4 THEN SUM(sales_manual_meter)
						      WHEN 3 THEN SUM(tbl_close_shift_fuels.sales_elec_meter)
						      WHEN 2 THEN SUM(tbl_close_shift_fuels.sales_elec_cash / tbl_close_shift_fuels.unit_price)
						      WHEN 5 THEN GREATEST(SUM(tbl_close_shift_fuels.sales_elec_meter), SUM(tbl_close_shift_fuels.sales_elec_cash / tbl_close_shift_fuels.unit_price))
						      ELSE GREATEST(SUM(sales_manual_meter), SUM(tbl_close_shift_fuels.sales_elec_meter), SUM(tbl_close_shift_fuels.sales_elec_cash / tbl_close_shift_fuels.unit_price))
					  		END as qty, CASE reading
						      WHEN 4 THEN SUM(sales_manual_meter * tbl_measurement_type.value )
						      WHEN 3 THEN SUM(tbl_close_shift_fuels.sales_elec_meter * tbl_measurement_type.value)
						      WHEN 2 THEN SUM(tbl_close_shift_fuels.sales_elec_cash / tbl_close_shift_fuels.unit_price * tbl_measurement_type.value)
						      WHEN 5 THEN GREATEST(SUM(tbl_close_shift_fuels.sales_elec_meter), SUM(tbl_close_shift_fuels.sales_elec_cash / tbl_close_shift_fuels.unit_price) * tbl_measurement_type.value)
						      ELSE GREATEST(SUM(sales_manual_meter), SUM(tbl_close_shift_fuels.sales_elec_meter), SUM(tbl_close_shift_fuels.sales_elec_cash / tbl_close_shift_fuels.unit_price) * tbl_measurement_type.value)
					  		END as vol, CASE reading
						      WHEN 4 THEN SUM(sales_manual_cash / (1 + tbl_close_shift_fuels_vat.vat))
						      WHEN 3 THEN SUM(sales_elec_meter * (tbl_close_shift_fuels.unit_price / (1 + tbl_close_shift_fuels_vat.vat)))
						      WHEN 2 THEN SUM(sales_elec_cash / (1+ tbl_close_shift_fuels_vat.vat))
						      WHEN 5 THEN GREATEST(SUM(sales_elec_meter * (tbl_close_shift_fuels.unit_price / (1+ tbl_close_shift_fuels_vat.vat))), SUM(sales_elec_cash / (1+tbl_close_shift_fuels_vat.vat)))
						      ELSE GREATEST(SUM(sales_manual_cash / (1+tbl_close_shift_fuels_vat.vat)), SUM(sales_elec_meter * (tbl_close_shift_fuels.unit_price / (1+tbl_close_shift_fuels_vat.vat))), SUM(sales_elec_cash / (1+tbl_close_shift_fuels_vat.vat)))
					  		END as amnt, CASE reading
						      WHEN 4 THEN SUM(sales_manual_cash - (sales_manual_cash / (1 + tbl_close_shift_fuels_vat.vat)))
						      WHEN 3 THEN SUM(sales_elec_meter * (tbl_close_shift_fuels.unit_price - (tbl_close_shift_fuels.unit_price/(1 + tbl_close_shift_fuels_vat))))
						      WHEN 2 THEN SUM(sales_elec_cash - (sales_elec_cash / (1 + tbl_close_shift_fuels_vat.vat)))
						      WHEN 5 THEN GREATEST(SUM(sales_elec_meter * (tbl_close_shift_fuels.unit_price/(1 + tbl_close_shift_fuels_vat.vat)) * tbl_close_shift_fuels_vat.vat), SUM(sales_elec_cash - (sales_elec_cash / (1 + tbl_close_shift_fuels_vat.vat))))
						      ELSE GREATEST(SUM(sales_manual_cash -(sales_manual_cash / (1 + tbl_close_shift_fuels_vat.vat))), SUM(sales_elec_meter * (tbl_close_shift_fuels.unit_price/(1 + tbl_close_shift_fuels_vat.vat)) * tbl_close_shift_fuels_vat.vat), SUM(sales_elec_cash - (sales_elec_cash / (1 + tbl_close_shift_fuels_vat.vat))))
					  		END as vat
FROM `tbl_close_shift_fuels`
LEFT JOIN `tbl_pumps` ON `tbl_pumps`.`pump_id` = `tbl_close_shift_fuels`.`pump_id`
LEFT JOIN `tbl_items` ON `tbl_items`.`item_id` = `tbl_pumps`.`fuel_product_id`
LEFT JOIN `tbl_measurement_type` ON `tbl_measurement_type`.`type_id` = `tbl_items`.`measurement_unit_id`
LEFT JOIN `tbl_shifts` ON `tbl_shifts`.`shift_id` = `tbl_close_shift_fuels`.`shift_id`
LEFT JOIN `tbl_close_shift_fuels_vat` ON `tbl_close_shift_fuels_vat`.`id` = `tbl_close_shift_fuels`.`close_shift_fuel_id`
WHERE `tbl_close_shift_fuels`.`shift_id` IN('65', '64', '63', '62', '61', '60', '59', '58', '57', '56', '55', '54', '53', '52', '51', '50', '49', '48', '47', '46', '45', '44', '43', '42', '41', '40', '39', '38', '36', '35', '34', '33', '32', '31', '30', '29', '28', '27', '26', '25', '24', '23', '22', '21', '20', '19', '18', '17', '16', '15', '14', '13', '12', '11', '10', '9', '7', '6', '5', '4', '3', '2')
GROUP BY `tbl_items`.`item_id`
ORDER BY `tbl_items`.`item_name`
ERROR - 2022-04-24 22:04:11 --> 404 Page Not Found: Assets/js
ERROR - 2022-04-24 22:04:12 --> 404 Page Not Found: Assets/DataTables
ERROR - 2022-04-24 22:04:25 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-04-24 22:04:25 --> Query error: Unknown column 'tbl_close_shift_fuels_vat' in 'field list' - Invalid query: SELECT `tbl_items`.`item_id`, `tbl_close_shift_fuels_vat`.`vat`, `item_name`, 0 as `category_id`, CASE reading
						      WHEN 4 THEN SUM(sales_manual_meter)
						      WHEN 3 THEN SUM(tbl_close_shift_fuels.sales_elec_meter)
						      WHEN 2 THEN SUM(tbl_close_shift_fuels.sales_elec_cash / tbl_close_shift_fuels.unit_price)
						      WHEN 5 THEN GREATEST(SUM(tbl_close_shift_fuels.sales_elec_meter), SUM(tbl_close_shift_fuels.sales_elec_cash / tbl_close_shift_fuels.unit_price))
						      ELSE GREATEST(SUM(sales_manual_meter), SUM(tbl_close_shift_fuels.sales_elec_meter), SUM(tbl_close_shift_fuels.sales_elec_cash / tbl_close_shift_fuels.unit_price))
					  		END as qty, CASE reading
						      WHEN 4 THEN SUM(sales_manual_meter * tbl_measurement_type.value )
						      WHEN 3 THEN SUM(tbl_close_shift_fuels.sales_elec_meter * tbl_measurement_type.value)
						      WHEN 2 THEN SUM(tbl_close_shift_fuels.sales_elec_cash / tbl_close_shift_fuels.unit_price * tbl_measurement_type.value)
						      WHEN 5 THEN GREATEST(SUM(tbl_close_shift_fuels.sales_elec_meter), SUM(tbl_close_shift_fuels.sales_elec_cash / tbl_close_shift_fuels.unit_price) * tbl_measurement_type.value)
						      ELSE GREATEST(SUM(sales_manual_meter), SUM(tbl_close_shift_fuels.sales_elec_meter), SUM(tbl_close_shift_fuels.sales_elec_cash / tbl_close_shift_fuels.unit_price) * tbl_measurement_type.value)
					  		END as vol, CASE reading
						      WHEN 4 THEN SUM(sales_manual_cash / (1 + tbl_close_shift_fuels_vat.vat))
						      WHEN 3 THEN SUM(sales_elec_meter * (tbl_close_shift_fuels.unit_price / (1 + tbl_close_shift_fuels_vat.vat)))
						      WHEN 2 THEN SUM(sales_elec_cash / (1 + tbl_close_shift_fuels_vat.vat))
						      WHEN 5 THEN GREATEST(SUM(sales_elec_meter * (tbl_close_shift_fuels.unit_price / (1+ tbl_close_shift_fuels_vat.vat))), SUM(sales_elec_cash / (1+tbl_close_shift_fuels_vat.vat)))
						      ELSE GREATEST(SUM(sales_manual_cash / (1 + tbl_close_shift_fuels_vat.vat)), SUM(sales_elec_meter * (tbl_close_shift_fuels.unit_price / (1+tbl_close_shift_fuels_vat.vat))), SUM(sales_elec_cash / (1 + tbl_close_shift_fuels_vat.vat)))
					  		END as amnt, CASE reading
						      WHEN 4 THEN SUM(sales_manual_cash - (sales_manual_cash / (1 + tbl_close_shift_fuels_vat.vat)))
						      WHEN 3 THEN SUM(sales_elec_meter * (tbl_close_shift_fuels.unit_price - (tbl_close_shift_fuels.unit_price/(1 + tbl_close_shift_fuels_vat))))
						      WHEN 2 THEN SUM(sales_elec_cash - (sales_elec_cash / (1 + tbl_close_shift_fuels_vat.vat)))
						      WHEN 5 THEN GREATEST(SUM(sales_elec_meter * (tbl_close_shift_fuels.unit_price/(1 + tbl_close_shift_fuels_vat.vat)) * tbl_close_shift_fuels_vat.vat), SUM(sales_elec_cash - (sales_elec_cash / (1 + tbl_close_shift_fuels_vat.vat))))
						      ELSE GREATEST(SUM(sales_manual_cash -(sales_manual_cash / (1 + tbl_close_shift_fuels_vat.vat))), SUM(sales_elec_meter * (tbl_close_shift_fuels.unit_price/(1 + tbl_close_shift_fuels_vat.vat)) * tbl_close_shift_fuels_vat.vat), SUM(sales_elec_cash - (sales_elec_cash / (1 + tbl_close_shift_fuels_vat.vat))))
					  		END as vat
FROM `tbl_close_shift_fuels`
LEFT JOIN `tbl_pumps` ON `tbl_pumps`.`pump_id` = `tbl_close_shift_fuels`.`pump_id`
LEFT JOIN `tbl_items` ON `tbl_items`.`item_id` = `tbl_pumps`.`fuel_product_id`
LEFT JOIN `tbl_measurement_type` ON `tbl_measurement_type`.`type_id` = `tbl_items`.`measurement_unit_id`
LEFT JOIN `tbl_shifts` ON `tbl_shifts`.`shift_id` = `tbl_close_shift_fuels`.`shift_id`
LEFT JOIN `tbl_close_shift_fuels_vat` ON `tbl_close_shift_fuels_vat`.`id` = `tbl_close_shift_fuels`.`close_shift_fuel_id`
WHERE `tbl_close_shift_fuels`.`shift_id` IN('65', '64', '63', '62', '61', '60', '59', '58', '57', '56', '55', '54', '53', '52', '51', '50', '49', '48', '47', '46', '45', '44', '43', '42', '41', '40', '39', '38', '36', '35', '34', '33', '32', '31', '30', '29', '28', '27', '26', '25', '24', '23', '22', '21', '20', '19', '18', '17', '16', '15', '14', '13', '12', '11', '10', '9', '7', '6', '5', '4', '3', '2')
GROUP BY `tbl_items`.`item_id`
ORDER BY `tbl_items`.`item_name`
ERROR - 2022-04-24 22:06:03 --> 404 Page Not Found: Assets/js
ERROR - 2022-04-24 22:06:12 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-04-24 22:06:12 --> Query error: Not unique table/alias: 'tbl_close_shift_fuels_vat' - Invalid query: SELECT `tbl_items`.`item_id`, `tbl_close_shift_fuels_vat`.`vat`, `item_name`, 0 as `category_id`, CASE reading
						      WHEN 4 THEN SUM(sales_manual_meter)
						      WHEN 3 THEN SUM(tbl_close_shift_fuels.sales_elec_meter)
						      WHEN 2 THEN SUM(tbl_close_shift_fuels.sales_elec_cash / tbl_close_shift_fuels.unit_price)
						      WHEN 5 THEN GREATEST(SUM(tbl_close_shift_fuels.sales_elec_meter), SUM(tbl_close_shift_fuels.sales_elec_cash / tbl_close_shift_fuels.unit_price))
						      ELSE GREATEST(SUM(sales_manual_meter), SUM(tbl_close_shift_fuels.sales_elec_meter), SUM(tbl_close_shift_fuels.sales_elec_cash / tbl_close_shift_fuels.unit_price))
					  		END as qty, CASE reading
						      WHEN 4 THEN SUM(sales_manual_meter * tbl_measurement_type.value )
						      WHEN 3 THEN SUM(tbl_close_shift_fuels.sales_elec_meter * tbl_measurement_type.value)
						      WHEN 2 THEN SUM(tbl_close_shift_fuels.sales_elec_cash / tbl_close_shift_fuels.unit_price * tbl_measurement_type.value)
						      WHEN 5 THEN GREATEST(SUM(tbl_close_shift_fuels.sales_elec_meter), SUM(tbl_close_shift_fuels.sales_elec_cash / tbl_close_shift_fuels.unit_price) * tbl_measurement_type.value)
						      ELSE GREATEST(SUM(sales_manual_meter), SUM(tbl_close_shift_fuels.sales_elec_meter), SUM(tbl_close_shift_fuels.sales_elec_cash / tbl_close_shift_fuels.unit_price) * tbl_measurement_type.value)
					  		END as vol, CASE reading
						      WHEN 4 THEN SUM(sales_manual_cash / (1 + tbl_close_shift_fuels_vat.vat))
						      WHEN 3 THEN SUM(sales_elec_meter * (tbl_close_shift_fuels.unit_price / (1 + tbl_close_shift_fuels_vat.vat)))
						      WHEN 2 THEN SUM(sales_elec_cash / (1 + tbl_close_shift_fuels_vat.vat))
						      WHEN 5 THEN GREATEST(SUM(sales_elec_meter * (tbl_close_shift_fuels.unit_price / (1+ tbl_close_shift_fuels_vat.vat))), SUM(sales_elec_cash / (1+tbl_close_shift_fuels_vat.vat)))
						      ELSE GREATEST(SUM(sales_manual_cash / (1 + tbl_close_shift_fuels_vat.vat)), SUM(sales_elec_meter * (tbl_close_shift_fuels.unit_price / (1+tbl_close_shift_fuels_vat.vat))), SUM(sales_elec_cash / (1 + tbl_close_shift_fuels_vat.vat)))
					  		END as amnt, CASE reading
						      WHEN 4 THEN SUM(sales_manual_cash - (sales_manual_cash / (1 + tbl_close_shift_fuels_vat.vat)))
						      WHEN 3 THEN SUM(sales_elec_meter * (tbl_close_shift_fuels.unit_price - (tbl_close_shift_fuels.unit_price/(1 + tbl_close_shift_fuels_vat))))
						      WHEN 2 THEN SUM(sales_elec_cash - (sales_elec_cash / (1 + tbl_close_shift_fuels_vat.vat)))
						      WHEN 5 THEN GREATEST(SUM(sales_elec_meter * (tbl_close_shift_fuels.unit_price/(1 + tbl_close_shift_fuels_vat.vat)) * tbl_close_shift_fuels_vat.vat), SUM(sales_elec_cash - (sales_elec_cash / (1 + tbl_close_shift_fuels_vat.vat))))
						      ELSE GREATEST(SUM(sales_manual_cash -(sales_manual_cash / (1 + tbl_close_shift_fuels_vat.vat))), SUM(sales_elec_meter * (tbl_close_shift_fuels.unit_price/(1 + tbl_close_shift_fuels_vat.vat)) * tbl_close_shift_fuels_vat.vat), SUM(sales_elec_cash - (sales_elec_cash / (1 + tbl_close_shift_fuels_vat.vat))))
					  		END as vat
FROM `tbl_close_shift_fuels`
LEFT JOIN `tbl_pumps` ON `tbl_pumps`.`pump_id` = `tbl_close_shift_fuels`.`pump_id`
LEFT JOIN `tbl_close_shift_fuels_vat` ON `tbl_close_shift_fuels_vat`.`id` = `tbl_close_shift_fuels`.`close_shift_fuel_id`
LEFT JOIN `tbl_items` ON `tbl_items`.`item_id` = `tbl_pumps`.`fuel_product_id`
LEFT JOIN `tbl_measurement_type` ON `tbl_measurement_type`.`type_id` = `tbl_items`.`measurement_unit_id`
LEFT JOIN `tbl_shifts` ON `tbl_shifts`.`shift_id` = `tbl_close_shift_fuels`.`shift_id`
LEFT JOIN `tbl_close_shift_fuels_vat` ON `tbl_close_shift_fuels_vat`.`id` = `tbl_close_shift_fuels`.`close_shift_fuel_id`
WHERE `tbl_close_shift_fuels`.`shift_id` IN('65', '64', '63', '62', '61', '60', '59', '58', '57', '56', '55', '54', '53', '52', '51', '50', '49', '48', '47', '46', '45', '44', '43', '42', '41', '40', '39', '38', '36', '35', '34', '33', '32', '31', '30', '29', '28', '27', '26', '25', '24', '23', '22', '21', '20', '19', '18', '17', '16', '15', '14', '13', '12', '11', '10', '9', '7', '6', '5', '4', '3', '2')
GROUP BY `tbl_items`.`item_id`
ORDER BY `tbl_items`.`item_name`
ERROR - 2022-04-24 22:07:05 --> 404 Page Not Found: Assets/js
ERROR - 2022-04-24 22:07:05 --> 404 Page Not Found: Assets/DataTables
ERROR - 2022-04-24 22:07:15 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-04-24 22:07:15 --> Query error: Unknown column 'tbl_close_shift_fuels_vat' in 'field list' - Invalid query: SELECT `tbl_items`.`item_id`, `tbl_close_shift_fuels_vat`.`vat`, `item_name`, 0 as `category_id`, CASE reading
						      WHEN 4 THEN SUM(sales_manual_meter)
						      WHEN 3 THEN SUM(tbl_close_shift_fuels.sales_elec_meter)
						      WHEN 2 THEN SUM(tbl_close_shift_fuels.sales_elec_cash / tbl_close_shift_fuels.unit_price)
						      WHEN 5 THEN GREATEST(SUM(tbl_close_shift_fuels.sales_elec_meter), SUM(tbl_close_shift_fuels.sales_elec_cash / tbl_close_shift_fuels.unit_price))
						      ELSE GREATEST(SUM(sales_manual_meter), SUM(tbl_close_shift_fuels.sales_elec_meter), SUM(tbl_close_shift_fuels.sales_elec_cash / tbl_close_shift_fuels.unit_price))
					  		END as qty, CASE reading
						      WHEN 4 THEN SUM(sales_manual_meter * tbl_measurement_type.value )
						      WHEN 3 THEN SUM(tbl_close_shift_fuels.sales_elec_meter * tbl_measurement_type.value)
						      WHEN 2 THEN SUM(tbl_close_shift_fuels.sales_elec_cash / tbl_close_shift_fuels.unit_price * tbl_measurement_type.value)
						      WHEN 5 THEN GREATEST(SUM(tbl_close_shift_fuels.sales_elec_meter), SUM(tbl_close_shift_fuels.sales_elec_cash / tbl_close_shift_fuels.unit_price) * tbl_measurement_type.value)
						      ELSE GREATEST(SUM(sales_manual_meter), SUM(tbl_close_shift_fuels.sales_elec_meter), SUM(tbl_close_shift_fuels.sales_elec_cash / tbl_close_shift_fuels.unit_price) * tbl_measurement_type.value)
					  		END as vol, CASE reading
						      WHEN 4 THEN SUM(sales_manual_cash / (1 + tbl_close_shift_fuels_vat.vat))
						      WHEN 3 THEN SUM(sales_elec_meter * (tbl_close_shift_fuels.unit_price / (1 + tbl_close_shift_fuels_vat.vat)))
						      WHEN 2 THEN SUM(sales_elec_cash / (1 + tbl_close_shift_fuels_vat.vat))
						      WHEN 5 THEN GREATEST(SUM(sales_elec_meter * (tbl_close_shift_fuels.unit_price / (1+ tbl_close_shift_fuels_vat.vat))), SUM(sales_elec_cash / (1+tbl_close_shift_fuels_vat.vat)))
						      ELSE GREATEST(SUM(sales_manual_cash / (1 + tbl_close_shift_fuels_vat.vat)), SUM(sales_elec_meter * (tbl_close_shift_fuels.unit_price / (1+tbl_close_shift_fuels_vat.vat))), SUM(sales_elec_cash / (1 + tbl_close_shift_fuels_vat.vat)))
					  		END as amnt, CASE reading
						      WHEN 4 THEN SUM(sales_manual_cash - (sales_manual_cash / (1 + tbl_close_shift_fuels_vat.vat)))
						      WHEN 3 THEN SUM(sales_elec_meter * (tbl_close_shift_fuels.unit_price - (tbl_close_shift_fuels.unit_price/(1 + tbl_close_shift_fuels_vat))))
						      WHEN 2 THEN SUM(sales_elec_cash - (sales_elec_cash / (1 + tbl_close_shift_fuels_vat.vat)))
						      WHEN 5 THEN GREATEST(SUM(sales_elec_meter * (tbl_close_shift_fuels.unit_price/(1 + tbl_close_shift_fuels_vat.vat)) * tbl_close_shift_fuels_vat.vat), SUM(sales_elec_cash - (sales_elec_cash / (1 + tbl_close_shift_fuels_vat.vat))))
						      ELSE GREATEST(SUM(sales_manual_cash -(sales_manual_cash / (1 + tbl_close_shift_fuels_vat.vat))), SUM(sales_elec_meter * (tbl_close_shift_fuels.unit_price/(1 + tbl_close_shift_fuels_vat.vat)) * tbl_close_shift_fuels_vat.vat), SUM(sales_elec_cash - (sales_elec_cash / (1 + tbl_close_shift_fuels_vat.vat))))
					  		END as vat
FROM `tbl_close_shift_fuels`
LEFT JOIN `tbl_pumps` ON `tbl_pumps`.`pump_id` = `tbl_close_shift_fuels`.`pump_id`
LEFT JOIN `tbl_close_shift_fuels_vat` ON `tbl_close_shift_fuels_vat`.`id` = `tbl_close_shift_fuels`.`close_shift_fuel_id`
LEFT JOIN `tbl_items` ON `tbl_items`.`item_id` = `tbl_pumps`.`fuel_product_id`
LEFT JOIN `tbl_measurement_type` ON `tbl_measurement_type`.`type_id` = `tbl_items`.`measurement_unit_id`
LEFT JOIN `tbl_shifts` ON `tbl_shifts`.`shift_id` = `tbl_close_shift_fuels`.`shift_id`
WHERE `tbl_close_shift_fuels`.`shift_id` IN('65', '64', '63', '62', '61', '60', '59', '58', '57', '56', '55', '54', '53', '52', '51', '50', '49', '48', '47', '46', '45', '44', '43', '42', '41', '40', '39', '38', '36', '35', '34', '33', '32', '31', '30', '29', '28', '27', '26', '25', '24', '23', '22', '21', '20', '19', '18', '17', '16', '15', '14', '13', '12', '11', '10', '9', '7', '6', '5', '4', '3', '2')
GROUP BY `tbl_items`.`item_id`
ORDER BY `tbl_items`.`item_name`
ERROR - 2022-04-24 22:08:20 --> 404 Page Not Found: Assets/js
ERROR - 2022-04-24 22:08:21 --> 404 Page Not Found: Assets/DataTables
ERROR - 2022-04-24 22:08:27 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-04-24 22:08:28 --> Query error: Unknown column 'tbl_close_shift_fuels_vat' in 'field list' - Invalid query: SELECT `tbl_items`.`item_id`, `tbl_close_shift_fuels_vat`.`vat`, `item_name`, 0 as `category_id`, CASE reading
						      WHEN 4 THEN SUM(sales_manual_meter)
						      WHEN 3 THEN SUM(tbl_close_shift_fuels.sales_elec_meter)
						      WHEN 2 THEN SUM(tbl_close_shift_fuels.sales_elec_cash / tbl_close_shift_fuels.unit_price)
						      WHEN 5 THEN GREATEST(SUM(tbl_close_shift_fuels.sales_elec_meter), SUM(tbl_close_shift_fuels.sales_elec_cash / tbl_close_shift_fuels.unit_price))
						      ELSE GREATEST(SUM(sales_manual_meter), SUM(tbl_close_shift_fuels.sales_elec_meter), SUM(tbl_close_shift_fuels.sales_elec_cash / tbl_close_shift_fuels.unit_price))
					  		END as qty, CASE reading
						      WHEN 4 THEN SUM(sales_manual_meter * tbl_measurement_type.value )
						      WHEN 3 THEN SUM(tbl_close_shift_fuels.sales_elec_meter * tbl_measurement_type.value)
						      WHEN 2 THEN SUM(tbl_close_shift_fuels.sales_elec_cash / tbl_close_shift_fuels.unit_price * tbl_measurement_type.value)
						      WHEN 5 THEN GREATEST(SUM(tbl_close_shift_fuels.sales_elec_meter), SUM(tbl_close_shift_fuels.sales_elec_cash / tbl_close_shift_fuels.unit_price) * tbl_measurement_type.value)
						      ELSE GREATEST(SUM(sales_manual_meter), SUM(tbl_close_shift_fuels.sales_elec_meter), SUM(tbl_close_shift_fuels.sales_elec_cash / tbl_close_shift_fuels.unit_price) * tbl_measurement_type.value)
					  		END as vol, CASE reading
						      WHEN 4 THEN SUM(sales_manual_cash / (1 + tbl_close_shift_fuels_vat.vat))
						      WHEN 3 THEN SUM(sales_elec_meter * (tbl_close_shift_fuels.unit_price / (1 + tbl_close_shift_fuels_vat.vat)))
						      WHEN 2 THEN SUM(sales_elec_cash / (1 + tbl_close_shift_fuels_vat.vat))
						      WHEN 5 THEN GREATEST(SUM(sales_elec_meter * (tbl_close_shift_fuels.unit_price / (1+ tbl_close_shift_fuels_vat.vat))), SUM(sales_elec_cash / (1+tbl_close_shift_fuels_vat.vat)))
						      ELSE GREATEST(SUM(sales_manual_cash / (1 + tbl_close_shift_fuels_vat.vat)), SUM(sales_elec_meter * (tbl_close_shift_fuels.unit_price / (1+tbl_close_shift_fuels_vat.vat))), SUM(sales_elec_cash / (1 + tbl_close_shift_fuels_vat.vat)))
					  		END as amnt, CASE reading
						      WHEN 4 THEN SUM(sales_manual_cash - (sales_manual_cash / (1 + tbl_close_shift_fuels_vat.vat)))
						      WHEN 3 THEN SUM(sales_elec_meter * (tbl_close_shift_fuels.unit_price - (tbl_close_shift_fuels.unit_price/(1 + tbl_close_shift_fuels_vat))))
						      WHEN 2 THEN SUM(sales_elec_cash - (sales_elec_cash / (1 + tbl_close_shift_fuels_vat.vat)))
						      WHEN 5 THEN GREATEST(SUM(sales_elec_meter * (tbl_close_shift_fuels.unit_price/(1 + tbl_close_shift_fuels_vat.vat)) * tbl_close_shift_fuels_vat.vat), SUM(sales_elec_cash - (sales_elec_cash / (1 + tbl_close_shift_fuels_vat.vat))))
						      ELSE GREATEST(SUM(sales_manual_cash -(sales_manual_cash / (1 + tbl_close_shift_fuels_vat.vat))), SUM(sales_elec_meter * (tbl_close_shift_fuels.unit_price/(1 + tbl_close_shift_fuels_vat.vat)) * tbl_close_shift_fuels_vat.vat), SUM(sales_elec_cash - (sales_elec_cash / (1 + tbl_close_shift_fuels_vat.vat))))
					  		END as vat
FROM `tbl_close_shift_fuels`
LEFT JOIN `tbl_close_shift_fuels_vat` ON `tbl_close_shift_fuels_vat`.`id` = `tbl_close_shift_fuels`.`close_shift_fuel_id`
LEFT JOIN `tbl_pumps` ON `tbl_pumps`.`pump_id` = `tbl_close_shift_fuels`.`pump_id`
LEFT JOIN `tbl_items` ON `tbl_items`.`item_id` = `tbl_pumps`.`fuel_product_id`
LEFT JOIN `tbl_measurement_type` ON `tbl_measurement_type`.`type_id` = `tbl_items`.`measurement_unit_id`
LEFT JOIN `tbl_shifts` ON `tbl_shifts`.`shift_id` = `tbl_close_shift_fuels`.`shift_id`
WHERE `tbl_close_shift_fuels`.`shift_id` IN('65', '64', '63', '62', '61', '60', '59', '58', '57', '56', '55', '54', '53', '52', '51', '50', '49', '48', '47', '46', '45', '44', '43', '42', '41', '40', '39', '38', '36', '35', '34', '33', '32', '31', '30', '29', '28', '27', '26', '25', '24', '23', '22', '21', '20', '19', '18', '17', '16', '15', '14', '13', '12', '11', '10', '9', '7', '6', '5', '4', '3', '2')
GROUP BY `tbl_items`.`item_id`
ORDER BY `tbl_items`.`item_name`
ERROR - 2022-04-24 22:16:33 --> 404 Page Not Found: Assets/DataTables
ERROR - 2022-04-24 22:16:35 --> 404 Page Not Found: Assets/js
ERROR - 2022-04-24 22:16:38 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-04-24 22:16:39 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'as vat
FROM `tbl_close_shift_products`
LEFT JOIN `tbl_items` ON `tbl_items`.`...' at line 1 - Invalid query: SELECT SUM(tbl_close_shift_products.sales_qty) as qty, SUM(sales_qty * tbl_measurement_type.value) as vol, SUM(sales_qty * ( price/(1 + tbl_close_shift_products_vat.vat))) as amnt, `item_name`, `category_id`, SUM((sales_qty * (price - ( price/(1 + tbl_close_shift_lubes_vat.vat)))) as vat
FROM `tbl_close_shift_products`
LEFT JOIN `tbl_items` ON `tbl_items`.`item_id` = `tbl_close_shift_products`.`item_id`
LEFT JOIN `tbl_products` ON `tbl_products`.`item_id` = `tbl_items`.`item_id`
LEFT JOIN `tbl_measurement_type` ON `tbl_measurement_type`.`type_id` = `tbl_items`.`measurement_unit_id`
LEFT JOIN `tbl_close_shift_products_vat` ON `tbl_close_shift_products_vat`.`id` = `tbl_close_shift_products`.`close_shift_id`
WHERE `sales_qty` > 0
AND `tbl_close_shift_products`.`shift_id` IN('65', '64', '63', '62', '61', '60', '59', '58', '57', '56', '55', '54', '53', '52', '51', '50', '49', '48', '47', '46', '45', '44', '43', '42', '41', '40', '39', '38', '36', '35', '34', '33', '32', '31', '30', '29', '28', '27', '26', '25', '24', '23', '22', '21', '20', '19', '18', '17', '16', '15', '14', '13', '12', '11', '10', '9', '7', '6', '5', '4', '3', '2')
GROUP BY `tbl_close_shift_products`.`item_id`
ORDER BY `tbl_items`.`item_name`
ERROR - 2022-04-24 22:16:48 --> 404 Page Not Found: Assets/js
ERROR - 2022-04-24 22:16:56 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-04-24 22:16:57 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'as vat
FROM `tbl_close_shift_products`
LEFT JOIN `tbl_items` ON `tbl_items`.`...' at line 1 - Invalid query: SELECT SUM(tbl_close_shift_products.sales_qty) as qty, SUM(sales_qty * tbl_measurement_type.value) as vol, SUM(sales_qty * ( price/(1 + tbl_close_shift_products_vat.vat))) as amnt, `item_name`, `category_id`, SUM((sales_qty * (price - ( price/(1 + tbl_close_shift_lubes_vat.vat)))) as vat
FROM `tbl_close_shift_products`
LEFT JOIN `tbl_items` ON `tbl_items`.`item_id` = `tbl_close_shift_products`.`item_id`
LEFT JOIN `tbl_products` ON `tbl_products`.`item_id` = `tbl_items`.`item_id`
LEFT JOIN `tbl_measurement_type` ON `tbl_measurement_type`.`type_id` = `tbl_items`.`measurement_unit_id`
LEFT JOIN `tbl_close_shift_products_vat` ON `tbl_close_shift_products_vat`.`id` = `tbl_close_shift_products`.`close_shift_id`
WHERE `sales_qty` > 0
AND `tbl_close_shift_products`.`shift_id` IN('65', '64', '63', '62', '61', '60', '59', '58', '57', '56', '55', '54', '53', '52', '51', '50', '49', '48', '47', '46', '45', '44', '43', '42', '41', '40', '39', '38', '36', '35', '34', '33', '32', '31', '30', '29', '28', '27', '26', '25', '24', '23', '22', '21', '20', '19', '18', '17', '16', '15', '14', '13', '12', '11', '10', '9', '7', '6', '5', '4', '3', '2')
GROUP BY `tbl_close_shift_products`.`item_id`
ORDER BY `tbl_items`.`item_name`
ERROR - 2022-04-24 22:19:34 --> 404 Page Not Found: Assets/js
ERROR - 2022-04-24 22:19:34 --> 404 Page Not Found: Assets/DataTables
ERROR - 2022-04-24 22:19:39 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-04-24 22:19:39 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'as vat
FROM `tbl_close_shift_products`
LEFT JOIN `tbl_items` ON `tbl_items`.`...' at line 1 - Invalid query: SELECT SUM(tbl_close_shift_products.sales_qty) as qty, SUM(sales_qty * tbl_measurement_type.value) as vol, SUM(sales_qty * ( price/(1 + tbl_close_shift_products_vat.vat))) as amnt, `item_name`, `category_id`, SUM((sales_qty * (price - ( price/(1 + tbl_close_shift_products_vat.vat)))) as vat
FROM `tbl_close_shift_products`
LEFT JOIN `tbl_items` ON `tbl_items`.`item_id` = `tbl_close_shift_products`.`item_id`
LEFT JOIN `tbl_products` ON `tbl_products`.`item_id` = `tbl_items`.`item_id`
LEFT JOIN `tbl_measurement_type` ON `tbl_measurement_type`.`type_id` = `tbl_items`.`measurement_unit_id`
LEFT JOIN `tbl_close_shift_products_vat` ON `tbl_close_shift_products_vat`.`id` = `tbl_close_shift_products`.`close_shift_id`
WHERE `sales_qty` > 0
AND `tbl_close_shift_products`.`shift_id` IN('65', '64', '63', '62', '61', '60', '59', '58', '57', '56', '55', '54', '53', '52', '51', '50', '49', '48', '47', '46', '45', '44', '43', '42', '41', '40', '39', '38', '36', '35', '34', '33', '32', '31', '30', '29', '28', '27', '26', '25', '24', '23', '22', '21', '20', '19', '18', '17', '16', '15', '14', '13', '12', '11', '10', '9', '7', '6', '5', '4', '3', '2')
GROUP BY `tbl_close_shift_products`.`item_id`
ORDER BY `tbl_items`.`item_name`
ERROR - 2022-04-24 22:26:41 --> 404 Page Not Found: Assets/js
ERROR - 2022-04-24 22:26:41 --> 404 Page Not Found: Assets/DataTables
ERROR - 2022-04-24 22:26:46 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-04-24 22:26:46 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'as vat
FROM `tbl_close_shift_products`
LEFT JOIN `tbl_items` ON `tbl_items`.`...' at line 1 - Invalid query: SELECT SUM(tbl_close_shift_products.sales_qty) as qty, SUM(sales_qty * tbl_measurement_type.value) as vol, SUM(sales_qty * ( price/(1 + tbl_close_shift_products_vat.vat))) as amnt, `item_name`, `category_id`, SUM((sales_qty * (price - ( price/(1 + tbl_close_shift_products_vat.vat)))) as vat
FROM `tbl_close_shift_products`
LEFT JOIN `tbl_items` ON `tbl_items`.`item_id` = `tbl_close_shift_products`.`item_id`
LEFT JOIN `tbl_products` ON `tbl_products`.`item_id` = `tbl_items`.`item_id`
LEFT JOIN `tbl_measurement_type` ON `tbl_measurement_type`.`type_id` = `tbl_items`.`measurement_unit_id`
LEFT JOIN `tbl_close_shift_products_vat` ON `tbl_close_shift_products_vat`.`id` = `tbl_close_shift_products`.`close_shift_id`
WHERE `sales_qty` > 0
AND `tbl_close_shift_products`.`shift_id` IN('65', '64', '63', '62', '61', '60', '59', '58', '57', '56', '55', '54', '53', '52', '51', '50', '49', '48', '47', '46', '45', '44', '43', '42', '41', '40', '39', '38', '36', '35', '34', '33', '32', '31', '30', '29', '28', '27', '26', '25', '24', '23', '22', '21', '20', '19', '18', '17', '16', '15', '14', '13', '12', '11', '10', '9', '7', '6', '5', '4', '3', '2')
GROUP BY `tbl_close_shift_products`.`item_id`
ORDER BY `tbl_items`.`item_name`
ERROR - 2022-04-24 22:30:45 --> 404 Page Not Found: Assets/js
ERROR - 2022-04-24 22:30:45 --> 404 Page Not Found: Assets/DataTables
ERROR - 2022-04-24 22:30:50 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-04-24 22:33:26 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-04-24 22:33:26 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'as vat
FROM `tbl_close_shift_products`
LEFT JOIN `tbl_items` ON `tbl_items`.`...' at line 1 - Invalid query: SELECT SUM(tbl_close_shift_products.sales_qty) as qty, SUM(sales_qty * tbl_measurement_type.value) as vol, SUM(sales_qty * ( price/(1 + tbl_close_shift_products_vat.vat))) as amnt, `item_name`, `category_id`, SUM((sales_qty * (price - ( price/(1 + tbl_close_shift_products_vat.vat)))) as vat
FROM `tbl_close_shift_products`
LEFT JOIN `tbl_items` ON `tbl_items`.`item_id` = `tbl_close_shift_products`.`item_id`
LEFT JOIN `tbl_products` ON `tbl_products`.`item_id` = `tbl_items`.`item_id`
LEFT JOIN `tbl_measurement_type` ON `tbl_measurement_type`.`type_id` = `tbl_items`.`measurement_unit_id`
LEFT JOIN `tbl_close_shift_products_vat` ON `tbl_close_shift_products_vat`.`id` = `tbl_close_shift_products`.`close_shift_id`
WHERE `sales_qty` > 0
AND `tbl_close_shift_products`.`shift_id` IN('65', '64', '63', '62', '61', '60', '59', '58', '57', '56', '55', '54', '53', '52', '51', '50', '49', '48', '47', '46', '45', '44', '43', '42', '41', '40', '39', '38', '36', '35', '34', '33', '32', '31', '30', '29', '28', '27', '26', '25', '24', '23', '22', '21', '20', '19', '18', '17', '16', '15', '14', '13', '12', '11', '10', '9', '7', '6', '5', '4', '3', '2')
GROUP BY `tbl_close_shift_products`.`item_id`
ORDER BY `tbl_items`.`item_name`
ERROR - 2022-04-24 22:33:50 --> Severity: error --> Exception: syntax error, unexpected 'public' (T_PUBLIC) C:\xampp\htdocs\fms_prod\application\models\ShiftReports_model.php 928
ERROR - 2022-04-24 22:35:05 --> 404 Page Not Found: ShiftReports/images
