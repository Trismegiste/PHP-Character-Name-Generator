<?php
require_once __DIR__ . '/vendor/autoload.php';

$repository = new \App\NameGenerator\Repository(__DIR__ . '/database');
?><!DOCTYPE html>
<html>
    <head>
        <title>Launch Page: Random Name Generator</title>
        <meta charset="UTF-8">
        <meta name="description" content="">
        <meta name="keywords" content="">
        <meta name="author" content="Mark Tasaka 2021">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>  
        <link rel="stylesheet" href="launchPage/css/randomNameText.css"/> 
        <script type="text/javascript" src="launchPage/js/nameMenu.js"></script>
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta charset="utf-8" />
    </head>
    <body>
        <section>
            <h1><img src="launchPage/images/title.png" alt="Random Name Generator" class="image" /></h1>
            <br/>
            <br/>
            <P>The Random Name Generator is an RPG tool designed to generate lists of randomly generated names, providing Game Masters with the means of producing lists of names for random NPCs, townsfolk, villagers, rank-and-file foot soldiers, etc., their Players may encounter during the game session.  These names are from real world examples based on different nations and ethnic groups; the given names are from 50 distinct countries/ethnic groups and the surnames from 38 distinct groups.  The data used by the Random Name Generator comes from <a href="http://www.familyeducation.com/" target="_blank" class="text_link"><span class="bold">familyeducation.com</span></a>, a new family resource website containing valuable information on family planning and the origins of baby names. </P>
            <br/>
            <br/>
            <h3><img src="launchPage/images/title3.png" alt=" Random Name Generator" class="image" /></h3>
            <form action="" id ="nameGenForm"  target="_blank" method="post">
                <div class="content11">
                    <div id="hideNames">
                        <span class="formIputDescriptionRandomName">Given Name:</span>	
                        <select id="givenName" name="theGivenName" class="randomNameBox">
                            <option value="100"selected>Random</option>	
                            <?php
                            $given = $repository->getGivenNameLanguage();

                            foreach ($given as $lang) {
                                $label = ucfirst($lang);
                                echo "<option value=\"$lang\">$label</option>";
                            }
                            ?>                            
                        </select>
                        <br/>
                        <br/>
                        <span class="formIputDescriptionRandomName">Surname:</span>	
                        <select id="surname" name="theSurname" class="randomNameBox">	
                            <option value="100">Random</option>	
                            <?php
                            $surname = $repository->getSurnameLanguage();

                            foreach ($given as $lang) {
                                $label = ucfirst($lang);
                                echo "<option value=\"$lang\">$label</option>";
                            }
                            ?>
                        </select>
                        <br/>
                        <br/>
                    </div>
                    <span class="formIputDescriptionRandomName">Gender:</span>	
                    <select id="gender" name="theGender" class="randomNameBox">	
                        <option value="male">Male</option>
                        <option value="female" selected>Female</option>
                    </select>
                    <br/>
                    <br/>
                    <span class="formIputDescriptionRandomName">Names Displayed:</span>	
                    <select id="namesDisplayed" name="theNamesDisplayed" class="randomNameBox">	
                        <option value="10">10</option>
                        <option value="15">15</option>	
                        <option value="20">20</option>
                        <option value="30">30</option>	
                        <option value="50" selected>50</option>
                        <option value="100">100</option>
                        <option value="200">200</option>
                    </select>
                    <br/>
                    <br/>
                    <div class="randomGenNameCheckBox">
                        <span class="footnote3"><input type="checkbox" id="totallyRandomName" value="1" name="theTotallyRandomName"  onClick="hideCharacterName()">Totally Random Names</span>
                    </div>
                    <br/>
                    <br/>
                </div>
                <div class="content8">
                    <div class="generatorButtonA2">
                        <span class="generatorbuttonsC1">
                            <input type="submit" value="" id="generate_randomName"/>
                        </span>
                        <span class="generatorbuttonsC1">
                            <input type="reset"  value="" id="reset_generatorName"  onClick="unhideCharacterName()"/>
                        </span>
                    </div>
                </div>
                <br/>
                <br/>
            </form>
            <script>
                $("#generate_randomName").click(function () {
                    $("#nameGenForm").attr('action', "randomName/nameGenerator.php");
                });
            </script>
        </section>
    </body>
</html>