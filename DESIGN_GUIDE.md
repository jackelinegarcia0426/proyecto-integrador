# 🎨 Guía de Diseño - Biblioteca Digital

## Resumen de Cambios

Se ha implementado un **diseño consistente, moderno y amistoso** en toda la aplicación usando **Tailwind CSS**. Todos los formularios, botones, alertas y elementos visuales siguen un estándar único.

---

## 📦 Componentes Disponibles

### 1. **Inputs de Formulario**

#### `<x-form-input />`
Input de texto estándar con validación integrada.

```blade
<x-form-input
    name="titulo"
    label="Título del Libro"
    placeholder="Ingresa el título"
    value="{{ old('titulo') }}"
    required
/>
```

**Propiedades:**
- `name` - Nombre del campo (requerido)
- `label` - Etiqueta visible (requerido)
- `type` - Tipo de input (default: "text", también: "email", "password", etc.)
- `placeholder` - Texto de placeholder
- `value` - Valor inicial
- `required` - Si es requerido

---

### 2. **Textarea**

#### `<x-form-textarea />`
Campo de área de texto para descripciones largas.

```blade
<x-form-textarea
    name="descripcion"
    label="Descripción"
    placeholder="Escribe una descripción..."
    rows="5"
    value="{{ old('descripcion') }}"
/>
```

**Propiedades:**
- `name` - Nombre del campo
- `label` - Etiqueta
- `placeholder` - Texto de placeholder
- `rows` - Número de filas (default: 4)
- `value` - Valor inicial
- `required` - Si es requerido

---

### 3. **Select (Dropdown)**

#### `<x-form-select />`
Selector con opciones dinámicas.

```blade
<x-form-select
    name="categoria_id"
    label="Categoría"
    :options="$categorias->pluck('nombre', 'id')->toArray()"
    value="{{ old('categoria_id') }}"
    placeholder="-- Selecciona una categoría --"
/>
```

**Propiedades:**
- `name` - Nombre del campo
- `label` - Etiqueta
- `options` - Array de opciones (key => valor)
- `value` - Valor seleccionado
- `placeholder` - Opción por defecto
- `required` - Si es requerido

---

## 🎯 Alertas y Mensajes

### 1. **Alerta de Éxito**

#### `<x-alert-success />`
```blade
<x-alert-success message="¡Operación completada exitosamente!" />

<!-- O con contenido personalizado -->
<x-alert-success>
    Contenido personalizado
</x-alert-success>
```

---

### 2. **Alerta de Error**

#### `<x-alert-error />`
```blade
<x-alert-error message="Hubo un error al procesar tu solicitud" />
```

---

### 3. **Alerta de Información**

#### `<x-alert-info />`
```blade
<x-alert-info message="Esta es una información importante" />
```

---

## 🔘 Botones

### 1. **Botón Primario**

#### `<x-btn-primary />`
Botón principal con gradiente indigo-purple.

```blade
<!-- Como botón de envío -->
<x-btn-primary>
    <i class="bi bi-check-circle"></i>
    Guardar
</x-btn-primary>

<!-- Como enlace -->
<x-btn-primary href="{{ route('home') }}">
    <i class="bi bi-house"></i>
    Ir a Inicio
</x-btn-primary>
```

---

### 2. **Botón Secundario**

#### `<x-btn-secondary />`
Botón neutro en gris.

```blade
<x-btn-secondary href="{{ route('back') }}">
    <i class="bi bi-arrow-left"></i>
    Cancelar
</x-btn-secondary>
```

---

### 3. **Botón de Acción (Rojo)**

#### `<x-btn-danger />`
```blade
<x-btn-danger>
    <i class="bi bi-trash"></i>
    Eliminar
</x-btn-danger>
```

---

### 4. **Botón de Éxito (Verde)**

#### `<x-btn-success />`
```blade
<x-btn-success>
    <i class="bi bi-cloud-upload"></i>
    Subir
</x-btn-success>
```

---

## 🎨 Paleta de Colores

| Color | Uso | Clases |
|-------|-----|--------|
| **Indigo/Purple** | Elementos principales | `from-indigo-500 to-purple-600` |
| **Rojo** | Acciones peligrosas | `bg-red-600` |
| **Verde** | Acciones exitosas | `bg-green-600` |
| **Azul** | Información | `bg-blue-500` |
| **Gris** | Elementos neutros | `bg-gray-200` |
| **Ámbar** | Advertencias | `bg-amber-500` |

---

## 📐 Estructura de Formularios

### Ejemplo completo:

```blade
<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-center gap-3">
            <i class="bi bi-pencil-square text-2xl"></i>
            <div>
                <h2>Editar Libro</h2>
                <p class="text-sm opacity-75 mt-1">Actualiza la información</p>
            </div>
        </div>
    </x-slot>

    <div class="max-w-2xl mx-auto">
        <!-- Mostrar errores -->
        @if ($errors->any())
            <x-alert-error>
                <strong class="block mb-2">¡Por favor revisa los siguientes errores:</strong>
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </x-alert-error>
        @endif

        <form action="{{ route('store') }}" method="POST">
            @csrf

            <x-form-input
                name="titulo"
                label="Título"
                placeholder="Ingresa el título"
                required
            />

            <x-form-textarea
                name="descripcion"
                label="Descripción"
                placeholder="Escribe una descripción..."
            />

            <x-form-select
                name="categoria_id"
                label="Categoría"
                :options="$categorias->pluck('nombre', 'id')->toArray()"
            />

            <!-- Botones -->
            <div class="flex gap-3 pt-4 border-t border-gray-200">
                <x-btn-secondary href="{{ route('back') }}">
                    Cancelar
                </x-btn-secondary>
                <x-btn-primary>
                    Guardar
                </x-btn-primary>
            </div>
        </form>
    </div>
</x-app-layout>
```

---

## 🎯 Características del Diseño

✅ **Responsivo** - Funciona perfectamente en mobile, tablet y desktop
✅ **Accesible** - Colores con suficiente contraste
✅ **Consistente** - Mismo estilo en toda la aplicación
✅ **Amistoso** - Interfaces intuitivas y fáciles de usar
✅ **Rápido** - Sin CSS externo innecesario (Tailwind integrado)
✅ **Moderno** - Degradados, sombras y efectos hover suaves

---

## 📝 Notas Importantes

1. **Validación en tiempo real** - Los campos muestran errores automáticamente
2. **Soporte para Blade** - Todos los componentes usan Blade nativo
3. **Bootstrap Icons** - Se utilizan íconos de `bi bi-*`
4. **Tailwind CSS** - Todo está construido con utilidades de Tailwind
5. **Espaciado consistente** - Usa la escala de espaciado de Tailwind (mb-6, px-4, etc.)

---

## 🔧 Cómo Usar en Nuevas Vistas

1. Copia la estructura base de una vista existente
2. Usa los componentes disponibles
3. Mantén la estructura de layout con `<x-app-layout>`
4. Siempre incluye validación de errores

¡Tu aplicación ahora tiene un diseño consistente, profesional y amistoso! 🎉
