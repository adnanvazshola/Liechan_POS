<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Product as ProductModel;
use Illuminate\Support\Facades\File;

class Product extends Component
{

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

    public function create()
    {
        return redirect()->route('product.create');
    }
    
    public function edit($id)
    {
        $product = ProductModel::find($id);

        return redirect()->route('product.edit', $product->id);
    }

    public function destroy($id)
    {
        $product = ProductModel::find($id);
        File::delete(storage_path('../public/storage/images/' . $product->image));
        $product->delete();
        session()->flash('info' , $product->name . ' telah dihapus');
    }

    public function changeStatus($id)
    {
        $product = ProductModel::find($id);
        if ($product->status == 0) {
            $product->update([
                'status' => 1
            ]);
        }else {
            $product->update([
                'status' => 0
            ]);
        }
    }
}
