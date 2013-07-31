#Fastbill

Dies ist eine kleine Library für die Fastbill API.
So können Sie mit wenigen Schritten und wenig Vorkenntnissen auf Ihre Fastbill-Daten zugreifen und diese verarbeiten. 

Die [Fastbill-API Dokumentation](http://www.fastbill.com/api/ "Fastbill API Dokumentation") finden Sie die Struktur der einzelnen Requests. Diese müssen in Form von Arrays an die Klasse übergeben werden. Am einfachsten ist es, sich an die **Request - JSON** Beispiele aus der Dokumentation zu halten.



##Installation

Binden Sie die aktuellste Version ein und initialisieren Sie die fastbill-Klasse mit Ihrer Fastbill-Email und APIKey.

``` php
require("fastbill.x.x.php");
$fastbill = new fastbill("%Fastbill-Email%", "%Fastbill-APIKey%");
```
Ersetzen Sie **%Fastbill-Email%** durch Ihre Fastbill-Email (z.B. max@mustermann.de) und **%Fastbill-APIKey%** durch Ihren Fastbill-APIKey (z.B. 1238751bd8714ciafnafv3afubafeGizQnudJHBzfaiusbwt48). Sollten Sie die Parameter vergessen oder diese Leer sein gibt new fastbill() *False* zurück.



##Klassen

``` php
$fastbill->request();
```
Diese Klasse erwartet ein Array mit den Request Daten: *Service, Filter, Limit, Offset* und *Data*.
Als Rückgabe erhalten Sie die Fastbill Antwort in einem Array.
Sollte es zu Fehlern kommen, erhalten Sie als Rückgabe *False*.



##Beispiele

JSON in einen Array Wandeln:
``` php
// Mit der PHP-Funktion json_decode
$JSON = '{ "SERVICE":"invoice.get", "FILTER": { "TYPE":"outgoing" }, "LIMIT":1 }';
$array = json_decode($JSON);
print_r($array);

// Sie können auch, wie ich es in den kommenden Beispielen gemacht habe, das JSON per Hand in ein Array konvertieren.
```

Hier ein Beispiel für Rechnungen:
``` php
// Als Rückgabe erhalten Sie alle Rechnungen
$temp = $fastbill->request(array("SERVICE" => "invoice.get"));
print_r($temp);

// Hier alle Ausgangsrechnungen
$temp = $fastbill->request(array("SERVICE" => "invoice.get", "FILTER" => array("TYPE" => "outgoing")));
print_r($temp);

// Und hier die ersten drei Ausgangsrechnungen
$temp = $fastbill->request(array("SERVICE" => "invoice.get", "FILTER" => array("TYPE" => "outgoing"), "LIMIT" => 3));
print_r($temp);
```

Hier ein Beispiel für Kunden:
``` php
// Als Rückgabe erhalten Sie alle Kunden
$temp = $fastbill->request(array("SERVICE" => "customer.get"));
print_r($temp);

// Hier den Kunden mit der ID 5376
$temp = $fastbill->request(array("SERVICE" => "invoice.get", "FILTER" => array("CUSTOMER_ID" => 5376)));
print_r($temp);
```

