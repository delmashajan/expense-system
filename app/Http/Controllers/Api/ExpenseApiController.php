<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreExpenseRequest;
use App\Models\Expense;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\ExpenseResource;

class ExpenseApiController extends Controller
{
    // 1. List expenses
    public function index(Request $request)
    {
        $user = Auth::user();
        $status = $request->query('status');

        $query = Expense::with('receipt');

        if ($user->role == 1) {
            $query->where('user_id', $user->id);
        }

        if ($status && in_array($status, ['pending', 'approved', 'rejected'])) {
            $query->where('status', $status);
        }

        return response()->json([
            'success' => true,
            'data' => ExpenseResource::collection($query->latest()->get())
        ]);
    }

    // 2. View single expense
    public function show(Expense $expense)
    {
        $user = Auth::user();

        if ($user->role == 1 && $expense->user_id !== $user->id) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        return response()->json([
            'success' => true,
            'data' => new ExpenseResource($expense)
        ]);
    }

    // 3. Store new expense
    public function store(StoreExpenseRequest $request)
    {

        $expense = Expense::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'amount' => $request->amount,
            'description' => $request->description,
            'status' => 'pending',
        ]);

        if ($request->hasFile('receipt')) {
            $path = $request->file('receipt')->store('receipts', 'public');
            $expense->receipt()->create(['file_path' => $path]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Expense created successfully.',
            'data' => $expense->load('receipt')
        ]);
    }

    public function approve(Expense $expense)
    {
        $expense->update(['status' => 'approved']);

        return response()->json([
            'message' => 'Expense approved.',
            'data' => $expense
        ]);
    }

    public function reject(Expense $expense)
    {
        $expense->update(['status' => 'rejected']);

        return response()->json([
            'message' => 'Expense rejected.',
            'data' => $expense
        ]);
    }
}
