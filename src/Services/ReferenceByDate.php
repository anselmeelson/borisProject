<?php

namespace App\Services;

use App\Repository\DocumentRepository;

class ReferenceByDate{

    public function __construct(private DocumentRepository $docs)
    {
        
    }

    private function getDocumentByMonth()
    {
        $docs = [];
        $month = date('m');
        $year = date('Y');
        $doc = $this->docs->findLastDocument();
        // if($doc->getId() == )


    }

    public function getRef(){
        return $this->getDocumentByMonth();
    }

}
              