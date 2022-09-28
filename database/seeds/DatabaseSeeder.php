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

        $this->call(CategoryTableSeeder::class);
        $this->call(ProductTableSeeder::class);
        $this->call(OperationTableSeeder::class);
        $this->call(RecipeTableSeeder::class);
        $this->call(RecipeProductsTableSeeder::class);
        $this->call(RecipeStepsTableSeeder::class);
        $this->call(SchedulesTableSeeder::class);

        Model::reguard();
    }
}
