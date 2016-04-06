  <ul class="content-add">
    <li class="active"><a data-toggle="tab" href="#lista"><div class="icon-lista"></div> Anunturi</a></li>
    <li><a data-toggle="tab" href="#data"><div class="icon-terenuri"></div> Teren</a></li>
    <li><a data-toggle="tab" href="#proiect"><div class="icon-anunt"></div> Detalii</a></li>
    <li ng-if="EDIT" ><a data-toggle="tab" href="#poze"><div class="icon-anunt"></div> Photo</a></li>
    <li class="salvare"><a ng-click="WriteAction();$event.stopPropagation();" href=""><div class="icon-save"></div> Salveaza</a></li>
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

