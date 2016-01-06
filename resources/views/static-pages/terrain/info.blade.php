<ul class="content-add">
    <li class="active"><a data-toggle="tab" href="#tab1"><div class="icon-lista"></div> Teren</a></li>
    <li><a data-toggle="tab" href="#tab2"><div class="icon-terenuri"></div> Contact</a></li>
</ul>
<div class="tab-content">
    <div id="tab1" class="tab-pane fade in active">
        @include('static-pages.terrain.tab1')
    </div>
    <div id="tab2" class="tab-pane fade">
        @include('static-pages.terrain.tab2')
    </div>
</div>

