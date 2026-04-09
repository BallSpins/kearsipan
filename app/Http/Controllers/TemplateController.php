<?php

namespace App\Http\Controllers;

use App\Models\LetterTemplate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class TemplateController extends Controller
{
    public function download(LetterTemplate $template): BinaryFileResponse
    {
        $disk = Storage::disk('letter_templates');

        if (!$disk->exists($template->path)) {
            abort(404, 'File template tidak ditemukan di server.');
        }
    
        $fullPath = $disk->path($template->path);
        $extension = pathinfo($template->path, PATHINFO_EXTENSION);
        $downloadName = trim($template->name) . '.' . $extension;

        return response()
                ->download($fullPath, $downloadName);
    }
}
