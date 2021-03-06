@extends('frontend.layouts.master')

@section('content')
        <div class="log-fundal">

        <div class="log">

            <div class="panel panel-default">
                <div class="log-heading">{!! HTML::image('/img/payment-blue.png', 'a picture') !!} </br> <div class="log-title">{{ trans('labels.make_pay') }}</div></div>

            <div class="panel-body user-edit">
                <div class="last-data">

                    <div class="title-box">
                        <span class="legend"><i class="icon-list"></i><center>Informații plată: EuPlatesc.ro securizata</center></span><div class="middle-border"></div>
                    </div>

                    <div  style="padding:25px" align="center">
                        <form ACTION="https://secure.euplatesc.ro/tdsprocess/tranzactd.php" METHOD="POST" name="gateway" target="_self">
                            <div class="col-md-12">
                                <p><img src="https://www.euplatesc.ro/plati-online/tdsprocess/images/progress.gif" alt="" title=""></p>
                            </div>
                            <!-- begin billing details -->
                            <div class="row">
                                <div class="pay-input">
                                    <label for="" class="control-label"> Nume </label>
                                    <input class="form-control" name="fname" type="text" value="<?php echo $dataBill['fname'];?>" />
                                </div>
                            </div>
                            <input class="form-control" name="lname" type="hidden" value="<?php echo $dataBill['lname'];?>" />
                            <input class="form-control" name="country" type="hidden" value="<?php echo $dataBill['country'];?>" />
                            <input class="form-control" name="company" type="hidden" value="<?php echo $dataBill['company'];?>" />
                            <input class="form-control" name="city" type="hidden" value="<?php echo $dataBill['city'];?>" />
                            <input class="form-control" name="add" type="hidden" value="<?php echo $dataBill['add'];?>" />
                            <div class="row">
                                <div class="pay-input">
                                    <label for="" class="control-label">Email</label>
                                    <input class="form-control" name="email" readonly="readonly" type="text" value="<?php echo $dataBill['email'];?>" />
                                </div>
                                <div class="pay-input">
                                    <div class="form-group">
                                        <label for="suma" class="control-label">Suma</label>
                                        <div class="input-group">
                                            <input class="form-control" type="text" id="suma" NAME="amount" VALUE="<?php echo  $dataAll['amount'] ?>" SIZE="12" MAXLENGTH="12" />
											<span class="input-group-addon">
											RON
											</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <input class="form-control" name="phone" type="hidden" value="<?php echo $dataBill['phone'];?>" />
                            <input class="form-control" name="fax" type="hidden" value="<?php echo $dataBill['fax'];?>" />
                            <!-- snd billing details -->
                            <!-- begin shipping details -->
                            <input class="form-control" name="sfname" type="hidden" value="<?php echo $dataShip['sfname'];?>" />
                            <input class="form-control" name="slname" type="hidden" value="<?php echo $dataShip['slname'];?>" />
                            <input class="form-control" name="scountry" type="hidden" value="<?php echo $dataShip['scountry'];?>" />
                            <input class="form-control" name="scompany" type="hidden" value="<?php echo $dataShip['scompany'];?>" />
                            <input class="form-control" name="scity" type="hidden" value="<?php echo $dataShip['scity'];?>" />
                            <input class="form-control" name="sadd" type="hidden" value="<?php echo $dataShip['sadd'];?>" />
                            <input class="form-control" name="semail" type="hidden" value="<?php echo $dataShip['semail'];?>" />
                            <input class="form-control" name="sphone" type="hidden" value="<?php echo $dataShip['sphone'];?>" />
                            <input class="form-control" name="sfax" type="hidden" value="<?php echo $dataShip['sfax'];?>" />

                            <!-- end shipping details -->

                            <input class="form-control" TYPE="hidden" NAME="curr" VALUE="<?php echo  $dataAll['curr'] ?>" SIZE="5" MAXLENGTH="3" />
                            <input class="form-control" type="hidden" NAME="invoice_id" VALUE="<?php echo  $dataAll['invoice_id'] ?>" SIZE="32" MAXLENGTH="32" />
                            <input class="form-control" type="hidden" NAME="order_desc" VALUE="<?php echo  $dataAll['order_desc'] ?>" SIZE="32" MAXLENGTH="50" />
                            <input class="form-control" TYPE="hidden" NAME="merch_id" SIZE="15" VALUE="<?php echo  $dataAll['merch_id'] ?>" />
                            <input class="form-control" TYPE="hidden" NAME="timestamp" SIZE="15" VALUE="<?php echo  $dataAll['timestamp'] ?>" />
                            <input class="form-control" TYPE="hidden" NAME="nonce" SIZE="35" VALUE="<?php echo  $dataAll['nonce'] ?>" />
                            <input class="form-control" TYPE="hidden" NAME="fp_hash" SIZE="40" VALUE="<?php echo  $dataAll['fp_hash'] ?>" />
                            @if(env('APP_ENV') == 'local')
                                <a href="#" id="simulare" class="btn btn-warning pull-left row">Simuleaza plata</a>
                            @endif
                            <a class="btn btn-confirm pull-right row" href="javascript:gateway.submit();" class="txtCheckout" style="margin-bottom:8px; margin-top:0;">Plătește acum</a>
                        </form>
                    </div>

                </div><!--panel body-->

            </div><!-- panel -->

        </div><!-- col-md-10 -->


    </div><!-- row -->
</div><!-- row -->


@endsection
@section('custom-scripts')
    <script>
        $('#simulare').on('click',function(){
            var val = $('#suma').val();
            console.log("{!! route('credit.simulare') !!}"+ '/' + val);
            location.href = "{!! url('credit-simulare') !!}"+ '/' + val;
        })
    </script>
@stop