<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\Admin;
use App\Models\Category;
use App\Models\Supplier;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\TransactionDetail;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->command->info('Memulai Seeding Database...');
        $this->command->info('');

        // Nonaktifkan foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Create Admin
        $this->command->info('Creating Admin...');
        Admin::truncate();

        Admin::create([
            'name' => 'Admin',
            'email' => 'admin.supermarket@gmail.com',
            'password' => Hash::make('admarket12'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $this->command->info('Admin created successfully!');
        $this->command->info('');

        // Create Categories
        $this->command->info('Creating Categories...');
        Category::truncate();

        $categories = [
            [
                'category_code' => 'CAT-001',
                'category_name' => 'Instant Food',
                'description' => 'Produk makanan siap saji atau mudah dimasak yang praktis untuk kebutuhan sehari-hari.',
            ],

            [
                'category_code' => 'CAT-002',
                'category_name' => 'Bevarages',
                'description' => 'Berbagai jenis minuman yang dapat diminum untuk menyegarkan tubuh.',
            ],

            [
                'category_code' => 'CAT-003',
                'category_name' => 'Snack & Biscuits',
                'description' => 'Makanan ringan seperti biskuit, crackers yang cocok untuk segala usia.',
            ],

            [
                'category_code' => 'CAT-004',
                'category_name' => 'Kitchen Ingredients',
                'description' => 'Bahan dapus utama seperti bumbu masak, tepung, gula, dan kebutuhan memasak lainnya.',
            ],

            [
                'category_code' => 'CAT-005',
                'category_name' => 'Personal Care',
                'description' => 'Produk perawatan dan kebersihan diri sehari-hari seperti sabun, sampo, pasta gigi, dan perawatan kulit.',
            ],

            [
                'category_code' => 'CAT-006',
                'category_name' => 'Dairy & Processed Products',
                'description' => 'Produk berbahan dasar susu dan makanan olahan seperti keju, yogurt.',
            ],

            [
                'category_code' => 'CAT-007',
                'category_name' => 'Baby Care Products',
                'description' => 'Produk khusus untuk bayi dan balita seperti popok, makanan bayi, dan perlengkapan bayi.',
            ]
        ];

        foreach ($categories as $category) {
            Category::create(array_merge($category, [
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }

        $this->command->info(count($categories) . ' Categories created successfully!');
        $this->command->info('');

        // Create Suppliers
        $this->command->info('Creating Suppliers...');
        Supplier::truncate();

        $suppliers = [
            [
                'supplier_code' => 'SUP-001',
                'supplier_name' => 'PT. Sumber Makmur Jaya',
                'contact_name' => 'Budi Santoso',
                'no_telephone' => '081234567890',
                'email' => 'sumberjaya@email.com',
                'address' => 'Jl. Sudirman No. 123, Blok A, Gedung Perkantoran',
                'city' => 'Jakarta Selatan',
                'status' => 'aktif',
            ],
            [
                'supplier_code' => 'SUP-002',
                'supplier_name' => 'CV. Mitra Sejahtera',
                'contact_name' => 'Siti Nurhaliza',
                'no_telephone' => '081234567891',
                'email' => 'mitrasejahtera@email.com',
                'address' => 'Jl. Gatot Subroto No. 456, Ruko Plaza Bisnis',
                'city' => 'Bandung',
                'status' => 'aktif',
            ],
            [
                'supplier_code' => 'SUP-003',
                'supplier_name' => 'PT. Berkah Sentosa Abadi',
                'contact_name' => 'Ahmad Fadli',
                'no_telephone' => '081234567892',
                'email' => 'berkahsentosa@email.com',
                'address' => 'Jl. Diponegoro No. 789, Kawasan Industri',
                'city' => 'Surabaya',
                'status' => 'aktif',
            ],
            [
                'supplier_code' => 'SUP-004',
                'supplier_name' => 'UD. Cahaya Baru Mandiri',
                'contact_name' => 'Dewi Lestari',
                'no_telephone' => '081234567893',
                'email' => 'cahayabaru@email.com',
                'address' => 'Jl. Ahmad Yani No. 321, Pasar Induk Blok C',
                'city' => 'Semarang',
                'status' => 'aktif',
            ],
            [
                'supplier_code' => 'SUP-005',
                'supplier_name' => 'PT. Anugrah Pangan Nusantara',
                'contact_name' => 'Rudi Hartono',
                'no_telephone' => '081234567894',
                'email' => 'anugrahpangan@email.com',
                'address' => 'Jl. Raya Bogor KM 45, Gudang Distribusi No. 7',
                'city' => 'Bogor',
                'status' => 'aktif',
            ],
            [
                'supplier_code' => 'SUP-006',
                'supplier_name' => 'CV. Jaya Abadi Sentosa',
                'contact_name' => 'Indra Gunawan',
                'no_telephone' => '081234567895',
                'email' => 'jayaabadi@email.com',
                'address' => 'Jl. Pahlawan No. 567, Kawasan Pergudangan',
                'city' => 'Tangerang',
                'status' => 'aktif',
            ],
            [
                'supplier_code' => 'SUP-007',
                'supplier_name' => 'PT. Karya Mandiri Utama',
                'contact_name' => 'Lina Marlina',
                'no_telephone' => '081234567896',
                'email' => 'karyamandiri@email.com',
                'address' => 'Jl. Veteran No. 234, Plaza Bisnis Lantai 3',
                'city' => 'Yogyakarta',
                'status' => 'nonaktif',
            ],
            [
                'supplier_code' => 'SUP-008',
                'supplier_name' => 'UD. Rizki Barokah Jaya',
                'contact_name' => 'Hendra Wijaya',
                'no_telephone' => '081234567897',
                'email' => 'rizkibarokah@email.com',
                'address' => 'Jl. Kemerdekaan No. 890, Komplek Toko Grosir',
                'city' => 'Malang',
                'status' => 'aktif',
            ],
        ];

        foreach ($suppliers as $supplier) {
            Supplier::create(array_merge($supplier, [
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }

        $this->command->info(count($suppliers) . ' Suppliers created!');
        $this->command->info('');


        // Create Products
        $this->command->info('📦 Creating Products...');
        Product::truncate();

        $products = [
            [
                'category_id' => 1,
                'supplier_id' => 1,
                'product_code' => 'PRD-001',
                'product_name' => 'Ultra Milk UHT 250 ml',
                'description' => 'Ultra Milk adalah susu segar UHT yang terbuat dari susu sapi segar pilihan.',
                'purchase_price' => 5500,
                'sale_price' => 7500,
                'stock' => 300,
                'minimum_stock' => 30,
                'unit' => 'pcs',
                'status' => 'aktif',
                'image' => 'products/Ultra Milk Coklat.jpg'
            ],
            [
                'category_id' => 2,
                'supplier_id' => 2,
                'product_code' => 'PRD-002',
                'product_name' => 'Olatte 240 ml',
                'description' => 'Olatte adalah minuman susu rasa buah (milky & fruity) yang menyegarkan.',
                'purchase_price' => 6000,
                'sale_price' => 6500,
                'stock' => 150,
                'minimum_stock' => 30,
                'unit' => 'bottle',
                'status' => 'aktif',
                'image' => 'products/Olatte.jpg'
            ],
        ];

        foreach ($products as $product) {
            Product::create(array_merge($product, [
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }

        $this->command->info(count($products) . ' Products created!');  
        $this->command->info('');
    }
}
