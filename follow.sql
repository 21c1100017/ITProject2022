CREATE TABLE `follow` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `follow_id` int(11) NOT NULL,
  `follower_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
)