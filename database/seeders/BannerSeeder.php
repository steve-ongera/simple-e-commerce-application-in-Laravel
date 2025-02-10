<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Banner;

class BannerSeeder extends Seeder
{
    public function run()
    {
        Banner::create([
            'image' => 'banners/banner1.jpg',
            'title' => 'Valentine\'s Day Special',
            'subtitle' => 'Find the perfect gift for your loved ones',
            'order' => 1
        ]);

        Banner::create([
            'image' => 'banners/banner2.jpg',
            'title' => 'New Arrivals',
            'subtitle' => 'Check out our latest products',
            'order' => 2
        ]);
    }
}