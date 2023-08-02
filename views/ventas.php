
<!-- BOOTSTRAP -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
<!-- Boxicons CSS -->
<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>


<div class="container mt-5 col-12">
    <div class="card">
    <div class="card-header bg-warning-subtle text-black">
        <h4 class="text-center">REGISTRO DE VENTAS</h4>
    </div>
    <div class="card-body" >
        <form action="" id="form-venta">
            <div class="row">
            <div class="col-lg-4" >
                <!-- <label for="nombres" class="form-label">Cliente:</label> -->
                <div class="input-group mb-3">
                <span class="input-group-text" id="addon-wrapping"><i class='bx bxs-user-detail' ></i></span>
                <input type="text" class="form-control" placeholder="Buscar cliente" aria-label="Recipient's username" aria-describedby="button-addon2" id="cliente">
                <button class="btn btn-outline-success" type="button" id="button-addon1" data-bs-toggle="modal" data-bs-target="#modalId"><i class='bx bx-search' ></i></button>
                </div>
            </div>
            </div>
            <div class="row">

            <div class="mb-3 col-lg-4">
                <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1"><i class='bx bx-user' ></i></span>
                <input type="text" class="form-control" placeholder="Nombres" maxlength="50" id="nombres">
                </div>
            </div>

            <div class="mb-3 col-lg-4">
                <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1"><i class='bx bx-user' ></i></span>
                <input type="text" class="form-control" placeholder="Apellidos" maxlength="50" id="apellidos">
                </div>
            </div>

            <div class="mb-3 col-lg-4">
                <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1"><i class='bx bx-id-card'></i></span>
                <input type="text" class="form-control" placeholder="Número DNI" maxlength="8" id="dni">
                </div>  
            </div>
            <div class="mb-3 col-lg-4">
                <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1"><i class='bx bx-phone' ></i></span>
                <input type="tel" class="form-control" placeholder="900-000-00" maxlength="9" id="telefono">
                </div>  
            </div>
            
            <div class="col-lg-4">
                <!-- <label for="fecha" class="form-label">Fecha:</label> -->
                <div class="input-group mb-3 ">
                    <span class="input-group-text" id="basic-addon1"><i class='bx bxs-calendar' ></i></span>
                    <input type="date" class="form-control" aria-label="Username" id="fecha">
                </div>
            </div>
            <div class="col-lg-4">
                <!-- <label for="cantidad" class="form-label">N° Paquetes:</label> -->
                <div class="input-group mb-3">
                    <input type="number" placeholder="Digité cantidad paquetes" class="form-control" id="cantidad" min="1" max="500">
                    <button class="btn btn-outline-warning" type="button" id="button-addon2" onclick="crearCajas()"><i class='bx bx-package' ></i></button>
                </div>
            </div>   
            </div>
        </form>

        <form action="" id="form-paquete">
            <div class="mb-3 colg-6" id="contenedorCajas" >

            </div>
        </form>

        <form action="" id="form-detalle">

            <h4 class="text-center">DETALLES</h4>
            <hr>
            <div class="row">
            <div class="col-lg-2" >
                <label for="totalValores" class="form-label">Total kg:</label>
                <input type="number" class="form-control" id="totalValores" disabled >
            </div>
            <div class="col-lg-2">
                <label for="factor" class="form-label">Precio:</label>
                <input type="number" class="form-control" id="factor" step="0.001" oninput="actualizarTotal()" min="1" max="10">
            </div>
            <div class="col-lg-2">
                <label for="resultadoMultiplicacion" class="form-label">Monto:</label>
                <input type="text" class="form-control" id="resultadoMultiplicacion" disabled>
            </div>
            <div class="col-lg-2">
                <label for="flete" class="form-label">Flete:</label>
                <input type="number" class="form-control" id="flete" step="0.01" oninput="actualizarTotal()" min="1" max="10" >
            </div>
            <div class="col-lg-4">
                <label for="resultadoResta" class="form-label">Total a pagar:</label>
                <input type="text" class="form-control" id="resultadoResta" disabled>
            </div>
            </div>
        </form>
    </div>
    <div class="card-footer text-muted">
        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <!-- <button class="btn btn-primary " type="button" onclick="crearCajas()">Crear paquetes</button> -->
            <button type="button" class="btn btn-primary">Guardar</button>
            <button class="btn btn-secondary bg-danger"  onclick="limpiarCajas()" >Limpiar</button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Salir</button>
        </div>
    </div>
    </div>
</div>
<script src="../js/operacion.js"></script>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous"></script>

