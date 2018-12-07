<div class="login_index" id="login">
  <!--Réccuperation de la session-->
  <form action="#" method="post" id="form_recherche">
    <input type="search" name="recherche" id="recherche" placeholder="faites un recherche"/>
    <button type="button" id="button_recherche">
      <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
width="32" height="32"
viewBox="0 0 50 50"
style="fill:#fff;">
<path style="line-height:normal;text-indent:0;text-align:start;text-decoration-line:none;text-decoration-style:solid;text-decoration-color:#000;text-transform:none;block-progression:tb;isolation:auto;mix-blend-mode:normal" d="M 7 4 C 5.3545455 4 4 5.3545455 4 7 L 4 43 C 4 44.645455 5.3545455 46 7 46 L 43 46 C 44.645455 46 46 44.645455 46 43 L 46 7 C 46 5.3545455 44.645455 4 43 4 L 7 4 z M 7 6 L 43 6 C 43.554545 6 44 6.4454545 44 7 L 44 43 C 44 43.554545 43.554545 44 43 44 L 7 44 C 6.4454545 44 6 43.554545 6 43 L 6 7 C 6 6.4454545 6.4454545 6 7 6 z M 22.5 13 C 17.26514 13 13 17.26514 13 22.5 C 13 27.73486 17.26514 32 22.5 32 C 24.758219 32 26.832076 31.201761 28.464844 29.878906 L 36.292969 37.707031 L 37.707031 36.292969 L 29.878906 28.464844 C 31.201761 26.832076 32 24.758219 32 22.5 C 32 17.26514 27.73486 13 22.5 13 z M 22.5 15 C 26.65398 15 30 18.34602 30 22.5 C 30 26.65398 26.65398 30 22.5 30 C 18.34602 30 15 26.65398 15 22.5 C 15 18.34602 18.34602 15 22.5 15 z" font-weight="400" font-family="sans-serif" white-space="normal" overflow="visible">
</path>
</svg>
    </button>
  </form>
  <?php
    if(isset($_SESSION['login']))
    {
      ?>
        <!--Le profil d'utilisateur-->
        <ul id="profil">
          <li >
            <div class="avatar">
              <a href="#"><img src="https://img.icons8.com/ios/50/000000/user-filled.png"></a>
              <span class="user_login"><?php echo key($_SESSION['login']);?></span>
            </div>
            <ul id="detail_profil">
              <li>
                <a href="panier.php" title="voir mon panier">Panier</a>
              </li>
              <li>
                <a href="modifProfil.php" title="Editer ou voir">Profil</a>
              </li>
              <li>
                <a href="deconnexion.php" title="se deconnecter">Deconnexion</a>
              </li>
            </ul>
          </li>
        </ul>
      <?php
    }
    else
    {
      ?>
        <p>
          <a href="inscription.php" id="connexion_button">connexion</a>
        </p>
      <?php
    }
  ?>
</div>
<nav>
  <ul id="nav">
    <?php

      //$_SESSION['chemin']=array();
      include "Donnees.inc.php";
      if(!isset($_GET['valeur'])) $_GET['valeur'] = 'Aliment';

      //tableau du chemin relatif et absolu
      if(!isset($_SESSION['chemin'])) $_SESSION['chemin']=array();

      if(!in_array($_GET['valeur'], $_SESSION['chemin']))
        array_push($_SESSION['chemin'], $_GET['valeur']);

        else{
        //suppression des éléments lien dans le chemin absolu quand on clique sur un lien dans le chemin
        /* On recupère la taille du tableau, on recupère la position de la liste d'élément que l'on veut,
        Ensuite on boucle grace à la position de l'élément dans le tableau jusqu'à la taille du tableau,
        si l'indice est inferieur à la taille du tableau -1, on dépile le dernier element du tableau*/
            $size = count($_SESSION['chemin']);
            $pos = array_search($_GET['valeur'], $_SESSION['chemin']);

              for($i=$size - 1;$i>$pos;$i--){
                   array_pop($_SESSION['chemin']);
              }

          }
        ?>
      <li>
        <?php
        foreach ($_SESSION['chemin'] as $key => $value) {
        ?>
          <a href="?valeur=<?php echo $value ?>" id="chemin_absolu"><?php echo $value?></a>
        <?php
      }
      ?>
    </li>
  </ul>
</nav>
