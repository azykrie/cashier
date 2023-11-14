<?php
namespace App\Http\Controllers;

use App\Models\Transaction;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;

class InvoiceController extends Controller
{
    public function pdf()
    {
        $transactions = Transaction::all();
        $pdf = FacadePdf::loadView('transaction.invoice', compact('transactions'));
        return $pdf->download('invoice.pdf');
    }
}

