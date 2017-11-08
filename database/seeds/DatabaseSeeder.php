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
        // Role comes before User seeder here.
        $this->call(RoleTableSeeder::class);
        // User seeder will use the roles above created.
        $this->call(UserTableSeeder::class);

        $posts = factory(App\Post::class, 25)->create();
        $events = factory(App\Event::class, 25)->create();
    }
}
