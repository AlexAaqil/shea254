<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\DeliveryArea;

class DeliveryAreasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $delivery_areas = [
            [
                'location_id' => 1,
                'area_name' => 'Moi Avenue',
                'price' => '100'
            ],
            [
                'location_id' => 1,
                'area_name' => 'Tom Mboya',
                'price' => '100'
            ],
            [
                'location_id' => 1,
                'area_name' => 'Kenyatta Avenue',
                'price' => '100'
            ],
            [
                'location_id' => 1,
                'area_name' => 'City Hall Way',
                'price' => '100'
            ],
            [
                'location_id' => 1,
                'area_name' => 'OTC',
                'price' => '100'
            ],
            [
                'location_id' => 1,
                'area_name' => 'Nyamakima',
                'price' => '100'
            ],
            [
                'location_id' => 1,
                'area_name' => 'Kamukunji',
                'price' => '100'
            ],
            [
                'location_id' => 1,
                'area_name' => 'Gikomba',
                'price' => '100'
            ],
            [
                'location_id' => 2,
                'area_name' => 'Museum Hill',
                'price' => '250'
            ],
            [
                'location_id' => 2,
                'area_name' => 'ICEA Lion',
                'price' => '250'
            ],
            [
                'location_id' => 2,
                'area_name' => 'Westlands',
                'price' => '300'
            ],
            [
                'location_id' => 2,
                'area_name' => 'Kangemi',
                'price' => '350'
            ],
            [
                'location_id' => 2,
                'area_name' => 'Upper Kabete',
                'price' => '400'
            ],
            [
                'location_id' => 2,
                'area_name' => 'Uthiru',
                'price' => '500'
            ],
            [
                'location_id' => 2,
                'area_name' => 'Kikuyu',
                'price' => '600'
            ],
            [
                'location_id' => 2,
                'area_name' => 'Thogoto',
                'price' => '600'
            ],
            [
                'location_id' => 2,
                'area_name' => 'Gitaru',
                'price' => '600'
            ],
            [
                'location_id' => 2,
                'area_name' => 'Sigona',
                'price' => '600'
            ],
            [
                'location_id' => 3,
                'area_name' => 'CID Headquaters',
                'price' => '300'
            ],
            [
                'location_id' => 3,
                'area_name' => 'Karura Forest',
                'price' => '300'
            ],
            [
                'location_id' => 3,
                'area_name' => 'Muthaiga',
                'price' => '350'
            ],
            [
                'location_id' => 3,
                'area_name' => 'Ridgeways',
                'price' => '350'
            ],
            [
                'location_id' => 3,
                'area_name' => 'Fourways',
                'price' => '400'
            ],
            [
                'location_id' => 3,
                'area_name' => 'Thindigua',
                'price' => '400'
            ],
            [
                'location_id' => 3,
                'area_name' => 'Kiambu Town',
                'price' => '500'
            ],
            [
                'location_id' => 3,
                'area_name' => 'Tatu City',
                'price' => '600'
            ],
        ];

        foreach($delivery_areas as $delivery_area) {
            DeliveryArea::create([
                'location_id' => $delivery_area['location_id'],
                'area_name' => $delivery_area['area_name'],
                'price' => $delivery_area['price'],
            ]);
        }
    }
}
