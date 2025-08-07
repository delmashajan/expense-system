<x-app-layout>
    <x-slot name="header">
        @if ($user->role == '0')
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Admin Dashboard') }}
            </h2>
        @else
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Employee Dashboard') }}
            </h2>
        @endif
    </x-slot>

    <div class="py-6 px-4 max-w-7xl mx-auto">
        @if ($user->role == '1')
            <div class="mb-4">
                <a href="{{ route('expenses.create') }}"
                    style="background: blue; color: white; padding: 10px 20px; border-radius: 5px;">
                    + Add New Expense
                </a>

            </div>
        @endif

        <h3 class="text-lg font-semibold mb-2">
            {{ $user->role == '0' ? 'All Submitted Expenses' : 'Your Submitted Expenses' }}
        </h3>


        <div class="bg-white shadow rounded p-4">
            @if ($user->role == '0')
                <form method="GET" action="{{ route('dashboard') }}" class="mb-4">
                    <label for="status" class="mr-2 font-medium">Filter by Status:</label>
                    <select name="status" id="status" onchange="this.form.submit()" class="border rounded px-3 py-1">
                        <option value="">-- All --</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Approved</option>
                        <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
                    </select>
                </form>
            @endif
            <table class="w-full text-left border">
                <thead>
                    <tr>
                        @if($user->role == '0')
                            <th class="border px-4 py-2">Employee</th>
                        @endif
                        <th class="border px-4 py-2">Title</th>
                        <th class="border px-4 py-2">Amount</th>
                        <th class="border px-4 py-2">Status</th>
                        <th class="border px-4 py-2">Receipt</th>
                        @if($user->role == '0')
                            <th class="border px-4 py-2">Actions</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @forelse($expenses as $expense)
                        <tr>
                            @if($user->role == '0')
                                <td class="border px-4 py-2">{{ $expense->user->name }}</td>
                            @endif
                            <td class="border px-4 py-2">{{ $expense->title }}</td>
                            <td class="border px-4 py-2">₹{{ $expense->amount }}</td>
                            <td class="border px-4 py-2 capitalize">{{ $expense->status }}</td>
                            <td class="border px-4 py-2">
                                @if($expense->receipt)
                                    <a href="{{ asset('storage/' . $expense->receipt->file_path) }}" target="_blank"
                                        class="text-blue-600 underline">View</a>
                                @else
                                    No file
                                @endif
                            </td>
                            @if($user->role == '0')
                                <td class="border px-4 py-2">
                                    @if($expense->status === 'pending')
                                        <form action="{{ route('expenses.approve', $expense) }}" method="POST" class="inline">
                                            @csrf
                                            <button type="submit" class="text-green-600">Approve</button>
                                        </form>
                                        |
                                        <form action="{{ route('expenses.reject', $expense) }}" method="POST" class="inline">
                                            @csrf
                                            <button type="submit" class="text-red-600">Reject</button>
                                        </form>
                                    @else
                                        <span class="text-gray-500">-</span>
                                    @endif
                                </td>
                            @endif
                        </tr>
                    @empty
                        <tr>
                            <td colspan="{{ $user->role == 0 ? 6 : 5 }}" class="border px-4 py-2 text-center">No expenses
                                found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>