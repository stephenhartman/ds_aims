<?php

use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        \DB::table('posts')->insert(array (
            0 => 
            array (
                'id' => 24,
                'title' => 'Welcome Back!',
                'body' => '<h4>Welcome back to the DePaul Alumni Page!</h4>
                    <p>It is great to be here with you all.  Without a doubt this is the time to be a DePaul Schoo Alumni.  We just launched this application!  <img src="http://cdn.tinymce.com/4/plugins/emoticons/img/smiley-smile.gif" alt="smile"></p>
                    <p>If you have any questions don\'t be afraid to ask!</p>
                    <p>Thanks,</p>
                    <p>Dr. Oliveira</p>',
                'image' => NULL,
                'alumni' => 'Admin',
                'created_at' => new Carbon('now'),
                'updated_at' => new Carbon('now'),
                'user_id' => 1,
            ),
            1 => 
            array (
                'id' => 25,
                'title' => 'Reunion in two weeks!',
                'body' => '<h4>Hey all!</h4>
                    <p>As you may or may not know, the DePaul School reunion is coming up in two weeks.   You can find information on the event <a href="../events/11">here.</a></p>
                    <p>We look forward to seeing everyone!</p>
                    <p>Thanks,</p>
                    <p>Mrs. Parker</p>',
                'image' => NULL,
                'alumni' => 'Admin',
                'created_at' => new Carbon('now'),
                'updated_at' => new Carbon('now'),
                'user_id' => 1,
            ),
        ));
    }
}