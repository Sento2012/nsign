<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Class m181003_090112_main
 */
class m181003_090112_main extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('dishes', [
            'id' => $this->primaryKey(),
            'name' => $this->text()->notNull()
        ]);

        $this->createTable('ingredients', [
            'id' => $this->primaryKey(),
            'name' => $this->text()->notNull(),
            'hidden' => $this->integer()
        ]);

        $this->createTable('dish_has_ingredient', [
            'id' => $this->primaryKey(),
            'dish_id' => $this->integer()->notNull(),
            'ingredient_id' => $this->integer()->notNull()
        ]);

        $this->addForeignKey(
            'fk-dishes-dhi',
            'dish_has_ingredient',
            'dish_id',
            'dishes',
            'id',
            'CASCADE'
        );

        $this->createIndex(
            'idx-dishes-dhi',
            'dish_has_ingredient',
            'dish_id'
        );

        $this->addForeignKey(
            'fk-ingredient-dhi',
            'dish_has_ingredient',
            'ingredient_id',
            'ingredients',
            'id',
            'CASCADE'
        );

        $this->createIndex(
            'idx-ingredient-dhi',
            'dish_has_ingredient',
            'ingredient_id'
        );

        $this->createTable('users', [
            'id' => $this->primaryKey(),
            'username' => $this->string()->notNull(),
            'password' => $this->string()->notNull()
        ]);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m181003_090112_main cannot be reverted.\n";

        $this->dropTable('dishes');
        $this->dropTable('ingredients');
        $this->dropForeignKey(
            'fk-dishes-dhi',
            'dish_has_ingredient'
        );

        // drops index for column `author_id`
        $this->dropIndex(
            'idx-dishes-dhi',
            'dish_has_ingredient'
        );

        // drops foreign key for table `category`
        $this->dropForeignKey(
            'fk-ingredient-dhi',
            'dish_has_ingredient'
        );

        // drops index for column `category_id`
        $this->dropIndex(
            'idx-ingredient-dhi',
            'dish_has_ingredient'
        );
        $this->dropTable('dish_has_ingredient');
        $this->dropTable('users');

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181003_090112_main cannot be reverted.\n";

        return false;
    }
    */
}
