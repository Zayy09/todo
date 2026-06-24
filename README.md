# 📝 Todo List App

Aplikasi manajemen tugas (*To-Do List*) berbasis web yang dibangun dengan **Laravel 12** dan menggunakan **WorkOS SSO** sebagai sistem autentikasi. Proyek ini dikembangkan sebagai bagian dari pembelajaran Laravel dengan penerapan best practice seperti Form Request Validation dan sentralisasi konfigurasi.

---

## ✨ Fitur

- 🔐 **Autentikasi via WorkOS SSO** — Login aman menggunakan Single Sign-On
- ✅ **CRUD Todo** — Tambah, lihat, edit, dan hapus tugas
- 🔍 **Pencarian Todo** — Filter tugas berdasarkan kata kunci
- ✔️ **Tandai Selesai** — Ubah status todo menjadi selesai / belum selesai
- 🛡️ **Validasi Form Terpusat** — Menggunakan `TodoRequest` (Form Request Class)
- 🔒 **Route Terproteksi** — Semua route todo dilindungi middleware `auth`

---

## 🛠️ Tech Stack

| Teknologi | Versi | Keterangan |
|---|---|---|
| PHP | ^8.2 | Bahasa pemrograman utama |
| Laravel | ^12.0 | Framework PHP |
| WorkOS PHP Laravel | ^7.0 | Paket integrasi WorkOS SSO |
| Vite | - | Bundler aset frontend |
| SQLite / MySQL | - | Database |

---

## 🗂️ Struktur Route

| Method | URI | Controller | Nama Route | Auth |
|---|---|---|---|---|
| GET | `/login` | `AuthController@index` | `login` | ❌ |
| POST | `/logout` | `AuthController@logout` | `logout` | ❌ |
| GET | `/auth/workos` | `WorkOSController@redirect` | `workos.login` | ❌ |
| GET | `/auth/callback` | `WorkOSController@callback` | `workos.callback` | ❌ |
| GET | `/todo` | `TodoController@index` | `todo` | ✅ |
| POST | `/todo` | `TodoController@store` | `todo.post` | ✅ |
| PUT | `/todo/{id}` | `TodoController@update` | `todo.update` | ✅ |
| DELETE | `/todo/{id}` | `TodoController@destroy` | `todo.delete` | ✅ |

---

## ⚙️ Instalasi & Setup

### Prasyarat
- PHP >= 8.2
- Composer
- Node.js & NPM
- Akun & konfigurasi [WorkOS](https://workos.com)

### Langkah Instalasi

1. **Clone repositori**
   ```bash
   git clone <url-repositori>
   cd todo-list
   ```

2. **Install dependensi PHP**
   ```bash
   composer install
   ```

3. **Install dependensi Node.js**
   ```bash
   npm install
   ```

4. **Salin file environment**
   ```bash
   cp .env.example .env
   ```

5. **Generate application key**
   ```bash
   php artisan key:generate
   ```

6. **Konfigurasi `.env`** — Isi variabel berikut sesuai akun WorkOS Anda:
   ```env
   DB_CONNECTION=sqlite

   WORKOS_API_KEY=your_workos_api_key
   WORKOS_CLIENT_ID=your_workos_client_id
   WORKOS_REDIRECT_URL=http://localhost:8000/auth/callback
   ```

7. **Jalankan migrasi database**
   ```bash
   php artisan migrate
   ```

8. **Jalankan server pengembangan**
   ```bash
   composer run dev
   ```
   Aplikasi akan tersedia di `http://localhost:8000`.

---

## 🔍 Validasi Todo

Validasi input dikelola oleh `App\Http\Requests\TodoRequest`:

| Field | Aturan | Pesan Error |
|---|---|---|
| `task` | `required` | Task wajib diisi |
| `task` | `min:5` | Task minimal 5 karakter |
| `task` | `max:255` | Task maksimal 255 karakter |

---

## 📋 Catatan Perbaikan (Bug Fix & Refactoring)

Proyek ini telah melalui sesi bug fix dan refactoring yang didokumentasikan di [LK-11.md](./LK-11.md), mencakup:

- ✂️ **Penghapusan Dead Code** — Method `login` pada `AuthController` yang sudah tidak digunakan telah dihapus
- 🔒 **Penghapusan Route Debug** — Route `/cek-redirect` & `/cek-workos` yang berpotensi mengekspos *environment variable* telah dihapus
- ⚙️ **Migrasi `env()` ke `config()`** — Konfigurasi WorkOS dipindahkan ke `config/services.php` untuk kompatibilitas dengan *config cache* Laravel
- 🧹 **Refactoring Validasi** — Logika validasi duplikat di `store` dan `update` dikonsolidasikan ke dalam `TodoRequest`

---

## 📄 Lisensi

Proyek ini bersifat terbuka untuk keperluan pembelajaran. Dibangun di atas [Laravel Framework](https://laravel.com) yang dilisensikan di bawah [MIT License](https://opensource.org/licenses/MIT).
