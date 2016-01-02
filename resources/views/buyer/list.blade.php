<div class="col-md-3" ng-cloak>
    <div class="col-md-12" style="margin-top: 30px; height: 70vh; overflow-y: scroll;" ng-cloak>
        <ul class="nav nav-stacked" id="accordion1" ng-if="searchTerrains.length > 0" >
            <li class="panel" ng-repeat="terrain in searchTerrains
                              |filter: { id_locatie: f_locatie }
                              |filter: { id_tip_teren: id_tip_teren }
                              |filter:byRange('pret', price.min, price.max)
                              |filter:byRange('suprafata', suprafata.min, suprafata.max)
                              |byOwner:type_id
                              track by $index "
                    ng-click="select(terrain)"
                    >
                <div ng-if="$index == 1">
                    <!-- Catalin aici poti sa faci acest div cu position absolute, ca sa ramana pe aceeasi pozitie la scroll. -->
                    <h5>Numarul de rezultate este:
                        <span ng-cloak>
                        @{{
                              (searchTerrains
                              |filter: { id_locatie: f_locatie }
                              |filter: { id_tip_teren: id_tip_teren }
                              |filter:byRange('pret', price.min, price.max)
                              |filter:byRange('suprafata', suprafata.min, suprafata.max)
                              |byOwner:type_id).length
                         }}
                    </span></h5>
                </div>
                <a data-toggle="collapse" data-parent="#accordion1" href="#@{{terrain.id}}">
                    @{{terrain.title}}</a>
                <ul id="@{{terrain.id}}" class="collapse">
                    <li>@{{ terrain.locatie_string}}mp</li>
                    <li>@{{ terrain.suprafata}}mp</li>
                    <li>@{{ terrain.pret }} EUR/mp</li>
                    <li>@{{ terrain.detalii }}</li>
                </ul>

            </li>
        </ul>

        <div class="alert alert-info" role="info" ng-if="terrains.length == 0">
            <h6>
                Încă nu sunt terenuri salvate!
            </h6>
        </div>
    </div>
</div>