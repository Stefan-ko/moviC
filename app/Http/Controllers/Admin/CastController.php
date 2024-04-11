<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cast;
use Illuminate\Http\Request;
use App\Service\ImageService;

class CastController extends Controller
{
    protected $imageService;

    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;
    }

    public function store(Request $request)
    {
        foreach ($request->cast_role as $key => $role) {
            $cast = new Cast();
            $cast->movie_id = $request->movie_id;
            $cast->role = $role;
            $cast->name_uk = $request->cast_name_uk[$key];
            $cast->name_en = $request->cast_name_en[$key];

            $photoUrl = $this->saveImage($request, $key);
            if ($photoUrl) {
                $cast->photo = $photoUrl;
            }

            $cast->save();
        }

        return redirect()->route('admin.movies.index');
    }

    public function update(Request $request)
    {
        foreach ($request->cast_role as $key => $role) {
            if ($request->has('cast_id') && isset($request->cast_id[$key])) {
                $cast = Cast::find($request->cast_id[$key]);
                $cast->role = $role;
                $cast->name_uk = $request->cast_name_uk[$key];
                $cast->name_en = $request->cast_name_en[$key];

                $photoUrl = $this->saveImage($request, $key);
                if ($photoUrl) {
                    $cast->photo = $photoUrl;
                }

                $cast->save();
            }
        }
        return redirect()->route('admin.movies.index');
    }

    public function destroy(Cast $cast)
    {
        $cast->delete();
        return response()->json(['message' => 'Cast deleted successfully']);
    }

    private function saveImage(Request $request, $key)
    {
        if ($request->hasFile('cast_photo') && isset($request->cast_photo[$key])) {
            return $this->imageService->storeAndCropImage(
                $request->file('cast_photo')[$key],
                'public/cast_photos',
                200,
                200
            );
        }

        return null;
    }
}
