DROP PROCEDURE IF EXISTS fx_users_create;
CREATE PROCEDURE fx_users_create(
    IN p_user_id                                BIGINT
,   IN p_username                               VARCHAR(256)
,   IN p_fullname                               VARCHAR(256)
,   IN p_profile_picture                        VARCHAR(2048)
)
BEGIN
  INSERT INTO `users`
  (
    `id`,
    `username`,
    `fullname`,
    `profile_picture`
  )
  VALUES (
    p_user_id,
    p_username,
    p_fullname,
    p_profile_picture
  )
  ON DUPLICATE KEY UPDATE
    `username` = p_username,
    `fullname` = p_fullname,
    `profile_picture` = p_profile_picture;

  SELECT * FROM `users` WHERE `id` = p_user_id;
END
