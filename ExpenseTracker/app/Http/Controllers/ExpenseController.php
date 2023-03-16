<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Expense;
use App\Charts\ExpenseChart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ExpenseController extends Controller
{

    // Show current expense
    public function index(Request $request)
    {
        if ($request->has('filter_date')) {
            $filterDate = $request->input('filter_date');
        } else {
            $filterDate = Carbon::now()->format('Y-m-d');
        }

        $userId = auth()->id();

        // Daily Data
        $dailyReportData = Expense::dailyReportData($userId, $filterDate)->get();

        // Monthly Data
        $startDate = Carbon::parse($filterDate)->startOfMonth();
        $endDate =Carbon::parse($filterDate)->endOfMonth();

        $monthlyReportData = Expense::monthlyReportData($userId, $startDate, $endDate)->get();

        $totalFood = $monthlyReportData->whereIn('category', ['Food'])->pluck('amount')->sum();
        $totalEntertainment = $monthlyReportData->whereIn('category', ['Entertainment'])->pluck('amount')->sum();
        $totalTransportation = $monthlyReportData->whereIn('category', ['Transportation'])->pluck('amount')->sum();
        $totalUtilities = $monthlyReportData->whereIn('category', ['Utilities'])->pluck('amount')->sum();
        $totalMiscellaneous = $monthlyReportData->whereIn('category', ['Miscellaneous'])->pluck('amount')->sum();

        // ExpenseChart

        $borderColors = [
            "rgba(254, 202, 202, 1.0)",
            "rgba(187, 247, 208, 1.0)",
            "rgba(191, 219, 254, 1.0)",
            "rgba(254, 240, 138, 1.0)",
            "rgba(233, 213, 255, 1.0)"
        ];

        $fillColors = [
            "rgba(254, 202, 202, 0.5)",
            "rgba(187, 247, 208, 0.5)",
            "rgba(191, 219, 254, 0.5)",
            "rgba(254, 240, 138, 0.5)",
            "rgba(233, 213, 255, 0.5)"
        ];

        $expenseChart = new ExpenseChart;
        $expenseChart->labels(['Food', 'Entertainment', 'Transportation', 'Utilities', 'Miscellaneous']);
        $expenseChart->dataset('Monthly Expense', 'pie', [$totalFood, $totalEntertainment, $totalTransportation, $totalUtilities, $totalMiscellaneous])
            ->color($borderColors)
            ->backgroundcolor($fillColors);

        return view('expenses.index', [
            'dailyReportData' => $dailyReportData,
            'monthlyReportData' => $monthlyReportData,
            'filterDate' => $filterDate,
            'totalFood' => $totalFood,
            'totalEntertainment' => $totalEntertainment,
            'totalTransportation' => $totalTransportation,
            'totalUtilities' => $totalUtilities,
            'totalMiscellaneous' => $totalMiscellaneous,
            'expenseChart' => $expenseChart

        ]);
    }
    
    // Store Expense Data
    public function store(Request $request) {
        
        $formFields = $request->validate([
            'category' => 'required',
            'amount' => 'required|numeric',
            'date' => 'required'
        ]);
        
        $formFields['user_id'] = auth()->id();
        
        Expense::create($formFields);
        
        return redirect('/index')->with('message', 'Expense created succesfully!');
    }

    // Delete Expense
    public function delete(Expense $data) {
        $data->delete();
        return back()->with('message', 'Expense deleted successfully!');
    }
}
