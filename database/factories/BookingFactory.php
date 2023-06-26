<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Client;
use Carbon\CarbonInterval;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class BookingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $startTime = $this->faker->dateTimeBetween('+1 day', '+1 week');
        $startMinute = $startTime->format('i');
        $roundedStartMinute = ceil($startMinute / 15) * 15;
        $startTime->setTime($startTime->format('H'), $roundedStartMinute, 0);

        $interval = CarbonInterval::minutes(mt_rand(15, 120));
        $finishTime = clone $startTime;
        $finishTime->add($interval);

        return [
            'start_time' => $startTime,
            'finish_time' => $finishTime,
            'comments' => $this->faker->sentence(),
            'client_email' => User::inRandomOrder()->first()->email,
            'employee_id' => User::inRandomOrder()->first()->id,
            'payment_status' => $this->faker->randomElement(['paid', 'unpaid']),
            'payment_intent_id' => null,
        ];
    }

}
