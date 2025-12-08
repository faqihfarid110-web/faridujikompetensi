# Template Section Diagrams untuk README.md

Salin dan paste bagian berikut ke README.md Anda, letakkan setelah section "## Fitur Utama" (sebelum "---" yang pertama).

---

```markdown
---

## Diagrams

### ERD (Entity Relationship Diagram)

![ERD Diagram](docs/erd.png)

Diagram ini menunjukkan relasi antar tabel dalam database:
- **Users**: Tabel pengguna sistem
- **Students**: Tabel data siswa
- **Funfacts**: Tabel konten fakta sejarah
- **FunfactFeedback**: Tabel feedback/rating untuk setiap funfact (relasi 1:N dengan Funfacts)
- **Surveys**: Tabel data survey dari pengguna

### UML Class Diagram

![UML Class Diagram](docs/uml.png)

Diagram ini menunjukkan struktur class dan use case:
- **Admin**: Dapat membuat, mengupdate, dan menghapus data
- **User**: Dapat melihat funfact, memberikan feedback, dan submit survey
- **Use Cases**: Include/extend relationships antara berbagai fitur sistem

---
```

## Langkah Implementasi

### 1. Edit README.md

Buka file `README.md` dan cari bagian:
```
- **Responsive Design**: Dioptimalkan untuk semua perangkat

---

## Entity Relationship Diagram (ERD)
```

Ubah menjadi:
```
- **Responsive Design**: Dioptimalkan untuk semua perangkat

---

## Diagrams

### ERD (Entity Relationship Diagram)

![ERD Diagram](docs/erd.png)

Diagram ini menunjukkan relasi antar tabel dalam database:
- **Users**: Tabel pengguna sistem
- **Students**: Tabel data siswa
- **Funfacts**: Tabel konten fakta sejarah
- **FunfactFeedback**: Tabel feedback/rating untuk setiap funfact (relasi 1:N dengan Funfacts)
- **Surveys**: Tabel data survey dari pengguna

### UML Class Diagram

![UML Class Diagram](docs/uml.png)

Diagram ini menunjukkan struktur class dan use case:
- **Admin**: Dapat membuat, mengupdate, dan menghapus data
- **User**: Dapat melihat funfact, memberikan feedback, dan submit survey
- **Use Cases**: Include/extend relationships antara berbagai fitur sistem

---

## Entity Relationship Diagram (ERD) - Text Version
```

### 2. Simpan Gambar ke docs/

Dari attachment yang diberikan:
- Gambar pertama (diagram dengan oval = **Use Case Diagram**) → `docs/uml.png`
- Gambar kedua (diagram dengan kotak = **Class Diagram**) → `docs/erd.png`

### 3. Commit & Push

```bash
git add README.md docs/
git commit -m "Add diagrams: ERD and UML class diagram"
git push origin main
```

## Verifikasi

Setelah push, kunjungi GitHub dan pastikan:
1. Section "## Diagrams" muncul di README
2. Gambar ERD tampil dengan benar
3. Gambar UML tampil dengan benar

---

## Note Tambahan

File yang sudah disiapkan:
- ✅ `docs/` folder sudah dibuat
- ✅ `docs/README.md` - Dokumentasi tentang diagram
- ✅ `README_DIAGRAMS_NOTES.md` - Instruksi lengkap
- ✅ `ADD_DIAGRAMS.bat` - Script helper (Windows)
