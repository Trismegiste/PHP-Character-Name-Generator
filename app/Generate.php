<?php

/*
 * Name Generator
 */

namespace App;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Trismegiste\NameGenerator\FileRepository;
use Trismegiste\NameGenerator\RandomizerDecorator;

/**
 * Controller
 */
class Generate
{

    protected $repository;

    public function __construct()
    {
        $this->repository = new RandomizerDecorator(new FileRepository(__DIR__ . '/../database'));
    }

    public function form(): Response
    {
        $given = $this->repository->getGivenNameLanguage();
        $surname = $this->repository->getSurnameLanguage();
        $html = $this->render('template/form.php', ['given' => $given, 'surname' => $surname]);

        return new Response($html);
    }

    public function result(Request $request): Response
    {
        $numberNames = $request->request->get("theNamesDisplayed", 50);
        $givenName = $request->request->get("theGivenName");
        $surname = $request->request->get("theSurname");
        $gender = $request->request->get("theGender");
        $totallyRandomName = $request->request->get("theTotallyRandomName", 0);

        if ($totallyRandomName == 1) {
            $givenName = 'random';
            $surname = 'random';
        }

        $nameGenerated = [];
        for ($k = 0; $k < $numberNames; $k++) {
            // listings are cached, therefore, it's ok to call the same language again and again
            $surnameList = $this->repository->getSurnameListFor($surname);
            $givenList = $this->repository->getGivenNameListFor($gender, $givenName);

            $nameGenerated[] = $givenList[random_int(0, count($givenList) - 1)]
                    . ' ' .
                    $surnameList[random_int(0, count($surnameList) - 1)];
        }

        $html = $this->render('template/result.php', [
            'nameGenerated' => $nameGenerated,
            'givenName' => $givenName,
            'surname' => $surname,
            'gender' => $gender
        ]);

        return new Response($html);
    }

    // helper function to render templates
    protected function render($path, array $args = [])
    {
        extract($args);
        ob_start();
        require $path;
        $html = ob_get_clean();

        return $html;
    }

}
