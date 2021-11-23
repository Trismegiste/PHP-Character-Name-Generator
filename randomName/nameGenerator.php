<?php
require_once dirname(__DIR__) . '/vendor/autoload.php';
?><!DOCTYPE html>
<html>
    <head>
        <title>Name Generator</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <meta charset="UTF-8">
        <meta name="description" content=" Random Name Generator..">
        <meta name="keywords" content=",PHP,HTML5,CSS,JavaScript">
        <meta name="author" content="Mark Tasaka 2021">
        <link rel="icon" href="../../../images/favicon/icon.png" type="image/png" sizes="16x16"> 
        <link rel="stylesheet" type="text/css" href="css/randomNameGen.css">
    </head>
    <body>
        <?php
        $request = Symfony\Component\HttpFoundation\Request::createFromGlobals();

        $numberNames = $request->request->get("theNamesDisplayed", 50);
        $givenName = $request->request->get("theGivenName");
        $surname = $request->request->get("theSurname");
        $gender = $request->request->get("theGender");
        $totallyRandomName = $request->request->get("theTotallyRandomName", 0);

        if ($totallyRandomName == 1) {
            $givenName = 100;
            $surname = 100;
        }

        // generating
        $surnameList = Symfony\Component\Yaml\Yaml::parseFile("./../database/surname/$surname.yml");
        $givenList = Symfony\Component\Yaml\Yaml::parseFile("./../database/$gender/$givenName.yml");

        $nameGenerated = [];
        for ($k = 0; $k < $numberNames; $k++) {
            $nameGenerated[] = $givenList[random_int(0, count($givenList) - 1)] .
                    ' ' . $surnameList[random_int(0, count($surnameList) - 1)];
        }

        // $nameGenerated = getName($numberNames, $givenName, $surname, $gender);

        $nameGeneratedCol1 = array();
        $nameGeneratedCol2 = array();

        $nameCount = count($nameGenerated);

        if ($nameCount >= 20) {
            $nameGeneratedCol1 = array_slice($nameGenerated, 0, ($nameCount / 2));
            $nameGeneratedCol2 = array_slice($nameGenerated, ($nameCount / 2));
        }

        $lastName = array(
        );

        $lastName2 = array_unique($lastName);
        ?>

        <img id="title"/>

        <span id="nameInformation">
            Given Name: <?php echo ucfirst($givenName); ?> (<?php echo ucfirst($gender); ?>)       
            Last Name: <?php echo ucfirst($surname); ?>
        </span>
        <span id="nameBlock">
            <?php
            if ($nameCount >= 20) {
                foreach ($nameGeneratedCol1 as $name) {
                    echo $name . '<br/><br/>';
                }
            } else {
                foreach ($nameGenerated as $name) {
                    echo $name . '<br/><br/>';
                }
            }
            ?>

        </span>
        <span id="nameBlock2">
            <?php
            if ($nameCount >= 20) {
                foreach ($nameGeneratedCol2 as $name) {
                    echo $name . '<br/><br/>';
                }
            }
            ?>
        </span>
        <script>
            let imgData = "images/title.png";
            $("#title").attr("src", imgData);
        </script>
    </body>
</html>