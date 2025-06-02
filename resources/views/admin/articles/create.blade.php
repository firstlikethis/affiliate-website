@extends('layouts.admin')

@section('title', 'เพิ่มบทความ')

@section('page-title', 'เพิ่มบทความ')

@section('head')
    <!-- Include Quill.js -->
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    
    <!-- Include tagify -->
    <link href="https://unpkg.com/@yaireo/tagify/dist/tagify.css" rel="stylesheet">
    <style>
        .ql-editor {
            min-height: 300px;
        }
        
        .tagify {
            width: 100%;
            max-width: 100%;
            border: 1px solid #e2e8f0;
            border-radius: 0.375rem;
        }
        
        .tagify__input {
            padding: 0.5rem;
        }
        
        .product-search-results {
            max-height: 250px;
            overflow-y: auto;
        }
        
        .product-item {
            transition: all 0.2s ease;
        }
        
        .product-item:hover {
            background-color: #f9fafb;
        }
        
        .selected-products-list {
            max-height: 300px;
            overflow-y: auto;
        }
    </style>
@endsection

@section('content')
<div class="bg-white rounded-lg shadow-sm overflow-hidden">
    <form action="{{ route('admin.articles.store') }}" method="POST" enctype="multipart/form-data" class="p-6" id="article-form">
        @csrf
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- คอลัมน์ซ้าย (2/3) -->
            <div class="md:col-span-2">
                <div class="mb-6">
                    <label for="title" class="block text-sm font-medium text-gray-700 mb-2">หัวข้อบทความ <span class="text-red-500">*</span></label>
                    <input type="text" name="title" id="title" value="{{ old('title') }}" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-200">
                    @error('title')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="mb-6">
                    <label for="content" class="block text-sm font-medium text-gray-700 mb-2">เนื้อหาบทความ <span class="text-red-500">*</span></label>
                    <div id="editor"></div>
                    <textarea name="content" id="content" class="hidden">{{ old('content') }}</textarea>
                    @error('content')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="mb-6 border-t border-gray-200 pt-4">
                    <h3 class="text-lg font-medium text-gray-700 mb-4">สินค้าที่เกี่ยวข้อง</h3>
                    <p class="text-sm text-gray-500 mb-3">เลือกสินค้าที่ต้องการแสดงในบทความนี้</p>
                    
                    <div class="mb-4">
                        <label for="product-search" class="block text-sm font-medium text-gray-700 mb-2">ค้นหาสินค้า</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                                <i class="fas fa-search text-gray-400"></i>
                            </span>
                            <input type="text" id="product-search" 
                                placeholder="พิมพ์เพื่อค้นหาสินค้า..." 
                                class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-200">
                        </div>
                    </div>
                    
                    <div id="product-search-results" class="product-search-results hidden bg-white border border-gray-200 rounded-md shadow-sm mb-4">
                        <!-- Search results will be displayed here -->
                    </div>
                    
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">สินค้าที่เลือก</label>
                        <div id="selected-products" class="selected-products-list border border-gray-200 rounded-md p-2 min-h-[100px]">
                            <!-- Selected products will be displayed here -->
                            <p id="no-products" class="text-gray-500 text-sm p-2">ยังไม่ได้เลือกสินค้า</p>
                        </div>
                        <div id="product-ids-container">
                            <!-- Hidden inputs for product IDs will be added here -->
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- คอลัมน์ขวา (1/3) -->
            <div>
                <div class="mb-6">
                    <label for="thumbnail" class="block text-sm font-medium text-gray-700 mb-2">รูปภาพปก <span class="text-red-500">*</span></label>
                    <input type="file" name="thumbnail" id="thumbnail" accept="image/*" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-200"
                        onchange="previewImage(this, 'thumbnailPreview')">
                    <p class="mt-1 text-xs text-gray-500">รูปภาพควรมีขนาดไม่เกิน 2MB และเป็นไฟล์ประเภท JPEG, PNG, GIF, หรือ WEBP</p>
                    @error('thumbnail')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                    
                    <div class="mt-2">
                        <img id="thumbnailPreview" src="#" alt="Preview" class="hidden mt-2 max-h-48 rounded">
                    </div>
                </div>
                
                <div class="mb-6">
                    <label for="tags-input" class="block text-sm font-medium text-gray-700 mb-2">แท็ก</label>
                    <input name="tags" id="tags-input" class="w-full px-3 py-2 border border-gray-300 rounded-md">
                    <p class="mt-1 text-xs text-gray-500">ใส่แท็กเพื่อช่วยในการค้นหาบทความ (กด Enter หลังแต่ละแท็ก)</p>
                    @error('tags.*')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="mb-6 border-t border-gray-200 pt-4">
                    <h3 class="text-lg font-medium text-gray-700 mb-4">ข้อมูล SEO</h3>
                    
                    <div class="mb-4">
                        <label for="meta_title" class="block text-sm font-medium text-gray-700 mb-2">Meta Title</label>
                        <input type="text" name="meta_title" id="meta_title" value="{{ old('meta_title') }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-200">
                        <p class="mt-1 text-xs text-gray-500">ถ้าเว้นว่าง ระบบจะใช้หัวข้อบทความแทน (แนะนำไม่เกิน 70 ตัวอักษร)</p>
                        @error('meta_title')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="mb-4">
                        <label for="meta_description" class="block text-sm font-medium text-gray-700 mb-2">Meta Description</label>
                        <textarea name="meta_description" id="meta_description" rows="3"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-200">{{ old('meta_description') }}</textarea>
                        <p class="mt-1 text-xs text-gray-500">ถ้าเว้นว่าง ระบบจะใช้เนื้อหาส่วนต้นของบทความแทน (แนะนำไม่เกิน 160 ตัวอักษร)</p>
                        @error('meta_description')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
        
        <div class="flex justify-end space-x-3 mt-6 border-t border-gray-200 pt-6">
            <a href="{{ route('admin.articles.index') }}" class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-200 rounded-md hover:bg-gray-300">
                ยกเลิก
            </a>
            <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-purple-500 rounded-md hover:bg-purple-600">
                บันทึกข้อมูล
            </button>
        </div>
    </form>
</div>
@endsection

@section('scripts')
    <!-- Include Quill.js -->
    <script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>
    
    <!-- Include tagify -->
    <script src="https://unpkg.com/@yaireo/tagify"></script>
    
    <script>
        // Initialize Quill editor
        const quill = new Quill('#editor', {
            theme: 'snow',
            modules: {
                toolbar: [
                    [{ 'header': [1, 2, 3, 4, 5, 6, false] }],
                    ['bold', 'italic', 'underline', 'strike'],
                    [{ 'color': [] }, { 'background': [] }],
                    [{ 'list': 'ordered' }, { 'list': 'bullet' }],
                    [{ 'align': [] }],
                    ['link', 'image'],
                    ['clean']
                ]
            },
            placeholder: 'เขียนเนื้อหาบทความที่นี่...'
        });
        
        // Initialize with existing content if any
        const contentInput = document.getElementById('content');
        if (contentInput.value) {
            quill.clipboard.dangerouslyPasteHTML(contentInput.value);
        }
        
        // Update hidden field before submitting the form
        document.getElementById('article-form').addEventListener('submit', function() {
            document.getElementById('content').value = quill.root.innerHTML;
        });
        
        // Initialize Tagify
        const input = document.getElementById('tags-input');
        const tagify = new Tagify(input, {
            pattern: /^.{1,50}$/,
            delimiters: ',| ',
            maxTags: 10,
            dropdown: {
                enabled: 0
            },
            transformTag: function(tagData) {
                // Capitalize first letter
                tagData.value = tagData.value.charAt(0).toUpperCase() + tagData.value.slice(1).toLowerCase();
            }
        });
        
        // Product search functionality
        const productSearch = document.getElementById('product-search');
        const productSearchResults = document.getElementById('product-search-results');
        const selectedProducts = document.getElementById('selected-products');
        const noProducts = document.getElementById('no-products');
        const productIdsContainer = document.getElementById('product-ids-container');
        
        let selectedProductsArray = [];
        
        productSearch.addEventListener('input', debounce(function(e) {
            const query = e.target.value.trim();
            
            if (query.length < 2) {
                productSearchResults.innerHTML = '';
                productSearchResults.classList.add('hidden');
                return;
            }
            
            // Fetch products based on search query
            fetch('{{ route('admin.articles.search-products') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ query: query })
            })
            .then(response => response.json())
            .then(data => {
                productSearchResults.innerHTML = '';
                
                if (data.length === 0) {
                    productSearchResults.innerHTML = '<p class="p-3 text-gray-500 text-sm">ไม่พบสินค้าที่ตรงกับคำค้นหา</p>';
                } else {
                    data.forEach(product => {
                        // Skip if product is already selected
                        if (selectedProductsArray.includes(product.id)) {
                            return;
                        }
                        
                        const productItem = document.createElement('div');
                        productItem.className = 'product-item p-3 border-b border-gray-100 flex items-center cursor-pointer';
                        productItem.innerHTML = `
                            <div class="w-12 h-12 flex-shrink-0 mr-3">
                                <img src="${product.image_url}" alt="${product.name}" class="w-full h-full object-cover rounded">
                            </div>
                            <div class="flex-grow">
                                <h4 class="text-sm font-medium text-gray-800">${product.name}</h4>
                                <p class="text-xs text-gray-500">${product.category.name} - ${parseFloat(product.price).toLocaleString('th-TH', { minimumFractionDigits: 2 })} บาท</p>
                            </div>
                            <button type="button" class="ml-2 text-green-600 hover:text-green-800">
                                <i class="fas fa-plus-circle"></i>
                            </button>
                        `;
                        
                        productItem.addEventListener('click', function() {
                            addProduct(product);
                            productSearchResults.classList.add('hidden');
                            productSearch.value = '';
                        });
                        
                        productSearchResults.appendChild(productItem);
                    });
                }
                
                productSearchResults.classList.remove('hidden');
            })
            .catch(error => {
                console.error('Error searching products:', error);
            });
        }, 300));
        
        // Hide search results when clicking outside
        document.addEventListener('click', function(event) {
            if (!productSearch.contains(event.target) && !productSearchResults.contains(event.target)) {
                productSearchResults.classList.add('hidden');
            }
        });
        
        // Add product to selected products
        function addProduct(product) {
            if (selectedProductsArray.includes(product.id)) {
                return;
            }
            
            selectedProductsArray.push(product.id);
            
            // Hide the "no products" message
            noProducts.classList.add('hidden');
            
            // Create the product element
            const productElement = document.createElement('div');
            productElement.className = 'selected-product flex items-center p-2 mb-2 bg-gray-50 rounded';
            productElement.setAttribute('data-id', product.id);
            productElement.innerHTML = `
                <div class="w-12 h-12 flex-shrink-0 mr-3">
                    <img src="${product.image_url}" alt="${product.name}" class="w-full h-full object-cover rounded">
                </div>
                <div class="flex-grow">
                    <h4 class="text-sm font-medium text-gray-800">${product.name}</h4>
                    <p class="text-xs text-gray-500">${product.category.name} - ${parseFloat(product.price).toLocaleString('th-TH', { minimumFractionDigits: 2 })} บาท</p>
                </div>
                <button type="button" class="ml-2 text-red-600 hover:text-red-800 remove-product">
                    <i class="fas fa-times-circle"></i>
                </button>
            `;
            
            // Add event listener to remove button
            productElement.querySelector('.remove-product').addEventListener('click', function() {
                removeProduct(product.id);
            });
            
            // Add to the selected products container
            selectedProducts.appendChild(productElement);
            
            // Add hidden input for the product ID
            const hiddenInput = document.createElement('input');
            hiddenInput.type = 'hidden';
            hiddenInput.name = 'products[]';
            hiddenInput.value = product.id;
            hiddenInput.id = `product-input-${product.id}`;
            productIdsContainer.appendChild(hiddenInput);
        }
        
        // Remove product from selected products
        function removeProduct(productId) {
            // Remove from array
            selectedProductsArray = selectedProductsArray.filter(id => id !== productId);
            
            // Remove element
            const productElement = selectedProducts.querySelector(`.selected-product[data-id="${productId}"]`);
            if (productElement) {
                selectedProducts.removeChild(productElement);
            }
            
            // Remove hidden input
            const hiddenInput = document.getElementById(`product-input-${productId}`);
            if (hiddenInput) {
                productIdsContainer.removeChild(hiddenInput);
            }
            
            // Show the "no products" message if no products are selected
            if (selectedProductsArray.length === 0) {
                noProducts.classList.remove('hidden');
            }
        }
        
        // Debounce function to limit API calls
        function debounce(func, wait) {
            let timeout;
            return function() {
                const context = this, args = arguments;
                clearTimeout(timeout);
                timeout = setTimeout(() => {
                    func.apply(context, args);
                }, wait);
            };
        }
    </script>
@endsection