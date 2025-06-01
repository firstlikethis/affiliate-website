@extends('layouts.app')

@section('head')
    <title>500 เกิดข้อผิดพลาดในเซิร์ฟเวอร์ - {{ config('app.name') }}</title>
    <meta name="robots" content="noindex, follow">
@endsection

@section('content')
<div class="flex items-center justify-center min-h-[60vh] py-16">
    <div class="text-center px-6">
        <div class="mb-8">
            <img src="{{ asset('images/500-illustration.svg') }}" alt="Server error" class="h-64 mx-auto">
        </div>
        <h1 class="text-5xl font-bold text-gray-800 mb-4">500</h1>
        <h2 class="text-2xl font-medium text-gray-700 mb-6">ขออภัย เกิดข้อผิดพลาดในเซิร์ฟเวอร์</h2>
        <p class="text-gray-600 max-w-md mx-auto mb-8">
            เซิร์ฟเวอร์ของเรากำลังประสบปัญหา โปรดลองใหม่อีกครั้งในภายหลัง หากปัญหายังคงอยู่ โปรดติดต่อเรา
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('home') }}" class="btn-primary">
                <i class="fas fa-home mr-2"></i> กลับไปหน้าแรก
            </a>
            <a href="#" onclick="window.location.reload(); return false;" class="btn-secondary">
                <i class="fas fa-sync-alt mr-2"></i> โหลดหน้านี้ใหม่
            </a>
        </div>
    </div>
</div>

<!-- Support Contact -->
<section class="container mx-auto px-4 mt-12 mb-16">
    <div class="bg-white rounded-lg shadow-md p-8">
        <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">ต้องการความช่วยเหลือ?</h2>
        <div class="max-w-xl mx-auto">
            <p class="text-gray-600 text-center mb-8">
                หากคุณยังคงประสบปัญหาในการเข้าถึงเว็บไซต์ของเรา โปรดติดต่อทีมสนับสนุนของเราโดยใช้ช่องทางด้านล่าง
            </p>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="flex flex-col items-center p-4 bg-gray-50 rounded-lg">
                    <div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center text-purple-600 mb-3">
                        <i class="fas fa-envelope text-xl"></i>
                    </div>
                    <h3 class="font-medium mb-2">อีเมล</h3>
                    <p class="text-gray-600 text-sm text-center">support@example.com</p>
                </div>
                <div class="flex flex-col items-center p-4 bg-gray-50 rounded-lg">
                    <div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center text-purple-600 mb-3">
                        <i class="fas fa-phone-alt text-xl"></i>
                    </div>
                    <h3 class="font-medium mb-2">โทรศัพท์</h3>
                    <p class="text-gray-600 text-sm text-center">+66 123 456 789</p>
                </div>
                <div class="flex flex-col items-center p-4 bg-gray-50 rounded-lg">
                    <div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center text-purple-600 mb-3">
                        <i class="fab fa-line text-xl"></i>
                    </div>
                    <h3 class="font-medium mb-2">Line</h3>
                    <p class="text-gray-600 text-sm text-center">@example_support</p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection