<ul class="content-add">
    <li class="active"><a data-toggle="tab" href="#lista"><div class="icon-lista"></div> Anunturile mele</a></li>
    <li><a data-toggle="tab" href="#data" style="font-size: 13px; line-height: 0px;"><div class="icon-terenuri"></div> Adauga teren pe harta</a></li>
    <li><a data-toggle="tab" href="#proiect"><div class="icon-anunt"></div> Editeaza anunt</a></li>
    <li ng-if="EDIT" ><a data-toggle="tab" href="#poze"><div class="icon-anunt"></div> Poze</a></li>
    <li ng-if="EDIT || ADD" class="salvare"><a ng-click="WriteAction();$event.stopPropagation();" href=""><div class="icon-save"></div> Salveaza</a></li>
</ul>
<div class="tab-content">
    <div id="lista" class="tab-pane fade in active">
        @include('terrains.partials.tab-1')
    </div>
    <div id="data" class="tab-pane fade">
        @include('terrains.partials.tab-2')
    </div>
    <div id="proiect" class="tab-pane fade">
        @include('terrains.partials.tab-3')
    </div>
    <div id="poze" class="tab-pane fade">
        @include('terrains.partials.tab-4')
    </div>
    <div id="salvare" class="tab-pane fade">
        @include('terrains.partials.tab-5')
    </div>
</div>

