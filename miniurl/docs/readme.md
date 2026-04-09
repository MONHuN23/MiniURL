# MiniURL - Egyszerű URL Rövidítő

Ez egy Laravel alapú webalkalmazás, amely lehetővé teszi hosszú webcímek rövidítését és egyedi azonosítók használatát.

## 🛠 Technológiai Stack
* **Framework:** Laravel 11
* **Frontend:** Tailwind CSS (Blade components)
* **Adatbázis:** MySQL
* **Nyelv:** PHP 8.2+

## 🚀 Telepítés
1. Klónozd a projektet vagy töltsd le.
2. Futtasd: `composer install`
3. Másold le a `.env.example`-t: `cp .env.example .env`
4. Generálj kulcsot: `php artisan key:generate`
5. Állítsd be az adatbázist a `.env` fájlban.
6. Migráld az adatbázist: `php artisan migrate`
7. Indítsd el: `php artisan serve`

## 📈 Tervezett Funkciók
- [x] Alapvető URL rövidítés (random generált kód)
- [x] Egyedi URL rövidítés (felhasználó által megadott kód)
- [ ] Átirányítás kezelése
- [ ] Regisztráció és bejelentkezés
- [ ] Kattintásszámláló és statisztika