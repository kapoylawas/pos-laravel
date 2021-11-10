<?php

namespace App\Http\Livewire;

use App\Models\Transaction;
use App\Models\ProductTransaction;
use Livewire\Component;

class History extends Component
{
    public function render()
    {
        $transactions = Transaction::with('user')->get();
        $products = ProductTransaction::with('product')->get();
        // dd($products);
        return view('livewire.history', ['transactions' => $transactions, 'products' => $products]);
    }

    
}
