<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ProductController extends Controller
{
    public function index(Request $request)
    {

        // Validate request parameters
        $request->validate([
            'category' => 'nullable|string',
            'sort' => 'nullable|in:asc,desc',
            'search' => 'nullable|string'
        ]);

        // Start query
        $query = Product::query();

        // Filter by category if provided
        if ($request->has('category')) {
            $query->where('category', $request->category);
        }

        // Search by name if provided
        if ($request->has('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // Sort by price (default ascending)
        $sortOrder = $request->get('sort', 'asc');
        $query->orderBy('price', $sortOrder);

        // Paginate results | Add caching for performance
        $products = Cache::remember('products:' . request()->fullUrl(), 60, function () use ($query) {
            return $query->paginate(10);
        });

        // Return paginated Product Resource
        return ProductResource::collection($products);
    }
}
