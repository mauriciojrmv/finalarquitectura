<?php

class Registrado {
    public function getEstado() {
        return "Registrado";
    }

    public function revisar($producto) {
        $producto->setEstado(new Revisado());
    }

    public function guardar($producto) {
        // No se puede guardar directamente desde Registrado
    }
}
