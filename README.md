# SGA FICCT – Backend (Laravel 11 + PostgreSQL + Sanctum)

Sistema de Gestión Académica para **Sistemas de Información I (UAGRM)**.  
Incluye autenticación con **Sanctum**, gestión de **roles y usuarios (UC1–UC3)** y la **estructura académica base** (PUD1: facultades, carreras, materias, aulas, grupos).

---

## 🔧 Stack
- PHP 8.2+
- Laravel 11
- PostgreSQL 14+ (PDO PGSQL)
- Laravel Sanctum (tokens personales)
- Composer

---

## 🚀 Inicio rápido

```bash
git clone https://github.com/alecaballero17/sga_ficct_SI1.git
cd sga_ficct_SI1

composer install

# copiar variables de entorno
cp .env.example .env

# generar APP_KEY
php artisan key:generate

