<footer class="bg-gray-800 text-white py-8 mt-12">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- About -->
            <div>
                <h3 class="text-lg font-semibold mb-4">เกี่ยวกับเรา</h3>
                <p class="text-gray-300 text-sm">
                    {{ config('app.name') }} คือเว็บไซต์รวบรวมสินค้าคุณภาพและบทความรีวิวที่น่าสนใจ 
                    เพื่อให้คุณได้เลือกสิ่งที่ดีที่สุดในราคาที่คุ้มค่า
                </p>
                <div class="mt-4 flex space-x-4">
                    <a href="#" class="text-gray-300 hover:text-white">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#" class="text-gray-300 hover:text-white">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="#" class="text-gray-300 hover:text-white">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="#" class="text-gray-300 hover:text-white">
                        <i class="fab fa-line"></i>
                    </a>
                </div>
            </div>
            
            <!-- Quick Links -->
            <div>
                <h3 class="text-lg font-semibold mb-4">ลิงก์ด่วน</h3>
                <ul class="space-y-2 text-sm">
                    <li>
                        <a href="{{ route('home') }}" class="text-gray-300 hover:text-white">หน้าแรก</a>
                    </li>
                    <li>
                        <a href="{{ route('home') }}#latest-articles" class="text-gray-300 hover:text-white">บทความล่าสุด</a>
                    </li>
                    <li>
                        <a href="{{ route('home') }}#featured-products" class="text-gray-300 hover:text-white">สินค้าแนะนำ</a>
                    </li>
                </ul>
                <h3 class="text-lg font-semibold mb-2 mt-6">หมวดหมู่</h3>
                <ul class="space-y-2 text-sm">
                    @foreach($globalCategories->take(5) as $category)
                        <li>
                            <a href="{{ route('category.show', $category->slug) }}" class="text-gray-300 hover:text-white">
                                {{ $category->name }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
            
            <!-- Contact -->
            <div>
                <h3 class="text-lg font-semibold mb-4">ติดต่อเรา</h3>
                <ul class="space-y-3 text-sm">
                    <li class="flex items-start">
                        <i class="fas fa-map-marker-alt text-purple-400 mt-1 mr-3"></i>
                        <span class="text-gray-300">123 ถนนสุขุมวิท, กรุงเทพฯ 10110</span>
                    </li>
                    <li class="flex items-center">
                        <i class="fas fa-envelope text-purple-400 mr-3"></i>
                        <a href="mailto:contact@example.com" class="text-gray-300 hover:text-white">contact@example.com</a>
                    </li>
                    <li class="flex items-center">
                        <i class="fas fa-phone text-purple-400 mr-3"></i>
                        <a href="tel:+66123456789" class="text-gray-300 hover:text-white">+66 123 456 789</a>
                    </li>
                </ul>
                
                <div class="mt-6">
                    <h3 class="text-lg font-semibold mb-2">รับข่าวสารล่าสุด</h3>
                    <form class="flex mt-2">
                        <input type="email" placeholder="อีเมลของคุณ" class="w-full px-3 py-2 text-gray-800 rounded-l-md focus:outline-none">
                        <button type="submit" class="bg-purple-600 hover:bg-purple-700 px-4 py-2 rounded-r-md transition duration-300">
                            <i class="fas fa-paper-plane"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
        
        <div class="border-t border-gray-700 mt-8 pt-6 flex flex-col md:flex-row justify-between items-center">
            <p class="text-sm text-gray-400">
                &copy; {{ date('Y') }} {{ config('app.name') }}. สงวนลิขสิทธิ์ทั้งหมด.
            </p>
            <div class="mt-4 md:mt-0">
                <ul class="flex space-x-4 text-sm">
                    <li><a href="#" class="text-gray-400 hover:text-white">นโยบายความเป็นส่วนตัว</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-white">เงื่อนไขการใช้งาน</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-white">คำถามที่พบบ่อย</a></li>
                </ul>
            </div>
        </div>
        
        <div class="text-center mt-4 text-xs text-gray-500">
            <p>เว็บไซต์นี้อาจมีลิงก์แนะนำสินค้า เราอาจได้รับค่าตอบแทนหากคุณซื้อผ่านลิงก์ของเรา โดยไม่มีค่าใช้จ่ายเพิ่มเติมสำหรับคุณ</p>
        </div>
    </div>
</footer>