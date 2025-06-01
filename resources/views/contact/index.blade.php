@extends('layouts.app')

@section('content')
    <!-- Contact Header -->
    <section class="bg-gradient-to-r from-purple-600 to-purple-800 py-12">
        <div class="container mx-auto px-4 text-center">
            <h1 class="text-3xl md:text-4xl font-bold text-white mb-4">ติดต่อเรา</h1>
            <p class="text-lg text-purple-100 max-w-2xl mx-auto">
                มีคำถามหรือข้อสงสัย? ทีมงานของเราพร้อมช่วยเหลือคุณ ติดต่อเราได้ตลอดเวลา
            </p>
        </div>
    </section>

    <!-- Breadcrumbs -->
    <section class="container mx-auto px-4 py-4">
        <div class="flex items-center text-sm text-gray-600">
            <a href="{{ route('home') }}" class="hover:text-purple-600">หน้าแรก</a>
            <span class="mx-2">/</span>
            <span class="text-gray-900 font-medium">ติดต่อเรา</span>
        </div>
    </section>

    <!-- Contact Information and Form -->
    <section class="container mx-auto px-4 py-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Contact Information -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h2 class="text-xl font-bold text-gray-800 mb-6">ข้อมูลติดต่อ</h2>
                    
                    <div class="space-y-6">
                        <div class="flex items-start">
                            <div class="bg-purple-100 rounded-full p-3 mr-4">
                                <i class="fas fa-map-marker-alt text-purple-600"></i>
                            </div>
                            <div>
                                <h3 class="font-medium text-gray-800 mb-1">ที่อยู่</h3>
                                <p class="text-gray-600">
                                    123 ถนนสุขุมวิท<br>
                                    แขวงคลองตันเหนือ เขตวัฒนา<br>
                                    กรุงเทพมหานคร 10110
                                </p>
                            </div>
                        </div>
                        
                        <div class="flex items-start">
                            <div class="bg-purple-100 rounded-full p-3 mr-4">
                                <i class="fas fa-envelope text-purple-600"></i>
                            </div>
                            <div>
                                <h3 class="font-medium text-gray-800 mb-1">อีเมล</h3>
                                <p class="text-gray-600">
                                    <a href="mailto:contact@example.com" class="hover:text-purple-600">contact@example.com</a><br>
                                    <a href="mailto:support@example.com" class="hover:text-purple-600">support@example.com</a>
                                </p>
                            </div>
                        </div>
                        
                        <div class="flex items-start">
                            <div class="bg-purple-100 rounded-full p-3 mr-4">
                                <i class="fas fa-phone-alt text-purple-600"></i>
                            </div>
                            <div>
                                <h3 class="font-medium text-gray-800 mb-1">เบอร์โทรศัพท์</h3>
                                <p class="text-gray-600">
                                    <a href="tel:+66123456789" class="hover:text-purple-600">+66 123 456 789</a><br>
                                    <a href="tel:+66987654321" class="hover:text-purple-600">+66 987 654 321</a>
                                </p>
                            </div>
                        </div>
                        
                        <div class="flex items-start">
                            <div class="bg-purple-100 rounded-full p-3 mr-4">
                                <i class="far fa-clock text-purple-600"></i>
                            </div>
                            <div>
                                <h3 class="font-medium text-gray-800 mb-1">เวลาทำการ</h3>
                                <p class="text-gray-600">
                                    จันทร์ - ศุกร์: 9:00 - 18:00 น.<br>
                                    เสาร์: 9:00 - 15:00 น.<br>
                                    อาทิตย์: ปิดทำการ
                                </p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Social Media Links -->
                    <div class="mt-8">
                        <h3 class="font-medium text-gray-800 mb-3">ติดตามเรา</h3>
                        <div class="flex space-x-3">
                            <a href="#" class="bg-blue-600 text-white w-10 h-10 rounded-full flex items-center justify-center hover:bg-blue-700">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="#" class="bg-pink-600 text-white w-10 h-10 rounded-full flex items-center justify-center hover:bg-pink-700">
                                <i class="fab fa-instagram"></i>
                            </a>
                            <a href="#" class="bg-blue-400 text-white w-10 h-10 rounded-full flex items-center justify-center hover:bg-blue-500">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a href="#" class="bg-green-500 text-white w-10 h-10 rounded-full flex items-center justify-center hover:bg-green-600">
                                <i class="fab fa-line"></i>
                            </a>
                            <a href="#" class="bg-red-600 text-white w-10 h-10 rounded-full flex items-center justify-center hover:bg-red-700">
                                <i class="fab fa-youtube"></i>
                            </a>
                        </div>
                    </div>
                </div>
                
                <!-- Map -->
                <div class="bg-white rounded-lg shadow-md p-6 mt-6">
                    <h2 class="text-xl font-bold text-gray-800 mb-4">แผนที่</h2>
                    <div class="aspect-ratio-16-9 bg-gray-200 rounded">
                        <iframe class="w-full h-64 rounded" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3875.5850663015895!2d100.56827807575769!3d13.740879697967381!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x311d61eb6f19f11d%3A0x90e28fc3f2471794!2sSukhumvit%20Rd%2C%20Khwaeng%20Khlong%20Toei%20Nuea%2C%20Khet%20Watthana%2C%20Krung%20Thep%20Maha%20Nakhon!5e0!3m2!1sen!2sth!4v1687420397814!5m2!1sen!2sth" 
                            frameborder="0" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                    </div>
                </div>
            </div>
            
            <!-- Contact Form -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h2 class="text-xl font-bold text-gray-800 mb-6">ส่งข้อความถึงเรา</h2>
                    
                    <!-- Success Message -->
                    @if(session('success'))
                        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6" role="alert">
                            <p>{{ session('success') }}</p>
                        </div>
                    @endif
                    
                    <!-- Error Message -->
                    @if($errors->any())
                        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6" role="alert">
                            <p class="font-medium">เกิดข้อผิดพลาด</p>
                            <ul class="mt-2 list-disc list-inside">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    
                    <form action="{{ route('contact.store') }}" method="POST" class="space-y-6">
                        @csrf
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">ชื่อ <span class="text-red-500">*</span></label>
                                <input type="text" id="name" name="name" value="{{ old('name') }}" required
                                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-600">
                            </div>
                            
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">อีเมล <span class="text-red-500">*</span></label>
                                <input type="email" id="email" name="email" value="{{ old('email') }}" required
                                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-600">
                            </div>
                        </div>
                        
                        <div>
                            <label for="subject" class="block text-sm font-medium text-gray-700 mb-1">หัวข้อ <span class="text-red-500">*</span></label>
                            <input type="text" id="subject" name="subject" value="{{ old('subject') }}" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-600">
                        </div>
                        
                        <div>
                            <label for="message" class="block text-sm font-medium text-gray-700 mb-1">ข้อความ <span class="text-red-500">*</span></label>
                            <textarea id="message" name="message" rows="6" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-600">{{ old('message') }}</textarea>
                        </div>
                        
                        <div class="flex items-start">
                            <input type="checkbox" id="privacy" name="privacy" required
                                class="mt-1 h-4 w-4 text-purple-600 focus:ring-purple-500 border-gray-300 rounded">
                            <label for="privacy" class="ml-2 block text-sm text-gray-700">
                                ฉันยอมรับ <a href="#" class="text-purple-600 hover:underline">นโยบายความเป็นส่วนตัว</a> และอนุญาตให้เก็บข้อมูลของฉันเพื่อติดต่อกลับ
                            </label>
                        </div>
                        
                        <div>
                            <button type="submit" class="btn-primary w-full py-3">
                                <i class="fas fa-paper-plane mr-2"></i> ส่งข้อความ
                            </button>
                        </div>
                    </form>
                </div>
                
                <!-- FAQ -->
                <div class="bg-white rounded-lg shadow-md p-6 mt-6">
                    <h2 class="text-xl font-bold text-gray-800 mb-6">คำถามที่พบบ่อย</h2>
                    
                    <div class="space-y-4">
                        <div class="border-b border-gray-200 pb-4">
                            <button class="flex w-full justify-between items-center text-left" onclick="toggleFaq(this)">
                                <h3 class="font-medium text-gray-800">วิธีการสั่งซื้อสินค้าผ่านเว็บไซต์ทำอย่างไร?</h3>
                                <i class="fas fa-chevron-down text-gray-500"></i>
                            </button>
                            <div class="mt-2 hidden faq-content">
                                <p class="text-gray-600">
                                    เว็บไซต์ของเราเป็นเว็บไซต์ affiliate ซึ่งหมายความว่าเราจะแนะนำสินค้าจากร้านค้าออนไลน์ชั้นนำ 
                                    เมื่อคุณคลิกที่ปุ่ม "ซื้อเลย" ระบบจะนำคุณไปยังหน้าสินค้าบนเว็บไซต์พาร์ทเนอร์ของเรา เช่น Lazada หรือ Shopee 
                                    จากนั้นคุณสามารถทำการสั่งซื้อสินค้าได้ตามขั้นตอนปกติของเว็บไซต์นั้นๆ
                                </p>
                            </div>
                        </div>
                        
                        <div class="border-b border-gray-200 pb-4">
                            <button class="flex w-full justify-between items-center text-left" onclick="toggleFaq(this)">
                                <h3 class="font-medium text-gray-800">สินค้าที่แนะนำบนเว็บไซต์มีรับประกันหรือไม่?</h3>
                                <i class="fas fa-chevron-down text-gray-500"></i>
                            </button>
                            <div class="mt-2 hidden faq-content">
                                <p class="text-gray-600">
                                    สินค้าทุกชิ้นที่เราแนะนำบนเว็บไซต์มาจากร้านค้าที่เชื่อถือได้ 
                                    การรับประกันสินค้าจะเป็นไปตามเงื่อนไขของร้านค้าหรือแบรนด์นั้นๆ 
                                    เราแนะนำให้คุณตรวจสอบเงื่อนไขการรับประกันบนหน้าสินค้าของร้านค้าพาร์ทเนอร์ก่อนทำการสั่งซื้อ
                                </p>
                            </div>
                        </div>
                        
                        <div class="border-b border-gray-200 pb-4">
                            <button class="flex w-full justify-between items-center text-left" onclick="toggleFaq(this)">
                                <h3 class="font-medium text-gray-800">ฉันสามารถขอคำแนะนำเกี่ยวกับสินค้าได้หรือไม่?</h3>
                                <i class="fas fa-chevron-down text-gray-500"></i>
                            </button>
                            <div class="mt-2 hidden faq-content">
                                <p class="text-gray-600">
                                    แน่นอน! คุณสามารถส่งคำถามหรือขอคำแนะนำเกี่ยวกับสินค้าได้ผ่านแบบฟอร์มติดต่อบนหน้านี้ 
                                    ทีมงานของเรายินดีให้คำแนะนำเกี่ยวกับสินค้าที่เหมาะสมกับความต้องการของคุณ 
                                    นอกจากนี้ คุณยังสามารถอ่านบทความรีวิวสินค้าบนเว็บไซต์ของเราเพื่อข้อมูลเพิ่มเติมได้อีกด้วย
                                </p>
                            </div>
                        </div>
                        
                        <div class="border-b border-gray-200 pb-4">
                            <button class="flex w-full justify-between items-center text-left" onclick="toggleFaq(this)">
                                <h3 class="font-medium text-gray-800">ฉันสามารถเป็นพาร์ทเนอร์กับเว็บไซต์ของคุณได้หรือไม่?</h3>
                                <i class="fas fa-chevron-down text-gray-500"></i>
                            </button>
                            <div class="mt-2 hidden faq-content">
                                <p class="text-gray-600">
                                    เรายินดีร่วมงานกับพาร์ทเนอร์ที่มีสินค้าคุณภาพ หากคุณสนใจที่จะร่วมงานกับเรา 
                                    กรุณาส่งรายละเอียดเกี่ยวกับธุรกิจของคุณมาที่อีเมล partner@example.com 
                                    ทีมงานของเราจะติดต่อกลับเพื่อพูดคุยเกี่ยวกับโอกาสในการร่วมงานกัน
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
<script>
    function toggleFaq(element) {
        const content = element.nextElementSibling;
        const icon = element.querySelector('i');
        
        content.classList.toggle('hidden');
        
        if (content.classList.contains('hidden')) {
            icon.classList.remove('fa-chevron-up');
            icon.classList.add('fa-chevron-down');
        } else {
            icon.classList.remove('fa-chevron-down');
            icon.classList.add('fa-chevron-up');
        }
    }
</script>
@endsection