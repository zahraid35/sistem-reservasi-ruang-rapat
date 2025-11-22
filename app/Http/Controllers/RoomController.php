<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;

class RoomController extends Controller
{
    // Tampilkan semua ruangan
    public function index()
    {
        $rooms = Room::all();
        return view('dashboard', compact('rooms')); // misal di dashboard admin
    }

    // Form tambah ruangan
    public function create()
    {
        return view('rooms.create'); 
    }

    // Simpan ruangan baru
    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'kapasitas' => 'required|integer|min:1',
            'lokasi' => 'nullable|string|max:255',
            'deskripsi' => 'nullable|string',
        ]);

        // Simpan ke database
        Room::create($validated);

        return redirect()->route('admin.dashboard')->with('success', 'Ruangan berhasil ditambahkan!');
    }

    // Form edit ruangan
    public function edit(Room $room)
    {
        return view('rooms.edit', compact('room'));
    }

    // Update ruangan
    public function update(Request $request, Room $room)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'kapasitas' => 'required|integer|min:1',
            'lokasi' => 'nullable|string|max:255',
            'deskripsi' => 'nullable|string',
        ]);

        $room->update($validated);

        return redirect()->route('admin.dashboard')->with('success', 'Ruangan berhasil diperbarui!');
    }

    // Hapus ruangan
    public function destroy(Room $room)
    {
        $room->delete();
        return redirect()->route('admin.dashboard')->with('success', 'Ruangan berhasil dihapus!');
    }
}