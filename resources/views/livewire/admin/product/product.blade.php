<div>
    @if ($data->isEmpty())
        <div class="container  px-6 pb-6 mx-auto">
            <h1 class="text-2xl my-6 font-semibold text-gray-700 ">Product</h1>
            <div class="flex justify-center items-center gap-2 md:gap-4 flex-col-reverse md:flex-row mb-4">
                <form class="w-full" method="GET" action="">
                    <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only">Search</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                            </svg>
                        </div>
                        {{-- @foreach ($data as $product) --}}
                        <!-- Tampilkan informasi produk -->
                        <form action="" method="GET">
                            <input type="search" id="default-search" name="search"
                                class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500"
                                placeholder="Search Product... ">
                            <button type="submit"
                                class="text-white absolute end-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 duration-300">Search</button>
                        </form>
                        {{-- @endforeach --}}
                    </div>
                </form>
                <a href="{{ route('admin.product.create') }}"
                    class="text-center focus:outline-none text-white w-full md:w-fit bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-3 me-2 mb duration-300 whitespace-nowrap">
                    Add Product
                </a>
            </div>
            <p>Tidak ada Product</p>
        @else
            <div class="container  px-6 pb-6 mx-auto">
                <h1 class="text-2xl my-6 font-semibold text-gray-700 ">Product</h1>
                <div class="flex justify-center items-center gap-2 md:gap-4 flex-col-reverse md:flex-row mb-4">
                    <form class="w-full" method="GET" action="">
                        <label for="default-search"
                            class="mb-2 text-sm font-medium text-gray-900 sr-only">Search</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                                </svg>
                            </div>
                            {{-- @foreach ($data as $product) --}}
                            <!-- Tampilkan informasi produk -->
                            <form action="" method="GET">
                                <input type="search" id="default-search" name="search"
                                    class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500"
                                    placeholder="Search Product... ">
                                <button type="submit"
                                    class="text-white absolute end-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 duration-300">Search</button>
                            </form>
                            {{-- @endforeach --}}
                        </div>
                    </form>

                    <a href="{{ route('admin.product.create') }}"
                        class="text-center focus:outline-none text-white w-full md:w-fit bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-3 me-2 mb duration-300 whitespace-nowrap">
                        Add Product
                    </a>
                </div>
                <div class="w-full">

                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead
                                class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="p-4">
                                        <div class="flex items-center">
                                            <input id="checkbox-all-search" type="checkbox"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                            <label for="checkbox-all-search" class="sr-only">checkbox</label>
                                        </div>
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Gambar Product
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Nama Product
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Harga
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Stok
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Status
                                    </th>
                                    <th scope="col" class="text-center px-6 py-3">
                                        Action
                                    </th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($data as $items)
                                    <tr
                                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                        <td class="w-4 p-4">
                                            <div class="flex items-center">
                                                <input id="checkbox-table-search-1" type="checkbox"
                                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                                <label for="checkbox-table-search-1" class="sr-only">checkbox</label>
                                            </div>
                                        </td>
                                        <th scope="row"
                                            class="flex items-center px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            <img class="w-12 h-12 rounded-xl"
                                                src="{{ asset($items->fotos->first()->foto) }}" alt="PRODUCT">
                                        </th>
                                        <th scope="row"
                                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            <p>{{ $items->nama_product }}</p>

                                        </th>
                                        <td class="px-6 py-4">
                                            <p class="text-gray-900">{{ $items->harga }}</p>
                                        </td>
                                        <td class="px-6 py-4">
                                            <p class="text-gray-900">{{ $items->stok }}</p>
                                        </td>
                                        <td class="px-6 py-4">
                                            @if ($items->tersedia == 1)
                                                <div class="flex items-center">
                                                    <div class="h-2.5 w-2.5 rounded-full bg-green-500 me-2"></div>
                                                    <p class="text-green-500">Tersedia</p>

                                                </div>
                                            @else
                                                <div class="flex items-center">
                                                    <div class="h-2.5 w-2.5 rounded-full bg-red-500 me-2">
                                                        <p class="text-red-500">Tidak Tersedia</p>
                                                    </div>

                                                </div>
                                            @endif
                                        </td>
                                        {{-- <td class="px-6 py-4">
                                            <div class="flex justify-center items-center">
                                                <a href="#"
                                                    class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                                            </div>
                                        </td> --}}
                                        <td class="px-6 py-4 ">
                                            <div class="flex justify-center items-center gap-2">
                                                <a href="{{ route('admin.product.detail', $items->id) }}"
                                                    class="font-medium text-slate-900 dark:text-slate-900 hover:underline">Detail</a>
                                                @if (auth()->check() && (auth()->user()->hasRole('superadmin') || auth()->user()->can('edit-product')))
                                                    <a href="{{ route('admin.product.edit', $items->id) }}"
                                                        class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                                                    <button onclick="deleteProduct({{ $items->id }})"
                                                        class="font-medium text-red-600 dark:text-red-500 hover:underline">Remove</button>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
            @if ($totalProduct > 12)
                <div class="mt-4 flex flex-col items-center justify-center">
                    <div class="flex items-center space-x-4">
                        {{ $data->links('pagination::tailwind') }}
                    </div>
                    <div class="mt-2 text-sm text-gray-700">
                        Page {{ $data->currentPage() }} of {{ $data->lastPage() }}
                    </div>
                </div>
            @endif
    @endif
    <script>
        function deleteProduct($id) {
            Swal.fire({
                title: "Apakah yakin ingin menghapus Product?",
                text: "tidak ada kata kata, yang ada hanyalah bukti nyata",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: "Deleted!",
                        text: "Product berhasil dihapus",
                        icon: "success"
                    });

                    Livewire.dispatch('deleteProduct', {
                        idProduct: $id
                    });
                }
            });

        }
    </script>
</div>
