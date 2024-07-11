<!-- resources/views/guests/more.blade.php -->
@foreach ($listpegawai as $list)
<tr class="hover:bg-lightBlue2 group">
    <th
        class="border-t-0 align-middle border-l-0 border-r-0 text-sm whitespace-nowrap py-4 text-center text-dark">
        {{ $list->id }}.
    </th>
    <td
        class="border-t-0 align-middle border-l-0 border-r-0 text-sm whitespace-nowrap py-4 text-center text-dark">
        {{ $list->NIP }}
    </td>
    <td
        class="border-t-0 align-center border-l-0 border-r-0 text-sm whitespace-nowrap py-4 text-center text-dark">
        {{ $list->user->name }}
    </td>
    <td
        class="border-t-0 align-center border-l-0 border-r-0 text-sm whitespace-nowrap py-4 text-center text-dark lowercase">
        {{ $list->user->email }}
    </td>
    <td
        class="border-t-0 align-middle border-l-0 border-r-0 text-sm whitespace-nowrap py-4 text-center text-dark">
        {{ $list->PTK }}
    </td>
</tr>
@endforeach
