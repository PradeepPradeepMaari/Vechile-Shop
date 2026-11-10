<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreModelShowroomRequest;
use App\Http\Requests\UpdateModelShowroomRequest;
use App\Models\ModelShowroom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ModelShowroomController extends Controller
{
    
    public function dashboard()
    {
        $totalModels   = ModelShowroom::count();
        $activeModels  = ModelShowroom::active()->count();
        $inactiveModels = $totalModels - $activeModels;
        $recentModels  = ModelShowroom::where('created_at', '>=', now()->subDays(30))->count();
        $recentVehicles = ModelShowroom::latest()->take(5)->get();
        $categoryData = $this->getCategoryData();

        return view('admin.dashboard', compact('totalModels','activeModels','inactiveModels','recentModels','recentVehicles','categoryData'));
    }

    public function index(Request $request)
    {
        $query = ModelShowroom::query()->ordered();
        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('model_name', 'like', "%{$search}%")
                  ->orWhere('year', 'like', "%{$search}%")
                  ->orWhere('price', 'like', "%{$search}%");
            });
        }
        if ($status = $request->input('status')) {
            $query->where('status', $status === 'active' ? 1 : 0);
        }
        $models = $query->paginate(10);
        return view('admin.models.index', compact('models'));
    }
    public function create()
    {
        return view('admin.models.create');
    }

    public function store(StoreModelShowroomRequest $request)
    {
        $data = $request->validated();
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('vehicles', 'public');
            $data['image'] = basename($path);
        }
        $data['status'] = $request->has('status') ? 1 : 0;

        ModelShowroom::create($data);

        return redirect()
            ->route('admin.models.index')
            ->with('success', 'Model added successfully.');
    }

    public function edit(ModelShowroom $model)
    {
        return view('admin.models.edit', compact('model'));
    }
    
    public function update(UpdateModelShowroomRequest $request, ModelShowroom $model)
    {
        $data = $request->validated();
        if ($request->hasFile('image')) {
            if ($model->image && Storage::disk('public')->exists('vehicles/' . $model->image)) {
                Storage::disk('public')->delete('vehicles/' . $model->image);
            }

            $path = $request->file('image')->store('vehicles', 'public');
            $data['image'] = basename($path);
        }
        $data['status'] = $request->has('status') ? 1 : 0;

        $model->update($data);

        return redirect()
            ->route('admin.models.index')
            ->with('success', 'Model updated successfully.');
    }

    public function destroy(ModelShowroom $model)
    {
        if ($model->image && Storage::disk('public')->exists('vehicles/' . $model->image)) {
            Storage::disk('public')->delete('vehicles/' . $model->image);
        }

        $model->delete();
        return redirect()->route('admin.models.index')->with('success', 'Model deleted successfully.');
    }
    private function getCategoryData(): array
    {
        $vehicles = ModelShowroom::all();
        $categories = [];

        foreach ($vehicles as $vehicle) {
            $name = strtoupper($vehicle->model_name);
            if (str_contains($name, 'QX80') || str_contains($name, 'QX60')) {
                $cat = 'SUV';
            } elseif (str_contains($name, 'QX')) {
                $cat = 'Crossover';
            } elseif (str_contains($name, 'COUPE')) {
                $cat = 'Coupe';
            } elseif (str_contains($name, 'CONVERTIBLE')) {
                $cat = 'Convertible';
            } else {
                $cat = 'Sedan';
            }
            $categories[$cat] = ($categories[$cat] ?? 0) + 1;
        }

        return $categories;
    }
}

