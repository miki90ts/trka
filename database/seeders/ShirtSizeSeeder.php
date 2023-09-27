<?php

namespace Database\Seeders;

use App\Models\ShirtSize;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ShirtSizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $shirtSizes = ['XS', 'S', 'M', 'L', 'XL', 'XXL', 'XXXL'];

        foreach ($shirtSizes as $size) {
            ShirtSize::create([
                'title' => $size,
            ]);
        }
    }
}
