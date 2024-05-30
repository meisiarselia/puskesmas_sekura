<?php

namespace App\Http\Controllers\Admin;

use App\Models\Faq;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FaqController extends Controller
{
    protected $rules = [
        'pertanyaan' => 'required|max:255',
        'jawaban' => 'required'
    ];
    public function index()
    {
        $faqs = Faq::all();
        return view('admin.faq.index', compact('faqs'));
    }
    public function create(Faq $faq = null)
    {
        return view('admin.faq.create', compact('faq'));
    }
    public function store(Request $request)
    {
        $validated = $request->validate($this->rules);
        try {
            Faq::create($validated);
            return redirect(route('faq.index'))->with('success', 'FAQ berhasil ditambah');
        } catch (\Throwable $e) {
            return back()->with('fails', $e->getMessage());
        }
    }
    public function update(Request $request, Faq $faq)
    {
        $request->validate($this->rules);
        try {
            $faq->pertanyaan = $request->pertanyaan;
            $faq->jawaban = $request->jawaban;
            $faq->save();
            return redirect(route('faq.index'))->with('success', 'FAQ berhasil diubah');
        } catch (\Throwable $e) {
            return back()->with('fails', $e->getMessage());
        }
    }
    public function delete(Faq $faq)
    {
        try {
            $faq->delete();
            return redirect(route('faq.index'))->with('success', 'FAQ berhasil dihapus');
        } catch (\Throwable $e) {
            return back()->with('fails', $e->getMessage());
        }
    }
}
