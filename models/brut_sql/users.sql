USE record;

CREATE TABLE `role`(
    `role_id` INT PRIMARY KEY AUTO_INCREMENT,
    `role_name` VARCHAR(80) NOT NULL
);

CREATE TABLE `user`(
    `user_id`       INT PRIMARY KEY AUTO_INCREMENT,
    `user_nk_name`  VARCHAR(60) NOT NULL UNIQUE,
    `user_name`     VARCHAR(80),
    `user_fst_name` VARCHAR(80),
    `user_email`    VARCHAR(80) NOT NULL UNIQUE,
    `user_pwd`      BLOB NOT NULL,
    `user_role_id`  INT NOT NULL,
    `user_confirm`  BOOLEAN,
    FOREIGN KEY (`user_role_id`) REFERENCES `role`(`role_id`)
);

INSERT INTO `role`(`role_name`) VALUE
('Administrateur'),
('Utilisateur');