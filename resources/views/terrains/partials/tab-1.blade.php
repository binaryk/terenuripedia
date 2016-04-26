<div class="lista">
<div class="col-md-12 pre-grid">
    <div class="cautare">
       <label class="lista-label lista-label-cautare"><div class="icon-cautari"></div></label>
       <input type="text" class="form-lista-cautare" ng-model="f_title">
    </div>
        <a ng-click="add()" class="btn btn-add pull-right" href="" ng-if="mc.credit > 18.1"><i class="fa fa-plus"></i> Adauga teren</a>
    	<div ng-if="mc.credit < 18.1" class="row">
			<p class="alert alert-warning">Atentie, nu mai aveti credit.</p>
			<a href="{!! url('credit') !!}" class="btn btn-add pull-right" href=""><i class="fa fa-plus"></i> Cumpara credit</a>
		</div>
</div>
<div class="col-md-12 grid-terrains" style="margin-top: 30px;">
	<div ng-if="terrains.length > 0" style="background: white;">
			<div class="terrain" ng-repeat="terrain in terrains | filter: { title: f_title} track by $index ">
              <div class="item-teren">    
                  <div class="small-box-c1" style="cursor: pointer;"
					   ng-click="edit(terrain)"><a href="" class=""><div class="icon-edit"></div><span class="sup">
							 @{{ $index + 1  }}. @{{ terrain.title }}</span></a> </div>
                <div class="sup-lista small-box-zona">@{{ terrain.localitate.localitate }}</div>
				<div class="sup-lista small-box-pret">@{{ terrain.pret }} EURO</div>
				<div class="sup-lista small-box-mp">@{{ terrain.suprafata}}mp</div>
              </div>  
				<div class="small-box-delete" ng-click="deleteTerrain(terrain)"><a href="" class="btn btn-sm"><div class="icon-delete"></div><span class="sup">Sterge</span></a></div>
			</div>
	</div>

	<div class="alert alert-info" role="info" ng-if="terrains.length == 0">
		<h6>
		    Încă nu sunt terenuri salvate!
		</h6>
	</div>
</div>
</div>