<?php
/**
 * Created by PhpStorm.
 * User: Ravi Bastola
 * Date: 2017-01-24
 * Time: 4:09 PM
 */
return [
            'backend_assets'=>[
                'css'               =>  'assets/backend/css/',
                'js'                =>  'assets/backend/js/',
                'default_images'     =>  'assets/backend/images/',

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
                    'site-admin'        =>  'Marcus Paul',
                    'location'          =>  'The Printworks, 14 Claremont,Hastings, East Sussex TN34 1HA',
                    'phone'             =>  '+44 1424 403000',
            ],

            'menus'                 =>[

                    'cms.rug-designs'    =>  'Rug Designs',
//                    'bespoke_rug_service'   =>  'Bespoke Rug Service',
//                    'about_us'              =>  'About Us',
//                    'contact_us'            =>  'Contact Us',
//                    'home'                  =>  'Home',
            ],

            'frontend_assets'        =>[
                    'css_path'       =>     'assets/frontend/css/',
                    'js_path'        =>     'assets/frontend/js/',
                    'test_images'    =>     'assets/frontend/images/',

                'pages'             =>[
                    'master'        =>  'frontend.layout.master',
                    'header'        =>  'frontend.includes.header',
                    'nav-bar'       =>  'frontend.includes.nav',
                    'footer'        =>  'frontend.includes.footer',
                ],
            ],
];