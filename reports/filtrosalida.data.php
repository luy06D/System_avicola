<h1 class="text-center text-md mb-4 mt-3">Reporte Salida de Insumos</h1>
<h3 class="text-center text-md ">"Avicola"</h3>
<img src="../img/remove.png" alt="" class="logo mb-5">
<label for="" class=" fecha mt-3">Salida del ''<?=$fechaI?>'' al ''<?=$fechaF?>''</label>

<table class="table table-border text-center">
    <colgroup>

        <col style="width: 50%;">
        <col style="width: 10%;">
        <col style="width: 10%;">
        <col style="width: 30%;">

    </colgroup>
    <thead class="table-cabez">
        <tr>
        
        <th>Insumo</th>
        <th>Cantidad</th>
        <th>unidad</th>
        <th>Fecha Salida</th>
        </tr>            
    </thead>
    <tbody>

    <?php foreach($data as $registro): ?>
        <tr>
      
            <td><?=$registro['insumo']?></td>
            <td><?=$registro['cantidad']?></td>
            <td><?=$registro['unidad']?></td>
            <td><?=$registro['fecha_entrada']?></td>

      
        </tr>

    <?php endforeach;?>
    
    </tbody>

</table>
