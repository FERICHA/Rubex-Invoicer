<?php

namespace App\Http\Controllers;

use App\Models\Invoices;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\InvoicesExport;


class InvoiceReportController extends Controller
{
    public function index()
    {
        return view('reports.invoices_report');
    }
    // public function Search_invoices(Request $request)
    // {

    //     $rdio = $request->rdio;
    //     // return $rdio;

    //     // في حالة البحث بنوع الفاتورة

    //     if ($rdio == 1) {


    //         // في حالة عدم تحديد تاريخ
    //         if ($request->type && $request->start_at == '' && $request->end_at == '') {

    //             $invoices = invoices::select('*')->where('Status', '=', $request->type)->get();
    //             $type = $request->type;
    //             return view('reports.invoices_report', compact('type', 'invoices'));
    //         }

    //         // في حالة تحديد تاريخ استحقاق
    //         else {

    //             $start_at = date($request->start_at);
    //             $end_at = date($request->end_at);
    //             $type = $request->type;

    //             $invoices = invoices::whereBetween('invoice_Date', [$start_at, $end_at])->where('Status', '=', $request->type)->get();
    //             return view('reports.invoices_report', compact('type', 'start_at', 'end_at', 'invoices'));
    //         }
    //     }

    //     //====================================================================

    //     // في البحث برقم الفاتورة
    //     else {

    //         $invoices = Invoices::select('*')->where('invoice_number', '=', $request->invoice_number)->get();
    //         return view('reports.invoices_report', compact(
    //             'invoices'
    //         ));
    //     }
    // }





    public function Search_invoices(Request $request)
{
    $invoices = [];
    $totalAmount = 0; 
    
    $rdio = $request->input('rdio');

    if ($rdio === '1') {
        $start_at = $request->input('start_at');
        $end_at = $request->input('end_at');

        $invoices = invoices::whereBetween('invoice_Date', [$start_at, $end_at])->get();
    } elseif ($rdio === '2') {
        $invoice_number = $request->input('invoice_number');

        $invoices = invoices::where('invoice_number', '=', $invoice_number)->get();
    }

    foreach ($invoices as $invoice) {
        $totalAmount += $invoice->amount;
    }

    if ($rdio === '1') {
        return view('reports.invoices_report', compact('start_at', 'end_at', 'invoices', 'totalAmount'));
    } else {
        return view('reports.invoices_report', compact('invoices', 'totalAmount'));
    }
}

    




public function exportToCSV(Request $request)
{
    $start_at = $request->input('start_at');
    $end_at = $request->input('end_at');
    $invoice_number = $request->input('invoice_number');
    
    $invoices = $this->getInvoicesToExport($start_at, $end_at, $invoice_number);
    $totalAmount = $invoices->sum('amount'); // Calculate total amount

    return $this->downloadCSV($invoices, $totalAmount);
}




private function getInvoicesToExport($start_at, $end_at, $invoice_number)
{
    if ($start_at && $end_at) {
        return invoices::whereBetween('invoice_Date', [$start_at, $end_at])->get();
    } elseif ($invoice_number) {
        return invoices::where('invoice_number', '=', $invoice_number)->get();
    } else {
        return collect([]);
    }
}



private function downloadCSV($invoices, $totalAmount)
{
    $filename = 'invoices.csv';

    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename="' . $filename . '"');
    header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
    header('Expires: 0');
    
    $output = fopen('php://output', 'w');

    fputs($output, "\xEF\xBB\xBF");

    

    foreach ($invoices as $invoice) {
        $data = [
            'Numéro de facture : ', $invoice->invoice_number, '', '', '', '', '',
            'Date de facture : ', $invoice->invoice_Date, '', '', '', '', '',
            'Date d\'échéance : ', $invoice->Due_date, '', '', '', '', '',
            'Dépense : ', $invoice->product, '', '', '', '', '',
            'Montant : ', $invoice->amount, '', '', '', '', '',
            'Statut : ', $invoice->Status, '', '', '', '', '',
            'Notes : ' ,  $invoice->note ?? 'N/A', '', '', '', '', '',
        ];

        fputcsv($output, $data, ' ');
    }

    fputcsv($output, ['Total ', '', '', '', '', $totalAmount,'MAD'], ' ');

    fclose($output);
}







    
}
