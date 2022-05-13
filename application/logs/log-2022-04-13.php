<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2022-04-13 05:31:47 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-04-13 05:36:12 --> 404 Page Not Found: Assets/DataTables
ERROR - 2022-04-13 05:36:12 --> 404 Page Not Found: Assets/js
ERROR - 2022-04-13 05:36:55 --> 404 Page Not Found: Assets/js
ERROR - 2022-04-13 05:42:55 --> 404 Page Not Found: Assets/js
ERROR - 2022-04-13 05:42:55 --> 404 Page Not Found: Assets/DataTables
ERROR - 2022-04-13 05:43:21 --> 404 Page Not Found: Assets/js
ERROR - 2022-04-13 05:43:21 --> 404 Page Not Found: Assets/DataTables
ERROR - 2022-04-13 06:02:17 --> Severity: Notice --> Undefined property: stdClass::$shift_name_id C:\xampp\htdocs\fms_prod\application\controllers\ShiftReports.php 449
ERROR - 2022-04-13 06:02:34 --> Severity: Notice --> Undefined property: stdClass::$shift_name_id C:\xampp\htdocs\fms_prod\application\controllers\ShiftReports.php 449
ERROR - 2022-04-13 06:11:40 --> Query error: Column 'shift_name_id' in field list is ambiguous - Invalid query: SELECT `tbl_shifts`.`shift_id`, `shift_name_id`, `tbl_shifts`.`shift_date`, `tbl_shifts`.`close_user_id`, `tbl_shifts`.`status`, `tbl_shifts_names`.`name` as `shift_name`, `tbl_shifts`.`assigned`, `tbl_shifts`.`var_ltrs_status`, `reading`
FROM `tbl_shifts`
LEFT JOIN `tbl_shifts_names` ON `tbl_shifts_names`.`shift_name_id` = `tbl_shifts`.`shift_name_id`
WHERE `tbl_shifts`.`status` = 0
ORDER BY `shift_id` ASC
ERROR - 2022-04-13 06:14:37 --> Severity: Warning --> var_dump() expects at least 1 parameter, 0 given C:\xampp\htdocs\fms_prod\application\controllers\ShiftReports.php 454
ERROR - 2022-04-13 06:44:01 --> Severity: Notice --> Undefined variable: active C:\xampp\htdocs\fms_prod\application\controllers\Payment.php 53
ERROR - 2022-04-13 06:44:49 --> Severity: Notice --> Undefined variable: active C:\xampp\htdocs\fms_prod\application\controllers\Payment.php 53
ERROR - 2022-04-13 07:08:03 --> Unable to delete cache file for Export/CreatePdf
ERROR - 2022-04-13 07:09:22 --> Unable to delete cache file for Export/CreatePdf
ERROR - 2022-04-13 07:12:36 --> Unable to delete cache file for Export/CreatePdf
ERROR - 2022-04-13 08:39:10 --> Query error: Unknown column 'tbl_credit_notes.user_id' in 'on clause' - Invalid query: SELECT `tbl_debit_notes`.*, `tbl_suppliers`.`company_name` as `vendor`, `tbl_customers`.`company_name` as `customer`, `tbl_users`.`name` as `employee`, `tbl_shifts`.`shift_date` as `date`
FROM `tbl_debit_notes`
LEFT JOIN `tbl_users` ON `tbl_users`.`user_id` = `tbl_credit_notes`.`user_id`
LEFT JOIN `tbl_suppliers` ON `tbl_suppliers`.`supplier_id` = `tbl_debit_notes`.`supplier_id`
LEFT JOIN `tbl_customers` ON `tbl_customers`.`customer_id` = `tbl_debit_notes`.`customer_id`
LEFT JOIN `tbl_shifts` ON `tbl_shifts`.`shift_id` = `tbl_debit_notes`.`shift_id`
ORDER BY `note_id` DESC
ERROR - 2022-04-13 08:42:20 --> Unable to delete cache file for Export/CreatePdf
ERROR - 2022-04-13 08:47:54 --> Query error: Unknown column 'tbl_suppliers_transactions.debit' in 'field list' - Invalid query: SELECT `tbl_suppliers_transactions`.`datetime`, `tbl_suppliers_transactions`.`debit`, `tbl_suppliers_transactions`.`details`, `tbl_suppliers_transactions`.`amount`, `tbl_suppliers_transactions`.`transaction_type`, `tbl_suppliers_transactions`.`payment_type`, `tbl_users`.`name` as `employee`, `tbl_suppliers`.`company_name` as `supplier`
FROM `tbl_suppliers_transactions`
LEFT JOIN `tbl_users` ON `tbl_users`.`user_id` = `tbl_suppliers_transactions`.`employee_id`
LEFT JOIN `tbl_suppliers` ON `tbl_suppliers`.`supplier_id` = `tbl_suppliers_transactions`.`supplier_id`
WHERE `tbl_suppliers_transactions`.`supplier_id` = '2'
ORDER BY `tbl_suppliers_transactions`.`supplier_transaction_id` ASC
