<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

		$this->call(CategorieTableSeeder::class);
		$this->call(ProduitTableSeeder::class);
		$this->call(RecetteTableSeeder::class);
		$this->call(RecetteProduitsTableSeeder::class);

        Model::reguard();
    }
}
