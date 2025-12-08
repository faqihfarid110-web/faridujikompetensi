@echo off
REM Script untuk menambahkan diagram ke README.md
REM Pastikan file erd.png dan uml.png sudah ada di folder docs/

echo.
echo ============================================
echo INSTRUKSI MENAMBAHKAN DIAGRAM KE README.md
echo ============================================
echo.
echo Status:
echo - Folder docs/ sudah dibuat: ✓
echo - README.md sudah diupdate daftar isi: ✓
echo.
echo Langkah yang perlu dilakukan:
echo.
echo 1. SIMPAN GAMBAR KE FOLDER docs/
echo    - Gambar Use Case Diagram → docs/uml.png
echo    - Gambar Class Diagram → docs/erd.png
echo.
echo 2. MANUAL EDIT README.md
echo    Tambahkan section berikut setelah "## Fitur Utama":
echo.
echo    ---
echo.
echo    ## Diagrams
echo.
echo    ### ERD (Entity Relationship Diagram)
echo.
echo    ![ERD Diagram](docs/erd.png)
echo.
echo    ### UML Class Diagram
echo.
echo    ![UML Class Diagram](docs/uml.png)
echo.
echo    ---
echo.
echo 3. COMMIT DAN PUSH
echo    git add README.md docs/
echo    git commit -m "Add ERD and UML diagrams"
echo    git push
echo.
echo ============================================
echo.
pause
