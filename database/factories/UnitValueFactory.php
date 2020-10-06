<?php

namespace Database\Factories;

use App\Models\UnitValue;
use Illuminate\Database\Eloquent\Factories\Factory;

class UnitValueFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = UnitValue::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->getUnitValue(),
        ];
    }

    private function getUnitValue()
    {
        $unit = ['vnt', 'g', 'kg', 'mg', 'l', 'ml'];

        return rand(0, 1000) . $unit[rand(0,5)];
    }
}
