Berikut adalah detail struktur untuk setiap tabel yang di perlukan dalam Sistem Reservaasi Ruang Rapat.

1. Tabel : users
   Tabel ini untuk menyimpan data pengguna atau karyawan, bahkan admin yang akan melakukan reservasi.

    |Kolom|Tipe|
    |:---:|:---:|
    |id|BIGINT UNSIGNED|
    |name|VARCHAR(255), UNIQUE|
    |email|VARCHAR(255)|
    |password|VARCHAR(255)|
    |emai_verified_at|TIMESTAMP|
    |remember_token|VARCHAR(100)|
    |created_at|TIMESTAMP, NULLABLE|
    |update_at|TIMESTAMP, NULLABLE|

2. Tabel : reservations
    Menyimpan semua catatan reservasi ruang rapat yang di buat.
   
   |Kolom|Tipe|
   |:---:|:---:|
   |id|BIGINT UNSIGNED|
   |user_id|BIGINT UNSIGNED|
   |room_id|BIGINT UNSIGNED|
   |tanggal|DATE|
   |waktu_mulai|TIME|
   |waktu_berakhir|TIME|
   |tujuan|TEXT|
   |created_at|TIMESTAMP, NULLABLE|
   |update_at|TIMESTAMP, NULLABLE|

   reservations.user_id → users.id
   reservations.room_id → rooms.id

3. Tabel : rooma
   Menyimpan daftar detail ruang rapat yang tersedia untuk di pesan.

   |Kolom|Tipe|
   |:---:|:---:|
   |id|BIGINT UNSIGNED|
   |nama|VARCHAR(255), UNIQUE|
   |kapasitas|INT|
   |lokasi|VARCHAR(255), NULLABLE|
   |deskripsi|TEXT, NULLABLE|
   |created_at|TIMESTAMP, NULLABLE|
   |update_at|TIMESTAMP, NULLABLE|

**Hubungan Antar Tabel (Relationship)**

​**users ke reservations (One-to-Many):**
​    - Satu pengguna (User) dapat membuat banyak reservasi (Reservation).
    ​- Ditunjukkan oleh user_id di tabel reservations yang merujuk ke id di tabel users.
    
**​rooms ke reservations (One-to-Many):**
    - ​Satu ruang rapat (Room) dapat memiliki banyak reservasi (Reservation) yang terkait dengannya.
​    - Ditunjukkan oleh room_id di tabel reservations yang merujuk ke id di tabel rooms.
   
