@extends('layout')

@section('title', 'Daftar Produk')

@section('content')
    <div class="container mx-auto grid grid-cols-1 md:grid-cols-3 gap-8">
        @if (!empty($nama))
            @foreach ($nama as $index => $item)
                <div class="bg-gray-100 rounded-lg shadow-lg p-6">
                    <h2 class="text-2xl font-semibold mb-4 text-blue-600">Produk {{$index + 1}}</h2>
                    <p class="text-gray-700 mb-2">Nama: {{ $item }}</p>
                    <p class="text-gray-700 mb-2">Deskripsi: {{ $desc[$index] ?? 'Deskripsi tidak tersedia' }}</p>
                    <p class="text-gray-700 mb-2">Harga: {{ $harga[$index] ?? 'Harga tidak tersedia' }}</p>
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mt-4">Beli Sekarang</button>
                    @if (isset($reviews[$index]) && is_array($reviews[$index]) && count($reviews[$index]) > 0)
                        @include('components.product_reviews', ['reviews' => $reviews[$index]])
                    @else
                        <p class="text-gray-700">Tidak ada ulasan</p>
                    @endif
                </div>
            @endforeach
        @else
            <p class="text-gray-700">Tidak ada produk yang tersedia.</p>
        @endif
        
        <div>
            <h1 class="text-3xl font-bold mb-6 text-blue-600">Input Produk</h1>
            <form method="POST" action="{{ route('produk.simpan') }}">
                @csrf
                <table class="table-auto w-full">
                    <tr>
                        <td>Nama:</td>
                        <td colspan="3"><input type="text" class="border border-gray-300 rounded p-2 w-full" id="nama" name="nama"></td>
                    </tr>
                    <tr>
                        <td>Deskripsi:</td>
                        <td colspan="3"><textarea class="border border-gray-300 rounded p-2 w-full" id="deskripsi" name="deskripsi"></textarea></td>
                    </tr>
                    <tr>
                        <td>Harga:</td>
                        <td colspan="3"><input type="number" class="border border-gray-300 rounded p-2 w-full" id="harga" name="harga"></td>
                    </tr>
                </table>
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mt-4">Simpan</button>
            </form>
        </div>
    </div>

    <div class="mt-8">
        <table class="min-w-full bg-white border border-gray-200">
            <thead class="bg-gray-200">
                <tr>
                    <th class="px-4 py-2 border">No</th>
                    <th class="px-4 py-2 border">Nama Produk</th>
                    <th class="px-4 py-2 border">Deskripsi Produk</th>
                    <th class="px-4 py-2 border">Harga Produk</th>
                    <th class="px-4 py-2 border">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($nama as $index => $item)
                <tr class="border-t">
                    <td class="px-4 py-2 border">{{ $index + 1 }}</td>
                    <td class="px-4 py-2 border">{{ $item }}</td>
                    <td class="px-4 py-2 border">{{ $desc[$index] }}</td>
                    <td class="px-4 py-2 border">{{ $harga[$index] }}</td>
                    <td class="px-4 py-2 border">
                        <form action="{{ route('produk.delete', $index) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-800" onclick="return confirm('Are you sure you want to delete {{ $item }}?')">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
