<?php
namespace App\Http\Controllers;


use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Symfony\Component\HttpFoundation\Request;

class PictureController extends Controller {

    public function upload(Request $request) {
        $path = $request->file('picture')->store('pictures',['disk' => 'public']);
        $img = Image::make($request->file('picture'))
            ->resize(320, 250);

        //Storage::put('/public/small', $img);
        $img->save('storage/'.$request->file('picture')->store('small',['disk' => 'public']));

        $smallPath = explode("/", $img->basePath());
        unset($smallPath[0]);
        $smallPath = implode("/", $smallPath);

        DB::table('user_pictures')->insert(['user_id' => auth()->id(), 'picture_path' => $path, 'small_picture_path' => $smallPath]);

        return redirect('/user');
    }
}
