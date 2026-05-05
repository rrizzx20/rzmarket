<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Saving;
use App\Models\SavingTarget;

class SavingController extends Controller
{
    public function index()
    {
        $targets = SavingTarget::all();
        $savings = Saving::latest()->get();
        $totalSavings = SavingTarget::sum('current_amount');
        
        return view('savings.index', compact('targets', 'savings', 'totalSavings'));
    }

    public function create()
    {
        return view('savings.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:0',
            'type' => 'required|in:deposit,withdrawal',
            'description' => 'nullable|string',
            'target_id' => 'required|exists:saving_targets,id',
        ]);

        $saving = Saving::create($request->only('amount', 'type', 'description', 'target_id'));

        $target = SavingTarget::findOrFail($request->target_id);
        if ($request->type === 'deposit') {
            $target->increment('current_amount', $request->amount);
        } else {
            $target->decrement('current_amount', $request->amount);
        }

        if ($target->current_amount >= $target->target_amount) {
            $target->update(['status' => 'achieved']);
        } else {
            $target->update(['status' => 'active']);
        }

        return redirect()->route('savings.index')->with('success', 'Tabungan berhasil dicatat');
    }

    public function createTarget()
    {
        return view('savings.create_target');
    }

    public function storeTarget(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'target_amount' => 'required|numeric|min:0',
        ]);

        SavingTarget::create([
            'name' => $request->name,
            'target_amount' => $request->target_amount,
            'current_amount' => 0,
            'status' => 'active',
        ]);

        return redirect()->route('savings.index')->with('success', 'Target tabungan berhasil dibuat');
    }

    public function destroy(Saving $saving)
    {
        // Jika setorannya dihapus, kembalikan saldo di targetnya (jika masih ada targetnya)
        // Namun untuk kesederhanaan, kita hapus saja catatannya
        $saving->delete();
        return redirect()->route('savings.index')->with('success', 'Catatan tabungan berhasil dihapus');
    }

    public function destroyTarget(SavingTarget $target)
    {
        $target->delete();
        return redirect()->route('savings.index')->with('success', 'Target tabungan berhasil dihapus');
    }
}
