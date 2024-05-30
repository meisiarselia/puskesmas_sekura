<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;

class StorageController extends Controller
{
    public function __invoke($dir, $filename)
    {;
        if (!Storage::disk('private')->exists("$dir/$filename")) abort(404);

        $file = Storage::disk('private')->get("$dir/$filename");
        $type = Storage::disk('private')->mimeType("$dir/$filename");

        return Response::make($file, 200, [
            'Content-Type' => $type,
            'Content-Disposition' => 'inline; filename="' . $filename . '"'
        ]);
    }
}
