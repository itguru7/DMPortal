<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Portal extends Model
{
    protected $table = 'portals';

    protected $primaryKey = 'id';

    protected $fillable = [
        'subdomain_id',
        'name',
        'color',
        'logo',
        'background',
        'access',
        'password',
    ];

    protected $appends = [
        'vendor',
        'link',
    ];

    protected $dates = [];

    protected $casts = [];

    public function getVendorAttribute() {
        $subdomain = DB::table('subdomains')->select('SubdomainID', 'Vendor')->where('SubdomainID', $this->subdomain_id)->first();
        $subdomain = json_decode(json_encode($subdomain), true);
        return $subdomain['Vendor'];
    }

    public function getLinkAttribute() {
        $subdomain = DB::table('subdomains')->select('SubdomainID', 'Vendor')->where('SubdomainID', $this->subdomain_id)->first();
        $subdomain = json_decode(json_encode($subdomain), true);
        return 'http://' . strtolower($subdomain['Vendor']) . '.aftermarketdata.com';
    }

}
