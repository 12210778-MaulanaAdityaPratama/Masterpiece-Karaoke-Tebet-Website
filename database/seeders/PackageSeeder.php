<?php

namespace Database\Seeders;

use App\Models\Package;
use App\Models\PackageTier;
use App\Models\TierInclude;
use Illuminate\Database\Seeder;

class PackageSeeder extends Seeder
{
    public function run(): void
    {
        $packagesData = [
            [
                'name'           => 'Paket Hemat',
                'description'    => 'Free Room 2 Jam',
                'duration_hours' => 2,
                'sort_order'     => 1,
                'tiers'          => [
                    [
                        'name'       => 'Bronze',
                        'color'      => '#CD7F32',
                        'price'      => 300000,
                        'sort_order' => 1,
                        'includes'   => [
                            ['item_name' => 'Ice Lemon Tea',  'quantity' => '1 Pitcher'],
                            ['item_name' => 'Pisang Goreng',  'quantity' => '1 Porsi'],
                            ['item_name' => 'Tahu Lada Garam','quantity' => '1 Porsi'],
                        ],
                    ],
                    [
                        'name'       => 'Silver',
                        'color'      => '#A8A9AD',
                        'price'      => 350000,
                        'sort_order' => 2,
                        'includes'   => [
                            ['item_name' => 'Ice Lemon Tea',  'quantity' => '1 Pitcher'],
                            ['item_name' => 'Orange Juice',   'quantity' => '1 Glass'],
                            ['item_name' => 'Pisang Goreng',  'quantity' => '1 Porsi'],
                            ['item_name' => 'Tahu Lada Garam','quantity' => '1 Porsi'],
                        ],
                    ],
                    [
                        'name'       => 'Gold',
                        'color'      => '#FFD700',
                        'price'      => 450000,
                        'badge'      => 'Best Value',
                        'sort_order' => 3,
                        'includes'   => [
                            ['item_name' => 'Ice Lemon Tea',  'quantity' => '2 Pitcher'],
                            ['item_name' => 'Pisang Goreng',  'quantity' => '1 Porsi'],
                            ['item_name' => 'Tahu Lada Garam','quantity' => '1 Porsi'],
                        ],
                    ],
                ],
            ],
            [
                'name'           => 'Paket Asik',
                'description'    => 'Free Room 3 Jam + Bonus Snack',
                'duration_hours' => 3,
                'sort_order'     => 2,
                'tiers'          => [
                    [
                        'name'       => 'Bronze',
                        'color'      => '#CD7F32',
                        'price'      => 400000,
                        'sort_order' => 1,
                        'includes'   => [
                            ['item_name' => 'Ice Lemon Tea',  'quantity' => '1 Pitcher'],
                            ['item_name' => 'Pisang Goreng',  'quantity' => '1 Porsi'],
                            ['item_name' => 'French Fries',   'quantity' => '1 Porsi'],
                        ],
                    ],
                    [
                        'name'       => 'Silver',
                        'color'      => '#A8A9AD',
                        'price'      => 500000,
                        'sort_order' => 2,
                        'includes'   => [
                            ['item_name' => 'Ice Lemon Tea',  'quantity' => '1 Pitcher'],
                            ['item_name' => 'Orange Juice',   'quantity' => '1 Glass'],
                            ['item_name' => 'Pisang Goreng',  'quantity' => '1 Porsi'],
                            ['item_name' => 'French Fries',   'quantity' => '1 Porsi'],
                            ['item_name' => 'Tahu Lada Garam','quantity' => '1 Porsi'],
                        ],
                    ],
                    [
                        'name'       => 'Gold',
                        'color'      => '#FFD700',
                        'price'      => 650000,
                        'badge'      => 'Best Seller',
                        'sort_order' => 3,
                        'includes'   => [
                            ['item_name' => 'Ice Lemon Tea',  'quantity' => '2 Pitcher'],
                            ['item_name' => 'Orange Juice',   'quantity' => '2 Glass'],
                            ['item_name' => 'Pisang Goreng',  'quantity' => '2 Porsi'],
                            ['item_name' => 'French Fries',   'quantity' => '1 Porsi'],
                            ['item_name' => 'Tahu Lada Garam','quantity' => '1 Porsi'],
                            ['item_name' => 'Chicken Pop',    'quantity' => '1 Porsi'],
                        ],
                    ],
                ],
            ],
            [
                'name'           => 'Paket Family',
                'description'    => 'Free Room 3 Jam untuk Keluarga',
                'duration_hours' => 3,
                'sort_order'     => 3,
                'tiers'          => [
                    [
                        'name'       => 'Bronze',
                        'color'      => '#CD7F32',
                        'price'      => 600000,
                        'sort_order' => 1,
                        'includes'   => [
                            ['item_name' => 'Ice Lemon Tea',  'quantity' => '2 Pitcher'],
                            ['item_name' => 'Pisang Goreng',  'quantity' => '2 Porsi'],
                            ['item_name' => 'French Fries',   'quantity' => '1 Porsi'],
                            ['item_name' => 'Tahu Lada Garam','quantity' => '1 Porsi'],
                        ],
                    ],
                    [
                        'name'       => 'Silver',
                        'color'      => '#A8A9AD',
                        'price'      => 750000,
                        'sort_order' => 2,
                        'includes'   => [
                            ['item_name' => 'Ice Lemon Tea',  'quantity' => '2 Pitcher'],
                            ['item_name' => 'Orange Juice',   'quantity' => '2 Glass'],
                            ['item_name' => 'Pisang Goreng',  'quantity' => '2 Porsi'],
                            ['item_name' => 'French Fries',   'quantity' => '2 Porsi'],
                            ['item_name' => 'Tahu Lada Garam','quantity' => '1 Porsi'],
                        ],
                    ],
                    [
                        'name'       => 'Gold',
                        'color'      => '#FFD700',
                        'price'      => 950000,
                        'badge'      => 'Recommended',
                        'sort_order' => 3,
                        'includes'   => [
                            ['item_name' => 'Ice Lemon Tea',  'quantity' => '3 Pitcher'],
                            ['item_name' => 'Orange Juice',   'quantity' => '2 Glass'],
                            ['item_name' => 'Pisang Goreng',  'quantity' => '2 Porsi'],
                            ['item_name' => 'French Fries',   'quantity' => '2 Porsi'],
                            ['item_name' => 'Tahu Lada Garam','quantity' => '1 Porsi'],
                            ['item_name' => 'Chicken Pop',    'quantity' => '1 Porsi'],
                            ['item_name' => 'Free Dekorasi',  'quantity' => '1 Set'],
                        ],
                    ],
                ],
            ],
        ];

        foreach ($packagesData as $pd) {
            $pkg = Package::create([
                'name'           => $pd['name'],
                'description'    => $pd['description'],
                'duration_hours' => $pd['duration_hours'],
                'is_active'      => true,
                'sort_order'     => $pd['sort_order'],
            ]);

            foreach ($pd['tiers'] as $td) {
                $tier = PackageTier::create([
                    'package_id'   => $pkg->id,
                    'name'         => $td['name'],
                    'color'        => $td['color'],
                    'price'        => $td['price'],
                    'badge'        => $td['badge'] ?? null,
                    'is_available' => true,
                    'sort_order'   => $td['sort_order'],
                ]);

                foreach ($td['includes'] as $i => $inc) {
                    TierInclude::create([
                        'package_tier_id' => $tier->id,
                        'item_name'       => $inc['item_name'],
                        'quantity'        => $inc['quantity'],
                        'sort_order'      => $i,
                    ]);
                }
            }
        }
    }
}
