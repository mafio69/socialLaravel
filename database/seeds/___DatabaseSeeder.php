<?php

use Illuminate\Database\Seeder;
use App\Friend;

class DatabaseSeeder extends Seeder {

    /**
     * Run the database seeds.
     * //$this->call(friend_ad::class);
     * @return void
     */
    public function run() {
        //================ Variables=================/
        $many_user = 20;

        //================ Users=================/
        for ($user = 1; $user < $many_user; $user++) {
            if ($user == 1) {
                DB::table('users')->insert([
                    'name' => 'Mariusz Franciszczak',
                    'email' => 'mariusz@designmf.pl',
                    'sex' => 'm',
                    'password' => bcrypt('123456'),
                ]);
            }


            $faker = new Faker\factory;
            $faker = $faker->create('pl_PL');
            $sex = $faker->randomElement($array = array('m', 'f'));
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
                'name' => $name,
                'sex' => $sex,
                'avatar' => $avatar,
                'email' => str_slug($name, '') . '@' . $faker->freeEmailDomain,
                'password' => bcrypt('123456'),
            ]);
            for ($i = 1; $i < $faker->numberBetween($min = 0, $max = $many_user - 1); $i++) {
                $friend_id = $faker->numberBetween(1, $many_user);
                $date = $faker->dateTimeThisYear($max = 'now');
                $friendship_exists = Friend::where([
                            'user_id' => $user,
                            'friend_id' => $friend_id,
                        ])->orWhere([
                            'user_id' => $friend_id,
                            'friend_id' => $user,
                        ])->exists();
                if (!$friendship_exists) {
                    DB::table('friends')->insert([
                        'user_id' => $user,
                        'friend_id' => $friend_id,
                        'accepted' => $faker->numberBetween(0, 1),
                        'created_at' => $date,
                        'updated_at' => $date,
                    ]);
                }
            }
        }
        //================ Friends=================/
    }

}
