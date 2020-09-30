<?php

namespace App\Exports;

use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromCollection;
use Log;

class PostExport implements FromCollection
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        if (Auth::user()->type == 0) {
            return Post::all();
        } else {
            return Post::where('create_user_id', auth()->user()->id)->get();
        }
    }
}
