# Implementación de una aplicación para crear CVs

**Autor:** Antonio Benítez García

**Asignatura:** Desarrollo web en entorno servidor

---

## 📝 Descripción del Proyecto

Este proyecto es una aplicación web para la gestión de Currículums (CVs) de alumnos.

La aplicación implementa un CRUD (Crear, Leer, Actualizar, Borrar) completo, permitiendo a los usuarios añadir nuevos perfiles de alumnos, incluyendo sus datos personales, habilidades y una fotografía. También cuenta con un sistema de búsqueda y validación de datos.

## ✨ Características Principales

* **Listado y Búsqueda:** Visualizar todos los CVs con una barra de búsqueda que filtra por nombre, apellidos, correo o habilidades.
* **Creación de Perfiles:** Añadir nuevos alumnos a través de un formulario con validación de datos y subida de imagen.
* **Edición de Perfiles:** Modificar la información de un CV existente, con la opción de reemplazar la fotografía.
* **Borrado de Perfiles:** Eliminar un CV de la base de datos, lo que también elimina su foto asociada del servidor para no almacenar archivos huérfanos.
* **Almacenamiento de Archivos:** Gestión de la subida de imágenes en el servidor (guardadas en `storage/app/public/fotos_cvs`).

---

## 📸 Galería de la Aplicación

A continuación se muestran las vistas principales de la aplicación.

### 1. Página Principal (Index)

Vista principal donde se listan todos los currículums. Aquí se puede ver la funcionalidad de búsqueda en acción.

<img width="1422" height="909" alt="index" src="https://github.com/user-attachments/assets/0c4e9a81-6149-4d26-9161-60d7dfc444f9" />

---

### 2. Formulario de Creación (Create)

Formulario para añadir un nuevo perfil, mostrando los campos requeridos y el selector de archivos para la fotografía.

<img width="1120" height="920" alt="create" src="https://github.com/user-attachments/assets/d3e6e25f-63c0-423c-b89b-4535965b287a" />
<img width="828" height="921" alt="create 2" src="https://github.com/user-attachments/assets/f87ee173-8e07-4c4d-a272-b467736fa565" />

---

### 3. Formulario de Edición (Edit)

Formulario pre-rellenado con los datos del alumno que se va a editar.

<img width="874" height="891" alt="edit 1" src="https://github.com/user-attachments/assets/c10f252f-39d8-4dbf-9dbb-634b0b6581e2" />
<img width="990" height="919" alt="edit 2" src="https://github.com/user-attachments/assets/60429a05-7ef9-4f3e-9860-38ae2a9b8257" />

---

### 4. Funcionalidad de Borrado (Delete)

La funcionalidad de borrado se activa desde el listado principal. Si tienes un modal de confirmación (un pop-up que pregunta "¿Estás seguro?"), sería ideal mostrarlo. Si no, muestra el botón de borrar en la lista.

<img width="515" height="327" alt="delete" src="https://github.com/user-attachments/assets/8e4e73f9-ae59-4271-95ad-8b458eba8e65" />

---

### 5. Funcionalidad de Visionado (View)

Al dar click muestra una carta sobre el usuario seleccionado


<img width="722" height="821" alt="view" src="https://github.com/user-attachments/assets/6a302839-a436-4cfa-899b-4ecb13146a1c" />
