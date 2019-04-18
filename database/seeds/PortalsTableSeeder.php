<?php

use Illuminate\Database\Seeder;

class PortalsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $subdomains = DB::table('subdomains')->select('SubdomainID', 'Vendor')->get();
        $subdomains = json_decode(json_encode($subdomains), true);
        foreach ($subdomains as $subdomain) {
            DB::table('portals')->insert([
                'subdomain_id' => $subdomain['SubdomainID'],
                'name' => strtolower($subdomain['Vendor']),
                'title' => ucfirst($subdomain['Vendor']),
            ]);
        }
    }
}
