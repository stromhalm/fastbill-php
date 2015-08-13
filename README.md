#Fastbill

Dies ist eine kleine Library um mittels PHP mit der Fastbill API kommunizieren zu können.
So können Sie mit wenigen Schritten und wenig Vorkenntnissen auf Ihre Fastbill-Daten zugreifen und diese verarbeiten. 

In der [Fastbill-API Dokumentation](http://www.fastbill.com/api/ "Fastbill API Dokumentation") finden Sie die Struktur der einzelnen Requests. Diese müssen in Form von Arrays an die Klasse übergeben werden. Am einfachsten ist es, sich an die **Request - JSON** Beispiele aus der Dokumentation zu halten.



##Installation

Binden Sie die aktuellste Version ein und initialisieren Sie die fastbill-Klasse mit Ihrer Fastbill-Email und APIKey.

``` php
require("FastBill.php");
$fastbill = new \FastBill\FastBill(string $email, string $apiKey [, string $apiUrl = FASTBILL_PLUS]);
```
Ersetzen Sie <code>$email</code> durch Ihre Fastbill-E-Mail-Adresse (z.B. *max@mustermann.de*) und <code>$apiKey</code> durch Ihren Fastbill-APIKey (z.B. *1238751bd8714ciafnafv3afubafeGizQnudJHBzfaiusbwt48*). Sollten Sie die Parameter vergessen oder diese Leer sein gibt <code>new fastbill()</code> *False* zurück.

Optional können Sie als 3 Parameter die APIURL übergeben.

Oder binden Sie den Wrapper über Composer ein:

``` php
{
    "digitalschmiede/fastbill": "dev-master"
}
```

##Klassen

###Debug-Modus
``` php
$fastbill->setDebug(bool $status = false);
```
Mit dieser Klasse können Sie den Debug-Modus aktivieren oder deaktivieren. Standardmäßig ist der Debug-Modus deaktiviert.

Sobald der Debug-Modus aktiviert wurde erhalten Sie bei Fehlerfällen ein Array in dem Format: <code>array("RESPONSE" => array("ERROR" => array("Fehler1","Fehler2",...)));</code> zurück.

###Request
``` php
$fastbill->request(array $request [, string $file]);
```
Diese Klasse erwartet ein Array mit den Request Daten: *Service* [, *Filter, Limit, Offset* und *Data*].
Als Rückgabe erhalten Sie die Fastbill Antwort in einem Array.
Sollte es zu Fehlern kommen, erhalten Sie als Rückgabe *False* oder das Debugarray.

Wenn Sie eine Datei übergeben möchten können Sie entweder den kompletten Pfad des Servers zu der gewünschten Datei übergeben oder nach dem Hochladen <code>$_FILES[%parameter%]["tmp_name"]</code>.



##Beispiele


###Rechnungen
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

###Kunden
``` php
// Als Rückgabe erhalten Sie alle Kunden
$temp = $fastbill->request(array("SERVICE" => "customer.get"));
print_r($temp);

// Hier den Kunden mit der ID 5376
$temp = $fastbill->request(array("SERVICE" => "invoice.get", "FILTER" => array("CUSTOMER_ID" => 5376)));
print_r($temp);
```

