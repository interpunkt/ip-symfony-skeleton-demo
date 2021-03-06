## Controller

### indexAction
```
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
```
### insertAction
```
    /**
     * @Route("/$path$/$repo$/insert", name="$path$_$repo$_insert")
     */
    public function insertAction(Request $request)
    {
        $data = new $repo$();
    $form = $this->createForm($repo$Type::class, $data);
    $result = $this->handleFormUpload($form, $request);
    if($result)
    {
        return $this->redirectToRoute('$path$_$repo$');
    }
    $html = $this->renderView(
        '$path$/$repo$/insert.html.twig', array(
            'data' => $data,
            'form' => $form->createView()
        )
    );
    return new Response($html);
    }
```
### updateAction
```
    /**
     * @Route("/admin/$repo$/update/{id}", name="$path$_$repo$_update")
     */
    public function updateAction(Request $request, $id)
    {
        $data = $this->getDoctrine()
            ->getRepository('DevPro$path$Bundle:$repo$')
            ->find($id);
        $form = $this->createForm($repo$Type::class, $data);
        $result = $this->handleFormUpload($form, $request);
        if($result)
        {
            return $this->redirectToRoute('$path$_$repo$');
        }
        $html = $this->renderView(
            '$path$/$repo$/update.html.twig', array(
                "form" => $form->createView()
            )
        );
        return new Response($html);
    }
```

### deleteAction
```
    /**
     * @Route("/$path$/$repo$/delete/{id}", name="$path$_$repo$_delete")
     */
    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $data = $em->getRepository('DevPro$path$Bundle:$repo$')
            ->find($id);
        $em->remove($data);
        $em->flush();
        return $this->redirectToRoute('$path$_$repo$');
    }
```
### handFormUpload
```
    /**
     * @return bool
     */
    public function handleFormUpload($form, $request)
    {
        $form->handleRequest($request);
        if ($form->isValid() && $form->isSubmitted())
        {
            $data = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($data);
            $em->flush();
            return true;
        }
    }
}
```
