<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sidebar</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<style>
    ::after,
    ::before {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
    }

    a {
        text-decoration: none;
    }

    li {
        list-style: none;
    }



    body {
        font-family: 'Poppins', sans-serif;
    }

    .wrapper {
        display: flex;
    }

    .main {
        min-height: 100vh;
        width: 100%;
        overflow: hidden;
        background-color: #fafbfe;
    }

    #sidebar {

        width: 70px;
        min-width: 70px;
        min-height: 100vh;
        z-index: 1000;
        transition: all .25s ease-in-out;
        background-color: #081444;
        display: flex;
        flex-direction: column;
    }

    #sidebar.expand {
        width: 260px;
        min-width: 260px;
    }

    .toggle-btn {
        background-color: transparent;
        cursor: pointer;
        border: 0;
        padding: 1rem 1.5rem;
    }

    .toggle-btn i {
        font-size: 1.5rem;
        color: #FFF;
    }

    .sidebar-logo {
        margin: auto 0;
    }

    .sidebar-logo a {
        color: #f556a3;
        font-size: 1.15rem;
        font-weight: 600;
    }

    #sidebar:not(.expand) .sidebar-logo,
    #sidebar:not(.expand) a.sidebar-link span {
        display: none;
    }

    .sidebar-nav {
        padding-top: 0;
        flex: 1 1 auto;

    }

    a.sidebar-link {
        padding: 1rem 1.500rem;
        color: #FFF;
        display: block;
        font-size: 1.3rem;
        white-space: nowrap;
        border-left: 4px solid transparent;

    }

    .sidebar-link i {
        font-size: 1.15rem;
        margin-right: .75rem;
    }

    .sidebar-link.ir-inicio i {
        margin-right: 0;
        margin-top: .6rem;
    }

    a.sidebar-link:hover {
        background-color: rgba(255, 255, 255, .075);
        border-left: 5px solid #f556a3;

    }
    a.sidebar-link.ir-inicio {
        padding-bottom: 2rem;
    }

    .sidebar-item {
        position: relative;
    }



    #sidebar:not(.expand) .sidebar-item .sidebar-dropdown {
        position: absolute;
        top: 0;
        left: 70px;
        background-color: #d99db7;
        padding: 0;
        min-width: 15rem;
        display: none;
        border-top-right-radius: 10px;
        border-bottom-right-radius: 10px;
    }

    #sidebar:not(.expand) .sidebar-item:hover .has-dropdown+.sidebar-dropdown {
        display: block;
        max-height: 15em;
        width: 100%;
        opacity: 1;
    }

    #sidebar:not(.expand) .sidebar-item:hover .sidebar-link {
        background-color: #d99db7;
    }

    #sidebar.expand .sidebar-link[data-bs-toggle="collapse"]::after {
        border: solid;
        border-width: 0 .075rem .075rem 0;
        content: "";
        display: inline-block;
        padding: 2px;
        position: absolute;
        right: 1.5rem;
        top: 1.4rem;
        transform: rotate(-135deg);
        transition: all .2s ease-out;
    }

    #sidebar.expand .sidebar-link[data-bs-toggle="collapse"].collapsed::after {
        transform: rotate(45deg);
        transition: all .2s ease-out;
    }

    .sidebar-divider{
        width: 100%;
        height: 2px;
        background-color: #f556a3;
        margin: 1rem 0;
    }

    #fecha-hora {
        margin-top: .5rem;
        font-size: 1rem;
        color: #fff;
    }

    .usuario {
        margin-top: .5rem;
        font-size: 1.2rem;
        color: #fff;
    }

    /* ESTILO PARA AGREGAR IMAGES */
    /* Estilo para el botón circular */
    .btn-circle {
        width: 60px;  /* Tamaño del botón "plus" */
        height: 60px;
        border-radius: 50%;
        background-color: #fff;
        border: 2px solid #ddd;
        display: flex;
        justify-content: center;
        align-items: center;
        cursor: pointer;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }

    .btn-circle i {
        font-size: 30px;  /* Tamaño del ícono "plus" */
        color: #000;
    }

    /* Diálogo flotante */
    .dialog-box-images {
        background-color: #0a0f24;
        padding: 10px;
        border-radius: 4px;
        width: 250px; /* Tamaño del cuadro de diálogo */
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        position: absolute;
        z-index: 1000;
    }

    /* Contenedor de la imagen y el botón "plus" */
    .image-preview-area {
        display: flex;
        align-items: center;
        flex-wrap: wrap;  /* Asegura que las imágenes se acomoden bien en varias filas */
    }

    /* Estilo para la imagen y el botón "plus" */
    .add-image {
        width: 60px;  /* Tamaño del botón "plus" */
        height: 60px;
        border-radius: 50%;
        background-color: #333;
        display: flex;
        justify-content: center;
        align-items: center;
        cursor: pointer;
    }

    .add-btn {
        font-size: 35px;  /* Tamaño del ícono "plus" */
        color: white;
    }

    #mainImageContainer {
        position: relative;
    }

    /* Estilo para la imagen y su ícono de eliminar */
    #mainImageContainer img {
        width: 150px;  /* Tamaño de la imagen cuadrada */
        height: 150px; /* Tamaño de la imagen cuadrada */
        object-fit: cover; /* Mantener la proporción correcta sin distorsionar */
        margin-right: 10px; /* Espacio entre las imágenes */
        margin-bottom: 10px; /* Espacio debajo de las imágenes */
        border-radius: 10px; /* Bordes redondeados opcionales */
    }

    /* Estilo para el ícono de "X" en la parte superior derecha */
    .remove-img {
        position: absolute;
        top: 5px;
        right: 15px;
        background-color: rgba(0, 0, 0, 0.3);
        color: #fff;
        border-radius:50%;
        padding: 5px 10px;
        cursor: pointer;
        font-size: 18px;
    }

    .remove-img:hover {
        background-color: rgba(0, 0, 0, 0.6);
    }

    .volver-home {
        font-size: 1.6rem;

        font-family: 'Poppins', sans-serif;
    }

    a.sidebar-link.ir-inicio:hover {
        color: #ff69b4;
        border-left: 5px solid #ff69b4;
    }
</style>
<body>


@include('components.sidebar')
<div class="main p-3">
    aqui
    @include(Route::currentRouteName())
</div>

<script>
    if (window.location.pathname === '/dashboard/productos') {
        // Variables para el modal de agregar producto
        const imageButton = document.getElementById('imageButton');
        const imageDialog = document.getElementById('imageDialog');
        const addBtn = document.querySelector('.add-btn');
        const fileInput = document.querySelector('.file-input');
        const mainImageContainer = document.getElementById('mainImageContainer');
        const closeDialogBtn = document.getElementById('closeDialog');
        const saveImageBtn = document.getElementById('saveImageBtn');

        let popperInstance = null;

        function createPopper(button, dialog) {
            return Popper.createPopper(button, dialog, {
                placement: 'top',
                modifiers: [
                    {
                        name: 'offset',
                        options: {
                            offset: [0, 8],
                        },
                    },
                ],
            });
        }

        function toggleImageDialog(button, dialog, popperInstance) {
            if (dialog.style.display === 'none' || dialog.style.display === '') {
                dialog.style.display = 'block';
                createPopper(button, dialog);
            } else {
                dialog.style.display = 'none';
                if (popperInstance) {
                    popperInstance.destroy();
                    popperInstance = null;
                }
            }
        }

        function handleFileSelect(fileInput, imageContainer) {
            const files = fileInput.files;
            imageContainer.innerHTML = '';

            Array.from(files).forEach(file => {
                const reader = new FileReader();
                reader.onload = function (e) {
                    const imgElement = document.createElement('img');
                    imgElement.src = e.target.result;
                    imgElement.style.width = '100px';
                    imgElement.style.height = '100px';

                    const imageWrapper = document.createElement('div');
                    imageWrapper.style.position = 'relative';
                    imageWrapper.appendChild(imgElement);

                    const removeIcon = document.createElement('span');
                    removeIcon.className = 'remove-img';
                    removeIcon.innerHTML = '&times;';
                    removeIcon.style.cursor = 'pointer';
                    removeIcon.addEventListener('click', function () {
                        imageWrapper.remove();
                    });

                    imageWrapper.appendChild(removeIcon);
                    imageContainer.appendChild(imageWrapper);
                };

                reader.readAsDataURL(file);
            });
        }

        // Eventos para el modal de agregar producto
        if (imageButton) {
            imageButton.addEventListener('click', () => toggleImageDialog(imageButton, imageDialog, popperInstance));
            addBtn.addEventListener('click', () => fileInput.click());
            fileInput.addEventListener('change', () => handleFileSelect(fileInput, mainImageContainer));
            closeDialogBtn.addEventListener('click', () => {
                imageDialog.style.display = 'none';
                if (popperInstance) {
                    popperInstance.destroy();
                    popperInstance = null;
                }
            });
            saveImageBtn.addEventListener('click', () => {
                console.log('Imagen guardada');
                imageDialog.style.display = 'none';
            });
        }

        // Variables para el modal de editar producto
        const imageButtonEdit = document.getElementById('imageButtonEdit');
        const imageDialogEdit = document.getElementById('imageDialogEdit');
        const addBtnEdit = document.querySelector('.add-btn-edit');
        const fileInputEdit = document.querySelector('.file-input-edit');
        const mainImageContainerEdit = document.getElementById('mainImageContainerEdit');
        const closeDialogBtnEdit = document.getElementById('closeDialogEdit');
        const saveImageBtnEdit = document.getElementById('saveImageBtnEdit');

        let popperInstanceEdit = null;

        // Eventos para el modal de editar producto
        if (imageButtonEdit) {
            imageButtonEdit.addEventListener('click', () => toggleImageDialog(imageButtonEdit, imageDialogEdit, popperInstanceEdit));
            addBtnEdit.addEventListener('click', () => fileInputEdit.click());
            fileInputEdit.addEventListener('change', () => handleFileSelect(fileInputEdit, mainImageContainerEdit));
            closeDialogBtnEdit.addEventListener('click', () => {
                imageDialogEdit.style.display = 'none';
                if (popperInstanceEdit) {
                    popperInstanceEdit.destroy();
                    popperInstanceEdit = null;
                }
            });
            saveImageBtnEdit.addEventListener('click', () => {
                console.log('Imagen guardada');
                imageDialogEdit.style.display = 'none';
            });
        }
    }



    // aqui inicia la parte de usuarios
    if (window.location.pathname === '/dashboard/usuarios') {
        // Funcionalidad de la barra de búsqueda para usuarios
        const searchInputUsuarios = document.getElementById('searchInputUsuarios');
        searchInputUsuarios.addEventListener('input', function () {
            const filter = searchInputUsuarios.value.toLowerCase();
            const rows = document.querySelectorAll('tbody tr');
            rows.forEach(row => {
                const nombre = row.cells[0].textContent.toLowerCase();
                if (nombre.includes(filter)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });


    }


</script>



</body>

</html>
