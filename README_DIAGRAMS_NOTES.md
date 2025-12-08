# Instruksi Menambahkan Diagram ke README.md

## Status Saat Ini

✅ Folder `docs/` sudah dibuat
✅ README.md sudah diupdate (bagian "Daftar Isi" ditambahkan link ke "Diagrams")

## Yang Perlu Dilakukan

### 1. Update README.md - Tambahkan Section Diagrams

Edit file `README.md` dan tambahkan section berikut setelah "## Fitur Utama" (sebelum "---"):

```markdown
---

## Diagrams

### ERD (Entity Relationship Diagram)

![ERD Diagram](docs/erd.png)

**Cara menampilkan diagram di GitHub:**
1. Buat folder `docs/` di root project jika belum ada ✅ (sudah ada)
2. Simpan gambar ERD dengan nama `erd.png` di folder `docs/`
3. Commit dan push ke repository

### UML Class Diagram

![UML Class Diagram](docs/uml.png)

**Cara menampilkan diagram di GitHub:**
1. Buat folder `docs/` di root project jika belum ada ✅ (sudah ada)
2. Simpan gambar UML dengan nama `uml.png` di folder `docs/`
3. Commit dan push ke repository

---
```

### 2. Simpan Gambar ke Folder `docs/`

Letakkan kedua file gambar dari attachment ke folder `docs/`:
- File pertama (Use Case Diagram dengan Admin & User) → `docs/uml.png` 
- File kedua (Class Diagram dengan Authenticatable, User, Student, Funfact, dll) → `docs/erd.png`

Atau menggunakan terminal:
```bash
# Jika Anda punya file gambar di tempat lain
cp /path/to/first-diagram.png docs/uml.png
cp /path/to/second-diagram.png docs/erd.png
```

### 3. Commit dan Push

```bash
git add README.md docs/
git commit -m "Add ERD and UML diagrams to documentation"
git push origin main
```

### 4. Verifikasi di GitHub

Setelah push, buka repository di GitHub dan cek apakah:
- Gambar ERD muncul di section "Diagrams → ERD"
- Gambar UML muncul di section "Diagrams → UML Class Diagram"

## Penjelasan Gambar

**Gambar 1 (Use Case Diagram)**: 
- Menunjukkan interaksi antara Admin dan User dengan sistem
- Use case meliputi: Create/Update/View Funfact, Student, Survey
- Relasi include/extend antar use case

**Gambar 2 (Class Diagram)**:
- Menunjukkan struktur class dan relasi
- Class: Authenticatable (abstract), User, Student, Funfact, FunfactFeedback, Survey
- Relasi 1:N antara Funfact dan FunfactFeedback

## Troubleshooting

Jika gambar tidak muncul di GitHub:
1. Pastikan path di markdown benar: `docs/erd.png` (case-sensitive di Linux)
2. Pastikan file sudah di-commit dan push
3. Refresh halaman GitHub atau clear cache browser
4. Verifikasi file ada di folder dengan perintah: `ls -la docs/`
