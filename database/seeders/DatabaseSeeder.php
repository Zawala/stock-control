<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Get the contents of the dump file
        $sql = File::get(database_path('database_dump.sql'));

        // Split the SQL statements
        $statements = explode(';', $sql);

        // Execute each statement
        foreach ($statements as $statement) {
            if (trim($statement) !== '') {
                DB::statement($statement);
            }
        }
    }
}