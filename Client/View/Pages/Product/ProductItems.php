    <!DOCTYPE html>
    <html lang="vi">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Sản phẩm - Shop Giày</title>
        <script src="https://cdn.tailwindcss.com"></script>
    </head>

    <body class="bg-gray-100">

        <!-- HEADER -->
        <header class="bg-white shadow">
            <div class="container mx-auto flex items-center justify-between py-4">
                <h1 class="text-2xl font-bold text-blue-600">Shop Giày</h1>

                <nav class="flex gap-6">
                    <a href="#" class="text-gray-700 hover:text-blue-500">Trang chủ</a>
                    <a href="#" class="text-blue-500 font-semibold">Sản phẩm</a>
                    <a href="#" class="text-gray-700 hover:text-blue-500">Liên hệ</a>
                </nav>
            </div>
        </header>

        <!-- CONTENT -->
        <main class="container mx-auto mt-6 relative">

            <!-- TITLE ROW -->
            <div class="flex gap-6 items-end mb-6">

                <!-- DANH MỤC TITLE -->
                <div class="w-1/4">
                    <h2 class="text-2xl font-semibold">Danh mục</h2>
                </div>

                <!-- PRODUCT TITLE + LINE -->
                <div class="w-3/4">
                    <h2 class="text-2xl font-semibold text-center">Danh sách sản phẩm</h2>
                    <div class="border-b mt-2"></div>
                </div>

            </div>

            <div class="flex gap-6">

                <!-- SIDEBAR -->
                <aside class="w-1/4">
                    <ul class="space-y-3">
                        <li><a href="#" class="block text-gray-700 hover:text-blue-500">Giày thể thao</a></li>
                        <li><a href="#" class="block text-gray-700 hover:text-blue-500">Giày chạy bộ</a></li>
                        <li><a href="#" class="block text-gray-700 hover:text-blue-500">Giày sneaker</a></li>
                        <li><a href="#" class="block text-gray-700 hover:text-blue-500">Giày nam</a></li>
                        <li><a href="#" class="block text-gray-700 hover:text-blue-500">Giày nữ</a></li>
                    </ul>
                </aside>

                <!-- PRODUCTS -->
                <section class="w-3/4">

                    <!-- FILTER -->
                    <div class="flex justify-end mb-4">
                        <select class="border border-gray-300 rounded px-3 py-2 text-sm">
                            <option>Lọc theo giá</option>
                            <option>Thấp → Cao</option>
                            <option>Cao → Thấp</option>
                        </select>
                    </div>

                    <!-- GRID -->
                    <div class="grid grid-cols-3 gap-6">

                        <div class="bg-white rounded-xl shadow hover:shadow-xl transition transform hover:-translate-y-1 p-4">
                            <img src="https://via.placeholder.com/200" class="w-full h-48 object-cover rounded mb-3">
                            <h3 class="font-semibold text-gray-800">Giày Nike Air</h3>
                            <p class="text-red-500 font-bold mt-1">1.200.000đ</p>
                            <button class="mt-3 w-full bg-blue-500 text-white py-2 rounded-lg hover:bg-blue-600">
                                Mua ngay
                            </button>
                        </div>

                        <div class="bg-white rounded-xl shadow hover:shadow-xl transition transform hover:-translate-y-1 p-4">
                            <img src="https://via.placeholder.com/200" class="w-full h-48 object-cover rounded mb-3">
                            <h3 class="font-semibold text-gray-800">Adidas UltraBoost</h3>
                            <p class="text-red-500 font-bold mt-1">2.000.000đ</p>
                            <button class="mt-3 w-full bg-blue-500 text-white py-2 rounded-lg hover:bg-blue-600">
                                Mua ngay
                            </button>
                        </div>

                        <div class="bg-white rounded-xl shadow hover:shadow-xl transition transform hover:-translate-y-1 p-4">
                            <img src="https://via.placeholder.com/200" class="w-full h-48 object-cover rounded mb-3">
                            <h3 class="font-semibold text-gray-800">Puma RS-X</h3>
                            <p class="text-red-500 font-bold mt-1">1.500.000đ</p>
                            <button class="mt-3 w-full bg-blue-500 text-white py-2 rounded-lg hover:bg-blue-600">
                                Mua ngay
                            </button>
                        </div>

                    </div>

                    <!-- Pagination -->
                    <div class="flex justify-center mt-8">
                        <nav class="flex items-center space-x-2">
                            <button class="px-3 py-1 bg-gray-200 rounded hover:bg-gray-300">«</button>
                            <button class="px-3 py-1 bg-blue-500 text-white rounded">1</button>
                            <button class="px-3 py-1 bg-gray-200 rounded hover:bg-gray-300">2</button>
                            <button class="px-3 py-1 bg-gray-200 rounded hover:bg-gray-300">3</button>
                            <button class="px-3 py-1 bg-gray-200 rounded hover:bg-gray-300">4</button>
                            <button class="px-3 py-1 bg-gray-200 rounded hover:bg-gray-300">»</button>
                        </nav>
                    </div>

                </section>
            </div>

            <!-- HOT PRODUCTS (OVERLAP) -->
            <div class="absolute left-0 right-0 -bottom-56 z-10">
                <div class="p-6 rounded-xl relative">

                    <h2 class="text-2xl font-bold mb-2 text-red-600 tracking-wide">
                        Sản phẩm HOT 🔥
                    </h2>
                    <div class="border-b mb-6"></div>

                    <!-- BUTTON LEFT -->
                    <button class="absolute left-0 top-1/2 -translate-y-1/2 bg-white shadow px-3 py-2 rounded-full hover:bg-gray-100">
                        <
                    </button>

                    <!-- BUTTON RIGHT -->
                    <button class="absolute right-0 top-1/2 -translate-y-1/2 bg-white shadow px-3 py-2 rounded-full hover:bg-gray-100">
                        >
                    </button>

                    <!-- SLIDER -->
                    <div class="overflow-hidden px-10">
                        <div class="flex gap-4">

                            <!-- ITEM -->
                            <div class="min-w-[180px] bg-gray-50 p-3 rounded-lg hover:shadow-md transition">
                                <img src="https://via.placeholder.com/150" class="rounded mb-2 w-full">
                                <p class="text-sm font-semibold">Nike Jordan</p>
                                <p class="text-red-500 text-sm">2.500.000đ</p>
                            </div>

                            <div class="min-w-[180px] bg-gray-50 p-3 rounded-lg hover:shadow-md transition">
                                <img src="https://via.placeholder.com/150">
                                <p class="text-sm font-semibold">Adidas NMD</p>
                                <p class="text-red-500 text-sm">1.800.000đ</p>
                            </div>

                            <div class="min-w-[180px] bg-gray-50 p-3 rounded-lg hover:shadow-md transition">
                                <img src="https://via.placeholder.com/150">
                                <p class="text-sm font-semibold">Puma Future</p>
                                <p class="text-red-500 text-sm">1.600.000đ</p>
                            </div>

                            <div class="min-w-[180px] bg-gray-50 p-3 rounded-lg hover:shadow-md transition">
                                <img src="https://via.placeholder.com/150">
                                <p class="text-sm font-semibold">Nike Air Force 1</p>
                                <p class="text-red-500 text-sm">2.200.000đ</p>
                            </div>

                            <div class="min-w-[180px] bg-gray-50 p-3 rounded-lg hover:shadow-md transition">
                                <img src="https://via.placeholder.com/150">
                                <p class="text-sm font-semibold">New Balance 550</p>
                                <p class="text-red-500 text-sm">1.900.000đ</p>
                            </div>

                            <!-- thêm nhiều sản phẩm để test -->
                            <div class="min-w-[180px] bg-gray-50 p-3 rounded-lg">
                                <img src="https://via.placeholder.com/150">
                                <p class="text-sm font-semibold">Nike Dunk</p>
                                <p class="text-red-500 text-sm">2.100.000đ</p>
                            </div>

                            <div class="min-w-[180px] bg-gray-50 p-3 rounded-lg">
                                <img src="https://via.placeholder.com/150">
                                <p class="text-sm font-semibold">Adidas Forum</p>
                                <p class="text-red-500 text-sm">1.700.000đ</p>
                            </div>

                        </div>
                    </div>

                </div>
            </div>

        </main>

        <!-- FOOTER -->
        <footer class="bg-white mt-72 shadow">
            <div class="container mx-auto py-4 text-center text-gray-600">
                © 2026 Shop Giày. All rights reserved.
            </div>
        </footer>

    </body>

    </html>