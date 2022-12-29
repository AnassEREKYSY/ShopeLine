
<?php
        $bd = new PDO('mysql:host=localhost;dbname=pfe_db;', 'root', '',array(PDO::ATTR_ERRMODE=> PDO::ERRMODE_EXCEPTION));
        $bd->query("SET NAMES 'utf8'");
        $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    function getProduct($productname, $productprice,$marque, $productimg, $productid,$i){
        $element = " 
        <div id=\"conteneur-produits$productid \" >
                    <form action=\"Client.php?id=$productid\" method=\"post\" id=\"products-form$i\">
                        <div id=\"produit-dive$i\" >
                            <img src=\"$productimg\" alt=\"Image1\" id=\"image-prd$i\">
                            <div >
                                <h5 id=\"marque$i\">$marque</h5>
                                <h5 id=\"titre-prd$i\">$productname</h5>
                                <h5>
                                    <span id=\"prix$i\">$productprice DHS</span>
                                </h5>
                                <button type=\"submit\" id=\"ajtpanier-btn$i\" name=\"add\" value=\"$productid\"><i class=\"fas fa-shopping-cart\"></i></button>
                                <input type='hidden' name='product_id' value='$productid'>
                            </div>
                            <button type=\"submit\" id=\"view$productid\" name=\"view\" >Details</button>
                        </div>
                    </form>
        </div>      
        ";
        echo $element;  
    }
    function getProduct_Promotion($productname, $productprice,$newprice,$marque, $productimg, $productid,$i){
        $element = " 
        <div id=\"conteneur-produits$productid \" >
                    <form action=\"Client.php?id=$productid\" method=\"post\" id=\"products-form$i\">
                        <div id=\"produit-dive$i\" >
                            <img src=\"$productimg\" alt=\"Image1\" id=\"image-prd$i\">
                            <div >
                                <h5 id=\"marque$i\">$marque</h5>
                                <h5 id=\"titre-prd$i\">$productname</h5>
                                <h5>
                                    <small><strike id=\"prixp$i\">$productprice DHS</strike><small></small>
                                    <span id=\"prix$i\">$newprice DHS</span>
                                </h5>
                                <button type=\"submit\" id=\"ajtpanier-btn$i\" name=\"add\" value=\"$productid\"><i class=\"fas fa-shopping-cart\"></i></button>
                                <input type='hidden' name='product_id' value='$productid'>
                            </div>
                            <button type=\"submit\" id=\"view$productid\" name=\"view\" >Details</button>
                        </div>
                    </form>
        </div>      
        ";
        echo $element;  
    }
    function getProductmenu($productname, $productprice,$marque, $productimg, $productid,$i){
        $element = " 
        <div id=\"conteneur-produits$productid \" >
                    <form action=\"menu_produit.php?id1=$productid\" method=\"GET\" id=\"products-form$i\">
                        <div id=\"produit-dive$i\" >
                            <img src=\"$productimg\" alt=\"Image1\" id=\"image-prd$i\">
                            <div >
                                <h5 id=\"marque$i\">$marque</h5>
                                <h5 id=\"titre-prd$i\">$productname</h5>
                                <h5>
                                    <span id=\"prix$i\">$productprice DHS</span>
                                </h5>
                                <button type=\"submit\" id=\"ajtpanier-btn$i\" name=\"add1\" value=\"$productid\"><i class=\"fas fa-shopping-cart\"></i></button>
                                <input type='hidden' name='produit_id' value='$productid'>
                            </div>
                            <button type=\"submit\" id=\"view$productid\" name=\"view\" >Details</button>
                        </div>
                    </form>
                </div>      
        ";
        echo $element;
        
    }
    function getProductmenu_promotion($productname, $productprice,$newprice,$marque, $productimg, $productid,$i){
        $element = " 
        <div id=\"conteneur-produits$productid \" >
                    <form action=\"menu_produit.php?id1=$productid\" method=\"GET\" id=\"products-form$i\">
                        <div id=\"produit-dive$i\" >
                            <img src=\"$productimg\" alt=\"Image1\" id=\"image-prd$i\">
                            <div >
                                <h5 id=\"marque$i\">$marque</h5>
                                <h5 id=\"titre-prd$i\">$productname</h5>
                                <h5>
                                    <strike id=\"prixp$i\">$productprice DHS</strike>
                                </h5>
                                <h5>
                                    <span id=\"prix$i\">$newprice DHS</span>
                                </h5>
                                <button type=\"submit\" id=\"ajtpanier-btn$i\" name=\"add1\" value=\"$productid\"><i class=\"fas fa-shopping-cart\"></i></button>
                                <input type='hidden' name='produit_id' value='$productid'>
                            </div>
                            <button type=\"submit\" id=\"view$productid\" name=\"view\" >Details</button>
                        </div>
                    </form>
                </div>      
        ";
        echo $element;
        
    }
    function getProductmenu_pp($productname, $productprice,$marque, $productimg, $productid,$i){
        $element = " 
        <div id=\"conteneur-produits$productid \" >
                    <form action=\"menu_produit1.php?id2=$productid\" method=\"POST\" id=\"products-form$i\">
                        <div id=\"produit-dive$i\" >
                            <img src=\"$productimg\" alt=\"Image1\" id=\"image-prd$i\">
                            <div >
                                <h5 id=\"marque$i\">$marque</h5>
                                <h5 id=\"titre-prd$i\">$productname</h5>
                                <h5>
                                    <span id=\"prix$i\">$productprice DHS</span>
                                </h5>
                                <button type=\"submit\" id=\"ajtpanier-btn$i\" name=\"add1\" value=\"$productid\"><i class=\"fas fa-shopping-cart\"></i></button>
                                <input type='hidden' name='produit_id' value='$productid'>
                            </div>
                            <button type=\"submit\" id=\"view$productid\" name=\"view1\" >Details</button>
                        </div>
                    </form>
                </div>      
        ";
        echo $element;
        
    }
    function getProductmenu_pp_promotion($productname, $productprice,$newprice,$marque, $productimg, $productid,$i){
        $element = " 
        <div id=\"conteneur-produits$productid \" >
                    <form action=\"menu_produit1.php?id2=$productid\" method=\"POST\" id=\"products-form$i\">
                        <div id=\"produit-dive$i\" >
                            <img src=\"$productimg\" alt=\"Image1\" id=\"image-prd$i\">
                            <div >
                                <h5 id=\"marque$i\">$marque</h5>
                                <h5 id=\"titre-prd$i\">$productname</h5>
                                <h5>
                                    <strike id=\"prixp$i\">$productprice DHS</strike>
                                </h5>
                                <h5>
                                    <span id=\"prix$i\">$newprice DHS</span>
                                </h5>
                                <button type=\"submit\" id=\"ajtpanier-btn$i\" name=\"add1\" value=\"$productid\"><i class=\"fas fa-shopping-cart\"></i></button>
                                <input type='hidden' name='produit_id' value='$productid'>
                            </div>
                            <button type=\"submit\" id=\"view$productid\" name=\"view1\" >Details</button>
                        </div>
                    </form>
                </div>      
        ";
        echo $element;
        
    }
    function Productdetails($img,$img1,$img2,$img3,$cat,$title,$details,$price,$id){
        $element="
            <form action=\"details.php?action=add&id2=$id\" method=\"post\" id=\"products-form\">
                <div class=\"small-container single-product\">
                    <div id=\"diveimg\"><img src=\"$img\" class=\"big-img\" id=\"ProductImg\"></div>
                    <div class=\"small-img-div\">
                        <div class=\"div1\"><img src=\"$img1\" class=\"small-img\"></div>
                        <div class=\"div2\"><img src=\"$img2\" class=\"small-img\"></div>
                        <div class=\"div3\"><img src=\"$img3\" class=\"small-img\"></div>  
                    </div>
                        <div class=\"col-2\">
                            <p>$cat</p>
                            <h1>$title</h1>
                            <h4>$price dhs</h4>
                            <input type=\"hidden\" name=\"idhide\" value=\"$id\">
                            <button type=\"submit\" class=\"btn\" name=\"add\">Ajouter<i class=\"fas fa-shopping-cart\"></i></button>
                            <h3>Détails <i class=\"fas fa-indent\"></i></h3>
                            <br>
                            <p>$details</p>
                        </div>
                </div>
            </form>    
            <script>
                var ProductImg =document.getElementById(\"ProductImg\");
                var SmallImg =document.getElementsByClassName(\"small-img\");
                SmallImg[0].onclick=function(){
                    imag=ProductImg.src;
                    ProductImg.src=SmallImg[0].src;
                    SmallImg[0].src=imag;
                }
                SmallImg[1].onclick=function(){
                    imag=ProductImg.src;
                    ProductImg.src=SmallImg[1].src;
                    SmallImg[1].src=imag;
                }
                SmallImg[2].onclick=function(){
                    imag=ProductImg.src;
                    ProductImg.src=SmallImg[2].src;
                    SmallImg[2].src=imag;
                }
            </script>
        ";
        echo $element;
    }
    function Productdetails_promotion($img,$img1,$img2,$img3,$cat,$title,$details,$price,$newprice,$id){
        $element="
            <form action=\"details.php?action=add&id2=$id\" method=\"post\" id=\"products-form\">
                <div class=\"small-container single-product\">
                    <div id=\"diveimg\"><img src=\"$img\" class=\"big-img\" id=\"ProductImg\"></div>
                    <div class=\"small-img-div\">
                        <div class=\"div1\"><img src=\"$img1\" class=\"small-img\"></div>
                        <div class=\"div2\"><img src=\"$img2\" class=\"small-img\"></div>
                        <div class=\"div3\"><img src=\"$img3\" class=\"small-img\"></div>  
                    </div>
                        <div class=\"col-2\">
                            <p>$cat</p>
                            <h1>$title</h1>
                            <h4>$newprice dhs</h4>
                            <strike><h4>$price dhs</h4></strike>
                            <input type=\"hidden\" name=\"idhide\" value=\"$id\">
                            <button type=\"submit\" class=\"btn\" name=\"add\">Ajouter<i class=\"fas fa-shopping-cart\"></i></button>
                            <h3>Détails <i class=\"fas fa-indent\"></i></h3>
                            <br>
                            <p>$details</p>
                        </div>
                </div>
            </form>    
            <script>
                var ProductImg =document.getElementById(\"ProductImg\");
                var SmallImg =document.getElementsByClassName(\"small-img\");
                SmallImg[0].onclick=function(){
                    imag=ProductImg.src;
                    ProductImg.src=SmallImg[0].src;
                    SmallImg[0].src=imag;
                }
                SmallImg[1].onclick=function(){
                    imag=ProductImg.src;
                    ProductImg.src=SmallImg[1].src;
                    SmallImg[1].src=imag;
                }
                SmallImg[2].onclick=function(){
                    imag=ProductImg.src;
                    ProductImg.src=SmallImg[2].src;
                    SmallImg[2].src=imag;
                }
            </script>
        ";
        echo $element;
    }
    function Productdetails_pp($img,$img1,$img2,$img3,$cat,$title,$details,$price,$id){
        $element="
            <form action=\"details1.php?action=add&id2=$id\" method=\"post\" id=\"products-form\">
                <div class=\"small-container single-product\">
                    <div id=\"diveimg\"><img src=\"$img\" class=\"big-img\" id=\"ProductImg\"></div>
                    <div class=\"small-img-div\">
                        <div class=\"div1\"><img src=\"$img1\" class=\"small-img\"></div>
                        <div class=\"div2\"><img src=\"$img2\" class=\"small-img\"></div>
                        <div class=\"div3\"><img src=\"$img3\" class=\"small-img\"></div>  
                    </div>
                        <div class=\"col-2\">
                            <p>$cat</p>
                            <h1>$title</h1>
                            <h4>$price dhs</h4>
                            <input type=\"hidden\" name=\"idhide\" value=\"$id\">
                            <button type=\"submit\" class=\"btn\" name=\"add\">Ajouter<i class=\"fas fa-shopping-cart\"></i></button>
                            <h3>Détails <i class=\"fas fa-indent\"></i></h3>
                            <br>
                            <p>$details</p>
                        </div>
                </div>
            </form>    
            <script>
                var ProductImg =document.getElementById(\"ProductImg\");
                var SmallImg =document.getElementsByClassName(\"small-img\");
                SmallImg[0].onclick=function(){
                    imag=ProductImg.src;
                    ProductImg.src=SmallImg[0].src;
                    SmallImg[0].src=imag;
                }
                SmallImg[1].onclick=function(){
                    imag=ProductImg.src;
                    ProductImg.src=SmallImg[1].src;
                    SmallImg[1].src=imag;
                }
                SmallImg[2].onclick=function(){
                    imag=ProductImg.src;
                    ProductImg.src=SmallImg[2].src;
                    SmallImg[2].src=imag;
                }
            </script>
        ";
        echo $element;
    }
    function Productdetails_pp_Promotion($img,$img1,$img2,$img3,$cat,$title,$details,$price,$newprice,$id){
        $element="
            <form action=\"details1.php?action=add&id2=$id\" method=\"post\" id=\"products-form\">
                <div class=\"small-container single-product\">
                    <div id=\"diveimg\"><img src=\"$img\" class=\"big-img\" id=\"ProductImg\"></div>
                    <div class=\"small-img-div\">
                        <div class=\"div1\"><img src=\"$img1\" class=\"small-img\"></div>
                        <div class=\"div2\"><img src=\"$img2\" class=\"small-img\"></div>
                        <div class=\"div3\"><img src=\"$img3\" class=\"small-img\"></div>  
                    </div>
                        <div class=\"col-2\">
                            <p>$cat</p>
                            <h1>$title</h1>
                            <h4>$newprice dhs</h4>
                            <strike><h4>$price dhs</h4></strike>
                            <input type=\"hidden\" name=\"idhide\" value=\"$id\">
                            <button type=\"submit\" class=\"btn\" name=\"add\">Ajouter<i class=\"fas fa-shopping-cart\"></i></button>
                            <h3>Détails <i class=\"fas fa-indent\"></i></h3>
                            <br>
                            <p>$details</p>
                        </div>
                </div>
            </form>    
            <script>
                var ProductImg =document.getElementById(\"ProductImg\");
                var SmallImg =document.getElementsByClassName(\"small-img\");
                SmallImg[0].onclick=function(){
                    imag=ProductImg.src;
                    ProductImg.src=SmallImg[0].src;
                    SmallImg[0].src=imag;
                }
                SmallImg[1].onclick=function(){
                    imag=ProductImg.src;
                    ProductImg.src=SmallImg[1].src;
                    SmallImg[1].src=imag;
                }
                SmallImg[2].onclick=function(){
                    imag=ProductImg.src;
                    ProductImg.src=SmallImg[2].src;
                    SmallImg[2].src=imag;
                }
            </script>
        ";
        echo $element;
    }
    function getProduct_pp($productname, $productprice,$marque,$productimg, $productid,$i){
        $element = " 
        <div id=\"conteneur-produits$productid \" >
                    <form action=\"Page_Principale.php?id=$productid\" method=\"POST\" id=\"products-form$i\">
                        <div id=\"produit-dive$i\">
                            <img src=\"$productimg\" alt=\"Image1\" id=\"image-prd$i\">
                            <div >
                                <h5 id=\"marque$i\">$marque</h5>
                                <h5 id=\"titre-prd$i\">$productname</h5>
                                <h5>
                                    <span id=\"prix$i\">$productprice DHS</span>
                                </h5>
                                <input type='hidden' name='produit_id' value='$productid'>
                                <button type=\"submit\" id=\"ajtpanier-btn$i\" name=\"add\" value=\"$productid\"><i class=\"fas fa-shopping-cart\"></i></button>
                                <button type=\"submit\" id=\"view$productid\" name=\"view1\" >Details</button>
                            </div>
                        </div>
                    </form>
                </div>      
        ";
        echo $element;
    }
    function getProduct_pp_Promotion($productname, $productprice,$newprice,$marque,$productimg, $productid,$i){
        $element = " 
        <div id=\"conteneur-produits$productid \" >
                    <form action=\"Page_Principale.php?id=$productid\" method=\"POST\" id=\"products-form$i\">
                        <div id=\"produit-dive$i\" >
                            <img src=\"$productimg\" alt=\"Image1\" id=\"image-prd$i\">
                            <div >
                                <h5 id=\"marque$i\">$marque</h5>
                                <h5 id=\"titre-prd$i\">$productname</h5>
                                <h5>
                                    <small><strike id=\"prixp$i\">$productprice DHS</strike><small></small>
                                    <span id=\"prix$i\">$newprice DHS</span>
                                </h5>
                                <button type=\"submit\" id=\"ajtpanier-btn$i\" name=\"add\" value=\"$productid\"><i class=\"fas fa-shopping-cart\"></i></button>
                                <input type='hidden' name='produit_id' value='$productid'>
                            </div>
                            <button type=\"submit\" id=\"view$productid\" name=\"view1\" >Details</button>
                        </div>
                    </form>
        </div>      
        ";
        echo $element; 
    }

    function getData(){
        $bd = new PDO('mysql:host=localhost;dbname=pfe_db;', 'root', '',array(PDO::ATTR_ERRMODE=> PDO::ERRMODE_EXCEPTION));
        $bd->query("SET NAMES 'utf8'");
        $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $requete=$bd->prepare('SELECT * FROM PRODUIT ORDER BY DATE_ENTREE DESC');
        $requete->execute();
        $nbligne=$requete->rowcount();
        if($nbligne!=0){
            return $requete;
        }
    }
    
    function getDataPromotion(){
        $bd = new PDO('mysql:host=localhost;dbname=pfe_db;', 'root', '',array(PDO::ATTR_ERRMODE=> PDO::ERRMODE_EXCEPTION));
        $bd->query("SET NAMES 'utf8'");
        $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $requete=$bd->prepare('SELECT * FROM PRODUIT WHERE ID_PRODUIT IN(SELECT ID_PRODUIT FROM PROMOTIONS)');
        $requete->execute();
        $nbligne=$requete->rowcount();
        if($nbligne!=0){
            return $requete;
        }
    }

    function getProduit_nouv(){
        $bd = new PDO('mysql:host=localhost;dbname=pfe_db;', 'root', '',array(PDO::ATTR_ERRMODE=> PDO::ERRMODE_EXCEPTION));
        $bd->query("SET NAMES 'utf8'");
        $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $requete=$bd->prepare('SELECT * FROM PRODUIT GROUP BY CATEGORIE HAVING(MAX(PRIX_VENTE))');
        $requete->execute();
        $nbligne=$requete->rowcount();
        if($nbligne!=0){
            return $requete;
        }
    }
    function Produit_nouv($img,$lib,$price,$id){
        $element="              
            <li class=\"item\">
                <form class=\"box\">
                    <div class=\"slide-image\">
                        <img src=\"$img\" >
                        <div class=\"overlay\">
                            <input type=\"submit\" name=\"acheter\" value=\"Acheter\" class=\"buy-btn\">
                        </div>
                    </div>
                    <div class=\"detail-box\">
                        <div class=\"type\">
                            <input type=\"text\" name=\"lib\" value=\"$lib\" class=\"type\">
                            <input type=\"text\" name=\"price\" value=\"$price DHS\" class=\"price\">
                        </div>
                    </div>
                </form>
            </li>
        ";
        echo $element;
    }
    function panierProducts($productimg, $productname, $productprice,$marque,$productdesc, $productid,$qte){
        $element = "
        <form action=\"panier.php?action=remove&id=$productid\" method=\"post\" class=\"panier-form$productid\">
            <div class=\"panier-dive$productid\">
                <img src=$productimg alt=\"Image1\">
                <div>
                    <div class=\"prd-marq$productid\">$marque</div>    <br>
                    <div class=\"prd-div$productid\">$productname</div>    <br>
                    <div class=\"desc-div$productid\">$productdesc</div>    <br>
                    <div class=\"prix-div$productid\">$productprice dh</div> <br>
                    <button type=\"submit\" class=\"remove-btn$productid\" name=\"remove\"><i class=\"fas fa-solid fa-trash\"></i></button>
                    <button type=\"submit\" class=\"acheter$productid\" name=\"acheter\" id=\"acheter\">Acheter <i class=\"fas fa-solid fa-euro-sign\"></i></button><br>
                </div>
                <div class=\"qte-div$productid\">
                    <div class=\"qte-div$productid\">
                    <input type=\"number\" value=\"$qte\" class=\"qte-input$productid\" name=\"qte-prd\" id=\"qte-p\">                                    
                    </div>
                </div>
            </div>
            <script>
                function moins(){
                    n = document.getElementById('qte-p');
                    n.value = n.value-1;
                }
                function plus(){
                    n = document.getElementById('qte-p');
                    n.value = n.value+1;
                }
            </script>
        </form>
        ";
        echo  $element;  
        if(isset($_POST['qte-prd'])){
            $qte=$_POST['qte-prd'];
            return $qte;
        }   
    }
    function panierProducts_promotion($productimg, $productname, $productprice,$newprice,$marque,$productdesc, $productid,$qte){
        $element = "
        <form action=\"panier.php?action=remove&id=$productid\" method=\"post\" class=\"panier-form$productid\">
            <div class=\"panier-dive$productid\">
                <img src=$productimg alt=\"Image1\">
                <div>
                    <div class=\"prd-marq$productid\">$marque</div>    <br>
                    <div class=\"prd-div$productid\">$productname</div>    <br>
                    <div class=\"desc-div$productid\">$productdesc</div>    <br>
                    <div class=\"prix-div$productid\">$newprice dh</div> <br>
                    <small><strike class=\"prixp-div$productid\">$productprice dh</strike></small> <br>
                    <button type=\"submit\" class=\"remove-btn$productid\" name=\"remove\"><i class=\"fas fa-solid fa-trash\"></i></button>
                    <button type=\"submit\" class=\"acheter$productid\" name=\"acheter\" id=\"acheter\">Acheter <i class=\"fas fa-solid fa-euro-sign\"></i></button><br>
                </div>
                <div class=\"qte-div$productid\">
                    <div class=\"qte-div$productid\">
                    <input type=\"number\" value=\"$qte\" class=\"qte-input$productid\" name=\"qte-prd\" id=\"qte-p\">                                    
                    </div>
                </div>
            </div>
            <script>
                function moins(){
                    n = document.getElementById('qte-p');
                    n.value = n.value-1;
                }
                function plus(){
                    n = document.getElementById('qte-p');
                    n.value = n.value+1;
                }
            </script>
        </form>
        ";
        echo  $element;     
    }
    function getProducts_panier(){
        $idclt=htmlspecialchars($_SESSION['id']);
        $bd = new PDO('mysql:host=localhost;dbname=pfe_db;', 'root', '',array(PDO::ATTR_ERRMODE=> PDO::ERRMODE_EXCEPTION));
        $bd->query("SET NAMES 'utf8'");
        $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $requete=$bd->prepare('SELECT PANIER.QTE,PRODUIT.ID_PRODUIT,PRODUIT.LIBELLE,PRODUIT.PRIX_VENTE,PRODUIT.IMAGE,PRODUIT.DESCRIPTION_P ,PRODUIT.MARQUE FROM PRODUIT , PANIER WHERE PRODUIT.ID_PRODUIT=PANIER.ID_PRODUIT AND PANIER.ID_CLT=?');
        $requete->execute(array($idclt));
        $nb=$requete->rowcount();
        if($nb!=0){
            return $requete;
        }else{
            return NULL;
        }
        
    }
    function countProducts_panier(){
        $bd = new PDO('mysql:host=localhost;dbname=pfe_db;', 'root', '',array(PDO::ATTR_ERRMODE=> PDO::ERRMODE_EXCEPTION));
        $bd->query("SET NAMES 'utf8'");
        $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $idclt=htmlspecialchars($_SESSION['id']);       
        $requete=$bd->prepare('SELECT * FROM PANIER WHERE ID_CLT=?');
        $requete->execute(array($idclt));
        $nb=$requete->rowcount();
        if($nb!=0){
            $requete=$bd->prepare('SELECT COUNT(*) AS NB_PRD FROM PANIER WHERE ID_CLT=?');
            $requete->execute(array($idclt));
            $nb=$requete->rowcount();
            $nbligne=$requete->fetch();
            return intval($nbligne['NB_PRD']);
        }
        else{
            return 0;
        } 
    }

    function Commandes($idcmd,$productimg, $productname,$productdesc, $productid,$qte,$prt,$datcmd,$statut,$datliv){
        $element = "
        <form action=\"commande.php?action=remove&id=$productid\" method=\"post\" class=\"cmd-form-$idcmd\">
            <div class=\"cmd-dive-$idcmd\">
                <img src=$productimg alt=\"Image1\">
                <div class=\"prd-div-$idcmd\">$productname</div>    <br>
                <div class=\"desc-div-$idcmd\">$productdesc</div>    <br>
                <div class=\"info-$idcmd\"> 
                    <div class=\"sbinfo1-$idcmd\"> 
                        <label >Numéro du commande: </label><input type=\"text\" value=\" $idcmd\" class=\"idcmd-input\" name=\"idcmd\" id=\"idcmd\" size=\"30\"  disabled=\"disabled\">  <br>
                        <label >Quantité: </label><input type=\"text\" value=\" $qte\" class=\"qte-input\" name=\"qte-prd\" id=\"qte-p\" disabled=\"disabled\">  <br>
                        <label >Prix total: </label><input type=\"text\" value=\" $prt dhs\" class=\"prt-input\" name=\"pt\" id=\"pt\" disabled=\"disabled\">    <br>                                
                        <label >Date de commande: </label><input type=\"text\" value=\"$datcmd\" class=\"datcmd-input\" name=\"datcmd\" id=\"datcmd\" disabled=\"disabled\">   <br>                                 
                    </div>
                    <div class=\"sbinfo2-$idcmd\"> 
                        <label >Statut: </label><input type=\"text\" value=\" $statut\" class=\"statut-input\" name=\"statut\" id=\statut\" disabled=\"disabled\">              <br>                      
                        <label >Date de livraison: </label><input type=\"text\" value=\"$datliv\" class=\"datliv-input\" name=\"datliv\" id=\"datliv\" disabled=\"disabled\">  <br>                                                                    
                    </div>
                </div>
            </div>
        </form>
        ";
        echo  $element;   
    }
    function getcommandes(){
        $bd = new PDO('mysql:host=localhost;dbname=pfe_db;', 'root', '',array(PDO::ATTR_ERRMODE=> PDO::ERRMODE_EXCEPTION));
        $bd->query("SET NAMES 'utf8'");
        $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $idclt=htmlspecialchars($_SESSION['id']);
        $requete=$bd->prepare('SELECT PRODUIT.ID_PRODUIT,PRODUIT.LIBELLE,PRODUIT.PRIX_VENTE,PRODUIT.DESCRIPTION_P,PRODUIT.IMAGE,
                                      COMMANDER.ID_CMD,COMMANDER.QUANTITE_CMD,COMMANDER.PRIX_TOTAL,COMMANDER.DATE_CMD,COMMANDER.STATUT,
                                      COMMANDER.DATE_LIVRAISON 
                               FROM PRODUIT , COMMANDER 
                               WHERE PRODUIT.ID_PRODUIT=COMMANDER.ID_PRODUIT AND COMMANDER.ID_CLT=? AND COMMANDER.ID_EMPLOYE=1');
        $requete->execute(array($idclt));
        $nb=$requete->rowcount();
        if($nb!=0){
            return $requete;
        }else{
            return NULL;
        }
    }
    function countCommande(){
        $bd = new PDO('mysql:host=localhost;dbname=pfe_db;', 'root', '',array(PDO::ATTR_ERRMODE=> PDO::ERRMODE_EXCEPTION));
        $bd->query("SET NAMES 'utf8'");
        $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $idclt=htmlspecialchars($_SESSION['id']);
        $requete=$bd->prepare('SELECT * FROM commander WHERE ID_CLT=?');
        $requete->execute(array($idclt));
        $nb=$requete->rowcount();
        if($nb!=0){
            $requete=$bd->prepare('SELECT COUNT(*) AS NB_PRD FROM commander WHERE ID_CLT=?');
            $requete->execute(array($idclt));
            $nb=$requete->rowcount();
            $nbligne=$requete->fetch();
            return intval($nbligne['NB_PRD']);
        }
        else{
            return 0;
        }  
    }

    function getmenu_product($productname, $productprice, $productimg,$productdesc, $productid,$i){
        $element = " 
        <div id=\"conteneur-produits$productid \" >
                    <form action=\"menu_produit.php?id=$productid\" method=\"post\" id=\"products-form$i\">
                        <div id=\"produit-dive$i\" class=\"dive-prd\">
                            <img src=\"$productimg\" alt=\"Image1\" id=\"image-prd$i\">
                            <div >
                                <h5 id=\"titre-prd$i\">$productname</h5>
                                <p id=\"description$i\">
                                    $productdesc
                                </p>
                                <h5>
                                    <span id=\"prix$i\">$productprice DHS</span>
                                </h5>
                                <button type=\"submit\" id=\"ajtpanier-btn$i\" name=\"add\" value=\"$productid\">Ajouter<i class=\"fas fa-shopping-cart\"></i></button>
                                <input type='hidden' name='prd_id' value='$productid'>
                            </div>
                            <button type=\"submit\" id=\"view$i\" name=\"view\" >View</button>
                        </div>
                    </form>
                </div>      
        ";
        echo $element;
        
    }
    function getproduit_menu($marque,$cat){
        $bd = new PDO('mysql:host=localhost;dbname=pfe_db;', 'root', '',array(PDO::ATTR_ERRMODE=> PDO::ERRMODE_EXCEPTION));
        $bd->query("SET NAMES 'utf8'");
        $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $requete=$bd->prepare('SELECT * FROM PRODUIT WHERE UPPER(CATEGORIE)=? AND LOWER(MARQUE) = LOWER(?)');
        $requete->execute(array($cat,$marque));
        $nbligne=$requete->rowcount();
        if($nbligne!=0){
            return $requete;
        }
    }
    function getproduit_recherche($marque,$name){
        $bd = new PDO('mysql:host=localhost;dbname=pfe_db;', 'root', '',array(PDO::ATTR_ERRMODE=> PDO::ERRMODE_EXCEPTION));
        $bd->query("SET NAMES 'utf8'");
        $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $requete=$bd->prepare('SELECT * FROM PRODUIT WHERE UPPER(MARQUE) LIKE UPPER(?) OR UPPER(LIBELLE) LIKE UPPER(?)');
        $requete->execute(array("%$marque","%$name%"));
        $nbligne=$requete->rowcount();
        if($nbligne!=0){
            return $requete;
        }
    }

    function countAdmin($table){
        $bd = new PDO('mysql:host=localhost;dbname=pfe_db;', 'root', '',array(PDO::ATTR_ERRMODE=> PDO::ERRMODE_EXCEPTION));
        $bd->query("SET NAMES 'utf8'");
        $tab=strtoupper($table);
        $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);     
            $requete=$bd->prepare('SELECT COUNT(*) AS NB FROM '.$tab);
            $requete->execute();
            $nbligne=$requete->fetch();
            return intval($nbligne['NB']);
    }


    function getProductPromotion($productname,$productprice,$newprice,$marque, $productimg, $productid,$i){
        $element = " 
        <div id=\"conteneur-produits$productid \" >
                    <form action=\"promotions.php?id1=$productid\" method=\"GET\" id=\"products-form$i\">
                        <div id=\"produit-dive$i\" >
                            <img src=\"$productimg\" alt=\"Image1\" id=\"image-prd$i\">
                            <div >
                                <h5 id=\"marque$i\">$marque</h5>
                                <h5 id=\"titre-prd$i\">$productname</h5>
                                <h5>
                                    <small><strike id=\"prixp$i\">$productprice DHS</strike><small></small>
                                    <span id=\"prix$i\">$newprice DHS</span>
                                </h5>
                                <button type=\"submit\" id=\"ajtpanier-btn$i\" name=\"add11\" value=\"$productid\"><i class=\"fas fa-shopping-cart\"></i></button>
                                <input type='hidden' name='produit_id' value='$productid'>
                            </div>
                            <button type=\"submit\" id=\"view$productid\" name=\"view11\" >Details</button>
                        </div>
                    </form>
                </div>      
        ";
        echo $element;
        
    }
    function getProductPromotion_PP($productname,$productprice,$newprice,$marque, $productimg, $productid,$i){
        $element = " 
        <div id=\"conteneur-produits$productid \" >
                    <form action=\"promotions.php?id1=$productid\" method=\"GET\" id=\"products-form$i\">
                        <div id=\"produit-dive$i\" >
                            <img src=\"$productimg\" alt=\"Image1\" id=\"image-prd$i\">
                            <div >
                                <h5 id=\"marque$i\">$marque</h5>
                                <h5 id=\"titre-prd$i\">$productname</h5>
                                <h5>
                                    <small><strike id=\"prixp$i\">$productprice DHS</strike><small></small>
                                    <span id=\"prix$i\">$newprice DHS</span>
                                </h5>
                                <a href=\"connexion.php\" id=\"ajtpanier-btn$i\" name=\"add\"><span id=\"ajt$i\"><i class=\"fas fa-shopping-cart\"></i></span></a>
                                <input type='hidden' name='produit_id' value='$productid'>
                            </div>
                            <button type=\"submit\" id=\"view$productid\" name=\"view11\" >Details</button>
                        </div>
                    </form>
                </div>      
        ";
        echo $element;
        
    }
?>
