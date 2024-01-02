<?php

namespace Database\Seeders;

use App\Models\Nfe;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NfeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::where('email', 'test_user@gmail.com')->first();
        Nfe::factory()->count(10)->setUserOwner($user)->create();
    }
}
