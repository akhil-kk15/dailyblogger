<?php

namespace App\Http\Controllers;

use App\Models\Posts;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

class SearchController extends Controller
{
    /**
     * Display the search page.
     */
    public function index(Request $request)
    {
        $posts = collect();
        $searchTerm = '';
        $selectedCategory = '';
        $selectedTags = [];
        $sortBy = 'latest';
        $hasResults = false;
        
        // Get filter options
        $categories = Category::active()->get();
        $tags = Tag::active()->get();
        
        // Only perform search if there are search parameters
        if ($request->hasAny(['q', 'category', 'tags', 'sort'])) {
            $hasResults = true;
            $query = Posts::query()->public();
            
            // Search by title and content
            if ($request->filled('q')) {
                $searchTerm = $request->input('q');
                $query->where(function (Builder $subQuery) use ($searchTerm) {
                    $subQuery->where('title', 'LIKE', '%' . $searchTerm . '%')
                            ->orWhere('description', 'LIKE', '%' . $searchTerm . '%');
                });
            }
            
            // Filter by category
            if ($request->filled('category')) {
                $selectedCategory = $request->input('category');
                $query->where('category_id', $selectedCategory);
            }
            
            // Filter by tags
            if ($request->filled('tags')) {
                $selectedTags = $request->input('tags');
                $query->whereHas('tags', function (Builder $tagQuery) use ($selectedTags) {
                    $tagQuery->whereIn('tags.id', $selectedTags);
                });
            }
            
            // Apply sorting
            $sortBy = $request->input('sort', 'latest');
            switch ($sortBy) {
                case 'oldest':
                    $query->orderBy('created_at', 'asc');
                    break;
                case 'title':
                    $query->orderBy('title', 'asc');
                    break;
                case 'most_commented':
                    $query->withCount('comments')->orderBy('comments_count', 'desc');
                    break;
                case 'latest':
                default:
                    $query->orderBy('created_at', 'desc');
                    break;
            }
            
            // Load relationships and paginate
            $posts = $query->with(['category', 'tags', 'user'])
                          ->paginate(12)
                          ->appends($request->query());
        }
        
        return view('home.search', compact(
            'posts',
            'searchTerm',
            'selectedCategory',
            'selectedTags',
            'sortBy',
            'categories',
            'tags',
            'hasResults'
        ));
    }
    
    /**
     * AJAX search for live search suggestions.
     */
    public function suggestions(Request $request)
    {
        $searchTerm = $request->input('q');
        
        if (strlen($searchTerm) < 2) {
            return response()->json([]);
        }
        
        $posts = Posts::public()
                    ->where(function (Builder $query) use ($searchTerm) {
                        $query->where('title', 'LIKE', '%' . $searchTerm . '%')
                             ->orWhere('description', 'LIKE', '%' . $searchTerm . '%');
                    })
                    ->with(['category'])
                    ->limit(8)
                    ->get(['id', 'title', 'category_id', 'created_at']);
        
        $suggestions = $posts->map(function ($post) {
            return [
                'id' => $post->id,
                'title' => $post->title,
                'category' => $post->category ? $post->category->name : null,
                'url' => route('home.post_details', $post->id),
                'date' => $post->created_at->format('M d, Y')
            ];
        });
        
        return response()->json($suggestions);
    }
    
    /**
     * Global search from header search bar.
     */
    public function quickSearch(Request $request)
    {
        $searchTerm = $request->input('q');
        
        if (!$searchTerm) {
            return redirect()->route('home.search');
        }
        
        return redirect()->route('home.search', ['q' => $searchTerm]);
    }
}
