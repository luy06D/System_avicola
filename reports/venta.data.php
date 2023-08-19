<div class="cabezera">
    <h1 class="text-center text-md mt-4">Comprobante de venta</h1>
    <h3 class="text-center text-md mt-3">"Avicola vania"</h3>
    <img src="../img/remove.png" alt="" class="logo mb-5">
</div>

<ul class="custom-list ">
    <li><span class="data-value">Fecha venta: </span><?=$fechaventa?>.</li>
    <li><span class="data-value">Cliente: </span><?=$clientes?>.</li>
    <li><span class="data-value">Producto:  </span><?=$nombre?>.</li>
    <li><span class="data-value">N° Paquetes:   </span> <?=$cantidad?>.</li>
</ul>

<table class="table table-border">
    <colgroup>
        <col style="width: 20%;">
        <col style="width: 20%;">
        <col style="width: 20%;">
        <col style="width: 20%;">
        <col style="width: 20%;">
    </colgroup>
    <thead class="text-center table-cabez">
        <tr>
            <th colspan="5">Paquetes</th>
        </tr>
    </thead>
    <tbody id="conten_paquetes">
        <?php
        $paquetesObj = json_decode($paquetes, true);

        $count = 0; // Inicializa el contador de columnas
        echo '<tr>'; // Inicializa la fila

        foreach ($paquetesObj as $key => $value) {
            if ($count >= 5) {
                echo '</tr><tr>'; // Cierra la fila anterior y comienza una nueva fila
                $count = 0; // Reinicia el contador
            }

            echo '<td>' . $key . ': ' . $value . 'kg' . '</td>';
            $count++;
        }

        // Completa la última fila si es necesario
        while ($count < 5) {
            echo '<td></td>';
            $count++;
        }

        echo '</tr>'; // Cierra la última fila
        ?>
    </tbody>
</table>


<ul class="custom-listF">
    <li><span class="data-value">Kilos:</span> <?=$kilos?></li>
    <li><span class="data-value">Precio:</span>  <?=$precio?></li>
    <li><span class="data-value">Flete:</span>   <?=$flete?></li>
    <li><span class="data-value">Monto:</span>   <?=$monto?></li>
</ul>


<label for="" class="fecha total mt-3"><span class="total">Total a pagar:</span> <?=$totalPago?></label>

    
    





