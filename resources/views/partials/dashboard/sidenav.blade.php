<!-- Desktop sidebar -->
<aside class="relative z-20 flex-shrink-0 hidden w-64 overflow-y-auto bg-white md:block">
    <div class="py-4 text-gray-500">
        <div class="flex items-center justify-start">
            {{-- Logo --}}
            <a href="{{ route('admin.dashboard') }}" class="ml-6">
                <img src="{{ asset('assets/images/logo.png') }}" alt="" class="w-10 h-auto">
            </a>
            <div>
                <h1 class="text-lg font-bold text-slate-800">PAWONKOE</h1>
            </div>
        </div>
        <ul class="mt-6">

            <x-sidebar-link active="{{ Request::is('admin/dashboard*') }}" route="admin.dashboard"
                icon="assets/icon/home.png" label="Dashboard" />

        </ul>

        <ul>
            <x-sidebar-link-group label="Produk">
                <x-sidebar-link active="{{ Request::is('admin/product\*') }}" route="admin.product"
                    icon="assets/icon/box-open.png" label="Produk" />
                <x-sidebar-link active="{{ Request::is('admin/produksi\*') }}" route="admin.produksi"
                    icon="assets/icon/microwave.png" label="Produksi" />
            </x-sidebar-link-group>


            <x-sidebar-link-group label="Keuangan">
                <x-sidebar-link active="{{ Request::is('admin/transaksi*') }}" route="admin.transaksi"
                    icon="assets/icon/clipboard-list-check.png" label="Transaksi" />

                <x-sidebar-link active="{{ Request::is('admin/preorder*') }}" route="admin.preorder"
                    icon="assets/icon/shipping-timed.png" label="Preorder" />

                @if (auth()->check() && auth()->user()->hasRole('superadmin'))
                    <x-sidebar-link active="{{ Request::is('admin/piutang*') }}" route="admin.piutang"
                        icon="assets/icon/sack-dollar.png" label="Piutang" />
                @endif

                @if (auth()->check() && auth()->user()->hasRole('superadmin'))
                    <x-sidebar-link active="{{ Request::is('admin/hutang*') }}" route="admin.hutang"
                        icon="assets/icon/debt.png" label="Hutang" />
                @endif

            </x-sidebar-link-group>
            @if (auth()->check() && auth()->user()->hasRole('superadmin'))
                <x-sidebar-link-group label="Perusahaan">

                    @if (auth()->check() && auth()->user()->hasRole('superadmin'))
                        <x-sidebar-link active="{{ Request::is('admin/beban-kewajiban*') }}"
                            route="admin.beban-kewajiban" icon="assets/icon/calculator-bill.png"
                            label="Beban Kewajiban" />
                    @endif
                    @if (auth()->check() && auth()->user()->hasRole('superadmin'))
                        <x-sidebar-link active="{{ Request::is('admin/modal*') }}" route="admin.modal"
                            icon="assets/icon/top-up.png" label="Modal" />
                    @endif
                    @if (auth()->check() && auth()->user()->hasRole('superadmin'))
                        <x-sidebar-link active="{{ Request::is('admin/log-activitas*') }}" route="admin.log-activitas"
                            icon="assets/icon/wall-clock.png" label="Log Aktivitas" />
                    @endif



                </x-sidebar-link-group>
            @endif

        </ul>

    </div>
</aside>
<!-- Mobile sidebar -->
<!-- Backdrop -->
<div x-show="isSideMenuOpen" x-transition:enter="transition ease-in-out duration-150"
    x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
    x-transition:leave="transition ease-in-out duration-150" x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
    class="fixed inset-0 z-10 flex items-end bg-black bg-opacity-50 sm:items-center sm:justify-center"></div>
<aside class="fixed inset-y-0 z-20 flex-shrink-0 w-64 mt-16 overflow-y-auto bg-white md:hidden" x-show="isSideMenuOpen"
    x-transition:enter="transition ease-in-out duration-150"
    x-transition:enter-start="opacity-0 transform -translate-x-20" x-transition:enter-end="opacity-100"
    x-transition:leave="transition ease-in-out duration-150" x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0 transform -translate-x-20" @click.away="isSideMenuOpen = false"
    @keydown.escape="isSideMenuOpen = false">
    <div class="py-4 text-gray-500">
        <div class="flex items-center justify-start">
            <a href="" class="ml-6">
                <img src="{{ asset('assets/images/logo.png') }}" alt="">
            </a>
            <div>
                <h1 class="text-2xl font-bold text-slate-800">PawonKOE</h1>
            </div>
        </div>
        <ul class="mt-6">
            <x-sidebar-link active="{{ Request::is('admin/dashboard*') }}" route="admin.dashboard"
                icon="assets/icon/home.png" label="Dashboard" />

        </ul>

        <ul>


            <x-sidebar-link active="{{ Request::is('admin/product\*') }}" route="admin.product"
                icon="assets/icon/box-open.png" label="Produk" />
            <x-sidebar-link active="{{ Request::is('admin/produksi\*') }}" route="admin.produksi"
                icon="assets/icon/microwave.png" label="Produksi" />

            <x-sidebar-link active="{{ Request::is('admin/transaksi*') }}" route="admin.transaksi"
                icon="assets/icon/clipboard-list-check.png" label="Transaksi" />

            <x-sidebar-link active="{{ Request::is('admin/preorder*') }}" route="admin.preorder"
                icon="assets/icon/shipping-timed.png" label="Preorder" />

            @if (auth()->check() && auth()->user()->hasRole('superadmin'))
                <x-sidebar-link-group label="Perusahaan">

                    @if (auth()->check() && auth()->user()->hasRole('superadmin'))
                        <x-sidebar-link active="{{ Request::is('admin/beban-kewajiban*') }}"
                            route="admin.beban-kewajiban" icon="assets/icon/calculator-bill.png"
                            label="Beban Kewajiban" />
                    @endif
                    @if (auth()->check() && auth()->user()->hasRole('superadmin'))
                        <x-sidebar-link active="{{ Request::is('admin/modal*') }}" route="admin.modal"
                            icon="assets/icon/top-up.png" label="Modal" />
                    @endif
                    @if (auth()->check() && auth()->user()->hasRole('superadmin'))
                        <x-sidebar-link active="{{ Request::is('admin/log-activitas*') }}"
                            route="admin.log-activitas" icon="assets/icon/wall-clock.png" label="Log Aktivitas" />
                    @endif



                </x-sidebar-link-group>
            @endif


        </ul>
    </div>

</aside>
