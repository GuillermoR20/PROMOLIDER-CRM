<?php

namespace Database\Seeders;

use App\Models\Classified;
use App\Models\UserMembreship;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CountrySeeder::class);
        $this->call(DocumentTypeSeeder::class);
        $this->call(AccountTypeSeeder::class);
        $this->call(PaymentMethodSeeder::class);
        // $this->call(BankSeeder::class);
        // UserMembreship::factory()->create(); // se reduce la cantida de datos de pruebas
        // $this->call(UserMembreshipSeeder::class);
        // $this->call(PaymentSeeder::class);
        // $this->call(AdvertisementSeeder::class);
        // $this->call(ClassifiedSeeder::class);
        // $this->call(WalletSeeder::class);
        /*$this->call(ClassifiedSeeder::class);*/
    }
}
