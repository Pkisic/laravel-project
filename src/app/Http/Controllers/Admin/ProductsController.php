<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Size;
use App\Models\Brand;

class ProductsController extends Controller {

    public function index(Request $request) {
        return view('admin.products.index', [
                //'products' => $products,
        ]);
    }

    public function datatable(Request $request) {

        $searchFilters = $request->validate([
            'name' => ['nullable', 'string', 'max:255'],
            'brand_id' => ['nullable', 'numeric', 'exists:brands,id'],
            'product_category_id' => ['nullable', 'numeric', 'exists:product_categories,id'],
            'featured' => ['nullable', 'in:0,1'],
            'size_ids' => ['nullable', 'array', 'exists:sizes,id']
        ]);

        $query = Product::query()
                ->with(['brand', 'productCategory', 'sizes'])
                ->join('brands', 'products.brand_id', '=', 'brands.id')
                ->join('product_categories', 'products.product_category_id', '=', 'product_categories.id')
                ->select(['products.*', 'brands.name AS brand_name', 'product_categories.name AS product_category_name']);

        /* if(isset($searchFilters['name'])){
          $query->where('products.name','LIKE', '%' . $searchFilters['name'] . '%');
          }

          if(isset($searchFilters['brand_id'])){
          $query->where('products.brand_id','LIKE', '%' . $searchFilters['brand_id'] . '%');
          }

          if(isset($searchFilters['product_category_id'])){
          $query->where('products.product_category_id','LIKE', '%' . $searchFilters['product_category_id'] . '%');
          }

          if(isset($searchFilters['featured'])){
          $query->where('products.featured','=', $searchFilters['featured']);
          }

          if(isset($searchFilters['size_ids'])){
          $query->whereHas('sizes', function($subQuery) use($searchFilters){//query iz tabele na koju se odnosi relacija // pod upit
          $subQuery->whereIn('size_id', $searchFilters['size_ids']);
          });
          } */

        //inicijalizacija
        $dataTable = \DataTables::of($query);

        //podesavanja
        $dataTable->addColumn('sizes', function($product) {
                    return optional($product->sizes->pluck('name'))->join(', ');
                })
//        ->addColumn('brand_name', function($product){
//            return optional($product->brand)->name;
//        })
//        ->addColumn('product_category_name', function($product){
//            return optional($product->productCategory)->name;
//        })
                ->addColumn('actions', function($product) {
                    return view('admin.products.partials.actions', ['product' => $product]);
                })
                ->editColumn('id', function($product) {
                    return '#' . $product->id;
                })
                ->editColumn('name', function($product) {
                    return '<strong>' . e($product->name) . '</strong>';
                })
                ->editColumn('photo1', function($product) {
                    return view('admin.products.partials.product_photo', ['product' => $product]);
                });

        $dataTable->rawColumns(['name', 'photo1', 'actions']);

        $dataTable->filter(function($query) use ($request, $searchFilters) {

            if ($request->has('search') && is_array($request->get('search')) && isset($request->get('search')['value'])) {

                $searchTerm = $request->get('search')['value'];

                $query->where(function($query) use($searchTerm) {

                    $query->orWhere('products.name', 'LIKE', '%' . $searchTerm . '%')
                            ->orWhere('products.description', 'LIKE', '%' . $searchTerm . '%')
                            ->orWhere('brands.name', 'LIKE', '%' . $searchTerm . '%')
                            ->orWhere('product_categories.name', 'LIKE', '%' . $searchTerm . '%')
                            ->orWhere('products.id', 'LIKE', $searchTerm);
                });
            }
            if (isset($searchFilters['name'])) {
                $query->where('products.name', 'LIKE', '%' . $searchFilters['name'] . '%');
            }

            if (isset($searchFilters['brand_id'])) {
                $query->where('products.brand_id', 'LIKE', '%' . $searchFilters['brand_id'] . '%');
            }

            if (isset($searchFilters['product_category_id'])) {
                $query->where('products.product_category_id', 'LIKE', '%' . $searchFilters['product_category_id'] . '%');
            }

            if (isset($searchFilters['featured'])) {
                $query->where('products.featured', '=', $searchFilters['featured']);
            }

            if (isset($searchFilters['size_ids'])) {
                $query->whereHas('sizes', function($subQuery) use($searchFilters) {//query iz tabele na koju se odnosi relacija // pod upit
                    $subQuery->whereIn('size_id', $searchFilters['size_ids']);
                });
            }
        });

        return $dataTable->make(true); // make - json po specifikaciji DataTables.js plugin-a
    }

    public function add(Request $request) {
        $productCategories = ProductCategory::getAllProductCategories();
        $sizes = Size::all();
        $brands = Brand::getAllBrands();

        return view('admin.products.add', [
            'productCategories' => $productCategories,
            'sizes' => $sizes,
            'brands' => $brands,
        ]);
    }

    public function insert(Request $request) {
        $formData = $request->validate([
            'brand_id' => ['required', 'numeric', 'exists:brands,id'],
            'product_category_id' => ['required', 'numeric', 'exists:product_categories,id'],
            'name' => ['required', 'string', 'max:255', 'unique:products,name'],
            'description' => ['nullable', 'string', 'max:2000'],
            'price' => ['required', 'numeric', 'min:0.01'],
            'old_price' => [
                'nullable',
                'numeric',
                'min:0.01',
                function ($attribute, $value, $fail) use($request) {
                    $price = $request->input('price');
                    $difference = $price * 0.1;
                    if ($value < ($difference + $price)) {
                        $fail(__('Old price must be greater than price for at least 10 % ' . ($difference + $price)));
                    }
                },
            ],
            'featured' => ['required', 'numeric', 'in:0,1'],
            'size_id' => ['required', 'array', 'exists:sizes,id', 'min:2'],
            'photo1' => ['nullable', 'file', 'image'],
            'photo2' => ['nullable', 'file', 'image'],
            'details' => ['nullable','string']
        ]);

        $newProduct = new Product();

        $newProduct->fill($formData);

        $newProduct->save();

        $newProduct->sizes()->sync($formData['size_id']);

        $this->handlePhotoUpload('photo1', $request, $newProduct);
        $this->handlePhotoUpload('photo2', $request, $newProduct);

        session()->flash('system_message', __('New Product Has Been Saved!'));
        return redirect()->route('admin.products.index');
    }

    public function edit(Request $request, Product $product) {

        $productCategories = ProductCategory::getAllProductCategories();
        $sizes = Size::all();

        return view('admin.products.edit', [
            'product' => $product,
            'productCategories' => $productCategories,
            'sizes' => $sizes,
        ]);
    }

    public function update(Request $request, Product $product) {
        $formData = $request->validate([
            'brand_id' => ['required', 'numeric', 'exists:brands,id'],
            'product_category_id' => ['required', 'numeric', 'exists:product_categories,id'],
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('products')->ignore($product->id),
            ],
            'description' => ['nullable', 'string', 'max:2000'],
            'price' => ['required', 'numeric', 'min:0.01'],
            'old_price' => [
                'nullable',
                'numeric',
                'min:0.01',
                function ($attribute, $value, $fail) use($request) {
                    if ($value <= $request->input('price')) {
                        $fail(__('Old price must be greater than price'));
                    }
                },
            ],
            'featured' => ['required', 'numeric', 'in:0,1'],
            'size_id' => ['required', 'array', 'exists:sizes,id', 'min:2'],
            'photo1' => ['nullable', 'file', 'image'],
            'photo2' => ['nullable', 'file', 'image'],
            'details' => ['nullable','string']
        ]);

        $product->fill($formData);

        $product->save();

        $product->sizes()->sync($formData['size_id']);


        $this->handlePhotoUpload('photo1', $request, $product);
        $this->handlePhotoUpload('photo2', $request, $product);


        session()->flash('system_message', __('Product Has Been Updated!'));

        return redirect()->route('admin.products.index');
    }

    public function delete(Request $request) {
        $formData = $request->validate([
            'id' => ['required', 'numeric', 'exists:products,id'],
        ]);

        $product = Product::findOrFail($formData['id']);

        $product->sizes()->detach();
        $product->deletePhotos();
        $product->delete();
        /*
          if($request->wantsJson()){//ajax poziv
          return response()->json([
          'system_message' => __('Product has been deleted!')
          ]);
          }

          session()->flash('system_message', __('Product Has Been Deleted!'));

          return redirect()->route('admin.products.index'); */

        return response()->json([
            'system_message' => __('Product has been deleted!')
        ]);
    }

    public function toggleFeatured(Request $request) {
        $formData = $request->validate([
            'id' => ['required', 'numeric', 'exists:products,id'],
        ]);

        $product = Product::findOrFail($formData['id']);

        $product->toggleSetFeatured();
        $product->save();
        $message = ($product->featured) ? __('Product has been marked as featured!') : __('Product has been removed from featured!');
        return response()->json([
            'system_message' => $message,
        ]);
    }

    public function deletePhoto(Request $request, Product $product) {
        $formData = $request->validate([
            'photo' => ['required', 'string', 'in:photo1,photo2'],
        ]);

        $photoFieldName = $formData['photo'];
        $product->deletePhoto($photoFieldName);

        $product->$photoFieldName = null;
        $product->save();

        return response()->json([
                    'system_message' => __('Photo has been deleted!'),
                    'photo_url' => $product->getPhoto($photoFieldName),
        ]);
    }

    protected function handlePhotoUpload(string $photoFieldName, Request $request, Product $product) {

        if ($request->hasFile($photoFieldName)) {
            $product->deletePhoto($photoFieldName);

            $photoFile = $request->file($photoFieldName);

            $newPhotoFileName = $product->id . '_' . $photoFieldName . '_' . $photoFile->getClientOriginalName();

            $photoFile->move(
                    public_path('/storage/products/'),
                    $newPhotoFileName
            );


            $product->$photoFieldName = $newPhotoFileName;
            $product->save();

            \Image::make(public_path('/storage/products/' . $product->$photoFieldName))
                    ->fit(600, 600)
                    ->save();
        }
    }

}
