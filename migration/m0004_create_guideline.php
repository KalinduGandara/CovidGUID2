<?php


class m0004_create_guideline
{
    public function up()
    {
        $db = \app\core\App::$app->db;
        $SQL = "CREATE TABLE IF NOT EXISTS `guidelines` (
                  `guideline_id` int(3) NOT NULL AUTO_INCREMENT,
                  `guideline_title` varchar(255) NOT NULL,
                  `guideline_description` text NOT NULL,
                  `guideline_author` varchar(255) NOT NULL,
                  `guideline_date` date NOT NULL,
                  `guideline_image` text NOT NULL,
                  `guideline_tags` varchar(255) NOT NULL,
                  `guideline_status` varchar(255) NOT NULL DEFAULT 'draft',
                  `guideline_last_edited` date DEFAULT NULL,
                  PRIMARY KEY (`guideline_id`)
               ) ENGINE = INNODB;";
        $db->pdo->exec($SQL);
    }

    public function down()
    {
        $db = \app\core\App::$app->db;
        $SQL = "DROP TABLE IF EXISTS `guidelines`;";
        $db->pdo->exec($SQL);
    }
}
