<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use Illuminate\Http\Request;

use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Csv as ReaderCsv;
use PhpOffice\PhpSpreadsheet\Writer\Csv as WriterCsv;
use Inertia\Inertia;
use Illuminate\Support\Facades\Storage;

class ExcelImportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('Test/ExcelImport');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function import(Request $request)
    {
        $spreadsheet = IOFactory::load($request->file);

        if($spreadsheet->sheetNameExists(1) === false){
            dd("指定されたシートは存在しません");
        }
        $sheet = $spreadsheet->getSheetByName(1);

        $a = $sheet->getCellByColumnAndRow(1,7)->getValue();

        $cellStyle = $spreadsheet->getActiveSheet()->getStyle('A2');
        $cellStyle = $spreadsheet->getActiveSheet()->getStyleByColumnAndRow(1,2);
        $a['B1'] = $cellStyle->getFill()->getEndColor()->getRGB();
        // $a = $sheet->getTabColor();
        dd($a);

        // $spreadsheet = new Spreadsheet();
        // $sheet = $spreadsheet->getActiveSheet();
        // $sheet->setCellValue('A1', 'こんにちは！');
        // $sheet->setCellValue('B1', 'Hello');

        // $writer = new WriterCsv($spreadsheet);
        // $writer->setUseBOM(false);
        // $writer->setOutputEncoding('shift-jis');

        // //$writer = IOFactory::createWriter($spreadsheet, 'Csv');
        // $writer->save(public_path() . 'output.csv');
        // //$writer->save('hello.csv');

        // $headers = [
        //     'Content-Type' => 'application/pdf',
        //     'Content-Disposition' => 'attachment; filename="' . 'hello.csv' . '"'
        // ];

        // $header = [
        //     'Content-Type' => 'application/octet-stream',
        // ];

        // return response()->download(public_path() . 'output.csv');

        // // レスポンスを返します。
        // //return response()->make($writer, 200, $headers);
        // return response()->streamDownload($writer, 'hello.csv', $headers);
    }
}
