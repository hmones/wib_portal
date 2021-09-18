<?php

namespace App\Http\Controllers;

use App\Models\Sector;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Cache};
use Sentry;

class SectorController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            "sector_create_name" => "required|string|unique:App\Models\Sector,name",
            "sector_create_icon" => "required|string"
        ]);

        Sector::create([
            'name' => $data['sector_create_name'],
            'icon' => $data['sector_create_icon']
        ]);

        $this->refreshSectorsCache();

        return redirect(route('admin.options'))->with('success', 'Sector was saved successfully!');
    }

    protected function refreshSectorsCache(): void
    {
        try {
            Cache::forget('sectors');
            Cache::rememberForever('sectors', function () {
                return Sector::all();
            });
        } catch (\Throwable $exception) {
            Sentry\captureException($exception);
        }
    }

    public function update(Request $request, Sector $sector)
    {
        request()->validate([
            "sector_update_name" => "required|string",
            "sector_update_icon" => "required|string"
        ]);

        $sector->update([
            'name' => $request->sector_update_name,
            'icon' => $request->sector_update_icon
        ]);

        $this->refreshSectorsCache();

        return redirect(route('admin.options'))->with('success', 'Your data was updated successfully!');
    }

    public function destroy(Sector $sector)
    {
        $sector->delete();

        return redirect(route('admin.options'))->with('success', 'Sector was deleted successfully!');
    }
}
