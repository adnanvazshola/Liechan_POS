<?php

namespace App\Http\Livewire\Product;

use Livewire\Component;
use App\Models\Product as ProductModel;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class Edit extends Component
{
    use WithFileUploads;

    public $productId, $name, $image, $imageProduct, $price, $description, $quantity, $jenis_makanan;

    public function mount($id)
    {
        $product = ProductModel::find($id);

        if($product){
            $this->productId    = $product->id;
            $this->name         = $product->name;
            $this->imageProduct = $product->image;
            $this->price        = $product->price;
            $this->description  = $product->description;
            $this->quantity     = $product->quantity;
            $this->jenis_makanan= $product->jenis_makanan;
        }
    }

    public function update()
    {
        $this->validate([
            'name'          => 'required',
            'image'         => 'nullable|image|mimes: jpg,jpeg,png',
            'price'         => 'required|numeric',
            'description'   => 'nullable',
            'quantity'      => 'required|numeric',
            'jenis_makanan' => 'required',
        ]);
        
        if ($this->productId) {
            $product = ProductModel::find($this->productId);

            if ($product) {
                if ($this->image) {
                    $imageName = md5($this->image.microtime().'.'.$this->image->extension());
    
                    Storage::putFileAs(
                        'public/images',
                        $this->image,
                        $imageName
                    );
                }

                $product->update([
                    'name'          => $this->name,
                    'image'         => $imageName ?? $product->image,
                    'description'   => $this->description,
                    'quantity'      => $this->quantity,
                    'price'         => $this->price,
                    'jenis_makanan' => $this->jenis_makanan,
                ]);
            }
        }

        $this->back();
    }

    public function render()
    {
        return view('livewire.product.edit');
    }

    public function back()
    {
        return redirect()->route('products.index');
    }
}