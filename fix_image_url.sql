-- Query untuk membersihkan karakter aneh pada kolom image_url di tabel products
-- Misal menghapus karakter selain huruf, angka, titik, garis bawah, dan garis miring

UPDATE products
SET image_url = REGEXP_REPLACE(image_url, '[^a-zA-Z0-9_./-]', '')
WHERE image_url REGEXP '[^a-zA-Z0-9_./-]';

-- Query ini akan menghapus karakter aneh seperti koma, titik dua, tanda plus, dll yang tidak valid pada path gambar
