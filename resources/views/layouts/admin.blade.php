<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'แผงควบคุม') - {{ config('app.name') }}</title>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Favicon -->
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">

    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <!-- TinyMCE for WYSIWYG editor -->
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    
    <!-- Custom Styles -->
    <style>
        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }
        ::-webkit-scrollbar-thumb {
            background: #888;
            border-radius: 4px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #555;
        }
        
        /* Active sidebar item */
        .sidebar-item.active {
            background-color: #374151;
            color: white;
        }
        
        /* Transitions */
        .transition-300 {
            transition: all 0.3s ease;
        }
    </style>
    
    @yield('head')
</head>
<body class="bg-gray-100 font-sans antialiased">
    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        <div class="hidden md:flex md:flex-shrink-0">
            <div class="flex flex-col w-64 bg-gray-800 text-white">
                <div class="flex items-center justify-center h-16 border-b border-gray-700">
                    <span class="text-xl font-bold">{{ config('app.name') }}</span>
                </div>
                
                <div class="flex flex-col flex-grow px-4 mt-5">
                    <nav class="flex-1 space-y-1">
                        <a href="{{ route('admin.dashboard') }}" class="sidebar-item flex items-center px-4 py-2 rounded-md {{ request()->routeIs('admin.dashboard') ? 'active' : 'hover:bg-gray-700' }}">
                            <i class="fas fa-tachometer-alt mr-3"></i>
                            <span>แดชบอร์ด</span>
                        </a>
                        
                        <a href="{{ route('admin.categories.index') }}" class="sidebar-item flex items-center px-4 py-2 mt-2 rounded-md {{ request()->routeIs('admin.categories*') ? 'active' : 'hover:bg-gray-700' }}">
                            <i class="fas fa-folder mr-3"></i>
                            <span>หมวดหมู่</span>
                        </a>
                        
                        <a href="{{ route('admin.products.index') }}" class="sidebar-item flex items-center px-4 py-2 mt-2 rounded-md {{ request()->routeIs('admin.products*') ? 'active' : 'hover:bg-gray-700' }}">
                            <i class="fas fa-box mr-3"></i>
                            <span>สินค้า</span>
                        </a>
                        
                        <a href="{{ route('admin.articles.index') }}" class="sidebar-item flex items-center px-4 py-2 mt-2 rounded-md {{ request()->routeIs('admin.articles*') ? 'active' : 'hover:bg-gray-700' }}">
                            <i class="fas fa-newspaper mr-3"></i>
                            <span>บทความ</span>
                        </a>
                    </nav>
                    
                    <div class="mt-auto mb-5">
                        <form action="{{ route('admin.logout') }}" method="POST" class="w-full">
                            @csrf
                            <button type="submit" class="flex w-full items-center px-4 py-2 mt-2 rounded-md text-white hover:bg-gray-700">
                                <i class="fas fa-sign-out-alt mr-3"></i>
                                <span>ออกจากระบบ</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Mobile sidebar -->
        <div class="md:hidden fixed bottom-0 left-0 right-0 z-10 bg-gray-800 text-white h-16 flex justify-around items-center">
            <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'text-white' : 'text-gray-400' }}">
                <i class="fas fa-tachometer-alt text-xl"></i>
            </a>
            <a href="{{ route('admin.categories.index') }}" class="{{ request()->routeIs('admin.categories*') ? 'text-white' : 'text-gray-400' }}">
                <i class="fas fa-folder text-xl"></i>
            </a>
            <a href="{{ route('admin.products.index') }}" class="{{ request()->routeIs('admin.products*') ? 'text-white' : 'text-gray-400' }}">
                <i class="fas fa-box text-xl"></i>
            </a>
            <a href="{{ route('admin.articles.index') }}" class="{{ request()->routeIs('admin.articles*') ? 'text-white' : 'text-gray-400' }}">
                <i class="fas fa-newspaper text-xl"></i>
            </a>
            <form action="{{ route('admin.logout') }}" method="POST" class="inline">
                @csrf
                <button type="submit" class="text-gray-400">
                    <i class="fas fa-sign-out-alt text-xl"></i>
                </button>
            </form>
        </div>
        
        <!-- Main content -->
        <div class="flex flex-col flex-1 overflow-hidden">
            <!-- Top bar -->
            <div class="bg-white shadow-sm z-10">
                <div class="px-4 sm:px-6 lg:px-8 py-4">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <h1 class="text-xl font-semibold text-gray-800">@yield('page-title', 'แผงควบคุม')</h1>
                        </div>
                        <div class="flex items-center">
                            <span class="text-sm text-gray-600 mr-2">{{ Auth::user()->name }}</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Page content -->
            <div class="flex-1 overflow-auto p-4 md:p-6 pb-20 md:pb-6">
                <!-- Flash messages -->
                @if (session('success'))
                    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4 rounded shadow" role="alert">
                        <p>{{ session('success') }}</p>
                    </div>
                @endif
                
                @if (session('error'))
                    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4 rounded shadow" role="alert">
                        <p>{{ session('error') }}</p>
                    </div>
                @endif
                
                @if ($errors->any())
                    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4 rounded shadow" role="alert">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                
                <!-- Main content -->
                @yield('content')
            </div>
        </div>
    </div>
    
    <!-- Scripts -->
    <script>
        // Initialize TinyMCE
        document.addEventListener('DOMContentLoaded', function() {
            if (document.querySelector('.tinymce-editor')) {
                tinymce.init({
                    selector: '.tinymce-editor',
                    plugins: 'link lists image table code',
                    toolbar: 'undo redo | styleselect | bold italic | alignleft aligncenter alignright | bullist numlist | link image | table | code',
                    height: 400,
                    promotion: false,
                    images_upload_handler: function (blobInfo, success, failure) {
                        // This is a simple example. In a real application, you would upload to your server
                        var reader = new FileReader();
                        reader.onload = function() {
                            success(reader.result);
                        };
                        reader.readAsDataURL(blobInfo.blob());
                    }
                });
            }
        });
        
        // Image preview
        function previewImage(input, previewId) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                
                reader.onload = function(e) {
                    document.getElementById(previewId).src = e.target.result;
                    document.getElementById(previewId).classList.remove('hidden');
                }
                
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
    
    @yield('scripts')
</body>
</html>