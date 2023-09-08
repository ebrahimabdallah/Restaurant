<x-admin-layout>
  <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
          {{ __('Dashboard') }}
      </h2>
  </x-slot>

  <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          
          <div class="flex justify-end m-2 p-2">
              <a href="{{ route('admin.Menu.index') }}"
                  class="px-4 py-2 bg-indigo-500 hover:bg-indigo-700 rounded-lg">All Menu
              </a>
          </div>
          
          <form action="{{ route('admin.Menu.store') }}" method="POST" enctype="multipart/form-data">
              @csrf
              @error('name')
              <div class="alert alert-danger">{{ $message }}</div>
          @enderror
              <div class="mb-6">
                  <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
                  <input type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="name@flowbite.com" required>
              </div>
              @error('description')
              <div class="alert alert-danger">{{ $message }}</div>
          @enderror
              <div class="mb-6">
                  <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
                  <input type="text" name="description" id="description" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
              </div>
              @error('category')
              <div class="alert alert-danger">{{ $message }}</div>
          @enderror
              <div class="mb-6">
                <label for="category" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Category</label>
             <select multiple class="form-multiselect black w-full mt-1">
              @foreach($categories as $category)
             <option value="{{$category->id}}">{{$category->name}}</option>
              @endforeach
             </select>
              </div>
              @error('image')
              <div class="alert alert-danger">{{ $message }}</div>
          @enderror
              <div class="mb-6">
                  <label for="image" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Image</label>
                  <input type="file" name="image" id="image" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
              </div>

              @error('price')
              <div class="alert alert-danger">{{ $message }}</div>
          @enderror
              <div class="mb-6">
                <label for="price" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">price</label>
                <input type="number" name="price" id="price" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
            </div>
              <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
          </form>
      </div>
  </div>
</x-admin-layout>