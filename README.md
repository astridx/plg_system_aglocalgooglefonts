# plg_system_aglocalgooglefonts

## Funktionen
- deaktivieren und 
- ersetzten

## Modus
- benutzerdefiniert und 
- auto

### deaktivieren

#### auto

(Anwendbar bei Template von YOOtheme)  

Sucht im HTML-Quelltext nach link-tags für eine CSS-Datei mit dem Namen 
- theme.css und 
- bootstrap.css und ändert den Tag.  

Wenn eine solche Datei gefunden wird, dann wird eine Kopie davon gespeichert, 
in der die link -Tags auskommentiert werden.

In den CSS-Dateien wird 

```@import 'https://fonts.googleapis.com/css?family=Playfair+Display:700,400,400italic';```

zu

```/*@import 'https://fonts.googleapis.com/css?family=Playfair+Display:700,400,400italic';*/```

Diese Datei, wird dann anstelle der ursprünglichen Datei geladen.  

Beispiel:  

Der Tag 

```<link rel="stylesheet" href="templates/mytemplate/css/theme.css">```

wird zu

```<link rel="stylesheet" href="templates/mytemplate/css/disable_google_font_theme.css">```

#### benutzerdefiniert

Im Modus benutzerdefiniert kann der Pfad zu einer CSS-Datei - oder einem Skript das per CDN geladen wird - eingegeben werden. 

### Ersetzten

Ist die Funktion ersetzen aktiviert, wird die deaktiviert Sprache von Google heruntergeladen.

Beispiel:  
Wird eine Schrift mit der URL  

`https://fonts.googleapis.com/css?family=Playfair+Display:700,400,400italic`

importiert, dann wird die Schrift 

`https://fonts.google.com/specimen/Playfair+Display`

ins Verzeichnis 

`/plugins/system/plg_system_aglocalgooglefonts/src/plugins/system/aglocalgooglefonts/fonts`

kopiert.

Außerdem wird im Verzeichnis eine CSS Datei mit dem Inhalt

```
@font-face {
	font-family: "Playfair Display";
	font-weight: 700;
	font-style: normal;
	src: url(http://localhost/jgering/plugins/system/aglocalgooglefonts/fonts/nuFlD-vYSZviVYUb_rj3ij__anPXBYf9lW4e5j5hNKc.woff2) format('woff2'), url(http://localhost/jgering/plugins/system/aglocalgooglefonts/fonts/nuFlD-vYSZviVYUb_rj3ij__anPXBYf9lW4e4A.woff) format('woff');
}
@font-face {
	font-family: "Playfair Display";
	font-weight: 400;
	font-style: normal;
	src: url(http://localhost/jgering/plugins/system/aglocalgooglefonts/fonts/nuFiD-vYSZviVYUb_rj3ij__anPXDTzYgEM86xQ.woff2) format('woff2'), url(http://localhost/jgering/plugins/system/aglocalgooglefonts/fonts/nuFiD-vYSZviVYUb_rj3ij__anPXDTzYhg.woff) format('woff');
}
```
angelegt.  
Diese Datei wird unmittelbar nach dem öffnenden head-Tag im HTML eingebunden:  

`<link href="/plugins/system/aglocalgooglefonts/css/font-7bc9d3f413ab8bdac41b2dfd06547ef4.css" rel="stylesheet" />`


