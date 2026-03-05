<?php

namespace Database\Seeders;

use App\Models\FnbCategory;
use App\Models\FnbItem;
use App\Models\Package;
use App\Models\PackageTier;
use App\Models\Room;
use App\Models\TierInclude;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // ── Admin User ─────────────────────────────────────────────────────
        User::firstOrCreate(['email' => 'admin@masterpiece.com'], [
            'name'     => 'Administrator',
            'password' => Hash::make('password'),
        ]);

        // ── Rooms ──────────────────────────────────────────────────────────
        $rooms = [
            [
                'name'          => 'Room Cozy',
                'type'          => 'small',
                'capacity_min'  => 2,
                'capacity_max'  => 4,
                'price_weekday' => 50000,
                'price_weekend' => 70000,
                'description'   => 'Room nyaman untuk bernyanyi berdua atau bersama sahabat dekat.',
                'facilities'    => ['LED TV 43"', 'Sistem Audio Premium', 'AC', 'Sofa', 'Mic 2 buah'],
                'sort_order'    => 1,
            ],
            [
                'name'          => 'Room Classic',
                'type'          => 'medium',
                'capacity_min'  => 4,
                'capacity_max'  => 8,
                'price_weekday' => 80000,
                'price_weekend' => 110000,
                'description'   => 'Pilihan terbaik untuk grup kecil dengan mood lighting.',
                'facilities'    => ['LED TV 55"', 'Sistem Audio Surround', 'AC', 'Sofa Panjang', 'Mic 4 buah', 'Mood Lighting'],
                'sort_order'    => 2,
            ],
            [
                'name'          => 'Room Grand',
                'type'          => 'large',
                'capacity_min'  => 8,
                'capacity_max'  => 15,
                'price_weekday' => 150000,
                'price_weekend' => 200000,
                'description'   => 'Room besar untuk pesta dan gathering keluarga.',
                'facilities'    => ['LED TV 65"', 'Sistem Audio Theater', 'AC', 'Sofa + Kursi Extra', 'Mic 6 buah', 'Panggung Mini', 'Disco Ball'],
                'sort_order'    => 3,
            ],
            [
                'name'          => 'Room VIP Sakura',
                'type'          => 'vip',
                'capacity_min'  => 4,
                'capacity_max'  => 10,
                'price_weekday' => 200000,
                'price_weekend' => 280000,
                'description'   => 'Pengalaman karaoke premium dengan dekorasi eksklusif.',
                'facilities'    => ['Smart TV 75"', 'Sistem Audio JBL Pro', 'AC Inverter', 'Sofa Kulit Mewah', 'Mic Wireless 6 buah', 'Private Bar', 'Disco Ball'],
                'sort_order'    => 4,
            ],
        ];

        foreach ($rooms as $r) {
            Room::create(array_merge($r, ['is_available' => true]));
        }

        // ── Packages + Tiers ───────────────────────────────────────────────
        $packagesData = [
            [
                'name'           => 'Paket Hemat',
                'description'    => 'Free Room 2 Jam',
                'duration_hours' => 2,
                'sort_order'     => 1,
                'tiers' => [
                    [
                        'name'       => 'Bronze',
                        'color'      => '#CD7F32',
                        'price'      => 300000,
                        'sort_order' => 1,
                        'includes'   => [
                            ['item_name' => 'Ice Lemon Tea',   'quantity' => '1 Pitcher'],
                            ['item_name' => 'Pisang Goreng',   'quantity' => '1 Porsi'],
                            ['item_name' => 'Tahu Lada Garam', 'quantity' => '1 Porsi'],
                        ],
                    ],
                    [
                        'name'       => 'Silver',
                        'color'      => '#A8A9AD',
                        'price'      => 350000,
                        'sort_order' => 2,
                        'includes'   => [
                            ['item_name' => 'Ice Lemon Tea',   'quantity' => '1 Pitcher'],
                            ['item_name' => 'Orange Juice',    'quantity' => '1 Glass'],
                            ['item_name' => 'Pisang Goreng',   'quantity' => '1 Porsi'],
                            ['item_name' => 'Tahu Lada Garam', 'quantity' => '1 Porsi'],
                        ],
                    ],
                    [
                        'name'       => 'Gold',
                        'color'      => '#FFD700',
                        'price'      => 450000,
                        'badge'      => 'Best Value',
                        'sort_order' => 3,
                        'includes'   => [
                            ['item_name' => 'Ice Lemon Tea',   'quantity' => '2 Pitcher'],
                            ['item_name' => 'Pisang Goreng',   'quantity' => '1 Porsi'],
                            ['item_name' => 'Tahu Lada Garam', 'quantity' => '1 Porsi'],
                        ],
                    ],
                ],
            ],
            [
                'name'           => 'Paket Asik',
                'description'    => 'Free Room 3 Jam + Bonus Snack',
                'duration_hours' => 3,
                'sort_order'     => 2,
                'tiers' => [
                    [
                        'name'       => 'Bronze',
                        'color'      => '#CD7F32',
                        'price'      => 400000,
                        'sort_order' => 1,
                        'includes'   => [
                            ['item_name' => 'Ice Lemon Tea',   'quantity' => '1 Pitcher'],
                            ['item_name' => 'Pisang Goreng',   'quantity' => '1 Porsi'],
                            ['item_name' => 'French Fries',    'quantity' => '1 Porsi'],
                        ],
                    ],
                    [
                        'name'       => 'Silver',
                        'color'      => '#A8A9AD',
                        'price'      => 500000,
                        'sort_order' => 2,
                        'includes'   => [
                            ['item_name' => 'Ice Lemon Tea',   'quantity' => '1 Pitcher'],
                            ['item_name' => 'Orange Juice',    'quantity' => '1 Glass'],
                            ['item_name' => 'Pisang Goreng',   'quantity' => '1 Porsi'],
                            ['item_name' => 'French Fries',    'quantity' => '1 Porsi'],
                            ['item_name' => 'Tahu Lada Garam', 'quantity' => '1 Porsi'],
                        ],
                    ],
                    [
                        'name'       => 'Gold',
                        'color'      => '#FFD700',
                        'price'      => 650000,
                        'badge'      => 'Best Seller',
                        'sort_order' => 3,
                        'includes'   => [
                            ['item_name' => 'Ice Lemon Tea',   'quantity' => '2 Pitcher'],
                            ['item_name' => 'Orange Juice',    'quantity' => '2 Glass'],
                            ['item_name' => 'Pisang Goreng',   'quantity' => '2 Porsi'],
                            ['item_name' => 'French Fries',    'quantity' => '1 Porsi'],
                            ['item_name' => 'Tahu Lada Garam', 'quantity' => '1 Porsi'],
                            ['item_name' => 'Chicken Pop',     'quantity' => '1 Porsi'],
                        ],
                    ],
                ],
            ],
            [
                'name'           => 'Paket Family',
                'description'    => 'Free Room 3 Jam untuk Keluarga',
                'duration_hours' => 3,
                'sort_order'     => 3,
                'tiers' => [
                    [
                        'name'       => 'Bronze',
                        'color'      => '#CD7F32',
                        'price'      => 600000,
                        'sort_order' => 1,
                        'includes'   => [
                            ['item_name' => 'Ice Lemon Tea',   'quantity' => '2 Pitcher'],
                            ['item_name' => 'Pisang Goreng',   'quantity' => '2 Porsi'],
                            ['item_name' => 'French Fries',    'quantity' => '1 Porsi'],
                            ['item_name' => 'Tahu Lada Garam', 'quantity' => '1 Porsi'],
                        ],
                    ],
                    [
                        'name'       => 'Silver',
                        'color'      => '#A8A9AD',
                        'price'      => 750000,
                        'sort_order' => 2,
                        'includes'   => [
                            ['item_name' => 'Ice Lemon Tea',   'quantity' => '2 Pitcher'],
                            ['item_name' => 'Orange Juice',    'quantity' => '2 Glass'],
                            ['item_name' => 'Pisang Goreng',   'quantity' => '2 Porsi'],
                            ['item_name' => 'French Fries',    'quantity' => '2 Porsi'],
                            ['item_name' => 'Tahu Lada Garam', 'quantity' => '1 Porsi'],
                        ],
                    ],
                    [
                        'name'       => 'Gold',
                        'color'      => '#FFD700',
                        'price'      => 950000,
                        'badge'      => 'Recommended',
                        'sort_order' => 3,
                        'includes'   => [
                            ['item_name' => 'Ice Lemon Tea',   'quantity' => '3 Pitcher'],
                            ['item_name' => 'Orange Juice',    'quantity' => '2 Glass'],
                            ['item_name' => 'Pisang Goreng',   'quantity' => '2 Porsi'],
                            ['item_name' => 'French Fries',    'quantity' => '2 Porsi'],
                            ['item_name' => 'Tahu Lada Garam', 'quantity' => '1 Porsi'],
                            ['item_name' => 'Chicken Pop',     'quantity' => '1 Porsi'],
                            ['item_name' => 'Free Dekorasi',   'quantity' => '1 Set'],
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

        // ── F&B Categories & Items ─────────────────────────────────────────
        $fnbData = [
            [
                'name'  => 'Minuman',
                'icon'  => '🥤',
                'items' => [
                    ['name' => 'Es Teh Manis',       'price' => 12000, 'badge' => null],
                    ['name' => 'Es Jeruk',            'price' => 15000, 'badge' => null],
                    ['name' => 'Jus Alpukat',         'price' => 22000, 'badge' => 'Recommended'],
                    ['name' => 'Jus Mangga',          'price' => 20000, 'badge' => null],
                    ['name' => 'Pitcher Juice Mix',   'price' => 65000, 'badge' => 'Best Seller'],
                    ['name' => 'Air Mineral',         'price' => 8000,  'badge' => null],
                    ['name' => 'Soft Drink (Kaleng)', 'price' => 15000, 'badge' => null],
                    ['name' => 'Ice Lemon Tea',       'price' => 18000, 'badge' => 'Favorit'],
                    ['name' => 'Orange Juice',        'price' => 20000, 'badge' => null],
                ],
            ],
            [
                'name'  => 'Makanan Berat',
                'icon'  => '🍱',
                'items' => [
                    ['name' => 'Nasi Goreng Spesial',  'price' => 35000, 'badge' => 'Best Seller'],
                    ['name' => 'Mie Goreng Spesial',   'price' => 30000, 'badge' => null],
                    ['name' => 'Nasi Ayam Geprek',     'price' => 32000, 'badge' => 'Spicy 🌶'],
                    ['name' => 'Indomie Goreng Telur', 'price' => 18000, 'badge' => null],
                    ['name' => 'Paket Nasi + Lauk',    'price' => 40000, 'badge' => 'Recommended'],
                ],
            ],
            [
                'name'  => 'Snack & Cemilan',
                'icon'  => '🍟',
                'items' => [
                    ['name' => 'French Fries',          'price' => 22000, 'badge' => 'Favorit'],
                    ['name' => 'Chicken Pop',           'price' => 25000, 'badge' => null],
                    ['name' => 'Pisang Goreng Crispy',  'price' => 18000, 'badge' => 'Recommended'],
                    ['name' => 'Tahu Lada Garam',       'price' => 20000, 'badge' => 'Favorit'],
                    ['name' => 'Dimsum (6 pcs)',         'price' => 28000, 'badge' => null],
                ],
            ],
            [
                'name'  => 'Dessert',
                'icon'  => '🍰',
                'items' => [
                    ['name' => 'Es Krim (2 scoop)',  'price' => 20000, 'badge' => null],
                    ['name' => 'Brownies Hangat',    'price' => 22000, 'badge' => 'Recommended'],
                    ['name' => 'Waffle + Topping',   'price' => 28000, 'badge' => null],
                ],
            ],
        ];

        foreach ($fnbData as $i => $cat) {
            $category = FnbCategory::create([
                'name'       => $cat['name'],
                'slug'       => Str::slug($cat['name']),
                'icon'       => $cat['icon'],
                'is_active'  => true,
                'sort_order' => $i + 1,
            ]);

            foreach ($cat['items'] as $j => $item) {
                FnbItem::create([
                    'fnb_category_id' => $category->id,
                    'name'            => $item['name'],
                    'price'           => $item['price'],
                    'badge'           => $item['badge'],
                    'is_available'    => true,
                    'sort_order'      => $j + 1,
                ]);
            }
        }
    }
}
