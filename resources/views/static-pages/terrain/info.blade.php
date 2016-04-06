<ul class="content-add">
    <li class="active"><a data-toggle="tab" href="#tab1"><div class="icon-lista"></div> Teren</a></li>
    <li><a data-toggle="tab" href="#tab2"><div class="icon-terenuri"></div> Contact</a></li>
    <li><a data-toggle="tab" href="#tab3"><div class="icon-terenuri"></div> Poze</a></li>
</ul>
<div class="tab-content" id="info_tab">
    <div id="tab1" class="tab-pane fade in active">
        @include('static-pages.terrain.tab1')
    </div>
    <div id="tab2" class="tab-pane fade">
        @include('static-pages.terrain.tab2')
    </div>
    <div id="tab3" class="tab-pane fade">
        @include('static-pages.terrain.tab3')
    </div>
</div>