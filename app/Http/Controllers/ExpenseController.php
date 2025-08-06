<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreExpenseRequest;
use App\Models\Expense;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExpenseController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();
        $status = $request->query('status'); // e.g., pending, approved, rejected

        if ($user->role == 0) {
            $query = Expense::with('user', 'receipt')->latest();
        } else {
            $query = $user->expenses()->with('receipt')->latest();
        }

        if ($status && in_array($status, ['pending', 'approved', 'rejected'])) {
            $query->where('status', $status);
        }

        $expenses = $query->get();

        return view('dashboard', compact('expenses', 'user', 'status'));
    }


    public function create()
    {
        return view('employee.create');
    }

    public function store(StoreExpenseRequest $request)
    {
        $expense = Expense::create([
            'user_id' => auth()->id(),
            'title' => $request->title,
            'amount' => $request->amount,
            'description' => $request->description,
            'status' => 'pending',
        ]);

        if ($request->hasFile('receipt')) {
            $path = $request->file('receipt')->store('receipts', 'public');
            $expense->receipt()->create(['file_path' => $path]);
        }

        return redirect()->route('dashboard')->with('success', 'Expense submitted!');
    }

    public function approve(Expense $expense)
    {
        $expense->update(['status' => 'approved']);
        return back();
    }

    public function reject(Expense $expense)
    {
        $expense->update(['status' => 'rejected']);
        return back();
    }
}
