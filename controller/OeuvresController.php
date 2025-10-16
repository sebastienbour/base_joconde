<?php
require_once('model/OeuvresModel.php');

class OeuvresController {
    public function showOeuvres(){
        $Nb=new Nombre(rand(0,9980));
        $oeuvres=$Nb->getOeuvres();
        $nombre=$Nb->getNombre();

        require_once('view/OeuvresView.php');
    }
}
?>