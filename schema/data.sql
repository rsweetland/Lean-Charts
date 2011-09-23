INSERT INTO `events` (`event_id`, `name`, `weight`, `send_alert`) VALUES
(1, 'first time fut use: user record created', 1, 0),
(2, 'fut scheduled', 2, 0);

INSERT INTO `logs` (`log_id`, `event_id`, `user_id`, `object_id`, `object_type`, `num_value`, `data`, `create_date`) VALUES
(1, 1, 1, NULL, NULL, NULL, NULL, '2011-09-23 15:35:13'),
(2, 2, 1, NULL, NULL, NULL, NULL, '2011-09-23 15:35:13');