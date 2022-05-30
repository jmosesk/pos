<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2022-05-28 08:22:52 --> 404 Page Not Found: User/images
ERROR - 2022-05-28 08:23:03 --> 404 Page Not Found: Payment/images
ERROR - 2022-05-28 08:23:13 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-28 10:14:04 --> Query error: Table 'posmain.tbl_close_shift_drops' doesn't exist - Invalid query: SELECT `tbl_close_shift_drops`.`user_id`, SUM(tbl_close_shift_drops.excess) as excess, `users_drop`.`name` as `cashier`
FROM `tbl_close_shift_drops`
LEFT JOIN `tbl_users` `users_drop` ON `users_drop`.`user_id` = `tbl_close_shift_drops`.`user_id`
WHERE `tbl_close_shift_drops`.`shift_id` = '308'
AND `excess` != 0
GROUP BY `tbl_close_shift_drops`.`user_id`
ERROR - 2022-05-28 10:14:16 --> Query error: Unknown column 'quantity' in 'field list' - Invalid query: INSERT INTO `rpt_sales` (`amount`, `category_id`, `centre_id`, `close_shift_id`, `employee_id`, `item_id`, `measurement_value`, `price`, `quantity`, `shift_id`, `vat_rate`) VALUES (0,0,'8','2','55','68','1',NULL,'3450','180','0.16'), (0,0,'8','3','53','68','1',NULL,'400','184','0.16'), (0,0,'8','4','56','68','1',NULL,'3420','194','0.16')
ERROR - 2022-05-28 10:14:55 --> 404 Page Not Found: ShiftReports/images
ERROR - 2022-05-28 10:20:01 --> 404 Page Not Found: ShiftReports/images
