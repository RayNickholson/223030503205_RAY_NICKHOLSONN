<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EBook;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

class EBookController extends Controller
{
    private $categories = ['Fiksi', 'Non-Fiksi', 'Fantasi', 'Romansa'];

    public function index(Request $request): View
    {
        $ebooks = EBook::latest();

        if ($request->has('category')) {
            $ebooks->where('category', $request->category);
        }

        if ($request->has('publish')) {
            $ebooks->where('published', $request->publish);
        }

        $ebooks = $ebooks->paginate(5);

        return view('EBook.index', compact('ebooks'));
    }

    public function create(): View
    {
        $categories = $this->categories;

        return view('EBook.create', compact('categories'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'image'         => 'required|image|mimes:jpeg,jpg,png|max:2048',
            'title'         => 'required|min:5',
            'description'   => 'required|min:10',
            'author'        => 'required',
            'category'      => 'required',
            'price'         => 'required|numeric',
            'published'     => 'required|boolean',
        ]);

        $image = $request->file('image');
        $image->storeAs('public/ebooks', $image->hashName());

        EBook::create([
            'image'         => $image->hashName(),
            'title'         => $request->title,
            'description'   => $request->description,
            'author'        => $request->author,
            'category'      => $request->category,
            'price'         => $request->price,
            'published'     => $request->published,
        ]);

        return redirect()->route('ebooks.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    public function show(string $id)
    {
        $ebook = EBook::findOrFail($id);
        return view('EBook.show', compact('ebook'));
    }

    public function edit(string $id): View
    {
        $ebook = EBook::findOrFail($id);
        $categories = $this->categories;

        return view('EBook.edit', compact('ebook', 'categories'));
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $request->validate([
            'image'         => 'image|mimes:jpeg,jpg,png|max:2048',
            'title'         => 'required|min:5',
            'description'   => 'required|min:10',
            'author'        => 'required',
            'category'      => 'required',
            'price'         => 'required|numeric',
            'published'     => 'required|boolean',
        ]);

        $ebook = EBook::findOrFail($id);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image->storeAs('public/ebooks', $image->hashName());

            Storage::delete('public/ebooks/'.$ebook->image);

            $description = strip_tags($request->description);

            $ebook->update([
                'image'         => $image->hashName(),
                'title'         => $request->title,
                'description'   => $request->description,
                'author'        => $request->author,
                'category'      => $request->category,
                'price'         => $request->price,
                'published'     => $request->published,
            ]);

        } else {
            $ebook->update([
                'title'         => $request->title,
                'description'   => $request->description,
                'author'        => $request->author,
                'category'      => $request->category,
                'price'         => $request->price,
                'published'     => $request->published,
            ]);
        }

        return redirect()->route('ebooks.index')->with(['success' => 'Data Berhasil Diubah!']);
    }

    public function destroy(string $id)
    {
        $ebook = EBook::findOrFail($id);
        $ebook->delete();

        return redirect()->route('ebooks.index')->with('success', 'EBook deleted successfully');
    }

    public function search(Request $request)
    {
        $output = "";
        $ebooks = EBook::where('title', 'like', '%' . $request->search . '%')
                       ->orWhere('description', 'like', '%' . $request->search . '%')
                       ->orWhere('author', 'like', '%' . $request->search . '%')
                       ->orWhere('category', 'like', '%' . $request->search . '%')
                       ->get();

        foreach ($ebooks as $ebook) {
            $output .= '<tr>
                            <td><img src="' . asset('storage/ebooks/' . $ebook->image) . '" class="rounded" style="width: 100px;"></td>
                            <td>' . $ebook->title . '</td>
                            <td>' . $ebook->description . '</td>
                            <td>' . $ebook->author . '</td>
                            <td>' . $ebook->category . '</td>
                            <td>Rp ' . number_format($ebook->price, 0, ',', '.') . '</td>
                            <td>' . ($ebook->published ? 'Yes' : 'No') . '</td>
                            <td class="text-center">
                                <form onsubmit="return confirm(\'Are you sure?\');" action="' . route('ebooks.destroy', $ebook->id) . '" method="POST">
                                    <a href="' . route('ebooks.show', $ebook->id) . '" class="btn btn-sm btn-dark">SHOW</a>
                                    <a href="' . route('ebooks.edit', $ebook->id) . '" class="btn btn-sm btn-primary">EDIT</a>
                                    ' . csrf_field() . '
                                    ' . method_field('DELETE') . '
                                    <button type="submit" class="btn btn-sm btn-danger">DELETE</button>
                                </form>
                            </td>
                        </tr>';
        }

        return response($output);
    }
}
