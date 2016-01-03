<?php namespace App\Http\Controllers\Frontend\Auth;

use App\Models\Access\User\User;
use Illuminate\Http\Request;
use App\Exceptions\GeneralException;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use App\Http\Requests\Frontend\Access\LoginRequest;
use App\Http\Requests\Frontend\Access\RegisterRequest;
use App\Repositories\Frontend\Auth\AuthenticationContract;

class AuthController extends Controller
{
    use ThrottlesLogins;
    public function __construct(AuthenticationContract $auth)
    {
        $this->auth = $auth;
    }
    public function getRegister($category)
    {
        return view('frontend.auth.register')->with(compact('category'));
    }
    public function postRegister(RegisterRequest $request, $type = '')
    {
        $data = $request->all();
        $data['confirmation_code'] = md5(uniqid(mt_rand(), true));
        $data['confirmed'] = config('access.users.confirm_email') ? 0 : 1;
        $data['status'] = 1;
        if (config('access.users.confirm_email')) {
            $user = $this->auth->create($data);
            $user->attachRole(User::category()[$type]);
            return redirect()->route('home')->withFlashSuccess( trans('alerts.register.success') );
        } else {
            $user = $this->auth->create($data);
            $user->attachRole(User::category()[$type]);
            auth()->login($user);
            return redirect()->route('frontend.dashboard');
        }
    }
    public function getLogin()
    {
        return view('frontend.auth.login');
    }
    public function postLogin(LoginRequest $request)
    {
        if ($this->hasTooManyLoginAttempts($request)) {
            return $this->sendLockoutResponse($request);
        }

        try {
            $this->auth->login($request);
            if(access()->hasRole('Saller')){
                return redirect()->intended( route('terrains_index') );
            }elseif(access()->hasRole('Buyer')){
                return redirect()->intended( route('buyer.search') );
            }
           return redirect()->intended( route('frontend.dashboard') );

        } catch (GeneralException $e) {
            return redirect()->back()->withInput()->withFlashDanger( $e->getMessage() );
        }
    }
    public function getLogout()
    {
        $this->auth->logout();
        return redirect()->route('home');
    }
    public function confirmAccount($token)
    {
        //Don't know why the exception handler is not catching this
        try {
            $this->auth->confirmAccount($token);
        } catch (GeneralException $e) {
            return redirect()->back()->withInput()->withFlashDanger($e->getMessage());
        }

        return redirect()->to('auth/login')->withFlashSuccess('Your account has been successfully confirmed!');
    }

    public function resendConfirmationEmail($user_id)
    {
        //Don't know why the exception handler is not catching this
        try {
            $this->auth->resendConfirmationEmail($user_id);
            return redirect()->route('home')->withFlashSuccess('A new confirmation e-mail has been sent to the address on file.');
        } catch (GeneralException $e) {
            return redirect()->back()->withInput()->withFlashDanger($e->getMessage());
        }
    }
    public function loginPath()
    {
        return property_exists($this, 'loginPath') ? $this->loginPath : '/auth/login';
    }

    public function loginUsername()
    {
        return property_exists($this, 'username') ? $this->username : 'email';
    }
    public function preRegister()
    {
        return view('frontend.auth.preregister');
    }
}
