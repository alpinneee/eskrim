<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'name' => 'Es Krim Vanilla Klasik',
                'description' => 'Es krim vanilla premium dengan tekstur lembut dan rasa yang creamy',
                'price' => 15000,
                'stock' => 75,
                'category' => 'classic',
                'is_active' => true
            ],
            [
                'name' => 'Es Krim Cokelat Susu',
                'description' => 'Es krim cokelat dengan rasa yang kaya dan manis sempurna',
                'price' => 18000,
                'stock' => 65,
                'category' => 'classic',
                'is_active' => true
            ],
            [
                'name' => 'Es Krim Strawberry Fresh',
                'description' => 'Es krim strawberry segar dengan potongan buah strawberry asli',
                'price' => 20000,
                'stock' => 60,
                'category' => 'fruit',
                'is_active' => true
            ],
            [
                'name' => 'Mint Choco Chip Delight',
                'description' => 'Es krim mint segar dengan serpihan cokelat yang renyah',
                'price' => 22000,
                'stock' => 45,
                'category' => 'premium',
                'is_active' => true
            ],
            [
                'name' => 'Cookies & Cream Supreme',
                'description' => 'Es krim vanilla premium dengan remahan biskuit oreo yang melimpah',
                'price' => 25000,
                'stock' => 50,
                'category' => 'premium',
                'is_active' => true
            ],
            [
                'name' => 'Es Krim Mangga Tropis',
                'description' => 'Es krim mangga manis dengan cita rasa tropis yang menyegarkan',
                'price' => 19000,
                'stock' => 40,
                'category' => 'fruit',
                'is_active' => true
            ],
            [
                'name' => 'Coffee Arabica Blend',
                'description' => 'Es krim kopi arabica dengan aroma yang kuat dan rasa yang nikmat',
                'price' => 23000,
                'stock' => 35,
                'category' => 'premium',
                'is_active' => true
            ],
            [
                'name' => 'Blueberry Antioxidant',
                'description' => 'Es krim blueberry segar kaya antioksidan dengan rasa asam manis',
                'price' => 21000,
                'stock' => 30,
                'category' => 'fruit',
                'is_active' => true
            ],
            [
                'name' => 'Rocky Road Adventure',
                'description' => 'Es krim cokelat dengan marshmallow lembut dan kacang almond panggang',
                'price' => 28000,
                'stock' => 25,
                'category' => 'premium',
                'is_active' => true
            ],
            [
                'name' => 'Pistachio Premium',
                'description' => 'Es krim pistachio eksklusif dengan rasa kacang yang autentik dan mewah',
                'price' => 32000,
                'stock' => 20,
                'category' => 'premium',
                'is_active' => true
            ],
            [
                'name' => 'Taro Purple Delight',
                'description' => 'Es krim taro ungu dengan rasa yang unik dan warna yang menarik',
                'price' => 24000,
                'stock' => 35,
                'category' => 'premium',
                'is_active' => true
            ],
            [
                'name' => 'Green Tea Matcha',
                'description' => 'Es krim green tea matcha Jepang dengan rasa yang autentik',
                'price' => 26000,
                'stock' => 30,
                'category' => 'premium',
                'is_active' => true
            ]
        ];

        // Safety check untuk products array
        if (!is_array($products) || empty($products)) {
            throw new \Exception('Products array is null or empty in ProductSeeder');
        }

        foreach ($products as $product) {
            if (!is_array($product) || !isset($product['name'], $product['price'])) {
                continue; // Skip invalid product data
            }
            // Check if product with the same name already exists
            if (!Product::where('name', $product['name'])->exists()) {
                Product::create($product);
            }
        }
    }
}
