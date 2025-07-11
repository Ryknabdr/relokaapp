@php
use Illuminate\Support\Facades\Storage;
@endphp

<x-layouts.app :title="__('Products')">
    <div class="relative mb-6 w-full">
        <flux:heading size="xl">Products</flux:heading>
        <flux:subheading size="lg" class="mb-6">Manage data Products</flux:subheading>
        <flux:separator variant="subtle" />
    </div>

    <div class="flex justify-between items-center mb-4">
        <div>
            <form action="{{ route('products.index') }}" method="get">
                @csrf
                <flux:input icon="magnifying-glass" name="q" value="{{ $q }}" placeholder="Search Products" />
            </form>
        </div>
        <div>
            <flux:button icon="plus">
                <flux:link href="{{ route('products.create') }}" variant="subtle">Add New Product</flux:link>
            </flux:button>
        </div>
    </div>

    @if(session()->has('successMessage'))
        <div class="mb-3 w-full rounded bg-lime-100 border border-lime-400 text-lime-800 px-4 py-3">
            {{ session()->get('successMessage') }}
        </div>
    @endif

    <div class="overflow-x-auto">
        <table class="min-w-full leading-normal border border-gray-300 rounded-lg overflow-hidden table-fixed">
            <thead class="bg-gray-200">
                <tr>
                    <th class="w-10 px-5 py-3 border-b border-gray-300 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                        ID
                    </th>
                    <th class="w-16 px-5 py-3 border-b border-gray-300 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                        Image
                    </th>
                    <th class="w-32 px-5 py-3 border-b border-gray-300 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                        Name
                    </th>
                    <th class="w-24 px-5 py-3 border-b border-gray-300 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                        Slug
                    </th>
                    <th class="w-48 px-5 py-3 border-b border-gray-300 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                        Description
                    </th>
                    <th class="w-20 px-5 py-3 border-b border-gray-300 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                        SKU
                    </th>
                    <th class="w-20 px-5 py-3 border-b border-gray-300 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                        Price
                    </th>
                    <th class="w-16 px-5 py-3 border-b border-gray-300 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                        Stock
                    </th>
                    <th class="w-28 px-5 py-3 border-b border-gray-300 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                        Product Category ID
                    </th>
                    <th class="w-32 px-5 py-3 border-b border-gray-300 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                        Image URL
                    </th>
                    <th class="w-16 px-5 py-3 border-b border-gray-300 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                        Active
                    </th>
                    <th class="w-28 px-5 py-3 border-b border-gray-300 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                        Created At
                    </th>
                    <th class="w-28 px-5 py-3 border-b border-gray-300 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                        Updated At
                    </th>
                    <th class="w-20 px-5 py-3 border-b border-gray-300 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                        Actions
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white">
                @foreach($products as $key=>$product)
                    <tr class="border-b border-gray-300 hover:bg-gray-50">
                        <td class="px-5 py-5 text-sm text-gray-900 whitespace-nowrap">
                            {{ $product->id }}
                        </td>
                        <td class="px-5 py-5 text-sm text-gray-900 whitespace-nowrap">
@if($product->image_url)
    <img src="{{ url('/storage/' . $product->image_url) }}" alt="{{ $product->name }}" class="h-10 w-10 object-cover rounded">
@else
    <div class="h-10 w-10 bg-gray-200 flex items-center justify-center rounded">
        <span class="text-gray-500 text-sm">N/A</span>
    </div>
@endif
                        </td>
                        <td class="px-5 py-5 text-sm text-gray-900 whitespace-nowrap">
                            {{ $product->name }}
                        </td>
                        <td class="px-5 py-5 text-sm text-gray-900 whitespace-nowrap">
                            {{ $product->slug }}
                        </td>
                        <td class="px-5 py-5 text-sm text-gray-900 whitespace-nowrap">
                            {{ $product->description }}
                        </td>
                        <td class="px-5 py-5 text-sm text-gray-900 whitespace-nowrap">
                            {{ $product->sku }}
                        </td>
                        <td class="px-5 py-5 text-sm text-gray-900 whitespace-nowrap">
                            {{ $product->price }}
                        </td>
                        <td class="px-5 py-5 text-sm text-gray-900 whitespace-nowrap">
                            {{ $product->stock }}
                        </td>
                        <td class="px-5 py-5 text-sm text-gray-900 whitespace-nowrap">
                            {{ $product->category ? $product->category->name : '-' }}
                        </td>
                        <td class="px-5 py-5 text-sm text-gray-900 whitespace-nowrap">
                            {{ $product->image_url }}
                        </td>
                        <td class="px-5 py-5 text-sm text-gray-900 whitespace-nowrap">
                            {{ $product->is_active ? 'Yes' : 'No' }}
                        </td>
                        <td class="px-5 py-5 text-sm text-gray-900 whitespace-nowrap">
                            {{ $product->created_at }}
                        </td>
                        <td class="px-5 py-5 text-sm text-gray-900 whitespace-nowrap">
                            {{ $product->updated_at }}
                        </td>
                        <td class="px-5 py-5 text-sm text-gray-900 whitespace-nowrap">
                            <flux:dropdown>
                                <flux:button icon:trailing="chevron-down">Actions</flux:button>
                                <flux:menu>
                                    <flux:menu.item icon="pencil" href="{{ route('products.edit', $product->id) }}">Edit</flux:menu.item>
                                    <flux:menu.item icon="trash" variant="danger" onclick="event.preventDefault(); if(confirm('Are you sure you want to delete this product?')) document.getElementById('delete-form-{{ $product->id }}').submit();">Delete</flux:menu.item>
                                    <form id="delete-form-{{ $product->id }}" action="{{ route('products.destroy', $product->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </flux:menu>
                            </flux:dropdown>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-layouts.app>
