<?php

use Illuminate\Database\Seeder;
use App\Model\SiteConfig;

class SiteConfigTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $site_configs = [
            [
                'key'       =>  'site-admin',
                'value'     =>  'Marcus Paul'
            ],
            [
                'key'       =>  'email',
                'value'     =>  'test@doublarddesign.com',
            ]
        ];

        foreach ($site_configs as $key => $value)
        {
            SiteConfig::create($value);
        }
    }
}
