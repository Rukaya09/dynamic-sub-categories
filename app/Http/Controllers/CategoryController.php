<?php
namespace App\Http\Controllers;
use App\Models\Category;
use Illuminate\Http\Request;
class CategoryController extends Controller
{
    // Display a listing of the categories with their children and child-children
    public function index()
    {
        // Fetch categories with their children and child-children
        $categories = Category::with('children.children') // Eager load children and child-children
                            ->where('parent_id', 0) // Get only top-level categories (parents)
                            ->get();

        // Return the data to a view
        return view('categories.index', compact('categories'));
    }

    // Show the form for creating a new category
    public function create()
    {
        // Fetch categories where parent_id is 0 (i.e., top-level categories) and their subcategories recursively
        $categories = Category::with('children')->where('parent_id', 0)->get();
        
        // Pass the categories to the view
        return view('categories.create', compact('categories'));
    }
    

    // Store a newly created category in the database
    public function store(Request $request)
    {
        // Validate the incoming request data
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'slug' => 'required|string|max:100',
            'parent_id' => 'nullable|exists:categories,id',
            'position' => 'nullable|integer',
            'home_status' => 'nullable|boolean',
            'priority' => 'nullable|integer',
            'icon' => 'nullable|string|max:250',
            'icon_storage_type' => 'nullable|string|max:10',
        ]);

        // Create a new category and save it to the database
        $category = Category::create([
            'name' => $validated['name'],
            'slug' => $validated['slug'],
            'parent_id' => $validated['parent_id'] ?? 0, // default to 0 if no parent
            'position' => $validated['position'] ?? 0,
            'home_status' => $validated['home_status'] ?? 0,
            'priority' => $validated['priority'] ?? null,
            'icon' => $validated['icon'] ?? null,
            'icon_storage_type' => $validated['icon_storage_type'] ?? 'public',
        ]);

        // Redirect back to categories list with a success message
        return redirect()->route('categories.index')->with('success', 'Category created successfully!');
    }

    // Show the form for editing the specified category
    public function edit($id)
    {
        // Fetch the category and the top-level categories for the parent dropdown
        $category = Category::findOrFail($id);
        $categories = Category::where('parent_id', 0)->get();

        return view('categories.edit', compact('category', 'categories'));
    }

    // Update the specified category in the database
    public function update(Request $request, $id)
    {
        // Validate the incoming request data
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'slug' => 'required|string|max:100',
            'parent_id' => 'nullable|exists:categories,id',
            'position' => 'nullable|integer',
            'home_status' => 'nullable|boolean',
            'priority' => 'nullable|integer',
            'icon' => 'nullable|string|max:250',
            'icon_storage_type' => 'nullable|string|max:10',
        ]);

        // Find the category and update it
        $category = Category::findOrFail($id);
        $category->update([
            'name' => $validated['name'],
            'slug' => $validated['slug'],
            'parent_id' => $validated['parent_id'] ?? 0,
            'position' => $validated['position'] ?? 0,
            'home_status' => $validated['home_status'] ?? 0,
            'priority' => $validated['priority'] ?? null,
            'icon' => $validated['icon'] ?? null,
            'icon_storage_type' => $validated['icon_storage_type'] ?? 'public',
        ]);

        // Redirect back to categories list with a success message
        return redirect()->route('categories.index')->with('success', 'Category updated successfully!');
    }

    // Remove the specified category from the database
    public function destroy($id)
    {
        // Find the category and delete it
        $category = Category::findOrFail($id);
        $category->delete();

        // Redirect back to categories list with a success message
        return redirect()->route('categories.index')->with('success', 'Category deleted successfully!');
    }
    public function getSubCategories($parentId)
{
    $subcategories = Category::where('parent_id', $parentId)->get();
    
    return response()->json([
        'subcategories' => $subcategories
    ]);
}
}
