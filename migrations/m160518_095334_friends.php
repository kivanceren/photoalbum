<?php

use yii\db\Migration;

class m160518_095334_friends extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%friends}}', [
            'userOne' => $this->string(255)->notNull(),
            'oFN' => $this->integer(80)->notNull(),
            'oLN' => $this->string(80)->notNull(),
            'userTwo' => $this->string(255)->notNull(),
            'tFN' => $this->string(80)->notNull(),
            'tLN' => $this->string(80)->notNull(),
            'state'=>$this->string(5)->notNull(),
        ], $tableOptions);


        $this->addPrimaryKey(
            'friends_primary',
            'friends',
            ['userOne','userTwo']
        );


        // add foreign key for table `album`
        $this->addForeignKey(
            'friends_ibfk_1',
            'friends',
            'userOne',
            'user',
            'username',
            'CASCADE'
        );

        $this->addForeignKey(
            'friends_ibfk_2',
            'friends',
            'userTwo',
            'user',
            'username',
            'CASCADE'
        );
    }

    public function down()
    {
        $this->dropTable('{{%friends}}');
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
