<?php

namespace Database\Seeders;

use App\Models\Domain;
use Illuminate\Database\Seeder;

class DomainsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Domain::create([
            'name' => 'subdomain',
            'value' => 'http://192.168.0.10',
            'description' => 'Subdominio util para referenciar el dominio en el que despliega el sitio',
        ]);
    }
}
