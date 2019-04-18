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
        'title',
        'color',
        'logo',
        'background',
        'access',
        'password',
    ];

    protected $appends = [
        'vendor',
        'link',
        'asset',
        'logo_url',
        'background_url',
    ];

    protected $dates = [];

    protected $casts = [];

    public function vendor() {
        $subdomain = DB::table('subdomains')->select('SubdomainID', 'Vendor')->where('SubdomainID', $this->subdomain_id)->first();
        $subdomain = json_decode(json_encode($subdomain), true);
        return strtolower($subdomain['Vendor']);
    }
    public function link() {
        return 'http://' . $this->vendor . '.aftermarketdata.com';
    }
    public function asset() {
        return '/assets/' . $this->vendor . '/';
    }

    public function getVendorAttribute() {
        return $this->vendor();
    }
    public function getLinkAttribute() {
        return $this->link();
    }
    public function getAssetAttribute() {
        return $this->asset();
    }
    public function getLogoUrlAttribute() {
        return $this->logo ? $this->asset() . $this->logo : '';
    }
    public function getBackgroundUrlAttribute() {
        return $this->background ? $this->asset() . $this->background : '';
    }
}
