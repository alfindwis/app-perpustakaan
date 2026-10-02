<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Http\Requests\StoreMemberRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class MemberController extends Controller
{
    /**
     * Tampilkan daftar anggota dengan pagination.
     */
    public function index()
    {
        $members = Member::paginate(10);

        return view('members.index', compact('members'));
    }    

    /**
     * Tampilkan form untuk menambah anggota baru.
     */
    public function create()
    {
        return view('members.create');
    }

    /**
     * Simpan data anggota baru ke database.
     */
    public function store(StoreMemberRequest $request)
    {
        $validated = $request->validated();

        Member::create($validated);

        return redirect()->route('members.index')
            ->with('success', "Anggota \"{$validated['nama']}\" berhasil ditambahkan.");
    }

    /**
     * Tampilkan detail data anggota.
     */
    public function show($id)
    {

        $member = Member::with(['loans.loanItems.book', 'loans.user'])->findOrFail($id);
        return view('members.show', compact('member'));

    }

    /**
     * Tampilkan form untuk mengedit data anggota.
     */
    public function edit($id)
    {
        $member = Member::findOrFail($id);
        return view('members.edit', compact('member'));
    }

    /**
     * Perbarui data anggota di database.
     */
    public function update(Request $request, $id)
    {
        $member = Member::findOrFail($id);

        $validated = $request->validate([
            'nama'          => 'required|string|max:255',
            'nim'           => ['required', 'string', 'max:50', Rule::unique('members')->ignore($member->id)],
            'email'         => ['required', 'email', 'max:255', Rule::unique('members')->ignore($member->id)],
            'nomor_telepon' => 'required|string|max:20',
            'alamat'        => 'required|string',
            'status'        => 'required|in:aktif,nonaktif',
        ]);

        $member->update($validated);

        return redirect()->route('members.index')
            ->with('success', 'Data anggota berhasil diperbarui.');
    }

    /**
     * Hapus data anggota dari database.
     */
    public function destroy($id)
    {
        $member = Member::findOrFail($id);
        $member->delete();

        return redirect()->route('members.index')
            ->with('success', 'Anggota berhasil dihapus.');
    }
}
