<div>
    <div class="my-2 flex sm:flex-row flex-col justify-center bg-gray-100 p-2 shadow-sm">
        <div class="flex flex-row mb-1 sm:mb-0">
            <div class="relative">
                <select wire:model="pagination"
                    class="appearance-none h-full rounded-l border block appearance-none w-full bg-white border-gray-400 text-gray-700 py-2 px-4 pr-8 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                    <option value="5">5</option>
                    <option value="10">10</option>
                    <option value="20">20</option>
                </select>

            </div>

            <div class="relative">
                <select wire:model="filter"
                    class="appearance-none h-full rounded-r border-t sm:rounded-r-none sm:border-r-0 border-r border-b block appearance-none w-full bg-white border-gray-400 text-gray-700 py-2 px-4 pr-8 leading-tight focus:outline-none focus:border-l focus:border-r focus:bg-white focus:border-gray-500">
                    <option value="null">All</option>
                    <option value="1">Finalized</option>
                    <option value="unapproved">Unapproved</option>
                    <option value="review">For Review By Osh Department</option>
                    <option value="unresponsive">Assigned But No Response</option>
                    <option value="toMe">Assigned To Me</option>
                </select>

            </div>
        </div>
        <div class="block relative">
            <span class="h-full absolute inset-y-0 left-0 flex items-center pl-2">
                <svg viewBox="0 0 24 24" class="h-4 w-4 fill-current text-gray-500">
                    <path
                        d="M10 4a6 6 0 100 12 6 6 0 000-12zm-8 6a8 8 0 1114.32 4.906l5.387 5.387a1 1 0 01-1.414 1.414l-5.387-5.387A8 8 0 012 10z">
                    </path>
                </svg>
            </span>
            <input placeholder="Search" wire:model="search"
                class="appearance-none rounded-r rounded-l sm:rounded-l-none border border-gray-400 border-b block pl-8 pr-6 py-2 w-full bg-white text-sm placeholder-gray-400 text-gray-700 focus:bg-white focus:placeholder-gray-600 focus:text-gray-700 focus:outline-none" />
        </div>

    </div>
    <table class="table-auto w-full" wire:loading.class="cursor-wait">
        <thead>
            <tr class="bg-gray-400">
                <th class="pr-5 pl-5 border-r border-t border-l border-gray-300 cursor-pointer">AWB</th>
                <th wire:click.prevent="sortBy('staff')"
                    class="pr-5 pl-5  border-r border-t border-gray-300 cursor-pointer">Release Date</th>
                <th wire:click.prevent="sortBy('staff')"
                    class="pr-5 pl-5  border-r border-t border-gray-300 cursor-pointer">Manifest Number</th>
                <th wire:click.prevent="sortBy('staff')"
                    class="pr-5 pl-5  border-r border-t border-gray-300 cursor-pointer">qty</th>
                <th wire:click.prevent="sortBy('staff')"
                    class="pr-5 pl-5  border-r border-t border-gray-300 cursor-pointer">Weight</th>
                    <th wire:click.prevent="sortBy('staff')"
                    class="pr-5 pl-5  border-r border-t border-gray-300 cursor-pointer">Description</th>



            </tr>
        </thead>
        <tbody>
            @foreach ($releases as $release)
                <tr class="cursor-pointer">

                    <td class="p-3 border border-r border-gray-50">{{ $release->awb_number }}</td>
                    <td class="p-3 border border-r border-gray-50">{{ $release->release_date}}</td>
                    <td class="p-3 border border-r border-gray-50">{{ $release->manifest_number}}</td>
                    <td class="p-3 border border-r border-gray-50">{{ $release->qty}}</td>
                    <td class="p-3 border border-r border-gray-50">{{ $release->weight}}</td>
                    <td class="p-3 border border-r border-gray-50">{{ $release->description}}</td>

                </tr>
            @endforeach



        </tbody>
    </table>

    <div class="pt-4">
        {{ $releases->links() }}
    </div>
</div>
