<?php

namespace DEISA\Enums;

abstract class Alerta {
    const Exito = ['clase' => 'alert-success', 'estatus' => 'Excelente!', 'mensaje' => 'Accion ejecutada correctamente :D'];
    const Informacion = ['clase' => 'alert-info', 'estatus' => 'Informacion', 'mensaje' => ''];
    const Advertencia = ['clase' => 'alert-warning', 'estatus' => 'Advertencia', 'mensaje' => ''];
    const Peligro = ['clase' => 'alert-danger', 'estatus' => 'Woops!', 'mensaje' => 'Al parecer algo salio mal :('];
}