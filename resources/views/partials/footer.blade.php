<footer class="bg-slate-800 text-white py-8 mt-12 site-footer">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-2 md:grid-cols-3 gap-8">
            <!-- About -->
            <div>
                <h3 class="text-lg font-semibold mb-4">เกี่ยวกับเรา</h3>
                <p class="text-gray-300 text-sm">
                    {{ config('app.name') }} คือเว็บไซต์รวบรวมสินค้าคุณภาพและบทความรีวิวที่น่าสนใจ 
                    เพื่อให้คุณได้เลือกสิ่งที่ดีที่สุดในราคาที่คุ้มค่า
                </p>
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
            </div>

            <div>
                <h3 class="text-lg font-semibold mb-4">หมวดหมู่</h3>
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
        </div>
        
        <div class="border-t border-gray-700 mt-8 pt-6 flex flex-col md:flex-row justify-between items-center">
            <p class="text-sm text-gray-400">
                &copy; {{ date('Y') }} {{ config('app.name') }}. สงวนลิขสิทธิ์ทั้งหมด.
            </p>
            <div class="mt-4 md:mt-0">
                <ul class="flex space-x-4 text-sm">
                    <li><a href="#" class="text-gray-400 hover:text-white">นโยบายความเป็นส่วนตัว</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-white">เงื่อนไขการใช้งาน</a></li>
                </ul>
            </div>
        </div>
        
        <div class="text-center mt-4 text-xs text-gray-500">
            <p>เว็บไซต์นี้อาจมีลิงก์แนะนำสินค้า เราอาจได้รับค่าตอบแทนหากคุณซื้อผ่านลิงก์ของเรา โดยไม่มีค่าใช้จ่ายเพิ่มเติมสำหรับคุณ</p>
        </div>
    </div>
</footer>