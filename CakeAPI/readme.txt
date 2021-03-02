Szia!

A feladathoz nem írtam frontendet, mert nem szerepelt a leírásban.

A megoldásom két részből áll.

--------------------------------------------------------------------------------
API
--------------------------------------------------------------------------------
Az [api] könyvtárban található maga az api, amit feltöltöttem egy használaton
kívüli domain név alá a tárhelyemre.

Ha localhoston szeretnéd futtatni: 
1. A gyökérkönyvtárban találsz egy mysql dump-ot.
2. A database.php-ban tutod beállítani a mysql hozzáférést.
3. A [client] mappa config fájlban pedig az URL-t tudod átírni. 

--------------------------------------------------------------------------------
CLIENT
--------------------------------------------------------------------------------
Innen tutod meghívni az API-t.
Mivel nincs frontend, így a $_POST tömb helyett tesztadatokat lehet megadni a
[controllers] mappában lévő fájlokban.

-----------------
save.php
-----------------
Felvitel és módosítás. ID nélkül új rekord, ID-vel módosítás.

-----------------
delete.php
-----------------
Egy rekord törlése.

-----------------
view.php
-----------------
Egy-egy rekord megnézése és léptetés előre hátra megadott rendezés szerint.
(Itt kicsit bizonytalan voltam, hogy nem lapozásra gondoltok-e, de a leírásban
a léptetés szó szerepelt, így egyesével léptetem.)
Rendezés a kötelező adatok alapján (megnevezés és ár), illetve a módosítás dátuma,
de ezeket belinkeltem.

order: name / price / updated_at
desc: DESC (opcionális)

