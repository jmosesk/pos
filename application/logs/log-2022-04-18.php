<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2022-04-18 07:24:54 --> 404 Page Not Found: User/images
ERROR - 2022-04-18 07:25:32 --> 404 Page Not Found: Payment/images
ERROR - 2022-04-18 07:25:46 --> 404 Page Not Found: Shift/images
ERROR - 2022-04-18 07:26:01 --> 404 Page Not Found: Shift/images
ERROR - 2022-04-18 07:27:57 --> Severity: error --> Exception: Invalid body indentation level (expecting an indentation level of at least 13) C:\xampp\htdocs\fms_prod\application\controllers\Export.php 46
ERROR - 2022-04-18 07:32:32 --> Unable to delete cache file for Export
ERROR - 2022-04-18 07:32:36 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\xampp\htdocs\fms_prod\application\controllers\Export.php:76) C:\xampp\htdocs\fms_prod\application\libraries\tcpdf\tcpdf.php 7678
ERROR - 2022-04-18 07:34:54 --> Unable to delete cache file for Export
ERROR - 2022-04-18 07:34:57 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\xampp\htdocs\fms_prod\application\controllers\Export.php:99) C:\xampp\htdocs\fms_prod\application\libraries\tcpdf\tcpdf.php 7678
ERROR - 2022-04-18 07:56:10 --> Unable to delete cache file for Export
ERROR - 2022-04-18 07:56:19 --> Severity: error --> Exception: Call to undefined method PHPMailer\PHPMailer\PHPMailer::clear() C:\xampp\htdocs\fms_prod\application\controllers\Export.php 101
ERROR - 2022-04-18 07:56:19 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\xampp\htdocs\fms_prod\application\controllers\Export.php:76) C:\xampp\htdocs\fms_prod\system\core\Common.php 570
ERROR - 2022-04-18 16:36:41 --> 404 Page Not Found: User/images
ERROR - 2022-04-18 16:36:57 --> 404 Page Not Found: Payment/images
ERROR - 2022-04-18 16:37:09 --> 404 Page Not Found: Payment/images
ERROR - 2022-04-18 16:37:52 --> 404 Page Not Found: Shift/images
ERROR - 2022-04-18 16:37:59 --> Query error: Unknown column 'images' in 'field list' - Invalid query: SELECT SUM(IF((tbl_bankings.shift_id = images), (tbl_bankings.amount), 0)) as total_bankings
FROM `tbl_bankings`
WHERE `tbl_bankings`.`shift_id` = 'images'
GROUP BY `shift_id`
ERROR - 2022-04-18 16:40:21 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-04-18 16:49:46 --> Query error: Unknown column 'images' in 'field list' - Invalid query: SELECT SUM(IF((tbl_bankings.shift_id = images), (tbl_bankings.amount), 0)) as total_bankings
FROM `tbl_bankings`
WHERE `tbl_bankings`.`shift_id` = 'images'
GROUP BY `shift_id`
