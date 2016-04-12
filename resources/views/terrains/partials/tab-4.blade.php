<div class="lista-label-lung">
    <div class="row">
        <div class="col-md-12" ng-if="currentTerrain.photos.length > 0">
            <div ng-repeat="photo in currentTerrain.photos track by $index" class="col-md-4">
                <img src="@{{photo.location}}" alt="Poza" width="50%"  class="photo">
            </div>
        </div>
        <div class="col-md-12" ng-if="currentTerrain.photos.length > 0 && !currentTerrain.newPhoto">
            <button class="btn btn-primary" ng-click="currentTerrain.newPhoto = true">Adaugă o poză nouă</button>
        </div>
        <br>
        <div class="col-md-12"  ng-show="currentTerrain.newPhoto || currentTerrain.photos.length == 0">
            <div>
                <input id="photos" type="file" multiple/>
            </div>
        </div>
    </div>
</div>