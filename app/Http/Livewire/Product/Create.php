<?php

namespace App\Http\Livewire\Product;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Product as ProductModel;
use Illuminate\Support\Facades\Storage;

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
            'name'          => 'required|unique:products',
            'image'         => 'required|image|mimes: jpg,jpeg,png',
            'price'         => 'required|numeric',
            'description'   => 'nullable',
            'jenis_makanan' => 'required',
        ]);

        $messages = [
            'name.required' => 'Nama ini telah ada.',
        ];

        $imageName = md5($this->image.microtime().'.'.$this->image->extension());

        Storage::putFileAs(
            'public/images',
            $this->image,
            $imageName
        );

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
