<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Imports\BooksImport;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Session;

class BookController extends Controller
{
 public function index(): View
{
    $books = Book::with('category')
        ->filter(request()->only('search', 'category'))
        ->paginate(10)
        ->appends(request()->query());

    /** @var \App\Models\User|\Spatie\Permission\Traits\HasRoles $user */
    $user = Auth::user();

    $view = $user && $user->hasAnyRole(['admin', 'staff'])
        ? 'admin.book.index'
        : 'user.book.index';

    return view($view, [
        'books' => $books,
        'categories' => $this->getCategories(),
    ]);
}


    public function create(): View
    {
        return view('admin.book.create', [
            'categories' => $this->getCategories()
        ]);
    }

    public function store(StoreBookRequest $request): RedirectResponse
    {
        Book::create($request->validated());
        return redirect()->route('admin.book.index')->with('success', 'Book created successfully.');
    }

    public function edit(Book $book): View
    {
        return view('admin.book.edit', [
            'book' => $book,
            'categories' => $this->getCategories()
        ]);
    }

    public function update(UpdateBookRequest $request, Book $book): RedirectResponse
    {
        $book->fill($request->validated());

        if ($book->isClean()) {
            return redirect()->route('admin.book.edit', $book)
                ->with('info', 'No changes detected. Update skipped.');
        }

        $book->save();

        return redirect()->route('admin.book.index')
            ->with('success', 'Book updated successfully.');
    }

    public function destroy(Book $book): RedirectResponse
    {
        $book->delete();
        return redirect()->route('admin.book.index')->with('success', 'Book deleted successfully.');
    }

    private function getCategories()
    {
        return Category::all();
    }

    
public function import(Request $request)
{
    $request->validate([
        'file' => 'required|file|mimes:xlsx,csv',
    ]);

    $import = new BooksImport;
    Excel::import($import, $request->file('file'));

    if ($import->insertedCount === 0) {
        return back()->withErrors(['file' => 'No new books were imported. They may already exist or the file is invalid.']);
    }

    return redirect()->route('admin.book.index')->with('success', $import->insertedCount . ' book(s) imported successfully.');
}

}
