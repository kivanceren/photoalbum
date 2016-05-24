<?php

use yii\db\Migration;

class m160518_092252_album extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%album}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(80)->notNull(),
            'tags' => $this->string(80)->notNull(),
            'owner_id' => $this->integer()->notNull(),
            'shareable' => $this->integer(),
        ], $tableOptions);

        $this->addForeignKey(
            'album_ibfk_1',
            'album',
            'owner_id',
            'user',
            'id',
            'CASCADE'
        );
    }

    public function down()
    {
        $this->dropTable('{{%album}}');
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
