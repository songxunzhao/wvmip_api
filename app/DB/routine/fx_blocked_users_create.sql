DROP PROCEDURE IF EXISTS fx_blocked_users_create;
CREATE PROCEDURE fx_blocked_users_create(
    IN p_user_id                                BIGINT
,   IN p_blocked_user_id                        BIGINT
,   IN p_source_type                            INT
)
BEGIN
  DECLARE newid VARCHAR(64);

  SET newid = UUID();
  INSERT INTO `blocked_users`
  (
    `id`,
    `user_id`,
    `blocked_user_id`,
    `source_type`
  )
  VALUES (
    newid,
    p_user_id,
    p_blocked_user_id,
    p_source_type
  );

  SELECT * FROM `blocked_users` WHERE `id` = newid;
END
