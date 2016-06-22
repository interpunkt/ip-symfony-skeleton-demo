Live Templates für die Skeleton Anwendung & PHPStorm

Controller
    Main Actions inkl. Routen
    - IndexAction -> Alle Daten aus der Entity an index.html.twig rendern
    - insertAction -> Datensatz aus Form in DB
    - updateAction -> Datensatz update
    - deleteAction -> Datensatz löschen

    Sub Functions
    * render ->
    * handleForm ->
    * selectFindBy ->


Entity



FormType


Twig

<?php

class foo
{
// indexAction
    /**
     * @Route("/$path$/$repo$", name="$path$_$repo$")
     */
    public function indexAction()
    {
        $data = $this->getDoctrine()->getRepository('DevPro$path$Bundle:$repo$')
            ->findBy(array(), array(
                'sort' => 'DESC'
            ));
        $html = $this->renderView(
            '$path$/$repo$/index.html.twig', array(
                'data' => $data
            )
        );
        return new Response($html);
    }

// insertAction
// updateAction
// deleteAction
}

