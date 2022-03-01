work


TRUNCATE `invoice`;
TRUNCATE `payment`;
TRUNCATE `reservation`;
TRUNCATE `transactions`;

UPDATE `vehicle_info` SET `vehicle_status` = 'active' WHERE `vehicle_info`.`vehicle_id` = 4;
ALTER TABLE `reservation` ADD `reservation_inspection_fee_tax` INT NOT NULL AFTER `reservation_inspection_fee`

UPDATE reservation SET reservation_sts = CASE WHEN reservation_expiry_date < '2021-08-10' THEN '0'ELSE '1' END


UPDATE `vehicle_info` SET `vehicle_status` = 'active' WHERE `vehicle_info`.`vehicle_id` = 4