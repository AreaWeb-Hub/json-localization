<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Document\AddDocumentRequest;
use App\Http\Requests\Document\GetDocumentRequest;
use App\Http\Requests\Document\GetDocumentsRequest;
use App\Http\Requests\Document\ImportTranslationsRequest;
use App\Http\Resources\Document\MinifiedDocumentResource;
use Illuminate\Http\Request;
use App\Facades\Document;

class DocumentController extends Controller
{
    public function add(AddDocumentRequest $request)
    {
        Document::setProject($request->input('projectId'))
            ->add($request->input('documents'));

        return responseCreated();
    }

    public function list(GetDocumentsRequest $request)
    {
        return MinifiedDocumentResource::collection(
            Document::setProject($request->get('projectId'))
                ->list()
        );
    }

    public function import(\App\Models\Document $document, ImportTranslationsRequest $request)
    {
        Document::setDocument($document)
            ->importTranslations(
                $request->input('lang'),
                $request->input('data'),
            );

        return responseOk();
    }

    public function show(\App\Models\Document $document, GetDocumentRequest $request)
    {
        return Document::setDocument($document)
            ->getTranslations($request->get('lang'));
    }

    public function destroy(\App\Models\Document $document)
    {
        $document->delete();
        return responseOk();
    }
}
