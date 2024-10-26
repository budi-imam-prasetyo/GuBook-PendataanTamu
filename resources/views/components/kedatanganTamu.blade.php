<li class="relative flex px-6 py-4 mb-2 bg-gray-50 border border-gray-200 rounded-lg hover:shadow transition-all duration-300 ease-in-out hover:-translate-y-1 group-hover:[&:not(:hover)]:opacity-70">
        <div class="flex items-center gap-6">
            <div class="flex items-center justify-center">
                @if ($item->type == 'tamu')
                    <img class="w-10 h-10" src="{{ asset('assets/icons/user2.svg') }}" alt="">
                @else
                    <img class="w-10 h-10" src="{{ asset('assets/icons/box2.svg') }}" alt="">
                @endif
            </div>
            <div class="flex flex-col gap-1">
                <h5 class="text-lg font-semibold text-gray-900 capitalize">{{ $item->user->nama }}</h5>
                <div class="text-gray-700 text-sm">
                    @if ($item->type == 'tamu')
                        <p><span class="font-medium">Nama: </span>{{ $item->tamu->nama }}</p>
                        <p><span class="font-medium">Email: </span>{{ $item->tamu->email }}</p>
                        <p><span class="font-medium">Tanggal Perjanjian: </span>{{ $item->waktu_perjanjian }}</p>
                    @else
                        <p><span class="font-medium">Nama Kurir: </span>{{ $item->ekspedisi->nama_kurir }}</p>
                        <p><span class="font-medium">Ekspedisi: </span>{{ $item->ekspedisi->ekspedisi }}</p>
                        <p><span class="font-medium">Tanggal Kedatangan: </span>{{ $item->waktu_kedatangan }}</p>
                    @endif
                </div>
            </div>
        </div>
    </li>
