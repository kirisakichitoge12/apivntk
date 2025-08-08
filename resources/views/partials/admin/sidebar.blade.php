<aside class="w-60 bg-white border-r overflow-y-auto">
  <div class="p-4 font-semibold border-b">Navigation</div>
  <nav class="p-4 space-y-2">
    <a href="{{ route('admin.dashboard') }}" class="block px-3 py-2 rounded hover:bg-gray-100 {{ request()->routeIs('admin.dashboard') ? 'bg-gray-200' : '' }}">
      Dashboard
    </a>
    <a href="#" class="block px-3 py-2 rounded hover:bg-gray-100">Chuyến bay</a>
    <a href="#" class="block px-3 py-2 rounded hover:bg-gray-100">Người dùng</a>
    {{-- thêm link khác --}}
  </nav>
</aside>
