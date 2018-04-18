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
        $this->call(RoleTableSeeder::class);

        /*
         * Development seeds
         *
         * User seeder will use the roles above created.
         * $this->call(UserTableSeeder::class);
         * $events = factory(App\Event::class, 15)->create();
         * $posts = factory(App\Post::class, 23)->create();
         * Call inverse posts seeds
         * $this->call(PostsTableSeeder::class);
         */
    }
}
