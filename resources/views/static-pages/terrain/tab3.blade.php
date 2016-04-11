
<div class="window_tab">
    <div class="window_tab1">
        @if(count($terrain->photos) > 0)
    <?php $i = 0; ?>
    @foreach($terrain->photos as $k => $photo)
        @if(++$i < 4)
            <img src="{!! $photo->location !!}" alt="poza" width="200" height="200">
        @endif
    @endforeach
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
@else
    <div class="info warning">
        Nu sunt poze deocamdata.
    </div>
@endif