<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        $event_id = DB::table('events')->first()->id;
        \DB::table('posts')->insert(array (
            0 =>
            array (
                'title' => 'Welcome Back!',
                'body' => '<h4>Welcome back to the DePaul Alumni Page!</h4>
                    <p>It is great to be here with you all.  Without a doubt this is the time to be a DePaul School Alumni.  We just launched this application!  <img src="http://cdn.tinymce.com/4/plugins/emoticons/img/smiley-smile.gif" alt="smile"></p>
                    <p>If you have any questions don\'t be afraid to ask!</p>
                    <p>Thanks,</p>
                    <p>Dr. Oliveira</p>',
                'created_at' => new Carbon('now'),
                'updated_at' => new Carbon('now'),
                'user_id' => DB::table('users')->first()->id,
            ),
            1 =>
            array (
                'title' => 'Reunion in two weeks!',
                'body' => '<h4>Hey all!</h4>
                    <p>As you may or may not know, the DePaul School reunion is coming up in two weeks.   
                    You can find information on the event <a href="../events/' . $event_id . '">here.</a></p>
                    <p>We look forward to seeing everyone!</p>
                    <p>Thanks,</p>
                    <p>Mrs. Parker</p>',
                'created_at' => new Carbon('now'),
                'updated_at' => new Carbon('now'),
                'user_id' => DB::table('users')->first()->id,
            ),
        ));
    }
}