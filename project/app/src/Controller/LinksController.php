<?php


namespace RudiMVC\Controller;


use RudiMVC\Core\Abstracts\AbstractView;
use RudiMVC\Core\RudiController;
use RudiMVC\Core\RudiEntityManager\RudiEntity;
use RudiMVC\Core\Services\UptimeCheckerService;
use Nette\Forms\Form;
use RudiMVC\Entities\Links;
use RudiMVC\Entities\Urls;

class LinksController extends RudiController {

    private $entityManager;

    public function __construct(AbstractView $view)
    {
        parent::__construct($view);
        $this->entityManager = new RudiEntity();
    }

    public function indexAction() {
        $UptimeCheckerService = new UptimeCheckerService();
        $tblLinks = $this->entityManager->getEntityManager()->getRepository('RudiMVC\Entities\Urls');
        $urls = $tblLinks->findAll();
        $listallLinks = [];
        foreach ($urls as $url) {
            $listallLinks[] = [
                'id' => $url->getId(),
                'link' => $url->getUrl(),
                'linkText' => $url->getUrlText(),
                'description' => $url->getDescription(),
                'reachable' => $UptimeCheckerService->isReachable($url->getUrl())
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
        $form->addText('url', 'Link:');
        $form->addText('url_text', 'Url-Text:');

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
            $urls = new Urls();
            $urls->setUrl($values->url);
            $urls->setUrlText($values->url_text);
            $urls->setDescription($values->description);
            $em = $this->entityManager->getEntityManager();
            $em->persist($urls);
            $em->flush();

        } catch (\Exception $e) {
           echo $e->getMessage();
        }


    }
}