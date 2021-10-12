<?php


class m0002_add_password_column{

    public function up()
    {
        $db = \app\core\App::$app->db;
        $SQL = "ALTER TABLE users ADD password VARCHAR(255) NOT NULL;";
        $db->pdo->exec($SQL);
    }

    public function down()
    {
        $db = \app\core\App::$app->db;
        $SQL = "ALTER TABLE users DROP password VARCHAR(255) NOT NULL;";
        $db->pdo->exec($SQL);
    }
}