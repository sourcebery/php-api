<?php

namespace App\Transformers;

use App\Models\Page;
use App\Transformers\UserAttachedTransformer;
use League\Fractal\TransformerAbstract;

class PageTransformer extends TransformerAbstract {

    protected $defaultIncludes = ['users'];

    public function transform(Page $page) {
        return [
            'id' => (int) $page->id,
            'guid' => $page->guid,
            'type' => $page->type,
            'status' => $page->status,
            'title' => $page->title,
            'state' => !empty($page->state) ? $page->state : '',
            'body' => !empty($page->body) ? $page->body : '',
            'created' => $page->created_at->toIso8601String(),
            'updated' => $page->updated_at->toIso8601String()
        ];
    }

    public function includeUsers(Page $page) {
        return $this->collection($page->users, new UserAttachedTransformer);
    }

}
