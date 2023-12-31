<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $setting = Setting::first();
        return view('dashboard.settings.index', compact('setting'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Setting $setting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Setting $setting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Setting $setting)
    {
        //
        // dd($request->all());
        $validator = Validator($request->all(), [
            'name' => 'string|nullable',
            'description' => 'string|nullable',
            'logo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048|nullable',
            'favicon' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048|nullable',
            'email' => 'email|nullable',
            'phone' => 'string|nullable',
            'address' => 'string|nullable',
            'facebook' => 'string|nullable',
            'twitter' => 'string|nullable',
            'instagram' => 'string|nullable',
            'youtube' => 'string|nullable',
            'tiktok' => 'string|nullable',
        ]);
        if (!$validator->fails()) {
            $data = $request->except('_token', 'logo', 'favicon');
            if ($request->has('logo')) {
                File::delete(public_path($setting->logo));
                $path_logo = $request->file('logo')->store('images', 'store');
                $data['logo'] = $path_logo;
            }
            if ($request->has('favicon')) {
                File::delete(public_path($setting->favicon));
                $path_favicon = $request->file('favicon')->store('images', 'store');
                $data['favicon'] = $path_favicon;
            }
            $setting->update($data);;

            // $setting->name = $request->name;
            // $setting->description = $request->description;
            // $setting->email = $request->email;
            // $setting->phone = $request->phone;
            // $setting->address = $request->address;
            // $setting->facebook = $request->facebook;
            // $setting->twitter = $request->twitter;
            // $setting->instagram = $request->instagram;
            // $setting->youtube = $request->youtube;
            // $setting->tiktok = $request->tiktok;
            // if ($request->has('logo')) {
            //     $image = $request->file('logo');
            //     $imageName = time() . '_Logo.' . $image->getClientOriginalExtension();
            //     $image->storeAs('images', $imageName, ['disk' => 'public']);
            //     $setting->logo = $imageName;
            // }
            // if ($request->has('favicon')) {
            //     $img = $request->file('favicon');
            //     $imgName = time() . '_Favicon.' . $img->getClientOriginalExtension();
            //     $img->storeAs('images', $imgName, ['disk' => 'public']);
            //     $setting->favicon = $imgName;
            // }
            // $setting->update();
            return redirect()->route('dashboard.settings.index')
                ->with('success', 'تم تحديث الاعدادات بنجاح')
                ->with('icon', 'success');;
        } else {
            dd('Fails');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Setting $setting)
    {
        //
    }
}
