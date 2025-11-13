# 📚 Sistema de Gestión de Libros (PDFs) - Admin Panel

## ✅ Lo que se ha implementado

### 1. **Sistema de Roles** 
- ✅ Tabla `roles` con roles: **admin** y **user**
- ✅ Columna `rol_id` en tabla `users`
- ✅ Auto-asignación de rol "user" al registrarse o loguearse
- ✅ Los usuarios con rol "user" pueden cambiar su propio rol
- ✅ Los admins pueden cambiar roles de otros usuarios

### 2. **Gestión de Libros (PDFs)**
- ✅ Tabla `books` para almacenar información de libros
- ✅ Almacenamiento de PDFs en `storage/app/public/books/`
- ✅ Modelo `Book.php` con relación a `Categoria`
- ✅ **CRUD completo**: Crear, Leer, Actualizar, Eliminar libros
- ✅ **Descarga de PDFs**: Los admins pueden descargar los libros subidos
- ✅ Validación: Solo archivos PDF (máx 20 MB)

### 3. **Categorías**
- ✅ Tabla `categorias` creada
- ✅ Relación entre `Book` y `Categoria`
- ✅ Los libros pueden asignarse a una categoría

### 4. **Panel de Admin**
- ✅ Dashboard con contadores (total libros, total categorías)
- ✅ Tabla de libros con opciones: Descargar, Editar, Eliminar
- ✅ Formulario para subir nuevos PDFs
- ✅ Gestión de roles de usuarios (solo admin)
- ✅ Protección con middleware `IsAdmin`

---

## 🚀 Cómo usar

### 1. **Ejecutar migraciones** (ya está hecho)
```bash
php artisan migrate
```

### 2. **Crear usuarios de ejemplo** (ya está hecho)
```bash
php artisan db:seed
```

Esto crea:
- **Admin**: `admin@ejemplo.com` / `password`
- **Usuario Normal**: `usuario@ejemplo.com` / `password`

---

## 📍 Rutas principales

### Para Usuarios Normales (rol = "user")
```
GET  /role/edit              → Cambiar su propio rol
PUT  /role/update            → Actualizar su rol
```

### Para Administradores (rol = "admin")
```
GET    /admin/books                    → Ver lista de libros
GET    /admin/books/create             → Formulario para subir PDF
POST   /admin/books                    → Guardar nuevo libro
GET    /admin/books/{id}/edit          → Editar libro
PUT    /admin/books/{id}               → Actualizar libro
DELETE /admin/books/{id}               → Eliminar libro
GET    /admin/books/{id}/download      → Descargar PDF

GET    /admin/roles/users              → Gestionar roles de usuarios
PUT    /admin/roles/users/{user}       → Cambiar rol de un usuario
```

---

## 🔐 Protecciones Implementadas

1. **Middleware `auth`**: Todas las rutas requieren autenticación
2. **Middleware `admin`**: Rutas `/admin/*` requieren rol admin
3. **Validaciones de rol**:
   - Solo usuarios "user" pueden cambiar su propio rol
   - Solo admins pueden cambiar roles de otros usuarios
   - Solo admins pueden gestionar libros

---

## 📂 Archivos Creados/Modificados

### Migraciones
- `database/migrations/2025_11_11_000010_create_roles_table.php`
- `database/migrations/2025_11_11_000011_add_rol_id_to_users.php`
- `database/migrations/2025_11_11_000012_create_categorias_table.php`
- `database/migrations/2025_11_11_000013_create_books_table.php`

### Modelos
- `app/Models/Book.php` ✨ (nuevo)
- `app/Models/Role.php` (actualizado)
- `app/Models/User.php` (ya tenía relación)

### Controladores
- `app/Http/Controllers/Admin/BookController.php` ✨ (nuevo)
- `app/Http/Controllers/RoleController.php` (actualizado)

### Listeners
- `app/Listeners/AssignDefaultRole.php` ✨ (nuevo)

### Middleware
- `app/Http/Middleware/IsAdmin.php` ✨ (nuevo)

### Vistas
- `resources/views/admin/books/index.blade.php`
- `resources/views/admin/books/create.blade.php`
- `resources/views/admin/books/edit.blade.php`
- `resources/views/admin/roles/manage-users.blade.php`
- `resources/views/role/edit-own.blade.php`

### Rutas
- `routes/web.php` (actualizado)

### Providers
- `app/Providers/AppServiceProvider.php` (actualizado)
- `bootstrap/app.php` (actualizado)

### Seeders
- `database/seeders/UserSeeder.php` ✨ (nuevo)
- `database/seeders/DatabaseSeeder.php` (actualizado)

---

## 🧪 Pruebas

### Prueba 1: Registrarse como usuario nuevo
1. Ve a `/register`
2. Crea una cuenta nueva
3. La cuenta tendrá automáticamente rol "user"

### Prueba 2: Cambiar rol propio (usuario → admin)
1. Loguéate como usuario normal
2. Ve a `/role/edit`
3. Selecciona "admin" y guarda
4. Tu rol cambió a admin

### Prueba 3: Subir un PDF (como admin)
1. Loguéate como admin
2. Ve a `/admin/books`
3. Haz clic en "+ Subir Nuevo Libro"
4. Completa el formulario y sube un PDF
5. El archivo se guarda en `storage/app/public/books/`

### Prueba 4: Admin gestiona roles de otros usuarios
1. Loguéate como admin
2. Ve a `/admin/roles/users`
3. Selecciona un rol diferente para un usuario
4. Haz clic en "Guardar"

---

## ⚙️ Configuración

### Storage Link
El proyecto ya tiene configurado el symlink de storage:
```bash
php artisan storage:link
```

Los PDFs se sirven desde: `http://localhost:8000/storage/books/nombre-del-archivo.pdf`

---

## 🔄 Flujo de Auto-Asignación de Rol

1. **Usuario se registra** → Evento `Registered` dispara
2. **Listener `AssignDefaultRole` se ejecuta** → Asigna rol "user" automáticamente
3. **Usuario se loguea** → Evento `Login` dispara
4. **Listener verifica si tiene rol** → Si no, asigna "user"

---

## 🛠️ Solución de Errores

### Error: "No tienes permisos de administrador"
→ Tu usuario no tiene rol admin. Ve a `/role/edit` si tienes rol user, o pide a un admin que te cambie el rol.

### Error: "Acceso denegado"
→ Intentas acceder a una ruta de admin sin tener ese rol.

### Archivo PDF no se descarga
→ Verifica que el archivo exista en `storage/app/public/books/`

---

## 📝 Notas Importantes

- Los PDFs se guardan en la carpeta `storage/app/public/books/`
- El máximo tamaño de PDF es **20 MB**
- Solo se aceptan archivos con extensión `.pdf`
- Al eliminar un libro, el PDF también se elimina del storage
- Todos los timestamps (created_at, updated_at) se registran automáticamente

---

## 🎯 Próximas mejoras (opcional)

- [ ] Añadir búsqueda y filtros en la tabla de libros
- [ ] Paginación en la tabla de libros
- [ ] Subida masiva de PDFs
- [ ] Previsualización de PDFs
- [ ] Sistema de permisos más granular (Gates/Policies)
- [ ] Auditoría de cambios de roles
- [ ] Notificaciones cuando un admin cambia tu rol

---

**¡Sistema listo para usar!** 🎉
