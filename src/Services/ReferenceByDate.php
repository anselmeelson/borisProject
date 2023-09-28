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
        return $this->docs->findLastDocument();


    }

    public function getRef(){
        return $this->getDocumentByMonth();
    }

}
              