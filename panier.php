<?php
session_start();
include 'functions.php';
include 'favorie.php';
include 'Donnees.inc.php';
$login = key($_SESSION['login']);//je reccupère le login
?>
<!DOCTYPE html>
<html>
  <head>
    <title>cocktail</title>
    <link rel="stylesheet" href="style.css"/>
    <link rel="icon" type="image/x-icon" href="photos/icon.png"/>
    <style>
      /* -----
      SVG Icons - svgicons.sparkk.fr
      ----- */

      .svg-icon {
        width: 2em;
        height: 2em;
      }

      .svg-icon path,
      .svg-icon polygon,
      .svg-icon rect {
        fill: white;
      }

      .svg-icon circle {
        stroke: white;
        stroke-width: 1;
      }
      .bar_panier{
        background-color: #424558;
        display:flex;
        justify-content:space-around;
        padding:10px;
      }
      .bar_panier h2{
        margin:0;
        padding:0;
        color:white;
        width:30%;
        text-align:center;
      }
      .icon-panier{
        display:flex;
        flex-direction:column;
        justify-content:center;
        margin:0;
        padding:0;
        width:20%;
        text-align:center;
      }
      .icon-panier>p{
        padding:0;
        margin:0;
        font-size:0.8em;
        color:white;
        align-self:center;
      }
      .h2_user span{
        font-size:0.6em;
        margin-left:10px;
      }
      main form{
        display: flex;
        border-bottom: 1px solid gray;
      }
      main form>h2{
        width:30%;
        font-size: 1em;
        text-align:center;
        display:flex;
        flex-direction:column;
        justify-content:center;
      }
      main form>h2{
        align-self:center;
      }
      .button_supp{
        display:flex;
        flex-direction:column;
        justify-content:center;
        margin-left:5px;
      }
      .button_supp input{
        align-self:center;
        border:none;
       padding: 5px;
       border:1px solid #CC8E69;
       background-color:#CC8E69;
       color:white;
      }
      .button_supp input:hover{
        background-color:rgba(204, 142, 105, .80);
        cursor:pointer;
      }
      main form>div{
        display:flex;
        justify-content:space-between;
        width:70%;
      }
      .vide{
        width:50%;
        height:250px;
        margin:10px auto;
        display:flex;
        justify-content: center;
      }
      .vide>p{
        font-size:1em;
        text-align: center;
        align-self: center;
      }
      footer{
        background-color:#424558;
        color:white;
        padding:10px;
      }
      footer p{
        width:50%;
        margin:0 auto;
        padding:5px;
        text-align:center;
        font-size:0.8em;
      }
    </style>
  </head>
  <body>
    <?php
      include 'header.php';
    ?>
    <div class="bar_panier">
      <h2 class="h2_user">
        Panier : <span><?php echo $login;?></span>
      </h2>
      <div class="icon-panier">
        <p><?php echo count($tab_fav[$login]['cocktail']);?><p>
        <svg class="svg-icon" viewBox="0 0 20 20">
						<path fill="none" d="M17.671,13.945l0.003,0.002l1.708-7.687l-0.008-0.002c0.008-0.033,0.021-0.065,0.021-0.102c0-0.236-0.191-0.428-0.427-0.428H5.276L4.67,3.472L4.665,3.473c-0.053-0.175-0.21-0.306-0.403-0.306H1.032c-0.236,0-0.427,0.191-0.427,0.427c0,0.236,0.191,0.428,0.427,0.428h2.902l2.667,9.945l0,0c0.037,0.119,0.125,0.217,0.239,0.268c-0.16,0.26-0.257,0.562-0.257,0.891c0,0.943,0.765,1.707,1.708,1.707S10,16.068,10,15.125c0-0.312-0.09-0.602-0.237-0.855h4.744c-0.146,0.254-0.237,0.543-0.237,0.855c0,0.943,0.766,1.707,1.708,1.707c0.944,0,1.709-0.764,1.709-1.707c0-0.328-0.097-0.631-0.257-0.891C17.55,14.182,17.639,14.074,17.671,13.945 M15.934,6.583h2.502l-0.38,1.709h-2.312L15.934,6.583zM5.505,6.583h2.832l0.189,1.709H5.963L5.505,6.583z M6.65,10.854L6.192,9.146h2.429l0.19,1.708H6.65z M6.879,11.707h2.027l0.189,1.709H7.338L6.879,11.707z M8.292,15.979c-0.472,0-0.854-0.383-0.854-0.854c0-0.473,0.382-0.855,0.854-0.855s0.854,0.383,0.854,0.855C9.146,15.596,8.763,15.979,8.292,15.979 M11.708,13.416H9.955l-0.189-1.709h1.943V13.416z M11.708,10.854H9.67L9.48,9.146h2.228V10.854z M11.708,8.292H9.386l-0.19-1.709h2.512V8.292z M14.315,13.416h-1.753v-1.709h1.942L14.315,13.416zM14.6,10.854h-2.037V9.146h2.227L14.6,10.854z M14.884,8.292h-2.321V6.583h2.512L14.884,8.292z M15.978,15.979c-0.471,0-0.854-0.383-0.854-0.854c0-0.473,0.383-0.855,0.854-0.855c0.473,0,0.854,0.383,0.854,0.855C16.832,15.596,16.45,15.979,15.978,15.979 M16.917,13.416h-1.743l0.189-1.709h1.934L16.917,13.416z M15.458,10.854l0.19-1.708h2.218l-0.38,1.708H15.458z"></path>
				</svg>
      </div>
    </div>
    <main id="main_panier">
      <?php
        ?>
        <p class="log" style="display:none"><?php echo $login;?></p>
        <?php
        if(!empty($tab_fav[$login]['cocktail']))
        {
          foreach ($tab_fav[$login]['cocktail'] as $key => $value) {
            ?>
              <form action="t_panier.php" method="post"/>
                <h2 class="nom_rec"><span><?php echo $value; ?></span></h2>
                <div>
                  <div>
                    <?php affiche_in_pre($value, $Recettes, 3, 3); ?>
                  </div>
                  <p class="button_supp">
                    <input type="text" value="<?php echo $value; ?>" style="display:none"/>
                    <input type="button" class ="envoi" value="supprimer"/>
                  </p>
                </div>
              </form>
            <?php
          }
        }
        if(empty($tab_fav[$login]['cocktail']))
        {
          ?>
            <div class="vide">
              <p>Panier vide :-)</p>
            </div>
          <?php
        }
       ?>
    </main>
    <?php include "footer.php";?>
    <script src="jquery-3.3.1.min.js"></script>
    <script src="verification_formulaire.js"></script>
  </body>
</html>
