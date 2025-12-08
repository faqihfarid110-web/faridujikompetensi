# Faridji Kompetensi - Sejarah Indonesia Platform

Platform interaktif untuk pembelajaran sejarah Indonesia dengan fitur fun facts, koleksi gambar, survey, dan student gallery.

## Daftar Isi
- [Fitur Utama](#fitur-utama)
- [Diagrams](#diagrams)
- [Entity Relationship Diagram (ERD)](#entity-relationship-diagram-erd)
- [UML Class Diagram](#uml-class-diagram)
- [Instalasi](#instalasi)

## Fitur Utama

- **Funfact Sejarah**: Koleksi fakta menarik sejarah dengan kategori (politik, kultur, militer, ekonomi, kuno, olahraga, sains, urban)
- **Rating & Komentar**: Sistem feedback untuk setiap funfact
- **Survey**: Pengumpulan data minat topik dari pengguna
- **Student Gallery**: Galeri siswa dengan foto dan informasi
- **Responsive Design**: Dioptimalkan untuk semua perangkat

---

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

```
┌─────────────────────────────┐
│         USERS               │
├─────────────────────────────┤
│ id (PK)                     │
│ name                        │
│ email (UNIQUE)              │
│ email_verified_at           │
│ password                    │
│ remember_token              │
│ created_at                  │
│ updated_at                  │
└─────────────────────────────┘

┌─────────────────────────────┐
│       STUDENTS              │
├─────────────────────────────┤
│ id (PK)                     │
│ name                        │
│ class_year                  │
│ major_interest              │
│ bio                         │
│ photo                       │
│ created_at                  │
│ updated_at                  │
└─────────────────────────────┘

┌─────────────────────────────┐
│      FUNFACTS               │
├─────────────────────────────┤
│ id (PK)                     │
│ slug (UNIQUE)               │
│ title                       │
│ category                    │
│ summary                     │
│ img                         │
│ source                      │
│ author                      │
│ date                        │
│ content                     │
│ created_at                  │
│ updated_at                  │
└─────────────────────────────┘
       │
       │ 1:N
       │
       ▼
┌─────────────────────────────┐
│   FUNFACT_FEEDBACK          │
├─────────────────────────────┤
│ id (PK)                     │
│ slug (FK)                   │
│ name                        │
│ comment                     │
│ rating (0-5)                │
│ created_at                  │
│ updated_at                  │
└─────────────────────────────┘

┌─────────────────────────────┐
│       SURVEYS               │
├─────────────────────────────┤
│ id (PK)                     │
│ name                        │
│ email                       │
│ topic_interest              │
│ reason                      │
│ expected_impact             │
│ comments                    │
│ created_at                  │
│ updated_at                  │
└─────────────────────────────┘
```

### Relasi Database

| Tabel Sumber | Tabel Tujuan | Tipe Relasi | Keterangan |
|---|---|---|---|
| FUNFACTS | FUNFACT_FEEDBACK | 1:N | Satu funfact bisa memiliki banyak feedback |
| FUNFACT_FEEDBACK | FUNFACTS | N:1 | Banyak feedback merujuk ke satu funfact |

---

## UML Class Diagram

```
┌─────────────────────────────────────────┐
│              <<abstract>>               │
│          Authenticatable                │
├─────────────────────────────────────────┤
│ #password: string                       │
│ #remember_token: string                 │
├─────────────────────────────────────────┤
│ +getAuthPassword()                      │
│ +getRememberToken()                     │
└─────────────────────────────────────────┘
           △
           │ extends
           │
┌─────────────────────────────────────────┐
│              User                       │
├─────────────────────────────────────────┤
│ -id: int <<PK>>                         │
│ -name: string                           │
│ -email: string <<UNIQUE>>               │
│ -email_verified_at: datetime            │
│ -password: string                       │
│ -remember_token: string                 │
│ -created_at: datetime                   │
│ -updated_at: datetime                   │
├─────────────────────────────────────────┤
│ +create()                               │
│ +update()                               │
│ +delete()                               │
└─────────────────────────────────────────┘

┌─────────────────────────────────────────┐
│              Student                    │
├─────────────────────────────────────────┤
│ -id: int <<PK>>                         │
│ -name: string                           │
│ -class_year: string                     │
│ -major_interest: string                 │
│ -bio: text                              │
│ -photo: string                          │
│ -created_at: datetime                   │
│ -updated_at: datetime                   │
├─────────────────────────────────────────┤
│ +create()                               │
│ +read()                                 │
│ +update()                               │
│ +delete()                               │
└─────────────────────────────────────────┘

┌─────────────────────────────────────────┐
│              Funfact                    │
├─────────────────────────────────────────┤
│ -id: int <<PK>>                         │
│ -slug: string <<UNIQUE>>                │
│ -title: string                          │
│ -category: string                       │
│ -summary: string                        │
│ -img: string                            │
│ -source: string                         │
│ -author: string                         │
│ -date: string                           │
│ -content: text                          │
│ -created_at: datetime                   │
│ -updated_at: datetime                   │
├─────────────────────────────────────────┤
│ +create()                               │
│ +readBySlug()                           │
│ +readByCategory()                       │
│ +update()                               │
│ +delete()                               │
│ +getFeedbacks(): FunfactFeedback[]      │
└─────────────────────────────────────────┘
           │
           │ 1:N
           │
           ▼
┌─────────────────────────────────────────┐
│        FunfactFeedback                  │
├─────────────────────────────────────────┤
│ -id: int <<PK>>                         │
│ -slug: string <<FK>>                    │
│ -name: string                           │
│ -comment: text                          │
│ -rating: int (0-5)                      │
│ -created_at: datetime                   │
│ -updated_at: datetime                   │
├─────────────────────────────────────────┤
│ +create()                               │
│ +read()                                 │
│ +update()                               │
│ +delete()                               │
│ +getFunfact(): Funfact                  │
└─────────────────────────────────────────┘

┌─────────────────────────────────────────┐
│              Survey                     │
├─────────────────────────────────────────┤
│ -id: int <<PK>>                         │
│ -name: string                           │
│ -email: string                          │
│ -topic_interest: string                 │
│ -reason: text                           │
│ -expected_impact: text                  │
│ -comments: text                         │
│ -created_at: datetime                   │
│ -updated_at: datetime                   │
├─────────────────────────────────────────┤
│ +create()                               │
│ +read()                                 │
│ +update()                               │
│ +delete()                               │
└─────────────────────────────────────────┘
```

### Deskripsi Class

#### User
- **Deskripsi**: Model pengguna sistem yang mengimplementasikan Authenticatable
- **Attribut Utama**: name, email, password
- **Operasi**: Create, Read, Update, Delete

#### Student
- **Deskripsi**: Model data siswa dengan profil dan portfolio
- **Attribut Utama**: name, class_year, major_interest, bio, photo
- **Operasi**: CRUD lengkap

#### Funfact
- **Deskripsi**: Model konten fakta sejarah yang dapat dikategorikan
- **Attribut Utama**: slug, title, category, content, img, source
- **Operasi**: CRUD, query berdasarkan kategori dan slug
- **Relasi**: One-to-Many dengan FunfactFeedback

#### FunfactFeedback
- **Deskripsi**: Model feedback/komentar untuk setiap funfact
- **Attribut Utama**: slug, name, comment, rating
- **Operasi**: CRUD
- **Relasi**: Many-to-One dengan Funfact

#### Survey
- **Deskripsi**: Model data survey minat topik dari pengguna
- **Attribut Utama**: name, email, topic_interest, reason, expected_impact, comments
- **Operasi**: CRUD

---

## Struktur Direktori

```
farrr/
├── app/
│   ├── Http/
│   │   └── Controllers/
│   │       ├── AdminSurveyController.php
│   │       ├── FunfactController.php
│   │       └── StudentController.php
│   ├── Models/
│   │   ├── User.php
│   │   ├── Student.php
│   │   ├── Funfact.php
│   │   ├── FunfactFeedback.php
│   │   └── Survey.php
│   └── Providers/
│       └── AppServiceProvider.php
├── database/
│   ├── migrations/
│   │   ├── 0001_01_01_000000_create_users_table.php
│   │   ├── 2025_11_29_000001_create_students_table.php
│   │   ├── 2025_11_29_000001_create_funfact_feedback_table.php
│   │   ├── 2025_11_29_000002_create_funfacts_table.php
│   │   └── 2025_11_29_000002_create_surveys_table.php
│   ├── factories/
│   │   └── UserFactory.php
│   └── seeders/
│       └── DatabaseSeeder.php
├── resources/
│   ├── css/
│   │   └── app.css
│   ├── js/
│   │   ├── app.js
│   │   └── bootstrap.js
│   └── views/
│       ├── layouts/
│       │   └── app.blade.php
│       ├── funfact.blade.php
│       ├── funfact/
│       ├── dashboard.blade.php
│       ├── survey/
│       └── ...
├── routes/
│   ├── web.php
│   └── console.php
├── public/
│   ├── index.php
│   ├── assets/
│   │   └── images/
│   └── build/
├── config/
│   ├── app.php
│   ├── auth.php
│   ├── database.php
│   └── ...
├── .env
├── .env.example
├── composer.json
├── package.json
├── tailwind.config.js
├── vite.config.js
└── phpunit.xml
```

---

## API Endpoints

### Funfact
- `GET /funfact` - Daftar semua funfacts
- `GET /funfact/{slug}` - Detail funfact
- `GET /funfact/category/{category}` - Funfacts berdasarkan kategori
- `POST /funfact/{slug}/feedback` - Tambah feedback/rating

### Student
- `GET /students` - Daftar semua siswa
- `GET /students/{id}` - Detail siswa

### Survey
- `POST /survey` - Submit survey

---

## Instalasi

### Prasyarat
- PHP 8.1+
- Composer
- MySQL 5.7+
- Node.js & npm

### Langkah Instalasi

1. **Clone Repository**
   ```bash
   git clone https://github.com/faqihfarid110-web/faridujikompetensi.git
   cd faridujikompetensi
   ```

2. **Install Dependencies**
   ```bash
   composer install
   npm install
   ```

3. **Setup Environment**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Database Configuration**
   - Update `.env` dengan kredensial database MySQL Anda
   - Jalankan migrasi:
     ```bash
     php artisan migrate
     php artisan db:seed
     ```

5. **Build Assets**
   ```bash
   npm run build
   ```

6. **Start Server**
   ```bash
   php artisan serve
   ```

   Aplikasi akan berjalan di `http://localhost:8000`

---

## Kontribusi

Silakan buat pull request untuk kontribusi. Pastikan kode mengikuti standar Laravel dan telah diuji.

## Lisensi

Project ini menggunakan lisensi MIT.
