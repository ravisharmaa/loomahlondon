<?php
/**
 * Created by PhpStorm.
 * User: Ravi Bastola
 * Date: 2017-01-24
 * Time: 4:09 PM
 */
return [
            'backend_assets'=>[
                'css'   =>  'assets/backend/css/',
                'js'    =>  'assets/backend/js/',

                'pages'         =>  [
                    'navbar'    =>  'cms.includes.navbar',
                    'header'    =>  'cms.includes.header',
                    'footer'    =>  'cms.includes.footer',
                ],

                'upload_locs'     =>  [
                    'upload_folder' =>  'images/',
                ],
            ],

            'site-configs'          =>  [
                    'pagination_limit'  =>  10,
                    'site-admin'        =>  'Marcus Doublard',
            ],
];