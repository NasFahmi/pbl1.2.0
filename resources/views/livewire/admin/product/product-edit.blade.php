<div>
    <div class="container  px-6 pb-6 mx-auto">

        <button onclick="deleteImage()">KLIK</button>

        <x-beardcumb menu='product' submenu='create' routemenu='admin.product' />
        <h1 class="text-2xl font-semibold text-gray-700 mb-6">Create Product</h1>
        <div class="bg-white  px-8 py-8 shadow-lg rounded-3xl">

            <form wire:submit.prevent="update">
                @csrf
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 ">
                    <div class="left">
                        <div class="">
                            <label class="block text-sm mb-1">
                                <span class="text-gray-700 dark:text-gray-400">Nama Product</span>
                            </label>
                            <input type="text" placeholder="nama product" wire:model="nama_product"
                                value="{{ old('nama_product') }}" required
                                class="bg-gray-50 border max-w-4xl border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full  p-2.5 " />
                            @error('nama_product')
                                <small class="error" style="color: red">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="">
                            <label class="block text-sm mt-3 mb-1">
                                <span class="text-gray-700 dark:text-gray-400">Harga</span>
                            </label>
                            <input type="number" placeholder="Harga" wire:model="harga"
                                value="{{ old('harga') }}"required
                                class="bg-gray-50 border max-w-4xl border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full  p-2.5  " />
                            @error('harga')
                                <small class="error" style="color: red">{{ $message }}</small>
                            @enderror

                        </div>


                    </div>
                    <div class="right">
                        <div class="">
                            <label class="block text-sm mb-1">
                                <span class="text-gray-700 dark:text-gray-400 ">Link Shopee</span>
                            </label>
                            <input type="text" placeholder="Link Shopee" wire:model="link_shopee"
                                value="{{ old('link_shopee') }}" required
                                class="bg-gray-50 border max-w-4xl border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full  p-2.5  " />
                            @error('link_shopee')
                                <small class="error" style="color: red">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="">
                            <label class="block text-sm mb-1 mt-3">
                                <span class="text-gray-700 dark:text-gray-400">Stok</span>
                            </label>
                            <input type="number" placeholder="Jumlah Stok" wire:model="stok"
                                value="{{ old('stok') }}" required
                                class="bg-gray-50 border max-w-4xl border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full  p-2.5  " />
                            @error('stok')
                                <small class="error" style="color: red">{{ $message }}</small>
                            @enderror
                        </div>

                    </div>

                </div>
                <div>
                    <label class="block  text-sm text-gray-700 mt-3">Ketersediaan Produk</label>
                    <div class="mt-2">
                        @foreach (['1' => 'Tersedia', '0' => 'Tidak Tersedia'] as $value => $label)
                            <label class="inline-flex items-center">
                                <input type="radio" class="form-radio" wire:model="tersedia"
                                    value="{{ $value }}">
                                <span class="ml-2">{{ $label }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>
                <div class="">
                    <label class="block text-sm mb-1 mt-3">
                        <span class="text-gray-700 dark:text-gray-400">Deskripsi Product</span>
                    </label>
                    <div class="" wire:ignore>
                        <textarea id='deskripsi' class="deskripsi" wire:model="deskripsi">
                            {{ $deskripsi }}
                        </textarea>
                    </div>
                    @error('deskripsi')
                        <small class="error" style="color: red">{{ $message }}</small>
                    @enderror
                </div>
                <div class="">
                    <label class="block text-sm mb-1 mt-3">
                        <span class="text-gray-700 dark:text-gray-400">Spesifikasi Product</span>
                    </label>
                    <div class="" wire:ignore>
                        <textarea id='spesifikasi' class="spesifikasi" wire:model="spesifikasi">
                            {{ $spesifikasi }}
                        </textarea>
                    </div>
                    @error('spesifikasi')
                        <small class="error" style="color: red">{{ $message }}</small>
                    @enderror
                </div>

                <div class=" mt-4">
                    <p class="text-gray-700 font-semibold text-left  mb-2">Gambar lama</p>
                    <div class="flex justify-start items-center gap-4">
                        @if (!empty($existingImages))
                            @foreach ($existingImages as $image)
                                <div
                                    class="flex items-center justify-center font-medium text-gray-900 whitespace-nowrap flex-col">
                                    <img class="w-36 h-36 rounded-xl" src="{{ $image['temporaryUrl'] }}"
                                        alt="{{ $image['name'] }}">
                                    <button onclick="deleteImage({{ $image['id'] }})"
                                        class="text-red-500 hover:text-red-700">
                                        Delete
                                    </button>
                                </div>
                            @endforeach
                        @else
                            <p>No existing images found.</p>
                        @endif
                    </div>
                    <label for="image" class="text-gray-700 font-semibold text-left  mb-2">Pilih Gambar</label>

                    <livewire:dropzone wire:model="image" :rules="['image', 'mimes:png,jpeg,jpg']" :multiple="true" />

                    @error('image')
                        <small class="error" style="color: red">{{ $message }}</small>
                    @enderror
                    @error('image.*')
                        <small class="error" style="color: red">{{ $message }}</small>
                    @enderror

                </div>


                <div class="flex justify-center items-center mt-3">
                    <button type="submit"
                        class="text-center focus:outline-none text-white w-full md:w-fit bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-3 me-2 mb duration-300 whitespace-nowrap">Submit</button>
                </div>
            </form>
        </div>
    </div>
    <script src="{{ asset('assets/js/tinymce/tinymce.min.js') }}" referrerpolicy="origin"></script>
    <script>
        function deleteImage($id) {
            Swal.fire({
                title: "Apakah yakin ingin menghapus gambar?",
                text: "Gambar bisa diupload ulang,",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: "Deleted!",
                        text: "Gambar berhasil dihapus",
                        icon: "success"
                    });

                    Livewire.dispatch('deleteImage', {
                        idGambar: $id
                    });
                }
            });

        }
        tinymce.init({
            selector: 'textarea#deskripsi', // Replace this CSS selector to match the placeholder element for TinyMCE
            plugins: 'code table lists',
            toolbar: 'undo redo | blocks | bold italic | alignleft aligncenter alignright | indent outdent | bullist numlist | table',
            setup: function(editor) {
                editor.on('change', function(e) {
                    @this.set('deskripsi', editor.getContent());
                    // console.log(editor.getContent())
                });
            }
        });

        tinymce.init({
            selector: 'textarea#spesifikasi', // Replace this CSS selector to match the placeholder element for TinyMCE
            plugins: 'code table lists',
            toolbar: 'undo redo | blocks | bold italic | alignleft aligncenter alignright | indent outdent | bullist numlist | table',
            setup: function(editor) {
                editor.on('change', function(e) {
                    @this.set('spesifikasi', editor.getContent());
                });
            }
        });
    </script>

</div>
