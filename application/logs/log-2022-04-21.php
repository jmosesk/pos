<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2022-04-21 08:44:39 --> 404 Page Not Found: User/images
ERROR - 2022-04-21 08:44:56 --> 404 Page Not Found: Payment/images
ERROR - 2022-04-21 08:45:05 --> 404 Page Not Found: Shift/images
ERROR - 2022-04-21 08:45:19 --> 404 Page Not Found: Shift/images
ERROR - 2022-04-21 08:51:37 --> 404 Page Not Found: Shift/images
ERROR - 2022-04-21 08:51:41 --> Query error: Unknown column 'images' in 'field list' - Invalid query: SELECT SUM(IF((tbl_bankings.shift_id = images), (tbl_bankings.amount), 0)) as total_bankings
FROM `tbl_bankings`
WHERE `tbl_bankings`.`shift_id` = 'images'
GROUP BY `shift_id`
ERROR - 2022-04-21 08:51:50 --> 404 Page Not Found: Shift/images
ERROR - 2022-04-21 08:51:53 --> 404 Page Not Found: Shift/images
ERROR - 2022-04-21 08:52:17 --> 404 Page Not Found: Shift/images
ERROR - 2022-04-21 08:52:25 --> 404 Page Not Found: Shift/images
ERROR - 2022-04-21 08:55:00 --> 404 Page Not Found: Shift/images
ERROR - 2022-04-21 08:59:31 --> 404 Page Not Found: Shift/images
ERROR - 2022-04-21 09:08:06 --> 404 Page Not Found: Shift/images
ERROR - 2022-04-21 09:14:40 --> 404 Page Not Found: Shift/images
ERROR - 2022-04-21 09:28:05 --> 404 Page Not Found: Shift/images
ERROR - 2022-04-21 09:28:37 --> 404 Page Not Found: Shift/images
ERROR - 2022-04-21 09:28:56 --> 404 Page Not Found: Payment/images
ERROR - 2022-04-21 09:29:20 --> 404 Page Not Found: Shift/images
ERROR - 2022-04-21 09:29:22 --> 404 Page Not Found: Shift/images
ERROR - 2022-04-21 09:29:50 --> 404 Page Not Found: Shift/images
ERROR - 2022-04-21 09:30:54 --> 404 Page Not Found: Shift/images
ERROR - 2022-04-21 09:30:56 --> 404 Page Not Found: Shift/images
ERROR - 2022-04-21 10:02:36 --> 404 Page Not Found: Payment/images
ERROR - 2022-04-21 10:03:21 --> 404 Page Not Found: Shift/images
ERROR - 2022-04-21 10:03:51 --> 404 Page Not Found: Shift/images
ERROR - 2022-04-21 10:35:11 --> 404 Page Not Found: Shift/images
ERROR - 2022-04-21 10:45:49 --> Severity: Notice --> Undefined offset: 0 C:\xampp\htdocs\fms_prod\application\views\shift\viewAllocations.php 1
ERROR - 2022-04-21 10:45:50 --> Severity: Notice --> Trying to get property 'shift_name' of non-object C:\xampp\htdocs\fms_prod\application\views\shift\viewAllocations.php 14
ERROR - 2022-04-21 10:45:50 --> Severity: Notice --> Trying to get property 'shift_date' of non-object C:\xampp\htdocs\fms_prod\application\views\shift\viewAllocations.php 14
ERROR - 2022-04-21 10:51:00 --> 404 Page Not Found: Shift/images
ERROR - 2022-04-21 10:52:01 --> Severity: Notice --> Undefined offset: 0 C:\xampp\htdocs\fms_prod\application\views\shift\viewAllocations.php 1
ERROR - 2022-04-21 10:52:01 --> Severity: Notice --> Trying to get property 'shift_name' of non-object C:\xampp\htdocs\fms_prod\application\views\shift\viewAllocations.php 14
ERROR - 2022-04-21 10:52:01 --> Severity: Notice --> Trying to get property 'shift_date' of non-object C:\xampp\htdocs\fms_prod\application\views\shift\viewAllocations.php 14
ERROR - 2022-04-21 10:52:01 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'tbl_close_shift_drops INNER JOIN tbl_close_shift_debit_user ON tbl_close_shif...' at line 1 - Invalid query: DELETE tbl_close_shift_drops,tbl_close_shift_debit_user,tbl_close_shift_adjust_amtFROM tbl_close_shift_drops INNER JOIN tbl_close_shift_debit_user ON tbl_close_shift_debit_user.shift_id = tbl_close_shift_drops.shift_id AND tbl_close_shift_debit_user.figure = 0INNER JOIN tbl_close_shift_adjust_amt ON tbl_close_shift_adjust_amt.shift_id = tbl_close_shift_drops.shift_id  WHERE tbl_close_shift_drops.shift_id = 239 
ERROR - 2022-04-21 10:52:23 --> 404 Page Not Found: Assets/DataTables
ERROR - 2022-04-21 10:52:23 --> 404 Page Not Found: Assets/js
ERROR - 2022-04-21 10:52:29 --> 404 Page Not Found: Assets/js
ERROR - 2022-04-21 10:52:29 --> 404 Page Not Found: Assets/DataTables
ERROR - 2022-04-21 10:53:22 --> Severity: Notice --> Undefined offset: 0 C:\xampp\htdocs\fms_prod\application\views\shift\viewAllocations.php 1
ERROR - 2022-04-21 10:53:23 --> Severity: Notice --> Trying to get property 'shift_name' of non-object C:\xampp\htdocs\fms_prod\application\views\shift\viewAllocations.php 14
ERROR - 2022-04-21 10:53:23 --> Severity: Notice --> Trying to get property 'shift_date' of non-object C:\xampp\htdocs\fms_prod\application\views\shift\viewAllocations.php 14
ERROR - 2022-04-21 10:53:23 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'tbl_close_shift_drops INNER JOIN tbl_close_shift_debit_user ON tbl_close_shif...' at line 1 - Invalid query: DELETE tbl_close_shift_drops,tbl_close_shift_debit_user,tbl_close_shift_adjust_amtFROM tbl_close_shift_drops INNER JOIN tbl_close_shift_debit_user ON tbl_close_shift_debit_user.shift_id = tbl_close_shift_drops.shift_id AND tbl_close_shift_debit_user.figure = 0INNER JOIN tbl_close_shift_adjust_amt ON tbl_close_shift_adjust_amt.shift_id = tbl_close_shift_drops.shift_id  WHERE tbl_close_shift_drops.shift_id = 239 
ERROR - 2022-04-21 10:56:09 --> 404 Page Not Found: Assets/js
ERROR - 2022-04-21 10:56:09 --> 404 Page Not Found: Assets/DataTables
ERROR - 2022-04-21 10:56:20 --> Severity: Notice --> Undefined offset: 0 C:\xampp\htdocs\fms_prod\application\views\shift\viewAllocations.php 1
ERROR - 2022-04-21 10:56:20 --> Severity: Notice --> Trying to get property 'shift_name' of non-object C:\xampp\htdocs\fms_prod\application\views\shift\viewAllocations.php 14
ERROR - 2022-04-21 10:56:20 --> Severity: Notice --> Trying to get property 'shift_date' of non-object C:\xampp\htdocs\fms_prod\application\views\shift\viewAllocations.php 14
ERROR - 2022-04-21 10:56:23 --> 404 Page Not Found: Assets/js
ERROR - 2022-04-21 10:56:23 --> 404 Page Not Found: Assets/DataTables
ERROR - 2022-04-21 10:56:26 --> 404 Page Not Found: Assets/js
ERROR - 2022-04-21 10:56:28 --> 404 Page Not Found: Assets/js
ERROR - 2022-04-21 10:56:28 --> 404 Page Not Found: Assets/DataTables
ERROR - 2022-04-21 10:58:42 --> Severity: Notice --> Undefined offset: 0 C:\xampp\htdocs\fms_prod\application\views\shift\viewAllocations.php 1
ERROR - 2022-04-21 10:58:42 --> Severity: Notice --> Trying to get property 'shift_name' of non-object C:\xampp\htdocs\fms_prod\application\views\shift\viewAllocations.php 14
ERROR - 2022-04-21 10:58:42 --> Severity: Notice --> Trying to get property 'shift_date' of non-object C:\xampp\htdocs\fms_prod\application\views\shift\viewAllocations.php 14
ERROR - 2022-04-21 10:58:51 --> Severity: Notice --> Undefined variable: close_shift_drops_id C:\xampp\htdocs\fms_prod\application\views\shift\drops.php 381
ERROR - 2022-04-21 11:17:14 --> Severity: Notice --> Undefined offset: 0 C:\xampp\htdocs\fms_prod\application\views\shift\viewAllocations.php 1
ERROR - 2022-04-21 11:17:32 --> 404 Page Not Found: Assets/DataTables
ERROR - 2022-04-21 11:17:32 --> 404 Page Not Found: Assets/js
ERROR - 2022-04-21 11:17:40 --> Severity: Notice --> Trying to get property 'shift_name' of non-object C:\xampp\htdocs\fms_prod\application\views\shift\viewAllocations.php 14
ERROR - 2022-04-21 11:17:40 --> Severity: Notice --> Trying to get property 'shift_date' of non-object C:\xampp\htdocs\fms_prod\application\views\shift\viewAllocations.php 14
ERROR - 2022-04-21 11:17:43 --> 404 Page Not Found: Assets/js
ERROR - 2022-04-21 11:17:43 --> 404 Page Not Found: Assets/DataTables
ERROR - 2022-04-21 11:18:26 --> Severity: Notice --> Undefined offset: 0 C:\xampp\htdocs\fms_prod\application\views\shift\viewAllocations.php 1
ERROR - 2022-04-21 11:18:26 --> Severity: Notice --> Trying to get property 'shift_name' of non-object C:\xampp\htdocs\fms_prod\application\views\shift\viewAllocations.php 14
ERROR - 2022-04-21 11:18:26 --> Severity: Notice --> Trying to get property 'shift_date' of non-object C:\xampp\htdocs\fms_prod\application\views\shift\viewAllocations.php 14
ERROR - 2022-04-21 11:18:28 --> 404 Page Not Found: Assets/js
ERROR - 2022-04-21 11:18:29 --> 404 Page Not Found: Assets/DataTables
ERROR - 2022-04-21 11:18:32 --> 404 Page Not Found: Assets/js
ERROR - 2022-04-21 11:18:32 --> 404 Page Not Found: Assets/DataTables
ERROR - 2022-04-21 11:19:05 --> 404 Page Not Found: Shift/images
ERROR - 2022-04-21 11:20:13 --> Severity: Notice --> Undefined offset: 0 C:\xampp\htdocs\fms_prod\application\views\shift\viewAllocations.php 1
ERROR - 2022-04-21 11:20:14 --> Severity: Notice --> Trying to get property 'shift_name' of non-object C:\xampp\htdocs\fms_prod\application\views\shift\viewAllocations.php 14
ERROR - 2022-04-21 11:20:14 --> Severity: Notice --> Trying to get property 'shift_date' of non-object C:\xampp\htdocs\fms_prod\application\views\shift\viewAllocations.php 14
ERROR - 2022-04-21 11:22:27 --> Severity: Notice --> Undefined offset: 0 C:\xampp\htdocs\fms_prod\application\views\shift\viewAllocations.php 1
ERROR - 2022-04-21 11:22:27 --> Severity: Notice --> Trying to get property 'shift_name' of non-object C:\xampp\htdocs\fms_prod\application\views\shift\viewAllocations.php 14
ERROR - 2022-04-21 11:22:27 --> Severity: Notice --> Trying to get property 'shift_date' of non-object C:\xampp\htdocs\fms_prod\application\views\shift\viewAllocations.php 14
ERROR - 2022-04-21 12:05:58 --> Unable to delete cache file for Export
ERROR - 2022-04-21 12:14:02 --> Unable to delete cache file for Export
ERROR - 2022-04-21 12:14:25 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\xampp\htdocs\fms_prod\application\controllers\Export.php:75) C:\xampp\htdocs\fms_prod\system\helpers\url_helper.php 561
ERROR - 2022-04-21 12:22:20 --> Unable to delete cache file for Export
ERROR - 2022-04-21 12:22:41 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\xampp\htdocs\fms_prod\application\controllers\Export.php:75) C:\xampp\htdocs\fms_prod\system\helpers\url_helper.php 561
ERROR - 2022-04-21 12:23:19 --> Unable to delete cache file for Export
ERROR - 2022-04-21 12:23:20 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\xampp\htdocs\fms_prod\application\controllers\Export.php:75) C:\xampp\htdocs\fms_prod\system\helpers\url_helper.php 561
ERROR - 2022-04-21 12:24:22 --> Unable to delete cache file for Export
ERROR - 2022-04-21 12:24:23 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\xampp\htdocs\fms_prod\application\controllers\Export.php:75) C:\xampp\htdocs\fms_prod\system\helpers\url_helper.php 561
ERROR - 2022-04-21 12:33:48 --> Unable to delete cache file for Export
ERROR - 2022-04-21 12:33:50 --> Severity: Warning --> Cannot modify header information - headers already sent C:\xampp\htdocs\fms_prod\system\helpers\url_helper.php 561
ERROR - 2022-04-21 12:35:16 --> Unable to delete cache file for Export
ERROR - 2022-04-21 12:35:17 --> Severity: Warning --> Cannot modify header information - headers already sent C:\xampp\htdocs\fms_prod\system\helpers\url_helper.php 561
ERROR - 2022-04-21 12:45:34 --> 404 Page Not Found: Shift/images
ERROR - 2022-04-21 12:45:39 --> Unable to delete cache file for Export
ERROR - 2022-04-21 12:45:41 --> Severity: Warning --> Cannot modify header information - headers already sent C:\xampp\htdocs\fms_prod\system\helpers\url_helper.php 561
ERROR - 2022-04-21 12:47:34 --> 404 Page Not Found: Shift/images
ERROR - 2022-04-21 12:47:39 --> Unable to delete cache file for Export
ERROR - 2022-04-21 12:47:40 --> 404 Page Not Found: Shift/images
ERROR - 2022-04-21 12:51:06 --> 404 Page Not Found: Shift/images
ERROR - 2022-04-21 12:51:08 --> Unable to delete cache file for Export
ERROR - 2022-04-21 12:51:10 --> Severity: Warning --> Cannot modify header information - headers already sent C:\xampp\htdocs\fms_prod\system\helpers\url_helper.php 561
ERROR - 2022-04-21 12:51:35 --> Unable to delete cache file for Export
ERROR - 2022-04-21 12:51:50 --> Unable to delete cache file for Export
