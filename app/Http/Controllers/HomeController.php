<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\invoices;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $chartjs2 = app()->chartjs
        ->name('lineChartTest')
        ->type('line')
        ->size(['width' => 400, 'height' => 200])
        ->labels(['January', 'February', 'March', 'April', 'May', 'June', 'July'])
        ->datasets([
            [
                "label" => "My First dataset",
                'backgroundColor' => "rgba(38, 185, 154, 0.31)",
                'borderColor' => "rgba(38, 185, 154, 0.7)",
                "pointBorderColor" => "rgba(38, 185, 154, 0.7)",
                "pointBackgroundColor" => "rgba(38, 185, 154, 0.7)",
                "pointHoverBackgroundColor" => "#fff",
                "pointHoverBorderColor" => "rgba(220,220,220,1)",
                'data' => [65, 59, 80, 81, 56, 55, 40],
            ],
            [
                "label" => "My Second dataset",
                'backgroundColor' => "rgba(38, 185, 154, 0.31)",
                'borderColor' => "rgba(38, 185, 154, 0.7)",
                "pointBorderColor" => "rgba(38, 185, 154, 0.7)",
                "pointBackgroundColor" => "rgba(38, 185, 154, 0.7)",
                "pointHoverBackgroundColor" => "#fff",
                "pointHoverBorderColor" => "rgba(220,220,220,1)",
                'data' => [12, 33, 44, 44, 55, 23, 40],
            ]
        ])
        ->options([]);

    //     $chartjs = app()->chartjs
    //      ->name('barChartTest')
    //      ->type('bar')
    //      ->size(['width' => 350, 'height' => 200])
    //      ->labels(['الفواتير المدفوعة', 'الفواتير الغير مدفوعة'])
    //      ->datasets([
    //          [
    //              "label" => "الفواتير المدفوعة",
    //              'backgroundColor' => ['rgba(41, 150, 230, 0.3)', "rgba(38, 185, 140, 0.5)"],// الفواتير المدفوعه و اجمالى الفواتير
    //              'data' => [69, 59]
    //          ],
    //          [
    //              "label" => 'الفواتير الغير مدفوعة',
    //              'backgroundColor' => ['rgba(255, 99, 132, 0.4)','rgba(54, 162, 235, 0.4)'],// الفواتير المدفوعه جزئيا و الفواتير غير المدفوعه
    //              'data' => [65, 12]
    //          ]
    //      ])
    //      ->options([]);

    //     return view('home', compact('chartjs','chartjs2'));
    // }
    //=================احصائية نسبة تنفيذ الحالات======================



    $count_all =invoices::count();
    $count_invoices1 = invoices::where('Value_Status', 1)->count();
    $count_invoices2 = invoices::where('Value_Status', 2)->count();
    $count_invoices3 = invoices::where('Value_Status', 3)->count();

    if($count_invoices2 == 0){
        $nspainvoices2=0;
    }
    else{
        $nspainvoices2 = $count_invoices2/ $count_all*100;
    }

      if($count_invoices1 == 0){
          $nspainvoices1=0;
      }
      else{
          $nspainvoices1 = $count_invoices1/ $count_all*100;
      }

      if($count_invoices3 == 0){
          $nspainvoices3=0;
      }
      else{
          $nspainvoices3 = $count_invoices3/ $count_all*100;
      }


      $chartjs = app()->chartjs
          ->name('barChartTest')
          ->type('bar')
          ->size(['width' => 350, 'height' => 200])
          ->labels(['الفواتير الغير المدفوعة', 'الفواتير المدفوعة','الفواتير المدفوعة جزئيا'])
          ->datasets([
              [
                  "label" => "الفواتير الغير المدفوعة",
                  'backgroundColor' => ['rgba(255, 99, 132, 0.4)'],
                  'data' => [$nspainvoices2]
              ],
              [
                  "label" => "الفواتير المدفوعة",
                  'backgroundColor' => ["rgba(38, 185, 140, 0.5)"],
                  'data' => [$nspainvoices1]
              ],
              [
                  "label" => "الفواتير المدفوعة جزئيا",
                  'backgroundColor' => ['rgba(54, 162, 235, 0.4)'],
                  'data' => [$nspainvoices3]
              ],


          ])
          ->options([]);


      $chartjs_2 = app()->chartjs
          ->name('pieChartTest')
          ->type('pie')
          ->size(['width' => 340, 'height' => 200])
          ->labels(['الفواتير الغير المدفوعة', 'الفواتير المدفوعة','الفواتير المدفوعة جزئيا'])
          ->datasets([
              [
                  'backgroundColor' => ['rgba(54, 162, 235,0.6)', "rgba(54, 162, 235, 0.4)",'rgba(54, 162, 235, 0.2)'],
                  'data' => [$nspainvoices2, $nspainvoices1,$nspainvoices3]
              ]
          ])
          ->options([]);

      return view('home', compact('chartjs','chartjs_2','chartjs2'));

  }
}
