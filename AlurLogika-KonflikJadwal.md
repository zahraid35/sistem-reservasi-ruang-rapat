**Alur Logika Pencegahan Konflik Jadwal Reservasi Ruangan**

Ketika seorang pengguna melakukan pemesanan ruang rapat, sistem akan memastikan bahwa jadwal yang dipilih tidak bentrok (conflict) dengan jadwal reservasi lain pada ruangan yang sama. Prosesnya sebagai berikut:

**User mengisi form reservasi**

Data yang dikirim ke sistem:

ID Ruangan
Tanggal pemakaian
Jam Mulai
Jam Selesai
Keperluan reservasi

Pada saat user mengajukan reservasi, reservasi controller menjalankan pengecekan jadwal yang bentrok berikut:
```php
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
```
Lalu logikanya :
```php
if ($exists) {
    return back()->with('error', 'Maaf, ruangan sudah dipesan pada waktu tersebut.');
}
```

Jika tidak ada jadwal yang bentrok, maka proses dilanjutkan:
