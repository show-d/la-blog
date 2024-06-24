<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Friendlink;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            Friendlink::class,
        ]);


        // \App\Models\Member::factory(10)->create();

        // \App\Models\Member::factory()->create([
        //     'name' => 'Test Member',
        //     'email' => 'test@example.com',
        // ]);
    }
}
