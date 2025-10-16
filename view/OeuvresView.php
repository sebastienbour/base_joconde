<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Liste d'oeuvres françaises</title>
        <style>
            body { 
                margin: 0;
                padding: 0;
                box-sizing: border-box;
                font-size: 0.9em;;
                background: url('Downloads/Background1.jpg');
                background-size: cover;
                background-position: center;
            }
            h2{
                font-size: 2em;
                font-weight: bold;
            }
            strong{
                font-size: 1.3em;
            }
            p {
                font-size: 1.6em;
                width: fit-content;
                margin-left: 5%;
                padding: 8px;
                border: 3px solid rgb(0, 0, 0);
                outline: 3px solid #e6c49c;
                box-shadow: 0 0 0 5px rgb(0, 0, 0);
                background-color: rgb(255, 255, 255);
            }
            .title{
                display: flex;
                justify-content: center;
                position: relative;
                top: 0;
                width: 100%;
                height: 100px;
                padding: 25px;
                padding-bottom: 15px;
                font-family:'Times New Roman', Times, serif;
                font-size: 3.5em;
                color: white;
                background-image: linear-gradient(black, 80%, rgba(255, 255, 255, 0));
            }
            .sub{
                display: flex;
                align-items: baseline;
            }
            .note{
                transition: 0.3s;
                display: flex;
                align-items: center;
                justify-content: center;
                margin-left: 2%;
                width: 20px;
                height: 20px;
                color: black;
                font-size: 1.3rem;
                border: 2px solid rgb(131, 108, 81);
                border-radius: 5px;
                background-color: whitesmoke;
                cursor: pointer;
            }
            .note:hover{
                transition: 0.3s;
                background-color: yellow;
            }
            .num{
                display: none;
                position: relative;
                padding: 5px;
                margin-top: auto;
                margin-bottom: auto;
                font-size: 0.9rem;
                text-align: center;
                border: 2px solid rgb(131, 108, 81);
                border-radius: 5px;
                background-color: whitesmoke;
                cursor: default;
            }
            .container {
                display: flex;
                flex-wrap: wrap;
                width: 100%;
            }
            .oeuvres {
                transition: 0.5s;
                align-items: center;
                flex-direction: column;
                text-align: center;
                width: 20.5%;
                margin-left: auto;
                margin-right: auto;
                margin-bottom: 25px;
                padding: 8px;
                padding-bottom: 40px;
                border: 3px solid rgb(131, 108, 81);
                outline: 3px solid #e6c49c;
                box-shadow: 0 0 0 5px rgb(131, 108, 81);
                backdrop-filter: blur(5px);
                background-color: rgba(255, 255, 255, 0.6);
            }
            .oeuvres:hover {
                transition: 0.5s;
                border: 3px solid black;
                outline: 3px solid rgb(205, 171, 131);;
                box-shadow: 0 0 0 5px black;
                background-color: white;
            }
            .oeuvres:hover>.button {
                transition: 0.5s;
                opacity: 100%;
            }
            .button{
                transition: 0.3s;
                position: absolute;
                opacity: 0%;
                bottom: 10px;
                left: 25%;
                right: 25%;
                width: 50%;
                height: 40px;
                padding: 5px;
                text-align: center;
                font-size: 1.2em;
                font-weight: bold;
                border: 2px solid black;
                border-radius: 5px;
                background-color: #e6c49c;
                cursor: pointer;
            }
            .button:hover{
                transition: 0.3s;
                font-size: 1.25em;
                background-color:rgb(131, 108, 81);
            }
            .infoSup {
                transition: 0.5s;
                display: none;
                flex-direction: column;
                z-index: 1;
                position: fixed;
                top: 100%;
                bottom: -100%;
                left: 0;
                right: 0;
                width: screen;
                height: screen;
                padding: 15px;
                padding-top: 80px;
                color: white;
                font-size: 1.3em;
                text-shadow: 1px 1px 2px black;
                overflow: auto;
                backdrop-filter: blur(10px);
                background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('Downloads/Background2.webp');
                background-size: cover;
                background-position: center;
            }
            .infoTitre {
                display: flex;
                align-items: center;
                justify-content: center;
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 8%;
                text-align: center;
                border-bottom: 2px solid white;
                background-color: black;
            }
            .close-button{
                transition: 0.3s;
                position: absolute;
                margin-top: auto;
                margin-bottom: auto;
                right: 15px;
                width: fit-content;
                height: fit-content;
                padding: 5px;
                text-align: center;
                font-size: 1em;
                font-weight: bold;
                border: 2px solid white;
                border-radius: 5px;
                background-color: #e6c49c;
                cursor: pointer;
            }
            .close-button:hover{
                transition: 0.3s;
                background-color:rgb(131, 108, 81);
            }
            .line{
                display: flex;
                align-items: baseline;
                gap: 10px;
            }
            .inf{
                white-space: nowrap;
                font-weight: bold;
                font-size: 1.3em;
            }
        </style>
    </head>
    <body>
        <div class="title">
            Répertoire Oeuvres de France
        </div>
        <div class="sub">
            <p>Liste de 20 oeuvres françaises</p>
            <div class="note" id="note">
                i
            </div>
            <div class="num" id="num">
                n°<?= $nombre ?> à n°<?= $nombre + 19?> <br> API Base Joconde
            </div>
        </div>
        <div class="container" id="container">
            <?php foreach ($oeuvres as $oeuvre): ?>
                <div class="oeuvres" id="oeuvres">
                    <?= "<strong>Titre :</strong> ".$oeuvre['titre']." <br><br> ".
                    "<strong>Auteur :</strong> ".$oeuvre['auteur']." <br><br> ".
                    "<strong>Époque :</strong> ".$oeuvre['epoque']." <br><br> ".
                    "<strong>Période de création :</strong> ".$oeuvre['periodeCreation']." <br><br> ".
                    "<strong>Domaine :</strong> ".$oeuvre['domaine']." <br><br> ".
                    "<strong>Nom du musée :</strong> ".$oeuvre['nomOfficielMusee']." <br><br> " ?>
                    <button type="button" class="button" id="btn_<?= $oeuvre['ref'] ?>">Voir plus</button>
                </div>
                <div class="infoSup" id="info_<?= $oeuvre['ref'] ?>">
                    <div class="infoTitre" >
                        <h2>Informations supplémentaires</h2>
                        <button type="button" class="close-button" id="btn_close_<?= $oeuvre['ref'] ?>">Fermer</button>
                    </div>
                    <?= "<div class='line'><div class='inf'><em>Référence :</div> ".$oeuvre['ref']." </em></div><br> ".
                    "<div class='line'><div class='inf'>Titre :</div> ".$oeuvre['titre']." </div> ". 
                    "<div class='line'><div class='inf'>Auteur :</div> ".$oeuvre['auteur']." </div> ".
                    "<div class='line'><div class='inf'>Précisions sur l'auteur :</div> ".$oeuvre['precisionsAuteur']." </div> ".
                    "<div class='line'><div class='inf'>Description :</div> ".$oeuvre['description']." </div> ".
                    "<div class='line'><div class='inf'>Mesures :</div> ".$oeuvre['mesures']." </div> ".
                    "<div class='line'><div class='inf'>Matériaux techniques :</div> ".$oeuvre['materiauxTechniques']." </div> ".
                    "<div class='line'><div class='inf'>Domaine :</div> ".$oeuvre['domaine']." </div> ".
                    "<div class='line'><div class='inf'>Période de création :</div> ".$oeuvre['periodeCreation']." </div> ".
                    "<div class='line'><div class='inf'>Ancienne appartenance :</div> ".$oeuvre['ancienneAppartenance']." </div> ".
                    "<div class='line'><div class='inf'>Dénomination :</div> ".$oeuvre['denomination']." </div><br> ".
                    "<div class='line'><div class='inf'>Découverte et collecte :</div> ".$oeuvre['decouverteCollecte']." </div> ".
                    "<div class='line'><div class='inf'>Date d'acquisition :</div> ".$oeuvre['dateAcquisition']." </div> ".
                    "<div class='line'><div class='inf'>Lieu de dépot :</div> ".$oeuvre['lieuDepot']." </div> ".
                    "<div class='line'><div class='inf'>Localisation :</div> ".$oeuvre['localisation']." </div> ".
                    "<div class='line'><div class='inf'>Région :</div> ".$oeuvre['region']." </div> ".
                    "<div class='line'><div class='inf'>Département :</div> ".$oeuvre['departement']." </div> ".
                    "<div class='line'><div class='inf'>Ville :</div> ".$oeuvre['ville']." </div> ".
                    "<div class='line'><div class='inf'>Nom du musée :</div> ".$oeuvre['nomOfficielMusee']." </div> ".
                    "<div class='line'><div class='inf'>Code Muséofile :</div> ".$oeuvre['codeMuseofile']." </div> ".
                    "<div class='line'><div class='inf'>Coordonnées :</div> ".$oeuvre['coordonnees']." </div><br> ".
                    "<div class='line'><div class='inf'>Utilisation :</div> ".$oeuvre['utilisation']." </div> ".
                    "<div class='line'><div class='inf'>Période d'utilisation :</div> ".$oeuvre['periodeUtilisation']." </div> ".
                    "<div class='line'><div class='inf'>Sujet représenté :</div> ".$oeuvre['sujetRep']." </div> ".
                    "<div class='line'><div class='inf'>Date du sujet représenté :</div> ".$oeuvre['dateSujetRep']." </div> ".
                    "<div class='line'><div class='inf'>Précisions sur les sujets représentés :</div> ".$oeuvre['precisionsSujetsRep']." </div> ".
                    "<div class='line'><div class='inf'>Précisions sur les inscriptions :</div> ".$oeuvre['precisionsInscriptions']." </div> ".
                    "<div class='line'><div class='inf'>Commentaires :</div> ".$oeuvre['commentaires']." </div><br> ".
                    "<div class='line'><div class='inf'>Date de création :</div> ".$oeuvre['dateCreation']." </div> ".
                    "<div class='line'><div class='inf'>Date de mise à jour :</div> ".$oeuvre['dateMAJ']." </div> ".
                    "<div class='line'><div class='inf'>Lien du site associé :</div> ".$oeuvre['lienSiteAssocie']." </div> " ?>
                </div>
                <br><br>
            <?php endforeach; ?>
        </div>
        <script> 
        <?php foreach ($oeuvres as $oeuvre): ?>
            document.getElementById("btn_<?= $oeuvre['ref'] ?>").onclick = function() {
                var element = document.getElementById("info_<?= $oeuvre['ref'] ?>");

                element.style.display = "flex";
                document.body.style.overflow = "hidden"; 
                setTimeout(function() {
                    element.style.top = "0"; 
                    element.style.bottom = "0";
                }, 0); 

                document.getElementById("btn_close_<?= $oeuvre['ref'] ?>").onclick = function() {
                
                    element.style.top = "100%";
                    element.style.bottom = "-100%";
                    document.body.style.overflow = "auto"; 
                    setTimeout(function() {
                        element.style.display = "none"; 
                    }, 500); 
                }
            }
        <?php endforeach; ?>

        var note = document.getElementById("note");
        var num = document.getElementById("num");
        note.onclick = function(){
            if(num.style.display === "none"){
                num.style.display = "flex";
            }else{
                num.style.display = "none";
            }
        }
        </script>
    </body>
</html>