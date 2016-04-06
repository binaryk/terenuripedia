@if(count($terrain->photos) > 0)
    <?php $i = 0; ?>
    @foreach($terrain->photos as $k => $photo)
        @if(++$i < 4)
            <img src="{!! $photo->location !!}" alt="poza" width="200" height="200">
        @endif
    @endforeach
@else
    <div class="info warning">
        Nu sunt poze deocamdata.
    </div>
@endif