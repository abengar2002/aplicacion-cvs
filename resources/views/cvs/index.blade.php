<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Currículums</title>
    <style>
        body { 
            font-family: sans-serif; 
            margin: 0; 
            background-color: #f4f7f6;
            color: #333;
        }
        .container { 
            max-width: 1200px; 
            margin: auto;
            padding: 20px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 2px solid #e0e0e0;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        .btn-create {
            background-color: #007bff;
            color: white;
            padding: 10px 15px;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            transition: background-color 0.2s;
        }
        .btn-create:hover {
            background-color: #0056b3;
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
            border: 1px solid #c3e6cb;
        }
        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
            border: 1px solid #f5c6cb;
        }

        .cv-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
        }
        
        .card {
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            overflow: hidden;
            display: flex;
            flex-direction: column;
            transition: transform 0.2s, box-shadow 0.2s;
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 12px rgba(0,0,0,0.15);
        }
        
        .card-img {
            width: 100%;
            height: 300px; 
            object-fit: contain; 
            border-bottom: 1px solid #eee;
            background-color: #f0f0f0; 
        }
        
        .card-content {
            padding: 15px;
            flex-grow: 1;
        }
        .card-content h3 {
            margin-top: 0;
            margin-bottom: 10px;
            font-size: 1.4rem;
        }
        .card-content h3 a {
            text-decoration: none;
            color: #333;
        }
        .card-content h3 a:hover {
            color: #007bff;
        }
        .card-content p {
            margin: 0 0 10px 0;
            color: #555;
            font-size: 0.95rem;
        }
        .card-content .nota {
            font-weight: bold;
            color: #007bff;
        }

        .card-actions {
            padding: 10px 15px;
            border-top: 1px solid #eee;
            background-color: #f9f9f9;
            text-align: right;
        }

        .empty-state {
            grid-column: 1 / -1;
            text-align: center;
            padding: 50px;
            color: #777;
        }
        
        .btn-edit, .btn-delete {
            padding: 5px 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 0.9em;
            text-decoration: none;
        }
        .btn-edit {
            background-color: #ffc107;
            color: #212529;
            margin-right: 5px;
        }
        .btn-edit:hover { background-color: #e0a800; }
        .btn-delete {
            background-color: #dc3545;
            color: white;
        }
        .btn-delete:hover { background-color: #c82333; }
        
    </style>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>

    <div class="container">

        <div class="header">
            <h1>Listado de Currículums</h1>
            <a href="{{ route('cvs.create') }}" class="btn-create">Añadir Nuevo CV</a>
        </div>

        @if(session('success') || session('general'))
            <div class="alert-success">
                {{ session('success') }}
                {{ session('general') }}
            </div>
        @endif
        @error('general')
        <div class="alert-danger" role="alert">
          {{ $message }}
        </div>
        @enderror

        <div class="cv-grid">
            
            @forelse ($alumnos as $alumno)
                
                <div class="card">
                    
                    <a href="{{ route('cvs.show', $alumno->id) }}">
                        <img src="{{ asset('storage/' . $alumno->fotografia) }}" alt="Foto de {{ $alumno->nombre }}" class="card-img">
                    </a>
                    <div class="card-content">
                        <h3>
                            <a href="{{ route('cvs.show', $alumno->id) }}">
                                {{ $alumno->nombre }} {{ $alumno->apellidos }}
                            </a>
                        </h3>
                        <p>
                            <strong>Edad:</strong> {{ $alumno->edad }} años
                        </p>
                        <p>
                            <strong>Correo:</strong> {{ $alumno->correo }}
                        </p>
                        <p>
                            <strong>Nota Media:</strong> <span class="nota">{{ $alumno->nota_media }}</span>
                        </p>
                    </div>

                    <div class="card-actions">
                        <a href="{{ route('cvs.edit', $alumno->id) }}" class="btn-edit">Editar</a>
                        <form 
                            action="{{ route('cvs.destroy', $alumno->id) }}" 
                            method="POST" 
                            class="form-borrar" 
                            style="display: inline;">
                            
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-delete">Borrar</button>
                        </form>
                    </div>
                </div>
                @empty
                <div class="empty-state">
                    <h2>No hay currículums guardados todavía.</h2>
                    <p>Haz clic en "Añadir Nuevo CV" para crear el primero.</p>
                </div>
            @endforelse

        </div>
    </div>
    <script>
        //Buscamos todos los formularios que tengan la clase 'form-borrar'
        const formsBorrar = document.querySelectorAll('.form-borrar');

        //Recorremos cada formulario
        formsBorrar.forEach(form => {
            
            //Escuchamos el evento 'submit' (cuando se pulsa "Borrar")
            form.addEventListener('submit', function (e) {
                
                //Prevenimos que el formulario se envíe automáticamente
                e.preventDefault();

                //Mostramos el pop-up bonito de SweetAlert
                Swal.fire({
                    title: '¿Estás seguro?',
                    text: "¡No podrás revertir esto!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6', 
                    cancelButtonColor: '#d33',
                    confirmButtonText: '¡Sí, bórralo!',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    //Si quiere borrarlo
                    if (result.isConfirmed) {
                        //Se borra
                        this.submit();
                    }
                })
            });
        });
    </script>
</body>
</html>