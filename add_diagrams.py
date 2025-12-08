#!/usr/bin/env python3
# -*- coding: utf-8 -*-
"""
Script untuk otomatis menambahkan section Diagrams ke README.md
"""

import os

def add_diagrams_to_readme():
    """Menambahkan section Diagrams ke README.md"""
    
    readme_path = "README.md"
    
    # Cek file ada
    if not os.path.exists(readme_path):
        print("❌ File README.md tidak ditemukan!")
        return False
    
    # Baca file
    with open(readme_path, 'r', encoding='utf-8') as f:
        content = f.read()
    
    # Check apakah sudah ada section Diagrams
    if "## Diagrams" in content:
        print("⚠️  Section Diagrams sudah ada di README.md")
        return False
    
    # String yang akan ditambahkan
    diagrams_section = """---

## Diagrams

### ERD (Entity Relationship Diagram)

![ERD Diagram](docs/erd.png)

Diagram relasi database menunjukkan struktur dan relasi antar tabel:
- **Users**: Tabel pengguna sistem
- **Students**: Tabel data siswa dengan profil dan foto
- **Funfacts**: Tabel konten fakta sejarah dengan kategori dan konten
- **FunfactFeedback**: Tabel feedback dan rating untuk setiap funfact (relasi 1:N dengan Funfacts)
- **Surveys**: Tabel data survey minat topik dari pengguna

### UML Class Diagram

![UML Class Diagram](docs/uml.png)

Diagram use case dan class structure menunjukkan:
- **Admin**: Dapat membuat, update, dan delete Funfact serta Student; dapat menghapus Survey
- **User**: Dapat melihat Funfact, submit feedback, mengisi Survey, dan melihat Student
- **Use Cases**: Relasi include dan extend antar fitur sistem
- **Classes**: Authenticatable (abstract), User, Student, Funfact, FunfactFeedback, Survey dengan relasi 1:N

---

## Entity Relationship Diagram (ERD) - Text Version

"""
    
    # Ganti text lama dengan text baru
    old_text = """---

## Entity Relationship Diagram (ERD)

```"""
    
    new_text = diagrams_section + """```"""
    
    if old_text in content:
        content = content.replace(old_text, new_text, 1)
        
        # Tulis kembali file
        with open(readme_path, 'w', encoding='utf-8') as f:
            f.write(content)
        
        print("✅ Section Diagrams berhasil ditambahkan ke README.md!")
        print("\n📝 Langkah selanjutnya:")
        print("1. Simpan gambar ERD ke docs/erd.png")
        print("2. Simpan gambar UML ke docs/uml.png")
        print("3. Jalankan: git add README.md docs/")
        print("4. Jalankan: git commit -m 'Add diagrams to README'")
        print("5. Jalankan: git push")
        return True
    else:
        print("❌ Format README.md tidak sesuai, tidak bisa otomatis edit")
        print("   Silakan edit manual sesuai template yang diberikan")
        return False

if __name__ == "__main__":
    success = add_diagrams_to_readme()
    exit(0 if success else 1)
