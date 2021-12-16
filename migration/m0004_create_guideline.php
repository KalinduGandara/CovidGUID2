<?php


class m0004_create_guideline
{
    public function up()
    {
        $db = \app\core\App::$app->db;
        $SQL = "CREATE TABLE IF NOT EXISTS `guidelines` (
                  `guid_id` int(3) NOT NULL AUTO_INCREMENT,
                  `cat_id` INT NOT NULL ,
                  `subcategory_id` int(255) NOT NULL,
                  `guidline` text NOT NULL,
                  `guid_status` TEXT NOT NULL ,
                  PRIMARY KEY (`guid_id`)
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
