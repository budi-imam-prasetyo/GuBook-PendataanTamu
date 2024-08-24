<!-- resources/views/guests/more.blade.php -->
@foreach ($listpegawai as $list)
    <tr class="group hover:bg-lightBlue2">
        <th
            class="whitespace-nowrap border-l-0 border-r-0 border-t-0 py-4 text-center align-middle text-sm text-dark"
        >
            {{ $list->id }}.
        </th>
        <td
            class="whitespace-nowrap border-l-0 border-r-0 border-t-0 py-4 text-center align-middle text-sm text-dark"
        >
            {{ $list->NIP }}
        </td>
        <td
            class="align-center whitespace-nowrap border-l-0 border-r-0 border-t-0 py-4 text-center text-sm text-dark"
        >
            {{ $list->user->name }}
        </td>
        <td
            class="align-center whitespace-nowrap border-l-0 border-r-0 border-t-0 py-4 text-center text-sm lowercase text-dark"
        >
            {{ $list->user->email }}
        </td>
        <td
            class="whitespace-nowrap border-l-0 border-r-0 border-t-0 py-4 text-center align-middle text-sm text-dark"
        >
            {{ $list->PTK }}
        </td>
    </tr>
@endforeach
