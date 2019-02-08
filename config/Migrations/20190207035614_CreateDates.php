<?php
use Migrations\AbstractMigration;

class CreateDates extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     * @return void
     */
    public function change()
    {
        $table = $this->table('dates');
        $table->addColumn('date_from', 'date', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('date_to', 'date', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('difference', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => false,
        ]);
        $table->addColumn('created', 'datetime', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('modified', 'datetime', [
            'default' => null,
            'null' => false,
        ]);
        $table->create();
    }
}
