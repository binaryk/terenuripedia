<div id="terrainPopUp" style="display:none">
    <ul class="nav nav-tabs">
        <h4>Teren de vanzare @{{ currentTerrain.title }}</h4>
        <li class="active"><a id="contactLink" data-toggle="tab" href="#contact">Contact</a></li>
        <li><a id="pozeLink" data-toggle="tab" href="#poze" ng-if="currentTerrain.photo != '' ">Poze</a></li>
    </ul>
    <div id="popUpContent"class="tab-content">
        <div id="contact" class="tab-pane fade in active">
            <div class="col-md-6">
            <ul class="list-group">
                <li class="list-group-item">Contact @{{ currentTerrain.telefon }}</li>
                <li class="list-group-item">Adresa @{{ currentTerrain.detalii }}</li>
            </ul>

            </div>
            <div class="col-md-6">
                <ul>
                    <li>Zona</li>
                    <li>Tip teren</li>
                    <li>@{{ currentTerrain.suprafata }}</li>s
                    <li>@{{ currentTerrain.pret }}</li>
                    <li>Drum de acces</li>
                </ul>
            </div>
        </div>

        <div id="poze" class="tab-pane fade">
                <div id="pictures" class="col-md-6">
                    <img id="terrainPicture" src="@{{config.assetBaseUrl+ '/' +currentTerrain.photo  }}" height="50px" width="50px" alt="" class="img-thumbnail">
                </div>
            <div id="info" class="col-md-6">
                <ul>
                    <li>Zona</li>
                    <li>Tip teren</li>
                    <li>@{{ currentTerrain.suprafata }}</li>s
                    <li>@{{ currentTerrain.pret }}</li>
                    <li>Drum de acces</li>
                </ul>
            </div>
        </div>
    </div>
    <input type="button" class="btn-success" id="unlockBtn" value="Deblocheaza">
</div>

