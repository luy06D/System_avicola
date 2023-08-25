<h1 class="text-center text-md mb-4 mt-3">Reporte de Pagos</h1>
<h3 class="text-center text-md ">"Avicola"</h3>
<img src="../img/remove.png" alt="" class="logo mb-5">
<label for="" class=" fecha mt-3">Pago del ''<?=$fechaI?>'' al ''<?=$fechaF?>''</label>

<table class="table table-border text-center">
    <colgroup>
        <!-- <col style="width: 8%;">
        <col style="width: 20% ;">
        <col style="width: 12% ;">
        <col style="width: 15%;">
        <col style="width: 13%;">
        <col style="width: 12%;">
        <col style="width: 10%;">
        <col style="width: 10%;"> -->
        <col style="width: 15%;">
        <col style="width: 10% ;">
        <col style="width: 11% ;">
        <col style="width: 12%;">
        <col style="width: 10%;">
        <col style="width: 13%;">
        <col style="width: 13%;">
        <col style="width: 16%">
    </colgroup>
    <thead class="table-cabez">
        <tr>
        <th>Código</th>
        <th>Cliente</th>
        <th>Fecha</th>
        <th>Producto</th>
        <th>Deuda total</th>
        <th>Pago total</th>
        <th>Saldo</th>   
        <th>Estado</th> 
        </tr>            
    </thead>
    <tbody>

    <?php foreach($data as $registro): ?>
        <tr>
      
            <td><?=$registro['idpago']?></td>
            <td><?=$registro['cliente']?></td>
            <td><?=$registro['fechapago']?></td>
            <td><?=$registro['producto']?></td>
            <td><?=$registro['deuda_total']?></td>
            <td><?=$registro['pago_total']?></td>
            <td><?=$registro['saldo']?></td>
            <td><?=$registro['estado']?></td>
      
        </tr>

    <?php endforeach;?>
    
    </tbody>

</table>
