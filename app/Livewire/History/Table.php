<?php

namespace App\Livewire\History;

use App\Models\Order;
use App\Models\Product;
use App\Models\TransactionDetail;
use Livewire\Component;

class Table extends Component
{
    public $order_id , $order, $transactionDetails;

    public function show($id){
        $this->order_id = $id;
        $this->order = Order::find($id);
        $this->transactionDetails = TransactionDetail::with('product')->where('order_id', $id)->get();

        $this->dispatch('show-order-modal');
    }

    public function render()
    {
        return view('livewire.history.table',[
            'orders' => Order::all(),
            'products' => Product::all(),
            'transactionDetails' => TransactionDetail::all()
        ]);
    }
}
