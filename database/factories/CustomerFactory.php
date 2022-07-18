<?php

namespace Database\Factories;

use App\Data\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;

class CustomerFactory extends Factory
{
    protected $model = Customer::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "shipment_address" => [
                "first_name" => $this->faker->name(),
                "last_name" => $this->faker->lastName(),
                "address_line1" => $this->faker->streetAddress(),
                "city" => $this->faker->city(),
                "state" => "",
                "country" => $this->faker->countryCode(),
                "zip_code" => $this->faker->postcode(),
            ],
            "billing_address" => [
                "first_name" => $this->faker->name(),
                "last_name" => $this->faker->lastName(),
                "address_line1" => $this->faker->streetAddress(),
                "city" => $this->faker->city(),
                "state" => "",
                "country" => $this->faker->countryCode(),
                "zip_code" => $this->faker->postcode(),
            ],
            "payment_method" => [
                "name_on_card" => $this->faker->name(),
                "security_code" => $this->faker->randomNumber(["nbDigits" => 3]),
                "number" => $this->faker->creditCardNumber(),
                "expiration_month" => $this->faker->month(),
                "expiration_year" => $this->faker->year(),
            ],
        ];
    }
}
