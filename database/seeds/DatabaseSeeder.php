<?php

use Illuminate\Database\Seeder;

/**
 * Seeds the database with multiple object instances and admin user.
 *
 * @category Seeder
 */
class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin_user = App\User::where('email', 'admin@example.com')->first();
        if ($admin_user === null) {
            DB::table('users')->insert(
                [
                'name' => 'Admin',
                'email' => 'admin@example.com',
                'password' => bcrypt('secret'),
                'is_admin' => 1,
                ]
            );
        }

        $users = factory(App\User::class, 100)->create();
        $posts = factory(App\Post::class, 25)->create();
        $events = factory(App\Event::class, 25)->create();
    }
}
