<?php

use yii\db\Migration;

class m160518_100153_yetki extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%yetki}}', [
            'id' => $this->integer()->notNull(),
            'username' => $this->string(255)->notNull(),
            'name' => $this->string(80)->notNull(),
            'surname' => $this->string(80)->notNull(),
            
        ], $tableOptions);


        $this->addPrimaryKey(
            'yetki_primary',
            'yetki',
            ['id','username']
        );


        // add foreign key for table `album`
        $this->addForeignKey(
            'yetki_ibfk_1',
            'yetki',
            'id',
            'album',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'yetki_ibfk_2',
            'yetki',
            'username',
            'user',
            'username',
            'CASCADE'
        );
    }

    public function down()
    {
        $this->dropTable('{{%yetki}}');
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
