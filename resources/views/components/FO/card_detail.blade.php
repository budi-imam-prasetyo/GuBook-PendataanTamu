@php
    $statusColors = [
        'diterima' => 'outline-green-400',
        'ditolak' => 'outline-red-400',
        'menunggu' => 'outline-orange-400',
    ];
@endphp
<div class="w-full flex flex-col col-span-3 gap-6 rounded-4.5">
    <div class="w-full flex items-center justify-center avatar">
        <div
            class="rounded-full flex items-center justify-center w-25 h-25 outline outline-4 {{ $statusColors[$item->status] ?? 'outline-green-400' }}">
            @if ($item->fotoUrl == null)
                <img src="{{ $item->fotoUrl }}" class="h-full rounded-full" alt="">
            @else
                <img src="{{ $nullFoto }}" class="h-full rounded-full" alt="">
            @endif
        </div>
    </div>
    <div class="w-full flex gap-2 justify-around">
        <div class="w-full flex flex-col items-center justify-center gap-2">
            @if ($item->tamu)
                <h6 class="text-sm leading-0 font-semibold text-grey">Nama Tamu</h6>
            @else
                <h6 class="text-sm leading-0 font-semibold text-grey">Nama Kurir</h6>
            @endif
            <h6 class="text-base text-darkGray">{{ $item->tamu->nama ?? $item->ekspedisi->nama_kurir }}</h6>
        </div>
        <div class="w-full flex flex-col items-center justify-center gap-2">
            <h6 class="text-sm leading-0 font-semibold text-grey">Bertemu Dengan</h6>
            <h6 class="text-base text-darkGray">{{ $item->user->nama }}</h6>
        </div>
        @if ($item->tamu)
            <div class="w-full flex flex-col items-center justify-center gap-2">
                <h6 class="text-sm leading-0 font-semibold text-grey">Waktu Pertemuan</h6>
                <h6 class="text-sm text-darkGray">{{ $item->formatWaktu }}</h6>
            </div>
        @endif
    </div>
    <div class="w-full px-4">
        <h2 class="text-lg font-semibold mb-2 px-2 leading-4">Detail Lainnya</h2>
        <div class="bg-lightBlue p-4 rounded-4.5 ">
            @if ($item->ekspedisi)
                <div class="flex mb-2">
                    <span class="font-semibold w-1/6">Waktu</span>
                    <span class="w-5/6">: {{ $item->formatWaktu }}</span>
                </div>
            @endif
            <div class="flex mb-2">
                @if ($item->tamu)
                    <span class="font-semibold w-1/6">Email</span>
                @else
                    <span class="font-semibold w-1/6">Ekspedisi</span>
                @endif
                <span class="w-5/6">: {{ $item->tamu->email ?? $item->ekspedisi->ekspedisi }}</span>
            </div>
            <div class="flex mb-2">
                <span class="font-semibold w-1/6">No. Telpon</span>
                <span class="w-5/6">: {{ $item->tamu->no_telpon ?? $item->ekspedisi->no_telpon }}</span>
            </div>
            @if ($item->tamu)
                <div class="flex mb-2">
                    <span class="font-semibold w-1/6">Alamat</span>
                    <span class="w-5/6">: {{ $item->tamu->alamat ?? '-' }}</span>
                </div>
                <div class="flex mb-2">
                    <span class="font-semibold w-1/6">Instansi</span>
                    <span class="w-5/6">: {{ $item->instansi ?? '-' }}</span>
                </div>
                <div class="flex flex-col gap-1">
                    <span class="font-semibold">Tujuan</span>
                    <div class="w-full py-2 px-3 bg-lightBlue2 rounded-lg h-24 overflow-auto">
                        {{ $item->tujuan ?? 'N/A' }}
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>