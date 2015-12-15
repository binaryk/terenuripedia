<?php

use App\Models\Subscription;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon as Carbon;


class SubscriptionsTableSeeder extends Seeder {


    protected $elements = [
        [
            'name'                            => 'Abonament FREE',
            'free_post'                       => '1',
            'saller_free_view_terrain'        => '1',
            'saller_free_view_contact'        => '0',
            'saller_can_pay_for_contact'      => '1',
            'price_month'                     => '0',
            'price_year'                      => '0',
            'price_semester'                  => '0',
            'count_visible_terrain_contact'   => '0',
            'min_terrains_year'               => '0',
            'min_terrains_semester'           => '0',
            'descriptions'                    => '
                <p> 1. Proprietarul isi posteaza in mod gratuit terenul </p>
                <p> 2. Cumparatorul poate vizualiza gratuit anunturile </p>
                <p> 3. Datele de contact nu sunt vizibile </p>
                <p> 4. Cumparatorul poate debloca contactul la un anunt (contra sumei de 10 LEI) </p>
            ',
        ],
        [
            'name'                            => 'Abonament STANDARD',
            'free_post'                       => '1',
            'saller_free_view_terrain'        => '1',
            'saller_free_view_contact'        => '1',
            'saller_can_pay_for_contact'      => '1',
            'price_month'                     => '4',
            'price_year'                      => '48',
            'price_semester'                  => '32',
            'price_per_terrain'               => '48',
            'price_min_terrains_year_year'     => '432',
            'price_min_terrains_year_month'    => '36',
            'price_min_terrains_semester_year' => '240',
            'price_min_terrains_semester_month'=> '20',
            'count_visible_terrain_contact'   => '1',
            'min_terrains_year'               => '10',
            'min_terrains_semester'           => '10',
            'descriptions'                    => '
                <p> 1. Proprietarul isi posteaza in mod gratuit terenul </p>
                <p> 2. Cumparatorul poate vizualiza gratuit anunturile </p>
                <p> 3. Datele de contact sunt vizibile doar la un anunt (primul introdus in sistem)</p>
                <p> 4. Cumparatorul poate debloca contactul la un anunt (contra sumei de 10 LEI) </p>
            ',
        ],
        [
            'name'                            => 'Abonament AVANSAT',
            'free_post'                       => '1',
            'saller_free_view_terrain'        => '1',
            'saller_free_view_contact'        => '1',
            'saller_can_pay_for_contact'      => '1',
            'price_month'                     => '',
            'price_year'                      => '',
            'price_semester'                  => '',
            'price_per_terrain'               => '48',
            'price_min_terrains_year_year'     => '1920',
            'price_min_terrains_year_month'    => '160',
            'price_min_terrains_semester_year' => '1200',
            'price_min_terrains_semester_month'=> '100',
            'count_visible_terrain_contact'   => '1',
            'min_terrains_year'               => '50',
            'min_terrains_semester'           => '50',
            'descriptions'                    => '
                <p> 1. 2-5 terenuri: 5% reducere  </p>
                <p> 2. 6-10 terenuri: 10% reducere </p>
                <p> 3. 11-15 terenuri: 15% reducere </p>
                <p> 4. 16-16+ terenuri: 20% reducere </p>
                <p> 5. ex: Pachet 6-10: 48 EUR * 6 (terenuri) = 288 EUR - 10% = 259.2 EUR</p>
                <p> 6. Proprietarul isi posteaza in mod gratuit terenul </p>
                <p> 7. Cumparatorul poate vizualiza gratuit anunturile </p>
                <p> 8. Datele de contact sunt vizibile doar la un anunt (primul introdus in sistem)</p>
                <p> 9. Cumparatorul poate debloca contactul la un anunt (contra sumei de 10 LEI) </p>
            ',
        ]
    ];

    public function run() {

        if(env('DB_DRIVER') == 'mysql')
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        if(env('DB_DRIVER') == 'mysql'){
            DB::table('config_subscriptions')->truncate();
        }



        foreach($this->elements as $k => $node){
            Subscription::createRecord($node);
        }




        if(env('DB_DRIVER') == 'mysql')
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}