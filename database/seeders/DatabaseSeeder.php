<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use  Illuminate\Support\Facades\File;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        //Storage::deleteDirectory('products');
        File::deleteDirectory(public_path('storage/categories'));
        File::makeDirectory(public_path('storage/categories'));

        File::deleteDirectory(public_path('storage/subcategories'));
        File::makeDirectory(public_path('storage/subcategories'));

        File::deleteDirectory(public_path('storage/products'));
        File::makeDirectory(public_path('storage/products'));

        $this->call(UserSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(SubcategorySeeder::class);    
        $this->call(ProductSeeder::class);
        $this->call(ColorSeeder::class);
        $this->call(ColorProductSeeder::class);
        $this->call(SizeSeeder::class);

        $this->call(ColorSizeSeeder::class);

        $this->call(DepartmentSeeder::class);
    }
}
