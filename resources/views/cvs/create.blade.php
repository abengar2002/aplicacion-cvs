<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Añadir Nuevo Currículum</title>
    
    <style>
        body {
            font-family: sans-serif;
            background-color: #f4f7f6;
            color: #333;
            margin: 0;
            padding: 20px;
        }

        .form-container {
            max-width: 800px;
            margin: 20px auto;
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0 6px 18px rgba(0,0,0,0.08);
            overflow: hidden;
        }

        .form-header {
            padding: 25px 30px;
            border-bottom: 1px solid #eee;
            background-color: #fdfdfd;
        }
        .form-header h1 {
            margin: 0;
            font-size: 1.8rem;
            color: #222;
        }
        
        .form-body {
            padding: 30px;
        }

        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            border: 1px solid #f5c6cb;
        }

        .form-section {
            margin-bottom: 25px;
        }
        .form-section h3 {
            margin-top: 0;
            margin-bottom: 20px;
            font-size: 1.3rem;
            color: #007bff;
            border-bottom: 2px solid #007bff;
            padding-bottom: 5px;
            display: inline-block;
        }

        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #555;
        }
        .form-control {
            width: 100%;
            padding: 12px 15px;
            font-size: 1rem;
            border: 1px solid #ddd;
            border-radius: 6px;
            box-sizing: border-box;
            transition: border-color 0.2s, box-shadow 0.2s;
        }
        .form-control:focus {
            outline: none;
            border-color: #007bff;
            box-shadow: 0 0 5px rgba(0,123,255,0.2);
        }
        textarea.form-control {
            min-height: 120px;
            line-height: 1.6;
        }
        
        .drop-zone-input {
            display: none;
        }
        
        .drop-zone {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            width: 100%;
            min-height: 150px; 
            padding: 25px;
            border: 2px dashed #ddd;
            border-radius: 8px;
            background-color: #f9f9f9;
            color: #888;
            font-size: 1.1rem;
            text-align: center;
            cursor: pointer;
            transition: background-color 0.2s, border-color 0.2s;
            box-sizing: border-box;
        }
      
        .drop-zone:hover {
            background-color: #f0f5ff;
            border-color: #007bff;
        }
        
        .drop-zone--active {
            background-color: #e6f0ff;
            border-color: #007bff;
            border-style: solid;
        }

        .photo-preview {
            width: 150px;
            height: 150px;
            border-radius: 8px;
            object-fit: contain;
            background-color: #fff;
            border: 1px solid #ddd;
            margin-top: 15px;
            display: none; 
        }

        .form-actions {
            background: #f9f9f9;
            padding: 20px 30px;
            border-top: 1px solid #eee;
            display: flex;
            justify-content: flex-end;
            align-items: center;
            gap: 15px;
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
        }
        .btn-primary { 
            background-color: #28a745;
            color: white; 
            order: 2; 
        }
        .btn-primary:hover { background-color: #218838; }
        
        .btn-secondary { 
            background-color: #6c757d; 
            color: white; 
            order: 1; 
        }
        .btn-secondary:hover { background-color: #5a6268; }

    </style>
</head>
<body>

    <div class="form-container">
        
        <div class="form-header">
            <h1>Añadir Nuevo Currículum</h1>
        </div>

        @error('general')
        <div class="alert-danger" role="alert" style="margin: 20px 30px 0;">
          {{ $message }}
        </div>
        @enderror

        <form class="form-body" action="{{ route('cvs.store') }}" method="post" enctype="multipart/form-data">
            @csrf

            <div class="form-section">
                <h3>Datos Personales</h3>
                
                <div class="form-group">
                    <label for="nombre">Nombre:</label>
                    <input class="form-control" required id="nombre" type="text" name="nombre" value="{{ old('nombre') }}"/>
                </div>

                <div class="form-group">
                    <label for="apellidos">Apellidos:</label>
                    <input class="form-control" required id="apellidos" type="text" name="apellidos" value="{{ old('apellidos') }}"/>
                </div>
                
                <div class="form-group">
                    <label for="correo">Correo Electrónico:</label>
                    <input class="form-control" required id="correo" type="email" name="correo" value="{{ old('correo') }}"/>
                </div>

                <div class="form-group">
                    <label for="telefono">Teléfono:</label>
                    <input class="form-control" id="telefono" type="tel" name="telefono" value="{{ old('telefono') }}"/>
                </div>

                <div class="form-group">
                    <label for="fecha_nacimiento">Fecha de Nacimiento:</label>
                    <input class="form-control" required id="fecha_nacimiento" type="date" name="fecha_nacimiento" value="{{ old('fecha_nacimiento') }}"/>
                </div>

                <div class="form-group">
                    <label for="nota_media">Nota Media:</label>
                    <input class="form-control" required id="nota_media" type="number" step="0.01" min="0" max="10" name="nota_media" value="{{ old('nota_media') }}"/>
                </div>

            </div>

            <div class="form-section">
                <h3>Datos del Currículum</h3>

                <div class="form-group">
                    <label for="formacion">Formación:</label>
                    <textarea class="form-control" id="formacion" name="formacion" rows="5">{{ old('formacion') }}</textarea>
                </div>

                <div class="form-group">
                    <label for="experiencia">Experiencia:</label>
                    <textarea class="form-control" id="experiencia" name="experiencia" rows="5">{{ old('experiencia') }}</textarea>
                </div>

                <div class="form-group">
                    <label for="habilidades">Habilidades:</label>
                    <textarea class="form-control" id="habilidades" name="habilidades" rows="3">{{ old('habilidades') }}</textarea>
                </div>
            </div>
            
            <div class="form-section">
                <h3>Fotografía</h3>
                
                <div class="form-group">
                    <div class="drop-zone" id="dropZone">
                        <input type="file" id="fotografiaInput" name="fotografia" class="drop-zone-input" required>
                        
                        <span id="dropZoneText">Arrastra y suelta tu foto aquí, o haz clic para seleccionar</span>
                        
                        <img id="fotografiaPreview" src="#" alt="Vista previa" class="photo-preview">
                    </div>
                </div>
            </div>
            <div class="form-actions">
                <a href="{{ route('cvs.index') }}" class="btn btn-secondary">Cancelar</a>
                <button class="btn btn-primary" type="submit">Guardar Currículum</button>
            </div>
            
        </form>
    </div>
    
    <script>
        //Se crea la zona del drag and drop y la preview para ver la foto cuando se añade
        const dropZone = document.getElementById('dropZone');
        const fotografiaInput = document.getElementById('fotografiaInput');
        const fotografiaPreview = document.getElementById('fotografiaPreview');
        const dropZoneText = document.getElementById('dropZoneText');
        const originalDropText = dropZoneText.textContent;

        //Vista previa
        function showPreview(file) {
            if (file) {
                if (file.type.startsWith('image/')) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        fotografiaPreview.src = e.target.result;
                        fotografiaPreview.style.display = 'block'; //Muestra la imagen
                        dropZoneText.textContent = file.name; //Muestra el nombre del archivo
                    };
                    reader.readAsDataURL(file);
                } else {
                    //Si no es una imagen
                    alert('Por favor, selecciona solo archivos de imagen.');
                    resetDropZone();
                }
            }
        }
        
        //Limpia la zona
        function resetDropZone() {
            fotografiaInput.value = '';
            fotografiaPreview.src = '#';
            fotografiaPreview.style.display = 'none';
            dropZoneText.textContent = originalDropText;
        }

        //Click para que abra la zona
        dropZone.addEventListener('click', () => {
            fotografiaInput.click();
        });

        //Selección de archivos
        fotografiaInput.addEventListener('change', () => {
            if (fotografiaInput.files.length > 0) {
                const file = fotografiaInput.files[0];
                showPreview(file);
            }
        });

        //Arrastrar a la zona
        dropZone.addEventListener('dragover', (e) => {
            e.preventDefault();
            dropZone.classList.add('drop-zone--active');
        });

        //Salir de la zona de arrastre
        dropZone.addEventListener('dragleave', () => {
            dropZone.classList.remove('drop-zone--active');
        });

        //Soltar archivo en la zona
        dropZone.addEventListener('drop', (e) => {
            e.preventDefault();
            dropZone.classList.remove('drop-zone--active');
            
            //Se coge el primer archivo que se suelta
            if (e.dataTransfer.files.length > 0) {
                const file = e.dataTransfer.files[0];
                
                //Asignamos archivos
                fotografiaInput.files = e.dataTransfer.files;
                
                //Mostramos la vista previa
                showPreview(file);
            }
        });
    </script>
    
</body>
</html>