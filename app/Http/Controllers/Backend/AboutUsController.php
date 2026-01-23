<?php

namespace App\Http\Controllers\Backend;

use App\Models\CoreValue;
use App\Models\About;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class AboutUsController extends Controller
{

    public function GetAboutUs()
    {
        $about = About::find(1);
        return view('admin.backend.about.get_about', compact('about'));
    }

    public function UpdateAboutUs(Request $request)
    {
        $about_id = $request->id;
        $about = About::find($about_id);

        if ($request->file('image')) {
            $image = $request->file('image');
            $manager = new ImageManager(new Driver());
            $name_gen = hexdec(uniqid()) . '.' .
                $image->getClientOriginalExtension();
            $img = $manager->read($image->getRealPath());
            $img->resize(526, 550)->save(public_path('upload/about/' . $name_gen));
            $save_url = 'upload/about/' . $name_gen;

            if (file_exists(public_path($about->image))) {
                @unlink(public_path($about->image));
            }

            About::find($about_id)->update([
                'title' => $request->title,
                'description' => $request->description,
                'image' => $save_url,

            ]);
            $notification = array(
                'message' => 'About Updated with Image Successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('get.aboutus')->with($notification);
        } else {
            About::find($about_id)->update([
                'title' => $request->title,
                'description' => $request->description,

            ]);
            $notification = array(
                'message' => 'About Updated without Image Successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('get.aboutus')->with($notification);
        }
    }

    public function AllCoreValue()
    {
        $core_value = CoreValue::latest()->get();
        return view('admin.backend.core_value.all_core_value', compact('core_value'));
    }

    public function AddCoreValue()
    {
        return view('admin.backend.core_value.add_core_value');
    }

    public function StoreCoreValue(Request $request)
    {
        CoreValue::create([
            'title' => $request->title,
            'icon' => $request->icon,
            'description' => $request->description,
        ]);

        $notification = array(
            'message' => 'Core Value Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.core.value')->with($notification);
    }

    public function EditCoreValue($id)
    {
        $core_value = CoreValue::find($id);
        return view('admin.backend.core_value.edit_core_value', compact('core_value'));
    }

    public function UpdateCoreValue(Request $request)
    {
        $core_value_id = $request->id;

        CoreValue::find($core_value_id)->update([
            'title' => $request->title,
            'icon' => $request->icon,
            'description' => $request->description,
        ]);

        $notification = array(
            'message' => 'Core Value Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.core.value')->with($notification);
    }

    public function DeleteCoreValue($id)
    {
        CoreValue::find($id)->delete();

        $notification = array(
            'message' => 'Core Value Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
}
