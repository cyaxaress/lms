<?php

namespace Cyaxaress\Slider\Database\Seeds;

use Cyaxaress\Media\Services\MediaFileService;
use Cyaxaress\Slider\Models\Slide;
use Illuminate\Database\Seeder;
use Illuminate\Http\UploadedFile;

class SliderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        auth()->loginUsingId(1);
        $slides = [
            [
                'link' => '/',
                'image' => 'slider-1.jpg',
            ],
            [
                'link' => '/',
                'image' => 'slider-2.jpg',
            ],
        ];
        foreach ($slides as $slide) {
            Slide::query()->create([
                'user_id' => 1,
                'media_id' => MediaFileService::publicUpload(new UploadedFile(storage_path('app/public/seeds/'.$slide['image']), $slide['image']))->id,
                'status' => 1,
                'link' => $slide['link'],
            ]);
        }
    }
}
