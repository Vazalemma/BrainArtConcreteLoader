Käivitamise õpetus:

1) Lae alla ja installi XAMPP (Sellega saad MySQL ja PHP kasutada oma arvuti peal)
2) Ava XAMPP ja aktiveeri Apache ja MySQL
3) Sinu server on C://xampp/htdocs kaustas, sinna saad ligi URLiga http://localhost/

4) Pane kõik alla laetud programmi failid uude kausta, nt. C://xampp/htdocs/concreteLoader
5) Ava URL http://localhost/concreteLoader/initial-setup.php
6) Ava URL http://localhost/concreteLoader/

Kõige hilisemalt avatud URLis saad sisestada kaubaauto nime ja maksimum koormuse.
Server valideerib andmed, ning tagastab parima laadungi kaubaauto peale lisamiseks.

* Kaubaauto laadung peab olema vahemikus 1000-8000 (KG)
* Betoonkaubad on vahemikus 55-5555 KG ning kõigi kaupade kaal kokku on 100000 KG

7) Ava URL http://localhost/concreteLoader/reset.php

See URL tühjendab andmebaasis kõik andmed ning genereerib uued kaubad.
Nii saad ülesande tulemust kontrollida mitmete erineva alusandmete põhjal.








Informatsioon:

Optimeerisin paljud kooditükid ning lisasin PHPDOC kõigile funktsioonidele.
Ma arvan et nüüd näeb see väga presenteeritav välja.
See näab välja nüüd nagu oleks keegi hoopiski teine selle ülesande lahendanud.

Nagu ma varem mainisin, oli mul alguses prioriteediks funktsionaalse osa töötamine
ning ajalimiidist kinni pidamine, nii et nüüd et mulle anti veidike rohkem aega,
sain ma kõik ilusaks formeerida, optimeerida, koondada ning loogiliselt üles ehitada.

Kõik mainitud parandused sain tehtud ning isegi veel rohkem.
Nüüd peaks see ülesanne olema adekvaatselt lahendatud ^^



Raskused:

- Rekursiivse algoritmi tegemine võttis veidike aega. Ma pole tükk aega selliseid
complex ülesandeid teinud, nii et ma pidin selle üle pead jällegi ragistama.
- Ülejäänud polnud nii hull. Tavaline PHP, mis seal muud ikka on.



Lisa/Optimeerimine:

- Kasutajaliidest saaks muidugi ikka optimeerida ning teha lisaleht kus kuvatakse
kaubaautod ning nendega relatsioonis olevad kaubad jne, aga see pole hetkel selle
ülesande põhimõte, nii et ma ei hakanud lisatunde UI tegemisele panustama.
- Järgmisele laadimisele kuuluvate kaupada printimine kasutajale on arvatavasti
veel võimalik ilusamaks teha, aga ma pole päris kindel mis parim meetod selleks
oleks, nii et see printimine on praegu nagu ta on.



Loodetavasti leiate selle lahenduse meelepäraseks :)




