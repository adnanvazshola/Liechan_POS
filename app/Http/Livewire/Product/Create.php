<?php

namespace App\Http\Livewire\Product;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Product as ProductModel;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class Create extends Component
{
    use WithFileUploads;

    public $name, $image, $price, $description, $jenis_makanan, $id_product;

    protected $messages = [
        'required'      => 'Field tidak boleh kosong.',
        'name.unique'   => 'Nama produk sudah ada.',
        'numeric'       => 'Field ini diisi dengan angka',
        'mimes'         => 'Foto harus dengan format jpg, jpeg, png'
    ];

    public function store()
    {
        $this->validate([
            // 'name'          => 'required|unique:products',
            'name'          => 'required',
            'image'         => 'required|image|mimes: jpg,jpeg,png',
            'price'         => 'required|numeric',
            'description'   => 'nullable',
            'jenis_makanan' => 'required',
        ]);

        $messages = [
            'name.required' => 'Nama ini telah ada.',
        ];

        
        $image = $this->image;
        $imageName = md5($this->image.microtime().'.'.$this->image->extension());
        $image_resize = Image::make($image->getRealPath());
        $image_resize->resize(900,585);
        $image_resize->save(public_path('storage/images/'.$imageName));

        // Storage::putFileAs(
        //     'public/images',
        //     $this->image,
        //     $imageName
        // );

        ProductModel::create([
            'name'          => $this->name,
            'image'         => $imageName,
            'description'   => $this->description,
            'price'         => $this->price,
            'jenis_makanan' => $this->jenis_makanan,
        ]);

        $this->back();
    }

    public function render()
    {
        return view('livewire.product.create');
    }

    public function back()
    {
        return redirect()->route('products.index');
    }
}
