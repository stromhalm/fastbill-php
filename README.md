#Fastbill

Dies ist eine kleine Library für die Fastbill API.
So können Sie mit wenigen Schritten und wenig Vorkenntnissen auf Ihre Fastbill Daten zugreifen und diese verarbeiten. Für die Requests benötigen Sie nur die [Fastbill-API Dokumentation](http://www.fastbill.com/api/ "Fastbill API Dokumentation"). Am einfachsten ist es sich an die JSON Request Beispiele zu halten. Diese müssen nur als Array umgewandelt dem request übergeben werden.



##Installation

binden Sie die aktuellste Version ein und initialisieren Sie die fastbill-Klasse mit Ihrer Fastbill-Email und APIKey.

<pre><code>require("fastbill.x.x.php");
$fastbill = new fastbill("%Fastbill-Email%", "%Fastbill-APIKey%");</code></pre>
Ersetzen Sie %Fastbill-Email% durch Ihre Fastbill-Email (z.B. max@mustermann.de) und %Fastbill-APIKey% durch Ihren Fastbill-APIKey (z.B. 1238751bd8714ciafnafv3afubafeGizQnudJHBzfaiusbwt48). Sollten Sie die Parameter vergessen oder diese Leer sein gibt new fastbill() False zurück.



##Klassen

<pre><code>$fastbill->request();</code></pre>
Diese Klasse erwartet ein Array mit den Request Daten: Service, Filter, Limit, Offset und Data.
Als Rückgabe erhalten Sie die Fastbill Antwort als Array.
Sollte etwas nicht funktionieren erhalten Sie als Rückgabe False.



##Beispiele

Hier ein Beispiel für Rechnungen:
<pre><code>// Als Rückgabe erhalten Sie alle Rechnungen
$temp = $fastbill->request(array("SERVICE" => "invoice.get"));
print_r($temp);

// Hier alle Ausgangsrechnungen
$temp = $fastbill->request(array("SERVICE" => "invoice.get", "FILTER" => array("TYPE" => "outgoing")));
print_r($temp);

// Und hier die ersten drei Ausgangsrechnungen
$temp = $fastbill->request(array("SERVICE" => "invoice.get", "FILTER" => array("TYPE" => "outgoing"), "LIMIT" => 3));
print_r($temp);</code></pre>

Hier ein Beispiel für Kunden:
<pre><code>// Als Rückgabe erhalten Sie alle Kunden
$temp = $fastbill->request(array("SERVICE" => "customer.get"));
print_r($temp);

// Hier den Kunden mit der ID 5376
$temp = $fastbill->request(array("SERVICE" => "invoice.get", "FILTER" => array("CUSTOMER_ID" => 5376)));
print_r($temp);</code></pre>

