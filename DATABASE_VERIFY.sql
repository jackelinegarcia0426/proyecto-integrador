-- Script de verificación de tablas y estructura
-- Ejecuta esto en tu terminal para verificar que todo está correctamente creado

-- 1. Ver estructura de tabla 'roles'
-- DESCRIBE roles;
-- Debería mostrar: id, nombre, descripcion

-- 2. Ver estructura de tabla 'users'
-- DESCRIBE users;
-- Debería mostrar la columna 'rol_id' con FK a roles

-- 3. Ver estructura de tabla 'books'
-- DESCRIBE books;
-- Debería mostrar: id, titulo, descripcion, categoria_id, file_path, created_at, updated_at

-- 4. Ver estructura de tabla 'categorias'
-- DESCRIBE categorias;
-- Debería mostrar: id, nombre, descripcion, created_at, updated_at

-- 5. Ver contenido de roles
-- SELECT * FROM roles;
-- Debería mostrar: (1, 'admin', 'Administrador del sistema'), (2, 'user', 'Usuario normal')

-- 6. Ver usuarios creados
-- SELECT id, name, email, rol_id FROM users;
-- Debería mostrar usuarios con rol_id asignado

-- 7. Ver libros (debería estar vacío inicialmente)
-- SELECT * FROM books;

-- 8. Ver categorías (debería estar vacío inicialmente)
-- SELECT * FROM categorias;
