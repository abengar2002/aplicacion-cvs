<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle de {{ $alumno->nombre }}</title>
    
    <style>
        body {
            font-family: sans-serif;
            background-color: #f4f7f6;
            color: #333;
            margin: 0;
            padding: 20px;
        }

        .profile-card {
            max-width: 900px;
            margin: 20px auto;
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0 6px 18px rgba(0,0,0,0.08);
            overflow: hidden;
        }
        
        .profile-header {
            padding: 30px;
            text-align: center;
            border-bottom: 1px solid #eee;
            background-color: #fdfdfd;
        }
        .profile-photo {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: contain;
            background-color: #f0f5ff;
            border: 4px solid #fff;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            margin-bottom: 15px;
        }
        .profile-header h1 {
            margin: 0;
            font-size: 2.2rem;
            color: #222;
        }

        .profile-content {
            display: grid;
            grid-template-columns: 1fr 2fr;
            gap: 30px;
            padding: 30px;
        }
        
        .profile-sidebar {
            
        }
        .profile-sidebar h3, .profile-main h3 {
            margin-top: 0;
            margin-bottom: 15px;
            font-size: 1.3rem;
            color: #007bff;
            border-bottom: 2px solid #007bff;
            padding-bottom: 5px;
            display: inline-block; 
        }
        
        .data-list {
            list-style: none;
            padding: 0;
            margin: 0;
            background-color: #fdfdfd;
            border-radius: 8px;
            padding: 15px 20px;
            border: 1px solid #eee;
        }
        .data-list li {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px 0;
            border-bottom: 1px solid #ebebeb;
            font-size: 1.05rem;
        }
        .data-list li:last-child {
            border-bottom: none;
        }
        .data-list strong {
            color: #333;
            font-weight: 600;
        }
        .data-list span {
            color: #555;
        }
        .data-list .nota {
            font-size: 1.15rem;
            font-weight: bold;
            color: #007bff;
            background-color: #e6f0ff;
            padding: 4px 10px;
            border-radius: 6px;
        }

        .profile-main {
            
        }
        .long-text-card {
            margin-bottom: 25px;
        }
        .long-text {
            line-height: 1.7;
            color: #444;
            background: #fdfdfd;
            padding: 20px;
            border-radius: 8px;
            border: 1px solid #f0f0f0;
            box-shadow: inset 0 1px 3px rgba(0,0,0,0.03);
            word-wrap: break-word; 
            overflow-wrap: break-word;
        }
        .text-muted {
            color: #888;
            font-style: italic;
        }
        
        .profile-actions {
            background: #f9f9f9;
            padding: 20px;
            border-top: 1px solid #eee;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 15px;
            flex-wrap: wrap;
        }
        .btn {
            padding: 10px 20px;
            font-size: 1rem;
            font-weight: bold;
            text-decoration: none;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: all 0.2s;
            display: inline-block;
        }
        .btn-secondary { background-color: #6c757d; color: white; }
        .btn-secondary:hover { background-color: #5a6268; transform: translateY(-2px); }
        
        .btn-warning { background-color: #ffc107; color: #333; }
        .btn-warning:hover { background-color: #e0a800; transform: translateY(-2px); }
        
        .btn-danger { background-color: #dc3545; color: white; }
        .btn-danger:hover { background-color: #c82333; transform: translateY(-2px); }
        
        .form-borrar {
            display: inline;
            margin: 0;
        }

    </style>
</head>
<body>

    <div class="profile-card">
        
        <div class="profile-header">
            <img src="{{ asset('storage/' . $alumno->fotografia) }}" alt="Foto de {{ $alumno->nombre }}" class="profile-photo">
            <h1>{{ $alumno->nombre }} {{ $alumno->apellidos }}</h1>
        </div>

        <div class="profile-content">
            
            <div class="profile-sidebar">
                <h3>Datos Personales</h3>
                <ul class="data-list">
                    <li>
                        <strong>Correo:</strong>
                        <span>{{ $alumno->correo }}</span>
                    </li>
                    <li>
                        <strong>Teléfono:</strong>
                        <span>{{ $alumno->telefono ?? 'No especificado' }}</span>
                    </li>
                    <li>
                        <strong>F. Nacimiento:</strong>
                        <span>{{ date('d/m/Y', strtotime($alumno->fecha_nacimiento)) }}</span>
                    </li>
                    <li>
                        <strong>Edad:</strong>
                        <span>{{ $alumno->edad }} años</span>
                    </li>
                    <li>
                        <strong>Nota Media:</strong>
                        <span class="nota">{{ $alumno->nota_media }}</span>
                    </li>
                </ul>
            </div>
            
            <div class="profile-main">
                <div class="long-text-card">
                    <h3>Formación</h3>
                    <p class="long-text">
                        @if($alumno->formacion)
                            {!! nl2br(e($alumno->formacion)) !!}
                        @else
                            <span class="text-muted">No hay datos de formación.</span>
                        @endif
                    </p>
                </div>

                <div class="long-text-card">
                    <h3>Experiencia</h3>
                    <p class="long-text">
                        @if($alumno->experiencia)
                            {!! nl2br(e($alumno->experiencia)) !!}
                        @else
                            <span class="text-muted">No hay datos de experiencia.</span>
                        @endif
                    </p>
                </div>

                <div class="long-text-card">
                    <h3>Habilidades</h3>
                    <p class="long-text">
                        @if($alumno->habilidades)
                            {!! nl2br(e($alumno->habilidades)) !!}
                        @else
                            <span class="text-muted">No hay datos de habilidades.</span>
                        @endif
                    </p>
                </div>
            </div>
            
        </div>
        
        <div class="profile-actions">
            <a href="{{ route('cvs.index') }}" class="btn btn-secondary">Volver al Listado</a>
            <a href="{{ route('cvs.edit', $alumno->id) }}" class="btn btn-warning">Editar</a>
            
            <form action="{{ route('cvs.destroy', $alumno->id) }}" 
                  method="POST" 
                  class="form-borrar"
                  onsubmit="return confirm('¿Estás seguro de que quieres borrar este CV? Es permanente.');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Borrar Currículum</button>
            </form>
        </div>
        
    </div>

</body>
</html>