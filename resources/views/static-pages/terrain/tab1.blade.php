<p>Nume: {!! $terrain->title !!}</p>
<p>Pret: {!! \Easy\Form\StringHelper::Text($terrain->pret) !!}</p>
<p>Suprafata: {!! \Easy\Form\StringHelper::Text($terrain->suprafata) !!} mp</p>
<p>Locatie: @if($terrain->id_locatie) {!! App\Models\Terrain::locatie()[$terrain->id_locatie] !!} @else '- Nu este definita -' @endif</p>
