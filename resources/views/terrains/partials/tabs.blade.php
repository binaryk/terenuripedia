  <ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#lista"><i class="tab-i fa fa-list-ol"></i> Lista</a></li>
    <li><a data-toggle="tab" href="#data"><i class="tab-i fa fa-database"></i> Data</a></li>
    <li><a data-toggle="tab" href="#proiect"><i class="tab-i fa fa-cogs"></i> Proiect</a></li>
    <li class="salvare"><a ng-click="saveTerrain();$event.stopPropagation();" href=""><i class="tab-i fa fa-upload"></i>Salveaza</a></li>
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
    <div id="salvare" class="tab-pane fade">
      @include('terrains.partials.tab-4')
    </div>
  </div>

