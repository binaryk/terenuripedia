<div id="list" style="height: 93vh; overflow-y: auto; width:420px;float:left" ng-cloak>
    <div ng-cloak>
        <ul class="nav nav-stacked" id="accordion1" ng-if="searchTerrains.length > 0" >
            <li class="rezultat" ng-repeat="terrain in ( filtered = ( searchTerrains
                              |filter: { id_locatie: f_locatie }
                              |filter: { id_tip_teren: id_tip_teren }
                              |filter: { destinatie: destinatie }
                              |filter:byRange('pret', price.min, price.max)
                              |filter:byRange('suprafata', suprafata.min, suprafata.max)
                              ))
                              |byOwner:type_id track by $index">

                <div id="rezultate" ng-if="$index == 1">
                    <!-- Catalin aici poti sa faci acest div cu position absolute, ca sa ramana pe aceeasi pozitie la scroll. -->
                    <h5>Numarul de rezultate este:

                        <span ng-cloak>
                        @{{
                              filtered.length
                         }}
                    </span></h5>
                </div>
                <a class="title_search_link"
                   ng-class="terrain.selected ? 'active' : ''"
                   ng-click="select(terrain)" href="#@{{terrain.id}}">
                    <span class="check"></span> @{{terrain.title}}
                </a>
                <div id="@{{terrain.id}}">
                    <div class="locatie">@{{ terrain.locatie_string}}</div>
                    <div class="lower_group">
                        <div class="suprafata">@{{ terrain.suprafata}}mp</div>
                        <div class="pret">@{{ terrain.pret }} EUR/mp</div>
                        <div class="detalii">@{{ terrain.id_tip_teren }}</div>
                    </div>
                </div>

            </li>
        </ul>


        <div ng-cloak class="alert alert-info" role="info" style="margin-top: 50px !important;"
             ng-if="(searchTerrains
                              |filter: { id_locatie: f_locatie }
                              |filter: { id_tip_teren: id_tip_teren }
                              |filter: { destinatie: destinatie }
                              |filter:byRange('pret', price.min, price.max)
                              |filter:byRange('suprafata', suprafata.min, suprafata.max)
                              |byOwner:type_id).length == 0 ">
            <h6>
                Din pacate, criteriile alese nu corespund cu baza noastra de terenuri!
            </h6>
        </div>
    </div>
</div>