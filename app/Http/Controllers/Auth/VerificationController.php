<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\VerifiesEmails;

use App\User;

use Illuminate\Http\Request;

use Illuminate\Auth\Events\Verified;

use Illuminate\Auth\Access\AuthorizationException;


class VerificationController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Email Verification Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling email verification for any
    | user that recently registered with the application. Emails may also
    | be re-sent if the user didn't receive the original email message.
    |
    */

    use VerifiesEmails;

    /**
     * Where to redirect users after verification.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('signed')->only('verify');
        $this->middleware('throttle:6,1')->only('verify', 'resend');
    }

    /**
     * Where to redirect users after verification.
     *
     */

//     public function verify(Request $request)
// {

//     $userId = $request->route('id');
//     $user = User::findOrFail($userId);

//     if ($user->markEmailAsVerified()) {
//         event(new Verified($user));
//     }

//     return redirect($this->redirectPath())->with('verified', true);
// }

// public function verify(Request $request)
// {
//     print_r($request);exit;
//     if ($request->route('id') != $request->user()->getKey()) {
//         throw new AuthorizationException;
//     }

//     if ($request->user()->hasVerifiedEmail()) {
//         return $redirectTo = '/';
//     }

//     if ($request->user()->markEmailAsVerified()) {
//         event(new Verified($request->user()));
//     }

//     return redirect($this->redirectPath())->with('verified', true);
// }
}
