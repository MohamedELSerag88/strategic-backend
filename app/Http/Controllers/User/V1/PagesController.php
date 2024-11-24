<?php

namespace App\Http\Controllers\User\V1;

use App\Http\Controllers\Controller;
use App\Http\Filters\PaginationPipeline;
use App\Http\Filters\SortPipeline;
use App\Http\Requests\User\MembershipRequest;
use App\Http\Resources\User\MembershipResource;
use App\Http\Resources\User\PageResource;
use App\Models\Membership;
use App\Models\Page;

class PagesController extends Controller
{


    public function index()
    {
        $pages = Page::select("name", "slug")->get();
        return $this->response->statusOk(["data" =>$pages]);
    }

    /**
     * Display the specified resource.
     */
    public function show($slug)
    {
        $page = Page::where('slug' ,$slug)->first();
        if(!$page){
            return $this->response->statusFail(trans("messages.page_not_found"));
        }

        return $this->response->statusOk(["data" => new PageResource($page)]);
    }



}
