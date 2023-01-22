<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Document\AddDocumentRequest;
use App\Http\Requests\Document\GetDocumentsRequest;
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

    public function destroy(\App\Models\Document $document)
    {
        $document->delete();
        return responseOk();
    }
}
