<h1 class="text-center text-md mb-4 mt-3">Reporte Salida de Insumos</h1>
<h3 class="text-center text-md ">"Avicola"</h3>
<img src="../img/remove.png" alt="" class="logo mb-5">
<label for="" class=" fecha mt-3">Salida del ''<?=$fechaI?>'' al ''<?=$fechaF?>''</label>

<table class="table table-border text-center">
    <colgroup>

        <col style="width: 15%;">
        <col style="width: 20%;">
        <col style="width: 20%;">
        <col style="width: 15%;">
        <col style="width: 15%;">
        <col style="width: 15%;">

    </colgroup>
    <thead class="table-cabez">
        <tr>
        
        <th>Fecha</th>
        <th>Fórmula</th>
        <th>Insumo</th>
        <th>Unidad</th>
        <th>Cantidad/Kg</th>
        <th>De Stock</th>
        </tr>            
    </thead>
    <tbody>

    <?php foreach($data as $registro): ?>
        <tr>

            <td><?=$registro['fecha_salida']?></td>
            <td><?=$registro['formula']?></td>
            <td><?=$registro['insumo']?></td>
            <td><?=$registro['unidad']?></td>
            <td><?=$registro['cantidad']?></td>
            <td><?=$registro['stock']?></td>

      
        </tr>

    <?php endforeach;?>
    
    </tbody>

</table>
