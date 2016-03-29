# Humbolt server
===================

## O projektu
===================

API server za CSMP i GPSS simulacije.

Projekat je realizovan korišćenjem [Laravel framework-a](http://laravel.com/).

Ovaj projekat u sebi sadrži verziju klijenta [Humbolt client](https://bitbucket.org/humbolt/humbolt_client) ali je API napravljen
tako da može da se koristi nezavisno od klijenta.

## Pokretanje projekta
===================

Da biste pokrenuli projekat morate imati globalno instaliran [composer](https://getcomposer.org/).

Nakon kloniranja projekta potrebno je instalirati biblioteke pokretanjem komande `composer install` u folderu projekta.

Potrebno je zatim napraviti kopiju fajla .env.example i preimenovati ga u .env.

U fajlu .env je potrebno definisati konfiguraciju okruženja, debug i parametre baze.

Potrebno je kreirati bazu podataka čije smo parametre uneli u fajl .env.

Za produkciono okruženje postaviti

`APP_ENV=production
 APP_DEBUG=false`

 APP_KEY se generiše pokretanjem komande `php artisan key:generate` u folderu projekta.

 Zatim je potrebno migrirati bazu pokretanjem komande `php artisan migrate` čime se kreiraju neophodne tabele u bazi.

 U folderu public se nalaze se javni fajlovi kojima server direktno pristupa, potrebno je napraviti virtuelni host na folder humbolt_server/public.

 Ovde možete pronaći uputstvo za kreiranje [virtual host-a](http://www.techrepublic.com/blog/smb-technologist/create-virtual-hosts-in-a-wamp-server/) na wamp serveru.

## API
===================

### PUBLIC ROUTES

#### Autentikacija
* `POST /login` - vraća token ako je autentikacija uspešna
    Request
    {
        name: string,
        password: string
    }
    Response
    {
        token: string
    }

#### CSMP
* `GET api/csmp/blocks` - vraća listu dostupnih blokova za simulaciju
    Response
        IMetaJSONBlock[]
* `GET api/csmp/integrationmethods` - vraća listu dostupnih metoda integracije
    Response
        IMetaJSONMethod[]

### PROTECTED ROUTES

#### CSMP
* `POST /csmp/simulate` - pokreće simulaciju, u telu zahteva očekuje IJSONSimulation objekat
    Request
        IJSONSimulation
    Response
        number[][]
* `GET /csmp/simulation` - vraća listu sačuvanih simulacija za korisnika
    Response
        {
        id: number,
        description: string
        }[]
* `GET /csmp/simulation/:id` - vraća simulaciju za zadati id
    Response
        IJSONSimulation
* `POST /csmp/simulation` - čuva simulaciju, u telu zahteva očekuje IJSONSimulation objekat
    Request
        IJSONSimulation
* `DELETE /csmp/simulation/:id` - briše simulaciju za zadati id

#### GPSS
* `POST /gpss/simulate` - pokreće simulaciju, u telu zahteva očekuje IGpssSimulation
* `GET /gpss/simulation` - vraća listu sačuvanih simulacija
* `GET /gpss/simulation/:id` - vraća simulaciju za zadati id
* `POST /gpss/simulation` - čuva simulaciju, u telu zahteva očekuje IGpssSimulation
* `DELETE /gpss/simulation/:id` - briše simulaciju za zadati id

## Autentikacija
===================

Za autentikaciju server koristi [JSON web tokens](https://jwt.io/).
Da bi se proverila autentikacija server poziva [https://moodle.elab.fon.bg.ac.rs/](https://moodle.elab.fon.bg.ac.rs/) web servis odakle dobija moodle token ukoliko je korisnik uspešno ulogovan.
Nakon ovoga se kreira jwt token koji se vraća korisniku i koji klijent mora da prosledi u zaglavlju svakog zahteva za sve putanje koje su zaštićene.

## CSMP
===================

Sva logika za CSMP simulaciju nalazi se u folderu Elab/Csmp.

### Folderi
===================

```
+Blocks - klase svih blokova
+config
    blocks.php - niz dostupnih blokova
    methods.php - niz dostupnih metoda
+Enums
    BlockType.php - definiše tipove blokova, trenutno se ne koristi
+Exceptions - custom exceptions
+Helpers
    Numbers.php - pomoćna klasa za rad sa decimalnim brojevima
+Methods - klase dostupnih metoda integracije
Block.php - klasa jednog bloka simulacije, svi blokovi se izvode iz ove klase
EmptyBlock.php - klasa praznog bloka
IntegrationMethod.php - apstraktna klasa iz koje se izvode sve metode integracije
IoTService.php - servis za rad sa IoT elementom
RungeKutta.php - iplementacija generičke RungeKutta metode, sve metode integracije za sada se izvode iz ove klase
Simulation.php - klasa simulacije
```

### CSMP tipovi
===================

IMetaJSONBlock opisuje jedan blok.
```
export interface IMetaJSONBlock {
	className: string;
	numberOfParams: number;
	numberOfStringParams: number;
	maxNumberOfInputs: number;
	hasOutput:boolean;
	sign: string;
	description: string;
	info: string;
	paramDescription: string[];
	stringParamDescription: string[];
	isAsync: boolean;
}
```

IJSONSimulation opisuje jednu simulaciju.
```
export interface IJSONSimulation {
	description: string;
	date: number;
	method: string;
	duration: number;
	integrationInterval: number;
	blocks: IJSONBlock[];
	optimizeAsync: boolean;
}
```

IJSONBlock sadrži sve parametre i poziciju bloka.
```
export interface IJSONBlock {
	className: string;
	position: IPosition;
	params: number[];
	stringParams: string[];
	inputs: number[];
	rotation: number;
}
```

IMetaJSONMethod opisuje jednu metodu integracije.
```
export interface IMetaJSONMethod {
    className: string;
    description: string;
}
```

### CSMP Internet of Things
===================

U folderu webservices se nalaze primeri implementacije web servisa za IoT element.
Prilikom poziva web servisa šalju se parametri bloka, vrednosti ulaza u blok i trenutno vreme izvršavanja simulacije.
Pošto vrednost ulaza u blok može biti 0 to nije dovoljna informacija da li na tom ulazu u blok zaista postoji ulazni blok,
iz tog razloga se šalje i niz konekcija koje imaju vrednost indeksa ulaza ako postoji prikačen blok ili -1 ako je ulaz prazan.
Primer sa korišćenjem konekcija kako bi se našao prosek ulaza (ma koliko ulaza bilo) se nalazi u fajlu webservices/Average.php.

## GPSS
===================

Sva logika za GPSS simulaciju nalazi se u folderu Elab/Gpss.

GPSS simulacija se izvršava na odvojenom gpss delphi serveru. Humbolt server služi kao među server između klijentske aplikacije humbolt client i gpss delphi servera.

GPSS Delphi Server je zasnovan na postojećoj verziji programa GPSS napisanom u programskom jeziku Pascal, a potom proširen u programski jezik Delphi.
Proširenje se vodi u dodavanju asinhronog HTTP web servera koji prihvata ulaze od strane klijentske aplikacije, a potom poziva podrutine koje vrše simulaciju.
Na kraju, rezultat simulacije se štampa korisniku u JSON formatu.
