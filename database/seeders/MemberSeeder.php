<?php

namespace Database\Seeders;

use App\Models\Friendlink;
use App\Models\Member;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class MemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

       //生成1条数据
        Member::factory(1)->create(function (){
            return[
                'user_name' => 'admin',
                'password' => '$2y$10$b4HqpxlXAiuAs2ZtGtj5D.4sPxZwGezcpIGOpjLfs6FwqPw4GavrG',
                'email' => 'cosmos@c.com',
                'group_id' => 99,
            ] ;

        });

    }
}
