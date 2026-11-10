<?php

namespace Database\Seeders;

use App\Models\ModelShowroom;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class ModelShowroomSeeder extends Seeder
{

    public function run(): void
    {
        // Ensure storage directory exists
        $storagePath = storage_path('app/public/vehicles');
        if (!File::isDirectory($storagePath)) {
            File::makeDirectory($storagePath, 0755, true);
        }

        // Source images from UI folder
        $sourceDir = public_path('assets/frontend/images/vehicles');

        $vehicles = [
            ['model_name' => 'Q50',             'year' => 2014, 'price' => 37500, 'status' => 1, 'display_order' => 1,  'image' => 'q50.png'],
            ['model_name' => 'QX70',            'year' => 2014, 'price' => 53350, 'status' => 1, 'display_order' => 2,  'image' => 'qx70.png'],
            ['model_name' => 'QX50',            'year' => 2014, 'price' => 37900, 'status' => 1, 'display_order' => 3,  'image' => 'qx50.png'],
            ['model_name' => 'QX60',            'year' => 2014, 'price' => 43000, 'status' => 1, 'display_order' => 4,  'image' => 'qx60.png'],
            ['model_name' => 'Q60 Coupe',       'year' => 2015, 'price' => 46800, 'status' => 1, 'display_order' => 5,  'image' => 'q50.png'],
            ['model_name' => 'Q70',             'year' => 2015, 'price' => 52900, 'status' => 0, 'display_order' => 6,  'image' => 'qx70.png'],
            ['model_name' => 'QX80',            'year' => 2015, 'price' => 71500, 'status' => 1, 'display_order' => 7,  'image' => 'qx60.png'],
            ['model_name' => 'Q40',             'year' => 2015, 'price' => 34200, 'status' => 0, 'display_order' => 8,  'image' => 'q50.png'],
            ['model_name' => 'QX30',            'year' => 2016, 'price' => 36400, 'status' => 1, 'display_order' => 9,  'image' => 'qx50.png'],
            ['model_name' => 'Q50 Hybrid',      'year' => 2016, 'price' => 48900, 'status' => 1, 'display_order' => 10, 'image' => 'q50.png'],
            ['model_name' => 'QX70 Sport',      'year' => 2016, 'price' => 58200, 'status' => 0, 'display_order' => 11, 'image' => 'qx70.png'],
            ['model_name' => 'Q60 Convertible', 'year' => 2016, 'price' => 61000, 'status' => 1, 'display_order' => 12, 'image' => 'q50.png'],
            ['model_name' => 'QX60 Hybrid',     'year' => 2016, 'price' => 49700, 'status' => 1, 'display_order' => 13, 'image' => 'qx60.png'],
            ['model_name' => 'QX50 Premium',    'year' => 2016, 'price' => 41300, 'status' => 0, 'display_order' => 14, 'image' => 'qx50.png'],
        ];

        foreach ($vehicles as $vehicle) {
            // Copy image to storage if it exists in source
            $srcFile = $sourceDir . DIRECTORY_SEPARATOR . $vehicle['image'];
            $destFile = $storagePath . DIRECTORY_SEPARATOR . $vehicle['image'];
            if (File::exists($srcFile) && !File::exists($destFile)) {
                File::copy($srcFile, $destFile);
            }

            ModelShowroom::updateOrCreate(
                ['model_name' => $vehicle['model_name'], 'year' => $vehicle['year']],
                $vehicle
            );
        }
    }
}

