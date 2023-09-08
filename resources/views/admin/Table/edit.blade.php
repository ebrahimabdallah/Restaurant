<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Update Table') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-end m-2 p-2">
                <a href="{{ route('admin.Table.index') }}" class="px-4 py-2 bg-indigo-500 hover:bg-indigo-700 rounded-lg">Tables</a>
            </div>

            <form action="{{ route('admin.Table.update', $table->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <div class="mb-6">
                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
                    <input type="text" id="name" name="name" value="{{ $table->name }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                </div>
                <div class="mb-6">
                    <label for="location" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Location</label>
                    <select name="location" id="location" class="form-multiselect black w-full mt-">
                        <option value="front" {{ $table->location === 'front' ? 'selected' : '' }}>front</option>
                        <option value="outside" {{ $table->location === 'outside' ? 'selected' : '' }}>outside</option>
                        <option value="inside" {{ $table->location === 'inside' ? 'selected' : '' }}>inside</option>
                    </select>
                </div>
                @error('guest_number')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <div class="mb-6">
                    <label for="guest_number" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Guest Number</label>
                    <input type="number" id="gust_number" name="gust_number" value="{{ $table->gust_number }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                </div>

                <div class="mb-6">
                    <label for="stutas" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Status</label>
                    <select name="stutas" id="stutas" class="form-multiselect black w-full mt-1">
                        <option value="available" {{ $table->stutas === 'available' ? 'selected' : '' }}>available</option>
                        <option value="unavailable" {{ $table->stutas === 'unavailable' ? 'selected' : '' }}>unavailable</option>
                        <option value="pending" {{ $table->stutas === 'pending' ? 'selected' : '' }}>pending</option>
                    </select>
                </div>
                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Update</button>
            </form>
        </div>
    </div>
</x-admin-layout>