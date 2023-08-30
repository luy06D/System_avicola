<h1 class="text-center text-md mb-4 mt-3">Reporte Entrada de Insumos</h1>
<h3 class="text-center text-md ">"Avicola"</h3>
<img src="../img/remove.png" alt="" class="logo mb-5">
<label for="" class=" fecha mt-3">Entrada del ''<?=$fechaI?>'' al ''<?=$fechaF?>''</label>

<table class="table table-border text-center">
    <colgroup>

        <col style="width: 12%;">
        <col style="width: 19%;">
        <col style="width: 19%;">
        <col style="width: 10%;">
        <col style="width: 10%;">
        <col style="width: 10%;">
        <col style="width: 10%;">
        <col style="width: 10%;">
    </colgroup>
    <thead class="table-cabez">
        <tr>
        
        <th>Fecha</th>
        <th>Detalle</th>
        <th>Insumo</th>
        <th>U.</th>
        <th>Cant/Kg</th>
        <th>Saco/Kg</th>
        <th>Precio</th>
        <th>A Stock</th>
        </tr>            
    </thead>
    <tbody>

    <?php foreach($data as $registro): ?>
        <tr>
      
            <td><?=$registro['fecha_entrada']?></td>
            <td><?=$registro['detalle']?></td>
            <td><?=$registro['insumo']?></td>
            <td><?=$registro['unidad']?></td>
            <td><?=$registro['cantidadtn']?></td>
            <td><?=$registro['cantidadsaco']?></td>
            <td><?=$registro['precio']?></td>
            <td><?=$registro['stock']?></td>

      
        </tr>

    <?php endforeach;?>
    
    </tbody>

</table>