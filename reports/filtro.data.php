<h1 class="text-center text-md mb-4 mt-3">Reporte de ventas</h1>
<h3 class="text-center text-md ">"Avicola"</h3>
<img src="../img/remove.png" alt="" class="logo mb-5">
<label for="" class=" fecha mt-3">Venta del ''<?=$fechaI?>'' al ''<?=$fechaF?>''</label>

<table class="table table-border">
    <colgroup>
        <col style="width: 41%;">
        <col style="width: 10% ;">
        <col style="width: 11% ;">
        <col style="width: 12%;">
        <col style="width: 13%;">
        <col style="width: 13%;">
    </colgroup>
    <thead class="table-cabez">
        <tr>
        <th>Cliente</th>
        <th>Kilo</th>
        <th>Paquetes</th>
        <th>Precio</th>
        <th>Fecha venta</th>
        <th>Total venta</th>    
        </tr>            
    </thead>
    <tbody>

    <?php foreach($data as $registro): ?>
        <tr>
      
            <td><?=$registro['clientes']?></td>
            <td><?=$registro['kilos']?></td>
            <td><?=$registro['cantidad']?></td>
            <td><?=$registro['precio']?></td>
            
            <td><?=$registro['fechaventa']?></td>
            <td><?=$registro['totalPago']?></td>
      
        </tr>

    <?php endforeach;?>
    
    </tbody>

</table>
