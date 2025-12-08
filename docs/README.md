# Dokumentasi Project - Diagrams

Folder ini berisi diagram-diagram project yang direferensikan di README.md utama.

## File yang Diperlukan

Simpan kedua file gambar berikut di folder `docs/`:

1. **erd.png** - Entity Relationship Diagram (ERD)
   - Gambar diagram relasi database project
   - Simpan dengan nama `erd.png`

2. **uml.png** - UML Class Diagram
   - Gambar diagram class dan relasi antar class
   - Simpan dengan nama `uml.png`

## Cara Menggunakan

1. Pindahkan kedua file gambar ke folder `docs/`:
   ```bash
   cp /path/to/erd.png docs/erd.png
   cp /path/to/uml.png docs/uml.png
   ```

2. Commit dan push ke GitHub:
   ```bash
   git add docs/
   git commit -m "Add ERD and UML diagrams"
   git push
   ```

3. Gambar akan otomatis muncul di README.md di GitHub dengan link `docs/erd.png` dan `docs/uml.png`

## Struktur Referensi README.md

Di README.md, gambar direferensikan dengan format:
- ERD: `![ERD Diagram](docs/erd.png)`
- UML: `![UML Class Diagram](docs/uml.png)`

Pastikan kedua file ada di folder `docs/` agar gambar tampil dengan benar di GitHub.
