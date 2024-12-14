<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Str;

class PageController extends Controller
{
    public function index()
    {
        $pages = Page::with('children')->whereNull('parent_id')->get();
        return Inertia::render('Index', compact('pages'));
    }

    public function create()
    {
        $pages = Page::all();
        return Inertia::render('Create', compact('pages'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'parent_id' => 'nullable|exists:pages,id',
        ]);

        $slug = Str::slug($request->title);

        Page::create([
            'title' => $request->title,
            'slug' => $slug,
            'content' => $request->content,
            'parent_id' => $request->parent_id,
        ]);
        
        return redirect()->route('pages.index')->with('success', 'Page created successfully.');
    }

    public function show($path)
    {
        $slugs = explode('/', $path);
        $page = null;

        foreach ($slugs as $slug) {
            $page = Page::where('slug', $slug)
                ->where('parent_id', $page?->id)
                ->first();

            if (!$page) {
                abort(404);
            }
        }

        return Inertia::render('Show', compact('page'));
    }

    public function edit(Page $page)
    {
        $pages = Page::where('id', '!=', $page->id)->get();
        // dd($page, $pages);
        return Inertia::render('Edit', compact('page', 'pages'));
    }

    public function update(Request $request, Page $page)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $slug = Str::slug($request->title);

        $page->update([
            'title' => $request->title,
            'slug' => $slug,
            'content' => $request->content,
        ]);

        return redirect()->route('pages.index')->with('success', 'Page updated successfully.');
    }

    public function destroy(Page $page)
    {
        $page->delete();
        return redirect()->route('pages.index')->with('success', 'Page deleted successfully.');
    }
}