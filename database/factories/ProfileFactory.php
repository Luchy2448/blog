<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Profile>
 */
class ProfileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
   {
       
       return [
                'profession' => fake()->jobTitle,
                'photo' => 'profiles/'.fake()->image('public/storage/profiles', 640, 480, null, false),
                'about' => fake()->paragraph,
                'birthday' => fake()->date,
                'twitter' => fake()->userName,
                'linkedin' => fake()->userName,
                'facebook' => fake()->userName,
                'user_id' => User::all()->random()->id,
            ]; 
        }
    }
        // return [
        //    'profession' => fake(),
        //    'photo' => 'profiles/'.$this->faker->image('public/storage/profiles', 640, 480, null, false),
        //    'about' => fake(),
        //    'birthday' => fake(),
        //    'twitter' => fake(),
        //    'linkedin' => fake(),
        //    'facebook' => fake(),
        //    'user_id' => User::all()->random()->id,
        // ];