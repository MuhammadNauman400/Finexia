<?php

namespace App\Http\Controllers\Backend;

use App\Models\CoreValue;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AboutUsController extends Controller
{
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
