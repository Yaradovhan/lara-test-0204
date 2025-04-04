<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder {
    public function run() {
        User::factory()->count(25)->create();
    }
}
