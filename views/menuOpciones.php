<?php

$opciones = [
    ["menu" => "Ventas",    "url"    => "index.php?views=ventas.php"],
    ["menu" => "Productos", "url"    => "index.php?views=productos.php"],
    ["menu" => "Clientes",  "url"    => "index.php?views=clientes.php"],
    ["menu" => "Reportes",  "url"    => "index.php?views=reportes.php"],
    ["menu" => "Contactos", "url"    => "index.php?views=contactos.php"]
  ];
//Renderizar los items del MENU
foreach ($opciones AS $item) {
    echo "
    <ul class='links'>
      <li class='nav-item'>
        <a class='nav-link' href='{$item['url']}'>
          {$item['menu']}</a>
      </li>
    </ul>
    ";
  }