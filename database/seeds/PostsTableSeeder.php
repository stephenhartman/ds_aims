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
        

        \DB::table('posts')->delete();
        
        \DB::table('posts')->insert(array (
            0 => 
            array (
                'id' => 1,
                'title' => 'Welcome Back!',
                'body' => '<h4>Welcome back to the DePaul Alumni Page!</h4>
                    <p>It is great to be here with you all.  Without a doubt this is the time to be a DePaul School Alumni.  We just launched this application!  <img src="http://cdn.tinymce.com/4/plugins/emoticons/img/smiley-smile.gif" alt="smile"></p>
                    <p>If you have any questions don\'t be afraid to ask!</p>
                    <p>Thanks,</p>
                    <p>Dr. Oliveira</p>',
                'created_at' => '2018-02-25 20:23:26',
                'updated_at' => '2018-02-25 20:23:26',
                'user_id' => \DB::table('users')->first()->id,
            ),
            1 => 
            array (
                'id' => 2,
                'title' => 'Reunion in two weeks!',
                'body' => '<h4>Hey all!</h4>
                    <p>As you may or may not know, the DePaul School reunion is coming up in two weeks.   
                    You can find information on the event <a href="../events">here.</a></p>
                    <p>We look forward to seeing everyone!</p>
                    <p>Thanks,</p>
                    <p>Mrs. Parker</p>',
                'created_at' => '2018-02-25 20:23:26',
                'updated_at' => '2018-02-25 20:23:26',
                'user_id' => \DB::table('users')->first()->id,
            ),
            2 => 
            array (
                'id' => 3,
                'title' => 'From the Development Team',
                'body' => '<h2>Greetings from the development team.</h2>
                    <h3>We are proud to present the DePaul Alumni Outreach System after 8 months of hard work. There a few features that you will want to familiarize with when you first log on.</h3>
                    <p>After you have registered your alumni account, you can view all posts by clicking on the Browse Posts link in the navigation bar at the top of the browser window. This will have posts from the Administration relating to school events, dyslexia related news, and traditional blog posts to update you and your fellow alumni about the School.</p>
                    <p>Right next to Browse Posts is the Event Calendar. Here you can view upcoming events, which are categorized by Community Events, which are gatherings for you and the community, Volunteer Events, which are opportunities for you and other to volunteer for the DePaul School and related organizations, and Reunion Events, which as you may know are Alumni gatherings for you to meet and greet with your fellow Alumni from the DePaul School.</p>
                    <p>Additionally, on the Community tab there is information for you to donate or help out the DePaul School in a few ways. You can edit your profile by clicking the your name in the top right corner. The Administrators will keep you updated by sending periodic emails about events which you have signed up for in the Event Calendar. We hope that you are able to use this website to have a greater sense of community with the school and your fellow alumni.</p>
                    <p>Cheers,</p>
                    <h3>Initech UNF</h3>',
                'created_at' => '2018-02-25 20:24:15',
                'updated_at' => '2018-02-25 20:24:15',
                'user_id' => \DB::table('users')->first()->id,
            ),
        ));
        
        
    }
}