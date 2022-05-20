<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2022-04-28 07:36:39 --> Severity: Notice --> Array to string conversion C:\xampp\htdocs\fms_prod\application\views\shiftReports\customer_summary_report.php 35
ERROR - 2022-04-28 09:34:51 --> 404 Page Not Found: Product/images
ERROR - 2022-04-28 10:44:48 --> 404 Page Not Found: Assets/js
ERROR - 2022-04-28 10:44:48 --> 404 Page Not Found: Assets/DataTables
ERROR - 2022-04-28 10:45:29 --> 404 Page Not Found: Assets/js
ERROR - 2022-04-28 10:45:29 --> 404 Page Not Found: Assets/DataTables
ERROR - 2022-04-28 10:45:51 --> 404 Page Not Found: Assets/js
ERROR - 2022-04-28 10:45:51 --> 404 Page Not Found: Assets/DataTables
ERROR - 2022-04-28 10:46:01 --> Query error: Unknown column 'vendor_transaction_id' in 'order clause' - Invalid query: SELECT *
FROM `tbl_vendors_transactions`
WHERE `supplier_id` = '1'
ORDER BY `vendor_transaction_id` DESC
 LIMIT 1
ERROR - 2022-04-28 10:48:00 --> 404 Page Not Found: Assets/js
ERROR - 2022-04-28 10:48:17 --> 404 Page Not Found: Shift/images
ERROR - 2022-04-28 12:00:19 --> 404 Page Not Found: Payment/images
ERROR - 2022-04-28 12:04:26 --> 404 Page Not Found: Shift/images
ERROR - 2022-04-28 14:16:00 --> 404 Page Not Found: Payment/images
ERROR - 2022-04-28 15:59:42 --> Severity: Notice --> Undefined variable: custCards C:\xampp\htdocs\fms_prod\application\views\payment\vendor_payment.php 195
ERROR - 2022-04-28 16:02:37 --> Severity: Notice --> Undefined variable: custCards C:\xampp\htdocs\fms_prod\application\views\payment\vendor_payment.php 195
ERROR - 2022-04-28 16:10:33 --> 404 Page Not Found: Assets/DataTables
ERROR - 2022-04-28 16:10:33 --> 404 Page Not Found: Assets/js
ERROR - 2022-04-28 16:11:48 --> 404 Page Not Found: Assets/js
ERROR - 2022-04-28 16:11:48 --> 404 Page Not Found: Assets/DataTables
ERROR - 2022-04-28 16:48:22 --> Query error: Unknown column 'tbl_supplier.company_name' in 'field list' - Invalid query: SELECT `tbl_shifts`.`shift_date` as `datetime`, `supplier_transaction_id`, `debit`, `amount`, `tbl_users`.`name` as `employee`, `tbl_supplier`.`company_name` as `supplier`, `tbl_payment_type`.`name` as `payment_type`, `ref_number`, `tbl_supplier_payments`.`remarks`, `tbl_supplier_payments`.`payment_reason`
FROM `tbl_vendors_transactions`
LEFT JOIN `tbl_shifts` ON `tbl_shifts`.`shift_id` = `tbl_vendors_transactions`.`shift_id`
LEFT JOIN `tbl_users` ON `tbl_users`.`user_id` = `tbl_customers_transactions`.`employee_id`
JOIN `tbl_payment_type` ON `tbl_payment_type`.`type_id` = `tbl_vendors_transactions`.`payment_type`
JOIN `tbl_supplier_payments` ON `tbl_supplier_payments`.`supplier_transactions_id` = `tbl_vendors_transactions`.`supplier_transaction_id`
LEFT JOIN `tbl_suppliers` ON `tbl_suppliers`.`supplier_id` = `tbl_vendors_transactions`.`supplier_id`
ORDER BY `supplier_transaction_id` DESC
ERROR - 2022-04-28 16:50:19 --> Query error: Unknown column 'tbl_customers_transactions.employee_id' in 'on clause' - Invalid query: SELECT `tbl_shifts`.`shift_date` as `datetime`, `supplier_transaction_id`, `debit`, `amount`, `tbl_users`.`name` as `employee`, `tbl_suppliers`.`company_name` as `supplier`, `tbl_payment_type`.`name` as `payment_type`, `ref_number`, `tbl_supplier_payments`.`remarks`, `tbl_supplier_payments`.`payment_reason`
FROM `tbl_vendors_transactions`
LEFT JOIN `tbl_shifts` ON `tbl_shifts`.`shift_id` = `tbl_vendors_transactions`.`shift_id`
LEFT JOIN `tbl_users` ON `tbl_users`.`user_id` = `tbl_customers_transactions`.`employee_id`
JOIN `tbl_payment_type` ON `tbl_payment_type`.`type_id` = `tbl_vendors_transactions`.`payment_type`
JOIN `tbl_supplier_payments` ON `tbl_supplier_payments`.`supplier_transactions_id` = `tbl_vendors_transactions`.`supplier_transaction_id`
LEFT JOIN `tbl_suppliers` ON `tbl_suppliers`.`supplier_id` = `tbl_vendors_transactions`.`supplier_id`
ORDER BY `supplier_transaction_id` DESC
ERROR - 2022-04-28 16:51:12 --> 404 Page Not Found: Assets/js
ERROR - 2022-04-28 16:51:14 --> 404 Page Not Found: Assets/DataTables
ERROR - 2022-04-28 18:03:08 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-04-28 19:29:26 --> Severity: Notice --> Undefined variable: suppliers C:\xampp\htdocs\fms_prod\application\views\shiftReports\supplierStatement.php 32
ERROR - 2022-04-28 19:29:26 --> Severity: error --> Exception: Call to a member function result() on null C:\xampp\htdocs\fms_prod\application\views\shiftReports\supplierStatement.php 32
ERROR - 2022-04-28 19:31:36 --> Severity: Notice --> Undefined variable: suppliers C:\xampp\htdocs\fms_prod\application\views\shiftReports\supplierStatement.php 32
ERROR - 2022-04-28 19:31:37 --> Severity: error --> Exception: Call to a member function result() on null C:\xampp\htdocs\fms_prod\application\views\shiftReports\supplierStatement.php 32
ERROR - 2022-04-28 19:35:36 --> 404 Page Not Found: Assets/js
ERROR - 2022-04-28 19:35:37 --> 404 Page Not Found: Assets/DataTables
ERROR - 2022-04-28 19:38:56 --> 404 Page Not Found: Assets/js
ERROR - 2022-04-28 19:38:56 --> 404 Page Not Found: Assets/DataTables
ERROR - 2022-04-28 19:41:38 --> Severity: Notice --> Undefined property: mysqli::$customer_id C:\xampp\htdocs\fms_prod\application\views\shiftReports\supplierStatement.php 33
ERROR - 2022-04-28 19:41:38 --> Severity: Notice --> Undefined property: mysqli::$name C:\xampp\htdocs\fms_prod\application\views\shiftReports\supplierStatement.php 33
ERROR - 2022-04-28 19:41:38 --> Severity: Notice --> Undefined property: mysqli_result::$customer_id C:\xampp\htdocs\fms_prod\application\views\shiftReports\supplierStatement.php 33
ERROR - 2022-04-28 19:41:38 --> Severity: Notice --> Undefined property: mysqli_result::$name C:\xampp\htdocs\fms_prod\application\views\shiftReports\supplierStatement.php 33
ERROR - 2022-04-28 19:41:38 --> Severity: Notice --> Trying to get property 'customer_id' of non-object C:\xampp\htdocs\fms_prod\application\views\shiftReports\supplierStatement.php 33
ERROR - 2022-04-28 19:41:38 --> Severity: Notice --> Trying to get property 'name' of non-object C:\xampp\htdocs\fms_prod\application\views\shiftReports\supplierStatement.php 33
ERROR - 2022-04-28 19:41:38 --> Severity: Notice --> Trying to get property 'customer_id' of non-object C:\xampp\htdocs\fms_prod\application\views\shiftReports\supplierStatement.php 33
ERROR - 2022-04-28 19:41:38 --> Severity: Notice --> Trying to get property 'name' of non-object C:\xampp\htdocs\fms_prod\application\views\shiftReports\supplierStatement.php 33
ERROR - 2022-04-28 19:41:38 --> Severity: Notice --> Trying to get property 'customer_id' of non-object C:\xampp\htdocs\fms_prod\application\views\shiftReports\supplierStatement.php 33
ERROR - 2022-04-28 19:41:38 --> Severity: Notice --> Trying to get property 'name' of non-object C:\xampp\htdocs\fms_prod\application\views\shiftReports\supplierStatement.php 33
ERROR - 2022-04-28 19:41:38 --> Severity: Notice --> Trying to get property 'customer_id' of non-object C:\xampp\htdocs\fms_prod\application\views\shiftReports\supplierStatement.php 33
ERROR - 2022-04-28 19:41:38 --> Severity: Notice --> Trying to get property 'name' of non-object C:\xampp\htdocs\fms_prod\application\views\shiftReports\supplierStatement.php 33
ERROR - 2022-04-28 19:41:38 --> Severity: Notice --> Trying to get property 'customer_id' of non-object C:\xampp\htdocs\fms_prod\application\views\shiftReports\supplierStatement.php 33
ERROR - 2022-04-28 19:41:38 --> Severity: Notice --> Trying to get property 'name' of non-object C:\xampp\htdocs\fms_prod\application\views\shiftReports\supplierStatement.php 33
ERROR - 2022-04-28 19:41:38 --> Severity: Notice --> Trying to get property 'customer_id' of non-object C:\xampp\htdocs\fms_prod\application\views\shiftReports\supplierStatement.php 33
ERROR - 2022-04-28 19:41:38 --> Severity: Notice --> Trying to get property 'name' of non-object C:\xampp\htdocs\fms_prod\application\views\shiftReports\supplierStatement.php 33
ERROR - 2022-04-28 19:41:38 --> 404 Page Not Found: Assets/js
ERROR - 2022-04-28 19:41:38 --> 404 Page Not Found: Assets/DataTables
ERROR - 2022-04-28 19:42:24 --> Severity: Notice --> Undefined variable: suppliers C:\xampp\htdocs\fms_prod\application\views\shiftReports\supplierStatement.php 32
ERROR - 2022-04-28 19:42:24 --> Severity: error --> Exception: Call to a member function result() on null C:\xampp\htdocs\fms_prod\application\views\shiftReports\supplierStatement.php 32
ERROR - 2022-04-28 19:42:28 --> 404 Page Not Found: Assets/js
ERROR - 2022-04-28 19:42:29 --> 404 Page Not Found: Assets/DataTables
ERROR - 2022-04-28 19:43:00 --> Severity: Notice --> Undefined variable: suppliers C:\xampp\htdocs\fms_prod\application\views\shiftReports\supplierStatement.php 32
ERROR - 2022-04-28 19:43:00 --> Severity: error --> Exception: Call to a member function result() on null C:\xampp\htdocs\fms_prod\application\views\shiftReports\supplierStatement.php 32
ERROR - 2022-04-28 19:46:43 --> Severity: Notice --> Undefined variable: suppliers C:\xampp\htdocs\fms_prod\application\views\shiftReports\supplierStatement.php 32
ERROR - 2022-04-28 19:46:43 --> Severity: error --> Exception: Call to a member function result() on null C:\xampp\htdocs\fms_prod\application\views\shiftReports\supplierStatement.php 32
ERROR - 2022-04-28 19:46:45 --> Severity: Notice --> Undefined variable: suppliers C:\xampp\htdocs\fms_prod\application\views\shiftReports\supplierStatement.php 32
ERROR - 2022-04-28 19:46:45 --> Severity: error --> Exception: Call to a member function result() on null C:\xampp\htdocs\fms_prod\application\views\shiftReports\supplierStatement.php 32
ERROR - 2022-04-28 19:47:01 --> Severity: Notice --> Undefined variable: suppliers C:\xampp\htdocs\fms_prod\application\views\shiftReports\supplierStatement.php 32
ERROR - 2022-04-28 19:47:01 --> Severity: error --> Exception: Call to a member function result() on null C:\xampp\htdocs\fms_prod\application\views\shiftReports\supplierStatement.php 32
ERROR - 2022-04-28 19:49:13 --> Severity: Notice --> Undefined variable: suppliers C:\xampp\htdocs\fms_prod\application\views\shiftReports\supplierStatement.php 32
ERROR - 2022-04-28 19:49:13 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\fms_prod\application\views\shiftReports\supplierStatement.php 32
ERROR - 2022-04-28 20:05:03 --> Severity: Notice --> Undefined variable: suppliers C:\xampp\htdocs\fms_prod\application\views\shiftReports\supplierStatement.php 32
ERROR - 2022-04-28 20:05:03 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\fms_prod\application\views\shiftReports\supplierStatement.php 32
ERROR - 2022-04-28 20:05:49 --> Severity: Notice --> Undefined variable: suppliers C:\xampp\htdocs\fms_prod\application\views\shiftReports\supplierStatement.php 32
ERROR - 2022-04-28 20:05:49 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\fms_prod\application\views\shiftReports\supplierStatement.php 32
ERROR - 2022-04-28 20:11:46 --> Severity: Notice --> Undefined variable: suppliers C:\xampp\htdocs\fms_prod\application\views\shiftReports\supplierStatement.php 32
ERROR - 2022-04-28 20:11:46 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\fms_prod\application\views\shiftReports\supplierStatement.php 32
ERROR - 2022-04-28 20:16:09 --> Severity: Notice --> Undefined variable: suppliers C:\xampp\htdocs\fms_prod\application\views\shiftReports\supplierStatement.php 32
ERROR - 2022-04-28 20:16:09 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\fms_prod\application\views\shiftReports\supplierStatement.php 32
ERROR - 2022-04-28 20:16:58 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-04-28 20:16:58 --> Query error: Unknown column 'tbl_vendors_transactions.supplier_transactions_id' in 'on clause' - Invalid query: SELECT `tbl_suppliers`.`company_name`, DATE_FORMAT(tbl_shifts.shift_date, "%d-%m-%Y") as datetime, `supplier_transaction_id`, `tbl_vendors_transactions`.`debit`, `tbl_vendors_transactions`.`source`, `tbl_vendors_transactions`.`ref_number`, `tbl_supplier_payments`.`remarks`, `tbl_vendors_transactions`.`transaction_type`, `tbl_vendors_transactions`.`amount`, `tbl_vendors_transactions`.`payment_type` as `payment_type`, `bbf`, `tbl_receivings`.`invoice_number`, `tbl_receivings`.`type`
FROM `tbl_vendors_transactions`
LEFT JOIN `tbl_supplier_payments` ON `tbl_supplier_payments`.`supplier_transactions_id` = `tbl_vendors_transactions`.`supplier_transactions_id`
LEFT JOIN `tbl_payment_type` ON `tbl_payment_type`.`type_id` = `tbl_vendors_transactions`.`payment_type`
LEFT JOIN `tbl_receivings` ON `tbl_receivings`.`receiving_id` = `tbl_vendors_transactions`.`ref_number`
LEFT JOIN `tbl_suppliers` ON `tbl_suppliers`.`supplier_id` = `tbl_vendors_transactions`.`supplier_id`
LEFT JOIN `tbl_shifts` ON `tbl_shifts`.`shift_id` = `tbl_vendors_transactions`.`shift_id`
WHERE `tbl_vendors_transactions`.`supplier_id` = '1'
AND `tbl_vendors_transactions`.`shift_id` IN('2', '3', '4', '5', '6', '7', '9', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20', '21', '22', '23', '24', '25', '26', '27', '28', '29', '30', '31', '32', '33', '34', '35', '36', '38', '39', '40', '41', '42', '43', '44', '45', '46', '47', '48', '49', '50', '51', '52', '53', '54', '55', '56', '57', '58', '59', '60', '61', '62', '63', '64', '65')
ORDER BY `tbl_vendors_transactions`.`supplier_transaction_id` ASC
ERROR - 2022-04-28 20:17:01 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-04-28 20:17:01 --> Query error: Unknown column 'tbl_vendors_transactions.supplier_transactions_id' in 'on clause' - Invalid query: SELECT `tbl_suppliers`.`company_name`, DATE_FORMAT(tbl_shifts.shift_date, "%d-%m-%Y") as datetime, `supplier_transaction_id`, `tbl_vendors_transactions`.`debit`, `tbl_vendors_transactions`.`source`, `tbl_vendors_transactions`.`ref_number`, `tbl_supplier_payments`.`remarks`, `tbl_vendors_transactions`.`transaction_type`, `tbl_vendors_transactions`.`amount`, `tbl_vendors_transactions`.`payment_type` as `payment_type`, `bbf`, `tbl_receivings`.`invoice_number`, `tbl_receivings`.`type`
FROM `tbl_vendors_transactions`
LEFT JOIN `tbl_supplier_payments` ON `tbl_supplier_payments`.`supplier_transactions_id` = `tbl_vendors_transactions`.`supplier_transactions_id`
LEFT JOIN `tbl_payment_type` ON `tbl_payment_type`.`type_id` = `tbl_vendors_transactions`.`payment_type`
LEFT JOIN `tbl_receivings` ON `tbl_receivings`.`receiving_id` = `tbl_vendors_transactions`.`ref_number`
LEFT JOIN `tbl_suppliers` ON `tbl_suppliers`.`supplier_id` = `tbl_vendors_transactions`.`supplier_id`
LEFT JOIN `tbl_shifts` ON `tbl_shifts`.`shift_id` = `tbl_vendors_transactions`.`shift_id`
WHERE `tbl_vendors_transactions`.`supplier_id` = '1'
AND `tbl_vendors_transactions`.`shift_id` IN('2', '3', '4', '5', '6', '7', '9', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20', '21', '22', '23', '24', '25', '26', '27', '28', '29', '30', '31', '32', '33', '34', '35', '36', '38', '39', '40', '41', '42', '43', '44', '45', '46', '47', '48', '49', '50', '51', '52', '53', '54', '55', '56', '57', '58', '59', '60', '61', '62', '63', '64', '65')
ORDER BY `tbl_vendors_transactions`.`supplier_transaction_id` ASC
ERROR - 2022-04-28 20:17:02 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-04-28 20:17:02 --> Query error: Unknown column 'tbl_vendors_transactions.supplier_transactions_id' in 'on clause' - Invalid query: SELECT `tbl_suppliers`.`company_name`, DATE_FORMAT(tbl_shifts.shift_date, "%d-%m-%Y") as datetime, `supplier_transaction_id`, `tbl_vendors_transactions`.`debit`, `tbl_vendors_transactions`.`source`, `tbl_vendors_transactions`.`ref_number`, `tbl_supplier_payments`.`remarks`, `tbl_vendors_transactions`.`transaction_type`, `tbl_vendors_transactions`.`amount`, `tbl_vendors_transactions`.`payment_type` as `payment_type`, `bbf`, `tbl_receivings`.`invoice_number`, `tbl_receivings`.`type`
FROM `tbl_vendors_transactions`
LEFT JOIN `tbl_supplier_payments` ON `tbl_supplier_payments`.`supplier_transactions_id` = `tbl_vendors_transactions`.`supplier_transactions_id`
LEFT JOIN `tbl_payment_type` ON `tbl_payment_type`.`type_id` = `tbl_vendors_transactions`.`payment_type`
LEFT JOIN `tbl_receivings` ON `tbl_receivings`.`receiving_id` = `tbl_vendors_transactions`.`ref_number`
LEFT JOIN `tbl_suppliers` ON `tbl_suppliers`.`supplier_id` = `tbl_vendors_transactions`.`supplier_id`
LEFT JOIN `tbl_shifts` ON `tbl_shifts`.`shift_id` = `tbl_vendors_transactions`.`shift_id`
WHERE `tbl_vendors_transactions`.`supplier_id` = '1'
AND `tbl_vendors_transactions`.`shift_id` IN('2', '3', '4', '5', '6', '7', '9', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20', '21', '22', '23', '24', '25', '26', '27', '28', '29', '30', '31', '32', '33', '34', '35', '36', '38', '39', '40', '41', '42', '43', '44', '45', '46', '47', '48', '49', '50', '51', '52', '53', '54', '55', '56', '57', '58', '59', '60', '61', '62', '63', '64', '65')
ORDER BY `tbl_vendors_transactions`.`supplier_transaction_id` ASC
ERROR - 2022-04-28 20:17:02 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-04-28 20:17:02 --> Query error: Unknown column 'tbl_vendors_transactions.supplier_transactions_id' in 'on clause' - Invalid query: SELECT `tbl_suppliers`.`company_name`, DATE_FORMAT(tbl_shifts.shift_date, "%d-%m-%Y") as datetime, `supplier_transaction_id`, `tbl_vendors_transactions`.`debit`, `tbl_vendors_transactions`.`source`, `tbl_vendors_transactions`.`ref_number`, `tbl_supplier_payments`.`remarks`, `tbl_vendors_transactions`.`transaction_type`, `tbl_vendors_transactions`.`amount`, `tbl_vendors_transactions`.`payment_type` as `payment_type`, `bbf`, `tbl_receivings`.`invoice_number`, `tbl_receivings`.`type`
FROM `tbl_vendors_transactions`
LEFT JOIN `tbl_supplier_payments` ON `tbl_supplier_payments`.`supplier_transactions_id` = `tbl_vendors_transactions`.`supplier_transactions_id`
LEFT JOIN `tbl_payment_type` ON `tbl_payment_type`.`type_id` = `tbl_vendors_transactions`.`payment_type`
LEFT JOIN `tbl_receivings` ON `tbl_receivings`.`receiving_id` = `tbl_vendors_transactions`.`ref_number`
LEFT JOIN `tbl_suppliers` ON `tbl_suppliers`.`supplier_id` = `tbl_vendors_transactions`.`supplier_id`
LEFT JOIN `tbl_shifts` ON `tbl_shifts`.`shift_id` = `tbl_vendors_transactions`.`shift_id`
WHERE `tbl_vendors_transactions`.`supplier_id` = '1'
AND `tbl_vendors_transactions`.`shift_id` IN('2', '3', '4', '5', '6', '7', '9', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20', '21', '22', '23', '24', '25', '26', '27', '28', '29', '30', '31', '32', '33', '34', '35', '36', '38', '39', '40', '41', '42', '43', '44', '45', '46', '47', '48', '49', '50', '51', '52', '53', '54', '55', '56', '57', '58', '59', '60', '61', '62', '63', '64', '65')
ORDER BY `tbl_vendors_transactions`.`supplier_transaction_id` ASC
ERROR - 2022-04-28 20:17:03 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-04-28 20:17:03 --> Query error: Unknown column 'tbl_vendors_transactions.supplier_transactions_id' in 'on clause' - Invalid query: SELECT `tbl_suppliers`.`company_name`, DATE_FORMAT(tbl_shifts.shift_date, "%d-%m-%Y") as datetime, `supplier_transaction_id`, `tbl_vendors_transactions`.`debit`, `tbl_vendors_transactions`.`source`, `tbl_vendors_transactions`.`ref_number`, `tbl_supplier_payments`.`remarks`, `tbl_vendors_transactions`.`transaction_type`, `tbl_vendors_transactions`.`amount`, `tbl_vendors_transactions`.`payment_type` as `payment_type`, `bbf`, `tbl_receivings`.`invoice_number`, `tbl_receivings`.`type`
FROM `tbl_vendors_transactions`
LEFT JOIN `tbl_supplier_payments` ON `tbl_supplier_payments`.`supplier_transactions_id` = `tbl_vendors_transactions`.`supplier_transactions_id`
LEFT JOIN `tbl_payment_type` ON `tbl_payment_type`.`type_id` = `tbl_vendors_transactions`.`payment_type`
LEFT JOIN `tbl_receivings` ON `tbl_receivings`.`receiving_id` = `tbl_vendors_transactions`.`ref_number`
LEFT JOIN `tbl_suppliers` ON `tbl_suppliers`.`supplier_id` = `tbl_vendors_transactions`.`supplier_id`
LEFT JOIN `tbl_shifts` ON `tbl_shifts`.`shift_id` = `tbl_vendors_transactions`.`shift_id`
WHERE `tbl_vendors_transactions`.`supplier_id` = '1'
AND `tbl_vendors_transactions`.`shift_id` IN('2', '3', '4', '5', '6', '7', '9', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20', '21', '22', '23', '24', '25', '26', '27', '28', '29', '30', '31', '32', '33', '34', '35', '36', '38', '39', '40', '41', '42', '43', '44', '45', '46', '47', '48', '49', '50', '51', '52', '53', '54', '55', '56', '57', '58', '59', '60', '61', '62', '63', '64', '65')
ORDER BY `tbl_vendors_transactions`.`supplier_transaction_id` ASC
ERROR - 2022-04-28 20:17:03 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-04-28 20:17:03 --> Query error: Unknown column 'tbl_vendors_transactions.supplier_transactions_id' in 'on clause' - Invalid query: SELECT `tbl_suppliers`.`company_name`, DATE_FORMAT(tbl_shifts.shift_date, "%d-%m-%Y") as datetime, `supplier_transaction_id`, `tbl_vendors_transactions`.`debit`, `tbl_vendors_transactions`.`source`, `tbl_vendors_transactions`.`ref_number`, `tbl_supplier_payments`.`remarks`, `tbl_vendors_transactions`.`transaction_type`, `tbl_vendors_transactions`.`amount`, `tbl_vendors_transactions`.`payment_type` as `payment_type`, `bbf`, `tbl_receivings`.`invoice_number`, `tbl_receivings`.`type`
FROM `tbl_vendors_transactions`
LEFT JOIN `tbl_supplier_payments` ON `tbl_supplier_payments`.`supplier_transactions_id` = `tbl_vendors_transactions`.`supplier_transactions_id`
LEFT JOIN `tbl_payment_type` ON `tbl_payment_type`.`type_id` = `tbl_vendors_transactions`.`payment_type`
LEFT JOIN `tbl_receivings` ON `tbl_receivings`.`receiving_id` = `tbl_vendors_transactions`.`ref_number`
LEFT JOIN `tbl_suppliers` ON `tbl_suppliers`.`supplier_id` = `tbl_vendors_transactions`.`supplier_id`
LEFT JOIN `tbl_shifts` ON `tbl_shifts`.`shift_id` = `tbl_vendors_transactions`.`shift_id`
WHERE `tbl_vendors_transactions`.`supplier_id` = '1'
AND `tbl_vendors_transactions`.`shift_id` IN('2', '3', '4', '5', '6', '7', '9', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20', '21', '22', '23', '24', '25', '26', '27', '28', '29', '30', '31', '32', '33', '34', '35', '36', '38', '39', '40', '41', '42', '43', '44', '45', '46', '47', '48', '49', '50', '51', '52', '53', '54', '55', '56', '57', '58', '59', '60', '61', '62', '63', '64', '65')
ORDER BY `tbl_vendors_transactions`.`supplier_transaction_id` ASC
ERROR - 2022-04-28 20:17:11 --> 404 Page Not Found: Assets/js
ERROR - 2022-04-28 20:17:11 --> 404 Page Not Found: Assets/DataTables
ERROR - 2022-04-28 20:17:19 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-04-28 20:17:19 --> Query error: Unknown column 'tbl_vendors_transactions.supplier_transactions_id' in 'on clause' - Invalid query: SELECT `tbl_suppliers`.`company_name`, DATE_FORMAT(tbl_shifts.shift_date, "%d-%m-%Y") as datetime, `supplier_transaction_id`, `tbl_vendors_transactions`.`debit`, `tbl_vendors_transactions`.`source`, `tbl_vendors_transactions`.`ref_number`, `tbl_supplier_payments`.`remarks`, `tbl_vendors_transactions`.`transaction_type`, `tbl_vendors_transactions`.`amount`, `tbl_vendors_transactions`.`payment_type` as `payment_type`, `bbf`, `tbl_receivings`.`invoice_number`, `tbl_receivings`.`type`
FROM `tbl_vendors_transactions`
LEFT JOIN `tbl_supplier_payments` ON `tbl_supplier_payments`.`supplier_transactions_id` = `tbl_vendors_transactions`.`supplier_transactions_id`
LEFT JOIN `tbl_payment_type` ON `tbl_payment_type`.`type_id` = `tbl_vendors_transactions`.`payment_type`
LEFT JOIN `tbl_receivings` ON `tbl_receivings`.`receiving_id` = `tbl_vendors_transactions`.`ref_number`
LEFT JOIN `tbl_suppliers` ON `tbl_suppliers`.`supplier_id` = `tbl_vendors_transactions`.`supplier_id`
LEFT JOIN `tbl_shifts` ON `tbl_shifts`.`shift_id` = `tbl_vendors_transactions`.`shift_id`
WHERE `tbl_vendors_transactions`.`supplier_id` = '1'
AND `tbl_vendors_transactions`.`shift_id` IN('66', '67', '68', '69', '70', '71', '72', '73', '74', '75', '76', '77', '78', '79', '80', '81', '82', '83', '84', '85', '86', '87', '88', '89', '90', '91', '92', '93', '94', '95', '96', '97', '98', '99', '100', '101', '102', '103', '104', '105', '106', '107', '108')
ORDER BY `tbl_vendors_transactions`.`supplier_transaction_id` ASC
ERROR - 2022-04-28 20:25:59 --> 404 Page Not Found: Assets/DataTables
ERROR - 2022-04-28 20:25:59 --> 404 Page Not Found: Assets/js
ERROR - 2022-04-28 20:26:11 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-04-28 20:57:55 --> 404 Page Not Found: Assets/DataTables
ERROR - 2022-04-28 20:57:55 --> 404 Page Not Found: Assets/js
ERROR - 2022-04-28 20:58:02 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-04-28 20:58:45 --> Unable to delete cache file for Export
ERROR - 2022-04-28 21:00:58 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-04-28 21:01:34 --> 404 Page Not Found: Assets/DataTables
ERROR - 2022-04-28 21:01:34 --> 404 Page Not Found: Assets/js
ERROR - 2022-04-28 21:01:41 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-04-28 21:04:18 --> 404 Page Not Found: Assets/js
ERROR - 2022-04-28 21:04:39 --> 404 Page Not Found: ShiftReports/images
