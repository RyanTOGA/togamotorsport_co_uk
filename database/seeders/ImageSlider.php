<?php

namespace Database\Seeders;

use App\Models\SliderImage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ImageSlider extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SliderImage::query()->create([
            'image_path' => 'image_1.png',
            'image_header' => 'IMAGE HEADER 1',
            'image_blurb' => 'TEST 1',
            'image_button' => 'TEST 1',
            'image_link' => 'https://youtube.com/@togamotorsport',
        ]);

        SliderImage::query()->create([
            'image_path' => 'image_2.png',
            'image_header' => 'IMAGE HEADER 2',
            'image_blurb' => 'TEST 2',
            'image_button' => 'TEST 2',
            'image_link' => 'https://youtube.com/@togamotorsport',
        ]);
        SliderImage::query()->create([
            'image_path' => 'image_3.png',
            'image_header' => 'IMAGE HEADER 3',
            'image_blurb' => 'TEST 3',
            'image_button' => 'TEST 3',
            'image_link' => 'https://youtube.com/@togamotorsport',
        ]);
    }
}
