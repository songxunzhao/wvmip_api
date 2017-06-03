DROP PROCEDURE IF EXISTS fx_blocked_users_delete_by_source;
CREATE PROCEDURE fx_blocked_users_delete_by_source(
    IN p_user_id                                BIGINT
,   IN p_source_type                            INT
)
BEGIN
  DELETE FROM `blocked_users`
  WHERE
    `user_id` = p_user_id
  AND
    `source_type` = p_source_type;
END
