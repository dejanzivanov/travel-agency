<?php
namespace App\Http\Controllers;
use App\Models\Blog;
use Illuminate\Http\Request;
use App\Models\FileUpload;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    public function index(){
        return view('welcome');
    }

    public function upload(Request $request){

        $request->validate([
            'file' => 'required|mimes:jpg,jpeg,png,csv,txt,xlx,xls,pdf|max:2048'
        ]);

        $fileUpload = new FileUpload;

        if ($request->file()) {
            $file_name = time() . '_' . $request->file->getClientOriginalName();
            $file_path = $request->file('file')->storeAs('uploads/' . $request->id, $file_name, 'public');

            $fileUpload->name = time() . '_' . $request->file->getClientOriginalName();
            $fileUpload->path = '/storage/' . $request->id . '/' . $file_name;
            if (!Storage::exists('public/uploads/' . $request->id)) {
                Storage::makeDirectory('public/uploads/' . $request->id);
            }
            $fileUpload->save();
            BlogController::saveImageName($request->id, $fileUpload->name);
            return response()->json(['success' => 'File uploaded successfully.']);
        }
    }

}
