<h1 class="text-center text-md mb-4 mt-3">Reporte detalles pagos</h1>
<h3 class="text-center text-md ">"Avicola"</h3>
<img src="../img/remove.png" alt="" class="logo mb-5">


<table class="table table-border">
    <colgroup>
        <col style="width: 30%;">
        <col style="width: 14% ;">
        <col style="width: 16% ;">
        <col style="width: 15%;">
        <col style="width: 10%;">
        <col style="width: 15%;">
    </colgroup>
    <thead class="table-cabez">
        <tr>
            <th>Cliente</th>
            <th>Fecha</th>
            <th>Producto</th>
            <th>Banco</th>
            <th>N° operación</th>
            <th>Pago</th> 
        </tr>            
    </thead>
    <tbody>

    <?php foreach($data as $registro): ?>
        <tr>
            <td><?=$registro['Cliente']?></td>
            <td><?=$registro['fechapago']?></td>
            <td><?=$registro['banco']?></td>
            <td><?=$registro['numoperacion']?></td>
            <td><?=$registro['pago']?></td>

        </tr>

    <?php endforeach;?>
    
    </tbody>

</table>