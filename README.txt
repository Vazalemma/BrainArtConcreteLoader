K�ivitamise �petus:

1) Lae alla ja installi XAMPP (Sellega saad MySQL ja PHP kasutada oma arvuti peal)
2) Ava XAMPP ja aktiveeri Apache ja MySQL
3) Sinu server on C://xampp/htdocs kaustas, sinna saad ligi URLiga http://localhost/

4) Pane k�ik alla laetud programmi failid uude kausta, nt. C://xampp/htdocs/concreteLoader
5) Ava URL http://localhost/concreteLoader/initial-setup.php
6) Ava URL http://localhost/concreteLoader/

K�ige hilisemalt avatud URLis saad sisestada kaubaauto nime ja maksimum koormuse.
Server valideerib andmed, ning tagastab parima laadungi kaubaauto peale lisamiseks.

* Kaubaauto laadung peab olema vahemikus 1000-8000 (KG)
* Betoonkaubad on vahemikus 55-5555 KG ning k�igi kaupade kaal kokku on 100000 KG

7) Ava URL http://localhost/concreteLoader/reset.php

See URL t�hjendab andmebaasis k�ik andmed ning genereerib uued kaubad.
Nii saad �lesande tulemust kontrollida mitmete erineva alusandmete p�hjal.








Informatsioon:

Optimeerisin paljud koodit�kid ning lisasin PHPDOC k�igile funktsioonidele.
Ma arvan et n��d n�eb see v�ga presenteeritav v�lja.
See n�ab v�lja n��d nagu oleks keegi hoopiski teine selle �lesande lahendanud.

Nagu ma varem mainisin, oli mul alguses prioriteediks funktsionaalse osa t��tamine
ning ajalimiidist kinni pidamine, nii et n��d et mulle anti veidike rohkem aega,
sain ma k�ik ilusaks formeerida, optimeerida, koondada ning loogiliselt �les ehitada.

K�ik mainitud parandused sain tehtud ning isegi veel rohkem.
N��d peaks see �lesanne olema adekvaatselt lahendatud ^^



Raskused:

- Rekursiivse algoritmi tegemine v�ttis veidike aega. Ma pole t�kk aega selliseid
complex �lesandeid teinud, nii et ma pidin selle �le pead j�llegi ragistama.
- �lej��nud polnud nii hull. Tavaline PHP, mis seal muud ikka on.



Lisa/Optimeerimine:

- Kasutajaliidest saaks muidugi ikka optimeerida ning teha lisaleht kus kuvatakse
kaubaautod ning nendega relatsioonis olevad kaubad jne, aga see pole hetkel selle
�lesande p�him�te, nii et ma ei hakanud lisatunde UI tegemisele panustama.
- J�rgmisele laadimisele kuuluvate kaupada printimine kasutajale on arvatavasti
veel v�imalik ilusamaks teha, aga ma pole p�ris kindel mis parim meetod selleks
oleks, nii et see printimine on praegu nagu ta on.



Loodetavasti leiate selle lahenduse meelep�raseks :)




