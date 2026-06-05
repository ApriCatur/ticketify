<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Event;
use Illuminate\Http\Request;

class EventCategoriesController extends Controller
{
   public function index(Request $request)
{
    $tab = $request->query('tab', 'active');
    $search = $request->query('search', '');

    $query = Category::withTrashed()
        ->withCount('events')
        ->when($search, function ($q) use ($search) {
            $q->where('name', 'like', "%{$search}%");
        })
        ->when($tab === 'active', function ($q) {
            $q->whereNull('deleted_at');
        })
        ->when($tab === 'deleted', function ($q) {
            $q->whereNotNull('deleted_at');
        });

    $categories = $query->orderBy('name')->get();

    $eventCountByCategory = Event::selectRaw('category_id, COUNT(*) as total')
        ->groupBy('category_id')
        ->pluck('total', 'category_id');

    $totalCategories = Category::count();

    $totalDeleted = Category::onlyTrashed()->count();

    $totalEventsTagged = Event::whereNotNull('category_id')->count();

    $mostUsed = '-';

    if ($categories->count() > 0) {
        $mostUsed = $categories->sortByDesc('events_count')->first()->name;
    }

    return view('Admin.EventCategories', compact(
        'categories',
        'eventCountByCategory',
        'tab',
        'search',
        'totalCategories',
        'totalDeleted',
        'totalEventsTagged',
        'mostUsed'
    ));
}
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100|unique:categories,name',
        ]);

        Category::create($request->only('name'));

        return redirect()->route('admin.categories')
            ->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:100|unique:categories,name,' . $category->id,
        ]);

        $oldName = $category->name;
        $category->update($request->only('name'));

        // Sinkronisasi kolom events.category jika nama berubah
        if ($oldName !== $category->name) {
            Event::where('category', $oldName)->update(['category' => $category->name]);
        }

        return redirect()->route('admin.categories')
            ->with('success', 'Kategori berhasil diperbarui.');
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('admin.categories')
            ->with('success', 'Kategori berhasil dihapus.');
    }

    public function restore($id)
    {
        Category::withTrashed()->findOrFail($id)->restore();

        return redirect()->route('admin.categories', ['tab' => 'deleted'])
            ->with('success', 'Kategori berhasil dipulihkan.');
    }

    public function forceDelete($id)
    {
        Category::withTrashed()->findOrFail($id)->forceDelete();

        return redirect()->route('admin.categories', ['tab' => 'deleted'])
            ->with('success', 'Kategori berhasil dihapus permanen.');
    }
}
