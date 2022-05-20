<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2022-04-08 11:15:41 --> 404 Page Not Found: User/images
ERROR - 2022-04-08 11:16:02 --> 404 Page Not Found: Payment/images
ERROR - 2022-04-08 11:16:09 --> 404 Page Not Found: Shift/images
ERROR - 2022-04-08 11:16:22 --> Unable to delete cache file for Export
ERROR - 2022-04-08 11:16:22 --> Severity: Notice --> Undefined variable: count C:\xampp\htdocs\fms_prod\application\controllers\Export.php 89
ERROR - 2022-04-08 11:16:26 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\xampp\htdocs\fms_prod\application\controllers\Export.php:76) C:\xampp\htdocs\fms_prod\application\libraries\tcpdf\tcpdf.php 7678
ERROR - 2022-04-08 11:18:15 --> Unable to delete cache file for Export
ERROR - 2022-04-08 11:18:16 --> Severity: Notice --> Undefined variable: count C:\xampp\htdocs\fms_prod\application\controllers\Export.php 89
ERROR - 2022-04-08 11:18:18 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\xampp\htdocs\fms_prod\application\controllers\Export.php:76) C:\xampp\htdocs\fms_prod\application\libraries\tcpdf\tcpdf.php 7678
ERROR - 2022-04-08 11:28:34 --> Unable to delete cache file for Export
ERROR - 2022-04-08 11:28:34 --> Severity: Notice --> Undefined variable: count C:\xampp\htdocs\fms_prod\application\controllers\Export.php 89
ERROR - 2022-04-08 11:28:35 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\xampp\htdocs\fms_prod\application\controllers\Export.php:76) C:\xampp\htdocs\fms_prod\application\libraries\tcpdf\tcpdf.php 7678
ERROR - 2022-04-08 11:31:55 --> Unable to delete cache file for Export
ERROR - 2022-04-08 11:33:03 --> Unable to delete cache file for Export
ERROR - 2022-04-08 11:33:10 --> Unable to delete cache file for Export
ERROR - 2022-04-08 11:33:12 --> Severity: Notice --> Undefined variable: count C:\xampp\htdocs\fms_prod\application\controllers\Export.php 89
ERROR - 2022-04-08 11:33:14 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\xampp\htdocs\fms_prod\application\controllers\Export.php:76) C:\xampp\htdocs\fms_prod\application\libraries\tcpdf\tcpdf.php 7678
ERROR - 2022-04-08 11:35:36 --> Unable to delete cache file for Export
ERROR - 2022-04-08 11:35:37 --> Severity: Notice --> Undefined variable: count C:\xampp\htdocs\fms_prod\application\controllers\Export.php 88
ERROR - 2022-04-08 11:35:41 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\xampp\htdocs\fms_prod\application\controllers\Export.php:75) C:\xampp\htdocs\fms_prod\application\libraries\tcpdf\tcpdf.php 7678
ERROR - 2022-04-08 11:44:32 --> Unable to delete cache file for Export
ERROR - 2022-04-08 11:44:34 --> Severity: Notice --> Undefined variable: count C:\xampp\htdocs\fms_prod\application\controllers\Export.php 88
ERROR - 2022-04-08 11:44:36 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\xampp\htdocs\fms_prod\application\controllers\Export.php:75) C:\xampp\htdocs\fms_prod\application\libraries\tcpdf\tcpdf.php 7678
ERROR - 2022-04-08 11:46:28 --> Query error: Table 'ola.tbl_employee_payments' doesn't exist - Invalid query: SELECT `tbl_close_shift_debit_user`.`employee_id` as `user_id`, `tbl_employee_payments`.`centre_id`, SUM(IF((tbl_close_shift_debit_user.shift_id = 213 AND tbl_close_shift_debit_user.transaction_type = 2 AND payment_type = 1), ((tbl_close_shift_debit_user.figure)), 0)) as customer_payment_amt
FROM `tbl_close_shift_debit_user`
JOIN `tbl_employee_payments` ON `tbl_employee_payments`.`employee_transactions_id` = `tbl_close_shift_debit_user`.`adjust_amt_id`
WHERE `tbl_close_shift_debit_user`.`shift_id` = '213'
GROUP BY `tbl_employee_payments`.`centre_id`
ERROR - 2022-04-08 11:46:29 --> 404 Page Not Found: User/images
ERROR - 2022-04-08 11:47:10 --> 404 Page Not Found: Payment/images
ERROR - 2022-04-08 11:47:15 --> 404 Page Not Found: Shift/images
ERROR - 2022-04-08 11:47:17 --> Query error: Unknown column 'tbl_close_shift_debit_user.employee_id' in 'field list' - Invalid query: SELECT `tbl_close_shift_debit_user`.`employee_id` as `user_id`, SUM(IF((tbl_close_shift_debit_user.shift_id = 233 AND tbl_close_shift_debit_user.transaction_type = 2 AND payment_type = 1), ((tbl_close_shift_debit_user.figure)), 0)) as employee_payment_amt
FROM `tbl_close_shift_debit_user`
WHERE `tbl_close_shift_debit_user`.`shift_id` = '233'
GROUP BY `tbl_close_shift_debit_user`.`employee_id`
ERROR - 2022-04-08 12:04:36 --> Severity: Notice --> Undefined variable: close_shift_drops_id C:\xampp\htdocs\fms_prod\application\views\shift\drops.php 353
ERROR - 2022-04-08 12:04:36 --> Severity: Notice --> Undefined variable: close_shift_drops_id C:\xampp\htdocs\fms_prod\application\views\shift\drops.php 355
ERROR - 2022-04-08 12:04:36 --> Severity: Notice --> Undefined variable: close_shift_drops_id C:\xampp\htdocs\fms_prod\application\views\shift\drops.php 358
ERROR - 2022-04-08 12:04:37 --> 404 Page Not Found: Shift/images
ERROR - 2022-04-08 12:12:03 --> 404 Page Not Found: Shift/images
ERROR - 2022-04-08 12:13:56 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-04-08 12:14:01 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-04-08 12:15:04 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-04-08 12:15:30 --> 404 Page Not Found: Payment/images
ERROR - 2022-04-08 12:18:56 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-04-08 12:24:23 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-04-08 12:34:48 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-04-08 12:35:29 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-04-08 12:35:59 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-04-08 12:36:54 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-04-08 12:37:30 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-04-08 12:38:22 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-04-08 12:38:43 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-04-08 13:15:15 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-04-08 13:16:28 --> Unable to delete cache file for Export
ERROR - 2022-04-08 14:11:22 --> 404 Page Not Found: Product/images
ERROR - 2022-04-08 14:11:26 --> Query error: Unknown column 'tbl_sales.user_id' in 'on clause' - Invalid query: SELECT `tbl_users`.`name`, `tbl_shifts`.`shift_date`, `tbl_items`.`item_name`, `tbl_close_shift_job_card`.`datetime`, `tbl_close_shift_job_card`.`close_shift_id`, `tbl_close_shift_job_card`.`quantity`, `tbl_close_shift_job_card`.`unit_price`
FROM `tbl_close_shift_job_card`
LEFT JOIN `tbl_users` ON `tbl_users`.`user_id` = `tbl_sales`.`user_id`
LEFT JOIN `tbl_shifts` ON `tbl_shifts`.`shift_id` = `tbl_close_shift_job_card`.`shift_id`
LEFT JOIN `tbl_items` ON `tbl_items`.`item_id` = `tbl_close_shift_job_card`.`item_id`
WHERE (tbl_shifts.shift_id) = '233'
ORDER BY `close_shift_id` DESC
ERROR - 2022-04-08 14:13:42 --> 404 Page Not Found: Payment/images
ERROR - 2022-04-08 14:13:51 --> 404 Page Not Found: Product/images
ERROR - 2022-04-08 15:43:56 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-04-08 15:44:00 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-04-08 15:44:06 --> Unable to delete cache file for Export
ERROR - 2022-04-08 15:45:42 --> Unable to delete cache file for Export
ERROR - 2022-04-08 15:53:32 --> 404 Page Not Found: Shift/images
ERROR - 2022-04-08 15:53:55 --> 404 Page Not Found: Company/images
ERROR - 2022-04-08 15:57:37 --> 404 Page Not Found: Email_Report/233
