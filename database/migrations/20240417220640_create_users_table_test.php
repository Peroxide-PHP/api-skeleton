<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;
use Phinx\Util\Literal;

final class CreateUsersTableTest extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change(): void
    {
        $table = $this->table('users', ['id' => false, 'primary_key' => 'id']);
        $table
            ->addColumn('id', 'uuid', [
                // postgres 13+
                'default' => Literal::from('gen_random_uuid()')

                // old postgres ext: uuid-ossp
                // 'default' => Literal::from('uuid_generate_v4()')
            ])
            ->addColumn('email', 'string', ['limit' => 130])
            ->addColumn('created_at', 'datetime', ['default' => 'CURRENT_TIMESTAMP'])
            ->addColumn('updated_at', 'datetime', ['null' => true])
            ->create();
    }
}
