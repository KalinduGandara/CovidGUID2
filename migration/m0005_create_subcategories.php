<?php


class m0005_create_subcategories
{
    public function up()
    {
        $db = \app\core\App::$app->db;
        $SQL = "CREATE TABLE IF NOT EXISTS `sub_categories` (
                  `sub_category_id` int(3) NOT NULL AUTO_INCREMENT,
                  `cat_id` INT NOT NULL ,
                  `sub_category_name` TEXT NOT NULL ,
                  PRIMARY KEY (`sub_category_id`)
               ) ENGINE = INNODB;";
        $db->pdo->exec($SQL);
    }

    public function down()
    {
        $db = \app\core\App::$app->db;
        $SQL = "DROP TABLE IF EXISTS `sub_categories`;";
        $db->pdo->exec($SQL);
    }
}
