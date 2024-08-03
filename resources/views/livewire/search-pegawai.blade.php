<div>
    <div class="px-4 space-y-4 mt-8">
        <form method="get">
            <input class="border-solid border border-gray-300 p-2 w-full md:w-1/4" 
                type="text" placeholder="Search Users" wire:model="term"/>
        </form>
        <div wire:loading>Searching users...</div>
        <div wire:loading.remove>        
        @empty($term)
            <div class="text-gray-500 text-sm">
                Enter a term to search for users.
            </div>
        @else
            @if($users)
                <div class="text-gray-500 text-sm">
                    No matching result was found.
                </div>
            @else
                @foreach($users as $user)
                    <div>
                        <h3 class="text-lg text-gray-900 text-bold">{{$user->name}}</h3>
                        <p class="text-gray-500 text-sm">{{$user->email}}</p>
                        <p class="text-gray-500">{{$user->bio}}</p>
                    </div>
                @endforeach
            @endif
        @endif
        </div>
    </div>
    <div class="px-4 mt-4">
        @isset($users)
            
        {{$users->links()}}
        @endisset
    </div>
</div>