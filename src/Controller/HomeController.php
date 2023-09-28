<?php

namespace App\Controller;

use App\Entity\Document;
use App\Form\DocumentType;
use App\Repository\DocumentRepository;
use App\Services\ReferenceByDate;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController{

    public function __construct(private EntityManagerInterface $manager, private DocumentRepository $documentRepository)
    {
        
    }

    #[Route(path:'/', name:'home.index')]
    public function index(Request $request, ReferenceByDate $referenceByDate)
    {
        $document = new Document();
        $form = $this->createForm(DocumentType::class, $document);
        $form->handleRequest($request);
        $ref = "1";

        dd($referenceByDate->getRef());

        $docs = $this->documentRepository->findAll();

        if($form->isSubmitted()){
            $document->setCreatedAt(new DateTimeImmutable())
            ->setRef(time() . '-' . mt_rand());
            $month = date('m');
            $year = date('Y');
            die($year);
            $this->manager->persist($document);
            $this->manager->flush();
            $ref = $document->getRef();
            $this->addFlash('success', "Nouvelle référence générée");
            return $this->redirectToRoute('home.index');
        }

        return $this->render('home.html.twig', [
            'ref'   => $ref,
            'form'  => $form->createView(),
            'docs'  => $docs
        ]);
    }

}