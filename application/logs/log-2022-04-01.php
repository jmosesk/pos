<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2022-04-01 14:52:55 --> Severity: error --> Exception: Call to a member function result() on null C:\xampp\htdocs\fms_prod\application\views\shift\drops.php 64
ERROR - 2022-04-01 14:52:57 --> Severity: error --> Exception: Call to a member function result() on null C:\xampp\htdocs\fms_prod\application\views\shift\drops.php 64
ERROR - 2022-04-01 14:54:05 --> 404 Page Not Found: Images/favicon.png
ERROR - 2022-04-01 14:57:20 --> 404 Page Not Found: User/userPayment
ERROR - 2022-04-01 14:57:28 --> 404 Page Not Found: User/userPayment
ERROR - 2022-04-01 15:00:08 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-04-01 15:00:17 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-04-01 15:03:42 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-04-01 15:04:00 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-04-01 15:04:41 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-04-01 15:04:55 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-04-01 15:05:47 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-04-01 15:06:10 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-04-01 15:06:46 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-04-01 15:07:45 --> 404 Page Not Found: Shift/images
ERROR - 2022-04-01 15:09:02 --> 404 Page Not Found: Shift/images
ERROR - 2022-04-01 15:11:43 --> 404 Page Not Found: Shift/images
ERROR - 2022-04-01 15:11:49 --> Query error: Unknown column 'images' in 'field list' - Invalid query: SELECT `tbl_assigned_centres`.`employee_id` as `user_id`, SUM(IF((tbl_close_shift_products.shift_id = images), ((tbl_close_shift_products.opening_quantity + tbl_close_shift_products.receipts - tbl_close_shift_products.closing_quantity) * tbl_close_shift_products.price), 0)) as total_sales_amount_lpg
FROM `tbl_assigned_centres`
LEFT JOIN `tbl_close_shift_products` ON `tbl_close_shift_products`.`centre_id` = `tbl_assigned_centres`.`centre_id`
JOIN `tbl_centres` ON `tbl_centres`.`centre_id` = `tbl_assigned_centres`.`centre_id`
JOIN `tbl_users` ON `tbl_users`.`user_id` = `tbl_assigned_centres`.`employee_id`
WHERE `tbl_assigned_centres`.`shift_id` = 'images'
GROUP BY `tbl_assigned_centres`.`employee_id`
ERROR - 2022-04-01 15:24:14 --> Severity: Notice --> Undefined variable: emp_amt C:\xampp\htdocs\fms_prod\application\views\shift\cash_reconcilliation_sheet.php 228
ERROR - 2022-04-01 15:24:14 --> Severity: Notice --> Undefined variable: bankings C:\xampp\htdocs\fms_prod\application\views\shift\cash_reconcilliation_sheet.php 348
ERROR - 2022-04-01 15:25:49 --> Severity: Notice --> Undefined property: Shift::$ShiftReports_model C:\xampp\htdocs\fms_prod\application\controllers\Shift.php 1026
ERROR - 2022-04-01 15:25:49 --> Severity: error --> Exception: Call to a member function TotalBankings() on null C:\xampp\htdocs\fms_prod\application\controllers\Shift.php 1026
ERROR - 2022-04-01 15:26:44 --> Severity: error --> Exception: Call to undefined method Shift_model::SumRecievingsEmpPayments() C:\xampp\htdocs\fms_prod\application\controllers\Shift.php 1033
ERROR - 2022-04-01 15:29:48 --> 404 Page Not Found: Shift/images
ERROR - 2022-04-01 15:32:08 --> Severity: Notice --> Undefined variable: emp_amt C:\xampp\htdocs\fms_prod\application\views\shift\drops.php 284
ERROR - 2022-04-01 15:35:16 --> 404 Page Not Found: Shift/images
ERROR - 2022-04-01 15:36:59 --> 404 Page Not Found: Shift/images
ERROR - 2022-04-01 15:49:01 --> Severity: error --> Exception: Call to undefined method Product_model::get_list_employeePayments() C:\xampp\htdocs\fms_prod\application\controllers\Payment.php 390
ERROR - 2022-04-01 15:50:33 --> Severity: error --> Exception: Call to undefined method Company_model::get_list_employee_station() C:\xampp\htdocs\fms_prod\application\controllers\Payment.php 391
ERROR - 2022-04-01 15:52:26 --> 404 Page Not Found: Payment/images
ERROR - 2022-04-01 15:53:11 --> Severity: error --> Exception: Call to undefined method Product_model::saveEmployeeTransactions() C:\xampp\htdocs\fms_prod\application\controllers\Payment.php 549
ERROR - 2022-04-01 15:53:38 --> 404 Page Not Found: Assets/DataTables
ERROR - 2022-04-01 15:53:38 --> 404 Page Not Found: Assets/js
ERROR - 2022-04-01 15:53:51 --> Severity: error --> Exception: Call to undefined method Product_model::saveEmployeeTransactions() C:\xampp\htdocs\fms_prod\application\controllers\Payment.php 549
ERROR - 2022-04-01 15:55:09 --> Severity: error --> Exception: Call to undefined method Product_model::saveEmployeeTransactions() C:\xampp\htdocs\fms_prod\application\controllers\Payment.php 549
ERROR - 2022-04-01 15:56:13 --> 404 Page Not Found: Assets/js
ERROR - 2022-04-01 15:56:15 --> 404 Page Not Found: Assets/DataTables
ERROR - 2022-04-01 15:56:15 --> 404 Page Not Found: Payment/images
ERROR - 2022-04-01 15:56:33 --> 404 Page Not Found: Shift/images
ERROR - 2022-04-01 16:03:34 --> 404 Page Not Found: ShiftReports/employeeSummaryReport
ERROR - 2022-04-01 16:07:31 --> Severity: Notice --> Array to string conversion C:\xampp\htdocs\fms_prod\application\views\shiftReports\employee_summary_report.php 35
ERROR - 2022-04-01 16:07:31 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-04-01 16:07:38 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-04-01 16:07:38 --> Severity: error --> Exception: Call to undefined method ShiftReports_model::employeeSummaryReport() C:\xampp\htdocs\fms_prod\application\controllers\ShiftReports.php 58
ERROR - 2022-04-01 16:07:43 --> Severity: Notice --> Array to string conversion C:\xampp\htdocs\fms_prod\application\views\shiftReports\employee_summary_report.php 35
ERROR - 2022-04-01 16:07:47 --> 404 Page Not Found: Assets/DataTables
ERROR - 2022-04-01 16:07:48 --> 404 Page Not Found: Assets/js
ERROR - 2022-04-01 16:07:54 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-04-01 16:07:55 --> Severity: error --> Exception: Call to undefined method ShiftReports_model::employeeSummaryReport() C:\xampp\htdocs\fms_prod\application\controllers\ShiftReports.php 58
ERROR - 2022-04-01 16:09:44 --> Severity: Notice --> Array to string conversion C:\xampp\htdocs\fms_prod\application\views\shiftReports\employee_summary_report.php 35
ERROR - 2022-04-01 16:09:44 --> 404 Page Not Found: Assets/js
ERROR - 2022-04-01 16:09:45 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-04-01 16:09:52 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-04-01 16:10:52 --> Unable to delete cache file for Export
ERROR - 2022-04-01 16:14:20 --> Severity: Notice --> Array to string conversion C:\xampp\htdocs\fms_prod\application\views\shiftReports\employee_summary_report.php 35
ERROR - 2022-04-01 16:14:20 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-04-01 16:15:22 --> 404 Page Not Found: Shift/images
ERROR - 2022-04-01 16:18:34 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-04-01 16:18:39 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-04-01 19:19:53 --> 404 Page Not Found: User/images
ERROR - 2022-04-01 19:20:19 --> 404 Page Not Found: Payment/images
ERROR - 2022-04-01 19:20:30 --> 404 Page Not Found: Reports/images
ERROR - 2022-04-01 19:25:11 --> 404 Page Not Found: Reports/images
ERROR - 2022-04-01 19:43:13 --> 404 Page Not Found: Reports/images
ERROR - 2022-04-01 19:43:24 --> Severity: Warning --> DOMDocument::loadHTML(): Unexpected end tag : h5 in Entity, line: 1 C:\xampp\htdocs\fms_prod\application\third_party\PHPExcel-1.8\Classes\PHPExcel\Reader\HTML.php 495
ERROR - 2022-04-01 19:48:29 --> Severity: Warning --> DOMDocument::loadHTML(): Unexpected end tag : h5 in Entity, line: 1 C:\xampp\htdocs\fms_prod\application\third_party\PHPExcel-1.8\Classes\PHPExcel\Reader\HTML.php 495
ERROR - 2022-04-01 19:50:54 --> 404 Page Not Found: Reports/images
ERROR - 2022-04-01 19:51:00 --> Severity: Warning --> DOMDocument::loadHTML(): Unexpected end tag : h5 in Entity, line: 1 C:\xampp\htdocs\fms_prod\application\third_party\PHPExcel-1.8\Classes\PHPExcel\Reader\HTML.php 495
ERROR - 2022-04-01 19:53:54 --> 404 Page Not Found: Reports/images
ERROR - 2022-04-01 19:58:46 --> 404 Page Not Found: Reports/images
