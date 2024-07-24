<?php

namespace App\Http\Controllers;

use App\Http\Requests\AnnotationFileStoreRequest;
use App\Models\Annotation;
use App\Models\AnnotationFile;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AnnotationFileController extends Controller
{
    public function create(Annotation $annotation): View
    {
        return view('annotations.files.create', [
            'annotation' => $annotation
        ]);
    }

    public function store(Annotation $annotation, AnnotationFileStoreRequest $request): RedirectResponse
    {
        $file = $request->file('attachment');
        $name = time() . '_' . $file->getClientOriginalName();
        $annFile = AnnotationFile::create([
            'path' => $name,
            'annotation_id' => $annotation->id
        ]);

        if (! $annFile) {
            return back()->with('noti', 'no se pudo adjuntar el archivo');
        }

        Storage::disk('annFiles')->putFileAs('', $file, $name);

        return redirect()->route('annotations.edit', $annotation);
    }

    public function delete(AnnotationFile $annotationFile): RedirectResponse
    {
        $path = $annotationFile->path;

        if (! $annotationFile->delete()) {
            return back()->with('noti', 'no se ha podido elminar el archivo');
        }
        
        Storage::disk('annFiles')->delete($path);

        return redirect()->route('annotations.edit', $annotationFile->annotation_id);
    }
}