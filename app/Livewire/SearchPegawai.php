<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class SearchPegawai extends Component
{
    use WithPagination;

    public $term = "";

    public function updatingTerm()
    {
        $this->resetPage();
    }

    public function render()
    {
        sleep(1);
        $users = User::where('name', 'like', '%' . $this->term . '%')
        ->orWhere('email', 'like', '%' . $this->term . '%')
        ->paginate(10);
        return view('livewire.search-pegawai', ['users' => $users]);
    }
}