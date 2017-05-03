-- view job general company

SELECT
`job`.*,
`order`.`id` AS `user_id`,
`order`.`partner_id` AS `partner_id`,
`offer`.`id` AS `offer_id`,
`offer`.`order` AS `offer_order`,
`order`.`id` AS `order_id`,
`order`.`status` AS `order_status` 
FROM 
`job` 
LEFT JOIN `company` ON `job`.`company_id` = `company`.`id` 
JOIN `user` ON `user`.`id` = `company`.`user_id` AND `company`.`status` = 1
LEFT JOIN `order` ON `order`.`user_id` = `user`.`id` AND `order`.`partner_id` IS NULL
JOIN `offer` ON `offer`.`id` = `order`.`offer_id` 
WHERE 
`job`.`open_job_date` BETWEEN `order`.`offer_at` AND `order`.`offer_expired_at` AND `job`.`status_payment` != 0 ORDER BY `offer`.`order`


SELECT
`job`.*,
`order`.`user_id` AS `user_id`,
`order`.`partner_id` AS `partner_id`,
`offer`.`id` AS `offer_id`,
`offer`.`order` AS `offer_order`,
`order`.`id` AS `order_id`,
`order`.`status` AS `order_status` 
FROM 
`job` 
LEFT JOIN `company` ON `job`.`company_id` = `company`.`id` 
JOIN `partner` ON `partner`.`id` = `company`.`partner_id` AND `company`.`status` = 1
LEFT JOIN `order` ON `order`.`partner_id` = `partner`.`id` AND `order`.`partner_id` IS NULL
JOIN `offer` ON `offer`.`id` = `order`.`offer_id` 
WHERE 
`job`.`open_job_date` BETWEEN `order`.`offer_at` AND `order`.`offer_expired_at` AND `job`.`status_payment` != 0 ORDER BY `offer`.`order`


-- job free
SELECT
`job`.*,
`company`.`user_id` AS `user_id`,
`company`.`partner_id` AS `partner_id`,
NULL AS `offer_id`,
'99' AS `offer_order`,
NULL AS `order_id`,
NULL AS `order_status`
FROM 
`job` 
LEFT JOIN `company` ON `job`.`company_id` = `company`.`id` 
LEFT JOIN `user` ON `user`.`id` = `company`.`user_id` AND `company`.`status` = 1
WHERE 
`job`.`open_job_date` <= NOW() AND `job`.`close_job_date` >= NOW() AND `job`.`status_payment` = 5
UNION
-- job partner
SELECT
`job`.*,
`order`.`user_id` AS `user_id`,
`order`.`partner_id` AS `partner_id`,
`offer`.`id` AS `offer_id`,
`offer`.`order` AS `offer_order`,
`order`.`id` AS `order_id`,
`order`.`status` AS `order_status` 
FROM 
`job` 
JOIN `company` ON `job`.`company_id` = `company`.`id` 
LEFT JOIN `partner` ON `partner`.`id` = `company`.`partner_id` AND `company`.`status` = 1
LEFT JOIN `order` ON `order`.`partner_id` = `partner`.`id` AND `order`.`user_id` IS NULL
JOIN `offer` ON `offer`.`id` = `order`.`offer_id` 
WHERE 
`job`.`open_job_date` <= NOW() AND `job`.`close_job_date` >= NOW() AND 
`job`.`open_job_date` BETWEEN `order`.`offer_at` AND `order`.`offer_expired_at` AND `job`.`status_payment` = 1 AND `order`.`status` = 10
UNION
-- job general company
SELECT
`job`.*,
`order`.`user_id` AS `user_id`,
`order`.`partner_id` AS `partner_id`,
`offer`.`id` AS `offer_id`,
`offer`.`order` AS `offer_order`,
`order`.`id` AS `order_id`,
`order`.`status` AS `order_status` 
FROM 
`job` 
JOIN `company` ON `job`.`company_id` = `company`.`id` 
LEFT JOIN `user` ON `user`.`id` = `company`.`user_id` AND `company`.`status` = 1
LEFT JOIN `order` ON `order`.`user_id` = `user`.`id` AND `order`.`partner_id` IS NULL
JOIN `offer` ON `offer`.`id` = `order`.`offer_id` 
WHERE 
`job`.`open_job_date` <= NOW() AND `job`.`close_job_date` >= NOW() AND 
`job`.`open_job_date` BETWEEN `order`.`offer_at` AND `order`.`offer_expired_at` AND `job`.`status_payment` = 1 AND `order`.`status` = 10
ORDER BY `offer_order`, `open_job_date` DESC
