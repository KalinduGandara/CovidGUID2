<?php

class m0003_create_categories
{
    public function up()
    {
        $db = \app\core\App::$app->db;
        $SQL = "CREATE TABLE IF NOT EXISTS `categories` (
                `cat_id` int(3) NOT NULL AUTO_INCREMENT,
                `cat_title` varchar(255) NOT NULL,
                `cat_status` int(1) NOT NULL,
                `category_description` varchar(255) NOT NULL, 
                PRIMARY KEY (`cat_id`)
                ) ENGINE = INNODB;";
        $db->pdo->exec($SQL);
    }

    public function down()
    {
        $db = \app\core\App::$app->db;
        $SQL = "DROP TABLE IF EXISTS `categories`;";
        $db->pdo->exec($SQL);
    }
}
