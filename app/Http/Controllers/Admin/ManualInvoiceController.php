<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;

class ManualInvoiceController extends Controller
{
    public function create()
    {
        return view('admin.invoices.create-simple');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            // Info Pelanggan
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|email|max:255',
            'customer_phone' => 'required|string|max:20',
            'customer_address' => 'required|string',
            
            // Info Produk Custom
            'product_name' => 'required|string|max:255',
            'product_description' => 'required|string',
            'product_price' => 'required|numeric|min:0',
            'product_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240',
        ]);

        $customCategory = Category::where('slug', 'custom-personal-order')->firstOrFail();
        $order = null;

        DB::transaction(function () use ($request, $validated, $customCategory, &$order) {
            
            $imagePath = null;
            if ($request->hasFile("product_image")) {
                $imagePath = $request->file("product_image")->store('products', 'public');
            }

            // 1. Buat SATU produk baru
            $newProduct = Product::create([
                'name' => $validated['product_name'],
                'description' => $validated['product_description'],
                'price' => $validated['product_price'],
                'category_id' => $customCategory->id,
                'image' => $imagePath,
            ]);
            
            // Buat varian default dengan stok 0
            $newVariant = $newProduct->variants()->create(['size' => 'Custom', 'stock' => 0]);

            // 2. Buat Order baru
            $order = Order::create([
                'user_id' => null,
                'customer_name' => $validated['customer_name'],
                'customer_email' => $validated['customer_email'],
                'customer_phone' => $validated['customer_phone'],
                'customer_address' => $validated['customer_address'],
                'total_price' => $validated['product_price'], // Total harga adalah harga produk itu sendiri
                'status' => 'process',
            ]);

            // 3. Buat SATU OrderItem
            $order->items()->create([
                'product_id' => $newProduct->id,
                'product_variant_id' => $newVariant->id,
                'size' => 'Custom',
                'quantity' => 1, // Kuantitas selalu 1
                'price' => $newProduct->price,
            ]);
        });

        $filename = 'CUSTOM-INVOICE-INV' . str_pad($order->id, 3, '0', STR_PAD_LEFT) . '.pdf';
        $pdf = PDF::loadView('invoices.template', compact('order'));
        return $pdf->download($filename);
    }
}