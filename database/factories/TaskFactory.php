<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'judul' => fake()->sentence(),
            'deskripsi' => fake()->paragraph(),
            'status' => $this->status(),
        ];
    }

    private function status(){
        $status = ['completed', 'incomplete'];
        return $status[rand(0,1)];
    }
}
