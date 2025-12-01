Project documentation data storage

This folder contains per-continent PHP files which return an array of paintings.

Files are named per-continent, e.g.:
- asia.php
- afrika.php
- eropa.php
- amerika.php
- australia.php
- antartika.php
- oseania.php

Each file returns an array of associative arrays with the following structure:
- slug: unique slug for link purposes
- title: painting title
- artist: artist
- continent: continent name as used by filter
- year: year of painting
- img: relative path to image under public/assets/images/
- desc: short description

To add or edit paintings for a continent, edit the corresponding file. The `resources/views/documentation.blade.php` view loads these files and merges them.

Important: keep arrays valid and ensure `img` paths point to existing assets in `public/assets/images/`.
