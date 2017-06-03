DROP PROCEDURE IF EXISTS fx_blocked_users_list_by_blocked_user;
CREATE PROCEDURE fx_blocked_users_list_by_blocked_user(
    IN p_blocked_user_id                        BIGINT
,   IN p_source_type                            INT
)
BEGIN
  SELECT *
  FROM `blocked_users`
    JOIN `users`
    ON `blocked_users`.`user_id` = `users`.`id`
  WHERE
    `blocked_user_id` = p_blocked_user_id
  AND
    `source_type` = p_source_type;

END
