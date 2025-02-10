<?php



namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category; // Import Category Model
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $products = Product::paginate(10); // ✅ Correct (Paginate with 10 products per page)
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all(); // Fetch all categories
        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'category_id' => 'required|exists:categories,id', // Ensure category exists
            'image' => 'required|image',
            'is_sponsored' => 'boolean',
            'is_valentine' => 'boolean',
            'sales_count' => 'integer',
        ]);

        $imagePath = $request->file('image')->store('products', 'public');

        Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'category_id' => $request->category_id,
            'image' => $imagePath,
            'is_sponsored' => $request->has('is_sponsored'),
            'is_valentine' => $request->has('is_valentine'),
            'sales_count' => $request->input('sales_count', 0),
        ]);

        return redirect()->route('admin.products.index')->with('success', 'Product added successfully.');
    }

    // Show edit form for a specific product
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all(); // Fetch all categories
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'is_sponsored' => 'boolean',
            'is_valentine' => 'boolean',
            'sales_count' => 'integer',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
            $product->image = $imagePath;
        }

        $product->update([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'is_sponsored' => $request->has('is_sponsored'),
            'is_valentine' => $request->has('is_valentine'),
            'sales_count' => $request->input('sales_count', 0),
        ]);

        return redirect()->route('admin.products.index')->with('success', 'Product updated successfully.');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully.');
    }

    // category controller 
    // Display All Categories
    public function categoryIndex()
    {
        $categories = Category::all();
        return view('admin.categories.index', compact('categories'));
    }

    // Show Category Creation Form
    public function categoryCreate()
    {
        return view('admin.categories.create');
    }

    // Store a New Category
    public function categoryStore(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:categories|max:255',
        ]);

        Category::create(['name' => $request->name]);

        return redirect()->route('admin.categories.index')->with('success', 'Category added successfully!');
    }

    // Delete a Category
    public function categoryDestroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()->route('admin.categories.index')->with('success', 'Category deleted successfully!');
    }
}
