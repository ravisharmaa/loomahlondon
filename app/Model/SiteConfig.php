<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class SiteConfig extends Model
{
    protected $table        =   'site_configs';
    protected $fillable     =   ['id','key','value'];
}
