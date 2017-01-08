<?php

use App\Friend;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);

        $faker = Faker::create('pl_PL');

        /* =============== VARIABLES =============== */

        $number_of_users = 20;
        $password = '123456';
        $max_post_per_user = 10;
        $max_per_comments = 4;

        /* =============== USERS =============== */
        DB::table('roles')->insert([
            'id' => 1,
            'type' => 'admin',
            'created_at' => date('Y-m-d G:i:s'),
        ]);
        DB::table('roles')->insert([
            'id' => 2,
            'type' => 'moderator',
            'created_at' => date('Y-m-d G:i:s'),
        ]);
        DB::table('roles')->insert([
            'id' => 3,
            'type' => 'user',
            'created_at' => date('Y-m-d G:i:s'),
        ]);

        for ($user_id = 1; $user_id <= $number_of_users; $user_id++) {

            if ($user_id === 1) {

                DB::table('users')->insert([
                    'role_id' => 1,
                    'name' => 'Mariusz Franciszczak',
                    'email' => 'mariusz@designmf.pl',
                    'sex' => 'm',
                    'password' => bcrypt($password),
                    'avatar' => 'avatar1.jpg',
                    'created_at' => $faker->dateTimeThisYear($max = 'now'),

                ]);

            } else {

                $sex = $faker->randomElement(['m', 'f']);

                switch ($sex) {

                    case 'm':
                        $name = $faker->firstNameMale . ' ' . $faker->lastNameMale;
                        $avatar = json_decode(file_get_contents('https://randomuser.me/api/?gender=male'))->results[0]->picture->large;
                        break;

                    case 'f':
                        $name = $faker->firstNameFemale . ' ' . $faker->lastNameFemale;
                        $avatar = json_decode(file_get_contents('https://randomuser.me/api/?gender=female'))->results[0]->picture->large;
                        break;

                }

                DB::table('users')->insert([
                    'role_id' => 3,
                    'name' => $name,
                    'email' => str_replace('-', '', str_slug($name)) . '@' . $faker->safeEmailDomain,
                    'sex' => $sex,
                    'avatar' => $avatar,
                    'password' => bcrypt($password),
                    'created_at' => $faker->dateTimeThisYear($max = 'now'),
                ]);

            } // If $user_id

            /* =============== FRIENDS =============== */

            for ($i = 1; $i <= $faker->numberBetween($min = 0, $max = $number_of_users - 1); $i++) {

                $friend_id = $faker->numberBetween($min = 1, $max = $number_of_users);

                $friendship_exists = Friend::where([
                    'user_id' => $user_id,
                    'friend_id' => $friend_id,
                ])->orWhere([
                    'user_id' => $friend_id,
                    'friend_id' => $user_id,
                ])->exists();

                if (!$friendship_exists) {

                    DB::table('friends')->insert([
                        'user_id' => $user_id,
                        'friend_id' => $friend_id,
                        'accepted' => 1,
                        'created_at' => $faker->dateTimeThisYear($max = 'now'),
                    ]);

                }

            } // Koniec pętli Friends Loop
            /* =============== POSTS =============== */
            for ($post_id = 1; $post_id <= $faker->numberBetween($min = 0, $max = $max_post_per_user); $post_id++) {
                DB::table('posts')->insert([
                    'user_id' => $user_id,
                    'content' => $faker->paragraph($nbSenteces = 1, $variableNbSentecens = true),
                    'created_at' => $faker->dateTimeThisYear($max = 'now'),
                ]);

                /* =============== comments =============== */
                $post_id_comment = DB::getPdo()->lastInsertId();
                for ($i = 1; $i <= $faker->numberBetween($min = 0, $max = $max_per_comments); $i++) {
                    DB::table('comments')->insert([
                        'post_id' => $post_id_comment,
                        'user_id' => $faker->numberBetween($min = 1, $max = $number_of_users),
                        'content' => $faker->paragraph($nbSenteces = 1, $variableNbSentecens = true),
                        'created_at' => $faker->dateTimeThisYear($max = 'now'),
                    ]);

                } // end loop comments
            } //Koniec pętli Post Loop

        } // Koniec pętli User Loop


    }
}
