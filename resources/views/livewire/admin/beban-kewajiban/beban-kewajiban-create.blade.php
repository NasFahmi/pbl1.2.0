<div>
    <div class="container px-6 pb-6 mx-auto">
        <x-beardcumb menu='Beban Kewajiban' submenu='Create' routemenu='admin.beban-kewajiban' />
        <h1 class="text-2xl my-6 font-semibold text-gray-700">Tambah Beban & Kewajiban</h1>
        <div class="bg-white px-8 py-8 shadow-lg rounded-3xl">
            <form wire:submit.prevent="store">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">
                    <div class="left">
                        <div class="max-w-lg">
                            <div class="flex justify-start items-start flex-col ">
                                <div class="w-full">
                                    <label for="jenis"
                                        class="block mb-2 text-sm font-medium text-gray-700">Jenis</label>
                                    <select wire:model="jenisBebanKewajibanId"
                                        class="bg-gray-50 border max-w-4xl border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                        <option value="">Pilih Jenis Beban Kewajiban</option>
                                        @foreach ($jenisBebanKewajiban as $id => $jenis)
                                            <option value="{{ $id }}">{{ $jenis }}</option>
                                        @endforeach
                                    </select>
                                    @error('jenisBebanKewajibanId')
                                        <small class="error" style="color: red">{{ $message }}</small>
                                    @enderror

                                    <x-modal>
                                        <x-slot name="title">Tambah Beban Kewajiban</x-slot>
                                        <x-slot name="message">Masukkan nama beban kewajiban</x-slot>
                                        <x-slot name="cancelButtonLabel">Batal</x-slot>
                                        <x-slot name="form">
                                            <label for="nama"
                                                class="block mb-2 text-sm font-medium  text-gray-700">Jenis Beban
                                                Kewajiban</label>
                                            <input type="text" placeholder="Jenis Beban Kewajiban"
                                                wire:model="addJenisBebanKewajian"
                                                class="bg-gray-50 border w-full border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block  " />
                                            @error('addJenisBebanKewajian')
                                                <small class="error" style="color: red">{{ $message }}</small>
                                            @enderror
                                        </x-slot>
                                        <x-slot name="buttonConfirm">
                                            <button wire:click="addBebanKewajiban" type="button"
                                                class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-green-600 text-base font-medium text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:ml-3 sm:w-auto sm:text-sm">
                                                Konfirmasi
                                            </button>
                                        </x-slot>
                                        Tambah Jenis Kewajiban
                                    </x-modal>
                                </div>

                                <div class="w-full mt-1">
                                    <label for="nama"
                                        class="block mb-2 text-sm font-medium  text-gray-700">Nama</label>
                                    <input type="text" placeholder="Nama" wire:model="nama"
                                        value="{{ old('nama') }}"
                                        class="bg-gray-50 border max-w-4xl border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full  p-2.5 " />
                                    @error('nama')
                                        <small class="error" style="color: red">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="right">
                        <div class="w-full">
                            <label for="nominal" class="block mb-2 text-sm font-medium text-gray-700">Nominal</label>
                            <input type="number" placeholder="Nominal" wire:model="nominal"
                                value="{{ old('nominal') }}"
                                class="bg-gray-50 border max-w-4xl border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full  p-2.5 " />
                            @error('nominal')
                                <small class="error" style="color: red">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="w-full mt-5">
                            <label for="" class="block pt-2 text-sm font-medium text-gray-800">Tanggal</label>
                            <div class="relative max-w-lg mt-2">
                                <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                                    </svg>
                                </div>
                                <input type="date" wire:model="tanggal" value="{{ old('tanggal') }}"
                                    class="bg-gray-50 border max-w-4xl border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="Select date">
                            </div>
                            @error('tanggal')
                                <small class="error" style="color: red">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="flex justify-center items-center mt-8">
                    <button type="submit"
                        class="bg-green-400 text-gray-100 px-4 py-2 w-full lg:w-fit rounded-lg hover:bg-green-500 duration-300">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
