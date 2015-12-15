<div class="col-md-12">
	<span class="btn btn-sm btn-default" ng-click="add_()">Adaugă teren</span>
</div>
<div class="col-md-12">
	<label class="control-label">Titlu teren</label>
	<input type="text" class="form-control" ng-model="f_title">
</div>
<div class="col-md-12" style="margin-top: 30px;">
	<table class="table table-bordered" ng-if="terrains.length > 0" style="background: white;">
		<thead>
			<tr>
				<th>Nume</th>
				<th>Preț</th>
				<th>Suprafață</th>
				<th>Editare</th>
				<th>Șterge</th>
			</tr>
		</thead>
		<tbody>
			<tr ng-repeat="terrain in terrains | filter: { title: f_title}">
				<td >@{{ terrain.title }}</td>
				<td>@{{ terrain.pret }}</td>
				<td>@{{ terrain.suprafata }}</td>
				<td style="cursor: pointer;" ng-click="editTerrain(terrain)"><a href="" class="btn btn-sm"><i class="fa fa-info" title="Click pentru a vedea mai multe detalii"></i></a> </td>
				<td ng-click="deleteTerrain(terrain)"><a href="" class="btn btn-sm"><i class="fa fa-remove" title="Click pentru a vedea mai multe detalii"></i></a></td>
			</tr>
		</tbody>
	</table>

	<div class="alert alert-info" role="info" ng-if="terrains.length == 0">
		<h6>
		    Încă nu sunt terenuri salvate!
		</h6>
	</div>
</div>