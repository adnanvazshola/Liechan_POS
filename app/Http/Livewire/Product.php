<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Product as ProductModel;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class Product extends Component
{
    use WithFileUploads;

    public $name, $image, $price, $description, $quantity, $jenis_makanan, $id_product;

    public function render()
    {
        $makanan = ProductModel::orderBy('name', 'asc')->where('jenis_makanan', '0')->get();
        $minuman = ProductModel::orderBy('name', 'asc')->where('jenis_makanan', '1')->get();
        $tambahan = ProductModel::orderBy('name', 'asc')->where('jenis_makanan', '2')->get();

        return view('livewire.product', [
            'makanan'   => $makanan,
            'minuman'   => $minuman,
            'tambahan'  => $tambahan,
        ]);
    }
    public function store()
    {
        $this->validate([
            'name'          => 'required',
            'image'         => 'required|image',
            'price'         => 'required',
            'description'   => 'nullable',
            'quantity'      => 'required',
            'jenis_makanan' => 'required',
        ]);

        $imageName = md5($this->image.microtime().'.'.$this->image->extension());

        Storage::putFileAs(
            'public/images',
            $this->image,
            $imageName
        );

        ProductModel::updateOrCreate(['id' => $this->id_product], [
            'name'          => $this->name,
            'image'         => $imageName,
            'description'   => $this->description,
            'quantity'      => $this->quantity,
            'price'         => $this->price,
            'jenis_makanan' => $this->jenis_makanan,
        ]);

        session()->flash('info' , 'Product telah disimpan');

        $this->name = '';
        $this->description = '';
        $this->quantity = '';
        $this->price = '';
        $this->jenis_makanan = '';
        $this->image = '';
    }

    public function edit($id)
    {
        $product = ProductModel::find($id);
        $this->id_product = $product->id;
        $this->name = $product->name;
        $this->description = $product->description;
        $this->quantity = $product->quantity;
        $this->price = $product->price;
        $this->jenis_makanan = $product->jenis_makanan;
        $this->image = $product->image;
    }

    public function destroy($id)
    {
        $product = ProductModel::find($id);
        File::delete(storage_path('../public/storage/image/' . $product->image));
        $product->delete();
        session()->flash('info' , $product->name . ' telah dihapus');
    }
}
