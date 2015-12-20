<?php

namespace App\Http\Controllers\Terrains;

use App\Models\Terrain;
use App\Models\TerrainCoord;
use Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;

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
                    ->ng_model('currentTerrain.id_locatie')
                    ->caption('Locație')
                    ->class('form-control data-source input-group form-select init-on-update-delete')
                    ->controlsource('id_locatie')
                    ->controltype('combobox')
//                ->value($model ? $model->id_locatie : '')
                    ->options(Terrain::locatie())
//                ->ng_repeat(' item in ' . Terrain::locatie() . ' track by $index' )
                    ->out(),
            'suprafata' =>
                \Easy\Form\Textbox::make('~layouts.form.controls.textboxes.textbox')
                    ->name('suprafata')
                    ->ng_model('currentTerrain.suprafata')
                    ->caption('Suprafața teren')
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
            'deschidere' =>
                \Easy\Form\Textbox::make('~layouts.form.controls.textboxes.textbox')
                    ->name('deschidere')
                    ->ng_model('currentTerrain.deschidere')
                    ->caption('Deschidere')
                    ->class('form-control data-source')
                    ->controlsource('deschidere')
                    ->controltype('textbox')
                    ->maxlength(255)
                    ->out(),
            'id_tip_caracteristici' =>
                \Easy\Form\Combobox::make('~layouts.form.controls.comboboxes.combobox')
                    ->name('characteristics')
                    ->ng_model('currentTerrain.id_tip_caracteristici')
                    ->multiple('multiple')
                    ->caption('Caracteristici')
                    ->class('form-control data-source input-group form-select init-on-update-delete multiple_class')
                    ->controlsource('id_tip_caracteristici')
                    ->controltype('combobox')
                    ->value($model ? $model->id_tip_caracteristici : '')
                    ->options(\App\Models\Characteristic::get())
                    ->out(),
            'pret' =>
                \Easy\Form\Textbox::make('~layouts.form.controls.textboxes.textbox')
                    ->name('pret')
                    ->ng_model('currentTerrain.Pret')
                    ->caption('Pret')
                    ->class('form-control data-source decimal')
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
                    ->name('photo')
                    ->ng_model('currentTerrain.photo')
                    ->caption('Poze')
                    ->route('')
//                    ->value($model ? $model->photo : '')
                    ->placeholder('')
                    ->controlsource('photo')
                    ->controltype('filebox')
                    ->class('form-control input-sm data-source')
                    ->out(),
        ];
    }
}