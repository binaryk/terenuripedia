<div class="" ng-cloak>
    <div class="half-center">
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-6">
                    {!! $controls['pay_plan'] !!}
                </div>

                @permission('broker')
                <div class="col-md-6" ng-show="selected_subscription == 2 || selected_subscription == 3">
                    {!! $controls['per'] !!}
                </div>
                @endauth

                @permissions(['proprietar','banca'])
                <div class="col-md-6" ng-show="selected_subscription == 2">
                    {!! $controls['per'] !!}
                </div>
                <div class="col-md-6" ng-show="selected_subscription == 3">
                    {!! $controls['percent'] !!}
                </div>
                @endauth
            </div>
        </div>
        <!-- <a href="" ng-click="show()" ng-if="selected_subscription">Informatii</a> -->
        <div ng-show="view_info">
            <div class="info_zone" ng-bind-html="description" >
                Nu sunt informatii deocamdata
            </div>
        </div>
    </div>
    <div class="half-center send-pass" ng-if="selected_subscription != 0 && last_variable != ''" style="margin-top: 40px;">
        <a  class="pay-btn btn btn-success" href="{!! url('profile/fonduri/efectueaza-plata/') !!}/?abonament=@{{ selected_subscription }}&@{{ last_variable }}" >Efectuati plata</a>
    </div>
</div>