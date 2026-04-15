<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Home - Shop Giày</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

  <!-- Navbar -->
  <header class="bg-white shadow">
    <div class="container mx-auto flex justify-between items-center p-4">
      <h1 class="text-xl font-bold">Sneaker Shop</h1>
      <nav class="space-x-6">
        <a href="#" class="hover:text-blue-500">Trang chủ</a>
        <a href="#" class="hover:text-blue-500">Sản phẩm</a>
        <a href="#" class="hover:text-blue-500">Giỏ hàng</a>
        <a href="#" class="hover:text-blue-500">Liên hệ</a>
      </nav>
    </div>
  </header>

  <!-- Banner -->
  <section class="bg-gray-100 py-6">
    <div class="container mx-auto">
      <img src="https://via.placeholder.com/1200x400" class="w-full rounded-lg shadow">
    </div>
  </section>

  <!-- Category Section -->
  <section class="bg-white py-10">
    <div class="container mx-auto grid grid-cols-1 md:grid-cols-3 gap-6 text-center">

      <!-- Category Item -->
      <div class="p-6 border rounded-xl hover:shadow-lg transition">
        <h4 class="font-semibold mb-3">GIÀY NAM</h4>
        <button class="border px-4 py-2 text-sm hover:bg-black hover:text-white transition">XEM NGAY</button>
      </div>

      <div class="p-6 border rounded-xl hover:shadow-lg transition">
        <h4 class="font-semibold mb-3">GIÀY NỮ</h4>
        <button class="border px-4 py-2 text-sm hover:bg-black hover:text-white transition">XEM NGAY</button>
      </div>

      <div class="p-6 border rounded-xl hover:shadow-lg transition">
        <h4 class="font-semibold mb-3">ONLINE GIÁ SỐC</h4>
        <button class="border px-4 py-2 text-sm hover:bg-black hover:text-white transition">XEM NGAY</button>
      </div>

    </div>
  </section>

  <!-- Product Section -->
  <section class="container mx-auto py-10">
    <h3 class="text-2xl font-semibold mb-6 text-center">Sản phẩm nổi bật</h3>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

      <!-- Product Card -->
      <div class="bg-white p-4 rounded-2xl shadow hover:shadow-lg transition">
        <img src="https://via.placeholder.com/300" class="w-full rounded-lg mb-3">
        <h4 class="font-semibold">Nike Air Force 1</h4>
        <p class="text-gray-500">1.500.000đ</p>
        <button class="mt-3 w-full bg-blue-500 text-white py-2 rounded-lg">Thêm vào giỏ</button>
      </div>

      <div class="bg-white p-4 rounded-2xl shadow hover:shadow-lg transition">
        <img src="https://via.placeholder.com/300" class="w-full rounded-lg mb-3">
        <h4 class="font-semibold">Adidas Ultraboost</h4>
        <p class="text-gray-500">2.200.000đ</p>
        <button class="mt-3 w-full bg-blue-500 text-white py-2 rounded-lg">Thêm vào giỏ</button>
      </div>

      <div class="bg-white p-4 rounded-2xl shadow hover:shadow-lg transition">
        <img src="https://via.placeholder.com/300" class="w-full rounded-lg mb-3">
        <h4 class="font-semibold">Puma RS-X</h4>
        <p class="text-gray-500">1.800.000đ</p>
        <button class="mt-3 w-full bg-blue-500 text-white py-2 rounded-lg">Thêm vào giỏ</button>
      </div>

    </div>
  </section>

  <!-- Sale Section -->
  <section class="container mx-auto py-10">
    <h3 class="text-2xl font-semibold mb-6 text-red-500 text-center">🔥 XẢ KHO ONLINE</h3>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

      <!-- Sale Product -->
      <div class="bg-white p-4 rounded-2xl shadow hover:shadow-lg transition">
        <div class="relative">
          <img src="https://via.placeholder.com/300" class="w-full rounded-lg mb-3">
          <span class="absolute top-2 left-2 bg-red-500 text-white text-xs px-2 py-1 rounded">-30%</span>
        </div>
        <h4 class="font-semibold">Nike Air Max Sale</h4>
        <div class="flex items-center gap-2">
          <p class="text-gray-400 line-through text-sm">2.000.000đ</p>
          <p class="text-red-500 font-semibold">1.400.000đ</p>
        </div>
        <button class="mt-3 w-full bg-red-500 text-white py-2 rounded-lg">Mua ngay</button>
      </div>

      <div class="bg-white p-4 rounded-2xl shadow hover:shadow-lg transition">
        <div class="relative">
          <img src="https://via.placeholder.com/300" class="w-full rounded-lg mb-3">
          <span class="absolute top-2 left-2 bg-red-500 text-white text-xs px-2 py-1 rounded">-40%</span>
        </div>
        <h4 class="font-semibold">Adidas NMD Sale</h4>
        <div class="flex items-center gap-2">
          <p class="text-gray-400 line-through text-sm">2.500.000đ</p>
          <p class="text-red-500 font-semibold">1.500.000đ</p>
        </div>
        <button class="mt-3 w-full bg-red-500 text-white py-2 rounded-lg">Mua ngay</button>
      </div>

      <div class="bg-white p-4 rounded-2xl shadow hover:shadow-lg transition">
        <div class="relative">
          <img src="https://via.placeholder.com/300" class="w-full rounded-lg mb-3">
          <span class="absolute top-2 left-2 bg-red-500 text-white text-xs px-2 py-1 rounded">-25%</span>
        </div>
        <h4 class="font-semibold">Puma Future Rider</h4>
        <div class="flex items-center gap-2">
          <p class="text-gray-400 line-through text-sm">1.800.000đ</p>
          <p class="text-red-500 font-semibold">1.350.000đ</p>
        </div>
        <button class="mt-3 w-full bg-red-500 text-white py-2 rounded-lg">Mua ngay</button>
      </div>

    </div>
  </section>

  <!-- New Arrivals Section -->
  <section class="container mx-auto py-10">
    <h3 class="text-2xl font-semibold mb-6 text-center">🆕 HÀNG MỚI VỀ</h3>

    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">

      <div class="bg-white p-4 rounded-2xl shadow hover:shadow-lg transition">
        <img src="https://via.placeholder.com/300" class="w-full rounded-lg mb-3">
        <h4 class="font-semibold">Nike Dunk Low</h4>
        <p class="text-gray-500">2.300.000đ</p>
      </div>

      <div class="bg-white p-4 rounded-2xl shadow hover:shadow-lg transition">
        <img src="https://via.placeholder.com/300" class="w-full rounded-lg mb-3">
        <h4 class="font-semibold">Adidas Forum</h4>
        <p class="text-gray-500">2.100.000đ</p>
      </div>

      <div class="bg-white p-4 rounded-2xl shadow hover:shadow-lg transition">
        <img src="https://via.placeholder.com/300" class="w-full rounded-lg mb-3">
        <h4 class="font-semibold">New Balance 550</h4>
        <p class="text-gray-500">2.400.000đ</p>
      </div>

      <div class="bg-white p-4 rounded-2xl shadow hover:shadow-lg transition">
        <img src="https://via.placeholder.com/300" class="w-full rounded-lg mb-3">
        <h4 class="font-semibold">Puma Suede</h4>
        <p class="text-gray-500">1.700.000đ</p>
      </div>

    </div>
  </section>

  <!-- Brand Section -->
  <section class="bg-white py-8">
    <div class="container mx-auto">
      <h3 class="text-xl font-semibold mb-6 text-center text-center">THƯƠNG HIỆU</h3>
      <div class="grid grid-cols-2 md:grid-cols-6 gap-6 items-center">
        <img src="https://via.placeholder.com/100x50" class="mx-auto grayscale hover:grayscale-0 transition">
        <img src="https://via.placeholder.com/100x50" class="mx-auto grayscale hover:grayscale-0 transition">
        <img src="https://via.placeholder.com/100x50" class="mx-auto grayscale hover:grayscale-0 transition">
        <img src="https://via.placeholder.com/100x50" class="mx-auto grayscale hover:grayscale-0 transition">
        <img src="https://via.placeholder.com/100x50" class="mx-auto grayscale hover:grayscale-0 transition">
        <img src="https://via.placeholder.com/100x50" class="mx-auto grayscale hover:grayscale-0 transition">
      </div>
    </div>
  </section>

  <!-- Blog Section -->
  <section class="bg-white py-12">
    <div class="container mx-auto">
      <h3 class="text-2xl font-semibold mb-8 text-center">Bài viết mới</h3>

      <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

        <!-- Blog Card -->
        <div class="bg-gray-50 rounded-2xl shadow hover:shadow-lg transition overflow-hidden">
          <img src="https://via.placeholder.com/400x250" class="w-full">
          <div class="p-4">
            <h4 class="font-semibold text-lg mb-2">Top 5 đôi giày hot nhất 2026</h4>
            <p class="text-gray-500 text-sm mb-3">Khám phá những mẫu giày đang được ưa chuộng nhất hiện nay.</p>
            <a href="#" class="text-blue-500 text-sm font-medium">Xem thêm →</a>
          </div>
        </div>

        <div class="bg-gray-50 rounded-2xl shadow hover:shadow-lg transition overflow-hidden">
          <img src="https://via.placeholder.com/400x250" class="w-full">
          <div class="p-4">
            <h4 class="font-semibold text-lg mb-2">Cách phối đồ với sneaker</h4>
            <p class="text-gray-500 text-sm mb-3">Gợi ý outfit cực chất khi mang giày thể thao.</p>
            <a href="#" class="text-blue-500 text-sm font-medium">Xem thêm →</a>
          </div>
        </div>

        <div class="bg-gray-50 rounded-2xl shadow hover:shadow-lg transition overflow-hidden">
          <img src="https://via.placeholder.com/400x250" class="w-full">
          <div class="p-4">
            <h4 class="font-semibold text-lg mb-2">Cách bảo quản giày đúng cách</h4>
            <p class="text-gray-500 text-sm mb-3">Giữ giày luôn mới và bền lâu với những mẹo đơn giản.</p>
            <a href="#" class="text-blue-500 text-sm font-medium">Xem thêm →</a>
          </div>
        </div>

      </div>
    </div>
  </section>

  <!-- Footer -->
  <footer class="bg-gray-200 py-10 mt-10">
    <div class="container mx-auto grid grid-cols-1 md:grid-cols-4 gap-8">

      <!-- Logo + Info -->
      <div>
        <img src="https://via.placeholder.com/200x80" class="mb-4">
        <p class="font-semibold mb-2">Hệ thống giày thể thao số 1 Hà Nội</p>
        <p class="text-sm text-gray-600">Hotline: 097.567.1080</p>
        <p class="text-sm text-gray-600 mt-2">Store 1: 57 Quan Hoa, Cầu Giấy, HN</p>
        <p class="text-sm text-gray-600">Store 2: 29 Trần Đại Nghĩa, Hai Bà Trưng, HN</p>
      </div>

      <!-- Support -->
      <div>
        <h4 class="font-semibold mb-4">HỖ TRỢ</h4>
        <ul class="space-y-2 text-sm text-gray-600">
          <li>7 cách bảo quản giày</li>
          <li>thể thao tốt nhất</li>
          <li>Giữ “phong độ” cho Sneaker trắng</li>
          <li>9 kỹ thuật làm đẹp dành cho U30</li>
        </ul>
      </div>

      <!-- Info -->
      <div>
        <h4 class="font-semibold mb-4">THÔNG TIN</h4>
        <ul class="space-y-2 text-sm text-gray-600">
          <li>Giới thiệu</li>
          <li>Hướng dẫn đặt hàng</li>
          <li>Chính sách đổi hàng</li>
          <li>Bảo mật</li>
          <li>Liên hệ</li>
          <li>Hệ thống cửa hàng</li>
        </ul>
      </div>

      <!-- Facebook -->
      <div>
        <h4 class="font-semibold mb-4">XSHOP TRÊN FACEBOOK</h4>
        <div class="bg-white p-3 rounded shadow">
          <p class="font-semibold">XShop New</p>
          <p class="text-sm text-gray-500">1.000.000+ người theo dõi</p>
          <div class="mt-3 h-32 bg-gray-100 flex items-center justify-center text-gray-400 text-sm">
            Facebook Plugin
          </div>
        </div>
      </div>

    </div>

    <div class="text-center text-gray-500 text-sm mt-10">
      © 2026 Sneaker Shop. All rights reserved.
    </div>
  </footer>

</body>
</html>
