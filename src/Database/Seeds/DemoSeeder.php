<?php
/**
 * @author Basic App Dev Team
 * @license MIT
 */
namespace BasicApp\AdminAuthShield\Database\Seeds;

use BasicApp\Core\Seeder;
use CodeIgniter\Shield\Entities\User;

class DemoSeeder extends Seeder
{
    public function run()
    {
        $users = auth()->getProvider();
        
        $user = new User([
            'username' => 'admin',
            'email'    => 'admin@example.org',
            'password' => 'admin',
        ]);

        $users->save($user);

        $user = $users->findById($users->getInsertID());

        $users->addToDefaultGroup($user);
        
        $user->addGroup('admin');
        
        $user->activate();
    }
}