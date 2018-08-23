<?php

use Illuminate\Database\Seeder;

class InventoryMasterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        DB::table('units')->truncate();
        DB::table('categories')->truncate();
        DB::table('items')->truncate();

        DB::table('units')->insert([
            ['id' => 1, 'name' => 'KG'],
            ['id' => 2, 'name' => 'Litre'],
            ['id' => 3, 'name' => 'Numbers'],
            ['id' => 4, 'name' => 'Persons'],
        ]);

        DB::table('categories')->insert([
            ['id' => 1, 'name' => 'Food', 'parent_id' => null],
            ['id' => 2, 'name' => 'Ready to Serve', 'parent_id' => 1],
            ['id' => 3, 'name' => 'Raw Materials', 'parent_id' => 1],
            ['id' => 4, 'name' => 'Clothing', 'parent_id' => null],
            ['id' => 5, 'name' => 'Medicine', 'parent_id' => null],
            ['id' => 6, 'name' => 'Utensils', 'parent_id' => null],
            ['id' => 7, 'name' => 'Fuel', 'parent_id' => null],
            ['id' => 8, 'name' => 'Misc', 'parent_id' => null],
        ]);

        DB::table('items')->insert([
            ['id' => 1, 'category_id' => 2, 'name' => 'Biriyani', 'unit_id' => 4, 'perishable' => true],
            ['id' => 2, 'category_id' => 2, 'name' => 'Rice and Curry', 'unit_id' => 4, 'perishable' => true],
            ['id' => 3, 'category_id' => 2, 'name' => 'Water', 'unit_id' =>2, 'perishable' => false],
            ['id' => 4, 'category_id' => 3, 'name' => 'Egg', 'unit_id' => 3, 'perishable' => true],
            ['id' => 5, 'category_id' => 3, 'name' => 'Coconut', 'unit_id' => 3, 'perishable' => false],
            ['id' => 6, 'category_id' => 7, 'name' => 'Kerosene', 'unit_id' => 2, 'perishable' => false],
        ]);

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
