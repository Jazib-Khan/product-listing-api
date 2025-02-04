<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

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

        // Paginate results
        $products = $query->paginate(10);

        // Return paginated JSON response
        return response()->json($products);
    }
}
