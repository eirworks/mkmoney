<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Lib\SiteSettings;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function index()
    {
        $settings = collect($this->settings())->map(function($setting) {
            $setting['value'] = setting($setting['key'], null);
            return $setting;
        })->toArray();

        return view('admin.settings.index', [
            'settings' => $settings,
        ]);
    }

    public function update(Request $request)
    {
        collect($this->settings())->map(function($setting) use($request) {
            if ($setting['type'] == 'bool') {
                $setting['value'] = $request->input($setting['key'], false);
            } else {
                $setting['value'] = $request->input($setting['key']);
            }
            return $setting;
        })->each(function($setting) {
            setting([$setting['key'] => $setting['value']]);
        });

        setting()->save();

        return redirect()->route('admin::settings::index')
            ->with('success', "Pengaturan telah disimpan");
    }

    private function settings()
    {
        return SiteSettings::settings();
    }
}
