<?php

class Revisado {
    public function getEstado() {
        return "Revisado";
    }

    public function revisar($producto) {
        // Ya está revisado, no hacer nada
    }

    public function guardar($producto) {
        $producto->setEstado(new Guardado());
    }
}
