<?php 
  include __DIR__."/../Class/locales.php";   

  $local = new Local();

  $todosLosLocales = $local->traerLocales();


//   $todosLosLocales

$arrayLocales = [];
foreach ($todosLosLocales as  $value) {
    $arrayLocales[] = $value['LOCAL'];
}

  include __DIR__."/../Class/cuenta.php";
  $cuentas = new Cuenta();


  if(isset($_GET['anio']) && isset($_GET['mes']) ){
      $date = $_GET['anio']."-".$_GET['mes'];
  }else{
      $date = date("Y-m-d");
  }

  $mes = (isset($_GET['mes'])) ? $_GET['mes'] : date("m");
  $anio = (isset($_GET['anio'])) ? $_GET['anio'] : date("Y");

  $date = strtotime( $date );
  $currentYear = date('Y',  strtotime( date("Y-m-d")));
  $yearDif = $currentYear - 2023;
  $date = date('m', $date);
  $currentDate = $currentYear."-".$date;

  $listado = $cuentas->getListadoFranquicia((int)$mes, $anio);

  $semanas = [];
  $semanas2 = [];

  $sucursales = []; 

  foreach ($listado as $key => $value) {

      if(!in_array($value['numero_semana'], $semanas)){
          $semanas[] = $value['numero_semana'];
      }

      if(!in_array($value['nro_sucursal'], $sucursales)){
          $sucursales[] = [$value['nro_sucursal'], $value['LOCAL']];
      }
      
  }

  sort($semanas);


  foreach ($semanas as $key => $value) {
      $semanas2[$key+1] = [$value];
  }

  
  $datos = [];

  foreach ($listado as $key => $value) {

      $datos[$value['numero_semana']][] = $value;
      
  }

  $tipoMov = [];

  $tiposMov = [];
  $count = 0;
  $tiposDeMovimiento = $local->traerTiposDeMovimientos();

  foreach ($tiposDeMovimiento as $i => $tipo) {


      foreach ($todosLosLocales as $key => $value) {
 
          $tiposMov[$tipo['tipo_movimiento']][$value['LOCAL']] = [];
          $tiposMov[$tipo['tipo_movimiento']][$value['LOCAL']]['id_local'] = $value['ID_LOCAL'];
          foreach ($semanas as $v) {
              $tiposMov[$tipo['tipo_movimiento']][$value['LOCAL']][$v] = [];
              $tiposMov[$tipo['tipo_movimiento']][$value['LOCAL']][$v]['cantidad_kilos'] = 0;
              $tiposMov[$tipo['tipo_movimiento']][$value['LOCAL']][$v]['cantidad'] = 0;
              $tiposMov[$tipo['tipo_movimiento']][$value['LOCAL']][$v]['importe'] = 0;

          }

      }
  }

  foreach ($datos as $x => $data) {

      foreach ($data as $key => $value) {
          $tiposMov [$value["tipo_movimiento"]] [$value['LOCAL']] [$value['numero_semana']] ['cantidad_kilos'] += (int)$value['cantidad_kilos'];
          $tiposMov [$value["tipo_movimiento"]] [$value['LOCAL']] [$value['numero_semana']] ['cantidad'] += (int)$value['cantidad'];
          $tiposMov [$value["tipo_movimiento"]] [$value['LOCAL']] [$value['numero_semana']] ['importe'] += ((float)$value['cantidad'] * (float)$value['valor']);

          
      }
      
      
  }






?>