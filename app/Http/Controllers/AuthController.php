<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Repositories\UserRepository\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
  
  public function __construct(
    private UserRepositoryInterface $userRepository
  ){}
  
  public function showLogin(Request $request){
    return view('auth.login');
  }
  
  public function showRegister(Request $request){
    return view('auth.register');
  }
  
  public function login(LoginRequest $request){
    $credentials = $request->validated();

    if (Auth::attempt($credentials)) {
      $request->session()->regenerate();
      
      return redirect()->route('chat');
    }
    
    return back()->withErrors([
      'email' => 'Invalid credentials'
    ])->withInput();
  }
  
  public function register(RegisterRequest $request){
    $data = $request->validated();
    
    $user = $this->userRepository->create($data);
    Auth::login($user);
    
    return redirect(route('chat'));
  }
  
  
  public function logout(Request $request)
  {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    
    return redirect(route('index'));
  }
}
