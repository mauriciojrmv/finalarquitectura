<?php

class Guardado {
    public function getEstado() {
        return "Guardado";
    }

    public function revisar($producto) {
        // No se puede revisar desde Guardado
    }

    public function guardar($producto) {
        // Ya está guardado, no hacer nada
    }
}
