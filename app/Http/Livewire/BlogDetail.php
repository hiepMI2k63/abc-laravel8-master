<?php

namespace App\Http\Livewire;

use Livewire\Component;

class BlogDetail extends Component
{
    public function render()
    {
        return view('livewire.blog-detail')->layout('layouts.base');
    }
}
