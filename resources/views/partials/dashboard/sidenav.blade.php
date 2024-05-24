<!-- Desktop sidebar -->
<aside class="z-20 hidden w-64 overflow-y-auto bg-white md:block flex-shrink-0 relative">
    <div class="py-4 text-gray-500">
        <div class="flex justify-start items-center">
            {{-- Logo --}}
            <a href="{{ route('admin.dashboard') }}" class="ml-6">
                <img src="{{ asset('assets/images/logo.png') }}" alt="" class="w-10 h-auto">
            </a>
            <div>
                <h1 class="text-lg font-bold text-slate-800">PAWONKOE</h1>
            </div>
        </div>
        <ul class="mt-6">

            <x-sidebar-link active="{{ Request::is('admin/dashboard*') }}" route="admin.dashboard" icon="assets/icon/home.png" label="Dashboard" />

        </ul>

        <ul>
            <x-sidebar-link active="{{ Request::is('admin/transaksi*') }}" route="transaksis.index" icon="assets/icon/clipboard-list-check.png" label="Transaksi" />

            <x-sidebar-link active="{{ Request::is('admin/product*') }}" route="products.index" icon="assets/icon/box-open.png" label="Produk" />

            <x-sidebar-link active="{{ Request::is('admin/preorder*') }}" route="preorders.index" icon="assets/icon/shipping-timed.png" label="Preorder" />

            @if (auth()->check() && auth()->user()->hasRole('superadmin'))
                <x-sidebar-link active="{{ Request::is('admin/piutang*') }}" route="piutang.index" icon="assets/icon/sack-dollar.png" label="Piutang" />
            @endif




            @if (auth()->check() && auth()->user()->hasRole('superadmin'))

                <x-sidebar-link active="{{ Request::is('admin/beban-kewajiban*') }}" route="beban-kewajibans.index" icon="assets/icon/calculator-bill.png" label="Beban Kewajiban" />


            @endif

            <x-sidebar-link active="{{ Request::is('admin/produksi*') }}" route="produksi.index" icon="assets/icon/microwave.png" label="Produksi" />


            @if (auth()->check() && auth()->user()->hasRole('superadmin'))

                <x-sidebar-link active="{{ Request::is('admin/log-activities*') }}" route="log-activities.index" icon="assets/icon/wall-clock.png" label="Log Aktivitas" />

            @endif

        </ul>

    </div>
    <div class="absolute bottom-1 w-full flex justify-center items-center mb-4">
        <p class="text-gray-700">{{ env('APP_VERSION') }}</p>
    </div>
</aside>
<!-- Mobile sidebar -->
<!-- Backdrop -->
<div x-show="isSideMenuOpen" x-transition:enter="transition ease-in-out duration-150"
    x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
    x-transition:leave="transition ease-in-out duration-150" x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
    class="fixed inset-0 z-10 flex items-end bg-black bg-opacity-50 sm:items-center sm:justify-center"></div>
<aside class="fixed inset-y-0 z-20 flex-shrink-0 w-64 mt-16 overflow-y-auto bg-white md:hidden"
    x-show="isSideMenuOpen" x-transition:enter="transition ease-in-out duration-150"
    x-transition:enter-start="opacity-0 transform -translate-x-20" x-transition:enter-end="opacity-100"
    x-transition:leave="transition ease-in-out duration-150" x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0 transform -translate-x-20" @click.away="closeSideMenu"
    @keydown.escape="closeSideMenu">
    <div class="py-4 text-gray-500">
        <div class="flex justify-start items-center">
            <a href="" class="ml-6">
                <img src="{{ asset('assets/images/logo.png') }}" alt="">
            </a>
            <div>
                <h1 class="text-2xl font-bold text-slate-800">PawonKOE</h1>
            </div>
        </div>
        <ul class="mt-6">
            <x-sidebar-link active="{{ Request::is('admin/dashboard*') }}" route="admin.dashboard" icon="assets/icon/home.png" label="Dashboard" />

        </ul>

        <ul>
            <x-sidebar-link active="{{ Request::is('admin/transaksi*') }}" route="transaksis.index" icon="assets/icon/clipboard-list-check.png" label="Transaksi" />

            <x-sidebar-link active="{{ Request::is('admin/product*') }}" route="products.index" icon="assets/icon/box-open.png" label="Produk" />

            <x-sidebar-link active="{{ Request::is('admin/preorder*') }}" route="preorders.index" icon="assets/icon/shipping-timed.png" label="Preorder" />

            @if (auth()->check() && auth()->user()->hasRole('superadmin'))
                <x-sidebar-link active="{{ Request::is('admin/piutang*') }}" route="piutang.index" icon="assets/icon/sack-dollar.png" label="Piutang" />
            @endif


            @if (auth()->check() && auth()->user()->hasRole('superadmin'))

                <x-sidebar-link active="{{ Request::is('admin/beban-kewajiban*') }}" route="beban-kewajibans.index" icon="assets/icon/calculator-bill.png" label="Beban Kewajiban" />


            @endif

            <x-sidebar-link active="{{ Request::is('admin/produksi*') }}" route="produksi.index" icon="assets/icon/microwave.png" label="Produksi" />


            @if (auth()->check() && auth()->user()->hasRole('superadmin'))

                <x-sidebar-link active="{{ Request::is('admin/log-activities*') }}" route="log-activities.index" icon="assets/icon/wall-clock.png" label="Log Aktivitas" />

            @endif

        </ul>
    </div>
    <div class="absolute bottom-1 w-full flex justify-center items-center mb-4">
        <p class="text-gray-700">{{ env('APP_VERSION') }}</p>
    </div>
</aside>
