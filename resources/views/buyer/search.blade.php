<div id="search_div" class="col-md-3">
    <div class="col-md-12">
        <label class="control-label">Preț</label>
        <div range-slider min="0" max="1000" model-min="price.min" model-max="price.max" filter="currency:'RON'" step="10"></div>
        <label for="">@{{ price.min  }}</label>
        <label for="" class="pull-right">@{{ price.max  }}</label>
    </div>
    <div class="col-md-12">
        {!!
             \Easy\Form\Combobox::make('~layouts.form.controls.comboboxes.combobox')
                        ->name('id_locatie')
                        ->caption('Locație')
                        ->ng_model('f_locatie')
                        ->class('form-control data-source input-group form-select')
                        ->controlsource('id_locatie')
                        ->controltype('combobox')
                        ->options(\App\Models\Terrain::locatie())
                        ->out()
            !!}
    </div>
    <div class="col-md-12">
        {!!
             \Easy\Form\Combobox::make('~layouts.form.controls.comboboxes.combobox')
                        ->name('type_id')
                        ->caption('Tip proprietar')
                        ->ng_model('type_id')
                        ->class('form-control data-source input-group form-select')
                        ->controlsource('type_id')
                        ->controltype('combobox')
                        ->options(['' => 'Alege'] + \App\Models\Access\User\User::type())
                        ->out()
            !!}
    </div>
    <div class="col-md-12">
        {!!
             \Easy\Form\Combobox::make('~layouts.form.controls.comboboxes.combobox')
                        ->name('id_tip_teren')
                        ->caption('Clasificare teren')
                        ->ng_model('id_tip_teren')
                        ->class('form-control data-source input-group form-select')
                        ->controlsource('id_tip_teren')
                        ->controltype('combobox')
                        ->options(\App\Models\Terrain::tip())
                        ->out()
            !!}
    </div>
    <div class="col-md-12">
        <label class="control-label">Suprafata</label>
        <div range-slider min="0" max="1000" model-min="suprafata.min" model-max="suprafata.max" filter="currency:'RON'" step="10"></div>
        <label for="">@{{ suprafata.min  }}</label>
        <label for="" class="pull-right">@{{ suprafata.max  }}</label>
    </div>

    <div class="col-md-12">
        <button class="btn btn-default" ng-click="clear()">
            Sterge criterii
        </button>
    </div>
</div>