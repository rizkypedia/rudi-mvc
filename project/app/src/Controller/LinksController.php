<?php


namespace RudiMVC\Controller;


use RudiMVC\Core\Abstracts\AbstractView;
use RudiMVC\Core\RudiController;
use RudiMVC\Core\RudiEntityManager\RudiEntity;
use RudiMVC\Core\Services\UptimeCheckerService;

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
}