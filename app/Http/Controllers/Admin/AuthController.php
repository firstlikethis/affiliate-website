<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Show login form
     */
    public function showLogin()
    {
        // If already logged in, redirect to dashboard
        if (Auth::check() && Auth::user()->is_admin) {
            return redirect()->route('admin.dashboard');
        }
        
        return view('admin.login');
    }
    
    /**
     * Handle login request
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        
        // Attempt to authenticate
        if (Auth::attempt($credentials)) {
            // Check if user is admin
            if (Auth::user()->is_admin) {
                $request->session()->regenerate();
                
                return redirect()->intended(route('admin.dashboard'))
                    ->with('success', 'เข้าสู่ระบบสำเร็จ');
            }
            
            // If not admin, logout and redirect with error
            Auth::logout();
            
            return back()->withErrors([
                'email' => 'คุณไม่มีสิทธิ์เข้าถึงส่วนนี้',
            ]);
        }
        
        // Authentication failed
        return back()->withErrors([
            'email' => 'ข้อมูลที่คุณกรอกไม่ถูกต้อง',
        ])->onlyInput('email');
    }
    
    /**
     * Handle logout request
     */
    public function logout(Request $request)
    {
        Auth::logout();
        
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect()->route('admin.login')
            ->with('success', 'ออกจากระบบสำเร็จ');
    }
}