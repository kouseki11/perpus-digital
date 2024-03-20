<x-admin-layout>
    
    <div class="p-4 py-20 sm:ml-64">
        <div class="text-2xl">
            <p>Users Master</p>
        </div>

        <div class="mt-10">
            <p class="text-xl">List Users</p>
        </div>
        <div class="flex justify-between mt-4">
            <a href="{{ route('users.export') }}" class="text-white inline-flex items-center bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                <svg class="w-6 h-6 text-white dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 15v2a3 3 0 0 0 3 3h10a3 3 0 0 0 3-3v-2m-8 1V4m0 12-4-4m4 4 4-4"/>
                  </svg>                  
                Export Users
            </a>
            <a href="{{ route('admin.users.create') }}" class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path></svg>
                Add User
            </a>
        </div>
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-2">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Name
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Username
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Email
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Role
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Address
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <span class="sr-only">Edit</span>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $user->name }}
                        </th>
                        <td class="px-6 py-4">
                            {{ $user->username }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $user->email }}
                        </td>
                        @if($user->hasRole('administrator'))
                        <td class="px-6 py-4">
                            Administrator
                        </td>
                        @elseif($user->hasRole('staff'))
                        <td class="px-6 py-4">
                            Staff
                        </td>
                        @else
                        <td class="px-6 py-4">
                            Loaner
                        </td>
                        @endif
                        <td class="px-6 py-4">
                            {{ $user->address }}
                        </td>
                        <td class="flex px-6 py-4 text-right justify-between gap-5">
                            <a href="{{ route('admin.users.edit', $user->id) }}" class="text-white focus:ring-4 bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Edit</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
     </div>

</x-admin-layout>


