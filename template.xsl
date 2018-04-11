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
                <xsl:for-each select="cv/informations_personnelles">
                    <h1 class="name"><xsl:value-of select="concat(nom, ' ', prenom)"></xsl:value-of></h1>
					<br/>
                    <h2 class="name">
                        <xsl:value-of select="concat(/cv/poste-recherche/recherche, ' ', /cv/poste-recherche/contrat, ' pour ', /cv/poste-recherche/duree)"></xsl:value-of>
                    </h2>
					<br/>
                    <p class="informations">
                        <xsl:value-of select="concat(naissance, naissance/@age)"></xsl:value-of><br/>
						<br/>
                        <xsl:value-of select="adresse"></xsl:value-of><br/>
						<br/>
                        <xsl:value-of select="concat(ville, ' ')"></xsl:value-of>
						<xsl:value-of select="codePostal"></xsl:value-of><br/>
						<br/>
                        <xsl:value-of select="mail"></xsl:value-of><br/>
						<br/>
                        <xsl:value-of select="telephone"></xsl:value-of><br/>
						<br/>
                        <xsl:value-of select="portfolio"></xsl:value-of><br/>
                    </p>
                </xsl:for-each>
                <hr/>
                <div class="formations">
                    <h2>Formations</h2>
                    <xsl:for-each select="cv/formations">
                        <xsl:for-each select="./formation">
                            <div class="formation">
                                <h3><xsl:value-of select="formation_titre"></xsl:value-of></h3>
                                <span><xsl:value-of select="formation_annee"></xsl:value-of></span>
                                <p class="formation-e">
									<xsl:value-of select="concat(formation_etablissement, ' ')"></xsl:value-of>
									<xsl:value-of select="concat('(', formation_lieu, ')')"></xsl:value-of>
								</p>
                            </div>
                        </xsl:for-each>
                    </xsl:for-each>
                </div>
                <hr/>
                <div class="competences">
                    <h2>Compétences</h2>
                    <div class="competence">
                        <xsl:for-each select="cv/competences">
                            <xsl:for-each select="./competence">
                                <ul>
                                    <li><xsl:value-of select="concat(competence_nom, ' ', competence_niveau)"></xsl:value-of></li>
                                </ul>
                            </xsl:for-each>
                        </xsl:for-each>
                    </div>
                </div>
                <hr/>
                <div class="experiences">
                    <h2>Experiences</h2>
                    <xsl:for-each select="cv/experiences">
                        <xsl:for-each select="./experience">
                            <div class="experience">
                                <h3><xsl:value-of select="experience_nom" /></h3>
                                <span><xsl:value-of select="experience_entreprise" /></span>
                                <p><xsl:value-of select="experience_mission" /></p>
								<p><xsl:value-of select="experience_duree" /></p>
                            </div>
                        </xsl:for-each>
                    </xsl:for-each>
                </div>
                <hr/>
                <div class="langues">
                    <h2>Langues</h2>
                    <xsl:for-each select="cv/langues">
                            <xsl:for-each select="./langue">
                                <ul>
                                    <li><xsl:value-of select="."></xsl:value-of></li>
                                </ul>
                            </xsl:for-each>
                    </xsl:for-each>
                </div>
                <hr/>
                <div class="centre_interet">
                    <h2>Centre d'interet</h2>
                    <xsl:for-each select="cv/centre-interet">
                            <xsl:for-each select="./centreinteret_nom">
                                <ul>
                                    <li><xsl:value-of select="."></xsl:value-of></li>
                                </ul>
                            </xsl:for-each>
                    </xsl:for-each>	
                </div>
            </div>
        </div>
        
    </body>
</html>
</xsl:template>
</xsl:stylesheet>