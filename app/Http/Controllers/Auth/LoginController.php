<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Kreait\Firebase\Auth as FirebaseAuth;
use Kreait\Firebase\Database;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Auth\SignInResult\SignInResult;
use Kreait\Firebase\Exception\FirebaseException;
use Kreait\Firebase\Exception\RequestException;
use Illuminate\Validation\ValidationException;
use Auth;
use Session;
use App\Models\User;

class LoginController extends Controller
{
   /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

   use AuthenticatesUsers;

   /**
    * Where to redirect users after login.
    *
    * @var string
    */
   protected $auth;
   protected $redirectTo = RouteServiceProvider::HOME;
   protected $redirectToMang = RouteServiceProvider::MANG_HOME;

   /**
    * Create a new controller instance.
    *
    * @return void
    */
   public function __construct(FirebaseAuth $auth, Database $database)
   {
      $this->middleware('guest')->except('logout');
      $this->auth = $auth;

      $factory = (new Factory)
         ->withServiceAccount(__DIR__ . '/rmg-project-9e4cf-firebase-adminsdk-ic8no-988a1cf17b.json')
         ->withDatabaseUri('https://rmg-project-9e4cf-default-rtdb.europe-west1.firebasedatabase.app');

      $this->database = $database;
      $this->auth = $factory->createAuth();
      $this->tablename = 'usersWeb';
   }
   protected function login(Request $request)
   {
     
      try {
         
            
        
       
         // $privilige [] = $this->database->getReference($this->tablename)->orderByChild('email')->equalTo($request['email'])->getSnapshot()->getValue();
         // print($privilige);
        
         
         // $ = $request->role;
         // if ($request['privilige'] == 'admin' && $request->role == 'admin') {
         if ($request['privilige'] == 'admin') {
            $signInResult = $this->auth->signInWithEmailAndPassword($request['email'], $request['password']);
            $user = new User($signInResult->data());

            $loginMail = $request['email'];
            //uid Session
            $loginuid = $signInResult->firebaseUserId();
            Session::put('uid', $loginuid);
            Session::put('currentMail', $loginMail);

            $result = Auth::login($user);
            return redirect($this->redirectPath());
         } 
         // elseif ($request['privilige'] == 'manager' && $request->role == 'manager') {
            elseif ($request['privivlige'] == 'manager') {
            $signInResult = $this->auth->signInWithEmailAndPassword($request['email'], $request['password']);
            $user = new User($signInResult->data());

            $loginMail = $request['email'];
            //uid Session
            $loginuid = $signInResult->firebaseUserId();
            Session::put('uid', $loginuid);
            Session::put('currentMail', $loginMail);

            $result = Auth::login($user);
            return redirect($this->redirectPathToMang());
         }
         else{
            //  throw ValidationException::withMessages([$this->username() => [trans('auth.failed')],]);

            print("Error");
         }
      } catch (FirebaseException $e) {
         //  throw ValidationException::withMessages([$this->username() => [trans('auth.failed')],]);
            var_dump($e);
      }
   }
   public function username()
   {
      return 'email';
   }
   public function handleCallback(Request $request, $provider)
   {
      $socialTokenId = $request->input('social-login-tokenId', '');
      try {
         $verifiedIdToken = $this->auth->verifyIdToken($socialTokenId);
         $user = new User();
         $user->displayName = $verifiedIdToken->getClaim('name');
         $user->email = $verifiedIdToken->getClaim('email');
         $user->localId = $verifiedIdToken->getClaim('user_id');
         Auth::login($user);
         return redirect($this->redirectPath());
      } catch (\InvalidArgumentException $e) {
         return redirect()->route('login');
      } catch (InvalidToken $e) {
         return redirect()->route('login');
      }
   }
}
