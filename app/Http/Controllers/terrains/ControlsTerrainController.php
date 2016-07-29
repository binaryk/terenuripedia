<?php

namespace App\Http\Controllers\Terrains;

use App\Models\Localitate;
use App\Models\Terrain;
use App\Models\TerrainCoord;
use Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;
use stdClass;

class ControlsTerrainController extends Controller
{
    protected $model = NULL;
    public function __construct(){
        parent::__construct();
    }

    public function controls( $model = NULL){

        if(! $model){
            $model = $this->model;
        }
        $extraData = [];
        $extraData[0] = [
            'key' => 'terrain_id',
            'value' => "$('#inserted_terrain').val()",
            'clean' => "$('#inserted_terrain').val('-1')"];
        return [
            'title' =>
                \Easy\Form\Textbox::make('~layouts.form.controls.textboxes.textbox')
                    ->name('title')
                    ->ng_model('currentTerrain.title')
                    ->caption('Titlu anunț')
                    ->class('form-control data-source')
                    ->controlsource('title')
                    ->controltype('textbox')
                    ->maxlength(255)
                    ->out(),
            'id_locatie' =>
                \Easy\Form\Combobox::make('~layouts.form.controls.comboboxes.combobox')
                    ->name('id_locatie')
//                    ->ng_model('currentTerrain.localitate.localitate')
                    ->caption('Locație')
                    ->class('form-control data-source input-group form-select init-on-update-delete')
                    ->controlsource('id_locatie')
                    ->controltype('combobox')
                    ->value($model ? $model->id_locatie : '')
                    ->options([])
//                ->ng_repeat(' item in ' . Terrain::locatie() . ' track by $index' )
                    ->out($model ? [$model->id_locatie => Localitate::find($model->id_locatie) ? Localitate::find($model->id_locatie)->localitate : ''] : []),
            'suprafata' =>
                \Easy\Form\Textbox::make('~layouts.form.controls.textboxes.textbox')
                    ->name('suprafata')
                    ->ng_model('currentTerrain.suprafata')
                    ->caption('Suprafața teren (mp)')
                    ->class('form-control data-source decimal')
                    ->controlsource('suprafata')
                    ->controltype('textbox')
                    ->maxlength(255)
                    ->out(),
            'id_tip_teren' =>
                \Easy\Form\Combobox::make('~layouts.form.controls.comboboxes.combobox')
                    ->name('id_tip_teren')
                    ->ng_model('currentTerrain.id_tip_teren')
                    ->caption('Tip teren')
                    ->class('form-control data-source input-group form-select init-on-update-delete')
                    ->controlsource('id_tip_teren')
                    ->controltype('combobox')
                    ->value($model ? $model->id_tip_teren : '')
                    ->options(Terrain::tip())
                    ->out(),
            'destinatie' =>
                \Easy\Form\Combobox::make('~layouts.form.controls.comboboxes.combobox')
                    ->name('destinatie')
                    ->ng_model('currentTerrain.destinatie')
                    ->caption('Destinatie teren')
                    ->class('form-control data-source input-group form-select init-on-update-delete')
                    ->controlsource('destinatie')
                    ->controltype('combobox')
                    ->value($model ? $model->destinatie : '')
                    ->options(Terrain::destinatie())
                    ->out(),
            'front_stradal' =>
                \Easy\Form\Combobox::make('~layouts.form.controls.comboboxes.combobox')
                    ->name('front_stradal')
                    ->ng_model('currentTerrain.front_stradal')
                    ->title('Frontul stradal este latura terenului paralel cu calea de acces.')
                    ->caption('Front stradal (?)')
                    ->class('form-control data-source input-group form-select init-on-update-delete')
                    ->controlsource('front_stradal')
                    ->controltype('combobox')
                    ->value($model ? $model->front_stradal : '')
                    ->options(Terrain::front())
                    ->out(),
            'deschidere' =>
                \Easy\Form\Textbox::make('~layouts.form.controls.textboxes.textbox')
                    ->name('deschidere')
                    ->ng_model('currentTerrain.deschidere')
                    ->caption('Deschidere teren (m) (?)')
                    ->title('Deschiderea terenului reprezinta lungimea laturii terenului aliniata cu calea de acces.')
                    ->class('form-control data-source decimal')
                    ->controlsource('deschidere')
                    ->controltype('textbox')
                    ->maxlength(255)
                    ->out(),
            'pot' =>
                \Easy\Form\Textbox::make('~layouts.form.controls.textboxes.textbox')
                    ->name('pot')
                    ->ng_model('currentTerrain.pot')
                    ->caption('POT (%) (?)')
                    ->title('Procentul de ocupare al terenului.')
                    ->class('form-control data-source decimal')
                    ->controlsource('pot')
                    ->controltype('textbox')
                    ->maxlength(255)
                    ->out(),
            'cut' =>
                \Easy\Form\Textbox::make('~layouts.form.controls.textboxes.textbox')
                    ->name('cut')
                    ->ng_model('currentTerrain.cut')
                    ->caption('CUT (%) (?)')
                    ->title('Coeficientul de utilizare al terenului.')
                    ->class('form-control data-source decimal')
                    ->controlsource('cut')
                    ->controltype('textbox')
                    ->maxlength(255)
                    ->out(),
            'id_tip_caracteristici' =>
                \Easy\Form\Combobox::make('~layouts.form.controls.comboboxes.combobox')
                    ->name('characteristics')
                    ->ng_model('currentTerrain.id_tip_caracteristici')
                    ->multiple('multiple')
                    ->caption('Caracteristici (?)')
                    ->title('Text ajutor')
                    ->class('form-control data-source input-group form-select init-on-update-delete multiple_class')
                    ->controlsource('id_tip_caracteristici')
                    ->controltype('combobox')
                    ->value($model ? $model->id_tip_caracteristici : '')
                    ->options(\App\Models\Characteristic::get())
                    ->out(),
            'pret' =>
                \Easy\Form\Textbox::make('~layouts.form.controls.textboxes.textbox')
                    ->name('pret')
                    ->ng_model('currentTerrain.pret')
                    ->caption('Pret')
                    ->class('form-control data-source decimal pret')
                    ->controlsource('pret')
                    ->controltype('textbox')
                    ->maxlength(255)
                    ->out(),
            'telefon' =>
                \Easy\Form\Textbox::make('~layouts.form.controls.textboxes.textbox')
                    ->name('telefon')
                    ->ng_model('currentTerrain.telefon')
                    ->caption('Telefon')
                    ->class('form-control data-source')
                    ->controlsource('telefon')
                    ->controltype('textbox')
                    ->maxlength(255)
                    ->out(),
            'pret_mp' =>
                \Easy\Form\Textbox::make('~layouts.form.controls.textboxes.textbox')
                    ->name('pret_mp')
                    ->ng_model('currentTerrain.pret_mp')
                    ->caption('Pret Euro/mp')
                    ->class('form-control decimal'/*data-source*/)
                    ->controlsource('pret_mp')
                    ->controltype('textbox')
                    ->readonly(true)
                    ->maxlength(255)
                    ->out(),
            'proprietar' =>
                \Easy\Form\Textbox::make('~layouts.form.controls.textboxes.textbox')
                    ->name('proprietar')
                    ->ng_model('currentTerrain.proprietar')
                    ->caption('Nume proprietar')
                    ->class('form-control data-source')
                    ->controlsource('proprietar')
                    ->controltype('textbox')
                    ->maxlength(255)
                    ->out(),
            'negociabil' =>
                \Easy\Form\Combobox::make('~layouts.form.controls.comboboxes.combobox')
                    ->name('negociabil')
                    ->ng_model('currentTerrain.negociabil')
                    ->caption('Negociabil')
                    ->class('form-control data-source input-group form-select init-on-update-delete')
                    ->controlsource('negociabil')
                    ->controltype('combobox')
                    ->value($model ? $model->negociabil : '')
                    ->options(['0' => '--Alege--', '1' => 'Da' ,'2' => 'Nu'])
                    ->out(),
            'detalii' =>
                \Easy\Form\Editbox::make('~layouts.form.controls.editboxes.editbox')
                    ->name('detalii')
                    ->ng_model('currentTerrain.detalii')
                    ->caption('Detalii suplimentare')
                    ->value($model ? $model->detalii : '')
                    ->placeholder('')
                    ->controlsource('detalii')
                    ->controltype('editbox')
                    ->class('form-control input-sm data-source')
                    ->out(),
            'front_stradal_1' =>
                \Easy\Form\Textbox::make('~layouts.form.controls.radioboxes.radiobutton')
                    ->name('front_stradal')
                    ->ng_model('currentTerrain.front_stradal')
                    ->caption('Nu are front stradal')
                    ->id('front_stradal_1')
                    ->ng_model('front_stradal')
                    ->class('data-source')
                    ->controlsource('front_stradal')
                    ->value(1)
                    ->controltype('radiobox')
                    ->maxlength(255)
                    ->out(),
            'front_stradal_2' =>
                \Easy\Form\Textbox::make('~layouts.form.controls.radioboxes.radiobutton')
                    ->name('front_stradal')
                    ->ng_model('currentTerrain.front_stradal')
                    ->caption('Are front stradal')
                    ->id('front_stradal_2')
                    ->ng_model('front_stradal')
                    ->ng_init($model ? 'front_stradal = "'.$model->front_stradal . '"' : '')
                    ->class('data-source')
                    ->controlsource('front_stradal')
                    ->value(2)
                    ->controltype('radiobox')
                    ->out(),
            'nr_fronturi' =>
                \Easy\Form\Textbox::make('~layouts.form.controls.textboxes.textbox')
                    ->name('nr_fronturi')
                    ->ng_model('currentTerrain.nr_fronturi')
                    ->caption('Numar fronturi')
                    ->class('form-control data-source integer')
                    ->controlsource('nr_fronturi')
                    ->controltype('textbox')
                    ->maxlength(255)
                    ->out(),
            'latime_drum_acces' =>
                \Easy\Form\Textbox::make('~layouts.form.controls.textboxes.textbox')
                    ->name('latime_drum_acces')
                    ->ng_model('currentTerrain.latime_drum_acces')
                    ->caption('Latime drum acces')
                    ->class('form-control data-source decimal')
                    ->controlsource('latime_drum_acces')
                    ->controltype('textbox')
                    ->maxlength(255)
                    ->out(),
            'constructie_teren' =>
                \Easy\Form\Textbox::make('~layouts.form.controls.textboxes.textbox')
                    ->name('constructie_teren')
                    ->ng_model('currentTerrain.constructie_teren')
                    ->caption('Constructie teren')
                    ->class('form-control data-source')
                    ->controlsource('constructie_teren')
                    ->controltype('textbox')
                    ->maxlength(255)
                    ->out(),
            'detalii_2' =>
                \Easy\Form\Editbox::make('~layouts.form.controls.editboxes.editbox')
                    ->name('detalii_2')
                    ->ng_model('currentTerrain.detalii_2')
                    ->caption('Detalii suplimentare')
                    ->value($model ? $model->detalii_2 : '')
                    ->placeholder('')
                    ->controlsource('detalii_2')
                    ->controltype('editbox')
                    ->class('form-control input-sm data-source')
                    ->out(),
            'photo' =>
                \Easy\Form\Editbox::make('~layouts.form.controls.fileboxes.imagebox')
                    ->name('file_document')
                    ->ng_model('currentTerrain.photo')
                    ->caption('Poze')
                    ->route('')
                    ->value($model ? $model->photo : '')
                    ->scripts([
                        'packages/fileinput/js/fileinput.min.js'
                    ])
                    ->styles([
                        'admin/css/fileinput/fileinput.css',
                        'packages\fileinput\css\fileinput.min.css'
                    ])
                    ->route('terrain.photo')
                    ->extraData($extraData)
                    ->controlsource('photo')
                    ->controltype('filebox')
                    ->class('form-control input-sm data-source')
                    ->out(),
        ];
    }
}