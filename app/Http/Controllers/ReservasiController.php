<?php
namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\User;

class ReservasiController extends Controller
{
    public function index() {
        // Ambil semua reservasi beserta user & room
        $reservasi = Reservation::with(['room', 'user'])->get();
        $user = auth()->user();
        return view('dashboard', compact('reservasi'));
    }

    public function create()
    {
        $currentHour = now()->format('H'); // jam sekarang dalam format 24 jam

    // jam kerja 08:00 - 17:00
        if ($currentHour < 8 || $currentHour >= 17) {
            // redirect ke dashboard dengan flash message
            return redirect()->route('dashboard')
                ->with('error', 'Maaf, reservasi hanya bisa dibuat pada jam kerja (08:00 - 17:00).');
        }

        $rooms = Room::all();
        return view('reservasi-create', compact('rooms'));
    }

    public function store(Request $request) {
        $data = $request->validate([
            'user_id' => 'required|exists:users,id',
            'room_id' => 'required|exists:rooms,id',
            'tanggal' => 'required|date',
            'waktu_mulai' => 'required',
            'waktu_berakhir' => 'required',
            'tujuan' => 'required|string',
        ]);

        
        $exists = Reservation::where('room_id', $data['room_id'])
            ->where('tanggal', $data['tanggal'])
            ->where(function($query) use ($data) {
                $query->whereBetween('waktu_mulai', [$data['waktu_mulai'], $data['waktu_berakhir']])
                    ->orWhereBetween('waktu_berakhir', [$data['waktu_mulai'], $data['waktu_berakhir']])
                    ->orWhere(function($q) use ($data) {
                        $q->where('waktu_mulai', '<=', $data['waktu_mulai'])
                            ->where('waktu_berakhir', '>=', $data['waktu_berakhir']);
                    });
            })->exists();

        if ($exists) {
            return back()->with('error', 'Maaf, ruangan sudah dipesan pada waktu tersebut.');
        }

        $data['status'] = 'Pending';
        Reservation::create($data);
        
        return redirect()->route('dashboard')->with('success', 'Reservasi berhasil ditambahkan!');
    }

    public function riwayat()
    {
        $userId = auth()->id(); // ambil id user yang login
        $reservasi = Reservation::with('room')
                        ->where('user_id', $userId)
                        ->orderBy('tanggal', 'desc')
                        ->get();
        return view('reservasi-riwayat', compact('reservasi'));
    }

    // batal reservasi
    public function batal($id)
    {
        $reservasi = Reservation::findOrFail($id);

        // Pastikan hanya pemilik reservasi yang bisa membatalkan
        if ($reservasi->user_id != auth()->id()) {
            return redirect()->back()->with('error', 'Aksi tidak diizinkan.');
        }

        if ($reservasi->tanggal < now()->toDateString()) {
            return redirect()->back()->with('error', 'Tidak bisa membatalkan reservasi yang sudah lewat.');
        }
        
        // Update status menjadi dibatalkan
        $reservasi->status = 'Dibatalkan';
        $reservasi->save();

        return redirect()->route('reservasi.riwayat')->with('success', 'Reservasi berhasil dibatalkan.');
    }
}