# DawBank 🏦

Aplicación bancaria sencilla desarrollada con **Laravel** para practicar arquitectura backend,
Programación Orientada a Objetos y buenas prácticas profesionales.

## 🎯 Objetivo del proyecto
Este proyecto nace como una adaptación a entorno web (Laravel) de un ejercicio clásico de POO,
con el objetivo de reforzar conceptos como:

- Separación de responsabilidades
- Lógica de dominio vs lógica de aplicación
- Uso de modelos, servicios y controladores
- Persistencia de datos
- Buenas prácticas de control de versiones

## 🧱 Funcionalidades
- Creación de cuentas bancarias
- Generación automática de IBAN
- Ingresos y retiradas con validaciones
- Control de saldo negativo (límite configurable)
- Registro de movimientos
- Avisos por operaciones superiores a un importe determinado
- Historial de movimientos

## 🛠️ Tecnologías
- PHP 8+
- Laravel
- MySQL (XAMPP)
- Composer
- Git / GitHub

## 🗂️ Arquitectura (en progreso)
- Models → Dominio (Cuenta, Movimiento)
- Controllers → Casos de uso
- Services → Lógica de negocio
- Requests → Validaciones
- Migrations → Persistencia

## 🚧 Estado del proyecto
En desarrollo 🚧  
Proyecto orientado a aprendizaje y mejora progresiva.

## ▶️ Instalación
```bash
git clone https://github.com/tu-usuario/dawbank.git
cd dawbank
composer install
cp .env.example .env
php artisan key:generate
