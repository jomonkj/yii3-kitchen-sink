<?php

use yii\db\Migration;

/**
 * Handles the creation of table `package`.
 */
class m190503_135137_create_package_table extends Migration
{
    private $packages;

    public function __construct(\yii\base\Application $app)
    {
        $this->packages = $app->params['packages'];
    }

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('package', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'travis' => $this->string()->notNull(),
            'section' => $this->string()->notNull(),
        ]);

        $this->batchInsert('package', ['name', 'travis', 'section'], $this->packages);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('package');
    }
}
