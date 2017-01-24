


CREATE TABLE `trl_global_report_chart` (
	`global_report_chart_id` INT(11) NOT NULL AUTO_INCREMENT,
	`chart_type` VARCHAR(100) NULL DEFAULT NULL,
	`chart_function` VARCHAR(100) NULL DEFAULT NULL,
	PRIMARY KEY (`global_report_chart_id`)
)
COLLATE='latin1_swedish_ci'
ENGINE=InnoDB
;

CREATE TABLE `trl_global_report_config` (
	`id_global_report` INT(11) NOT NULL AUTO_INCREMENT,
	`menu_name` VARCHAR(150) NULL DEFAULT NULL,
	`title` VARCHAR(150) NULL DEFAULT NULL,
	`description` VARCHAR(250) NULL DEFAULT NULL,
	`icon` VARCHAR(200) NULL DEFAULT NULL,
	`query` TEXT NULL,
	`chart_type_id` INT(2) NULL DEFAULT NULL,
	`status` TINYINT(4) NULL DEFAULT NULL,
	PRIMARY KEY (`id_global_report`),
	INDEX `FK_trl_global_report_config_trl_global_report_chart` (`chart_type_id`),
	CONSTRAINT `FK_trl_global_report_config_trl_global_report_chart` FOREIGN KEY (`chart_type_id`) REFERENCES `trl_global_report_chart` (`global_report_chart_id`) ON UPDATE NO ACTION ON DELETE NO ACTION
)
COLLATE='latin1_swedish_ci'
ENGINE=InnoDB
;

CREATE TABLE `trl_global_report_inputs` (
	`id_global_report_inputs` INT(50) NOT NULL AUTO_INCREMENT,
	`input_name` VARCHAR(200) NULL DEFAULT NULL,
	`input_type` VARCHAR(200) NULL DEFAULT NULL,
	`title` VARCHAR(200) NULL DEFAULT NULL,
	`id_global_report` INT(100) NULL DEFAULT NULL,
	`input_state` INT(11) NULL DEFAULT NULL,
	INDEX `Índice 1` (`id_global_report_inputs`),
	INDEX `FK_trl_global_report_inputs_trl_global_report_config` (`id_global_report`)
)
COLLATE='latin1_swedish_ci'
ENGINE=InnoDB
;

INSERT INTO `trl_global_report_chart` (`chart_type`, `chart_function`) VALUES ('barras', 'barraChart');
INSERT INTO `trl_global_report_chart` (`chart_type`, `chart_function`) VALUES ('pastel', 'pastelChart');
INSERT INTO `trl_global_report_chart` (`chart_type`, `chart_function`) VALUES ('Pie with legend', 'Pie with legend');
INSERT INTO `trl_global_report_chart` (`chart_type`, `chart_function`) VALUES ('Pie with monochrome fill', 'Pie with monochrome fill');

INSERT INTO `sys_menu_admin` (`parent_id`,`name`,`title`,`url`,`description`,`icon`,`order`) 
VALUES ('18','Global Report','Global Report','{siteUrl}m/globalreport/administration','Report for T-Life','modules/transactel/globalreport/templates/base/images/icons/|icon-user.png',3);
