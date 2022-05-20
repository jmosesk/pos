<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2022-05-14 11:15:00 --> 404 Page Not Found: /index
ERROR - 2022-05-14 11:15:03 --> 404 Page Not Found: /index
ERROR - 2022-05-14 11:18:37 --> 404 Page Not Found: /index
ERROR - 2022-05-14 11:20:08 --> 404 Page Not Found: Admin/index
ERROR - 2022-05-14 11:20:26 --> Unable to connect to the database
ERROR - 2022-05-14 11:21:03 --> Unable to connect to the database
ERROR - 2022-05-14 11:21:15 --> 404 Page Not Found: User/images
ERROR - 2022-05-14 11:21:27 --> 404 Page Not Found: /index
ERROR - 2022-05-14 11:26:41 --> 404 Page Not Found: Payment/images
ERROR - 2022-05-14 11:29:16 --> 404 Page Not Found: Payment/images
ERROR - 2022-05-14 11:31:01 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-14 11:31:20 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-14 11:32:24 --> Query error: Table 'posmain.tbl_close_shift_drops' doesn't exist - Invalid query: SELECT `tbl_close_shift_drops`.`user_id`, SUM(tbl_close_shift_drops.excess) as excess, `users_drop`.`name` as `cashier`
FROM `tbl_close_shift_drops`
LEFT JOIN `tbl_users` `users_drop` ON `users_drop`.`user_id` = `tbl_close_shift_drops`.`user_id`
WHERE `tbl_close_shift_drops`.`shift_id` = '308'
AND `excess` != 0
GROUP BY `tbl_close_shift_drops`.`user_id`
ERROR - 2022-05-14 11:48:43 --> Query error: Expression #3 of SELECT list is not in GROUP BY clause and contains nonaggregated column 'posmain.tbl_customers_transactions.bbf' which is not functionally dependent on columns in GROUP BY clause; this is incompatible with sql_mode=only_full_group_by - Invalid query: SELECT `tbl_customers_transactions`.`customer_id`, `tbl_customers`.`company_name`, `tbl_customers_transactions`.`bbf`, SUM(IF((tbl_customers_transactions.debit = 1), ((tbl_customers_transactions.amount)), 0)) as debit, SUM(IF((tbl_customers_transactions.debit = 0), ((tbl_customers_transactions.amount)), 0)) as credit, `tbl_customers_transactions`.`amount`, `debit` as `debit_type`
FROM `tbl_customers_transactions`
LEFT JOIN `tbl_customers` ON `tbl_customers`.`customer_id` = `tbl_customers_transactions`.`customer_id`
WHERE `tbl_customers_transactions`.`shift_id` IN('300', '299', '298', '297', '296', '295', '294', '293', '292', '291', '290', '289', '288', '287', '286', '285', '284', '283', '282', '281', '280', '279', '278', '277', '276', '275', '274', '273', '272', '271', '270', '269', '268', '267', '266', '265', '264', '263', '262', '261', '260', '259', '258', '257', '256', '255', '254', '253', '252', '251', '250', '249', '248', '247', '246', '245', '244', '243', '242', '241')
GROUP BY `tbl_customers_transactions`.`customer_id`
