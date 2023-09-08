<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
            
    <div class="flex justify-end m-2 p-2">
        <a href="{{route('admin.Reservation.index')}}" class="px-4 py-2 bg-indigo-500 hover:bg-indigo-700 rounded-lg">All Reservation</a>
    </div>

    <form  method="POST" action="{{route('admin.Reservation.update',$Reservation->id)}}" >
        @csrf
        @method('PUT')
        @error('firstname')
    <div class="alert alert-danger">{{ $message }}</div>
@enderror
        <div class="mb-6">
            <label for="firstname" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">firstname</label>
            <input type="text" id="firstname" name="firstname" value="{{$Reservation->firstname}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 @error('firstname') is-invalid @enderror"  >
        </div>
        @error('lastname')
    <div class="alert alert-danger">{{ $message }}</div>
@enderror
        <div class="mb-6">
            <label for="lastname" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">lastname</label>
            <input type="text" id="lastname" name="lastname" value="{{$Reservation->lastname}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 @error('lastname') is-invalid @enderror" >
        </div>
        @error('tel_number')
    <div class="alert alert-danger">{{ $message }}</div>
@enderror
        <div class="mb-6">
            <label for="tel_number" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">tel_number</label>
            <input type="string" id="tel_number" name="tel_number" value="{{$Reservation->tel_number}}"class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="name@flowbite.com" >
        </div>
        @error('email')
    <div class="alert alert-danger">{{ $message }}</div>
@enderror
        <div class="mb-6">
            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">email</label>
            <input type="email" id="email" name="email" value="{{$Reservation->email}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" >
        </div>
        @error('res_data')
    <div class="alert alert-danger">{{ $message }}</div>
@enderror
<div class="mb-6">
    <label for="res_data" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">res_data</label>
    <input type="datetime-local" id="res_data" name="res_data" value="{{$Reservation->res_data}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="YYYY-MM-DD HH:MM" >
</div>
        @error('table_id')
    <div class="alert alert-danger">{{ $message }}</div>
@enderror
        <div class="mb-6">
            <label for="table_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">table_id</label>
         <select  class="form-multiselect black w-full mt-1" name="table_id">
          @foreach($table as $tables)
         <option value="{{$tables->id}}"@selected($tables->id==$Reservation->table_id)>{{$tables->name}}(Guests {{$tables->gust_number}})</option>
          @endforeach
         </select>
          </div>
          @error('gust_number')
    <div class="alert alert-danger">{{ $message }}</div>
@enderror
        <div class="mb-6">
            <label for="gust_number" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">gust_number</label>
            <input type="number" id="gust_number" name="gust_number" value="{{$Reservation->gust_number}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" >
        </div>
        
        <div class="mb-6">
            <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
        </div>
    </form>
</x-admin-layout>