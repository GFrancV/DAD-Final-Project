<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;

class FileController extends Controller
{
    public function upload(Request $request)
    {

        $request->validate([
            'file' => 'required|mimes:jpg,jpeg,png|max:2048'
        ]);

        $path = $request->file('file')->store('public/fotos');

        //Devolve apenas o nome do ficheiro, cortando a parte "public/fotos"
        return Str::substr($path, 13);
    }
}
