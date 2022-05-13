<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2022-04-10 05:29:14 --> 404 Page Not Found: Assets/js
ERROR - 2022-04-10 05:29:15 --> 404 Page Not Found: Assets/DataTables
ERROR - 2022-04-10 05:29:15 --> 404 Page Not Found: Payment/images
ERROR - 2022-04-10 05:30:37 --> 404 Page Not Found: Assets/js
ERROR - 2022-04-10 05:30:37 --> 404 Page Not Found: Assets/DataTables
ERROR - 2022-04-10 06:25:28 --> 404 Page Not Found: Assets/js
ERROR - 2022-04-10 06:25:28 --> 404 Page Not Found: Assets/DataTables
ERROR - 2022-04-10 06:26:12 --> Query error: Column 'user_id' cannot be null - Invalid query: INSERT INTO `tbl_vendor_payments` (`vendor_id`, `payment_for`, `payment_method`, `amount`, `cheque_number`, `user_id`, `remarks`, `shift_id`, `note_id`) VALUES ('1', 'Invoice', 10, '2000000', NULL, NULL, 'Bank Transfer Okay', '215', 4)
ERROR - 2022-04-10 06:26:53 --> Query error: Column 'user_id' cannot be null - Invalid query: INSERT INTO `tbl_vendor_payments` (`vendor_id`, `payment_for`, `payment_method`, `amount`, `cheque_number`, `user_id`, `remarks`, `shift_id`, `note_id`) VALUES ('1', 'Invoice', 10, '2000000', NULL, NULL, 'Bank Transfer Okay', '215', 5)
ERROR - 2022-04-10 06:29:02 --> Severity: Notice --> Undefined property: Payment::$ShiftReports_model C:\xampp\htdocs\fms_prod\application\controllers\Payment.php 575
ERROR - 2022-04-10 06:29:02 --> Severity: error --> Exception: Call to a member function opening_balance_today() on null C:\xampp\htdocs\fms_prod\application\controllers\Payment.php 575
ERROR - 2022-04-10 06:29:19 --> Severity: Notice --> Undefined property: Payment::$ShiftReports_model C:\xampp\htdocs\fms_prod\application\controllers\Payment.php 575
ERROR - 2022-04-10 06:29:19 --> Severity: error --> Exception: Call to a member function opening_balance_today() on null C:\xampp\htdocs\fms_prod\application\controllers\Payment.php 575
ERROR - 2022-04-10 11:17:11 --> 404 Page Not Found: User/images
ERROR - 2022-04-10 11:17:26 --> 404 Page Not Found: Assets/js
ERROR - 2022-04-10 11:17:27 --> 404 Page Not Found: Assets/DataTables
ERROR - 2022-04-10 11:17:27 --> 404 Page Not Found: Payment/images
ERROR - 2022-04-10 11:17:56 --> 404 Page Not Found: Assets/js
ERROR - 2022-04-10 11:17:56 --> 404 Page Not Found: Assets/DataTables
ERROR - 2022-04-10 11:18:30 --> Severity: Notice --> Undefined property: Payment::$ShiftReports_model C:\xampp\htdocs\fms_prod\application\controllers\Payment.php 578
ERROR - 2022-04-10 11:18:30 --> Severity: error --> Exception: Call to a member function opening_balance_today() on null C:\xampp\htdocs\fms_prod\application\controllers\Payment.php 578
ERROR - 2022-04-10 11:25:14 --> 404 Page Not Found: Assets/DataTables
ERROR - 2022-04-10 11:25:14 --> 404 Page Not Found: Assets/js
ERROR - 2022-04-10 11:25:35 --> 404 Page Not Found: Assets/js
ERROR - 2022-04-10 11:25:36 --> 404 Page Not Found: Assets/DataTables
ERROR - 2022-04-10 11:26:05 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-04-10 11:27:52 --> 404 Page Not Found: Reports/images
ERROR - 2022-04-10 11:32:20 --> Query error: Unknown column 'tbl_suppliers_transactions.debit' in 'field list' - Invalid query: SELECT `tbl_suppliers_transactions`.`datetime`, `tbl_suppliers_transactions`.`debit`, `tbl_suppliers_transactions`.`details`, `tbl_suppliers_transactions`.`amount`, `tbl_suppliers_transactions`.`transaction_type`, `tbl_suppliers_transactions`.`payment_type`, `tbl_users`.`name` as `employee`, `tbl_suppliers`.`company_name` as `supplier`
FROM `tbl_suppliers_transactions`
LEFT JOIN `tbl_users` ON `tbl_users`.`user_id` = `tbl_suppliers_transactions`.`employee_id`
LEFT JOIN `tbl_suppliers` ON `tbl_suppliers`.`supplier_id` = `tbl_suppliers_transactions`.`supplier_id`
WHERE `tbl_suppliers_transactions`.`supplier_id` = '1'
ORDER BY `tbl_suppliers_transactions`.`supplier_transaction_id` ASC
ERROR - 2022-04-10 11:58:29 --> Severity: Notice --> Undefined variable: alloc C:\xampp\htdocs\fms_prod\application\views\shiftReports\customerStatement.php 94
ERROR - 2022-04-10 11:58:29 --> Severity: Notice --> Trying to get property 'shift_name' of non-object C:\xampp\htdocs\fms_prod\application\views\shiftReports\customerStatement.php 94
ERROR - 2022-04-10 11:58:29 --> Severity: Notice --> Undefined variable: alloc C:\xampp\htdocs\fms_prod\application\views\shiftReports\customerStatement.php 94
ERROR - 2022-04-10 11:58:29 --> Severity: Notice --> Trying to get property 'shift_date' of non-object C:\xampp\htdocs\fms_prod\application\views\shiftReports\customerStatement.php 94
ERROR - 2022-04-10 11:58:29 --> Severity: Notice --> Undefined variable: alloc C:\xampp\htdocs\fms_prod\application\views\shiftReports\customerStatement.php 94
ERROR - 2022-04-10 11:58:29 --> Severity: Notice --> Trying to get property 'operator' of non-object C:\xampp\htdocs\fms_prod\application\views\shiftReports\customerStatement.php 94
ERROR - 2022-04-10 13:25:21 --> 404 Page Not Found: Company/images
ERROR - 2022-04-10 13:48:57 --> Unable to delete cache file for Export/CreatePdf
ERROR - 2022-04-10 13:52:57 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-04-10 13:55:25 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-04-10 14:00:20 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-04-10 14:02:39 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-04-10 14:06:43 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-04-10 14:08:43 --> 404 Page Not Found: Shift/images
ERROR - 2022-04-10 14:14:54 --> 404 Page Not Found: Product/images
ERROR - 2022-04-10 14:15:14 --> 404 Page Not Found: Shift/images
ERROR - 2022-04-10 14:35:48 --> 404 Page Not Found: Images/favicon.png
ERROR - 2022-04-10 14:35:56 --> 404 Page Not Found: Admin/images
ERROR - 2022-04-10 14:41:51 --> Unable to delete cache file for Export/CreatePdf
ERROR - 2022-04-10 15:09:04 --> Severity: Notice --> Trying to get property 'shift_id' of non-object C:\xampp\htdocs\fms_prod\application\controllers\Shift.php 412
ERROR - 2022-04-10 15:09:05 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near '), ((tbl_close_shift_lubes.opening_quantity + tbl_close_shift_lubes.receipts ...' at line 1 - Invalid query: SELECT `tbl_assigned_centres`.`centre_id`, SUM(IF((tbl_close_shift_lubes.shift_id = ), ((tbl_close_shift_lubes.opening_quantity + tbl_close_shift_lubes.receipts - tbl_close_shift_lubes.closing_quantity) * tbl_close_shift_lubes.price), 0)) as total_sales_amt_lubes
FROM `tbl_assigned_centres`
LEFT JOIN `tbl_close_shift_lubes` ON `tbl_close_shift_lubes`.`centre_id` = `tbl_assigned_centres`.`centre_id`
WHERE `tbl_assigned_centres`.`shift_id` IS NULL
GROUP BY `tbl_assigned_centres`.`employee_id`
ERROR - 2022-04-10 15:09:12 --> Severity: Notice --> Trying to get property 'shift_id' of non-object C:\xampp\htdocs\fms_prod\application\controllers\Shift.php 412
ERROR - 2022-04-10 15:09:12 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near '), ((tbl_close_shift_lubes.opening_quantity + tbl_close_shift_lubes.receipts ...' at line 1 - Invalid query: SELECT `tbl_assigned_centres`.`centre_id`, SUM(IF((tbl_close_shift_lubes.shift_id = ), ((tbl_close_shift_lubes.opening_quantity + tbl_close_shift_lubes.receipts - tbl_close_shift_lubes.closing_quantity) * tbl_close_shift_lubes.price), 0)) as total_sales_amt_lubes
FROM `tbl_assigned_centres`
LEFT JOIN `tbl_close_shift_lubes` ON `tbl_close_shift_lubes`.`centre_id` = `tbl_assigned_centres`.`centre_id`
WHERE `tbl_assigned_centres`.`shift_id` IS NULL
GROUP BY `tbl_assigned_centres`.`employee_id`
ERROR - 2022-04-10 15:09:21 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\fms_prod\application\views\reports\customerReport.php 30
ERROR - 2022-04-10 15:10:51 --> 404 Page Not Found: Reports/images
ERROR - 2022-04-10 15:11:00 --> 404 Page Not Found: Shift/images
ERROR - 2022-04-10 15:12:18 --> 404 Page Not Found: Shift/images
ERROR - 2022-04-10 21:26:32 --> Unable to delete cache file for Export
ERROR - 2022-04-10 21:26:34 --> Severity: Notice --> Undefined variable: count C:\xampp\htdocs\fms_prod\application\controllers\Export.php 89
ERROR - 2022-04-10 21:26:35 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\xampp\htdocs\fms_prod\application\controllers\Export.php:76) C:\xampp\htdocs\fms_prod\application\libraries\tcpdf\tcpdf.php 7678
