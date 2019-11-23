<?php


namespace RudiMVC\Controller;


use RudiMVC\Core\Abstracts\AbstractView;
use RudiMVC\Core\RudiController;
use RudiMVC\Core\RudiEntityManager\RudiEntity;
use RudiMVC\Core\Services\UptimeCheckerService;
use Nette\Forms\Form;
use RudiMVC\Entities\Links;

class LinksController extends RudiController {

    private $entityManager;

    public function __construct(AbstractView $view)
    {
        parent::__construct($view);
        $this->entityManager = new RudiEntity();
    }

    public function indexAction() {
        $UptimeCheckerService = new UptimeCheckerService();
        $tblLinks = $this->entityManager->getEntityManager()->getRepository('RudiMVC\Entities\Links');
        $links = $tblLinks->findAll();
        $listallLinks = [];
        foreach ($links as $link) {
            $listallLinks[] = [
                'id' => $link->getId(),
                'link' => $link->getLink(),
                'linkText' => $link->getLinkText(),
                'country' => $link->getCountry(),
                'description' => $link->getDescription(),
                'reachable' => $UptimeCheckerService->isReachable($link->getLink())
            ];
        }
        $data['links'] = $listallLinks;
        $data['message'] = 'URLS to check';
        $this->view->render(__METHOD__, $data);

    }

    /**
     *
     */
    public function addAction() {

        $form = new Form;
        $form->setAction('/index.php/links/add');
        $form->setMethod('POST');
        $form->addText('link', 'Link:');
        $form->addText('linktext', 'Link-Text:');
        $form->addText('country', 'Country');
        $form->addTextArea('description', 'Description');
        $form->addSubmit('send', 'Add Link');
        $data['message'] = "Add new Link";
        $data['form'] = $form;
        if ($form->isSubmitted()) {
            $this->addLinkToDatabase($form->getValues());
            $data['form_message'] = "Data has been saved";
        }
        $this->view->render(__METHOD__, $data);
    }

    /**
     * @param array|null $values
     */
    private function addLinkToDatabase($values):void {

        try {
            $link = new Links();
            $link->setLink($values->link);
            $link->setLinkText($values->linktext);
            $link->setCountry($values->country);
            $link->setDescription($values->description);
            $this->entityManager->getEntityManager()->persist($link);
            $this->entityManager->getEntityManager()->flush();

        } catch (\Exception $e) {
           echo $e->getMessage();
        }


    }
}