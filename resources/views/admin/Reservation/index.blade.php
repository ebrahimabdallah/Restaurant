<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    @if(session()->has('message'))
    <div class="alert alert-success">
       {{session()->get('message')}}
    </div>
@endif
    <div class="flex justify-end m-2 p-2">
        
        <a href="{{route('admin.Reservation.create')}}"
            class="px-4 py-2 bg-indigo-500 hover:bg-indigo-700 rounded-lg">New Reservation
        </a>
        </div>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="relative overflow-x-auto">
              
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            
                            <th scope="col" class="px-6 py-3">
                                Name
                            </th>
                          
                            <th scope="col" class="px-6 py-3">
                                phone
                            </th>
                            <th scope="col" class="px-6 py-3">
                                email
                            </th>
                            <th scope="col" class="px-6 py-3">
                                res_data
                            </th>
                            
                            <th scope="col" class="px-6 py-3">
                                Table
                            
                            </th>
                            
                            <th scope="col" class="px-6 py-3">
                                Guest
                            </th>

                            <th scope="col" class="px-6 py-3">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($Reservations as $Reservation)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{$Reservation->firstname}}  {{$Reservation->lastname}}

                            </td>

                            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{$Reservation->tel_number}}
                            </td>

                            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{$Reservation->email}}
                            </td>

                            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{$Reservation->res_data}}
                            </td>


                            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{$Reservation->table->name}}
                            </td>



                            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{$Reservation->gust_number}}
                            </td> 


                           
                            <td>
                                <div class="flex space-x-2">
                                <a href="{{route('admin.Reservation.edit',$Reservation->id)}}" class="px-4 py-2 bg-green-500 hover:bg-green-700 rounded-lg text-white">Edit</a>
                                <form action="{{ route('admin.Reservation.destroy', $Reservation->id) }}" 
                                    method="POST"
                                    onsubmit="return confirm('Are You Sure Delete');"
                                    class="px-4 py-2 bg-red-500 hover:bg-red-700 rounded-lg text-white">
                                  @csrf
                                  @method('DELETE')
                                  <button type="submit" class="text-sm font-medium">Delete</button>
                              </form>
                                </div>
                            </td>
                          
                        </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
            
        </div>
    </div>
</x-admin-layout>
