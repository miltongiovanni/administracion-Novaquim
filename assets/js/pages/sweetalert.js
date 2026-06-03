import Swal from 'sweetalert2'

let deleteUser = document.getElementById("delete-user");
if (deleteUser !== null) {
    deleteUser.addEventListener("click", (e) => {
        Swal.fire({
            title: 'Confirmación',
            text: "¿Está seguro de borrar el usuario?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#000066',
            cancelButtonColor: '#dc3545',
            confirmButtonText: 'Si',
            cancelButtonText: 'No'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('deleteUserForm').submit();
                Swal.fire(
                    'Borrado!',
                    'El usuario ha sido borrado.',
                    'success'
                )
            }
        })
    })
}


let deleteConfiguration = document.getElementById("delete-configuration");
if (deleteConfiguration !== null) {
    deleteConfiguration.addEventListener("click", (e) => {
        Swal.fire({
            title: 'Confirmación',
            text: "¿Está seguro de borrar la configuración?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#000066',
            cancelButtonColor: '#dc3545',
            confirmButtonText: 'Si',
            cancelButtonText: 'No'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('deleteConfigurationForm').submit();
                Swal.fire(
                    'Borrado!',
                    'Configuración borrada.',
                    'success'
                )
            }
        })
    })

}

let deleteCategory = document.getElementById("delete-category");
if (deleteCategory !== null) {
    deleteCategory.addEventListener("click", (e) => {
        Swal.fire({
            title: 'Confirmación',
            text: "¿Está seguro de borrar la categoría?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#000066',
            cancelButtonColor: '#dc3545',
            confirmButtonText: 'Si',
            cancelButtonText: 'No'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('deleteCategoryForm').submit();
                Swal.fire(
                    'Borrada!',
                    'Categoría borrada.',
                    'success'
                )
            }
        })
    })

}


let deleteMercado = document.getElementById("delete-mercado");
if (deleteMercado !== null) {
    deleteMercado.addEventListener("click", (e) => {
        Swal.fire({
            title: 'Confirmación',
            text: "¿Está seguro de borrar el mercado?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#000066',
            cancelButtonColor: '#dc3545',
            confirmButtonText: 'Si',
            cancelButtonText: 'No'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('deleteMercadoForm').submit();
                Swal.fire(
                    'Borrado!',
                    'Mercado borrado.',
                    'success'
                )
            }
        })
    })

}

let deleteProducto = document.getElementById("delete-producto");
if (deleteProducto !== null) {
    deleteProducto.addEventListener("click", (e) => {
        Swal.fire({
            title: 'Confirmación',
            text: "¿Está seguro de borrar el producto?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#000066',
            cancelButtonColor: '#dc3545',
            confirmButtonText: 'Si',
            cancelButtonText: 'No'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('deleteProductoForm').submit();
                Swal.fire(
                    'Borrado!',
                    'Producto borrado.',
                    'success'
                )
            }
        })
    })

}


let deleteBanner = document.getElementById("delete-banner");
if (deleteBanner !== null) {
    deleteBanner.addEventListener("click", (e) => {
        Swal.fire({
            title: 'Confirmación',
            text: "¿Está seguro de borrar el banner?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#000066',
            cancelButtonColor: '#dc3545',
            confirmButtonText: 'Si',
            cancelButtonText: 'No'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('deleteBannerForm').submit();
                Swal.fire(
                    'Borrado!',
                    'Banner borrado.',
                    'success'
                )
            }
        })
    })

}


let deleteDistribudor = document.getElementById("delete-distribuidor");
if (deleteDistribudor !== null) {
    deleteDistribudor.addEventListener("click", (e) => {
        Swal.fire({
            title: 'Confirmación',
            text: "¿Está seguro de borrar el distribuidor?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#000066',
            cancelButtonColor: '#dc3545',
            confirmButtonText: 'Si',
            cancelButtonText: 'No'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('deleteDistribudorForm').submit();
                Swal.fire(
                    'Borrado!',
                    'Distribuidor borrado.',
                    'success'
                )
            }
        })
    })

}
