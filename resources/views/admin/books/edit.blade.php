<x-app-layout>
    <x-slot name="header">
        <div class="text-center text-white bg-gradient-to-r from-indigo-500 to-purple-600 py-10 rounded-lg shadow-md">
            <h2 class="font-semibold text-3xl leading-tight">
                <i class="bi bi-pencil"></i> Editar Libro
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-10">
                <h1 class="text-2xl font-bold mb-6">Editar Libro</h1>

                @if ($errors->any())
                    <div class="alert alert-danger mb-4">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('admin.books.update', $book) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="titulo" class="form-label">Título del Libro</label>
            <input type="text" name="titulo" id="titulo" class="form-control @error('titulo') is-invalid @enderror" required value="{{ old('titulo', $book->titulo) }}">
            @error('titulo')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción</label>
            <textarea name="descripcion" id="descripcion" class="form-control @error('descripcion') is-invalid @enderror" rows="4">{{ old('descripcion', $book->descripcion) }}</textarea>
            @error('descripcion')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="categoria_id" class="form-label">Categoría</label>
            <select name="categoria_id" id="categoria_id" class="form-control @error('categoria_id') is-invalid @enderror">
                <option value="">-- Sin categoría --</option>
                @foreach($categorias as $cat)
                    <option value="{{ $cat->id }}" {{ old('categoria_id', $book->categoria_id) == $cat->id ? 'selected' : '' }}>{{ $cat->nombre }}</option>
                @endforeach
            </select>
            @error('categoria_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="file" class="form-label">Reemplazar archivo PDF (opcional)</label>
            <input type="file" name="file" id="file" class="form-control @error('file') is-invalid @enderror" accept="application/pdf">
            <small class="form-text text-muted">Máximo 20 MB. Solo archivos PDF. Dejar vacío para mantener el PDF actual.</small>
            @error('file')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <a href="{{ route('admin.books.index') }}" class="btn btn-secondary">Cancelar</a>
            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
        </div>
    </form>
</div>
@endsection
