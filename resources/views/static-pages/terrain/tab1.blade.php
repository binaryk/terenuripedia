<div class="window_tab">
    <div class="window_tab1">
        <p class="telefon">0721218737</p><i class="telefon_icon"></i>
        <p class="locatie_line"><strong>Adresa: {!! $terrain->title !!}</strong></p>
        <p>Locatie: @if($terrain->id_locatie) {!! App\Models\Terrain::locatie()[$terrain->id_locatie] !!} @else '- Nu este definita -' @endif</p>
        <span class="deblocheaza">deblocheaza</span><i class="deblocheaza_icon"></i> 
    </div> 
    <div class="window_tab2">
        
        
        <p><i class="bullet"></i> Zona Rezidentiala</p>
        <p><i class="bullet"></i> Intravilan</p>
        <p><i class="bullet"></i> Suprafata: {!! \Easy\Form\StringHelper::Text($terrain->suprafata) !!} mp</p>
        <p><i class="bullet"></i> 33 euro/mp</p>
        <p><i class="bullet"></i> Drum de acces</p>
        <p class="total_price" >99,000 euro</p>
    </div>    
</div>