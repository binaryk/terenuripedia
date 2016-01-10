<div class="panel panel-default">
    <div class="log-heading">{!! HTML::image('/img/payment-blue.png', 'a picture') !!} </br> <div class="log-title">{{ trans('labels.current_balance') }}</div></div>
    <div class="panel-body">
        <table id="balanta" width="100%">
        <tbody>
        <tr>
            <th class="c2"><b>Data</b></th>
            <th class="c2"><b>Debit</b></th>
            <th class="c2"><b>Credit</b></th>
            <th class="c2"><b>Balanta</b></th>
        </tr>
        <tr>
            <th>12.12.2015</th>
            <th>10</th>
            <th></th>
            <th>57.89</th>
        </tr>
        <tr>
            <th>12.12.2015</th>
            <th>15</th>
            <th></th>
            <th>77.89</th>
        </tr>
        <tr>
            <th>12.12.2015</th>
            <th>15</th>
            <th></th>
            <th>67.89</th>
        </tr>
        <tr>
            <th>12.12.2015</th>
            <th></th>
            <th>100</th>
            <th>167.89</th>
        </tr>
        </tbody>
        </table>
            @role(config('access.roles.saller'))
                <h5> Stimate vanzator, mai aveti 0 RON </h5>
                <h4>Contul este INACTIV, puteti cumpara unul dintre urmatoarele abonamente</h4>
                @include('frontend.payment.form_subscription')
            @endauth
            @role(config('access.roles.buyer'))
                <h5> Stimate cumparator, mai aveti 15 RON </h5>
            @endauth
    </div><!--panel body-->

</div><!-- panel -->

