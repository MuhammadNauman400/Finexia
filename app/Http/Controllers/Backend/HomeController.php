<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Clarify;
use App\Models\Feature;
use App\Models\GetAll;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class HomeController extends Controller
{
    public function AllFeature()
    {
        $feature = Feature::latest()->get();
        return view('admin.backend.feature.all_feature', compact('feature'));
    }

    public function AddFeature()
    {
        return view('admin.backend.feature.add_feature');
    }

    public function StoreFeature(Request $request)
    {
        Feature::create([
                'title' => $request->title,
                'icon' => $request->icon,
                'description' => $request->description,
            ]);

        $notification = array(
            'message' => 'Feature Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.feature')->with($notification);
    }

    public function EditFeature($id)
    {
        $feature = Feature::find($id);
        return view('admin.backend.feature.edit_feature', compact('feature'));
    }

    public function UpdateFeature(Request $request)
    {   
        $feature_id = $request->id;

        Feature::find($feature_id)->update([
                'title' => $request->title,
                'icon' => $request->icon,
                'description' => $request->description,
            ]);

        $notification = array(
            'message' => 'Feature Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.feature')->with($notification);
    }

    public function DeleteFeature($id)
    {
        Feature::find($id)->delete();

        $notification = array(
            'message' => 'Feature Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function GetClarifies()
    {
        $clarify = Clarify::find(1);
        return view('admin.backend.clarify.get_clarify', compact('clarify'));
    }

    public function UpdateClarify(Request $request)
    {
        $clarify_id = $request->id;
        $clarify = Clarify::find($clarify_id);

        if ($request->file('image')) {
            $image = $request->file('image');
            $manager = new ImageManager(new Driver());
            $name_gen = hexdec(uniqid()) . '.' .
                $image->getClientOriginalExtension();
            $img = $manager->read($image->getRealPath());
            $img->resize(302, 618)->save(public_path('upload/clarify/' . $name_gen));
            $save_url = 'upload/clarify/' . $name_gen;

            if (file_exists(public_path($clarify->image))) {
                @unlink(public_path($clarify->image));
            }

            Clarify::find($clarify_id)->update([
                'title' => $request->title,
                'description' => $request->description,
                'image' => $save_url,

            ]);
            $notification = array(
                'message' => 'Clarify Updated with Image Successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('get.clarifies')->with($notification);
        } else {
            Clarify::find($clarify_id)->update([
                'title' => $request->title,
                'description' => $request->description,

            ]);
            $notification = array(
                'message' => 'Clarify Updated without Image Successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('get.clarifies')->with($notification);
        }
    }

    public function GetAll()
    {
        $get_all = GetAll::find(1);
        return view('admin.backend.get_all.get_all', compact('get_all'));
    }

    public function UpdateGetAll(Request $request)
    {
        $getAll_id = $request->id;
        $get_all = GetAll::find($getAll_id);

        if ($request->file('image')) {
            $image = $request->file('image');
            $manager = new ImageManager(new Driver());
            $name_gen = hexdec(uniqid()) . '.' .
                $image->getClientOriginalExtension();
            $img = $manager->read($image->getRealPath());
            $img->resize(307, 619)->save(public_path('upload/get_all/' . $name_gen));
            $save_url = 'upload/get_all/' . $name_gen;

            if (file_exists(public_path($get_all->image))) {
                @unlink(public_path($get_all->image));
            }

            GetAll::find($getAll_id)->update([
                'title' => $request->title,
                'description' => $request->description,
                'unified' => $request->unified,
                'real_time' => $request->real_time,
                'image' => $save_url,

            ]);
            $notification = array(
                'message' => 'Get All Updated with Image Successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('get.all')->with($notification);
        } else {
            GetAll::find($getAll_id)->update([
                'title' => $request->title,
                'description' => $request->description,
                'unified' => $request->unified,
                'real_time' => $request->real_time,

            ]);
            $notification = array(
                'message' => 'Get All Updated without Image Successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('get.all')->with($notification);
        }
    }
}
