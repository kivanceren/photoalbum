<?php

use yii\db\Migration;

class m160518_092811_photos extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%photos}}', [
            'id' => $this->primaryKey(),
            'album_id' => $this->integer()->notNull(),
            'filename' => $this->string(255)->notNull(),
            'caption' => $this->string(80)->notNull(),
            'alt_text' => $this->string(80)->notNull(),
        ], $tableOptions);

        // add foreign key for table `album`
        $this->addForeignKey(
            'photos_ibfk_1',
            'photos',
            'album_id',
            'album',
            'id',
            'CASCADE'
        );
    }

    public function down()
    {
        $this->dropTable('{{%photos}}');
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
