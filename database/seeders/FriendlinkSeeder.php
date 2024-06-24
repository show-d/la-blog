<?php

namespace Database\Seeders;

use App\Models\Friendlink;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class FriendlinkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
/*              Friendlink::factory()
                    ->count(50)
                    ->hasPosts(1)
                    ->create();*/

       //生成10条数据
        Friendlink::factory(20)->create(function (){

            $name = '友情链接'.uniqid();
            return[
                'name' => $name, //表中不能为空且没有默认值要设置一下
                'url' => 'https://www.'.uniqid().'.com/',
            ] ;

        });

    }
}
