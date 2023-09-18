<div class="cabezera" style="position: relative;">
    <h1 class="text-center text-md mt-4">Comprobante de venta</h1>
    <h3 class="text-center text-md mt-3">"Avicola vania"</h3>
    <img src="../img/remove.png" alt="" class="logo" style="position: absolute; top: 10px; left: 20px;">
</div>

<ul class="custom-list ">
    <li><span class="data-value">Fecha venta: </span><?=$fechaventa?>.</li>
    <li><span class="data-value">Cliente: </span><?=$clientes?>.</li>
    <li><span class="data-value">Producto:  </span><?=$nombre?>.</li>
    <li><span class="data-value">N° Paquetes:   </span> <?=$cantidad?>.</li>
</ul>

<table class="table table-border">
    <colgroup>
        <col style="width: 10%;">
        <col style="width: 10%;">
        <col style="width: 10%;">
        <col style="width: 10%;">
        <col style="width: 10%;">
        <col style="width: 10%;">
        <col style="width: 10%;">
        <col style="width: 10%;">
        <col style="width: 10%;">
        <col style="width: 10%;">
    </colgroup>
    <thead class="text-center table-cabez">
        <tr>
            <th colspan="10">Paquetes</th>
        </tr>
    </thead>
    <tbody id="conten_paquetes">
        <?php
        $paquetesObj = json_decode($paquetes, true);
        $maxCount = count($paquetesObj);
        $numRows = ceil($maxCount / 10);

        $totalValue = 0; // Inicializamos la variable para calcular la suma

        for ($row = 0; $row < $numRows; $row++) {
            echo '<tr>';
            
            for ($col = 1; $col <= 10; $col++) {
                $index = ($col - 1) * $numRows + $row;
                if ($index < $maxCount) {
                    $key = $index + 1;                                    
                    $value = $paquetesObj[$key];
                    $decimalValue = number_format($value, 2);
                    echo '<td>' . $key . ': ' . $decimalValue . '</td>';
                    
                    // Sumamos el valor al total
                    $totalValue += $value;
                } else {
                    // Si no hay más datos, muestra celdas vacías
                    echo '<td></td>';
                }
            }
            
            echo '</tr>';
        }
        ?>
    </tbody>
</table>

<div style="position: relative;">
<ul class="custom-listF">
    <li><span class="data-value">Kilos:</span> <?=$kilos?></li>
    <li><span class="data-value">Precio:</span>  <?=$precio?></li>
    <li><span class="data-value">Flete:</span>   <?=$flete?></li>
    <li><span class="data-value">Monto:</span>   <?=$monto?></li>
    <!-- Calcular y mostrar el promedio de las ventas -->
    <li><span class="data-value">Promedio general:</span> <?=number_format($totalValue / $maxCount, 2)?></li>
</ul>

</div>




<label for="" class="fecha total mt-3"><span class="total">Total a pagar:</span> <?=$totalPago?></label>

    
    





