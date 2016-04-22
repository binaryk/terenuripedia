<div class="window_tab">
    <div class="window_tab1">
        @if(auth()->user() && auth()->user()->hasRole('Administrator') || $terrain->opened)
            <p class="telefon" style="color: #264165;">{!! $terrain->telefon !!}</p><i class="telefon_icon"></i>
        @else
            <p class="telefon" id="base_telefon">0721218737</p><i class="telefon_icon"></i>
        @endif
            <p class="locatie_line"><strong>Adresa: {!! $terrain->title !!}</strong></p>
        <p>Locatie: @if($terrain->id_locatie) {!! App\Models\Localitate::find($terrain->id_locatie)->localitate !!} @else '- Nu este definita -' @endif</p>

    @if(auth()->user() && !auth()->user()->hasRole('Administrator') && !$terrain->opened && auth()->user()->credit >= config('credit.pret_cumparator'))
        <span ng-click="debloc({!! $terrain->id !!})" class="deblocheaza rdeblocheaza">deblocheaza</span><i class="deblocheaza_icon rdeblocheaza"></i>
    @endif
    @if(auth()->user() && ! auth()->user()->hasRole('Administrator') && !$terrain->opened && auth()->user()->credit < config('credit.pret_cumparator') )
        <a target="_blank" href="{!! route('credit.index') !!}" class="deblocheaza">cumpara credit</a><i class="deblocheaza_icon"></i>
        <a ng-click="refresh_credit()" id="refresh"><i class="fa fa-refresh" aria-hidden="true"></i>Actualizeaza cont</a>

    @endif
    </div> 
    <div class="window_tab2">
        <p><i class="bullet"></i> Zona Rezidentiala</p>
        <p><i class="bullet"></i> Intravilan</p>
        <p><i class="bullet"></i> Suprafata: {!! \Easy\Form\StringHelper::Text($terrain->suprafata) !!} mp</p>
        <p><i class="bullet"></i> 33 euro/mp</p>
        <p><i class="bullet"></i> Drum de acces</p>
        <p class="total_price" >{!! $terrain->pret !!} euro</p>
    </div>    
</div>