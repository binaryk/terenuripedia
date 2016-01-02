<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\General;
use App\Models\Subscription;
use App\Repositories\Frontend\User\UserContract;
use App\Http\Requests\Frontend\User\UpdateProfileRequest;
use App\Http\Controllers\Frontend\Payment\PaymentController;
use App\Http\Controllers\Frontend\Payment\PayReplayController;
/**
 * Class FondsController
 * @package App\Http\Controllers\Frontend
 */
class FondsController extends Controller
{
    /**
     * @return mixed
     */
    public function index()
    {
        return view('frontend.user.fonds.index')
            ->withUser(auth()->user());
    }

    public function current_balance()
    {
        $user     = auth()->user();
        $controls = $this->controls();
        return view('frontend.payment.current_balance')
            ->with(compact('user','controls'));
    }

    public function abonamente()
    {
        $user     = auth()->user();
        $controls = $this->controls();
        return view('frontend.payment.abonamente')
            ->with(compact('user','controls'));
    }

    public function subscriptions()
    {
        return Subscription::all();
    }

    public function controls($model = null)
    {
        return [
            'pay_plan' =>
                \Easy\Form\Combobox::make('~layouts.form.controls.comboboxes.combobox')
                    ->name('pay_plan')
                    ->caption('Selectati un abonament')
                    ->ng_model('selected_subscription')
                    ->ng_change('updateInfo(selected_subscription)')
                    ->ng_init("selected_subscription='0'")
                    ->class('form-control data-source input-group form-select init-on-update-delete input-abonament')
                    ->controlsource('pay_plan')
                    ->controltype('combobox')
                    ->value($model ? $model->pay_plan : '')
                    ->options(Subscription::toCombobox())
                    ->out(),
            'percent' =>
                \Easy\Form\Combobox::make('~layouts.form.controls.comboboxes.combobox')
                    ->name('percent')
                    ->caption('Selectati un interval')
                    ->ng_model('selected_percent')
                    ->ng_change('updatePercent(selected_percent)')
                    ->ng_init("selected_percent='0'")
                    ->class('form-control data-source input-group form-select init-on-update-delete input-abonament')
                    ->controlsource('percent')
                    ->controltype('combobox')
                    ->value($model ? $model->selected_percent : '')
                    ->options(General::percent())
                    ->out(),
            'per' =>
                \Easy\Form\Combobox::make('~layouts.form.controls.comboboxes.combobox')
                    ->name('per')
                    ->caption('Abonament platit pe:')
                    ->ng_model('selected_per')
                    ->ng_change('updatePer(selected_per)')
                    ->ng_init("selected_per='0'")
                    ->class('form-control data-source input-group form-select init-on-update-delete input-abonament')
                    ->controlsource('per')
                    ->controltype('combobox')
                    ->value($model ? $model->selected_per : '')
                    ->options(General::per())
                    ->out(),
        ];
    }


}
