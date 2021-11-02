<?php


class m0004_create_post
{
    public function up()
    {
        $db = \app\core\App::$app->db;
        $SQL = "CREATE TABLE IF NOT EXISTS `posts` (
                  `post_id` int(3) NOT NULL AUTO_INCREMENT,
                  `post_category_id` int(3) NOT NULL,
                  `post_title` varchar(255) NOT NULL,
                  `post_author` varchar(255) NOT NULL,
                  `post_date` date NOT NULL,
                  `post_image` text NOT NULL,
                  `post_content` text NOT NULL,
                  `post_tags` varchar(255) NOT NULL,
                  `post_comment_count` int(11) NOT NULL,
                  `post_status` varchar(255) NOT NULL DEFAULT 'draft',
                  `post_last_edited` date DEFAULT NULL,
                  PRIMARY KEY (`post_id`)
               ) ENGINE = INNODB;";
        $db->pdo->exec($SQL);
    }

    public function down()
    {
        $db = \app\core\App::$app->db;
        $SQL = "DROP TABLE IF EXISTS `posts`;";
        $db->pdo->exec($SQL);
    }

}