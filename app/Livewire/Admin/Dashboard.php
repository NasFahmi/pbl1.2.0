<?php

namespace App\Livewire\Admin;

use App\Models\Transaksi;
use App\Models\Preorder;
use App\Models\Product;
use App\Models\Foto;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;
use Livewire\Attributes\Layout;
use Livewire\Component;
#[Layout('components/layouts/admin')]
class Dashboard extends Component

{
    public $data;
    public $totalPendapatan;
    public $totalProductTerjual;
    public $totalPreorder;
    public $dataJumlahOrder;
    public $topSalesProducts;
    public $preorderRecently;
    public $namaPembeli;
    public $foto;
    public $productRecently;
    public $dataPenjualanFormatted;
    public $tanggalPenjualanFormatted;

    public function mount()
    {
        $this->fetchData();
    }

    public function fetchData()
    {
        $data = Transaksi::with(['pembelis', 'products', 'methode_pembayaran', 'preorders'])->get();
        $totalPendapatan = Transaksi::where('is_complete', 1)->sum('total_harga');
        $totalProductTerjual = Transaksi::where('is_complete', 1)->sum('jumlah');
        $totalPreorder = Transaksi::where('is_complete', 1)->sum('is_Preorder');
        $dataJumlahOrder = $data->count();

        $startDate = Carbon::now()->subDays(30)->startOfDay();
        $endDate = Carbon::now()->endOfDay();

        $namaPembeli = $data->where('is_Preorder', 1)
            ->whereNotNull('pembelis.nama')
            ->sortByDesc('created_at')
            ->pluck('pembelis.nama');

        $topSalesProducts = Transaksi::where('is_complete', 1)
            ->whereNotNull('product_id')
            ->groupBy('product_id')
            ->select('product_id', DB::raw('SUM(jumlah) as totalJumlah'))
            ->orderByDesc('totalJumlah')
            ->with('products')
            ->limit(5)
            ->get();

        $preorderRecently = Preorder::whereHas('transaksis', function ($query) {
            $query->where('is_preorder', 1)->where('is_complete', 0);
        })
            ->latest()
            ->limit(3)
            ->get();

        $productRecently = Product::with('fotos', 'transaksis')
            ->where('tersedia', 1)
            ->latest()->limit(5)->get();

        $foto = Foto::join('transaksis', 'fotos.product_id', '=', 'transaksis.product_id')
            ->where('transaksis.is_complete', 0)
            ->select('fotos.product_id', DB::raw('MAX(fotos.id) as id'), DB::raw('MAX(fotos.foto) as foto'))
            ->groupBy('fotos.product_id')
            ->get();

        $dataPenjualan = Transaksi::where('is_complete', 1)
            ->whereBetween('tanggal', [$startDate, $endDate])
            ->orderBy('tanggal', 'asc')
            ->selectRaw('tanggal, sum(total_harga) as total_penjualan')
            ->groupBy('tanggal')
            ->pluck('total_penjualan', 'tanggal');

        $dataPenjualanFormatted = array_values($dataPenjualan->toArray());

        $tanggalPenjualan = array_keys($dataPenjualan->toArray());

        $tanggalPenjualanFormatted = collect($tanggalPenjualan)->map(function ($tanggal) {
            $carbonDate = Carbon::parse($tanggal);
            $carbonDate->setLocale(App::getLocale());
            return $carbonDate->formatLocalized('%d %B %Y');
        });

        $this->data = $data;
        $this->totalPendapatan = $totalPendapatan;
        $this->totalProductTerjual = $totalProductTerjual;
        $this->totalPreorder = $totalPreorder;
        $this->dataJumlahOrder = $dataJumlahOrder;
        $this->topSalesProducts = $topSalesProducts;
        $this->preorderRecently = $preorderRecently;
        $this->namaPembeli = $namaPembeli;
        $this->foto = $foto;
        $this->productRecently = $productRecently;
        $this->dataPenjualanFormatted = $dataPenjualanFormatted;
        $this->tanggalPenjualanFormatted = $tanggalPenjualanFormatted;
    }
    public function render()
    {
        return view('livewire.admin.dashboard');
    }
}
