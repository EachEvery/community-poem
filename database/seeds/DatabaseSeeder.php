<?php

use Illuminate\Database\Seeder;
use CommunityPoem\Space;
use CommunityPoem\Response;
use CommunityPoem\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        $space = factory(Space::class)->create([
            'name' => 'Test Space',
            'typeform_id' => 'XLOUWc',
            'admin_emails' => 'nate@natehobi.com,nate.hobi@gmail.com',
        ]);

        factory(Response::class, 10)->create([
            'space_id' => $space->id,
        ]);

        User::create([
            'name' => 'Nate Hobi',
            'email' => 'hobi@eachevery.com',
            'password' => Hash::make('password'),
        ]);
    }
}
