<div>
    <div class="container  px-6 pb-6 mx-auto">
        <x-beardcumb menu='product' submenu='create' routemenu='' />
        <h1 class="text-2xl font-semibold text-gray-700 mb-6">Create Product</h1>
        <div class="bg-white  px-8 py-8 shadow-lg rounded-3xl">

            <form action="" class="" enctype="multipart/form-data">
                @csrf
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 ">
                    <div class="left">
                        <div class="">
                            <label class="block text-sm mb-1">
                                <span class="text-gray-700 dark:text-gray-400">Nama Product</span>
                            </label>
                            <input type="text" placeholder="nama product" name="nama_product"
                                value="{{ old('nama_product') }}"
                                class="bg-gray-50 border max-w-4xl border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full  p-2.5 " />
                            @error('nama_product')
                                <small class="error" style="color: red">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="">
                            <label class="block text-sm mt-3 mb-1">
                                <span class="text-gray-700 dark:text-gray-400">Harga</span>
                            </label>
                            <input type="number" placeholder="Harga" name="harga" value="{{ old('harga') }}"
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
                            <input type="text" placeholder="Link Shopee" name="link_shopee"
                                value="{{ old('link_shopee') }}"
                                class="bg-gray-50 border max-w-4xl border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full  p-2.5  " />
                            @error('link_shopee')
                                <small class="error" style="color: red">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="">
                            <label class="block text-sm mb-1 mt-3">
                                <span class="text-gray-700 dark:text-gray-400">Stok</span>
                            </label>
                            <input type="number" placeholder="Jumlah Stok" name="stok" value="{{ old('stok') }}"
                                class="bg-gray-50 border max-w-4xl border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full  p-2.5  " />
                            @error('stok')
                                <small class="error" style="color: red">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- <div class="">
                            <label class="block text-sm mb-1">
                                <span class="text-gray-700 dark:text-gray-400">Varian Product</span>
                            </label>
                        </div>
                        <div id="form-container">
                            <!-- Formulir input awal -->
                            <div class="form-group flex justify-center items-center gap-2">

                            </div>
                        </div> --}}

                        {{-- <button type="button" onclick="addInput()" class="text-green-400">Tambah Varian</button> --}}
                    </div>

                </div>
                <div class="">
                    <label class="block text-sm mb-1 mt-3">
                        <span class="text-gray-700 dark:text-gray-400">Deskripsi Product</span>
                    </label>

                    <textarea id='deskripsi' name="deskripsi" class="tinymce-editor">{{ old('deskripsi') }}</textarea>
                    @error('deskripsi')
                        <small class="error" style="color: red">{{ $message }}</small>
                    @enderror
                </div>
                <div class="">
                    <label class="block text-sm mb-1 mt-3">
                        <span class="text-gray-700 dark:text-gray-400">Spesifikasi Product</span>
                    </label>
                    <textarea id='spesifikasi' name="spesifikasi" class="tinymce-editor">{{ old('spesifikasi') }}</textarea>
                    @error('spesifikasi')
                        <small class="error" style="color: red">{{ $message }}</small>
                    @enderror
                </div>
                <div class=" mt-4">
                    <label for="image" class="text-gray-700 font-semibold text-left  mb-2">Pilih Gambar</label>

                    <livewire:dropzone wire:model="image" :rules="['image', 'mimes:png,jpeg,jpg']" :multiple="true" />

                    @error('image')
                        <small class="error" style="color: red">{{ $message }}</small>
                    @enderror
                    @error('image.*')
                        <small class="error" style="color: red">{{ $message }}</small>
                    @enderror

                </div>

                {{-- @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                            
                        </ul>
                    </div>
                @endif --}}

                <div class="flex justify-center items-center mt-3">
                    <button type="submit" id="submitbtn" disabled
                        class="text-center focus:outline-none text-white w-full md:w-fit bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-3 me-2 mb duration-300 whitespace-nowrap">Submit</button>
                </div>
            </form>
        </div>
    </div>
    <script src="{{ asset('assets/js/tinymce/tinymce.min.js') }}" referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: 'textarea#deskripsi', // Replace this CSS selector to match the placeholder element for TinyMCE
            plugins: 'code table lists',
            toolbar: 'undo redo | blocks | bold italic | alignleft aligncenter alignright | indent outdent | bullist numlist | table'
        });

        tinymce.init({
            selector: 'textarea#spesifikasi', // Replace this CSS selector to match the placeholder element for TinyMCE
            plugins: 'code table lists',
            toolbar: 'undo redo | blocks | bold italic | alignleft aligncenter alignright | indent outdent | bullist numlist | table'
        });
    </script>

</div>
