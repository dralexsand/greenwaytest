<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserCart;
use Faker\Generator;
use Illuminate\Container\Container;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Database\Seeder;

class UserCartSeeder extends Seeder
{

    /**
     * The current Faker instance.
     *
     * @var Generator
     */
    protected Generator $faker;

    /**
     * @throws BindingResolutionException
     */
    public function __construct()
    {
        $this->faker = $this->withFaker();
    }

    /**
     * Get a new Faker instance.
     *
     * @return Generator
     * @throws BindingResolutionException
     */
    protected function withFaker(): Generator
    {
        return Container::getInstance()->make(Generator::class);
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::get();

        foreach ($users as $user) {
            $credit_card_type = $this->faker->creditCardType();

            UserCart::create(
                [
                    'user_id' => $user->id,
                    'credit_card_type' => $credit_card_type,
                    'credit_card_number' => $this
                        ->faker
                        ->creditCardNumber($credit_card_type),
                    'credit_card_expiration_date' => $this
                        ->faker->creditCardExpirationDateString(),
                    'credit_card_code' => random_int(100, 999),
                ]
            );
        }
    }
}
