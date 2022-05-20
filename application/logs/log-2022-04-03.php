<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2022-04-03 10:34:31 --> 404 Page Not Found: User/images
ERROR - 2022-04-03 10:35:03 --> 404 Page Not Found: Payment/images
ERROR - 2022-04-03 10:35:37 --> 404 Page Not Found: Shift/images
ERROR - 2022-04-03 10:36:40 --> 404 Page Not Found: Assets/DataTables
ERROR - 2022-04-03 10:36:41 --> 404 Page Not Found: Assets/js
ERROR - 2022-04-03 10:36:55 --> 404 Page Not Found: Assets/js
ERROR - 2022-04-03 10:37:15 --> 404 Page Not Found: Shift/images
ERROR - 2022-04-03 10:37:28 --> 404 Page Not Found: Company/images
ERROR - 2022-04-03 10:39:09 --> 404 Page Not Found: Product/images
ERROR - 2022-04-03 10:41:42 --> Severity: Notice --> Array to string conversion C:\xampp\htdocs\fms_prod\application\views\shiftReports\supplier_summary_statement.php 35
ERROR - 2022-04-03 10:41:42 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-04-03 10:42:02 --> Severity: Notice --> Undefined variable: debits C:\xampp\htdocs\fms_prod\application\models\ShiftReports_model.php 997
ERROR - 2022-04-03 10:42:02 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\fms_prod\application\models\ShiftReports_model.php 997
ERROR - 2022-04-03 10:42:02 --> Severity: Notice --> Undefined variable: credits C:\xampp\htdocs\fms_prod\application\models\ShiftReports_model.php 1002
ERROR - 2022-04-03 10:42:02 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\fms_prod\application\models\ShiftReports_model.php 1002
ERROR - 2022-04-03 10:42:05 --> Severity: Notice --> Undefined variable: debits C:\xampp\htdocs\fms_prod\application\models\ShiftReports_model.php 997
ERROR - 2022-04-03 10:42:05 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\fms_prod\application\models\ShiftReports_model.php 997
ERROR - 2022-04-03 10:42:06 --> Severity: Notice --> Undefined variable: credits C:\xampp\htdocs\fms_prod\application\models\ShiftReports_model.php 1002
ERROR - 2022-04-03 10:42:06 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\fms_prod\application\models\ShiftReports_model.php 1002
ERROR - 2022-04-03 10:42:48 --> 404 Page Not Found: Payment/images
ERROR - 2022-04-03 10:44:25 --> Query error: Unknown column 'tbl_bankings.bbf' in 'field list' - Invalid query: SELECT `tbl_banks_account_number`.`account_number_id`, `tbl_banks_account_number`.`account_number`, `tbl_bankings`.`bbf`
FROM `tbl_banks_account_number`
LEFT JOIN `tbl_bankings` ON `tbl_bankings`.`account_number_id` = `tbl_banks_account_number`.`account_number_id`
WHERE `tbl_banks_account_number`.`account_number_id` = '1'
ERROR - 2022-04-03 10:44:43 --> 404 Page Not Found: Assets/js
ERROR - 2022-04-03 10:44:43 --> 404 Page Not Found: Assets/DataTables
ERROR - 2022-04-03 10:44:50 --> 404 Page Not Found: Assets/DataTables
ERROR - 2022-04-03 10:44:50 --> 404 Page Not Found: Assets/js
ERROR - 2022-04-03 10:45:04 --> Query error: Unknown column 'tbl_bankings.bbf' in 'field list' - Invalid query: SELECT `tbl_banks_account_number`.`account_number_id`, `tbl_banks_account_number`.`account_number`, `tbl_bankings`.`bbf`
FROM `tbl_banks_account_number`
LEFT JOIN `tbl_bankings` ON `tbl_bankings`.`account_number_id` = `tbl_banks_account_number`.`account_number_id`
WHERE `tbl_banks_account_number`.`account_number_id` = '1'
ERROR - 2022-04-03 10:49:18 --> 404 Page Not Found: Assets/js
ERROR - 2022-04-03 10:49:41 --> Query error: Column 'account_number_id' cannot be null - Invalid query: INSERT INTO `tbl_bankings` (`account_number_id`, `amount`, `deposited_by`, `shift_id`, `user_id`, `debit`, `bbf`) VALUES (NULL, 0, '1', '61', '1', 1, 0)
ERROR - 2022-04-03 10:51:48 --> 404 Page Not Found: Assets/js
ERROR - 2022-04-03 10:51:48 --> 404 Page Not Found: Assets/DataTables
ERROR - 2022-04-03 10:52:30 --> 404 Page Not Found: Assets/DataTables
ERROR - 2022-04-03 10:52:30 --> 404 Page Not Found: Assets/js
ERROR - 2022-04-03 10:52:53 --> Severity: Notice --> Array to string conversion C:\xampp\htdocs\fms_prod\application\views\shiftReports\supplier_summary_statement.php 35
ERROR - 2022-04-03 10:52:53 --> 404 Page Not Found: Assets/js
ERROR - 2022-04-03 10:52:54 --> 404 Page Not Found: Assets/DataTables
ERROR - 2022-04-03 10:52:56 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-04-03 10:54:48 --> Query error: Duplicate entry '0' for key 'PRIMARY' - Invalid query: INSERT INTO `tbl_vendor_payments` (`vendor_id`, `payment_for`, `payment_method`, `amount`, `cheque_number`, `user_id`, `remarks`, `shift_id`) VALUES ('2', 'Invoice', '2', '1000', '7899999', '1', 'Payment', '61')
ERROR - 2022-04-03 10:55:01 --> 404 Page Not Found: Assets/DataTables
ERROR - 2022-04-03 10:55:01 --> 404 Page Not Found: Assets/js
ERROR - 2022-04-03 10:55:14 --> Query error: Duplicate entry '0' for key 'PRIMARY' - Invalid query: INSERT INTO `tbl_vendor_payments` (`vendor_id`, `payment_for`, `payment_method`, `amount`, `cheque_number`, `user_id`, `remarks`, `shift_id`) VALUES ('2', 'Invoice', '2', '1000', '7899999', '1', 'Payment', '61')
ERROR - 2022-04-03 10:56:39 --> 404 Page Not Found: Assets/js
ERROR - 2022-04-03 10:56:40 --> 404 Page Not Found: Assets/DataTables
ERROR - 2022-04-03 10:57:41 --> Severity: Notice --> Array to string conversion C:\xampp\htdocs\fms_prod\application\views\shiftReports\supplier_summary_statement.php 35
ERROR - 2022-04-03 10:58:31 --> Severity: Notice --> Undefined variable: debits C:\xampp\htdocs\fms_prod\application\models\ShiftReports_model.php 997
ERROR - 2022-04-03 10:58:31 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\fms_prod\application\models\ShiftReports_model.php 997
ERROR - 2022-04-03 10:58:31 --> Severity: Notice --> Undefined variable: credits C:\xampp\htdocs\fms_prod\application\models\ShiftReports_model.php 1002
ERROR - 2022-04-03 10:58:31 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\fms_prod\application\models\ShiftReports_model.php 1002
ERROR - 2022-04-03 11:00:11 --> 404 Page Not Found: Reports/images
ERROR - 2022-04-03 11:00:17 --> Query error: Unknown column 'tbl_suppliers_transactions.debit' in 'field list' - Invalid query: SELECT `tbl_suppliers_transactions`.`datetime`, `tbl_suppliers_transactions`.`debit`, `tbl_suppliers_transactions`.`details`, `tbl_suppliers_transactions`.`amount`, `tbl_suppliers_transactions`.`transaction_type`, `tbl_suppliers_transactions`.`payment_type`, `tbl_users`.`name` as `employee`, `tbl_suppliers`.`company_name` as `supplier`
FROM `tbl_suppliers_transactions`
LEFT JOIN `tbl_users` ON `tbl_users`.`user_id` = `tbl_suppliers_transactions`.`employee_id`
LEFT JOIN `tbl_suppliers` ON `tbl_suppliers`.`supplier_id` = `tbl_suppliers_transactions`.`supplier_id`
WHERE `tbl_suppliers_transactions`.`supplier_id` = '2'
ORDER BY `tbl_suppliers_transactions`.`supplier_transaction_id` ASC
ERROR - 2022-04-03 11:04:56 --> Severity: Notice --> Array to string conversion C:\xampp\htdocs\fms_prod\application\views\shiftReports\supplier_summary_statement.php 35
ERROR - 2022-04-03 11:06:00 --> Severity: Notice --> Array to string conversion C:\xampp\htdocs\fms_prod\application\views\shiftReports\supplier_summary_statement.php 35
ERROR - 2022-04-03 11:07:08 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-04-03 11:14:16 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-04-03 11:16:21 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-04-03 11:18:49 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-04-03 11:22:32 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-04-03 11:23:20 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-04-03 11:31:23 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-04-03 11:33:00 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-04-03 11:49:05 --> 404 Page Not Found: Shift/images
ERROR - 2022-04-03 11:49:20 --> Query error: Unknown column 'tbl_bankings.bbf' in 'field list' - Invalid query: SELECT `tbl_banks_account_number`.`account_number_id`, `tbl_banks_account_number`.`account_number`, `tbl_bankings`.`bbf`
FROM `tbl_banks_account_number`
LEFT JOIN `tbl_bankings` ON `tbl_bankings`.`account_number_id` = `tbl_banks_account_number`.`account_number_id`
WHERE `tbl_banks_account_number`.`account_number_id` = '200'
ERROR - 2022-04-03 11:53:03 --> 404 Page Not Found: User/images
ERROR - 2022-04-03 11:53:15 --> 404 Page Not Found: Payment/images
ERROR - 2022-04-03 11:53:48 --> Severity: Notice --> Array to string conversion C:\xampp\htdocs\fms_prod\application\views\shiftReports\employee_summary_report.php 35
ERROR - 2022-04-03 11:53:56 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-04-03 11:56:03 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-04-03 11:56:41 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-04-03 12:32:20 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-04-03 12:32:44 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-04-03 12:44:13 --> 404 Page Not Found: Product/images
ERROR - 2022-04-03 12:46:11 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-04-03 12:46:19 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-04-03 12:46:45 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-04-03 12:50:13 --> 404 Page Not Found: Product/images
