<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform"> 
<xsl:template match="/">
<html>
    <head>
        <title>Tableau</title>
        <style type="text/css">
        * {
        box-sizing: border-box;
        }

        html, body {
        height: 100%;
        font-family: Verdana, Arial, sans-serif;
        }

        body {
        margin: 0;
        }

        .global {
        background-color: lightgrey;
		margin : 0;
        }

        .container {
        margin: 25px auto;
        min-height: 1200px;
        padding: 35px 0;
        width: 70%;
        background-color: #fff;
        }

        .name, .informations {
        text-align: center;
        margin: 0;
        }

        hr {
        width: 70%;
        margin: 15px auto;
        color: #e7e7e7;
        }

        .formations, .competences, .experiences, .langues, .centre_interet {
        width: 70%;
        margin: 0 auto;
        }

        .formation h3, .experience h3 {
        margin-bottom: 0;
        display: inline;
        }
        .formation h3:after, .experience h3:after {
        content: ' \2192';
        }

        </style>
    </head>
    <body>
        <div class="global">
            <div class="container">
                <xsl:for-each select="xml/entreprise">
                    <h1 class="name"><xsl:value-of select="nom"></xsl:value-of></h1>
					<br/>
                    <h2 class="name">
                        <xsl:value-of select="type"></xsl:value-of>
                    </h2>
					<hr/>
                    <p class="informations">
                        <xsl:value-of select="secteuractivite"></xsl:value-of><br/>
						<br/>
                        <xsl:value-of select="adresse"></xsl:value-of><br/>
						<br/>
                        <xsl:value-of select="courriel"></xsl:value-of><br/>
						<br/>
                        <xsl:value-of select="drh"></xsl:value-of><br/>
                    </p>
                </xsl:for-each>
            </div>
        </div>
        
    </body>
</html>
</xsl:template>
</xsl:stylesheet>