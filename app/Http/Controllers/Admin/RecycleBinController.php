<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\User;
use App\Models\Category;
use App\Models\Department;

class RecycleBinController extends Controller
{
    public function index()
{
    return view('admin.recycle-bin.index', [
        'deletedBooks' => Book::onlyTrashed()->get(),
        'deletedUsers' => User::onlyTrashed()->get(),
        'deletedCategories' => Category::onlyTrashed()->get(),
        'deletedDepartments' => Department::onlyTrashed()->get(),
    ]);
}


    public function restore($model, $id)
    {
        $modelClass = $this->resolveModel($model);

        $item = $modelClass::onlyTrashed()->findOrFail($id);
        $item->restore();

        return redirect()->route('admin.recycle-bin.index')
                         ->with('success', ucfirst($model) . ' restored successfully.');
    }

    public function forceDelete($model, $id)
    {
        $modelClass = $this->resolveModel($model);

        $item = $modelClass::onlyTrashed()->findOrFail($id);
        $item->forceDelete();

        return redirect()->route('admin.recycle-bin.index')
                         ->with('success', ucfirst($model) . ' permanently deleted.');
    }

    protected function resolveModel($model)
    {
        return match (strtolower($model)) {
            'book', 'books' => Book::class,
            'user', 'users' => User::class,
            'category', 'categories' => Category::class,
            'department', 'departments' => Department::class,
            default => abort(404, 'Model not found.'),
        };
    }
}
