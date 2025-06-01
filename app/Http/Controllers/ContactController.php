<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class ContactController extends Controller
{
    /**
     * Show the contact page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get all categories for menu
        $categories = Category::all();
        
        // Set SEO meta tags
        $metaTags = [
            'title' => 'ติดต่อเรา - ' . config('app.name'),
            'description' => 'ติดต่อทีมงาน ' . config('app.name') . ' หากคุณมีข้อสงสัยหรือต้องการความช่วยเหลือเกี่ยวกับสินค้าและบริการของเรา',
            'canonical' => url()->current(),
            'og_type' => 'website',
        ];
        
        return view('contact.index', compact('categories', 'metaTags'));
    }
    
    /**
     * Handle the contact form submission.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate form data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:1000',
        ], [
            'name.required' => 'กรุณาระบุชื่อของคุณ',
            'email.required' => 'กรุณาระบุอีเมลของคุณ',
            'email.email' => 'รูปแบบอีเมลไม่ถูกต้อง',
            'subject.required' => 'กรุณาระบุหัวข้อ',
            'message.required' => 'กรุณาระบุข้อความ',
        ]);
        
        // TODO: Send email notification
        // In a real application, you would send an email here
        // For now, we'll just redirect with a success message
        
        return redirect()->route('contact.index')->with('success', 'ขอบคุณสำหรับการติดต่อ เราจะตอบกลับคุณโดยเร็วที่สุด');
    }
}