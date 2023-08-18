<div>
    <h1 class="text-center text-md mb-4 mt-3">Comprobante de venta</h1>
    <h3 class="text-center text-md">"Avicola"</h3>
    <img src="../img/remove.png" alt="" class="logo mb-5">
</div>

<ul class="custom-list">
    <li><span class="data-value">Cliente:   </span><?=$clientes?></li>
    <li><span class="data-value">Producto:</span><?=$nombre?></li>
    <li><span class="data-value">N° Paquetes:</span> <?=$cantidad?></li>
</ul>

<table class="table table-border">
    <colgroup>
        <col style="width: 100%;">
    </colgroup>
    <thead class="text-center table-cabez">
        <tr>
            <th>Paquetes</th>  
        </tr>
    </thead>
    <tbody id="conten_paquetes">
        <?php
        
        $paquetesObj = json_decode($paquetes, true);

        foreach ($paquetesObj as $key => $value) {
            echo '<tr><td>' . $key . ': ' . $value .'Kg'. '</td></tr>';
        }
        ?>
    </tbody>
</table>

<ul class="custom-list mt-3">
    <li><span class="data-value">Kilos:   </span><?=$kilos?></li>
    <li><span class="data-value">Precio:</span><?=$precio?></li>
    <li><span class="data-value">Flete:</span> <?=$flete?></li>
</ul>

<!-- <div class="data-num">
    <label for="" class="mt-3 label1">Kilos: <span class="data-value"><?=$kilos?></span></label>
</div>
<div class="data-num">
<label for="" class="mt-3">Precio: <span class="data-value"><?=$precio?></span></label>
</div>
<div class="data-num">
<label for="" class="mt-3">Flete: <span class="data-value"><?=$flete?></span></label>
</div> -->

<label for="" class=" fecha mt-3">Total a pagar: <?=$totalPago?></label>

    
    





