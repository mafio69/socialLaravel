<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Friend;

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

    	/* =============== USERS =============== */

    	for ($user_id = 1; $user_id <= $number_of_users; $user_id++) {

    		if ($user_id === 1) {

		    	DB::table('users')->insert([
		    		'name' => 'Mariusz Franciszczak',
		    		'email' => 'mariusz@designmf.pl',
		    		'sex' => 'm',
		    		'password' => bcrypt($password),
                                'avatar' => 'avatar1.jpg',
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
		    		'name' => $name,
		    		'email' => str_replace('-', '', str_slug($name)) . '@' . $faker->safeEmailDomain,
		    		'sex' => $sex,
		    		'avatar' => $avatar,
		    		'password' => bcrypt($password),
		    	]);

    		}

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

    			if ( ! $friendship_exists) {

			    	DB::table('friends')->insert([
			    		'user_id' => $user_id,
			    		'friend_id' => $friend_id,
			    		'accepted' => 1,
			    		'created_at' => $faker->dateTimeThisYear($max = 'now'),
			    	]);

    			}

    		}

    	}

    }
}
