<?php

namespace App\Http\Controllers\Skus;

use App\Http\Controllers\Controller;
use App\Photo;
use App\Sku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PhotosController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Sku $sku)
    {
        $this->validate(request(), [
            'photo' => 'image',
        ]);

        $originalName = request()
            ->file('photo')
            ->getClientOriginalName();

        $sku->photos()->create([
            'SKU' => $sku->SKU,
            'Name' => $originalName,
            'Url' => Storage::url(
                request()
                    ->file('photo')
                    ->storeAs('sku', $originalName, 'public')
            ),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Photo $photo)
    {
        $photo->delete();

        $photoPath = str_replace('storage', 'public', $photo->URL);

        Storage::delete($photoPath);

        return back()->with('message', 'The user has been deleted successfully');
    }
}
