<?php

namespace Database\Factories;

use App\Models\TodoList;
use Illuminate\Database\Eloquent\Factories\Factory;

class TodoListFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public $model = TodoList::class;
    public function definition()
    {
        return [
            //
            'name' => $this->faker->sentence(),
        ];
    }
}
