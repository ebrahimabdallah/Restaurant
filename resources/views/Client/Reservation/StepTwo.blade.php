<x-guest-layout>
    <div class="container flex justify-center items-center h-screen">
        <div class="w-full max-w-sm">
            <form method="POST" action="{{ route('reservation.store.step.Two') }}" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">   
           @csrf
                @error('table_id')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <div class="mb-8">
                    <img src="https://restaurant.eatapp.co/hubfs/WordPress-Table-Reservation-plugin-1000x562-1.webp"  alt="Image" class="mb-6 w-full" style="max-height: 200px; object-fit: cover;">

                    <label for="table_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">table_id</label>
                    <select class="form-multiselect black w-full mt-1" name="table_id">
                        @foreach($table as $tables)
                        <option value="{{ $tables->id }}" {{ isset($Reservation) && $tables->id == $Reservation->table_id ? 'selected' : '' }}>
                            {{ $tables->name }} (Guests {{ $tables->gust_number }})
                        </option>
                        @endforeach
                    </select>
                </div>

                <div class="flex justify-between">
                    <a href="{{ route('reservation.store.step.One') }}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Previous</a>
                    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Finish</button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>