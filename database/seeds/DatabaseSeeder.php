<?php

use App\Models\Profile\User;
use Illuminate\Database\Seeder;
use App\Models\Billings\Billing;
use App\Models\Products\Product;
use App\Models\Customers\Customer;
use Caffeinated\Shinobi\Models\Role;
use App\Models\Billings\BillingDetail;
use App\Models\Products\Config\Category;
use App\Models\Products\Sales\Inventory;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserSeeder::class);

        DB::table('categories')->delete();
        DB::table('products')->delete();
        DB::table('inventories')->delete();
        DB::table('roles')->delete();
        DB::table('users')->delete();
        DB::table('customers')->delete();

        Role::create([
			'name' 			=> 'Admin',
			'slug' 			=> 'admin',
			'description' 	=> 'Admin',
			'special' 		=> 'all-access'
		]);
        Role::create([
			'name'			=> 'Cliente',
			'slug'			=> 'guest',
			'description' 	=> 'Cliente'
        ]);
        
        $user = User::create([
            'name' => "Admin",
            'email' => "admin@mail.com",
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
        ]);
        
        $user->assignRoles('admin');

        factory(Category::class, 18)->create();
        factory(Product::class, 90)->create();
        factory(Inventory::class, 181)->create();
        factory(User::class, 29)->create()->each(function ($user) {
            $user->assignRoles('guest');
        });
        factory(Customer::class, 29)->create();
        factory(Billing::class, 246)->create();
        factory(BillingDetail::class, 628)->create();
    }
}
